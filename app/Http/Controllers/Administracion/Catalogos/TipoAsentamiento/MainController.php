<?php
 
namespace App\Http\Controllers\Administracion\Catalogos\TipoAsentamiento;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
/* ENTITIES */
use App\Entities\TipoAsentamiento;
use App\Entities\Logger;
/* DAOS */
use App\Daos\TipoAsentamientoDao;
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
  protected $tipoAsentamientoDao;
  protected $loggerDao;

  public function __construct(
    TipoAsentamientoDao $TipoAsentamientoDao
    ,LoggerDao $LoggerDao)
  {
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:TipoAsentamiento',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAsentamiento:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAsentamiento:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAsentamiento:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:TipoAsentamiento:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:TipoAsentamiento',[ 'only' => ['listAll' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->tipoAsentamientoDao = $TipoAsentamientoDao; 
    $this->loggerDao = $LoggerDao;
  }

  public function index()
  {
    return view('administracion.catalogos.tipoasentamiento.index');
  }
 
  public function create()
  {
    return view('administracion.catalogos.tipoasentamiento.create');
  }


  public function edit($id)
  {
      $data['tipoAsentamiento']=$this->tipoAsentamientoDao->findById($id);
      return view('administracion.catalogos.tipoasentamiento.edit',$data);
  }
 

  public function store(Request $request)
  {
    $nombre = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\TipoAsentamiento,etiqueta'
    );

    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );

    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/tipoAsentamientos/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoAsentamiento = new TipoAsentamiento;
        $tipoAsentamiento->setEtiqueta( $nombre );
        $this->tipoAsentamientoDao->create( $tipoAsentamiento );

        $this->loggerDao->create( new Logger( "Ha creado la asentamiento: " . $nombre  ) );   
        return Redirect::to("/administracion/catalogo/tipoAsentamientos")->with('mensaje','Creado correctamente!.');
    }
  }


  public function update(Request $request,$id)
  {
    $nombre = $request->get('nombre');
    $rules = array(
          'nombre' => 'required|unique:App\Entities\TipoAsentamiento,etiqueta,'.$id
    );

    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/tipoAsentamientos/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {
        $tipoAsentamiento = $this->tipoAsentamientoDao->findById( $id );
        $tipoAsentamiento->setEtiqueta( $nombre );
        $this->tipoAsentamientoDao->update( $tipoAsentamiento );

        $this->loggerDao->create( new Logger( "Ha actualizado tipoAsentamiento: " . $nombre ) );   
        return Redirect::to("/administracion/catalogo/tipoAsentamientos")->with('mensaje','Actualizada correctamente!.');
    }
  }

   
  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
     SERVICIOS REST  SERVICIOS REST SERVICIOS REST SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==============================================================================================*/
    public function listAll()
    {      
      $tipoAsentamientos = $this->tipoAsentamientoDao->listAll();
      $tipoAsentamientosArreglo = array();
      foreach ( $tipoAsentamientos as $indice => $tipoAsentamiento ){
          $tipoAsentamientoArreglo = array(
              'id' => $tipoAsentamiento->getId(),
              'etiqueta' => $tipoAsentamiento->getEtiqueta()
          );
          $tipoAsentamientosArreglo[] = $tipoAsentamientoArreglo;
      }
      return response( $tipoAsentamientosArreglo , 200)->header('Content-Type', 'application/json');
    }
  
  
      

}
