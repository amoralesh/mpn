<?php

namespace App\Http\Controllers\Administracion\UsuariosMobile;

/*ENTITIES*/
use App\Entities\UsuariosMobile\UsuarioMobile;
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger;
  
/*DAOS*/
use App\Daos\UsuariosMobile\PermisoMobileDao;
use App\Daos\UsuariosMobile\UsuarioMobileDao;
use App\Daos\LoggerDao;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;  
use Illuminate\Http\Request;
use Hash;
use Session;
use Auth;

class MainController extends Controller
{
    protected $permisoMobileDao;
    protected $usuarioMobileDao;  
    protected $loggerDao;
    
    public function __construct(
         PermisoMobileDao $PermisoMobileDao
        ,UsuarioMobileDao $UsuarioMobileDao
        ,LoggerDao $LoggerDao)
    {   
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios',[ 'only' => ['index','listAllJsonPermisos','listAllJsonUsuarios','show']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Crear',[ 'only' => ['create']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Editar',[ 'only' => ['edit']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Guardar',[ 'only' => ['store']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Actualizar',[ 'only' => ['update']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Eliminar',[ 'only' => ['destroy']] );
        $this->permisoMobileDao = $PermisoMobileDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->loggerDao = $LoggerDao;
    }
   

    public function index()    
    {   
        return view('administracion.usuariosMobile.index');
    }  



    public function create()
    { 
      return view('administracion.usuariosMobile.nuevo');   
    }


    public function edit($id)
    { 
        $data['id'] = $id;
        $data['usuario'] = $this->usuarioMobileDao->findById($id);
        
        $permisosArreglo = array();
        foreach( $data['usuario']->getPermisos() as $indice => $permiso )
        { array_push($permisosArreglo, $permiso->getId() ); }
        $data['permisosList'] = $permisosArreglo;

        return view('administracion.usuariosMobile.editar', $data);    
    }
  

    public function store(Request $request)
    { 
      $nombre = $request->get('nombre');
      $apPaterno = $request->get('apPaterno');
      $apMaterno = $request->get('apMaterno');
      $email = $request->get('email');
      $usuario = $request->get('usuario');
      $password = $request->get('password');
      $password_confirmation = $request->get('password_confirmation');
      $permisosElegidos = $request->get('permisosElegidos');

       //creamos un array con las reglas que deben cumplir nuestro formulario
      $rules = array(
          'nombre'           => 'required',
          'apPaterno'        => 'required',
          'apMaterno'        => 'required',
          'email'            => 'required|email|unique:App\Entities\UsuariosMobile\UsuarioMobile,email',
          'usuario'          => 'required|unique:App\Entities\UsuariosMobile\UsuarioMobile,usuario',
          'password'         => 'required|confirmed',
          'password_confirmation' => 'required',
          'permisosElegidos' => 'required'
      );

      //personalizamos los mensajes de error para nuestro formualario
      $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'Integer' => 'El campo :attribute no existe.',
        'confirmed' => 'El campo :attribute debe ser igual.',
        'unique' => 'El campo :attribute ya existe'
       );
       
       $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {
            return Redirect::to('/administracion/usuariosmobile/create')->withErrors($validation)->withInput();
        } else {

              $EnteroPermisos = explode(',', $permisosElegidos);
              $user = new UsuarioMobile;
              $user->setNombre($nombre);
              $user->setApellidoPaterno($apPaterno);
              $user->setApellidoMaterno($apMaterno);
              $user->setUsuario($usuario);
              $user->setPassword(Hash::make($password));
              $user->setEmail($email);
              $permisosList = $this->permisoMobileDao->listAllByMultipleIds($EnteroPermisos);
              $user->setPermisos($permisosList);   
              $this->usuarioMobileDao->create($user);
              $this->loggerDao->create( new Logger("Ha creado al usuario mobile: " . $user->getUsuario() ) );
              return Redirect::to('/administracion/usuariosmobile')->with('mensaje','Usuario Creado Correctamente!.');
        }
    }
  

    public function show($cuip)
    {
       echo 'edit';
    }

