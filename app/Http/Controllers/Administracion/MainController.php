<?php

namespace App\Http\Controllers\Administracion;

/* DAOS */
use App\Daos\Usuarios\UsuarioDao;
use App\Daos\UsuariosPublico\UsuarioPublicoDao; 
use App\Daos\UsuariosMobile\UsuarioMobileDao;
use App\Daos\Dispositivos\DispositivoDao;
use App\Daos\UniversalDao;



use App\Daos\Usuarios\PermisoDao; 
use App\Daos\UsuariosPublico\PermisoPublicoDao;
use App\Daos\UsuariosMobile\PermisoMobileDao;
use App\Daos\Dispositivos\PermisosDispositivosDao;
    
use App\Daos\LoggerDao;  
use App\Daos\DashboardDao;

/* ENTITIES */
use App\Entities\Logger;


/* LIBRERIAS DE LARAVEL */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MainController extends Controller
{
    
    /* ENTITIES DAO */
    protected $usuarioDao;
    protected $usuarioPublicoDao;
    protected $usuarioMobileDao;
    protected $dispositivoDao;

    protected $permisoDao;
    protected $permisoPublicoDao;
    protected $permisoMobileDao;
    protected $permisosDispositivosDao;

    protected $loggerDao;
    protected $universalDao;
    
    public function __construct(
        UsuarioDao $UsuarioDao
        ,UsuarioMobileDao $UsuarioMobileDao
        ,UsuarioPublicoDao $UsuarioPublicoDao
        ,DispositivoDao $DispositivoDao

        ,PermisoDao $PermisoDao
        ,PermisoPublicoDao $PermisoPublicoDao
        ,PermisoMobileDao $PermisoMobileDao
        ,PermisosDispositivosDao $PermisosDispositivosDao

        ,LoggerDao $LoggerDao
        ,DashboardDao $DashboardDao
        ,UniversalDao $UniversalDao)
    {
        $this->middleware('auth');
        /* ENTITIES DAO */
        
        $this->usuarioDao = $UsuarioDao;
        $this->usuarioPublicoDao = $UsuarioPublicoDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->dispositivoDao = $DispositivoDao;

        $this->permisoDao = $PermisoDao;
        $this->permisoPublicoDao = $PermisoPublicoDao;
        $this->permisoMobileDao = $PermisoMobileDao;
        $this->permisosDispositivosDao = $PermisosDispositivosDao;

        $this->dashboardDao = $DashboardDao;
        $this->loggerDao = $LoggerDao;

        $this->universalDao = $UniversalDao;
    }

    
    public function welcome()  
    { 
        return view('administracion.welcome' );
    }

    
    public function index()  
    { 
        $data['usuariosTotal'] = $this->usuarioDao->countAll();
        $data['usuariosPublicosTotal'] = $this->usuarioPublicoDao->countAll();
        $data['usuariosMobileTotal'] = $this->usuarioMobileDao->countAll();
        $data['dispositivosTotal'] = $this->dispositivoDao->countAll();
   
        $data['usuariosBloqueados'] = $this->usuarioDao->countAllByStatus(0);
        $data['usuariosPublicosBloqueados'] = $this->usuarioPublicoDao->countAllByStatus(0);
        $data['usuariosMobileBloqueados'] = $this->usuarioMobileDao->countAllByStatus(0);
        $data['dispositivosBloqueados'] = $this->dispositivoDao->countAllByStatus(0); 

        $data['usuariosPermisos'] = $this->permisoDao->countAll();
        $data['usuariosPublicosPermisos'] = $this->permisoPublicoDao->countAll();
        $data['usuariosMobilePermisos'] = $this->permisoMobileDao->countAll();
        $data['dispositivoPermisos'] = $this->permisosDispositivosDao->countAll();



        $data['establecimientos'] = $this->dashboardDao->listAllEstablecimientoJson();
        $data['asociaciones'] = $this->dashboardDao->listAllAsociacionesJson();
        $data['cadenas'] = $this->dashboardDao->listAllCadenasJson();
        $data['plazas'] = $this->dashboardDao->listAllPlazasJson();
        
        $data['alertasEmitidas'] = $this->dashboardDao->listAllAlertasEmitidasJson();
        $data['alertasEfectivas'] = $this->dashboardDao->listAllAlertasEfectivasJson();
        $data['alertasNoEfectivas'] = $this->dashboardDao->listAllAlertasNoEfectivasJson();

        $tiempoP = $this->dashboardDao->listAllTiempoPromedioJson();
        
        //$data['tiempoPromedio']  = $this->dashboardDao->listAllEstablecimientoJson();
        if($tiempoP['AvgTime']==NULL  ){
          $data['tiempoPromedio'] = $tiempoP[0][1]=0;
        }else{
          $data['tiempoPromedio'] = explode(":", $tiempoP['AvgTime']);
        }
        
        $data['pruebasEmitidas'] = $this->dashboardDao->listAllPruebasEmitidasJson();
        $data['encargados'] = $this->dashboardDao->listAllEncargadosJson();
        $data['colonias'] = $this->dashboardDao->listAllColoniasJson();
        $data['dispositivos'] = $this->dashboardDao->listAllDispositivosJson();
    
     
    


        return view('administracion.dashboard' , $data );
    }


    public function busquedaUniversal(Request $request)
    { 
        $datos = $request->get('datos');
        
        $this->universalDao->buscar( $datos );

        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    } 






}
