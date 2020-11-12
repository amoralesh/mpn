<?php

namespace App\Http\Controllers\Administracion\Asociaciones;

/* CONTROLADOR */
use App\Http\Controllers\Controller; 
 
/* ENTITIES */  
use App\Entities\Asociacion;
use App\Entities\MotivoAltaBaja; 
use App\Entities\Logger; 
    
/* DAOS */
use App\Daos\AsociacionDao;
use App\Daos\CadenaDao;
use App\Daos\MotivoAltaBajaDao;
use App\Daos\EncargadoDao;
use App\Daos\LoggerDao;
 
/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Predis\Connection\ConnectionException;
use File;  
use Session;

class MainController extends Controller
{
     
  /* ENTITIES DAO */ 
  protected $asociacionDao;
  protected $motivoAltaBajaDao; 
  protected $encargadoDao;
  protected $loggerDao;
  protected $cadenaDao;

  public function __construct(
     AsociacionDao $AsociacionDao
    ,MotivoAltaBajaDao $MotivoAltaBajaDao 
    ,EncargadoDao $EncargadoDao
    ,CadenaDao $CadenaDao
    ,LoggerDao $LoggerDao)   
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Asociaciones',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Asociaciones:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Asociaciones:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Asociaciones:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Asociaciones:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Asociaciones:Habilitar',[ 'only' => ['habilitar' ]] );
    $this->middleware('hasPermission:Administracion:Asociaciones:Deshabilitar',[ 'only' => ['deshabilitar' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Asociaciones',[ 'only' => ['listAll','obtenerAsociacionesRango' ]] );
    $this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
 

    /* ENTITIES DAO */ 
    $this->asociacionDao = $AsociacionDao;
    $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
    $this->encargadoDao = $EncargadoDao;
    $this->cadenaDao = $CadenaDao;
    $this->loggerDao = $LoggerDao;
  }  
 

  public function index()
  {  
    return view('administracion.asociaciones.index');  
  }     
  
  public function create()
  { 
    return view('administracion.asociaciones.create'); 
  }  

  
  public function edit($id)
  {   
    $asociacion = $this->asociacionDao->findById( $id ); 
    $data['asociacion'] = $asociacion;
     
    $encargadosArreglo = array();
    foreach( $asociacion->getEncargados() as $indice => $encargado )
    { array_push($encargadosArreglo, $encargado->getId() ); }    
    $data['encargadosList'] = $encargadosArreglo;
    
    return view('administracion.asociaciones.edit',$data);   
  }



  public function store(Request $request)
  {
    $nombre         = $request->get('nombre');
    $alias          = $request->get('alias');
    $encargadosList = $request->get('encargadosList');
    $rules = array(
          'nombre'             => 'required|max:250|unique:App\Entities\Asociacion,etiqueta',
          'alias'              => 'required|max:250',
          'encargadosList'     => 'required'
    );  
    $messages = array( 
        'required' => 'El campo :attribute es obligatorio.',
        'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique' => 'La asociación ya esta registrada'
    );     

    $validation = Validator::make($request->all(), $rules, $messages);
    
    if ($validation->fails())  
    {
      return Redirect::to("/administracion/asociaciones/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {   
        $asociacion = new Asociacion;
        $asociacion->setEtiqueta( $nombre );
        $asociacion->setAlias( $alias ); 
        
        $encargadosArray = explode(',', $encargadosList);  
        $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);

        $asociacion->setEncargados( $encargadosListE );
        $this->asociacionDao->create( $asociacion );

        $this->loggerDao->create( new Logger("Ha creado la Asociación: " . $nombre) );
        return Redirect::to("/administracion/asociaciones")->with('mensaje','Creado correctamente!.');
    }   
  }  
  


  public function update(Request $request,$id)
  {
    $nombre          = $request->get('nombre');
    $alias           = $request->get('alias');
    $encargadosList  = $request->get('encargadosList');
    $rules = array(
          'nombre'             => 'required|max:250|unique:App\Entities\Asociacion,etiqueta,'.$id,
          'alias'              => 'required|max:250',  
          'encargadosList'     => 'required'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique' => 'La asociación ya esta registrada'
    );
    $validation = Validator::make($request->all(), $rules, $messages);

    if ($validation->fails())
    {
      return Redirect::to("/administracion/asociaciones/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {   
        $asociacion = $this->asociacionDao->findById( $id );

        $asociacion->setEtiqueta( $nombre );
        $asociacion->setAlias( $alias ); 
        $encargadosArray = explode(',', $encargadosList);
        
        $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);   
        $asociacion->setEncargados( $encargadosListE );
        
        $this->asociacionDao->update( $asociacion );
   
        $this->loggerDao->create( new Logger("Ha actualizado la asociacion: " . $nombre." con el ID: ".$asociacion->getId()) );
        return Redirect::to("/administracion/asociaciones")->with('mensaje','Actualizado correctamente!.');
    }   
  }


  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
  ==========================================*/

  /**  VALIDADO */
  public function listAll(Request $request)
  {    

    $firstResult = $request->get('start'); 
    $maxResult   = $request->get('length');
    $draw        = $request->get('draw');      
    $buscar      = $request->get('search')['value'];
    
    $data = $this->asociacionDao->listAll( $draw,  $maxResult , $firstResult , $buscar );
    return response( $data , 200 )->header('Content-Type', 'application/json');
  }    
  
    /**  VALIDADO */
    public function listAllAsociacionesEscuelas(Request $request)
    {    
  
      $firstResult = $request->get('start'); 
      $maxResult   = $request->get('length');
      $draw        = $request->get('draw');      
      $buscar      = $request->get('search')['value'];
      
      $data = $this->asociacionDao->listAllAsociacionesEscuelas( $draw,  $maxResult , $firstResult , $buscar );
      return response( $data , 200 )->header('Content-Type', 'application/json');
    } 

    /**  VALIDADO */
    public function listAllAsociacionesMercados(Request $request)
    {    
  
      $firstResult = $request->get('start'); 
      $maxResult   = $request->get('length');
      $draw        = $request->get('draw');      
      $buscar      = $request->get('search')['value'];
      
      $data = $this->asociacionDao->listAllAsociacionesMercados( $draw,  $maxResult , $firstResult , $buscar );
      return response( $data , 200 )->header('Content-Type', 'application/json');
    } 


  /**  VALIDADO */ 
  public function findById( $id )    
  {  
      $asociacion = $this->asociacionDao->findById( $id );
  
      $motivoAltaBajaArreglo = array();   
      foreach( $asociacion->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
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
        "id" => $asociacion->getId(),
        "etiqueta" => $asociacion->getEtiqueta(),  
        "alias" => $asociacion->getAlias(),
        "fechaAlta" => $asociacion->getFechaAlta(),
        "status" => $asociacion->getStatus() ? "Activo" : "No activo",
        "motivosAltaBaja" => $motivoAltaBajaArreglo
      );

      return response( $arreglo , 200)->header('Content-Type', 'application/json');
  }
  

  /** VALIDADO */
  public function asociacionesEstablecimiento( $id )
  {
      $asociaciones = $this->asociacionDao->findByEstablecimientoId( $id );       
     
      $asociacionesArreglo = array(); 
      if( $asociaciones != null ){
        foreach( $asociaciones as $indice => $asociacion ){   
            $arreglo = array(
              "id" => $asociacion->getId(),
              "etiqueta" => $asociacion->getEtiqueta(),   
              "alias" => $asociacion->getAlias(),   
              "numeroEncargados" => count( $asociacion->getEncargados() ),   
              "numeroCadenas" =>  count(  $asociacion->getCadenas() ) , 
              "fechaAlta" => $asociacion->getFechaAlta(), 
              "status" => $asociacion->getStatus() ? "Activo" : "No activo"
            );
            $asociacionesArreglo[] = $arreglo; 
        }   
      }
      
      return response( $asociacionesArreglo , 200)->header('Content-Type', 'application/json');
  }
   

  /** VALIDADO */
  public function asociacionesEncargado( $id )
  {
      $asociaciones = $this->asociacionDao->findByEncargadoId( $id );     

      $asociacionesArreglo = array();
      foreach( $asociaciones as $indice => $asociacion ){   
          $arreglo = array(
            "id" => $asociacion->getId(),
            "etiqueta" => $asociacion->getEtiqueta(),   
            "alias" => $asociacion->getAlias(),   
            "encargados" => count( $asociacion->getEncargados() ),   
            "numeroCadenas" =>  count(  $asociacion->getCadenas() ) , 
            "fechaAlta" => $asociacion->getFechaAlta(), 
            "status" => $asociacion->getStatus() ? "Activo" : "No activo"
          );
          $asociacionesArreglo[] = $arreglo; 
      }
      return response( $asociacionesArreglo , 200)->header('Content-Type', 'application/json');
  }



  /** VALIDADO */
  public function asociacionesCadena( $id )
  {
      $asociacion = $this->asociacionDao->findByCadenaId( $id ); 

      $motivoAltaBajaArreglo = array();
      foreach( $asociacion->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
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
        "id" => $asociacion->getId(),
        "etiqueta" => $asociacion->getEtiqueta(),  
        "alias" => $asociacion->getAlias(),
        "fechaAlta" => $asociacion->getFechaAlta(),
        "status" => $asociacion->getStatus() ? "Activo" : "No activo",
        "motivosAltaBaja" => $motivoAltaBajaArreglo
      );

      return response( $arreglo , 200)->header('Content-Type', 'application/json');
  }



  /**  VALIDADO */
  public function habilitar(Request $request)
  {    
      $id              = $request->get('id');
      $motivoAltaBaja  = $request->get('motivoAltaBaja');

      $asociacion = $this->asociacionDao->findById($id);

      $asociacion->setStatus(true);

      $asociacionArray = array();
      $asociacionArray[] = $asociacion;
      
      $motivoAltaBajaE = new MotivoAltaBaja; 
      $motivoAltaBajaE->setContenido( $motivoAltaBaja );
      $motivoAltaBajaE->setAsociaciones( $asociacionArray );  
      $motivoAltaBajaE->setTipo( "Habilitado" );  
      $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  

      $asociacion->addMotivoAltaBaja( $motivoAltaBajaE );

      $this->asociacionDao->update( $asociacion );

      $this->loggerDao->create( new Logger( "Ha Habilitado la asociacion: " . $asociacion->getEtiqueta() ) );
      return response( 200 , 200)->header('Content-Type', 'application/json');
  }

  /**  VALIDADO */
  public function deshabilitar(Request $request)
  {  
      $request->merge(array_map('trim', $request->all() ));
      $id              = $request->get('id');  
      $motivoAltaBaja  = $request->get('motivoAltaBaja');  

      $asociacion = $this->asociacionDao->findById($id);

      $asociacion->setStatus(false);

      $asociacionArray = array();
      $asociacionArray[] = $asociacion;

      $motivoAltaBajaE = new MotivoAltaBaja;
      $motivoAltaBajaE->setContenido( $motivoAltaBaja );
      $motivoAltaBajaE->setAsociaciones( $asociacionArray );
      $motivoAltaBajaE->setTipo( "Deshabilitado" );
      $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  

      $asociacion->addMotivoAltaBaja($motivoAltaBajaE);
    
      $this->asociacionDao->update( $asociacion );

      $this->loggerDao->create( new Logger( "Ha deshabilitado la asociacion: " . $asociacion->getEtiqueta()  ) );
      return response( 200 , 200)->header('Content-Type', 'application/json');
  }
 


  public function obtenerAsociacionesRango($fechaInicio, $fechaFin)
  {
      $json = $this->asociacionDao->listAllRangoJson($fechaInicio, $fechaFin);
      echo json_encode($json);
  }


}

