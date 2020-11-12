<?php

namespace App\Http\Controllers\ServiciosWeb\MPN\Encargado;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* DAOS */       
use App\Daos\EncargadoDao;



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
  protected $encargadoDao; 


  public function __construct(
     
    EncargadoDao $EncargadoDao
  )
  {
    $this->encargadoDao = $EncargadoDao;
  }  

  public function listAll(Request $request){
    
    $firstResult = $request->get('start');
    $maxResult   = $request->get('length');
    $draw        = $request->get('draw');
    $buscar      = $request->get('search')['value'];
    $json = $this->encargadoDao->obtenerEncargados($draw,  $maxResult , $firstResult , $buscar );
    
    return response($json)
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Allow', 'GET, POST, PUT, DELETE, OPTIONS, HEAD')
      ->header('Content-Type', "application/json");
}






public function findByIdCodigoAguila(Request $request){
 
  $listaIds = $request->get('idsEncargados');
  $listaIdsArray = explode(',', $listaIds);
       
  $encargados = $this->encargadoDao->listAllByIDS( $listaIdsArray );   
      
  $arregloEncargados = array();
  foreach( $encargados as $index => $encargado ){

    $arregloEncargado = array(
      "id" => $encargado->getId(),
      "nombre" => $encargado->getNombre(),
      "apellidoPaterno" => $encargado->getApellidoPaterno(),
      "apellidoMaterno" => $encargado->getApellidoMaterno(),
      "telefono" => $encargado->getTelefono(),
      "extension" => $encargado->getExtension(),
      "celular" => $encargado->getCelular(),
      "correo" => $encargado->getCorreo(),
      "status" => $encargado->getStatus(),
      "fechaAlta" => $encargado->getFechaAlta(),
      "tipoEncargado" => $encargado->getTipoEncargado()->getEtiqueta(),
    );

    $arregloEncargados[] = $arregloEncargado;
  }

  
  return response($arregloEncargados)->header('Content-Type', "application/json");
}


}

