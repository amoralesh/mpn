<?php

namespace App\Http\Controllers\ServiciosWeb\MPN\Negocio;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* DAOS */   
use App\Daos\NegocioDao;


/* EVENTOS SOCKET */
use App\Events\Establecimientos;
use App\Events\Dispositivos;

/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request; 
use File; 
use Hash;
 
class MainController extends Controller
{
   
  /* ENTITIES DAO */ 
  protected $negocioDao;


  public function __construct(
    NegocioDao $NegocioDao)
  {
    $this->negocioDao = $NegocioDao;
  }  



  public function establecimientos(Request $request){
    
    $firstResult = $request->get('start');
    $maxResult   = $request->get('length');
    $draw        = $request->get('draw');
    $buscar      = $request->get('search')['value'];
    $json = $this->negocioDao->listAllEstablecimientosJson($draw,  $maxResult , $firstResult , $buscar );
    
    return response($json)
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Allow', 'GET, POST, PUT, DELETE, OPTIONS, HEAD')
      ->header('Content-Type', "application/json");


}






public function findByIdCodigoAguila(Request $request){
  
  $listaIds = $request->get('lista');
  $listaIdsArray = explode(',', $listaIds);  


  $negocios = $this->negocioDao->findByIdCodigoAguila( $listaIdsArray ); 


  $arregloNegocios = array();
  foreach( $negocios as $index => $negocio ){

    $arregloNegocio = array(
      "id" => $negocio->getId(),
      "nombre" => $negocio->getNombre(),
      "razonSocial" => $negocio->getRazonSocial(),
      "tipoNegocio" => $negocio->getTipoNegocio()->getEtiqueta(),
      "giroNegocio" => $negocio->getGiroNegocio()->getEtiqueta(),
      "giroNegocioGeneral" => $negocio->getGiroNegocioGeneral()->getEtiqueta(),
      "piso" => $negocio->getPiso(),
      "referencia" => $negocio->getReferencia(), 
      "latitud" => $negocio->getLatitud(),
      "longitud" => $negocio->getLongitud(),
      "telefono" => $negocio->getTelefono(),
      "extension" => $negocio->getExtension(),
      "delegacionDePaso" => $negocio->getDelegacionDePaso(),
      "coloniaDePaso" => $negocio->getColoniaDePaso(),
      "callePrincipal" => $negocio->getDireccion()->getCallePrincipal(),
      "calle1" => $negocio->getDireccion()->getCalle1(),
      "calle2" => $negocio->getDireccion()->getCalle2(),
      "numeroInterior" => $negocio->getDireccion()->getNumeroInterior(),
      "numeroExterior" => $negocio->getDireccion()->getNumeroExterior(),
      "edificio" => $negocio->getDireccion()->getEdificio(),
      "tipoAsentamiento" => $negocio->getDireccion()->getTipoAsentamiento()->getEtiqueta(),
      "nombreAsentamiento" => $negocio->getDireccion()->getNombreAsentamiento(),
      "colonia" => $negocio->getDireccion()->getColonia()->getEtiqueta(),
      "delegacion" => $negocio->getDireccion()->getColonia()->getDelegacion()->getEtiqueta(),
      "codigoPostal" => $negocio->getDireccion()->getCodigoPostal(),
     // "asociacion" => $negocio->getCadenas()->last()->getAsociacion()->getEtiqueta(),
     // "cadena" => $negocio->getCadenas()->last()->getEtiqueta(),
   
      
    );

    $arregloNegocios[] = $arregloNegocio;
  }



  
  return response($arregloNegocios)->header('Content-Type', "application/json");
}



}

