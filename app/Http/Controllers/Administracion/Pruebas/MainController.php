<?php

namespace App\Http\Controllers\Administracion\Pruebas;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
  
/* ENTITIES */  
use App\Entities\Pruebas;
use App\Entities\MotivoAltaBaja; 

/* DAOS */ 
use App\Daos\PruebasDao;
use App\Daos\DispositivoDao;
use App\Daos\TipoAlarmaDao; 
use App\Daos\MotivoAlarmaDao;      
use App\Daos\NegocioDao;
use App\Daos\TipoStatusDao;
use App\Daos\MotivoAltaBajaDao;
use App\Daos\DivisionTerritorial\SectorDao;
use App\Daos\LoggerDao;

/* EVENTOS SOCKET */
use App\Events\Pruebas as PruebasEvent;
    
/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request;   
use File;  
   
class MainController extends Controller
{
   
  /* ENTITIES DAO */ 
  protected $pruebasDao;
  protected $dispositivoDao;
  protected $tipoAlarmaDao;
  protected $motivoAlarmaDao;
  protected $tipoStatusDao;
  protected $negocioDao;
  protected $motivoAltaBajaDao;
  protected $sectorDao;
  protected $loggerDao;
    
  public function __construct(
      PruebasDao $PruebasDao
      ,DispositivoDao $DispositivoDao
     ,TipoAlarmaDao $TipoAlarmaDao
     ,TipoStatusDao $TipoStatusDao
     ,MotivoAlarmaDao $MotivoAlarmaDao
     ,NegocioDao $NegocioDao
     ,SectorDao $SectorDao
     ,LoggerDao $LoggerDao
    ,MotivoAltaBajaDao $MotivoAltaBajaDao)
  {

    $this->pruebasDao = $PruebasDao;
    $this->dispositivoDao = $DispositivoDao;
    $this->tipoAlarmaDao = $TipoAlarmaDao;
    $this->motivoAlarmaDao = $MotivoAlarmaDao;
    $this->tipoStatusDao = $TipoStatusDao;
    $this->negocioDao = $NegocioDao;
    $this->sectorDao = $SectorDao;
    $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
    $this->loggerDao = $LoggerDao;
  }    
 
    public function index()
    {
        return view('administracion.pruebas.index');  
    } 
    
    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
       
    /** VALIDADO */
    public function listAll( Request $request )
    {
        $draw        = $request->get('draw');
        $maxResult   = $request->get('length');
        $firstResult = $request->get('start');
        $buscar      = $request->get('search')['value'];
        $fechaInicio = $request->get('fechaInicio');
        $fechaFin    = $request->get('fechaFin');

        $pruebas = $this->pruebasDao->listAll( $fechaInicio , $fechaFin, $draw,  $maxResult , $firstResult , $buscar );
     
        $arregloPruebas = array();
        foreach( $pruebas['data'] as $indice => $prueba ){

            $cadenasArreglo = array(); 
            foreach( $prueba->getNegocio()->getCadenas() as $indice => $cadena ){
                $arreglo = array(
                    "id" => $cadena->getId(),
                    "etiqueta" => $cadena->getEtiqueta(),
                    "fechaAlta" => $cadena->getFechaAlta(), 
                    "status" => $cadena->getStatus() ? "Activo" : "No activo" 
                ); 
                $cadenasArreglo[] = $arreglo;
            }    

            $zonasArreglo = array();
            if( $prueba->getSector() != null ){  
                foreach( $prueba->getSector()->getZonas() as $indice => $zona ){    
                  $arreglo = array( 
                      "id" => $zona->getId(),
                      "etiqueta" => $zona->getEtiqueta()
                  ); 
                  $zonasArreglo[] = $arreglo;
                }    
            }
  
            $arreglo = array(
              "id" => $prueba->getId(),      
              "cadenas" => $cadenasArreglo,
              "idNegocio" => $prueba->getNegocio()->getId(),
              "negocio" => $prueba->getNegocio()->getNombre(),
              "fechaAlta" => $prueba->getFechaAlta(), 
              "contenido" => $prueba->getContenido(), 
              "zonas" => $zonasArreglo,       
              "sector" => $prueba->getSector() != null ? $prueba->getSector()->getEtiqueta() : "Ninguno",
              "dispositivo" => $prueba->getDispositivo()->getTipoDispositivo()->getEtiqueta()
            );
            $arregloPruebas[] = $arreglo;
        }

        $pruebas['data'] = $arregloPruebas;
        return response( $pruebas , 200)->header('Content-Type', 'application/json');               
    }


