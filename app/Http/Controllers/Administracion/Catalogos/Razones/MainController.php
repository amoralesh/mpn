<?php

namespace App\Http\Controllers\Administracion\Catalogos\Razones;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */
use App\Entities\Razon;  
use App\Entities\Logger;

/* DAOS */
use App\Daos\RazonDao;
use App\Daos\TipoAlarmaDao;
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
  protected $razonDao;
  protected $tipoAlarmaDao;
  protected $loggerDao;

  public function __construct(
     RazonDao $RazonDao
    ,TipoAlarmaDao $TipoAlarmaDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth'); 
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:Razones',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Razones:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Razones:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Razones:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Razones:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:Razones',[ 'only' => ['listAll' ]] );
    //$this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
   
    /* ENTITIES DAO */
    $this->razonDao = $RazonDao;
    $this->tipoAlarmaDao = $TipoAlarmaDao;
    $this->loggerDao = $LoggerDao;
  }


  public function index()
  {
    return view('administracion.catalogos.razon.index');
  }      

  public function create()
  {
    $data['tipoAlarmaList'] = $this->tipoAlarmaDao->listAll();
    return view('administracion.catalogos.razon.create',$data);
  } 

  public function edit($id)
  {
    $razon = $this->razonDao->findById( $id );
    $data['razon'] = $razon;
    $data['tipoAlarmaList'] = $this->tipoAlarmaDao->listAll();
    return view('administracion.catalogos.razon.edit',$data);
  }

  public function store(Request $request)
  {
    $nombre       = $request->get('nombre');
    $tipoAlarma   = $request->get('tipoAlarma');

    $rules = array(
          'nombre'     => 'required|unique:App\Entities\Razon,etiqueta',    
          'tipoAlarma' => 'required'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/razones/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $razon = new Razon;
        $razon->setEtiqueta( $nombre );
        $tipAlarma =  $this->tipoAlarmaDao->findById( $tipoAlarma );
        $razon->setTipoAlarma( $tipAlarma);
        $this->razonDao->create($razon);
           
        $this->loggerDao->create( new Logger( "Ha creado la la razón: " . $nombre  ) );  
        return Redirect::to("/administracion/catalogo/razones")->with('mensaje','Creado correctamente!.');
    }
  }


  public function update(Request $request,$id)
  {
    $nombre      = $request->get('nombre');
    $tipoAlarma  = $request->get('tipoAlarma');

    $rules = array(
          'nombre'     => 'required|unique:App\Entities\Razon,etiqueta,'.$id,
          'tipoAlarma' => 'required'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/razones/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else 
    {
        $razon = $this->razonDao->findById( $id );
        $razon->setEtiqueta( $nombre );
        $tipAlarma =  $this->tipoAlarmaDao->findById( $tipoAlarma );
        $razon->setTipoAlarma( $tipAlarma );
        $this->razonDao->update( $razon );

        $this->loggerDao->create( new Logger( "Ha actualizado la razon: " . $nombre ) );
        return Redirect::to("/administracion/catalogo/razones")->with('mensaje','Actualizada correctamente!.');
    }
  }



  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
  ==========================================*/
  public function listAll() 
  {     
    $razones = $this->razonDao->listAll();
    $razonesArreglo = array();
    foreach ( $razones as $indice => $razon ){
        $razonArreglo = array(
            'id' => $razon->getId(),
            'etiqueta' => $razon->getEtiqueta(),
            'tipoAlarma' => $razon->getTipoAlarma()->getEtiqueta()
        );   
        $razonesArreglo[] = $razonArreglo;
    }
    return response( $razonesArreglo , 200)->header('Content-Type', 'application/json');
  }



}
