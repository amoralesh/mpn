<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoGiroGeneral;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\GiroNegocioGeneral;
use App\Entities\Logger;
/* DAOS */
use App\Daos\GiroNegocioGeneralDao;
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
  protected $giroNegocioGeneralDao;
  protected $loggerDao;


  public function __construct(
    GiroNegocioGeneralDao $GiroNegocioGeneralDao
    ,LoggerDao $LoggerDao)
  { 
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoGiroGeneral',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiroGeneral:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiroGeneral:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiroGeneral:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiroGeneral:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoGiroGeneral',[ 'only' => ['listAll' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->giroNegocioGeneralDao = $GiroNegocioGeneralDao;
    $this->loggerDao = $LoggerDao;
  }

  public function index()
  {
    return view('administracion.catalogos.tipogirogeneral.index');
  }

  public function edit($id)
  {
      $data['tipoGiroGeneral']=$this->giroNegocioGeneralDao->findById($id);
      return view('administracion.catalogos.tipogirogeneral.edit',$data);
  }

  public function create()
  {
    return view('administracion.catalogos.tipogirogeneral.create');
  }


  public function store(Request $request)
  {

    $nombre = $request->get('nombre');
    $rules = array(
    'nombre' => 'required|unique:App\Entities\GiroNegocioGeneral,etiqueta'
    );

    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );

    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/tipogirosgenerales/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoGiroGeneral = new GiroNegocioGeneral;
        $tipoGiroGeneral->setEtiqueta( $nombre );
        $this->giroNegocioGeneralDao->create( $tipoGiroGeneral );
        
        $this->loggerDao->create( new Logger("Ha creado EL Giro General: " . $nombre) );
        return Redirect::to("/administracion/catalogo/tipogirosgenerales")->with('mensaje','Creado correctamente!.');
    }
  }

  public function update(Request $request,$id)
  {
    $nombre = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\GiroNegocioGeneral,etiqueta,'.$id
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );

    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/tipogirosgenerales/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoGiroGeneral = $this->giroNegocioGeneralDao->findById( $id );
        $tipoGiroGeneral->setEtiqueta( $nombre );
        $this->giroNegocioGeneralDao->update( $tipoGiroGeneral );

        $this->loggerDao->create( new Logger("Ha creado EL Giro General: " . $nombre." con el ID: ".$tipoGiroGeneral->getId()) );
        return Redirect::to("/administracion/catalogo/tipogirosgenerales")->with('mensaje','Actualizada correctamente!.');
    }
  }



    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {     
      $tipoGiroGenerales = $this->giroNegocioGeneralDao->listAll();
      $tipoGiroGeneralArreglo = array();
      foreach ( $tipoGiroGenerales as $indice => $tipoGiroGeneral ){
          $arreglo = array( 
              'id' => $tipoGiroGeneral->getId(), 
              'etiqueta' => $tipoGiroGeneral->getEtiqueta()
          );
          $tipoGiroGeneralArreglo[] = $arreglo;
      } 
      return response( $tipoGiroGeneralArreglo , 200)->header('Content-Type', 'application/json');
    }  
  


}
