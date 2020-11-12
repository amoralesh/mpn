<?php

namespace App\Http\Controllers\Administracion\Catalogos\Participacion;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
 
/* ENTITIES */
use App\Entities\Participacion;
use App\Entities\Logger;

/* DAOS */ 
use App\Daos\ParticipacionDao; 
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
  protected $participacionDao;
  protected $loggerDao;

  public function __construct(
     ParticipacionDao $ParticipacionDao
     ,LoggerDao $LoggerDao)
  {   
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:Participaciones',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Participaciones:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Participaciones:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Participaciones:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Participaciones:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:Participaciones',[ 'only' => ['listAll' ]] );
    //$this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );

    /* ENTITIES DAO */
    $this->participacionDao = $ParticipacionDao;
    $this->loggerDao = $LoggerDao;
  }  

  public function index()
  {
    return view('administracion.catalogos.participacion.index');
  } 

  public function create()
  {
    $data['participacionList'] = $this->participacionDao->listAll();
    return view('administracion.catalogos.participacion.create',$data);
  }

  public function edit($id)
  {
    $participacion = $this->participacionDao->findById( $id );
    $data['participacion'] = $participacion;
    return view('administracion.catalogos.participacion.edit',$data);
  }

  public function store(Request $request)
  {
    $nombre    = $request->get('nombre');
    $rules = array(
          'nombre'=> 'required',
    );
    $messages = array(
        'nombre' => 'required|unique:App\Entities\Participacion,etiqueta'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/participaciones/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $participacion = new Participacion;
        $participacion->setEtiqueta( $nombre );
        $this->participacionDao->create( $participacion );
        
        $this->loggerDao->create( new Logger( "Ha creado la participación: " . $nombre ) );  
        return Redirect::to("/administracion/catalogo/participaciones")->with('mensaje','Creado correctamente!.');
    }
  }


  public function update(Request $request,$id)
  {
    $nombre = $request->get('nombre');
    $rules = array(
        'nombre' => 'required|unique:App\Entities\Participacion,etiqueta,'.$id
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/participaciones/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $participacion = $this->participacionDao->findById( $id );
        $participacion->setEtiqueta( $nombre );
        $this->participacionDao->create( $participacion );
        $this->loggerDao->create( new Logger( "Ha actualizado la participación: " . $nombre ) );   
        return Redirect::to("/administracion/catalogo/participaciones")->with('mensaje','Actualizada correctamente!.');
    }
  }



    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {     
      $participaciones = $this->participacionDao->listAll();
      $participacionesArreglo = array();
      foreach ( $participaciones as $indice => $participacion ){
          $participacionArreglo = array(
              'id' => $participacion->getId(),
              'etiqueta' => $participacion->getEtiqueta()
          );
          $participacionesArreglo[] = $participacionArreglo;
      }
      return response( $participacionesArreglo , 200)->header('Content-Type', 'application/json');
    }

  

}
