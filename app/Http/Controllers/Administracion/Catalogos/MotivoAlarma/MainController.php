<?php

namespace App\Http\Controllers\Administracion\Catalogos\MotivoAlarma;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\MotivoAlarma; 
use App\Entities\Logger;
/* DAOS */
use App\Daos\MotivoAlarmaDao;
use App\Daos\LoggerDao;  
/* EVENTOS SOCKET */

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request;
use File;  

class MainController extends Controller
{
  
  /* ENTITIES DAO */
  protected $motivoAlarmaDao;
  protected $loggerDao;

  public function __construct( 
    MotivoAlarmaDao $MotivoAlarmaDao
    ,LoggerDao $LoggerDao) 
  {
    $this->middleware('auth');
    
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:MotivoAlarma',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:MotivoAlarma:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:MotivoAlarma:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:MotivoAlarma:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:MotivoAlarma:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:MotivoAlarma',[ 'only' => ['listAll' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
   
    /* ENTITIES DAO */ 
    $this->motivoAlarmaDao = $MotivoAlarmaDao;
    $this->loggerDao = $LoggerDao;
  }


  public function index()
  {  
    return view('administracion.catalogos.motivoalarma.index');
  }
 
  public function create()
  {
    return view('administracion.catalogos.motivoalarma.create');
  }

  public function edit($id)
  {
      $data['motivo']=$this->motivoAlarmaDao->findById($id);
      return view('administracion.catalogos.motivoalarma.edit',$data);
  }


  public function store(Request $request)
  {
    $nombre = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\MotivoAlarma,etiqueta'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/motivoAlarmas/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $motivo = new MotivoAlarma;
        $motivo->setEtiqueta( $nombre );
        $this->motivoAlarmaDao->create( $motivo );
        $this->loggerDao->create( new Logger("Ha creado el Motivo Alarma: " . $nombre) );   
        return Redirect::to("/administracion/catalogo/motivoAlarmas")->with('mensaje','Creado correctamente!.');
    }
  }




  public function update(Request $request,$id)
  {
    $nombre = $request->get('nombre');
    $rules = array(
        'nombre' => 'required|unique:App\Entities\MotivoAlarma,etiqueta,'.$id
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to( "/administracion/catalogo/motivoAlarmas/".$id ."/edit" )->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $motivo = $this->motivoAlarmaDao->findById( $id );
        $motivo->setEtiqueta( $nombre );
        $this->motivoAlarmaDao->update( $motivo );
        $this->loggerDao->create( new Logger("Ha actualizado la Motivo Alarma: " . $nombre ) );   
        return Redirect::to( "/administracion/catalogo/motivoAlarmas" )->with('mensaje','Actualizado correctamente!.');
    }
  }


  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
  ==========================================*/
  public function listAll()
  {
    $motivoAlarmas = $this->motivoAlarmaDao->listAll();  
    $motivoAlarmasArray = array();
    foreach( $motivoAlarmas as $indice => $motivoAlarma ){
        $motivoAlarmaArray = array(
            'id' => $motivoAlarma->getId(),
            'etiqueta' => $motivoAlarma->getEtiqueta()
        );
        $motivoAlarmasArray[] = $motivoAlarmaArray;  
    }   
    return response( $motivoAlarmasArray , 200)->header('Content-Type', 'application/json');
  }

  
}
