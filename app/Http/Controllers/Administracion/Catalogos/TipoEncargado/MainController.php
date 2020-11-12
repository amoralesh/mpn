<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoEncargado;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\TipoEncargado;
use App\Entities\Logger;
/* DAOS */
use App\Daos\TipoEncargadoDao;
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
  protected $tipoEncargadoDao;
  protected $loggerDao;
  public function __construct(
    TipoEncargadoDao $TipoEncargadoDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoEncargado',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoEncargado:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoEncargado:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoEncargado:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoEncargado:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoEncargado',[ 'only' => ['listAll' ]] );
    //$this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->tipoEncargadoDao = $TipoEncargadoDao;
    $this->loggerDao = $LoggerDao;
  }

    public function index()
    {
        return view('administracion.catalogos.tipoencargado.index');
    }


    public function edit($id)
    {
        $data['tipoEncargado']=$this->tipoEncargadoDao->findById($id);
        return view('administracion.catalogos.tipoencargado.edit',$data);
    }

    public function create()
    {
        return view('administracion.catalogos.tipoencargado.create');
    }

    public function store(Request $request)
    {
        
        $nombre             = $request->get('nombre');
        $rules = array(
            'nombre'             => 'required|unique:App\Entities\TipoEncargado,etiqueta'
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.'
        );

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
        return Redirect::to("/administracion/catalogo/tipoencargado/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
        }
        else
        {  
            $tipoEncargado = new TipoEncargado;
            $tipoEncargado->setEtiqueta( $nombre );
            $this->tipoEncargadoDao->create( $tipoEncargado );

            $this->loggerDao->create( new Logger( "Ha creado la asentamiento: " . $nombre ) );   
            return Redirect::to("/administracion/catalogo/tipoencargado")->with('mensaje','Creado correctamente!.');
        }
    }


    public function update(Request $request,$id)
    {
        $nombre  = $request->get('nombre');
        $rules = array(
            'nombre'  => 'required|unique:App\Entities\TipoEncargado,etiqueta,'.$id
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.'
        );

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
        //var_dump($validation->errors());
        return Redirect::to("/administracion/catalogo/tipoencargado/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
        }
        else
        {
            $tipoEncargado = $this->tipoEncargadoDao->findById( $id );
            $tipoEncargado->setEtiqueta( $nombre );
            $this->tipoEncargadoDao->update( $tipoEncargado );

            $this->loggerDao->create( new Logger( "Ha actualizado TipoEncargadoDao: " . $nombre ) );   
            return Redirect::to("/administracion/catalogo/tipoencargado")->with('mensaje','Actualizada correctamente!.');
        }
    }




    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {     
      $tipoEncargados = $this->tipoEncargadoDao->listAll();
      $tipoEncargadoArreglo = array();
      foreach ( $tipoEncargados as $indice => $tipoEncargado ){
          $arreglo = array(
              'id' => $tipoEncargado->getId(),
              'etiqueta' => $tipoEncargado->getEtiqueta()
          );
          $tipoEncargadoArreglo[] = $arreglo;
      } 
      return response( $tipoEncargadoArreglo , 200)->header('Content-Type', 'application/json');
    }  
  




}
