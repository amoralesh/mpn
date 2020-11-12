<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoGiro;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */
use App\Entities\GiroNegocio;
use App\Entities\Logger;

/* DAOS */
use App\Daos\GiroNegocioDao;
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
  protected $giroNegocioDao;
  protected $loggerDao;

  public function __construct(
    GiroNegocioDao $GiroNegocioDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoGiro',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiro:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiro:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiro:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoGiro:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoGiro',[ 'only' => ['listAll' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->giroNegocioDao = $GiroNegocioDao;
    $this->loggerDao = $LoggerDao;
  }


    public function index()
    {
        return view('administracion.catalogos.tipogiro.index');
    }

    public function edit($id)
    {
        $data['tipoGiro']=$this->giroNegocioDao->findById($id);
        return view('administracion.catalogos.tipogiro.edit',$data);
    }

    public function create()
    {
        return view('administracion.catalogos.tipogiro.create');
    }


    public function store(Request $request)
    {
        $nombre  = $request->get('nombre');
        $rules = array(
            'nombre' => 'required|unique:App\Entities\GiroNegocio,etiqueta'
        );
        $messages = array(
            'required' => 'El campo :attribute es obligatorio.'
        );

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
        return Redirect::to("/administracion/catalogo/tipoGiros/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
        }
        else
        {
            $tipoGiro = new GiroNegocio;
            $tipoGiro->setEtiqueta( $nombre );
            $this->giroNegocioDao->create( $tipoGiro );

            $this->loggerDao->create( new Logger("Ha creado la asentamiento: " . $nombre  ) ); 
            return Redirect::to("/administracion/catalogo/tipoGiros")->with('mensaje','Creado correctamente!.');
        }  
    }


    public function update(Request $request,$id)
    {
        $nombre  = $request->get('nombre');
        $rules = array(
            'nombre' => 'required|unique:App\Entities\GiroNegocio,etiqueta,'.$id
        );
        $messages = array(
            'required' => 'El campo :attribute es obligatorio.'
        );

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
        return Redirect::to("/administracion/catalogo/tipoGiros/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
        }
        else
        {
            $tipoGiro = $this->giroNegocioDao->findById( $id );
            $tipoGiro->setEtiqueta( $nombre );
            $this->giroNegocioDao->update( $tipoGiro );
            $this->loggerDao->create( new Logger( "Ha actualizado tipoGiro: " . $nombre ) ); 
            return Redirect::to("/administracion/catalogo/tipoGiros")->with('mensaje','Actualizada correctamente!.');
        }
    }


    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {      
      $tipoGiros = $this->giroNegocioDao->listAll();
      $tipoGiroArreglo = array();
      foreach ( $tipoGiros as $indice => $tipoGiro ){
          $arreglo = array(
              'id' => $tipoGiro->getId(), 
              'etiqueta' => $tipoGiro->getEtiqueta()
          );
          $tipoGiroArreglo[] = $arreglo;
      } 
      return response( $tipoGiroArreglo , 200)->header('Content-Type', 'application/json');
    }  
  



}
