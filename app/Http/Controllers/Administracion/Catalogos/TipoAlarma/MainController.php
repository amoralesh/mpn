<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoAlarma;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
 
/* ENTITIES */
use App\Entities\TipoAlarma;
use App\Entities\Logger;

/* DAOS */
use App\Daos\TipoAlarmaDao;
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
  protected $tipoAlarmaDao;
  protected $loggerDao;

  public function __construct(
    TipoAlarmaDao $TipoAlarmaDao  
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoAlarma',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAlarma:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAlarma:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAlarma:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAlarma:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoAlarma',[ 'only' => ['listAll' ]] );
    //$this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    
    /* ENTITIES DAO */
    $this->tipoAlarmaDao = $TipoAlarmaDao;
    $this->loggerDao = $LoggerDao;
  }

  public function index()
  {
    return view('administracion.catalogos.tipoalarma.index');
  }

  public function create()
  {
    return view('administracion.catalogos.tipoalarma.create');
  }

  public function edit($id)
  {
      $data['motivo']=$this->tipoAlarmaDao->findById($id);
      return view('administracion.catalogos.tipoalarma.edit',$data);
  }

  public function store(Request $request)
  {   
    $nombre = $request->get('nombre');

    $rules = array(
        'nombre' => 'required|unique:App\Entities\TipoAlarma,etiqueta'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/tipoAlarmas/create")->with('errores','Woops algo esta mal.!')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoAlarma = new TipoAlarma;  
        $tipoAlarma->setEtiqueta( $nombre );
        $this->tipoAlarmaDao->create( $tipoAlarma );

        $this->loggerDao->create( new Logger("Ha creado el Motivo Alarma: " . $nombre) );   
        return Redirect::to("/administracion/catalogo/tipoAlarmas")->with('mensaje','Creado correctamente!.');
    }
  }



  public function update(Request $request,$id)
  {

    $nombre = $request->get('nombre');
    $rules = array( 
        'nombre' => 'required|unique:App\Entities\TipoAlarma,etiqueta,'.$id
    );

    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
  
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to( "/administracion/catalogo/tipoAlarmas/".$id."/edit" )->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoAla = $this->tipoAlarmaDao->findById( $id );
        $tipoAla->setEtiqueta( $nombre );
        $this->tipoAlarmaDao->update( $tipoAla );

        $this->loggerDao->create( new Logger("Ha actualizado la Motivo Alarma: " . $nombre ) );   
        return Redirect::to( "/administracion/catalogo/tipoAlarmas" )->with('mensaje','Actualizado correctamente!.');
    }
  }
  

    
  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
  public function listAll() 
  {      
    $tiposAlarma = $this->tipoAlarmaDao->listAll();
    $tiposAlarmaArreglo = array();
    foreach ( $tiposAlarma as $indice => $tipoAlarma ){
        $tipoAlarmaArreglo = array(
            'id' => $tipoAlarma->getId(),
            'etiqueta' => $tipoAlarma->getEtiqueta()
        );
        $tiposAlarmaArreglo[] = $tipoAlarmaArreglo;
    }
    return response( $tiposAlarmaArreglo , 200)->header('Content-Type', 'application/json');
  }


    

}
