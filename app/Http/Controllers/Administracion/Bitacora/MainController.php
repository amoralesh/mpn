<?php

namespace App\Http\Controllers\Administracion\Bitacora;

/* DAOS */
use App\Daos\Usuarios\UsuarioDao;
use App\Daos\UsuariosPublico\UsuarioPublicoDao; 
use App\Daos\UsuariosMobile\UsuarioMobileDao;
use App\Daos\Dispositivos\DispositivoDao;

use App\Daos\LoggerDao;   

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
    protected $loggerDao;
     
    public function __construct(    
        UsuarioDao $UsuarioDao
       ,UsuarioMobileDao $UsuarioMobileDao
       ,UsuarioPublicoDao $UsuarioPublicoDao
       ,DispositivoDao $DispositivoDao
       ,LoggerDao $LoggerDao)
    {
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Bitacora',[ 'only' => ['index','listByDate' ]] );
        
        /* ENTITIES DAO */
        $this->usuarioDao = $UsuarioDao;
        $this->usuarioPublicoDao = $UsuarioPublicoDao;
        $this->usuarioMobileDao = $UsuarioMobileDao;
        $this->dispositivoDao = $DispositivoDao;
        $this->loggerDao = $LoggerDao;
 
    }

    public function index()  
    { 
        return view('administracion.bitacora.index');    
    } 
    
    public function listByDate($fechaInicio, $fechaFin)
    {      
        $datos = $this->loggerDao->findByDates($fechaInicio, $fechaFin);
        echo json_encode($datos);
    }


}
