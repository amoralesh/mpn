<?php

namespace App\Http\Controllers\ServiciosWeb\MPNAPP\Encargados;

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
use App\Daos\DelegacionDao;
use App\Daos\TipoEncargadoDao;
use App\Daos\ColoniaDao;
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
    protected $delegacionDao;
    protected $coloniaDao;
    protected $tipoEncargadoDao;
      
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
      ,DelegacionDao $DelegacionDao
      ,TipoEncargadoDao $TipoEncargadoDao
      ,ColoniaDao $ColoniaDao
      ,EntrevistadorDao $EntrevistadorDao )
    {   
      /* ENTITIES DAO */
        //$this->middleware('hasPermission:Administracion:Rest:Alertas',[ 'only' => [ 'listAll' , 'alertasEstablecimiento' ]] );

      $this->alertaDao         = $AlertaDao;
      $this->pruebasDao        = $PruebasDao;
      $this->dispositivoDao    = $DispositivoDao;
      $this->entrevistadoDao   = $EntrevistadoDao;
      $this->entrevistadorDao  = $EntrevistadorDao;
      $this->reportaDao        = $ReportaDao;
      $this->razonDao          = $RazonDao;
      $this->participacionDao  = $ParticipacionDao;
      $this->tipoAlarmaDao     = $TipoAlarmaDao;
      $this->motivoAlarmaDao   = $MotivoAlarmaDao;
      $this->tipoStatusDao     = $TipoStatusDao;
      $this->negocioDao        = $NegocioDao;
      $this->sectorDao         = $SectorDao;
      $this->delegacionDao     = $DelegacionDao;
      $this->tipoEncargadoDao  = $TipoEncargadoDao;
      $this->coloniaDao       = $ColoniaDao;
      $this->motivoAltaBajaDao = $MotivoAltaBajaDao;
      $this->logDao            = $LogDao;
    }  
    

    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
    /** VALIDADO */
    public function listAllMPNAPPEncargados( Request $request )  
    {


        $encargados = $this->tipoEncargadoDao->listAll();
     
        $arregloEncargados = array();
        foreach( $encargados as $indice => $encargado ){

            $arreglo = array( 
              "id" => $encargado->getId(),      
              "etiqueta" => $encargado->getEtiqueta()
            );
            $arregloEncargados[] = $arreglo;
        }
     
        return response( $arregloEncargados , 200)->header('Content-Type', 'application/json');               
    }





}

