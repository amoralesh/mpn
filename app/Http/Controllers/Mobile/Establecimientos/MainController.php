<?php

namespace App\Http\Controllers\Mobile\Establecimientos;

/* CONTROLADOR */
use App\Http\Controllers\Controller;
  
/* DAOS */   
use App\Daos\NegocioDao;
use App\Daos\UsuariosMobile\UsuarioMobileDao;

/* LIBRERIAS */ 
use Illuminate\Http\Request; 
use Session;
 
class MainController extends Controller
{
   
  /* ENTITIES DAO */ 
  protected $negocioDao;
  protected $usuarioMobileDao;
 
  public function __construct( NegocioDao $NegocioDao, UsuarioMobileDao $UsuarioMobileDao )
  {
    $this->middleware('auth:mobile');    
    $this->negocioDao = $NegocioDao;
    $this->usuarioMobileDao = $UsuarioMobileDao;
  }
 
  
  public function listAllMapa() 
  {   
      $usuario = $this->usuarioMobileDao->findByUser( Session::get('usuario') );        
            
      $establecimientoArreglo = array();
      foreach( $usuario->getNegocios() as $indice => $establecimiento ){
  
          $direccion = "Delegación: " . $establecimiento->getDireccion()->getColonia()->getDelegacion()->getEtiqueta() . " " 
                      . "Colonia: "  . $establecimiento->getDireccion()->getColonia()->getEtiqueta() . " " 
                      . "Calle Principal: "  . $establecimiento->getDireccion()->getCallePrincipal() . " " 
                      . "Calle 1: "  . $establecimiento->getDireccion()->getCalle1() . " " 
                      . "Calle 2: "  . $establecimiento->getDireccion()->getCalle2() . " " 
                      . "Número Exterior: "  . $establecimiento->getDireccion()->getNumeroExterior() ;
            
          $arreglo = array(
              "id"          => $establecimiento->getId(),
              "nombre"      => $establecimiento->getNombre(),   
              "direccion"   => $direccion,
              "telefono"    => $establecimiento->getTelefono(), 
              "lat"         => $establecimiento->getLatitud(), 
              "lng"         => $establecimiento->getLongitud()
          ); 
          $establecimientoArreglo[] = $arreglo;
      } 
      return response( $establecimientoArreglo , 200)->header('Content-Type', 'application/json');
  }

  /* 
    private long id;
    private String nombre;
    private String razonSocial;
    private String tipoNegocio;
    private String piso;
    private String referencia;
    private double latitud;
    private double longitud;
    private String telefono;
    private String extension;
    private String tipoStatus;
    private boolean status;
    private ModelFecha fechaAlta;
    private String callePrincipal;
    private String calle1;
    private String calle2;
    private String numeroInterior;
    private String numeroExterior;
    private List<ModelAlertas> modelAlertasList;
    private List<ModelPruebas> modelPruebasList;
    private int numeroEncargados;
    private int numeroDispositivos;
  
  */
  public function listAllEstablecimientos() {   
      $usuario = $this->usuarioMobileDao->findByUser( Session::get('usuario') );        
            
      $establecimientoArreglo = array();
      foreach( $usuario->getNegocios() as $indice => $establecimiento ){
  
        $direccion = array(
          "latitud"         => $establecimiento->getLatitud(), 
          "longitud"        => $establecimiento->getLongitud(),
          "callePrincipal"  => $establecimiento->getDireccion()->getCallePrincipal(),
          "calle1"          => $establecimiento->getDireccion()->getCalle1(),
          "calle2"          => $establecimiento->getDireccion()->getCalle2(),
          "numeroExterior"  => $establecimiento->getDireccion()->getNumeroExterior(),
          "numeroInterior"  => $establecimiento->getDireccion()->getNumeroInterior()
        ); 

          $arreglo = array(
            "id"                  => $establecimiento->getId(),
            "nombre"              => $establecimiento->getNombre(),   
            "razonSocial"         => $establecimiento->getRazonSocial(),      
            "tipoNegocio"         => $establecimiento->getTipoNegocio()->getEtiqueta(),
            "piso"                => $establecimiento->getPiso(),
            "referencia"          => $establecimiento->getReferencia(),
            "direccion"           => $direccion,
            "numeroEncargados"    => count($establecimiento->getEncargados()),
            "numeroDispositivos"  => count($establecimiento->getDispositivos())
          ); 
          $establecimientoArreglo[] = $arreglo;
      } 
      return response( $establecimientoArreglo , 200)->header('Content-Type', 'application/json');
  }

}

