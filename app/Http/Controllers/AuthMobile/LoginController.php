<?php
namespace App\Http\Controllers\AuthMobile;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* DAOS */
use App\Daos\Dispositivos\DispositivoDao;  
use App\Daos\UsuariosMobile\UsuarioMobileDao;
use App\Daos\LoggerDao;

/**ENTITIE */
use App\Entities\Logger;

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth; 
use Request;
use Hash;
use Session;
use File;

 
class LoginController extends Controller
{

  protected $usuarioMobileDao;
  protected $dispositivoDao;
  protected $loggerDao;

  public function __construct(
     UsuarioMobileDao $UsuarioMobileDao
    ,DispositivoDao $DispositivoDao
    ,LoggerDao $LoggerDao)
  {
      $this->usuarioMobileDao = $UsuarioMobileDao;
      $this->dispositivoDao = $DispositivoDao;
      $this->loggerDao = $LoggerDao;
  }
 
   
  public function administradorIndex()
  {  
    if ( Auth::guard('mobile')->check() )
    {
      return response('Logeado', 200)->header('Content-Type', 'text/plain');
    }else{
      return response('No Autorizado', 401)->header('Content-Type', 'text/plain');
    }
  }

       

  public function authenticate(Request $request)
  {  
        $imei = $request::header('Imei');
   
        /* CHECA AUTORIZACION DEL USUARIO */ 
        $usuario = $this->usuarioMobileDao->findByUser($request::get('usuario'));
        if( $usuario != null ){
            if( ! $usuario->getStatus() ){  
                return response('No Autorizado', 401)->header('Content-Type', 'text/plain');
            }
        } 
        
        /* CHECA AUTORIZACION DEL DISPOSITIVO */ 
        $dispositivo = $this->dispositivoDao->findByIdUnico( $imei );       
        if( $dispositivo == FALSE || !$dispositivo->getStatus()) { 
            return response('No Autorizado', 401)->header('Content-Type', 'text/plain');
        }

      $credentials = array('usuario' => $request::get('usuario') , 'password' => $request::get('password'));

      if( Auth::guard('mobile')->attempt($credentials) )
      {
          /* CHECA PERMISOS DEL USUARIO */ 
          $permisos = array();
          foreach ( $usuario->getPermisos() as $index => $permiso) {  
          array_push($permisos, $permiso->getNombre() );
          }

          Session::put('permisos', $permisos );
          Session::put('idUsuarioMovil', $usuario->getId() ); 
          Session::put('usuario', $usuario->getUsuario() );  
          Session::put('nombreUsuario',$usuario->getNombre()." ".$usuario->getApellidoPaterno() );
          Session::put('sistema', "Mobile" );

          $this->loggerDao->create( new Logger("Ha iniciado sesión" ) );     

          return response('Logeado', 200)->header('Content-Type', 'text/plain');
      }   
      else 
      {
          return response('Usuario o password incorrectos', 401)->header('Content-Type', 'text/plain');
      }
  }


  public function getLogout()
  {  
    $this->loggerDao->create( new Logger("Ha cerrado sesión" ) );
    Auth::guard('mobile')->logout();
    Session::getHandler()->destroy( Session::getId() );
    Session::flush();
    Session::regenerate(true);
    Session::regenerate();
    return response('Ha cerrado sesión', 200)->header('Content-Type', 'text/plain');
  }

    



}

