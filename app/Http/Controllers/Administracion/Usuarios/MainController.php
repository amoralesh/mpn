<?php
namespace App\Http\Controllers\Administracion\Usuarios;

/*ENTITIES*/
use App\Entities\Usuarios\Usuario;
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger;
  
/*DAOS*/
use App\Daos\Usuarios\InstitucionDao;
use App\Daos\Usuarios\PermisoDao;
use App\Daos\Usuarios\UsuarioDao;
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

    protected $institucionDao;
    protected $permisoDao;
    protected $usuarioDao;  
    protected $loggerDao;


    public function __construct(
        InstitucionDao $InstitucionDao
        ,PermisoDao $PermisoDao
        ,UsuarioDao $UsuarioDao
        ,LoggerDao $LoggerDao)
    {   
        $this->middleware('auth');   
        $this->middleware('hasPermission:Administracion:AsideControlls:Administracion:Usuarios',[ 'only' => ['index','listAllJsonPermisos','listAllJsonUsuarios','show']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Administracion:Usuarios:Crear',[ 'only' => ['create']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Administracion:Usuarios:Editar',[ 'only' => ['edit']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Administracion:Usuarios:Guardar',[ 'only' => ['store']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Administracion:Usuarios:Actualizar',[ 'only' => ['update']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Administracion:Usuarios:Eliminar',[ 'only' => ['destroy']] ); 
        $this->institucionDao = $InstitucionDao;
        $this->permisoDao = $PermisoDao;
        $this->usuarioDao = $UsuarioDao;
        $this->loggerDao = $LoggerDao;
    }
   
    public function index()    
    {   
        return view('administracion.usuarios.index');
    }  



    public function create()
    {
      $data['institucionList'] = $this->institucionDao->listAll();    
      return view('administracion.usuarios.nuevo', $data);
    }


    public function edit($id)
    { 
        $data['id'] = $id;
        $data['usuario'] = $this->usuarioDao->findById($id);
        $data['institucionList'] = $this->institucionDao->listAll();
        
        $permisosArreglo = array();
        foreach( $data['usuario']->getPermisos() as $indice => $permiso )
        { array_push($permisosArreglo, $permiso->getId() ); }
        $data['permisosList'] = $permisosArreglo;

        return view('administracion.usuarios.editar', $data);    
    }
  

    public function store(Request $request)
    { 
      $nombre = $request->get('nombre');
      $apPaterno = $request->get('apPaterno');
      $apMaterno = $request->get('apMaterno');
      $email = $request->get('email');
      $usuario = $request->get('usuario');
      $placa = $request->get('placa');
      $password = $request->get('password');
      $password_confirmation = $request->get('password_confirmation');
      $institucion = $request->get('institucion');
      $permisosElegidos = $request->get('permisosElegidos');

       //creamos un array con las reglas que deben cumplir nuestro formulario
      $rules = array(
          'nombre'           => 'required',
          'apPaterno'        => 'required',
          'apMaterno'        => 'required',
          'email'            => 'required|email|unique:App\Entities\Usuarios\Usuario,email',
          'usuario'          => 'required|unique:App\Entities\Usuarios\Usuario,usuario',
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
            return Redirect::to('/administracion/usuarios/create')->withErrors($validation)->withInput();
        } else {

              $EnteroPermisos = explode(',', $permisosElegidos);

              $user = new Usuario;
              $user->setNombre($nombre);
              $user->setApellidoPaterno($apPaterno);
              $user->setApellidoMaterno($apMaterno);
              $user->setUsuario($usuario);
              $user->setPassword(Hash::make($password));
              $user->setEmail($email);
              $user->setPlaca($placa);

              $depen = $this->institucionDao->findById($institucion);
              $permisosList = $this->permisoDao->listAllByMultipleIds($EnteroPermisos);

              $user->setInstitucion($depen);
              $user->setPermisos($permisosList);

              $this->usuarioDao->create($user);

              $this->loggerDao->create( new Logger("Ha creado al usuario: " . $user->getUsuario() ) );
              return Redirect::to('/administracion/usuarios')->with('mensaje','Usuario Creado Correctamente!.');
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
      $placa = $request->get('placa');
      $password = $request->get('password');
      $password_confirmation = $request->get('password_confirmation');
      $institucion = $request->get('institucion');
      $permisosElegidos = $request->get('permisosElegidos');

       //creamos un array con las reglas que deben cumplir nuestro formulario
       $rules = array(
            'nombre'           => 'required',
            'apPaterno'        => 'required',
            'apMaterno'        => 'required',
            'email'            => 'required|email|unique:App\Entities\Usuarios\Usuario,email,' . $id,
            'usuario'          => 'required|unique:App\Entities\Usuarios\Usuario,usuario,' .  $id,
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
            return Redirect::to('/administracion/usuarios/'. $id . '/edit')->withErrors($validation)->withInput();
        } else {

            $user = $this->usuarioDao->findById($id);

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
            $user->setPlaca($placa);

            $EnteroPermisos = explode(',', $permisosElegidos);

            $depen = $this->institucionDao->findById($institucion);
            $permisosList = $this->permisoDao->listAllByMultipleIds($EnteroPermisos);
            $user->setInstitucion($depen);
            $user->setPermisos($permisosList);

            $this->usuarioDao->update($user);

            $this->loggerDao->create( new Logger("Ha actualizado al usuario: " . $user->getUsuario() ) );
            return Redirect::to('/administracion/usuarios/'. $id . '/edit')->with('mensaje','Usuario Actualizado Correctamente!.');
        }
    }
    

    public function destroy($id)
    {
       echo 'destroy';
    }




    /* JSON REQUEST */
    public function listAllJsonPermisos()
    {
      $permisos = $this->permisoDao->listAll();

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

      $usuarios = $this->usuarioDao->listAll();

      $usuariosArray = array();
      foreach( $usuarios as $index => $usuario ){
        $usuarioArray = array(
            'id' => $usuario->getId(),
            'usuario' => $usuario->getUsuario(),
            'nombre' => $usuario->getNombre(),
            'apellidoPaterno' => $usuario->getApellidoPaterno(),
            'apellidoMaterno' => $usuario->getApellidoMaterno(),
            'placa' => $usuario->getPlaca(),
            'email' => $usuario->getEmail(),
            'depend' => $usuario->getInstitucion()->getNombre(),
            'status' => $usuario->getStatus() 
        );
        $usuariosArray[] = $usuarioArray;
      }  
      
      return response( $usuariosArray , 200)->header('Content-Type', 'application/json');
    }


    public function habilitar( Request $request ){
        $id = $request->get('id');

        $usuario = $this->usuarioDao->findById($id);
        $usuario->setStatus(true);
        $motivoAltaBaja = new MotivoAltaBaja;
        $motivoAltaBaja->setContenido('Habilitado'); 
        $motivoAltaBaja->setTipo('');
        $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
        $usuario->addMotivoAltaBaja( $motivoAltaBaja );
         
        $this->usuarioDao->update($usuario);  
        $this->loggerDao->create( new Logger("Ha Habilitado al usuario: " . $usuario->getUsuario() ) );

        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    }

    
    public function deshabilitar( Request $request ){ 
        $id = $request->get('id');

        $usuario = $this->usuarioDao->findById($id);
        $usuario->setStatus(false);
        $motivoAltaBaja = new MotivoAltaBaja;
        $motivoAltaBaja->setContenido('Deshabilitado'); 
        $motivoAltaBaja->setTipo('');
        $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
        $usuario->addMotivoAltaBaja( $motivoAltaBaja );

        $this->usuarioDao->update($usuario);
        $this->loggerDao->create( new Logger("Ha deshabilitado al usuario: " . $usuario->getUsuario() ) );

        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    }
  
}

