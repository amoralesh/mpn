<?php

namespace App\Http\Controllers\Administracion\Catalogos\Delegacion;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\Delegacion;
use App\Entities\Logger;
/* DAOS */
use App\Daos\DelegacionDao;
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
  protected $delegacionDao; 
  protected $loggerDao; 

  public function __construct(
    DelegacionDao $DelegacionDao
    ,LoggerDao $LoggerDao)
  {  
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:Delegaciones',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Delegaciones:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Delegaciones:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Delegaciones:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Delegaciones:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:Delegaciones',[ 'only' => ['listAll' ]] );
 
    $this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
   
    /* ENTITIES DAO */
    $this->delegacionDao = $DelegacionDao;
    $this->loggerDao = $LoggerDao;
  }

  public function index()
  {
    return view('administracion.catalogos.delegaciones.index');
  }
  
  public function create()
  {
    return view('administracion.catalogos.delegaciones.create');
  }

  public function edit($id)
  {
      $data['delegacion']=$this->delegacionDao->findById($id);
      return view('administracion.catalogos.delegaciones.edit',$data);
  }


  public function store(Request $request)
  {
      
    $nombre  = $request->get('nombre');
    $rules = array(
        'nombre' => 'required|unique:App\Entities\Delegacion,etiqueta'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/delegaciones/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    } 
    else  
    {
        $delegacion = new Delegacion;
        $delegacion->setEtiqueta( $nombre );  
        $this->delegacionDao->create( $delegacion );

        $this->loggerDao->create( new Logger("Ha creado la Delegación: " . $nombre) );   
        return Redirect::to("/administracion/catalogo/delegaciones")->with('mensaje','Creado correctamente!.');
    }
  }

  
  public function update(Request $request,$id)
  {

    $nombre          = $request->get('nombre');
    $rules = array(
          'nombre'   => 'required|unique:App\Entities\Delegacion,etiqueta,'.$id
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/delegaciones/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $delegacion = $this->delegacionDao->findById( $id );
        $delegacion->setEtiqueta( $nombre );
        $this->delegacionDao->update( $delegacion );

        $this->loggerDao->create( new Logger("Ha actualizado la Delegación: " . $nombre) );     
        return Redirect::to("/administracion/catalogo/delegaciones")->with('mensaje','Actualizada correctamente!.');
    }
  }

     
  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
  public function listAll()
  {   
    $delegaciones = $this->delegacionDao->listAll(); 
    $delegacionesArray = array();
    foreach( $delegaciones as $indice => $delegacion ){
        $delegacionArray = array(
            'id' => $delegacion->getId(),
            'etiqueta' => $delegacion->getEtiqueta()
        );
        $delegacionesArray[] = $delegacionArray;
    } 
    return response( $delegacionesArray , 200)->header('Content-Type', 'application/json');
  }





}
