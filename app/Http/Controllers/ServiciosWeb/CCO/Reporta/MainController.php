<?php

namespace App\Http\Controllers\ServiciosWeb\CCO\Reporta;

/* CONTROLADOR */ 
use App\Http\Controllers\Controller;
 
 
/* DAOS */
use App\Daos\NegocioDao;
use App\Daos\ReportaDao;

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
    protected $reportaDao;
    
    public function __construct(
        NegocioDao   $NegocioDao,
        ReportaDao   $ReportaDao) 
    { 
        /* ENTITIES DAO */
        $this->negocioDao    = $NegocioDao;
        $this->reportaDao    = $ReportaDao;
    }
    

    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
    /** VALIDADO */
    public function listAllCCO( Request $request )  
    {

        $reportes = $this->reportaDao->listAll();
     
        $arregloReporta = array();
        foreach( $reportes as $indice => $reporta ){

            $arreglo = array( 
              "id" => $reporta->getId(),      
              "etiqueta" => $reporta->getEtiqueta()
            );
            $arregloReporta[] = $arreglo;
        }
     
        return response( $arregloReporta , 200)->header('Content-Type', 'application/json');               
    

    
}

    
}
