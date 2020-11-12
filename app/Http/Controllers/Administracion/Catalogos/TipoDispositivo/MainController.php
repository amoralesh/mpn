<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoDispositivo;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */
use App\Entities\TipoDispositivo;
use App\Entities\Logger;

/* DAOS */
use App\Daos\TipoDispositivoDao;
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

    /*2:18:27

  /* ENTITIES DAO */
  protected $tipoDispositivoDao;
  protected $loggerDao;
  public function __construct(
    TipoDispositivoDao $TipoDispositivoDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoDispositivo',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoDispositivo:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoDispositivo:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoDispositivo:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoDispositivo:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoDispositivo',[ 'only' => ['listAll' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */ 
    $this->tipoDispositivoDao = $TipoDispositivoDao;
    $this->loggerDao = $LoggerDao;
  }


  public function index()
  {
    return view('administracion.catalogos.tipodispositivo.index');
  } 

  public function edit($id)
  {
      $data['tipoDispositivo']=$this->tipoDispositivoDao->findById($id);
      return view('administracion.catalogos.tipodispositivo.edit',$data);
  }

  public function create()
  {
    return view('administracion.catalogos.tipodispositivo.create');
  }


  public function store(Request $request)
  {
    $nombre = $request->get('nombre'); 
    $rules = array(
          'nombre'  => 'required|unique:App\Entities\TipoDispositivo,etiqueta'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );

    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
        return Redirect::to("/administracion/catalogo/tipoDispositivo/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoDispositivo = new TipoDispositivo;
        $tipoDispositivo->setEtiqueta( $nombre );
        $this->tipoDispositivoDao->create( $tipoDispositivo );
        $this->loggerDao->create( new Logger("Ha creado la asentamiento: " . $nombre) );   
        return Redirect::to("/administracion/catalogo/tipoDispositivo")->with('mensaje','Creado correctamente!.');
    }
  }


  public function update(Request $request,$id)
  {
    $nombre = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\TipoDispositivo,etiqueta,'.$id
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/tipoDispositivo/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoDispositivo = $this->tipoDispositivoDao->findById( $id );
        $tipoDispositivo->setEtiqueta( $nombre );
        $this->tipoDispositivoDao->update( $tipoDispositivo );
        $this->loggerDao->create( new Logger("Ha actualizado tipoDispositivo: " . $nombre) );   
        return Redirect::to("/administracion/catalogo/tipoDispositivo/")->with('mensaje','Actualizada correctamente!.');
    }
  }



    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {     
      $tipoDispositivos = $this->tipoDispositivoDao->listAll();
      $tipoDispositivoArreglo = array();
      foreach ( $tipoDispositivos as $indice => $tipoDispositivo ){
          $arreglo = array(
              'id' => $tipoDispositivo->getId(),
              'etiqueta' => $tipoDispositivo->getEtiqueta()
          );
          $tipoDispositivoArreglo[] = $arreglo;
      } 
      return response( $tipoDispositivoArreglo , 200)->header('Content-Type', 'application/json');
    }  



}
