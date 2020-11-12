<?php

namespace App\Http\Controllers\Auth;

/* ENTITIES */
use App\Entities\Logger;

/* DAOS */
use App\Daos\Usuarios\UsuarioDao;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsuarioDao $UsuarioDao
    ,LoggerDao $LoggerDao)
    {
        $this->usuarioDao = $UsuarioDao;
        $this->loggerDao = $LoggerDao;
    }


    public function showLoginForm()
    { 
        if(Auth::check()){
            return redirect()->intended('/administracion/welcome');
        } else {
            return view('administracion.index');
        }
    }


    
    public function authenticate(Request $request)
    {

        /* CHECA AUTORIZACION DEL USUARIO */ 
        $usuario = $this->usuarioDao->findByUser($request::get('usuario'));
        if( $usuario != null ){
            if( ! $usuario->getStatus() ){  
                return Redirect::to('login')->with('errores','Usuario Bloqueado!.');
            }
        }

        $credentials = array('usuario' => $request::get('usuario') , 'password' => $request::get('password'));

        if(Auth::attempt($credentials, false))
        {  
            /* CHECA PERMISOS DEL USUARIO */ 
            $permisos = array();
            foreach ( $usuario->getPermisos() as $index => $permiso) {  
                array_push($permisos, $permiso->getNombre() );
            }

            Session::put('permisos', $permisos );
            Session::put('idUsuario', $usuario->getId() );
            Session::put('usuario', $usuario->getUsuario() );
            Session::put('nombreUsuario',$usuario->getNombre()." ".$usuario->getApellidoPaterno()." ".$usuario->getApellidoMaterno() );
            Session::put('dependencia', $usuario->getInstitucion()->getNombre() );
            Session::put('dependenciaNombreCorto', $usuario->getInstitucion()->getNombreCorto() );
            Session::put('sistema', "WEB" );

            $this->loggerDao->create( new Logger("Ha iniciado sesión" ) );     
            return redirect()->intended('/administracion/welcome');
        }     
        else 
        {
            return Redirect::to('login')->with('errores','Usuario o Password Incorrectos!.');
        }
    }      

   
    public function logout()
    {
        $this->loggerDao->create( new Logger("Ha cerrado sesión" ) );
        Auth::logout();
        Session::invalidate();
        return Redirect::to('login')->with('mensaje','Hasta luego.');
    }


}
