<?php

namespace App\Http\Controllers\ServiciosWeb\CCO\Alertas;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
 
/* ENTITIES */  
use App\Entities\Alarma;
use App\Entities\Informe;
use App\Entities\Entrevistado;
use App\Entities\Entrevistador;
use App\Entities\MotivoAltaBaja;   
use App\Entities\Pruebas;   

/* DAOS */  
use App\Daos\AlertaDao;
use App\Daos\PruebasDao;  
use App\Daos\DispositivoDao;
use App\Daos\EntrevistadoDao;
use App\Daos\EntrevistadorDao;
use App\Daos\ReportaDao;
use App\Daos\RazonDao;
use App\Daos\ParticipacionDao;
use App\Daos\TipoAlarmaDao;
use App\Daos\MotivoAlarmaDao;
use App\Daos\NegocioDao;
use App\Daos\TipoStatusDao; 
use App\Daos\MotivoAltaBajaDao;
use App\Daos\LogDao;
use App\Daos\DivisionTerritorial\SectorDao;

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;  
use Predis\Connection\ConnectionException;
use Session;
use File;  
use nusoap_client;
use SoapClient;
   
class MainController extends Controller
{
    
    /* ENTITIES DAO */    
    protected $alertaDao;
    protected $pruebasDao;
    protected $dispositivoDao;
    protected $entrevistadoDao;
    protected $entrevistadorDao;
    protected $tipoAlarmaDao;
    protected $razonDao;
    protected $motivoAlarmaDao;
    protected $tipoStatusDao;
    protected $negocioDao;
    protected $motivoAltaBajaDao;
    protected $reportaDao;
    protected $participacionDao;
    protected $logDao;
    protected $sectorDao;
      
    public function __construct (
      AlertaDao $AlertaDao
      ,PruebasDao $PruebasDao
      ,DispositivoDao $DispositivoDao
      ,ReportaDao $ReportaDao
      ,RazonDao $RazonDao
      ,ParticipacionDao $ParticipacionDao
      ,TipoAlarmaDao $TipoAlarmaDao
      ,TipoStatusDao $TipoStatusDao
      ,MotivoAlarmaDao $MotivoAlarmaDao
      ,NegocioDao $NegocioDao
      ,MotivoAltaBajaDao $MotivoAltaBajaDao
      ,LogDao $LogDao
      ,EntrevistadoDao $EntrevistadoDao
      ,SectorDao $SectorDao
      ,EntrevistadorDao $EntrevistadorDao )
    {   
      /* ENTITIES DAO */
        //$this->middleware('hasPermission:Administracion:Rest:Alertas',[ 'only' => [ 'listAll' , 'alertasEstablecimiento' ]] );

      $this->alertaDao = $AlertaDao;
      $this->pruebasDao = $PruebasDao;
      $this->dispositivoDao = $DispositivoDao;
      $this->entrevistadoDao = $EntrevistadoDao;
      $this->entrevistadorDao = $EntrevistadorDao;
      $this->reportaDao = $ReportaDao;
      $this->razonDao = $RazonDao;
      $this->participacionDao = $ParticipacionDao;
      $this->tipoAlarmaDao = $TipoAlarmaDao;
      $this->motivoAlarmaDao = $MotivoAlarmaDao;
      $this->tipoStatusDao = $TipoStatusDao;
      $this->negocioDao = $NegocioDao;
      $this->sectorDao = $SectorDao;
      $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
      $this->logDao = $LogDao;
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
        

        $alertas = $this->alertaDao->listAll( $fechaInicio , $fechaFin, $draw,  $maxResult , $firstResult , $buscar );
       
        $arregloAlertas = array();
        foreach( $alertas['data'] as $indice => $alerta ){

            $cadenasArreglo = array();
            foreach( $alerta->getNegocio()->getCadenas() as $indice => $cadena ){
                $arreglo = array(
                    "id" => $cadena->getId(),
                    "etiqueta" => $cadena->getEtiqueta(),
                    "fechaAlta" => $cadena->getFechaAlta(), 
                    "status" => $cadena->getStatus() ? "Activo" : "No activo" 
                ); 
                $cadenasArreglo[] = $arreglo;
            }    

            $zonasArreglo = array();
            if( $alerta->getSector() != null ){
                foreach( $alerta->getSector()->getZonas() as $indice => $zona ){    
                  $arreglo = array(
                      "id" => $zona->getId(),
                      "etiqueta" => $zona->getEtiqueta()
                  ); 
                  $zonasArreglo[] = $arreglo;
                }  
            }

            $direccionArreglo = array(
                "colonia" => $alerta->getNegocio()->getDireccion()->getColonia()->getEtiqueta(),
                "delegacion" => $alerta->getNegocio()->getDireccion()->getColonia()->getDelegacion()->getEtiqueta(),
                "callePrincipal" => $alerta->getNegocio()->getDireccion()->getCallePrincipal(),
                "calle1" => $alerta->getNegocio()->getDireccion()->getCalle1(),
                "calle2" => $alerta->getNegocio()->getDireccion()->getCalle2(),
                "numeroInterior" => $alerta->getNegocio()->getDireccion()->getNumeroInterior(),
                "numeroExterior" => $alerta->getNegocio()->getDireccion()->getNumeroExterior(),
                "edificio" => $alerta->getNegocio()->getDireccion()->getEdificio(),
                "codigoPostal" => $alerta->getNegocio()->getDireccion()->getCodigoPostal()
            ); 
             
    
            $arreglo = array( 
              "id" => $alerta->getId(),      
              "cadenas" => $cadenasArreglo,  
              "idNegocio" => $alerta->getNegocio()->getId(),

              "latitud" => $alerta->getNegocio()->getLatitud(), 
              "longitud" => $alerta->getNegocio()->getLongitud(),
 
              "idNegocio" => $alerta->getNegocio()->getId(),
              "fechaAltaNegocio" => $alerta->getNegocio()->getFechaAlta(), 
              "direccionNegocio" => $direccionArreglo,
              "negocio" => $alerta->getNegocio()->getNombre(),
            
              "referenciaNegocio" => $alerta->getNegocio()->getReferencia(),
              "giroNegocio" => $alerta->getNegocio()->getGirONegocioGeneral()->getEtiqueta(),

              
              "fechaAlta" => $alerta->getFechaAlta(), 
              "tipoAlarma" => $alerta->getTipoAlarma() != null ?  $alerta->getTipoAlarma()->getEtiqueta() : "No asignado",
              "tipoStatus" => $alerta->getTipoStatus()->getEtiqueta(),   
              "zonas" => $zonasArreglo,       
              "sector" => $alerta->getSector() != null ? $alerta->getSector()->getEtiqueta() : "Ninguno",
              "motivoAlarma" => $alerta->getMotivoAlarma()  != null ? $alerta->getMotivoAlarma()->getEtiqueta(): "No asignado",
              "dispositivo" => $alerta->getDispositivo()->getTipoDispositivo()->getEtiqueta(),
            );
            $arregloAlertas[] = $arreglo;
        }  
        $alertas['data'] = $arregloAlertas;
        return response( $alertas , 200)->header('Content-Type', 'application/json');               
    }


