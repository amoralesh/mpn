<?php

namespace App\Http\Controllers\Administracion\Alertas;

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
use App\Daos\LoggerDao;
use App\Daos\DivisionTerritorial\SectorDao;
use App\Daos\PID\AlertaDao as AlertaPIDDao;

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
    protected $alertaPIDDao;
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
    protected $loggerDao;
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
      ,LoggerDao $LoggerDao
      ,EntrevistadoDao $EntrevistadoDao    
      ,SectorDao $SectorDao
      ,AlertaPIDDao $AlertaPIDDao
      ,EntrevistadorDao $EntrevistadorDao )
    {   
      /* ENTITIES DAO */
        $this->middleware('hasPermission:Administracion:Rest:Alertas',[ 'only' => [ 'listAll' , 'alertasEstablecimiento' ]] );

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
        $this->loggerDao = $LoggerDao;
        $this->alertaPIDDao       = $AlertaPIDDao;
    }  
    
    public function index()
    {
      return view('administracion.alertas.index');  
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

    
            $arreglo = array( 
              "id" => $alerta->getId(),      
              "cadenas" => $cadenasArreglo,

              "idNegocio" => $alerta->getNegocio()->getId(),
              "negocio" => $alerta->getNegocio()->getNombre(),
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



    public function alertasEstablecimiento( $idEstablecimiento ){

        $alertas = $this->alertaDao->findByNegocio( $idEstablecimiento );
          
        $arregloAlertas = array();
        foreach( $alertas as $indice => $alerta ){

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
            $arreglo = array(
                "id" => $alerta->getId(),      
                "cadenas" => $cadenasArreglo,
                "idNegocio" => $alerta->getNegocio()->getId(),
                "negocio" => $alerta->getNegocio()->getNombre(),
                "fechaAlta" => $alerta->getFechaAlta(), 
                "tipoAlarma" => $alerta->getTipoAlarma()->getEtiqueta(),
                "tipoStatus" => $alerta->getTipoStatus()->getEtiqueta(),   
                "zonas" => $zonasArreglo,         
                "sector" => $alerta->getSector() != null ? $alerta->getSector()->getEtiqueta() : "Ninguno",
                "motivoAlarma" => $alerta->getMotivoAlarma() != null ? $alerta->getMotivoAlarma()->getEtiqueta() : "No asignado",
                "dispositivo" => $alerta->getDispositivo()->getTipoDispositivo()->getEtiqueta(),
            );
            $arregloAlertas[] = $arreglo;
        }
        return response( $arregloAlertas , 200)->header('Content-Type', 'application/json');  
    }





   

    public function activar($token)
    {    
        
        $negocio = $this->negocioDao->findByToken($token);    
        $dispositivo = $this->dispositivoDao->findByToken($token);

        /** PRUEBAS DE ALERTAS REALES */
        if( $dispositivo->getTipoStatus()->getId() == 5 )
        {
            $this->creaPrueba( $negocio ,  $dispositivo );
            $this->loggerDao->onlyNotify( "El establecimiento: " . $negocio->getNombre() . " ha realizado una PRUEBA REAL." );
            $data = array('code' => 210, 'title' => 'Prueba enviada', 'message' => 'OK' );
            return \Response::view('success.407', $data , $data['code'] );
        }
        else
        { 
                $isOk = $this->checarEstablecimiento( $negocio , $dispositivo );
                /** CALCULO DE LA DIFERENCIA DE TIEMPO */
                $diferenciaDeTiempo = 4;
                if(  $negocio->getAlarmas()->last() != null ){
                    $diferenciaDeTiempo = $negocio->getAlarmas()->last()->getFechaAlta()->diff( new \DateTime() );
                    $diferenciaDeTiempo = $diferenciaDeTiempo->i;
                }
                
                // CONDICION 
                if( $diferenciaDeTiempo < 3 ){  
                
                    $data = array('code' => 200, 'title' => 'Comunicación emitida correctamente', 'message' => 'Enviada ' . $diferenciaDeTiempo );
                    return \Response::view('success.200', $data , $data['code'] );  
                
                } else { 

                        if ( $isOk ) {

                            $alerta = $this->creaAlerta( $negocio ,  $dispositivo );
                            $recieved = $this->alertaPIDDao->create( $negocio );
                               
                            if( $recieved != true){ 
                            
                                $data = array('code' => 501, 'title' => 'Comunicación No emitida - Problema con registro', 'message' => 'No enviada' );
                                return \Response::view('errors.errores', $data , $data['code'] );
                                
                            } else {
                                
                                $this->enviarWasatch( $alerta );
                                $data = array('code' => 200, 'title' => 'Comunicación emitida correctamente', 'message' => 'Enviada' );
                                return \Response::view('success.200', $data , $data['code'] );  
                            }
                
                        } else{
                        return  $isOk;
                        }  
                }// 3 MINUTOS
        }
    } 


    public function checarEstablecimiento( $negocio , $dispositivo )
    {
        if( $negocio == FALSE  ) { // ERORR
            $data = array('code' => 404, 'title' => 'Comunicación No emitida', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );
        } else if( $negocio->getStatus() == FALSE ) {  // ERORR
            $data = array('code' => 415, 'title' => 'Comunicación No emitida', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );
        } else if( $dispositivo->getStatus() == FALSE ){ // ERORR
            $data = array('code' => 416, 'title' => 'Comunicación No emitida', 'message' => 'No enviada' );
            echo \Response::view('errors.errores', $data , $data['code'] );
        }  else{     
            return true; 
        }       
    }


    public function creaAlerta( $negocio ,  $dispositivo )
    {  
        $alerta = new Alarma;   
        $tipoAlarmaE = $this->tipoAlarmaDao->findById( 1 ); 
        $alerta->setTipoAlarma( $tipoAlarmaE );

        //$motivoAlarmaE = $this->motivoAlarmaDao->findById( 1 );
        //$alerta->setMotivoAlarma( $motivoAlarmaE );

        $tipoStatusE = $this->tipoStatusDao->findById( 3 );
        $alerta->setTipoStatus( $dispositivo->getTipoStatus() );
        $alerta->setNegocio( $negocio );

        $idSector = $this->sectorDao->findByLatLng( $negocio->getLongitud() , $negocio->getLatitud() );
        $sector = $this->sectorDao->findById( intval( $idSector["id"] ) ); 
        
        $alerta->setSector( $sector );
        $alerta->setStatus( true );
        $alerta->setDispositivo( $dispositivo );
        $alerta = $this->alertaDao->create( $alerta );
    
        $negocio->setTipoStatus( $tipoStatusE );
        $this->negocioDao->update($negocio);

        return $alerta;
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
    }

    
    
    public function enviarWasatch( $alerta )
    {
        /** WASATCH */
        $wsdl   = "http://10.13.8.216/wasatch/WW-ControllerProg.asmx?WSDL";
        $client = new \nusoap_client('http://10.13.8.216/Pid/WW-PidProg.asmx?WSDL', true);
        $err = $client->getError();
        if ($err) {
          echo '<h2>client error</h2><pre>' . $err . '</pre>';
        }


        $direccion = "Delegación: " . $alerta->getNegocio()->getDireccion()->getColonia()->getDelegacion()->getEtiqueta() . " " 
        . "Colonia: "  . $alerta->getNegocio()->getDireccion()->getColonia()->getEtiqueta() . " " 
        . "Calle Principal: "  . $alerta->getNegocio()->getDireccion()->getCallePrincipal() . " " 
        . "Calle 1: "  . $alerta->getNegocio()->getDireccion()->getCalle1() . " " 
        . "Calle 2: "  . $alerta->getNegocio()->getDireccion()->getCalle2() . " " 
        . "Número Exterior: "  . $alerta->getNegocio()->getDireccion()->getNumeroExterior() ;


        $param = array(
          'Id'       => intval($alerta->getId()),     
          'Comercio' => $alerta->getNegocio()->getNombre(),    
          'Direccion'=> $direccion,
          'Longitud' => doubleval($alerta->getNegocio()->getLongitud()), 
          'Latitud'  => doubleval($alerta->getNegocio()->getLatitud()),
          'Fecha'    => $alerta->getFechaAlta()->format('d/m/Y H:i:s')
        );

        $result = $client->call('EmergenciaPid', $param);

        if ($client->fault) {

          echo '<h2>Fault</h2><pre>';
          print_r($result);
          echo '</pre>';

        } else {
            $err = $client->getError();
            if ($err) {
              return false;
            } else { 
              echo 'W - OK';
              return true;
            }
        }
    }


    public function enviarCCO( $negocio ){

      try{

        $data = array(
          
          "id" => $negocio->getId(),
          "nombre" => $negocio->getNombre(),
          "razonSocial" => $negocio->getRazonSocial(),
          "piso" => $negocio->getPiso(),
          "referencia" => $negocio->getReferencia(),
          "latitud" => $negocio->getLatitud(),
          "longitud" => $negocio->getLatitud(),
          "telefono" => $negocio->getTelefono(),
          "extension" => $negocio->getExtension(),
          "status" => $negocio->getStatus(),
          "fechaAlta" => $negocio->getFechaAlta(),
          "delegacionDePaso" => $negocio->getDelegacionDePaso(),
          "coloniaDePaso" => $negocio->getColoniaDePaso(),

          "asociacion" => $negocio->getCadena()->getAsociacion()->getEtiqueta(),
          "cadena" => $negocio->getCadena()->getEtiqueta(),
          "giroNegocio" => $negocio->getGiroNegocio()->getEtiqueta(),
          "tipoNegocio" => $negocio->getTipoNegocio()->getEtiqueta(),
          "giroNegocioGeneral" => $negocio->getGiroNegocioGeneral()->getEtiqueta(),
          "tipoDispositivo" => $negocio->getDispositivos()->getTipoDispositivo()->getEtiqueta(),
          "statusRevision" => $negocio->getStatusRevisionNegocio()->getEtiqueta(),

          "nombrePlaza" => $negocio->getPlaza()->getEtiqueta(),
          "alias" => $negocio->getPlaza()->getAlias(),
          "telefonoPlaza" => $negocio->getPlaza()->getTelefono(),
          "extensionPlaza" => $negocio->getPlaza()->getExtension(),

          "colonia" => $negocio->getDireccion()->getColonia()->getEtiqueta(),
          "delegacion" => $negocio->getDireccion()->getColonia()->getDelegacion()->getEtiqueta(),
          "callePrincipal" => $negocio->getDireccion()->getCallePrincipal(),
          "calle1" => $negocio->getDireccion()->getCalle1(),
          "calle2" => $negocio->getDireccion()->getCalle2(),
          "numeroInterior" => $negocio->getDireccion()->getNumeroInterior(),
          "numeroExterior" => $negocio->getDireccion()->getNumeroExterior(),
          "edificio" => $negocio->getDireccion()->getEdificio(),
          "codigoPostal" => $negocio->getDireccion()->getCodigoPostal(), 
        
          "nombreEncargado" => $negocio->getEncargados()->getNombre(),
          "apellidoPaternoEncargado" => $negocio->getEncargados()->getApellidoPaterno(),
          "apellidoMaternoEncargado" => $negocio->getEncargados()->getApellidoMaterno(),
          "telefonoEncargado" => $negocio->getEncargados()->getTelefono(),
          "extensionEncargado" => $negocio->getEncargados()->getExtension(),
          "celularEncargado" => $negocio->getEncargados()->getCelular(),
          "correoEncargado" => $negocio->getEncargados()->getCorreo(),

          "tipoAlarma" => $negocio->getAlarmas()->getTipoAlarma()->getEtiqueta(),
          "motivoAlarma" => $negocio->getAlarmas()->getMotivoAlarma()->getEtiqueta(),
          "zona" => $negocio->getAlarmas()->getZona(),
          "sector" => $negocio->getAlarmas()->getSector()

        );
      
        $client = new \GuzzleHttp\Client( );
        $request =$client->post("http://10.13.73.116:8080/ccobackend/rest/mipolicia/negocio", array( 'content-type' => 'application/json' ) , $data );
        $response = $request->send();
      
      } catch ( Exception $e){
 
      }
    }


  
        


}