    public function pruebasEstablecimiento( $idEstablecimiento ){
    
        $pruebas = $this->pruebasDao->findByNegocio( $idEstablecimiento );
          
        $arregloPruebas = array();
        foreach( $pruebas as $indice => $prueba ){

            $cadenasArreglo = array();
            foreach( $prueba->getNegocio()->getCadenas() as $indice => $cadena ){
                $arreglo = array(
                    "id" => $cadena->getId(),
                    "etiqueta" => $cadena->getEtiqueta(),
                    "fechaAlta" => $cadena->getFechaAlta(), 
                    "status" => $cadena->getStatus() ? "Activo" : "No activo" 
                ); 
                $cadenasArreglo[] = $arreglo;
            }    

            $zonasArreglo = array();
            if( $prueba->getSector() != null ){
                foreach( $prueba->getSector()->getZonas() as $indice => $zona ){    
                  $arreglo = array(
                      "id" => $zona->getId(),
                      "etiqueta" => $zona->getEtiqueta()
                  );   
                  $zonasArreglo[] = $arreglo;
                }  
            }

            $arreglo = array(
              "id" => $prueba->getId(),      
              "cadenas" => $cadenasArreglo,
              "idNegocio" => $prueba->getNegocio()->getId(),
              "negocio" => $prueba->getNegocio()->getNombre(),
              "fechaAlta" => $prueba->getFechaAlta(), 
              "contenido" => $prueba->getContenido(), 
              "zonas" => $zonasArreglo,       
              "sector" => $prueba->getSector() != null ? $prueba->getSector()->getEtiqueta() : "Ninguno",
              "dispositivo" => $prueba->getDispositivo()->getTipoDispositivo()->getEtiqueta()
            );
            $arregloPruebas[] = $arreglo;
        } 
        return response( $arregloPruebas , 200)->header('Content-Type', 'application/json');  
    } 




    public function activar($token)
    {  
        $negocio = $this->negocioDao->findByToken($token);
        $dispositivo = $this->dispositivoDao->findByToken($token);
        $isOk = $this->checarEstablecimiento( $negocio , $dispositivo );

        if( $negocio->getIdNegocio() == null ){   

            $data = array('code' => 501, 'title' => 'Comunicación No emitida - Problema con registro', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );

        } 
        else if ( $isOk ) {
            
            $this->loggerDao->onlyNotify( "El establecimiento: " . $negocio->getNombre() . " ha realizado una PRUEBA NORMAL." );
            $prueba = $this->creaPrueba( $negocio ,  $dispositivo );
            $data = array('code' => 200, 'title' => 'Prueba emitida correctamente', 'message' => 'Enviada' );
            echo \Response::view('success.200', $data , $data['code'] );   

        } else{
          return  $isOk;
        }  

    }
  
    


    public function checarEstablecimiento( $negocio , $dispositivo )
    {
        if( $negocio == FALSE  ) {  
            $data = array('code' => 404, 'title' => 'Prueba No emitida', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );
        } else if( $negocio->getStatus() == FALSE ) { 
            $data = array('code' => 405, 'title' => 'Prueba No emitida', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );
        } else if(  $dispositivo->getTipoStatus()->getEtiqueta() == 'No Activo' ){
            $data = array('code' => 406, 'title' => 'Prueba No emitida', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );
        } else{
            return true;
        }
    }  
    

    public function creaPrueba( $negocio ,  $dispositivo )
    {      
        $prueba = new Pruebas;
        $prueba->setContenido("Prueba realizada correctamente");
        $prueba->setDispositivo( $dispositivo );
        $prueba->setNegocio( $negocio );

        $idSector = $this->sectorDao->findByLatLng( $negocio->getLongitud() , $negocio->getLatitud() );
        $sector = $this->sectorDao->findById( intval( $idSector["id"] ) ); 
        $prueba->setSector( $sector ); 
        
        $this->pruebasDao->create($prueba);      

        return $prueba;
    }


}

