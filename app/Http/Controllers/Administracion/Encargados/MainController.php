<?php

namespace App\Http\Controllers\Administracion\Encargados;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\Encargado;
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger;
  
/* DAOS */
use App\Daos\EncargadoDao;
use App\Daos\MotivoAltaBajaDao;
use App\Daos\TipoEncargadoDao;
use App\Daos\LoggerDao;

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request;
use File;
   
class MainController extends Controller 
{

  /* ENTITIES DAO */
  protected $encargadoDao; 
  protected $motivoAltaBajaDao;
  protected $tipoEncargadoDao;
  protected $loggerDao;


  public function __construct(EncargadoDao $EncargadoDao
    ,MotivoAltaBajaDao $MotivoAltaBajaDao
    ,LoggerDao $LoggerDao
    ,TipoEncargadoDao $tipoEncargadoDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Encargado',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Encargado:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Encargado:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Encargado:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Encargado:Actualizar',[ 'only' => ['update' ]] );

    $this->middleware('hasPermission:Administracion:Encargado:Habilitar',[ 'only' => ['habilitar' ]] );
    $this->middleware('hasPermission:Administracion:Encargado:Deshabilitar',[ 'only' => ['deshabilitar' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Encargado',[ 'only' => ['listAll' ]] ); 

    $this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
 
    /* ENTITIES DAO */ 
    $this->encargadoDao = $EncargadoDao;
    $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
    $this->tipoEncargadoDao = $tipoEncargadoDao;
    $this->loggerDao = $LoggerDao;
  }  


  public function index()
  {     
    return view('administracion.encargados.index');  
  }

  public function create()
  {
    $data['tipoEncargadoList'] = $this->tipoEncargadoDao->listAll();
    return view('administracion.encargados.create',$data);  
  }

  public function edit($id)
  {  
    $data['tipoEncargadoList'] = $this->tipoEncargadoDao->listAll();
    $encargado = $this->encargadoDao->findById( $id );
    $data['encargado'] = $encargado;
    return view('administracion.encargados.edit',$data);  
  }
 

  public function store(Request $request)
  {
    
    $nombre          = $request->get('nombre');
    $apellidoPaterno = $request->get('apellidoPaterno');
    $apellidoMaterno = $request->get('apellidoMaterno');
    $correo          = $request->get('correo');
    $telefonoCelular = $request->get('telefonoCelular');
    $telefono        = $request->get('telefono');
    $extension       = $request->get('extension');
    $tipoEncargado   = $request->get('tipoEncargado');
    //creamos un array con las reglas que deben cumplir nuestro formulario
    $rules = array(
          'nombre'            => 'required|max:100',
          'apellidoPaterno'   => 'required|max:100',
          'apellidoMaterno'   => 'required|max:100', 
          'correo'            => 'required|email|unique:App\Entities\Encargado,correo',
          'telefonoCelular'   => 'required_without_all:telefono',
          'telefono'          => 'required_without_all:telefonoCelular',
          'tipoEncargado'     => 'required'
    );  

    $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'min'      => 'El campo :attribute no puede tener menos de :min carácteres.',
        'max'      => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique'   => 'El contenido en :attribute, ya existe en la base de datos'
    );  

    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/encargados/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {  
        $encargado = new Encargado;
        $encargado->setNombre( $nombre );
        $encargado->setApellidoPaterno( $apellidoPaterno );
        $encargado->setApellidoMaterno( $apellidoMaterno );
        $encargado->setCorreo( $correo );
        $encargado->setCelular( $telefonoCelular );
        $encargado->setTelefono( $telefono );
        $encargado->setExtension( $extension );
        $tipoEncargadoE = $this->tipoEncargadoDao->findById($tipoEncargado );
        $encargado->setTipoEncargado($tipoEncargadoE);
        $this->encargadoDao->create( $encargado );

        $this->loggerDao->create( new Logger("Ha creado al Encargado: " . $nombre." correo: ".$correo) );
        return Redirect::to("/administracion/encargados")->with('mensaje','Creado correctamente!.');
    } 
  }



  public function update(Request $request,$id)
  {
    $nombre          = $request->get('nombre');
    $apellidoPaterno = $request->get('apellidoPaterno');
    $apellidoMaterno = $request->get('apellidoMaterno');
    $correo          = $request->get('correo');
    $telefonoCelular = $request->get('telefonoCelular');
    $telefono        = $request->get('telefono');
    $extension       = $request->get('extension');
    $tipoEncargado   = $request->get('tipoEncargado');
    
    //creamos un array con las reglas que deben cumplir nuestro formulario
    $rules = array(
          'nombre'            => 'required|max:100',
          'apellidoPaterno'   => 'required|max:100',
          'apellidoMaterno'   => 'required|max:100', 
          //'correo'            => 'required|email|unique:App\Entities\Encargado,correo,'.$id
    );  
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
        'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique' => 'El contenido en :attribute, ya existe en la base de datos'
    );  
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {  
        return Redirect::to("/administracion/encargados/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $encargado = $this->encargadoDao->findById( $id );
        $encargado->setNombre( $nombre );
        $encargado->setApellidoPaterno( $apellidoPaterno );
        $encargado->setApellidoMaterno( $apellidoMaterno );
        $encargado->setCorreo( $correo );
        $encargado->setCelular( $telefonoCelular );
        $encargado->setTelefono( $telefono );
        $encargado->setExtension( $extension );
        $tipoEncargadoE = $this->tipoEncargadoDao->findById($tipoEncargado );
        $encargado->setTipoEncargado($tipoEncargadoE);
        $this->encargadoDao->update( $encargado );
        
        $this->loggerDao->create( new Logger("Ha actualizado al Encargado: " . $nombre." correo: ".$correo." con el ID: ".$encargado->getId()) );
        return Redirect::to("/administracion/encargados")->with('mensaje','Creado correctamente!.');
    } 
  }
 
   
    /* SERVICIOS REST ENCARGADOS 
    =====================================*/
    public function listAll(Request $request){ 
      $firstResult = $request->get('start');
      $maxResult   = $request->get('length');
      $draw        = $request->get('draw');
      $buscar      = $request->get('search')['value'];
      $data = $this->encargadoDao->obtenerEncargados($draw,  $maxResult , $firstResult , $buscar );
        
      return response( $data , 200)->header('Content-Type', 'application/json');
    }      
    

    /**  VALIDADO */ 
    public function findById( $id )
    {     
      $encargado = $this->encargadoDao->findById($id);

      $motivoAltaBajaArreglo = array();   
      foreach( $encargado->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
          $arreglo = array( 
            "id" => $motivoAltaBaja->getId(),
            "contenido" => $motivoAltaBaja->getContenido(),   
            "tipo" => $motivoAltaBaja->getTipo(), 
            "usuario" => $motivoAltaBaja->getUsuario(),    
            "fechaAlta" => $motivoAltaBaja->getFechaAlta()
          );
          $motivoAltaBajaArreglo[] = $arreglo;
      }   

      $arreglo = array(
        "id" => $encargado->getId(),
        "nombre" => $encargado->getNombre(),   
        "apellidoPaterno" => $encargado->getApellidoPaterno(),  
        "apellidoMaterno" => $encargado->getApellidoMaterno(), 
        "correo" => $encargado->getCorreo(), 
        "celular" => $encargado->getCelular(), 
        "telefono" => $encargado->getTelefono(), 
        "extension" => $encargado->getExtension(), 
        "tipoEncargado" => $encargado->getTipoEncargado()->getEtiqueta(),
        "fechaAlta" => $encargado->getFechaAlta(), 
        "status" => $encargado->getStatus() ? "Activo" : "No activo" ,
        "motivosAltaBaja" => $motivoAltaBajaArreglo 
      ); 
      return response( $arreglo , 200)->header('Content-Type', 'application/json');
    }    
    
     /**  ENCARGADOS ASOCIACIONES */   
     public function encargadosAsociacion($id)
     {    
       $encargados = $this->encargadoDao->findByIdAsociacion($id);  
       $encargadoArreglo = array();
       foreach( $encargados as $indice => $encargado ){
           $arreglo = array(
             "id" => $encargado->getId(),
             "nombre" => $encargado->getNombre(),   
             "apellidoPaterno" => $encargado->getApellidoPaterno(), 
             "apellidoMaterno" => $encargado->getApellidoMaterno(), 
             "telefono" => $encargado->getTelefono(), 
             "extension" => $encargado->getExtension(), 
             "celular" => $encargado->getCelular(), 
             "correo" => $encargado->getCorreo(), 
             "asociaciones" => count( $encargado->getAsociaciones() ), 
             "cadenas" => count( $encargado->getCadenas() ), 
             "negocios" => count( $encargado->getNegocios() ), 
             "plazas" => count( $encargado->getPlazas() ), 
             "tipoEncargado" => $encargado->getTipoEncargado()->getEtiqueta(), 
             "fechaAlta" => $encargado->getFechaAlta(), 
             "status" => $encargado->getStatus() ? "Activo" : "No activo" 
           ); 
           $encargadoArreglo[] = $arreglo;
       } 
       return response( $encargadoArreglo , 200)->header('Content-Type', 'application/json');
     }

    /**  VALIDADO */   
    public function encargadosCadena($id)
    {    
      $encargados = $this->encargadoDao->findByIdCadena($id);  
      $encargadoArreglo = array();
      foreach( $encargados as $indice => $encargado ){
          $arreglo = array(
            "id" => $encargado->getId(),
            "nombre" => $encargado->getNombre(),   
            "apellidoPaterno" => $encargado->getApellidoPaterno(), 
            "apellidoMaterno" => $encargado->getApellidoMaterno(), 
            "telefono" => $encargado->getTelefono(), 
            "extension" => $encargado->getExtension(), 
            "celular" => $encargado->getCelular(), 
            "correo" => $encargado->getCorreo(), 
            "asociaciones" => count( $encargado->getAsociaciones() ), 
            "cadenas" => count( $encargado->getCadenas() ), 
            "negocios" => count( $encargado->getNegocios() ), 
            "plazas" => count( $encargado->getPlazas() ), 
            "tipoEncargado" => $encargado->getTipoEncargado()->getEtiqueta(), 
            "fechaAlta" => $encargado->getFechaAlta(), 
            "status" => $encargado->getStatus() ? "Activo" : "No activo" 
          ); 
          $encargadoArreglo[] = $arreglo;
      } 
      return response( $encargadoArreglo , 200)->header('Content-Type', 'application/json');
    }      

    /**  VALIDADO */
    public function encargadosPlaza($id)
    {    
      $encargados = $this->encargadoDao->findByIdPlaza($id);    
      $encargadoArreglo = array();
      foreach( $encargados as $indice => $encargado ){
          $arreglo = array(
            "id" => $encargado->getId(),
            "nombre" => $encargado->getNombre(),   
            "apellidoPaterno" => $encargado->getApellidoPaterno(), 
            "apellidoMaterno" => $encargado->getApellidoMaterno(), 
            "telefono" => $encargado->getTelefono(), 
            "extension" => $encargado->getExtension(), 
            "celular" => $encargado->getCelular(), 
            "correo" => $encargado->getCorreo(), 
            "asociaciones" => count( $encargado->getAsociaciones() ), 
            "cadenas" => count( $encargado->getCadenas() ), 
            "negocios" => count( $encargado->getNegocios() ), 
            "plazas" => count( $encargado->getPlazas() ), 
            "tipoEncargado" => $encargado->getTipoEncargado()->getEtiqueta(), 
            "fechaAlta" => $encargado->getFechaAlta(), 
            "status" => $encargado->getStatus() ? "Activo" : "No activo" 
          ); 
          $encargadoArreglo[] = $arreglo;
      } 
      return response( $encargadoArreglo , 200)->header('Content-Type', 'application/json');
    }

    

    /**  VALIDADO */  
    public function deshabilitar(Request $request)
    {    
        $id              = $request->get('id');
        $motivoAltaBaja  = $request->get('motivoAltaBaja');
        $encargado = $this->encargadoDao->findById($id);
        $encargado->setStatus(false);
        $encargadoArray = array();
        $encargadoArray[] = $encargado;
        $motivoAltaBajaE = new MotivoAltaBaja;
        $motivoAltaBajaE->setContenido( $motivoAltaBaja );
        $motivoAltaBajaE->setEncargados( $encargadoArray );
        $motivoAltaBajaE->setTipo( "Deshabilitado" );
        $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  
        $encargado->addMotivoAltaBaja($motivoAltaBajaE);
        $this->encargadoDao->update( $encargado );
        $this->loggerDao->create( new Logger( "Ha Deshabilitado al encargado: " . $encargado->getCorreo()  ) );
        return response( 200 , 200)->header('Content-Type', 'application/json');
    }

    /**  VALIDADO */  
    public function habilitar(Request $request)
    {  
        $id              = $request->get('id');
        $motivoAltaBaja  = $request->get('motivoAltaBaja');
        $encargado = $this->encargadoDao->findById($id);
        $encargado->setStatus(true);
        $encargadoArray = array();
        $encargadoArray[] = $encargado;
        $motivoAltaBajaE = new MotivoAltaBaja;
        $motivoAltaBajaE->setContenido( $motivoAltaBaja );
        $motivoAltaBajaE->setEncargados( $encargadoArray );  
        $motivoAltaBajaE->setTipo( "Habilitado" );
        $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  
        $encargado->addMotivoAltaBaja($motivoAltaBajaE);
        //$this->motivoAltaBajaDao->create( $motivoAltaBajaE );
        $this->encargadoDao->update( $encargado );
        $this->loggerDao->create( new Logger( "Ha Habilitado al encargado: " . $encargado->getCorreo()  ) );
        return response( 200 , 200)->header('Content-Type', 'application/json');
    }


}

