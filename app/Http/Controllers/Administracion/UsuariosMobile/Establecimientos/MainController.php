<?php
namespace App\Http\Controllers\Administracion\UsuariosMobile\Establecimientos;

use App\Entities\UsuariosMobile\UsuarioMobile;
use App\Entities\Logger;
    
use App\Daos\NegocioDao;
use App\Daos\UsuariosMobile\UsuarioMobileDao;
use App\Daos\LoggerDao;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Request; 
use Hash;
use Session;
use File;   
  

class MainController extends Controller
{
    protected $negocioDao;
    protected $usuarioMobileDao;
    protected $loggerDao;

    public function __construct(NegocioDao $NegocioDao
        ,UsuarioMobileDao $UsuarioMobileDao
        ,LoggerDao $LoggerDao)
    {
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Establecimientos',[ 'only' => ['index','show']] );
        $this->negocioDao = $NegocioDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->loggerDao = $LoggerDao;
    }   
   
   
    public function index()
    {   
        return view('administracion.usuariosMobile.establecimientos.index');
    }        
      
  
    public function addEstablecimiento( Request $request )
    {   
        $idEstablecimiento = $request::get('idEstablecimiento');
        $idUsuario = $request::get('idUsuario');
   
        $usuario = $this->usuarioMobileDao->findById( $idUsuario );   
        $establecimiento = $this->negocioDao->findById( $idEstablecimiento );
        
        $establecimiento->addUsuariosMobile( $usuario );  
        //$usuario->addNegocio( $establecimiento );  
         
        $this->negocioDao->update( $establecimiento );     

        return response( 200 , 200)->header('Content-Type', 'application/json');

    }




    public function removeEstablecimiento( Request $request )
    {   
        $idEstablecimiento = $request::get('idEstablecimiento');
        $idUsuario = $request::get('idUsuario');

        $usuario = $this->usuarioMobileDao->findById( $idUsuario );
        $establecimiento = $this->negocioDao->findById( $idEstablecimiento );
             
        $usuario->removeNegocio( $establecimiento );

        $this->usuarioMobileDao->update( $usuario );
        
        return response( 200 , 200)->header('Content-Type', 'application/json');
    }

  

    /* SERVICIOS WEB */
    public function listAllJson()
    {
        $usuarios = $this->usuarioMobileDao->listAll();
        
        $arrayUsuarios = array();     
        foreach( $usuarios as $indice => $usuario ){
            
            $arrayEstablecimientos = array();  
            foreach( $usuario->getNegocios() as $indice => $establecimiento ){
                $arrayEstablecimiento = array(  
                    'id' => $establecimiento->getId(),
                    'nombre' => $establecimiento->getNombre(),
                    'razonSocial' => $establecimiento->getRazonSocial(),
                    'direccion' => $establecimiento->getDireccion()->getCallePrincipal() . " " . $establecimiento->getDireccion()->getCalle1() , 
                    'giroNegocio' => $establecimiento->getGiroNegocio()->getEtiqueta(), 
                    'fechaAlta' => $establecimiento->getFechaAlta(),
                    'status' => $establecimiento->getStatus()
                );  
                $arrayEstablecimientos[] = $arrayEstablecimiento;
            }

            $arrayUsuario = array(
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'apellidoPaterno' => $usuario->getApellidoPaterno(),
                'apellidoMaterno' => $usuario->getApellidoMaterno(),
                'depend' => $usuario->getInstitucionLabora()->getNombre(),
                'email' => $usuario->getEmail(),
                'usuario' => $usuario->getUsuario(),
                'status' => $usuario->getStatus(),
                'establecimientos' => $arrayEstablecimientos
            );  

            $arrayUsuarios[] = $arrayUsuario;
        }

        return response( $arrayUsuarios , 200)->header('Content-Type', 'application/json');

    }



  
}

