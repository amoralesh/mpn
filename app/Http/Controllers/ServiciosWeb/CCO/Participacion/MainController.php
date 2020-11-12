<?php

namespace App\Http\Controllers\ServiciosWeb\CCO\Participacion;

/* CONTROLADOR */ 
use App\Http\Controllers\Controller;
 
 
/* DAOS */
use App\Daos\NegocioDao;
use App\Daos\ParticipacionDao;

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
    
    public function __construct(
        NegocioDao   $NegocioDao,
        ParticipacionDao   $ParticipacionDao) 
    { 
        /* ENTITIES DAO */
        $this->negocioDao    = $NegocioDao;
        $this->participacionDao    = $ParticipacionDao;
    }
    

    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
    /** VALIDADO */
    public function listAllCCO( Request $request )  
    {

        $participacion = $this->participacionDao->listAll();
     
        $arregloParticipacion = array();
        foreach( $participacion as $indice => $participa ){

            $arreglo = array( 
              "id"       => $participa->getId(),      
              "etiqueta" => $participa->getEtiqueta()
            );
            $arregloParticipacion[] = $arreglo;
        }
     
        return response( $arregloParticipacion , 200)->header('Content-Type', 'application/json');               
    

    
}

    
}