       /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
    /** VALIDADO */
    public function listAllCCO( Request $request  )  
    {

        $ultimoId    = $request->get('ultimoId');

        $fechaInicio  = new \DateTime();
        $fechaFin     = new \DateTime();

        $sectores    = $request->get('sectores');
        
        $alertas = $this->alertaDao->listAllCCO(  $ultimoId, $fechaInicio , $fechaFin , $sectores);
        //return response( $alertas , 200)->header('Content-Type', 'application/json');            
 
        $arregloAlertas = array();
        foreach( $alertas as $indice => $alerta ){

            $cadenasArreglo = array();
            foreach( $alerta->getNegocio()->getCadenas() as $indice => $cadena ){
                $arreglo = array(
                    "id" => $cadena->getId(),
                    "etiqueta" => $cadena->getEtiqueta(),
                ); 
                $cadenasArreglo[] = $arreglo;
            }    

            $zonasArreglo = array();
            if( $alerta->getSector() != null ){
                foreach( $alerta->getSector()->getZonas() as $indice => $zona ){    
                  $arreglo = array(
                      "id" => $zona->getId(),
                      "etiqueta" => $zona->getEtiqueta()
                  ); 
                  $zonasArreglo[] = $arreglo;
                }  
            }

            $direccionArreglo = array(
                "colonia" => $alerta->getNegocio()->getDireccion()->getColonia()->getEtiqueta(),
                "delegacion" => $alerta->getNegocio()->getDireccion()->getColonia()->getDelegacion()->getEtiqueta(),
                "callePrincipal" => $alerta->getNegocio()->getDireccion()->getCallePrincipal(),
                "calle1" => $alerta->getNegocio()->getDireccion()->getCalle1(),
                "calle2" => $alerta->getNegocio()->getDireccion()->getCalle2(),
                "numeroInterior" => $alerta->getNegocio()->getDireccion()->getNumeroInterior(),
                "numeroExterior" => $alerta->getNegocio()->getDireccion()->getNumeroExterior(),
                "codigoPostal" => $alerta->getNegocio()->getDireccion()->getCodigoPostal()
            ); 
             
    
            $arreglo = array( 
              "id" => $alerta->getId(),      
              "cadenas" => $cadenasArreglo,  
              "idNegocio" => $alerta->getNegocio()->getId(),

              "latitud" => $alerta->getNegocio()->getLatitud(), 
              "longitud" => $alerta->getNegocio()->getLongitud(),
 
              "idNegocio" => $alerta->getNegocio()->getId(),
              "fechaAltaNegocio" => $alerta->getNegocio()->getFechaAlta(), 
              "direccionNegocio" => $direccionArreglo,
              "negocio" => $alerta->getNegocio()->getNombre(),

              "referenciaNegocio" => $alerta->getNegocio()->getReferencia(),
              "giroNegocio" => $alerta->getNegocio()->getGirONegocioGeneral()->getEtiqueta(),
              "fechaAlta" => $alerta->getFechaAlta(),  
              "zonas" => $zonasArreglo,       
              "sector" => $alerta->getSector() != null ? $alerta->getSector()->getEtiqueta() : "Ninguno",
              "dispositivo" => $alerta->getDispositivo()->getTipoDispositivo()->getEtiqueta(),
            );
            $arregloAlertas[] = $arreglo;
        }
        return response( $arregloAlertas , 200)->header('Content-Type', 'application/json');            
        
    }





}

