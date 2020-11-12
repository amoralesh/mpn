<?php

namespace App\Http\Controllers\Administracion\Plazas;  
   
/* CONTROLADOR */  
use App\Http\Controllers\Controller;

/* ENTITIES */  
use App\Entities\Plaza;
use App\Entities\Direccion; 
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger;

/* DAOS */
use App\Daos\PlazaDao;
use App\Daos\DelegacionDao;
use App\Daos\ColoniaDao;
use App\Daos\TipoAsentamientoDao;  
use App\Daos\EncargadoDao;
use App\Daos\MotivoAltaBajaDao;
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
  protected $plazaDao;
  protected $delegacionDao;
  protected $coloniaDao;
  protected $tipoAsentamientoDao;
  protected $encargadoDao;
  protected $motivoAltaBajaDao;
  protected $loggerDao;

  public function __construct(
    PlazaDao $PlazaDao
    ,DelegacionDao $DelegacionDao
    ,ColoniaDao $ColoniaDao
    ,TipoAsentamientoDao $TipoAsentamientoDao
    ,MotivoAltaBajaDao $MotivoAltaBajaDao
    ,EncargadoDao $EncargadoDao 
    ,LoggerDao $LoggerDao)
  {  
    $this->middleware('auth');
    $this->middleware('hasPermission:Administracion:Aside:Plaza',[ 'only' => ['index' ]] );
    $this->middleware('hasPermission:Administracion:Plaza:Crear',[ 'only' => ['create' ]] );
    $this->middleware('hasPermission:Administracion:Plaza:Editar',[ 'only' => ['edit' ]] );
    $this->middleware('hasPermission:Administracion:Plaza:Guardar',[ 'only' => ['store' ]] );
    $this->middleware('hasPermission:Administracion:Plaza:Actualizar',[ 'only' => ['update' ]] );

    $this->middleware('hasPermission:Administracion:Plaza:Habilitar',[ 'only' => ['habilitar' ]] );
    $this->middleware('hasPermission:Administracion:Plaza:Deshabilitar',[ 'only' => ['deshabilitar' ]] );
    $this->middleware('hasPermission:Administracion:Rest:Plaza',[ 'only' => ['listAll' ]] ); 

    $this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
    $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
    /* ENTITIES DAO */
    $this->plazaDao = $PlazaDao;
    $this->delegacionDao = $DelegacionDao;
    $this->coloniaDao = $ColoniaDao;
    $this->tipoAsentamientoDao = $TipoAsentamientoDao;
    $this->encargadoDao = $EncargadoDao;
    $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
    $this->loggerDao = $LoggerDao;
  }  
 
  public function index()
  {  
    return view('administracion.plazas.index');     
  }   

  public function create()
  {
    $data['delegacionList'] = $this->delegacionDao->listAll();
    $data['tipoAsentamientoList'] = $this->tipoAsentamientoDao->listAll();
    return view('administracion.plazas.create',$data);  
  }

  public function edit($id)
  {
    $plaza = $this->plazaDao->findById( $id );
    $data['plaza']  = $plaza;
    $data['delegacionList'] = $this->delegacionDao->listAll();
    $data['coloniaList'] = $this->coloniaDao->listAll();
    $data['tipoAsentamientoList'] = $this->tipoAsentamientoDao->listAll();
    $encargadosArreglo = array();
    foreach( $plaza->getEncargados() as $indice => $encargado )
    {
        array_push($encargadosArreglo, $encargado->getId() ); 
    } 
    $data['encargadosList'] = $encargadosArreglo; 
    return view('administracion.plazas.edit',$data);   
  }


  public function store(Request $request)
  {
    $nombre              = $request->get('nombre');
    $alias               = $request->get('alias');
    $callePrincipal      = $request->get('callePrincipal');
    $calleA              = $request->get('calleA');
    $calleB              = $request->get('calleB');
    $numeroInterior      = $request->get('numeroInterior');
    $numeroExterior      = $request->get('numeroExterior');
    $edificio            = $request->get('edificio');
    $delegacion          = $request->get('delegacion');
    $colonia             = $request->get('colonia'); 
    $tipoAsentamiento    = $request->get('tipoAsentamiento');  
    $nombreAsentamiento  = $request->get('nombreAsentamiento');
    $codigoPostal        = $request->get('codigoPostal');
    $telefono            = $request->get('telefono');
    $extension           = $request->get('extension');
    $encargadosList      = $request->get('encargadosList');
      
    $rules = array(
          'nombre'             => 'required|max:100|unique:App\Entities\Plaza,etiqueta',
          'alias'              => 'required|max:100', 
          'callePrincipal'     => 'required|max:100',  
          'calleA'             => 'required|max:100',
          'calleB'             => 'required|max:100',
          'delegacion'         => 'required',
          'colonia'            => 'required',
          'tipoAsentamiento'   => 'required',
          'nombreAsentamiento' => 'required',
          'codigoPostal'       => 'required|min:1|max:8',
          'telefono'           => 'required|min:6|max:15',
          'encargadosList'     => 'required'
    );
    $messages = array(
        'required' => 'El campo :attribute es obligatorio.',
        'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
        'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        'unique' => 'La plaza ya esta registrada'
    );
    $validation = Validator::make($request->all(), $rules, $messages);
    if ($validation->fails())
    {
      return Redirect::to("/administracion/plazas/create")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
    }
    else
    {   
        $plaza = new Plaza;
        $plaza->setEtiqueta( $nombre );
        $plaza->setAlias( $alias );
        $plaza->setTelefono( $telefono );  
        $plaza->setExtension( $extension );

        $direccion = new Direccion;
        $direccion->setCallePrincipal( $callePrincipal );
        $direccion->setCalle1( $calleA );
        $direccion->setCalle2( $calleB );
        $direccion->setNumeroInterior( $numeroInterior );
        $direccion->setNumeroExterior( $numeroExterior );
        $direccion->setEdificio( $edificio );

        //DAO
        $tipoAsentamientoE = $this->tipoAsentamientoDao->findById( $tipoAsentamiento );
        $direccion->setTipoAsentamiento( $tipoAsentamientoE );
        $direccion->setNombreAsentamiento( $nombreAsentamiento );

        //DAO
        $coloniaE = $this->coloniaDao->findById( $colonia  ); 
        $direccion->setColonia( $coloniaE );
        $direccion->setCodigoPostal( $codigoPostal );

        $plaza->setDireccion( $direccion ); 


        $encargadosArray = explode(',', $encargadosList);
        $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);
        $plaza->setEncargados( $encargadosListE );
        $this->plazaDao->create( $plaza );

        $this->loggerDao->create( new Logger("Ha creado la plaza: " . $nombre) );
        return Redirect::to("/administracion/plazas")->with('mensaje','Creado correctamente!.');

    } 
  }  

  public function update(Request $request,$id)
  {
      $nombre              = $request->get('nombre');
      $alias               = $request->get('alias');
      $callePrincipal      = $request->get('callePrincipal');
      $calleA              = $request->get('calleA');
      $calleB              = $request->get('calleB');
      $numeroInterior      = $request->get('numeroInterior');
      $numeroExterior      = $request->get('numeroExterior');
      $edificio            = $request->get('edificio');
      $delegacion          = $request->get('delegacion'); 
      $colonia             = $request->get('colonia'); 
      $tipoAsentamiento    = $request->get('tipoAsentamiento');
      $nombreAsentamiento  = $request->get('nombreAsentamiento');
      $codigoPostal        = $request->get('codigoPostal');
      $telefono            = $request->get('telefono');
      $extension           = $request->get('extension');
      $encargadosList      = $request->get('encargadosList');
        
      $rules = array(
            'nombre'             => 'required|max:100|unique:App\Entities\Plaza,etiqueta,'.$id,//notese que es el id del objet
            'alias'              => 'required|max:100', 
            'callePrincipal'     => 'required|max:100',  
            'calleA'             => 'required|max:100',
            'calleB'             => 'required|max:100',
            'delegacion'         => 'required',
            'colonia'            => 'required',
            'tipoAsentamiento'   => 'required',
            'nombreAsentamiento' => 'required',
            'codigoPostal'       => 'required|min:1|max:8',
            'telefono'           => 'required|min:6|max:15',
            'encargadosList'     => 'required'
      );  
    
      $messages = array(
          'required' => 'El campo :attribute es obligatorio.',
          'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
          'max' => 'El campo :attribute no puede tener más de :max carácteres.',
          'unique' => 'La plaza ya esta registrada'
      );     

      $validation = Validator::make($request->all(), $rules, $messages);
      if ($validation->fails())
      {
        return Redirect::to("/administracion/plazas/".$id."/edit")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
      }
      else
      {
          $plaza = $this->plazaDao->findById( $id );
          $plaza->setEtiqueta( $nombre );
          $plaza->setAlias( $alias );
          $plaza->setTelefono( $telefono );  
          $plaza->setExtension( $extension );

          $direccion = $plaza->getDireccion();
          $direccion->setCallePrincipal( $callePrincipal );
          $direccion->setCalle1( $calleA );
          $direccion->setCalle2( $calleB );
          $direccion->setNumeroInterior( $numeroInterior );
          $direccion->setNumeroExterior( $numeroExterior );
          $direccion->setEdificio( $edificio );

          //DAO
          $tipoAsentamientoE = $this->tipoAsentamientoDao->findById( $tipoAsentamiento );
          $direccion->setTipoAsentamiento( $tipoAsentamientoE );
          $direccion->setNombreAsentamiento( $nombreAsentamiento );

          //DAO
          $coloniaE = $this->coloniaDao->findById( $colonia  ); 
          $direccion->setColonia( $coloniaE );
          $direccion->setCodigoPostal( $codigoPostal );

          $plaza->setDireccion( $direccion ); 

          $encargadosArray = explode(',', $encargadosList);
          $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);
          $plaza->setEncargados( $encargadosListE );

          $this->plazaDao->update( $plaza );
          $this->loggerDao->create( new Logger("Ha actualizado la plaza: " . $nombre." con le ID: ".$plaza->getId()) );
          return Redirect::to("/administracion/plazas")->with('mensaje','Actualizada correctamente!.');
      } 
  }



    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
    public function plazas(Request $request)
    {
        $firstResult = $request->get('start');
        $maxResult   = $request->get('length');
        $draw        = $request->get('draw');
        $buscar      = $request->get('search')['value'];
          
        $data = $this->plazaDao->listAllJson($draw,  $maxResult , $firstResult , $buscar );
        return response( $data , 200)->header('Content-Type', 'application/json');
    }
     

    /**  VALIDADO */ 
    public function findById( $id )
    {     
        $plaza = $this->plazaDao->findById($id);

        $motivoAltaBajaArreglo = array();   
        foreach( $plaza->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
            $arreglo = array(    
              "id" => $motivoAltaBaja->getId(),
              "contenido" => $motivoAltaBaja->getContenido(),   
              "tipo" => $motivoAltaBaja->getTipo(), 
              "usuario" => $motivoAltaBaja->getUsuario(),    
              "fechaAlta" => $motivoAltaBaja->getFechaAlta()
            );
            $motivoAltaBajaArreglo[] = $arreglo;
        }
          
        $direccion = array(    
          "id" => $plaza->getDireccion()->getId(),  
          "callePrincipal" => $plaza->getDireccion()->getCallePrincipal(),   
          "calle1" => $plaza->getDireccion()->getCalle1(), 
          "calle2" => $plaza->getDireccion()->getCalle2(),  
          "numeroInterior" => $plaza->getDireccion()->getNumeroInterior(), 
          "numeroExterior" => $plaza->getDireccion()->getNumeroExterior(), 
          "edificio" => $plaza->getDireccion()->getEdificio(), 
          "tipoAsentamiento" => $plaza->getDireccion()->getTipoAsentamiento()->getEtiqueta(), 
          "nombreAsentamiento" => $plaza->getDireccion()->getNombreAsentamiento(), 
          "colonia" => $plaza->getDireccion()->getColonia()->getEtiqueta(), 
          "codigoPostal" => $plaza->getDireccion()->getCodigoPostal()
        );

        $arreglo = array( 
          "id" => $plaza->getId(),
          "etiqueta" => $plaza->getEtiqueta(),   
          "alias" => $plaza->getAlias(),  
          "telefono" => $plaza->getTelefono(), 
          "extension" => $plaza->getExtension(), 
          "direccion" => $direccion,
          "fechaAlta" => $plaza->getFechaAlta(), 
          "status" => $plaza->getStatus() ? "Activo" : "No activo" ,
          "motivosAltaBaja" => $motivoAltaBajaArreglo   
        ); 
        return response( $arreglo , 200)->header('Content-Type', 'application/json');
    }        

    
    /**  VALIDADO */ 
    public function plazasEstablecimiento( $id ) 
    {      
        $plaza = $this->plazaDao->findByIdEstablecimiento( $id );
        $arreglo = array();
        if( $plaza != FALSE ){  
            $direccion = array(    
              "id" => $plaza->getDireccion()->getId(),  
              "callePrincipal" => $plaza->getDireccion()->getCallePrincipal(),   
              "calle1" => $plaza->getDireccion()->getCalle1(), 
              "calle2" => $plaza->getDireccion()->getCalle2(),  
              "numeroInterior" => $plaza->getDireccion()->getNumeroInterior(), 
              "numeroExterior" => $plaza->getDireccion()->getNumeroExterior(), 
              "edificio" => $plaza->getDireccion()->getEdificio(), 
              "tipoAsentamiento" => $plaza->getDireccion()->getTipoAsentamiento()->getEtiqueta(), 
              "nombreAsentamiento" => $plaza->getDireccion()->getNombreAsentamiento(), 
              "colonia" => $plaza->getDireccion()->getColonia()->getEtiqueta(), 
              "codigoPostal" => $plaza->getDireccion()->getCodigoPostal()
            //  "latitud" => $plaza->getNegocios()->getLatitud(),
              //"longitud" => $plaza->getNegocios()->getLongitud()
            );
    
            $arreglo = array( 
              "id" => $plaza->getId(),
              "etiqueta" => $plaza->getEtiqueta(),   
              "alias" => $plaza->getAlias(),  
              "telefono" => $plaza->getTelefono(), 
              "extension" => $plaza->getExtension(), 
              "direccion" => $direccion,
              "fechaAlta" => $plaza->getFechaAlta(), 
              "status" => $plaza->getStatus() ? "Activo" : "No activo"
            ); 
        }
        return response( $arreglo , 200)->header('Content-Type', 'application/json');
    }        

    

    public function deshabilitar(Request $request)
    {  
        $id              = $request->get('id');  
        $motivoAltaBaja  = $request->get('motivoAltaBaja');
        
        $plaza = $this->plazaDao->findById($id);
        $plaza->setStatus(false);

        $plazaArray = array();
        $plazaArray[] = $plaza;

        $motivoAltaBajaE = new MotivoAltaBaja;
        $motivoAltaBajaE->setContenido( $motivoAltaBaja );
        $motivoAltaBajaE->setPlazas( $plazaArray );
        $motivoAltaBajaE->setTipo( "Deshabilitado" );
        $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  
        $plaza->addMotivoAltaBaja($motivoAltaBajaE);
        $this->plazaDao->update( $plaza );

        return response( 200 , 200)->header('Content-Type', 'application/json');
    }




    public function habilitar(Request $request)
    {  
      $request->merge(array_map('trim', $request->all() ));
      $id              = $request->get('id');
      $motivoAltaBaja  = $request->get('motivoAltaBaja');
      $plaza = $this->plazaDao->findById($id);
      $plaza->setStatus(true);

      $plazaArray = array();
      $plazaArray[] = $plaza;
    
      $motivoAltaBajaE = new MotivoAltaBaja;
      $motivoAltaBajaE->setContenido( $motivoAltaBaja );
      $motivoAltaBajaE->setPlazas( $plazaArray );  
      $motivoAltaBajaE->setTipo( "Habilitado" );
      $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );  

      $plaza->addMotivoAltaBaja($motivoAltaBajaE);

      $this->plazaDao->update( $plaza );
      
      return response( 200 , 200)->header('Content-Type', 'application/json');

    }
}

