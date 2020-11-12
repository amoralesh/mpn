<?php

namespace App\Http\Controllers\Administracion\Cadenas;
 
/* CONTROLADOR */ 
use App\Http\Controllers\Controller;

/* ENTITIES */  
use App\Entities\Cadena; 
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger; 


/* DAOS */
use App\Daos\AsociacionDao;
use App\Daos\MotivoAltaBajaDao;
use App\Daos\EncargadoDao;
use App\Daos\CadenaDao;
use App\Daos\NegocioDao; 
use App\Daos\LoggerDao;

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Predis\Connection\ConnectionException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use File;  
   
class MainController extends Controller
{
   
  /* ENTITIES DAO */ 
  protected $asociacionDao;
  protected $cadenaDao;
  protected $motivoAltaBajaDao;
  protected $encargadoDao;
  protected $negocioDao;
  protected $loggerDao;

  public function __construct(
     AsociacionDao $AsociacionDao
    ,MotivoAltaBajaDao $MotivoAltaBajaDao
    ,EncargadoDao $EncargadoDao
    ,CadenaDao $CadenaDao
    ,NegocioDao $NegocioDao
    ,LoggerDao $LoggerDao)  
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Cadenas'        , [ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Cadenas:Crear'        , [ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Cadenas:Editar'       , [ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Cadenas:Guardar'      , [ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Cadenas:Actualizar'   , [ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Cadenas:Habilitar'    , [ 'only' => ['habilitar' ]] );
    $this->middleware('hasPermission:Administracion:Cadenas:Deshabilitar' , [ 'only' => ['deshabilitar' ]] );
    
    $this->middleware('hasPermission:Administracion:Rest:Cadenas',[ 'only' => [ ' ' ] ]  );
  
    $this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );

