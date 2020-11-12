<?php

namespace App\Http\Controllers\Administracion\Establecimientos\Dashboard;


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
    
        return view('administracion.establecimientos.dashboard' , $data );
    } 


    public function obtenerEstablecimientosEstadisticas()
    { 
      $establecimientosAltas = $this->dashboardDao->obtenerEstablecimientosEstadisticas();
      $arregloAltas = array();
      foreach ($establecimientosAltas as $indice => $altas) {
        $arreglo = array(
             'anhoAlta' => $altas['anhoAlta']
            ,'mesAlta' => $altas['mesAlta']
            ,'totalAlta' => $altas['totalAlta']
          );
        $arregloAltas[] = $arreglo;
      }
      return \Response::json( $arregloAltas);
    }
    
    public function obtenerAsociacionesEstadisticas()
    { 
      $asociacionesAltas = $this->dashboardDao->obtenerAsociacionesEstadisticas();
      $arregloAltas = array();
      foreach ($asociacionesAltas as $indice => $altas) {
        $arreglo = array(
             'anhoAlta' => $altas['anhoAlta']
            ,'mesAlta' => $altas['mesAlta']
            ,'totalAlta' => $altas['totalAlta']
          );
        $arregloAltas[] = $arreglo;
      }
      return \Response::json( $arregloAltas);
    }

    public function obtenerCadenasEstadisticas()
    { 
      $cadenasAltas = $this->dashboardDao->obtenerCadenasEstadisticas();
      $arregloAltas = array();
      foreach ($cadenasAltas as $indice => $altas) {
        $arreglo = array(
             'anhoAlta' => $altas['anhoAlta']
            ,'mesAlta' => $altas['mesAlta']
            ,'totalAlta' => $altas['totalAlta']
          );
        $arregloAltas[] = $arreglo;
      }
      return \Response::json( $arregloAltas);
    }

    public function obtenerPlazasEstadisticas()
    { 
      $plazasAltas = $this->dashboardDao->obtenerPlazasEstadisticas();
      $arregloAltas = array();
      foreach ($plazasAltas as $indice => $altas) {
        $arreglo = array(
             'anhoAlta' => $altas['anhoAlta']
            ,'mesAlta' => $altas['mesAlta']
            ,'totalAlta' => $altas['totalAlta']
          );
        $arregloAltas[] = $arreglo;
      }
      return \Response::json( $arregloAltas);
    }

    public function obtenerAlertasPruebasEstadisticas()
    { 
      $obtenerAlertas = $this->dashboardDao->totalesAlertas();
      $obtenerPruebas = $this->dashboardDao->totalesPruebas();

      $arregloAlertasPruebas = array();
      foreach ($obtenerAlertas as $indice => $alertas) {
        $arreglo = array(
             'anhoAlarma' => $alertas['anhoAlarma']
            ,'mesAlarma' => $alertas['mesAlarma']
            ,'totalAlarma' => $alertas['totalAlarma']
          );
        $arregloAlertasPruebas[] = $arreglo;
      }

      foreach ($obtenerPruebas as $indice => $pruebas) {
        
              $arreglo = array(
                   'anhoPrueba' => $pruebas['anhoPrueba']
                  ,'mesPrueba' => $pruebas['mesPrueba']
                  ,'totalPrueba' => $pruebas['totalPrueba']
                );
        
              $arregloAlertasPruebas[] = $arreglo ;
            }
      return \Response::json( $arregloAlertasPruebas);
    }



    public function obtenerAlertasEfectivasNoEfectivas()
    { 
      $obtenerAlertasEfectivas = $this->dashboardDao->ObtenerAlertasEfectivasEstadisticas();
      $obtenerAlertasNoEfectivas = $this->dashboardDao->ObtenerAlertasNoEfectivasEstadisticas();

      $arregloAlertasEfectivasNoEfectivas = array();
      foreach ($obtenerAlertasEfectivas as $indice => $efectivas) {
        $arreglo = array(
             'anhoEfectiva'    => $efectivas['anhoEfectiva']
            ,'mesEfectiva'     => $efectivas['mesEfectiva']
            ,'totalEfectiva'   => $efectivas['totalEfectiva']
          );
        $arregloAlertasEfectivasNoEfectivas[] = $arreglo;
      }

      foreach ($obtenerAlertasNoEfectivas as $indice => $noEfectivas) {
        
              $arreglo = array(
                   'anhoNoEfectiva'  => $noEfectivas['anhoNoEfectiva']
                  ,'mesNoEfectiva'   => $noEfectivas['mesNoEfectiva']
                  ,'totalNoEfectiva' => $noEfectivas['totalNoEfectiva']
                );
        
              $arregloAlertasEfectivasNoEfectivas[] = $arreglo ;
            }
      return \Response::json( $arregloAlertasEfectivasNoEfectivas);
    }

    
    
    

    public function busquedaUniversal(Request $request)
    { 
        $datos = $request->get('datos');
        
        $this->universalDao->buscar( $datos );

        return response( 'ok' , 200)->header('Content-Type', 'text/plain');
    } 



    
}
