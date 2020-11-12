<?php

namespace App\Http\Controllers\AuthPublico;

/* ENTITIES */
use App\Entities\Logger;

/* DAOS */
use App\Daos\UsuariosPublico\UsuarioPublicoDao;
use App\Daos\LoggerDao;

/* LIBRERIAS */
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Request;
use Auth;
use Hash;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/publico/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    public function __construct(UsuarioPublicoDao $UsuarioPublicoDao
    ,LoggerDao $LoggerDao)
    {
        $this->usuarioPublicoDao = $UsuarioPublicoDao;
        $this->loggerDao = $LoggerDao;
    }

 
    public function showLoginForm()
    {   
        if( Auth::guard('webpublico')->check() ){
            return redirect()->intended('/publico/dashboard');
        } else {
            return view('publico.index');   
        }

    }

  
    
    public function authenticate(Request $request)
    {

        /* CHECA AUTORIZACION DEL USUARIO */ 
        $usuario = $this->usuarioPublicoDao->findByUser($request::get('usuario'));
        if( $usuario != null ){
            if( ! $usuario->getStatus() ){  
                return Redirect::to('publico/login')->with('errores','Usuario Bloqueado!.');
            }
        }  

        $credentials = array('usuario' => $request::get('usuario') , 'password' => $request::get('password'));

        if( Auth::guard('webpublico')->attempt($credentials) )
        {  
            /* CHECA PERMISOS DEL USUARIO */  
            $permisos = array();
            foreach ( $usuario->getPermisosPublicos() as $index => $permiso) {  
                    array_push($permisos, $permiso->getNombre() );
            } 
   
            Session::put('permisos', $permisos );
            Session::put('idUsuario', $usuario->getId() );
            Session::put('usuario', $usuario->getUsuario() );
            Session::put('nombreUsuario',$usuario->getNombre()." ".$usuario->getApellidoPaterno()." ".$usuario->getApellidoMaterno() );
            Session::put('dependencia', $usuario->getInstitucionPublico()->getNombre() );
            Session::put('dependenciaNombreCorto', $usuario->getInstitucionPublico()->getNombreCorto() );
            Session::put('sistema', "WEBPUBLICO" );
     
            $this->loggerDao->create( new Logger("Ha iniciado sesión" ) );
            return redirect()->intended('/publico/dashboard');
        }     
        else   
        {
            return Redirect::to('publico/login')->with('errores','Usuario o Password Incorrectos!.');
        }
        
    }  
   
    public function logout()
    {
        $this->loggerDao->create( new Logger("Ha cerrado sesión" ) );
        Auth::guard('webpublico')->logout();   
        Session::invalidate();
        return Redirect::to('publico/login')->with('mensaje','Hasta luego.');
    }

  
}