    /* ENTITIES DAO */ 
    $this->asociacionDao = $AsociacionDao;
    $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
    $this->encargadoDao = $EncargadoDao;
    $this->cadenaDao = $CadenaDao;
    $this->negocioDao = $NegocioDao;
    $this->loggerDao = $LoggerDao;
  }  
 
  public function index()
  {    
    return view('administracion.cadenas.index');      
  }     
  
  public function create() 
  {
    $data['asociacionList'] = $this->asociacionDao->listAllEntity();          
    return view('administracion.cadenas.create',$data);  
  }  
   
  public function edit($id)
  {  
    $cadena = $this->cadenaDao->findById( $id );
 
    $data['cadena'] = $cadena;
    $data['asociacionList'] = $this->asociacionDao->listAllEntity();    

    $encargadosArreglo = array();    
    foreach( $cadena->getEncargados() as $indice => $encargado )
    { array_push($encargadosArreglo, $encargado->getId() ); } 
    $data['encargadosList'] = $encargadosArreglo;
     
    return view('administracion.cadenas.edit',$data);   
  }

 
  public function store(Request $request)
  {  
    $nombre          = $request->get('nombre');
    $alias           = $request->get('alias');
    $encargadosList  = $request->get('encargadosList');
    $asociacion      = $request->get('asociacion');

    $rules = array(
          'nombre'             => 'required|max:100|unique:App\Entities\Cadena,etiqueta',
          'alias'              => 'required|max:250',
          'encargadosList'     => 'required', 
          'asociacion'         => 'required'
    );  
  
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique' => 'La plaza ya esta registrada'
    );     

    $validation = Validator::make($request->all(), $rules, $messages);

    if ($validation->fails())
    {
      return Redirect::to("/administracion/cadenas/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {   
        $cadena = new Cadena;
        $cadena->setEtiqueta( $nombre );
        $cadena->setAlias( $alias ); 

        $encargadosArray = explode(',', $encargadosList);
        $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);
        $cadena->setEncargados( $encargadosListE );

        $asociacionE = $this->asociacionDao->findById( $asociacion );
        $cadena->setAsociacion($asociacionE);
        
        $this->cadenaDao->create( $cadena );

        $this->loggerDao->create( new Logger("Ha creado la Cadena: " . $nombre) );
        return Redirect::to("/administracion/cadenas")->with('mensaje','Creado correctamente!.');
    }   
  }  
 

  public function update(Request $request,$id)
  {
    $nombre          = $request->get('nombre');
    $alias           = $request->get('alias');
    $encargadosList  = $request->get('encargadosList');
    $asociacion      = $request->get('asociacion');

    $rules = array(
          'nombre'             => 'required|max:100|unique:App\Entities\Cadena,etiqueta,'.$id,
          'alias'              => 'required|max:250',
          'encargadosList'     => 'required', 
          'asociacion'         => 'required'
    );  
  
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique' => 'La plaza ya esta registrada'
    );     

    $validation = Validator::make($request->all(), $rules, $messages);

    if ($validation->fails())
    {
      return Redirect::to("/administracion/cadenas/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {   
        $cadena = $this->cadenaDao->findById( $id );

        $cadena->setEtiqueta( $nombre );
        $cadena->setAlias( $alias ); 
        
        $encargadosArray = explode(',', $encargadosList);
        $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);

        $cadena->setEncargados( $encargadosListE );
        $asociacionE = $this->asociacionDao->findById( $asociacion );
        
        $cadena->setAsociacion($asociacionE);
        $this->cadenaDao->update( $cadena );

        $this->loggerDao->create( new Logger("Ha actualizado la cadena: " . $nombre." con el ID: ".$cadena->getId()) );
        return Redirect::to("/administracion/cadenas")->with('mensaje','Actualizado correctamente!.');
    }   
  }

 

  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
  ==========================================*/
  public function cadenas(Request $request) 
  {  
    $firstResult = $request->get('start');
    $maxResult   = $request->get('length');
    $draw        = $request->get('draw');
    $buscar      = $request->get('search')['value'];
    $data = $this->cadenaDao->listAllJson($draw,  $maxResult , $firstResult , $buscar );

    return response( $data , 200)->header('Content-Type', 'application/json');
  }    


  /**  VALIDADO */
  public function findById( $id )  
  {
      $cadena = $this->cadenaDao->findById( $id );
 
      $motivoAltaBajaArreglo = array();
      foreach( $cadena->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
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
        "id" => $cadena->getId(),
        "etiqueta" => $cadena->getEtiqueta(),  
        "alias" => $cadena->getAlias(),
        "fechaAlta" => $cadena->getFechaAlta(), 
        "status" => $cadena->getStatus() ? "Activo" : "No activo", 
        "motivosAltaBaja" => $motivoAltaBajaArreglo
      );
 
      return response( $arreglo , 200)->header('Content-Type', 'application/json');
  }

  /**  VALIDADO */
  public function cadenasAsociacion($id)
  {   
    $cadenas = $this->cadenaDao->findByIdAsociacion($id);       
         
    $cadenasArreglo = array(); 
    foreach( $cadenas as $indice => $cadena ){

        $arreglo = array(       
          "id" => $cadena->getId(),
          "etiqueta" => $cadena->getEtiqueta(),   
          "alias" => $cadena->getAlias(), 
          "numeroNegocios" => count( $cadena->getNegocios() ),
          "encargados" => count( $cadena->getEncargados() ) , 
          "fechaAlta" => $cadena->getFechaAlta(), 
          "status" => $cadena->getStatus() ? "Activo" : "No activo" 
        ); 
        $cadenasArreglo[] = $arreglo;
    }
    return response( $cadenasArreglo , 200)->header('Content-Type', 'application/json');
  }        

  
  /**  VALIDADO */ 
  public function cadenasEstablecimiento($id)
  {   
    $cadenas = $this->cadenaDao->findByIdEstablecimiento($id);       
     
    $cadenasArreglo = array(); 
    foreach( $cadenas as $indice => $cadena ){

        $arreglo = array(       
          "id" => $cadena->getId(),
          "etiqueta" => $cadena->getEtiqueta(),   
          "alias" => $cadena->getAlias(), 
          "asociacion" => $cadena->getAsociacion()->getEtiqueta(),
          "numeroNegocios" => count( $cadena->getNegocios() ),
          "numeroEncargados" => count( $cadena->getEncargados() ) ,  
          "fechaAlta" => $cadena->getFechaAlta(),  
          "status" => $cadena->getStatus() ? "Activo" : "No activo" 
        ); 
        $cadenasArreglo[] = $arreglo;
    }
    return response( $cadenasArreglo , 200)->header('Content-Type', 'application/json');
  }        


  /**  VALIDADO */ 
  public function cadenasEncargado($id)
  {   
    $cadenas = $this->cadenaDao->findByIdEncargado($id);       
     
    $cadenasArreglo = array(); 
    foreach( $cadenas as $indice => $cadena ){

        $arreglo = array(       
          "id" => $cadena->getId(),
          "etiqueta" => $cadena->getEtiqueta(),   
          "alias" => $cadena->getAlias(), 
          "asociacion" => $cadena->getAsociacion()->getEtiqueta(),
          "numeroNegocios" => count( $cadena->getNegocios() ),
          "numeroEncargados" => count( $cadena->getEncargados() ) ,  
          "fechaAlta" => $cadena->getFechaAlta(),  
          "status" => $cadena->getStatus() ? "Activo" : "No activo" 
        ); 
        $cadenasArreglo[] = $arreglo;
    }
    return response( $cadenasArreglo , 200)->header('Content-Type', 'application/json');
  }        



  /**  VALIDADO */
  public function deshabilitar(Request $request)
  {  
    $id              = $request->get('id');  
    $motivoAltaBaja  = $request->get('motivoAltaBaja');

    $cadena = $this->cadenaDao->findById($id);

    $cadena->setStatus(false);

    $cadenaArray = array();
    $cadenaArray[] = $cadena;

    $motivoAltaBajaE = new MotivoAltaBaja;
    $motivoAltaBajaE->setContenido( $motivoAltaBaja );
    $motivoAltaBajaE->setCadenas( $cadenaArray );
    $motivoAltaBajaE->setTipo( "Deshabilitado" );
    $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  


    $motivoAltaBajaEs = array();
    $motivoAltaBajaEs[] = $motivoAltaBajaE;

    $cadena->addMotivoAltaBaja($motivoAltaBajaE);
   
    $this->cadenaDao->update( $cadena ); 
            
    $this->loggerDao->create( new Logger( "Ha Deshabilitado la cadena: " . $cadena->getEtiqueta()  ) );
    return response( 200 , 200)->header('Content-Type', 'application/json');

  }

  /**  VALIDADO */
  public function habilitar(Request $request)
  {  
      $id              = $request->get('id');
      $motivoAltaBaja  = $request->get('motivoAltaBaja');

      $cadena = $this->cadenaDao->findById($id);

      $cadena->setStatus(true);

      $cadenaArray = array();
      $cadenaArray[] = $cadena;
      
      $motivoAltaBajaE = new MotivoAltaBaja;
      $motivoAltaBajaE->setContenido( $motivoAltaBaja );
      $motivoAltaBajaE->setCadenas( $cadenaArray );  
      $motivoAltaBajaE->setTipo( "Habilitado" );
      $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  
      $cadena->addMotivoAltaBaja($motivoAltaBajaE);
      $this->cadenaDao->update( $cadena );
      
      $this->loggerDao->create( new Logger( "Ha Habilitado la cadena: " . $cadena->getEtiqueta() ) );
      return response( 200 , 200)->header('Content-Type', 'application/json');

  }





}

