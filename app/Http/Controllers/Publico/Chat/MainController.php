<?php
namespace App\Http\Controllers\Publico\Chat;

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
        $this->middleware('auth:webpublico');    
        $this->middleware('hasPermission:Publico:AsideControlls:Chat',[ 'only' => ['index','listAllJsonPermisos','listAllJsonUsuarios','show']] );
        $this->middleware('hasPermission:Publico:AsideControlls:Chat:Crear',[ 'only' => ['create']] );
        $this->middleware('hasPermission:Publico:AsideControlls:Chat:Editar',[ 'only' => ['edit']] );
        $this->middleware('hasPermission:Publico:AsideControlls:Chat:Guardar',[ 'only' => ['store']] );
        $this->middleware('hasPermission:Publico:AsideControlls:Chat:Actualizar',[ 'only' => ['update']] );
        $this->middleware('hasPermission:Publico:AsideControlls:Chat:Eliminar',[ 'only' => ['destroy']] );
        $this->chatDao = $ChatDao;
        $this->usuarioDao = $UsuarioDao;
        $this->usuarioPublicoDao = $UsuarioPublicoDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->loggerDao = $LoggerDao;
        $this->sessionsDao = $SessionsDao;
    }
   

    public function index()
    {    
      $usuariosAdministradores = $this->usuarioDao->listAll(); 
      $usuariosAdministradoresArray = array();
      foreach( $usuariosAdministradores as $index => $usuarioAdmin ){
        $usuarioAdminArray = array(
            'id' => $usuarioAdmin->getId(),
            'usuario' => $usuarioAdmin->getUsuario(),
            'nombre' => $usuarioAdmin->getNombre(),
            'apellidoPaterno' => $usuarioAdmin->getApellidoPaterno(),
            'apellidoMaterno' => $usuarioAdmin->getApellidoMaterno(),
            'email' => $usuarioAdmin->getEmail(),
            'depend' => $usuarioAdmin->getInstitucion()->getNombre(),
            'tipo' => 'Admin',
            'status' => $usuarioAdmin->getStatus() 
        );
        $usuariosAdministradoresArray[] = $usuarioAdminArray;
      }

      $data['usuarios'] = $usuariosAdministradoresArray;

      return view('publico.chat.index',$data);
    }  
  

    /* JSON CHAT ADMIN*/ 
    public function commentAdmin(Request $request)
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
            , 'tipo' => "Admin" ];   
            $redis->publish('message', json_encode($data));
        }
        catch (ConnectionException $e) { } 

        return response(200 , 200)->header('Content-Type', 'text/plain');
    }
  
   
    public function mensajesChatAdministrador($EmailUser,$EmailFriend,$num){
        $mensajes = $this->chatDao->mensajesByEmailUsersAdmin($EmailUser,$EmailFriend,$num);     
        echo json_encode($mensajes);              
    }
    


    public function mensajeLeido( $id ){
        $comentarioUsuarioPublico = $this->chatDao->findComentarioUsuarioPublicoById( $id );
        $comentarioUsuarioPublico->setLeido(1); 
        $this->chatDao->updateComentarioUsuarioPublico( $comentarioUsuarioPublico );
        
        return response(200 , 200)->header('Content-Type', 'text/plain');
    }

      
    



}

