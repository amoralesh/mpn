<?php

namespace App\Http\Controllers\Administracion\Catalogos\Colonias;    

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */  
use App\Entities\Colonia;
use App\Entities\Logger;

/* DAOS */
use App\Daos\ColoniaDao;
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
  protected $coloniaDao;
  protected $delegacionDao;
  protected $loggerDao;
     
  public function __construct(
     ColoniaDao $ColoniaDao
    ,DelegacionDao $DelegacionDao
    ,LoggerDao $LoggerDao)
  {  
    $this->middleware('auth'); 
    $this->middleware('hasPermission:Administracion:Aside:Catalogos:Colonia',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Colonia:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Colonia:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Colonia:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Catalogos:Colonia:Actualizar',[ 'only' => ['update' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Catalogos:Colonia',[ 'only' => ['listAll','findColoniaByDelegacion' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update' ]] );
    /* ENTITIES DAO */  
    $this->coloniaDao = $ColoniaDao;
    $this->delegacionDao = $DelegacionDao;
    $this->loggerDao = $LoggerDao;
  }  
 
  public function index()
  {  
    return view('administracion.catalogos.colonias.index');  
  }


  public function create()
  {    
    $data['delegacionList'] = $this->delegacionDao->listAll();
    return view('administracion.catalogos.colonias.create',$data);  
  }

  public function edit( $id )
  {
    $colonia = $this->coloniaDao->findById( $id );
    $data['colonia'] = $colonia;
    $data['delegacionList'] = $this->delegacionDao->listAll();
    return view('administracion.catalogos.colonias.edit',$data);  
  }


  public function store(Request $request)
  {
    $nombre  = $request->get('nombre');  
    $delegacion = $request->get('delegacion');
    $rules = array(
          'nombre'   => 'required',
          'delegacion'  => 'required'
    );  
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );     
    $validation = Validator::make($request->all(), $rules, $messages);

    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/colonias/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {   
        $delegacionE =  $this->delegacionDao->findById( $delegacion );

        $colonia = $this->coloniaDao->findByEtiquetaAndDelegacion( $nombre, $delegacionE->getEtiqueta() );
        if( $colonia != FALSE ){
            return Redirect::to("/administracion/catalogo/colonias/create")->with('errores','La colonia ya existe en esa delegación!.');
        }
        $colonia = new Colonia;
        $colonia->setEtiqueta( $nombre );
        $colonia->setDelegacion( $delegacionE );

        $this->coloniaDao->create( $colonia );

        $this->loggerDao->create( new Logger("Ha creado la colonia: " . $nombre ) );
        return Redirect::to("/administracion/catalogo/colonias")->with('mensaje','Creado correctamente!.');
    }
  }

  
  public function update(Request $request,$id)
  {
    $nombre             = $request->get('nombre');  
    $delegacion         = $request->get('delegacion');
    $rules = array(  
          'nombre'             => 'required',
          'delegacion'         => 'required'
    );  
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.'
    );     
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/catalogo/colonias/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else   
    {    
        $delegacionE =  $this->delegacionDao->findById( $delegacion );

        $colonia = $this->coloniaDao->findByEtiquetaAndDelegacion( $nombre, $delegacionE->getEtiqueta() );

        if( $colonia == FALSE ){// NO ENCONTRO NINGUNA COLONIA

          $colonia = $this->coloniaDao->findById( $id );
          $colonia->setEtiqueta( $nombre );
          $colonia->setDelegacion( $delegacionE );

        } else {// ENCONTRO COLONIA
            return Redirect::to("/administracion/catalogo/colonias/".$id."/edit")->with('errores','La colonia ya existe en esa delegación!.');
        }  

        $this->coloniaDao->update( $colonia );

        $this->loggerDao->create( new Logger("Ha actualizado la colonia: " . $colonia->getEtiqueta() ." con el ID: ".$colonia->getId()) );
        return Redirect::to("/administracion/catalogo/colonias")->with('mensaje','Actualizada correctamente!.');
    } 
  }  
    
   
  /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
  ==========================================*/
  public function listAll(Request $request)
  {  
    $firstResult = $request->get('start');
    $maxResult   = $request->get('length');
    $draw        = $request->get('draw');
    $buscar      = $request->get('search')['value'];
    
    $data = $this->coloniaDao->listAllJson( $draw,  $maxResult , $firstResult , $buscar );
    return response( $data , 200)->header('Content-Type', 'application/json');
  }

  
    
  public function findByIdDelegacion($id)
  {    
    $colonias = $this->coloniaDao->findByIdDelegacion($id);
    $coloniaArreglo = array();
    foreach($colonias as $indice => $colonia){
        $arreglo = array(
          "id" => $colonia->getId(),
          "etiqueta" => $colonia->getEtiqueta()
        );
        $coloniaArreglo[] = $arreglo;
    }
    return response( $coloniaArreglo , 200)->header('Content-Type', 'application/json');

  }



}

