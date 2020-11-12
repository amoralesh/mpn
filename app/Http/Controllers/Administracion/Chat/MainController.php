<?php
namespace App\Http\Controllers\Administracion\Chat;

/* ENTITIES */ 
use App\Entities\Logger;
use App\Entities\Chat\Chat_Usuario_UsuarioMobile;
use App\Entities\Chat\Chat_Usuario_UsuarioPublico;
use App\Entities\Chat\ComentarioUsuarioMobile;
use App\Entities\Chat\ComentarioUsuarioPublico;
  
/* DAOS */
use App\Daos\Chat\ChatDao;
use App\Daos\Usuarios\UsuarioDao;
use App\Daos\UsuariosPublico\UsuarioPublicoDao;
use App\Daos\UsuariosMobile\UsuarioMobileDao;
use App\Daos\LoggerDao;  
use App\Daos\SessionsDao;

/* EVENTOS */

/* CONTROL NORMAL */
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Predis\Connection\ConnectionException;
use Hash;
use Session;
use File;  
use Auth;  
use Redis;

class MainController extends Controller  
{
    protected $chatDao;
    protected $usuarioDao;
    protected $usuarioPublicoDao;
    protected $usuarioMobileDao;
    protected $loggerDao;
    protected $sessionsDao;

    public function __construct(
           ChatDao $ChatDao
          ,UsuarioDao $UsuarioDao
          ,UsuarioPublicoDao $UsuarioPublicoDao
          ,UsuarioMobileDao $UsuarioMobileDao
          ,LoggerDao $LoggerDao
          ,SessionsDao $SessionsDao)
    {
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Chat',[ 'only' => ['index','listAllJsonPermisos','listAllJsonUsuarios','show']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Chat:Crear',[ 'only' => ['create']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Chat:Editar',[ 'only' => ['edit']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Chat:Guardar',[ 'only' => ['store']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Chat:Actualizar',[ 'only' => ['update']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Chat:Eliminar',[ 'only' => ['destroy']] );
        $this->chatDao = $ChatDao;
        $this->usuarioDao = $UsuarioDao;
        $this->usuarioPublicoDao = $UsuarioPublicoDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->loggerDao = $LoggerDao;
        $this->sessionsDao = $SessionsDao;
    }
   

    public function index()
    {    
      $usuariosPublicos = $this->usuarioPublicoDao->listAll();
      $usuariosPublicoArray = array();
      foreach( $usuariosPublicos as $index => $usuarioPublico ){
        $usuarioPublicoArray = array(
            'id' => $usuarioPublico->getId(),
            'usuario' => $usuarioPublico->getUsuario(),
            'nombre' => $usuarioPublico->getNombre(),
            'apellidoPaterno' => $usuarioPublico->getApellidoPaterno(),
            'apellidoMaterno' => $usuarioPublico->getApellidoMaterno(),
            'email' => $usuarioPublico->getEmail(),
            'depend' => $usuarioPublico->getInstitucionPublico()->getNombre(),
            'tipo' => 'Publico',
            'status' => $usuarioPublico->getStatus() 
        );
        $usuariosPublicoArray[] = $usuarioPublicoArray;
      }


      $usuariosMobile = $this->usuarioMobileDao->listAll();
      $usuariosMobileArray = array();
      foreach( $usuariosMobile as $index => $usuarioMobile ){
        $usuarioMobileArray = array(
            'id' => $usuarioMobile->getId(),
            'usuario' => $usuarioMobile->getUsuario(),
            'nombre' => $usuarioMobile->getNombre(),
            'apellidoPaterno' => $usuarioMobile->getApellidoPaterno(),
            'apellidoMaterno' => $usuarioMobile->getApellidoMaterno(),
            'email' => $usuarioMobile->getEmail(),
            'tipo' => 'Movil',
            'status' => $usuarioMobile->getStatus() 
        );
        $usuariosMobileArray[] = $usuarioMobileArray;
      } 

      $data['usuarios'] = array_merge($usuariosMobileArray, $usuariosPublicoArray);
      //var_dump ( $data['usuarios']  );
      return view('administracion.chat.index',$data);
    }  
  


     
    /* JSON CHAT ADMIN*/ 
    public function commentPublico(Request $request)
    {
        $message = $request->get('message');
        $emisor = $request->get('emisor');
        $receptor = $request->get('receptor');
         
        $chat_Usuario_UsuarioPublico = new Chat_Usuario_UsuarioPublico;
        $chat_Usuario_UsuarioPublico->setEmisor($emisor);
        $chat_Usuario_UsuarioPublico->setReceptor($receptor);

        $comentarioUsuarioPublico = new ComentarioUsuarioPublico;
        $comentarioUsuarioPublico->setTexto($message); 
        $comentarioUsuarioPublico->setLeido(0); 
        $comentarioUsuarioPublico->setChat_Usuario_UsuarioPublico($chat_Usuario_UsuarioPublico);

        $arregloChat_Usuario_UsuarioPublico = array();
        $arregloChat_Usuario_UsuarioPublico[] = $comentarioUsuarioPublico;
        $chat_Usuario_UsuarioPublico->setMensajes( $arregloChat_Usuario_UsuarioPublico );
        
        $chat_Usuario_UsuarioPublico = $this->chatDao->createPublico( $chat_Usuario_UsuarioPublico );

        try {       
            $redis = Redis::connection();
            $data = [
              'modo' => 'chat'   
            , 'id' => $chat_Usuario_UsuarioPublico->getMensajes()->last()->getId() 
            , 'fechaAlta' => $chat_Usuario_UsuarioPublico->getMensajes()->last()->getFechaAlta()
            , 'emisor' => Auth::user()->getUsuario() 
            , 'receptor' => $receptor
            , 'mensaje' => $message
            , 'tipo' => "Publico" ];   
            $redis->publish('message', json_encode($data));
        }
        catch (ConnectionException $e) { } 
        return response(200 , 200)->header('Content-Type', 'text/plain');
    }

  
    public function mensajesChatPublico($EmailUser,$EmailFriend,$num){
        $mensajes = $this->chatDao->mensajesByEmailUsersAdmin($EmailUser,$EmailFriend,$num);     
        echo json_encode($mensajes);              
    }
    
    /* JSON CHAT APP MOVIL*/ 
    public function commentMobile(Request $request)
    {
        $message = $request->get('message');
        $emisor = $request->get('emisor');
        $receptor = $request->get('receptor');
         
        $emisorC =  $this->usuarioDao->findById( $emisor );
        $receptorC =  $this->usuarioMobileDao->findById($receptor);


        $chat_Usuario_UsuarioMobile = new Chat_Usuario_UsuarioMobile;
        $chat_Usuario_UsuarioMobile->setEmisor($emisorC);
        $chat_Usuario_UsuarioMobile->setReceptor($receptorC);

        $comentarioUsuarioMobile = new ComentarioUsuarioMobile;
        $comentarioUsuarioMobile->setTexto($message);  
        $comentarioUsuarioMobile->setChat_Usuario_UsuarioMobile($chat_Usuario_UsuarioMobile);

        $arregloChat_Usuario_UsuarioMobile = array();
        $arregloChat_Usuario_UsuarioMobile[] = $comentarioUsuarioMobile;
        $chat_Usuario_UsuarioMobile->setMensajes( $arregloChat_Usuario_UsuarioMobile );
        
        $isSended = $this->sendPushNotification( $message , $receptorC );

        if( $isSended ){
            return response(200 , 200)->header('Content-Type', 'text/plain');
            $this->chatDao->createMobile( $chat_Usuario_UsuarioMobile );
        } else{
            return response(500 , 500)->header('Content-Type', 'text/plain');
        }

    }  

 
    public function sendPushNotification( $mensaje , $usuarioMobile ){
        
        if( !$usuarioMobile->getStatus() )
        { return; } 

        $usuariosMobile = array();
        $permisos = array();
        foreach ( $usuarioMobile->getPermisos() as $index => $permiso) {  
            array_push($permisos, $permiso->getNombre() );
        }   
        if( in_array( 'Mobile:Notificaciones:Recibir' , $permisos ) ){
            array_push($usuariosMobile,$usuarioMobile->getUsuario() ); 
        }

        $notificacion = array(
                      "message" => array( 
                          "alert" => $mensaje ,
                          "sound" => "default" 
                      ),
                      "criteria" => array( 
                        "variants" => ["f5d315f2-bc5c-431b-a714-e69783c0f24a"]
                        ,"alias" => $usuariosMobile
                      )  
                    );
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://10.13.9.197:8080/ag-push/rest/sender");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notificacion) );
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_USERPWD, "134db71e-31f8-4fc7-9f3c-f8a340a11b38" . ":" . "7d514b49-efbe-4d2e-acbf-7d0e7af7c2a6");

        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $this->loggerDao->create( new Logger("Falló al enviar el mensaje mobile"));
            return false;
        }
        curl_close ($ch);
        return true;
    }
    
    public function mensajesChatMobile($idUser,$idFriend,$num){ 
      $mensajes = $this->chatDao->mensajesByIdUsersApp($idUser,$idFriend,$num);
      echo json_encode($mensajes);
    }      


    public function mensajeLeidoPublico( $id ){ 
        $comentarioUsuarioPublico = $this->chatDao->findComentarioUsuarioPublicoById( $id );
        $comentarioUsuarioPublico->setLeido(1); 
        $this->chatDao->updateComentarioUsuarioPublico( $comentarioUsuarioPublico );
        
        return response(200 , 200)->header('Content-Type', 'text/plain');
    }

}

