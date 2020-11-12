<?php

namespace App\Http\Controllers\Administracion\Catalogos\TipoNegocio;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */
use App\Entities\TipoNegocio;
use App\Entities\Logger;

/* DAOS */
use App\Daos\TipoNegocioDao;
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
  protected $tipoNegocioDao;
  protected $loggerDao;

  public function __construct(
    TipoNegocioDao $TipoNegocioDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoNegocio',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoNegocio:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoNegocio:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoNegocio:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoNegocio:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoNegocio',[ 'only' => ['listAll' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->tipoNegocioDao = $TipoNegocioDao;
    $this->loggerDao = $LoggerDao;
  }


    public function index()
    {
        return view('administracion.catalogos.tiponegocio.index');
    }

    public function edit($id)
    {
        $data['tipoNegocio']=$this->tipoNegocioDao->findById($id);
        return view('administracion.catalogos.tiponegocio.edit',$data);
    }

    public function create()
    {
        return view('administracion.catalogos.tiponegocio.create');
    }

    
    public function store(Request $request)
    {
        $nombre = $request->get('nombre');
        $rules = array(
            'nombre' => 'required|unique:App\Entities\TipoNegocio,etiqueta'
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.'
        );

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
        return Redirect::to("/administracion/catalogo/tipoNegocios/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
        }
        else
        {
            $tipoNegocio = new TipoNegocio;
            $tipoNegocio->setEtiqueta( $nombre );
            $this->tipoNegocioDao->create( $tipoNegocio );

            $this->loggerDao->create( new Logger( "Ha creado la asentamiento: " . $nombre ) );   
            return Redirect::to("/administracion/catalogo/tipoNegocios")->with('mensaje','Creado correctamente!.');
        }
    }

    public function update(Request $request,$id)
    {
        $nombre = $request->get('nombre');
        $rules = array(
            'nombre' => 'required|unique:App\Entities\TipoNegocio,etiqueta,'.$id
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.'
        );

        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
        return Redirect::to("/administracion/catalogo/tipoNegocios/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
        }
        else
        {
            $tipoNegocio = $this->tipoNegocioDao->findById( $id );
            $tipoNegocio->setEtiqueta( $nombre );
            $this->tipoNegocioDao->update( $tipoNegocio );


            $this->loggerDao->create( new Logger( "Ha actualizado tipoNegocio: " . $nombre ) );  
            return Redirect::to("/administracion/catalogo/tipoNegocios")->with('mensaje','Actualizada correctamente!.');
        }
    }
    

    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll() 
    {     
      $tiposNegocio = $this->tipoNegocioDao->listAll();
      $tipoNegocioArreglo = array(); 
      foreach ( $tiposNegocio as $indice => $tipoNegocio ){
          $arreglo = array( 
              'id' => $tipoNegocio->getId(), 
              'etiqueta' => $tipoNegocio->getEtiqueta()
          );
          $tipoNegocioArreglo[] = $arreglo;
      } 
      return response( $tipoNegocioArreglo , 200)->header('Content-Type', 'application/json');
    }  
  



}
