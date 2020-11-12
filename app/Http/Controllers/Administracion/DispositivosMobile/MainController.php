<?php
namespace App\Http\Controllers\Administracion\DispositivosMobile;

use App\Entities\DispositivosMobile\DispositivoMobile;
use App\Entities\Logger; 
use App\Entities\MotivoAltaBaja;
 

use App\Daos\Dispositivos\DispositivoDao;
use App\Daos\Dispositivos\TipoDispositivoDao;
use App\Daos\Dispositivos\PermisosDispositivosDao;
use App\Daos\LoggerDao;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Hash;  
use Session;    
use sha1;  
use Auth;  

class MainController extends Controller
{
    protected $permisosDao; 
    protected $dispositivoDao;
    protected $tipoDispositivoDao;
    protected $loggerDao;

    public function __construct(
         PermisosDispositivosDao $PermisosDao
        ,DispositivoDao $DispositivoDao
        ,TipoDispositivoDao $TipoDispositivoDao
        ,LoggerDao $LoggerDao)
    {
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Dispositivos:Mobile',[ 'only' => ['index','listAllJsonPermisos','listAllJsonUsuarios','show']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Dispositivos:Mobile:Crear',[ 'only' => ['create']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Dispositivos:Mobile:Editar',[ 'only' => ['edit']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Dispositivos:Mobile:Guardar',[ 'only' => ['store']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Dispositivos:Mobile:Actualizar',[ 'only' => ['update']] );
        $this->middleware('hasPermission:Administracion:AsideControlls:Dispositivos:Mobile:Eliminar',[ 'only' => ['destroy']] );
        $this->permisosDao = $PermisosDao; 
        $this->dispositivoDao = $DispositivoDao; 
        $this->tipoDispositivoDao = $TipoDispositivoDao; 
        $this->loggerDao = $LoggerDao;
    }
   

  
    public function index()
    {   
      return view('administracion.dispositivosmobile.index');
    }  
   
 
    public function create()
    {
      $data['tipoDispositivoList'] = $this->tipoDispositivoDao->listAll();
      return view('administracion.dispositivosmobile.nuevo',$data);
    }  


    public function edit($id)
    { 
        $permisosArreglo = array();
 
        $data['id'] = $id;
        $data['dispositivo'] = $this->dispositivoDao->findById($id);
        $data['tipoDispositivoList'] = $this->tipoDispositivoDao->listAll();
        
        foreach( $data['dispositivo']->getPermisos() as $indice => $permiso )
        {  array_push($permisosArreglo, $permiso->getId() );} 
        $data['permisosList'] = $permisosArreglo;

        return view('administracion.dispositivosmobile.editar', $data);
    }
  
    public function store(Request $request)
    { 

      $idUnico = $request->get('idUnico');  
      $alias = $request->get('alias');
      $numero = $request->get('numero');
      $modelo = $request->get('modelo');
      $version = $request->get('version');
      $tipo = $request->get('tipo');
      $permisosElegidos = $request->get('permisosElegidos');

      $rules = array(
          'idUnico'       => 'required|unique:App\Entities\DispositivosMobile\DispositivoMobile,idUnico',
          'alias'        => 'required|unique:App\Entities\DispositivosMobile\DispositivoMobile,alias',
          'numero'        => 'required',
          'modelo'            => 'required',
          'version'          => 'required',
          'tipo'          => 'required',
          'permisosElegidos' => 'required'
      );

      $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'unique' => 'El :attribute ya existe'
       );

       $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {
            return Redirect::to('/administracion/dispositivos/mobile/create')->withErrors($validation)->withInput();

        } else {
  
          $EnteroPermisos = explode(',', $permisosElegidos);
 
          $dispositivo = new DispositivoMobile;
          $dispositivo->setIdUnico( $idUnico);
          $dispositivo->setAlias($alias);
          $dispositivo->setNumero($numero);
          $dispositivo->setModelo($modelo);
          $dispositivo->setVersion($version); 

          $tipoClass = $this->tipoDispositivoDao->findById($tipo);    
          $dispositivo->setTipoDispositivo($tipoClass);
     
          $permisosList = $this->permisosDao->listAllByMultipleIds($EnteroPermisos);
          $dispositivo->setPermisos($permisosList);

          $dispositivo->setToken( sha1( $idUnico . $alias ) );
      
          $this->dispositivoDao->create($dispositivo);

          $this->loggerDao->create( new Logger("Ha creado al dispositivo: " . $dispositivo->getIdUnico() ) );
          return Redirect::to('/administracion/dispositivos')->with('mensaje','Dispositivo Creado Correctamente!.');
        }
    }
  

    public function show($cuip)
    {
       echo 'edit';
    }

    
    public function update(Request $request, $id)
    {
      $idUnico = $request->get('idUnico');  
      $alias = $request->get('alias');
      $numero = $request->get('numero');
      $modelo = $request->get('modelo');
      $version = $request->get('version');
      $tipo = $request->get('tipo');
      $permisosElegidos = $request->get('permisosElegidos');

       //creamos un array con las reglas que deben cumplir nuestro formulario
      $rules = array(
          'idUnico'          => 'required|unique:App\Entities\DispositivosMobile\DispositivoMobile,idUnico,'.$id,
          'alias'            => 'required|unique:App\Entities\DispositivosMobile\DispositivoMobile,alias,'.$id,
          'numero'           => 'required',
          'modelo'           => 'required',
          'version'          => 'required',
          'tipo'             => 'required',
          'permisosElegidos' => 'required'
      );

      //personalizamos los mensajes de error para nuestro formualario
      $messages = array( 
        'required' => 'El campo :attribute es obligatorio.'
       );

        //validation necesita los campos, las reglas y opcionalmente los mensajes,
        //si no le pasamos los mensajes los pondrá en inglés, que son los que vienen
        //por defecto con laravel
       $validation = Validator::make($request->all(), $rules, $messages);

         //si la validación falla redirigimos a formularios con los errores
        //y los campos que haya ingresado el usuario para que queden grabados
        if ($validation->fails())
        {
            return Redirect::to('/administracion/dispositivos/mobile/'. $id . '/edit')->withErrors($validation)->withInput();
        } else {

            $dispositivo = $this->dispositivoDao->findById($id);
            $dispositivo->setIdUnico( $idUnico);
            $dispositivo->setAlias($alias);
            $dispositivo->setNumero($numero);
            $dispositivo->setModelo($modelo);
            $dispositivo->setVersion($version);

            $EnteroPermisos = explode(',', $permisosElegidos);
            $permisosList = $this->permisosDao->listAllByMultipleIds($EnteroPermisos);
            $dispositivo->setPermisos($permisosList);
   
            $tipoClass = $this->tipoDispositivoDao->findById($tipo);    
            $dispositivo->setTipoDispositivo($tipoClass);

            $this->dispositivoDao->update($dispositivo);

            $this->loggerDao->create( new Logger("Ha actualizado al dispositivo: " . $dispositivo->getAlias() ) );
            return Redirect::to('/administracion/dispositivos/mobile/'. $id . '/edit')->with('mensaje','Dispositivo Actualizado Correctamente!.');
        } 
    }
    

    public function destroy($id)
    {
       echo 'destroy';
    }


    //JSON
    public function listAllJsonPermisos()
    {
      $permisos = $this->permisosDao->listAll();

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
    
   
    public function listAllJsonDispositivos(){
  
      $dispositivos = $this->dispositivoDao->listAll();
        
      $dispositivosArray = array();
      foreach( $dispositivos as $index => $dispositivo ){
        $DispositivoArray = array(
            'id' => $dispositivo->getId(),
            'idUnico' => $dispositivo->getIdUnico(),
            'alias' => $dispositivo->getAlias(),
            'numero' => $dispositivo->getNumero(),
            'modelo' => $dispositivo->getModelo(),
            'token' => $dispositivo->getToken(),
            'version' => $dispositivo->getVersion(),
            'tipoDispositivo' => $dispositivo->getTipoDispositivo()->getEtiqueta(),
            'fechaAlta' => $dispositivo->getFechaAlta(),
            'status' => $dispositivo->getStatus()
        );
        $dispositivosArray[] = $DispositivoArray;
      }  
      return response( $dispositivosArray , 200)->header('Content-Type', 'application/json');
    }


    public function habilitar( Request $request ){
      $id = $request->get('id'); 

      $dispositivo = $this->dispositivoDao->findById($id);
      $dispositivo->setStatus(true);

      $motivoAltaBaja = new MotivoAltaBaja;
      $motivoAltaBaja->setContenido('Habilitado'); 
      $motivoAltaBaja->setTipo('');
      $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  

      $dispositivo->addMotivoAltaBaja( $motivoAltaBaja );
       
      $this->dispositivoDao->update($dispositivo);  
      $this->loggerDao->create( new Logger("Ha Habilitado al dispositivo: " . $dispositivo->getIdUnico() ) );

      return response( 'ok' , 200)->header('Content-Type', 'text/plain');
  }

  
  public function deshabilitar( Request $request ){ 
      
      $id = $request->get('id');

      $dispositivo = $this->dispositivoDao->findById($id);
      $dispositivo->setStatus(false);

      $motivoAltaBaja = new MotivoAltaBaja;
      $motivoAltaBaja->setContenido('Deshabilitado'); 
      $motivoAltaBaja->setTipo('');
      $motivoAltaBaja->setUsuario( Auth::user()->getUsuario() );  
      $dispositivo->addMotivoAltaBaja( $motivoAltaBaja );

      $this->dispositivoDao->update($dispositivo);

      $this->loggerDao->create( new Logger("Ha Deshabilitado al dispositivo: " . $dispositivo->getIdUnico() ) );

      return response( 'ok' , 200)->header('Content-Type', 'text/plain');
  }


  
}

