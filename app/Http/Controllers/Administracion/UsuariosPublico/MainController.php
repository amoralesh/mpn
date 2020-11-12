<?php
namespace App\Http\Controllers\Administracion\UsuariosPublico;

/*ENTITIES*/
use App\Entities\UsuariosPublico\UsuarioPublico;
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger;
  
/*DAOS*/
use App\Daos\UsuariosPublico\InstitucionPublicoDao;
use App\Daos\UsuariosPublico\PermisoPublicoDao;
use App\Daos\UsuariosPublico\UsuarioPublicoDao;
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

    protected $institucionPublicoDao;
    protected $permisoPublicoDao;
    protected $usuarioPublicoDao;  
    protected $loggerDao;


    public function __construct(
        InstitucionPublicoDao $InstitucionPublicoDao
        ,PermisoPublicoDao $PermisoPublicoDao
        ,UsuarioPublicoDao $UsuarioPublicoDao
        ,LoggerDao $LoggerDao)
    {   
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Publico:Usuarios',[ 'only' => ['index','listAllJsonPermisos','listAllJsonUsuarios','show']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Publico:Usuarios:Crear',[ 'only' => ['create']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Publico:Usuarios:Editar',[ 'only' => ['edit']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Publico:Usuarios:Guardar',[ 'only' => ['store']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Publico:Usuarios:Actualizar',[ 'only' => ['update']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Publico:Usuarios:Eliminar',[ 'only' => ['destroy']] );
        $this->institucionPublicoDao = $InstitucionPublicoDao;  
        $this->permisoPublicoDao = $PermisoPublicoDao;
        $this->usuarioPublicoDao = $UsuarioPublicoDao;
        $this->loggerDao = $LoggerDao;
    }
   

    public function index()    
    {   
        return view('administracion.usuariosPublico.index');
    }  



    public function create()
    {
      $data['institucionList'] = $this->institucionPublicoDao->listAll();    
      return view('administracion.usuariosPublico.nuevo', $data);
    }


    public function edit($id)
    { 
        $data['id'] = $id;
        $data['usuario'] = $this->usuarioPublicoDao->findById($id);
        $data['institucionList'] = $this->institucionPublicoDao->listAll();
        
        $permisosArreglo = array();
        foreach( $data['usuario']->getPermisosPublicos() as $indice => $permiso )
        { array_push($permisosArreglo, $permiso->getId() ); }
        $data['permisosList'] = $permisosArreglo;

        return view('administracion.usuariosPublico.editar', $data);    
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
      $institucion = $request->get('institucion');
      $permisosElegidos = $request->get('permisosElegidos');

       //creamos un array con las reglas que deben cumplir nuestro formulario
      $rules = array(
          'nombre'           => 'required',
          'apPaterno'        => 'required',
          'apMaterno'        => 'required',
          'email'            => 'required|email|unique:App\Entities\UsuariosPublico\UsuarioPublico,email',
          'usuario'          => 'required|unique:App\Entities\UsuariosPublico\UsuarioPublico,usuario',
          'password'         => 'required|confirmed',
          'password_confirmation' => 'required',
          'institucion'      => 'required|Integer',
          'permisosElegidos' => 'required'
      );

      //personalizamos los mensajes de error para nuestro formualario
      $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'Integer' => 'El campo :attribute no existe.',
        'confirmed' => 'El campo :attribute debe ser igual.',
        'unique' => 'El campo :attribute ya existe'
       );

        //validation necesita los campos, las reglas y opcionalmente los mensajes,
        //si no le pasamos los mensajes los pondrá en inglés, que son los que vienen
        //por defecto con laravel
       $validation = Validator::make($request->all(), $rules, $messages);

         //si la validación falla redirigimos a formularios con los errores
        //y los campos que haya ingresado el usuario para que queden grabados
        if ($validation->fails())
        {
            return Redirect::to('/administracion/usuariospublico/create')->withErrors($validation)->withInput();
        } else {

              $EnteroPermisos = explode(',', $permisosElegidos);

              $user = new UsuarioPublico;
              $user->setNombre($nombre);
              $user->setApellidoPaterno($apPaterno);
              $user->setApellidoMaterno($apMaterno);
              $user->setUsuario($usuario);
              $user->setPassword(Hash::make($password));
              $user->setEmail($email);

              $depen = $this->institucionPublicoDao->findById($institucion);
              $permisosList = $this->permisoPublicoDao->listAllByMultipleIds($EnteroPermisos);

              $user->setInstitucionPublico($depen);
              $user->setPermisosPublicos($permisosList);

              $this->usuarioPublicoDao->create($user);

              $this->loggerDao->create( new Logger("Ha creado al usuario público: " . $user->getUsuario() ) );
              return Redirect::to('/administracion/usuariospublico')->with('mensaje','Usuario Creado Correctamente!.');
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
      $institucion = $request->get('institucion');
      $permisosElegidos = $request->get('permisosElegidos');

       //creamos un array con las reglas que deben cumplir nuestro formulario
       $rules = array(
            'nombre'           => 'required',
            'apPaterno'        => 'required',
            'apMaterno'        => 'required',
            'email'            => 'required|email|unique:App\Entities\UsuariosPublico\UsuarioPublico,email,' . $id,
            'usuario'          => 'required|unique:App\Entities\UsuariosPublico\UsuarioPublico,usuario,' .  $id,
            'password'         => 'confirmed',
            'password_confirmation' => '',
            'institucion'      => 'required|Integer',
            'permisosElegidos' => 'required'
        );


      //personalizamos los mensajes de error para nuestro formualario
      $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'Integer' => 'El campo :attribute no existe.',
        'confirmed' => 'El campo :attribute debe ser igual.',
        'unique' => 'El campo :attribute ya existe'
       );

        //validation necesita los campos, las reglas y opcionalmente los mensajes,
        //si no le pasamos los mensajes los pondrá en inglés, que son los que vienen
        //por defecto con laravel
       $validation = Validator::make($request->all(), $rules, $messages);

         //si la validación falla redirigimos a formularios con los errores
        //y los campos que haya ingresado el usuario para que queden grabados
        if ($validation->fails())
        {
            return Redirect::to('/administracion/usuariospublico/'. $id . '/edit')->withErrors($validation)->withInput();
        } else {

            $user = $this->usuarioPublicoDao->findById($id);

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

            $depen = $this->institucionPublicoDao->findById($institucion);
            $permisosList = $this->permisoPublicoDao->listAllByMultipleIds($EnteroPermisos);
            $user->setInstitucionPublico($depen);
            $user->setPermisosPublicos($permisosList);

            $this->usuarioPublicoDao->update($user);

            $this->loggerDao->create( new Logger("Ha actualizado al usuario Publico: " . $user->getUsuario() ) );
            return Redirect::to('/administracion/usuariospublico/'. $id . '/edit')->with('mensaje','Usuario Actualizado Correctamente!.');
        }
    }
    

    public function destroy($id)
    {
       echo 'destroy';
    }




    /* JSON REQUEST */
    public function listAllJsonPermisos()
    {
      $permisos = $this->permisoPublicoDao->listAll();

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

      $usuarios = $this->usuarioPublicoDao->listAll();

      $usuariosArray = array(); 
      foreach( $usuarios as $index => $usuario ){
        $usuarioArray = array(
            'id' => $usuario->getId(),
            'usuario' => $usuario->getUsuario(),
            'nombre' => $usuario->getNombre(),
            'apellidoPaterno' => $usuario->getApellidoPaterno(),
            'apellidoMaterno' => $usuario->getApellidoMaterno(),
            'email' => $usuario->getEmail(),
            'depend' => $usuario->getInstitucionPublico()->getNombre(),
            'status' => $usuario->getStatus() 
        );
        $usuariosArray[] = $usuarioArray;
      }  
      
      return response( $usuariosArray , 200)->header('Content-Type', 'application/json');
    }


    public function habilitar( Request $request ){
        $id = $request->get('id');

        $usuario = $this->usuarioPublicoDao->findById($id);
        $usuario->setStatus(true);
        $motivoAltaBaja = new MotivoAltaBaja;
        $motivoAltaBaja->setContenido('Habilitado'); 
        $motivoAltaBaja->setTipo('');
        $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
        $usuario->addMotivoAltaBaja( $motivoAltaBaja );
         
        $this->usuarioPublicoDao->update($usuario);   
        $this->loggerDao->create( new Logger("Ha Habilitado al usuario público: " . $usuario->getUsuario() ) );

        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    }

    
    public function deshabilitar( Request $request ){ 
        $id = $request->get('id');

        $usuario = $this->usuarioPublicoDao->findById($id);
        $usuario->setStatus(false);
        $motivoAltaBaja = new MotivoAltaBaja;
        $motivoAltaBaja->setContenido('Deshabilitado'); 
        $motivoAltaBaja->setTipo('');
        $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
        $usuario->addMotivoAltaBaja( $motivoAltaBaja );

        $this->usuarioPublicoDao->update($usuario);
        $this->loggerDao->create( new Logger("Ha deshabilitado al usuario público: " . $usuario->getUsuario() ) );

        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    }
  
}

