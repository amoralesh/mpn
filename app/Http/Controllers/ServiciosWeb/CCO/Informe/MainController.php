<?php

namespace App\Http\Controllers\ServiciosWeb\CCO\Informe;

/* CONTROLADOR */ 
use App\Http\Controllers\Controller;


/* ENTITIES */ 
use App\Entities\Informe;
use App\Entities\Entrevistado;
use App\Entities\Entrevistador;
 
 
/* DAOS */
use App\Daos\NegocioDao;
use App\Daos\ParticipacionDao;
use App\Daos\RazonDao;
use App\Daos\ReportaDao;
use App\Daos\EntrevistadoDao;
use App\Daos\EntrevistadorDao;
use App\Daos\InformeDao;
use App\Daos\AlertaDao;

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request;
use File;
use Hash;
use Session;

class MainController extends Controller
{
    
    /* ENTITIES DAO */
    protected $negocioDao;
    protected $participacionDao;
    protected $razonDao;
    protected $reportaDao;
    protected $entrevistadoDao;
    protected $entrevistadorDao;
    protected $informeDao;
    protected $alertaDao;
    
    public function __construct(
        NegocioDao         $NegocioDao,
        ParticipacionDao   $ParticipacionDao,
        RazonDao           $RazonDao,
        ReportaDao         $ReportaDao,
        EntrevistadoDao    $EntrevistadoDao,
        EntrevistadorDao   $EntrevistadorDao,
        InformeDao         $InformeDao,
        AlertaDao          $AlertaDao) 
    { 
        /* ENTITIES DAO */
        $this->negocioDao          = $NegocioDao;
        $this->participacionDao    = $ParticipacionDao;
        $this->razonDao            = $RazonDao;
        $this->reportaDao          = $ReportaDao;
        $this->entrevistadoDao     = $EntrevistadoDao;
        $this->entrevistadorDao    = $EntrevistadorDao;
        $this->informeDao          = $InformeDao;
        $this->alertaDao           = $AlertaDao;
    }
    

    public function crearInformeCCO ( Request $request  )  
    {     
         
          $idAlerta                     = $request->get("idAlerta");
          $idReporta                    = $request->get("idReporta");
          $idRazon                      = $request->get("idRazon");
          $idParticipa                  = $request->get("idParticipa");
          $contenido                    = $request->get("contenido");
          $numeroDetenidos              = $request->get("numeroDetenidos");
          $tiempoRespuesta              = $request->get("tiempoRespuesta");
          $folioPap                     = $request->get("folioPap");
          $folioSip                     = $request->get("folioSip");
          $entrevistados                = $request->get("entrevistados");
          $entrevistadores              = $request->get("entrevistadores");

          if( $entrevistados == null ) {
            return response("El dato 'entrevistados' no debe contener valores Nulos",400);
          }
          if( $entrevistadores == null ) {
            return response("El dato 'entrevistadores' no debe contener valores Nulos",400);
          }
          if( $idReporta == null ) {
              return response("El dato 'idReporta' no debe contener valores Nulos",400);
          }
          if( $idRazon == null ) {
            return response("El dato 'idRazon' no debe contener valores Nulos",400);
          }
          if( $idAlerta == null ) {
            return response("El dato 'idAlerta' no debe contener valores Nulos",400);
          }
          if( $contenido == null ) {
            return response("El dato 'contenido' no debe contener valores Nulos",400);
          }
          if( $tiempoRespuesta == null ) {
            return response("El dato 'tiempoRespuesta' no debe contener valores Nulos",400);
          }

          $alerta  = $this->alertaDao->findById($idAlerta);
          if($alerta == null){
            return response("No existe la alerta consultada" , 404);
          } 

          $informe = new Informe;
          $informe->setContenido( $contenido);
          $informe->setNumeroDetenidos($numeroDetenidos);
          $razonesD  = $this->razonDao->findById($idRazon);
          $informe->setRazon($razonesD);
        
          $reportaD  = $this->reportaDao->findById($idReporta);
          $informe->setReporta($reportaD);
          
          $informe->setParticipacion( null ); 
          if( $idParticipa != null ||  $idParticipa != 0 ){
            $participacionD = $this->participacionDao->findById($idParticipa);
            $informe->setParticipacion($participacionD);
          }

          $informe->setTiempoRespuesta($tiempoRespuesta);   
          $informe->setFolioPap($folioPap);
          $informe->setFolioSip($folioSip);

          $arrayEntrevistados  = array();
          for ($i = 0; $i < count( $entrevistados ); $i++) {
            $entrevistado = new Entrevistado;
            $entrevistado->setNombre($entrevistados[$i]['nombre']);
            $entrevistado->setAPaterno($entrevistados[$i]['apellidoMaterno']);
            $entrevistado->setAMaterno($entrevistados[$i]['apellidoPaterno']);
            $entrevistado->setEdad( $entrevistados[$i]['edad']);
            $entrevistado->setInforme($informe);
            $arrayEntrevistados[] = $entrevistado;  
          }
          $informe->setEntrevistados($arrayEntrevistados);
    

          $arrayEntrevistadores = array();
          for ($i = 0; $i < count( $entrevistadores ); $i++) {
            $entrevistador = new Entrevistador;
            $entrevistador->setNombre($entrevistadores[$i]['nombre']);
            $entrevistador->setAPaterno($entrevistadores[$i]["apellidoMaterno"]);
            $entrevistador->setAMaterno($entrevistadores[$i]["apellidoPaterno"]);
            $entrevistador->setEdad( $entrevistadores[$i]["edad"] ) ;
            $entrevistador->setInforme($informe); 
            $arrayEntrevistadores[] = $entrevistador;
          }

          $informe->setEntrevistadores($arrayEntrevistadores);   
          $alerta->setInforme( array($informe ));
          $informe->setAlarma( $alerta );
          $informeCreado = $this->informeDao->create($informe);

          
 
          return response( "Informe Creado" , 200)->header('Content-Type', 'application/json'); 
    } 


    
}
