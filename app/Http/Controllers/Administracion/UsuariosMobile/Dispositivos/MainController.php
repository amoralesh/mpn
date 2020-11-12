<?php
namespace App\Http\Controllers\Administracion\UsuariosMobile\Dispositivos;
 
use App\Entities\UsuariosMobile\UsuarioMobile;
use App\Entities\Logger;
  
use App\Daos\Dispositivos\DispositivoDao;
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
    protected $dispositivoDao;
    protected $usuarioMobileDao;
    protected $loggerDao;

    public function __construct(
        DispositivoDao $DispositivoDao
        ,UsuarioMobileDao $UsuarioMobileDao
        ,LoggerDao $LoggerDao)
    {
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Mobile:Usuarios:Dispositivos',[ 'only' => ['index','show']] );
        $this->dispositivoDao = $DispositivoDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->loggerDao = $LoggerDao;
    }
   
    public function index()
    { 
      return view('administracion.usuariosMobile.dispositivos.index');
    }


    
    public function addDispositivo( Request $request )
    {   
        $idUnico = $request::get('idUnico');
        $idUsuario = $request::get('idUsuario');
  
        $usuario = $this->usuarioMobileDao->findById( $idUsuario );
        $dispositivo = $this->dispositivoDao->findByIdUnico( $idUnico );
 
        $usuario->addDispositivo( $dispositivo );
        
        $this->usuarioMobileDao->update( $usuario );
    }


    public function removeDispositivo( Request $request )
    {   
        $idUnico = $request::get('idUnico');
        $idUsuario = $request::get('idUsuario');

        $usuario = $this->usuarioMobileDao->findById( $idUsuario );
        $dispositivo = $this->dispositivoDao->findByIdUnico( $idUnico );
         
        $usuario->removeDispositivo( $dispositivo );

        $this->usuarioMobileDao->update( $usuario );
    }



    public function listAllJson()
    {
        $usuarios = $this->usuarioMobileDao->listAll();   

        $arrayUsuarios = array();  
        foreach( $usuarios as $indice => $usuario ){
            
            $arrayDispositivos = array();   
            foreach( $usuario->getDispositivos() as $indice => $dispositivo ){
                $arrayDispositivo = array(  
                    'id' => $dispositivo->getId(),
                    'idUnico' => $dispositivo->getIdUnico(),
                    'alias' => $dispositivo->getAlias(), 
                    'numero' => $dispositivo->getNumero(),
                    'modelo' => $dispositivo->getModelo(),
                    'version' => $dispositivo->getVersion(),
                    'tipo' => $dispositivo->getTipoDispositivo()->getEtiqueta(),  
                    'status' => $dispositivo->getStatus()
                );  
                $arrayDispositivos[] = $arrayDispositivo;
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
                'dispositivos' => $arrayDispositivos
            );  

            $arrayUsuarios[] = $arrayUsuario;
        }

        return response( $arrayUsuarios , 200)->header('Content-Type', 'application/json');

    }



  
}

