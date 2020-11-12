<?php

namespace App\Http\Controllers\Administracion\Catalogos\Reporta;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\Reporta;
use App\Entities\Logger;
/* DAOS */
use App\Daos\ReportaDao;
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
  protected $reportaDao;
  protected $loggerDao;

  public function __construct(
    ReportaDao $ReportaDao
    ,LoggerDao $LoggerDao)
  { 
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:Reporta',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Reporta:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Reporta:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Reporta:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Reporta:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:Reporta',[ 'only' => ['listAll' ]] );
    //$this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->reportaDao = $ReportaDao;
    $this->loggerDao = $LoggerDao;  
  }

  public function index()
  {
    return view('administracion.catalogos.reporta.index');
  }

  public function create()
  {
    return view('administracion.catalogos.reporta.create');
  }

  public function edit($id)
  {
      $data['reporta']=$this->reportaDao->findById($id);
      return view('administracion.catalogos.reporta.edit',$data);
  }


  public function store(Request $request)
  {
    $nombre  = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\Reporta,etiqueta'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/reporta/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $reporta = new Reporta;
        $reporta->setEtiqueta( $nombre );
        $this->reportaDao->create( $reporta );

        $this->loggerDao->create( new Logger( "Ha creado la reporta: " . $nombre ) );  
        return Redirect::to("/administracion/catalogo/reporta")->with('mensaje','Creado correctamente!.');
    }
  }


  public function update(Request $request,$id)
  {
    $nombre = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\Reporta,etiqueta,'.$id
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/reporta/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $reporta = $this->reportaDao->findById( $id );
        $reporta->setEtiqueta( $nombre );
        $this->reportaDao->update( $reporta );
        $this->loggerDao->create( new Logger( "Ha actualizado reporta: " . $nombre ) );  
        return Redirect::to("/administracion/catalogo/reporta")->with('mensaje','Actualizada correctamente!.');
    }
  }

   
  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {     
      $reportadores = $this->reportaDao->listAll();
      $reportadoresArreglo = array();
      foreach ( $reportadores as $indice => $reporta ){
          $reportaArreglo = array(
              'id' => $reporta->getId(),
              'etiqueta' => $reporta->getEtiqueta()
          );
          $reportadoresArreglo[] = $reportaArreglo;
      } 
      return response( $reportadoresArreglo , 200)->header('Content-Type', 'application/json');
    }
  

}