    public function update(Request $request, $id)
    {

      $nombre = $request->get('nombre');
      $apPaterno = $request->get('apPaterno');
      $apMaterno = $request->get('apMaterno');
      $email = $request->get('email');
      $usuario = $request->get('usuario');
      $password = $request->get('password');
      $password_confirmation = $request->get('password_confirmation');
      $permisosElegidos = $request->get('permisosElegidos');

       $rules = array(
            'nombre'           => 'required',
            'apPaterno'        => 'required',
            'apMaterno'        => 'required',
            'email'            => 'required|email|unique:App\Entities\UsuariosMobile\UsuarioMobile,email,' . $id,
            'usuario'          => 'required|unique:App\Entities\UsuariosMobile\UsuarioMobile,usuario,' .  $id,
            'password'         => 'confirmed',
            'password_confirmation' => '',
            'permisosElegidos' => 'required'
        );

      $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'Integer' => 'El campo :attribute no existe.',
        'confirmed' => 'El campo :attribute debe ser igual.',
        'unique' => 'El campo :attribute ya existe'
       );

       $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {
            return Redirect::to('/administracion/usuariosmobile/'. $id . '/edit')->withErrors($validation)->withInput();
        } else {

            $user = $this->usuarioMobileDao->findById($id);
            $user->setNombre($nombre);
            $user->setApellidoPaterno($apPaterno);
            $user->setApellidoMaterno($apMaterno);
            $user->setUsuario($usuario);
            if( $password == "" || empty($password) ){
                $user->setPassword( $user->getPassword() );
            } else {
                $user->setPassword( Hash::make($password) );
            }
            $user->setEmail($email);
            $EnteroPermisos = explode(',', $permisosElegidos);
            $permisosList = $this->permisoMobileDao->listAllByMultipleIds($EnteroPermisos);
            $user->setPermisos($permisosList);
            $this->usuarioMobileDao->update($user);
            $this->loggerDao->create( new Logger("Ha actualizado al usuario mobile: " . $user->getUsuario() ) );
            return Redirect::to('/administracion/usuariosmobile/'. $id . '/edit')->with('mensaje','Usuario Actualizado Correctamente!.');
        }
    }
    

    public function destroy($id)
    {
       echo 'destroy';
    }


    /* JSON REQUEST */
    public function listAllJsonPermisos()
    {
      $permisos = $this->permisoMobileDao->listAll();
      $permisosArray = array();
      foreach( $permisos as $index => $permiso ){
        $permisoArray = array(
            'id' => $permiso->getId(),
            'nombre' => $permiso->getNombre(),
            'descripcion' => $permiso->getDescripcion()
        );
        $permisosArray[] = $permisoArray;
      }  
      return response( $permisosArray , 200)->header('Content-Type', 'application/json');
    }


    public function listAllJsonUsuarios(){

      $usuarios = $this->usuarioMobileDao->listAll();
      $usuariosArray = array();
      foreach( $usuarios as $index => $usuario ){
        $usuarioArray = array(
            'id' => $usuario->getId(),
            'usuario' => $usuario->getUsuario(),
            'nombre' => $usuario->getNombre(),
            'apellidoPaterno' => $usuario->getApellidoPaterno(),
            'apellidoMaterno' => $usuario->getApellidoMaterno(),
            'email' => $usuario->getEmail(),
            'status' => $usuario->getStatus() 
        );
        $usuariosArray[] = $usuarioArray;
      } 
      return response( $usuariosArray , 200)->header('Content-Type', 'application/json');
    }


    public function habilitar( Request $request ){
        $id = $request->get('id');
        $usuario = $this->usuarioMobileDao->findById($id);
        $usuario->setStatus(true);
        $motivoAltaBaja = new MotivoAltaBaja;
        $motivoAltaBaja->setContenido('Habilitado'); 
        $motivoAltaBaja->setTipo('');
        $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
        $usuario->addMotivoAltaBaja( $motivoAltaBaja );
        $this->usuarioMobileDao->update($usuario);   
        $this->loggerDao->create( new Logger("Ha Habilitado al usuario mobile: " . $usuario->getUsuario() ) );
        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    }

    
    public function deshabilitar( Request $request ){ 

        $id = $request->get('id');
        $usuario = $this->usuarioMobileDao->findById($id);
        $usuario->setStatus(false);
        $motivoAltaBaja = new MotivoAltaBaja;
        $motivoAltaBaja->setContenido('Deshabilitado'); 
        $motivoAltaBaja->setTipo('');
        $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
        $usuario->addMotivoAltaBaja( $motivoAltaBaja );
        $this->usuarioMobileDao->update($usuario);
        $this->loggerDao->create( new Logger("Ha deshabilitado al usuario mobile: " . $usuario->getUsuario() ) );
        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    }

  
}

