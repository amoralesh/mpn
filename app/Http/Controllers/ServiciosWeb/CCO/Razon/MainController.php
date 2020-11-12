<?php

namespace App\Http\Controllers\ServiciosWeb\CCO\Razon;

/* CONTROLADOR */ 
use App\Http\Controllers\Controller;
 
 
/* DAOS */
use App\Daos\NegocioDao;
use App\Daos\RazonDao;

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
    protected $razonDao;
    
    public function __construct(
        NegocioDao $NegocioDao,
        RazonDao   $RazonDao) 
    { 
        /* ENTITIES DAO */
        $this->negocioDao               = $NegocioDao;
        $this->razonDao                 = $RazonDao;
    }
    

    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
    /** VALIDADO */
    public function listAllCCO( Request $request )  
    {

        $razones              = $this->razonDao->listAllEfectiva();
        $razonesNoEfectivas   = $this->razonDao->listAllNoEfectiva();
     
        $arregloRazones = array();
    


        foreach( $razones as $indice => $razon ){

            $arreglo = array( 
              "id" => $razon->getId(),      
              "etiqueta" => $razon->getEtiqueta()
            );
            $arregloRazones[] = $arreglo;
        }


        foreach( $razonesNoEfectivas as $indice => $razon ){

            $arreglo     = array( 
              "id"       => $razon->getId(),      
              "etiqueta" => $razon->getEtiqueta()
            );
            $arregloRazones[] = $arreglo;
        }
     
  
        
        return \Response::json( $arregloRazones);             
}

    
}

class Razones {
    private $arregloRazones = array();
    private $arregloRazonesNoEfectivas = array();

    public function getArregloRazones(){
        return $this->arregloRazones;
    }

    public function setArregloRazones($arregloRazones){
        $this->arregloRazones = $arregloRazones;
    }

    public function getArregloRazonesNoEfectivas(){
        return $this->arregloRazones;
    }

    public function setArregloRazonesNoEfectivas($arregloRazonesNoEfectivas){
        $this->arregloRazonesNoEfectivas = $arregloRazonesNoEfectivas;
    }
}
