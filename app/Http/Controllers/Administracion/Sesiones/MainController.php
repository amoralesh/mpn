<?php
namespace App\Http\Controllers\Administracion\Sesiones;

/* ENTITIES */
use App\Entities\Logger;
  
/* DAOS */ 
use App\Daos\SessionsDao;
use App\Daos\LoggerDao;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Hash;
use Session;
use File;  

class MainController extends Controller
{
  
    protected $sessionsDao;
    protected $loggerDao;

    public function __construct(
         SessionsDao $SessionsDao
        ,LoggerDao $LoggerDao)
    {
        $this->middleware('auth'); 
        $this->middleware('hasPermission:Administracion:AsideControlls:Sessions',[ 'only' => ['index','listadoJsonSesiones','listAllJsonUsuarios']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Sessions:Eliminar',[ 'only' => ['cerrarSesion']] );
        $this->sessionsDao = $SessionsDao;
        $this->loggerDao = $LoggerDao;
    }
   

    public function index()
    {   
      return view('administracion.sessions.index');
    }  
  
 

    //INFORMACION O DATOS DE LOS ELEMENTOS ACTUALES Y NO ACTIVOS EN EL SISTEMA
    public function listadoJsonSesiones(){  
      $sessions = $this->sessionsDao->listAll();

      $arraySesiones = array();
        foreach ($sessions as $indice => $session) {

          if( $session->getUser_id() != null ){
              $payload = unserialize(base64_decode($session->getPayload() )); // At this point you have an array
              
              $nombreUsuario = "";
              $usuario = "";
              $sistema = ""; 
    
              if ( isset( $payload['nombreUsuario'] ) ) { $nombreUsuario = $payload['nombreUsuario']; }
              if ( isset( $payload['usuario'] ) ) { $usuario = $payload['usuario']; }
              if ( isset( $payload['sistema'] ) ) { $sistema = $payload['sistema']; }
    
              $arraySesion = array(  
                  'id' => $session->getId(), 
                  'user_id' => $session->getUser_id(), 
                  'ip_address' => $session->getIp_address(), 
                  'user_agent' => $session->getUser_agent(),
                  'payload' => 'Nombre Usuario: ' . $nombreUsuario . '<br> Usuario: ' . $usuario . '<br> Sistema: ' . $sistema, // At this point you have an array ,
                  'last_activity' => $session->getLast_activity()
              );
              $arraySesiones[] =  $arraySesion;
          }
        }

      return response( $arraySesiones , 200)->header('Content-Type', 'application/json');
   
    }  

    public function cerrarSesion(Request $request){ 
      $session = $this->sessionsDao->findById(  $request->get('id') ); 
      $this->sessionsDao->remove($session);
      
    }


  
}

