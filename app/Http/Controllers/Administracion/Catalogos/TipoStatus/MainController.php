<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoStatus;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\TipoStatus;
use App\Entities\Logger;
/* DAOS */
use App\Daos\TipoStatusDao;
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
  protected $tipoStatusDao;
  protected $loggerDao;

  public function __construct(
    TipoStatusDao $TipoStatusDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoStatus',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoStatus:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoStatus:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoStatus:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoStatus:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoStatus',[ 'only' => ['listAll' ]] );
    //$this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->tipoStatusDao = $TipoStatusDao;
    $this->loggerDao = $LoggerDao;
  }
  
    public function index()
    {
      return view('administracion.catalogos.tipostatus.index');
    }

    public function create()
    {
      return view('administracion.catalogos.tipostatus.create');
    }

    public function edit($id)
    { 
        $data['status']=$this->tipoStatusDao->findById($id);
        return view('administracion.catalogos.tipostatus.edit',$data);
    }


    public function store(Request $request)
    {
      $nombre = $request->get('nombre');
      $rules = array(
            'nombre' => 'required|unique:App\Entities\TipoStatus,etiqueta'
      );
      $messages = array(
          'required' => 'El campo :attribute es obligatorio.'
      );
      $validation = Validator::make($request->all(), $rules, $messages);
      if ($validation->fails())
      {
        return Redirect::to("/administracion/catalogo/tipostatus/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
      }
      else
      {
          $status = new TipoStatus;
          $status->setEtiqueta( $nombre );
          $this->tipoStatusDao->create( $status );

          $this->loggerDao->create( new Logger( "Ha creado la status: " . $nombre  ) );   
          return Redirect::to("/administracion/catalogo/tipostatus")->with('mensaje','Creado correctamente!.');
      }
    }

    public function update(Request $request,$id)
    {
      $nombre = $request->get('nombre');
      $rules = array(
            'nombre' => 'required|unique:App\Entities\TipoStatus,etiqueta,'.$id
      );

      $messages = array(
          'required' => 'El campo :attribute es obligatorio.'
      );

      $validation = Validator::make($request->all(), $rules, $messages);
      if ($validation->fails())
      {
        return Redirect::to("/administracion/catalogo/tipostatus/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
      }
      else
      {
          $status = $this->tipoStatusDao->findById( $id );
          $status->setEtiqueta( $nombre );
          $this->tipoStatusDao->update( $status );

          $this->loggerDao->create( new Logger( "Ha actualizado status: " . $nombre  ) );   
          return Redirect::to("/administracion/catalogo/tipostatus")->with('mensaje','Actualizada correctamente!.');
      }
    }

    
    
    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
      SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
      ==============================================================================================*/
      public function listAll() 
      {     
        $tiposStatus = $this->tipoStatusDao->listAll();
        $tiposStatusArreglo = array();
        foreach ( $tiposStatus as $indice => $tipoStatus ){
            $tipoStatusArreglo = array(
                'id' => $tipoStatus->getId(),
                'etiqueta' => $tipoStatus->getEtiqueta()
            );
            $tiposStatusArreglo[] = $tipoStatusArreglo;
        }
        return response( $tiposStatusArreglo , 200)->header('Content-Type', 'application/json');
      }
    



}
