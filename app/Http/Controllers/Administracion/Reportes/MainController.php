<?php

namespace App\Http\Controllers\Administracion\Reportes;
 
/* CONTROLADOR */
use App\Http\Controllers\Controller;
  
/* ENTITIES */  
use App\Entities\Logger;

/* DAOS */
use App\Daos\DivisionTerritorial\SectorDao;
use App\Daos\DelegacionDao;
use App\Daos\ColoniaDao;
use App\Daos\TipoAsentamientoDao;
use App\Daos\TipoNegocioDao;
use App\Daos\GiroNegocioDao;
use App\Daos\GiroNegocioGeneralDao;
use App\Daos\TipoDispositivoDao;
use App\Daos\TipoStatusDao;  
use App\Daos\NegocioDao;
use App\Daos\AlertaDao;
use App\Daos\StatusRevisionNegocioDao;
use App\Daos\Usuarios\UsuarioDao;
use App\Daos\LoggerDao;

/* EVENTOS SOCKET */
use App\Events\Pruebas as PruebasEvent;
     
/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request;   
use File;  
   
class MainController extends Controller
{    
   
    /* ENTITIES DAO */ 
    protected $loggerDao;
    protected $sectorDao;
    protected $delegacionDao;
    protected $coloniaDao;
    protected $tipoAsentamientoDao;
    protected $tipoNegocioDao;
    protected $giroNegocioDao;
    protected $giroNegocioGeneralDao;
    protected $tipoDispositivoDao;
    protected $tipoStatusDao;  
    protected $negocioDao;
    protected $alertaDao;
    protected $statusRevisionNegocioDao;
    protected $usuarioDao;
    
    public function __construct(
         LoggerDao $LoggerDao 
        ,SectorDao $SectorDao
        ,DelegacionDao $DelegacionDao
        ,ColoniaDao $ColoniaDao
        ,TipoAsentamientoDao $TipoAsentamientoDao
        ,TipoNegocioDao $TipoNegocioDao
        ,GiroNegocioDao $GiroNegocioDao
        ,GiroNegocioGeneralDao $GiroNegocioGeneralDao
        ,TipoDispositivoDao $TipoDispositivoDao
        ,TipoStatusDao   $TipoStatusDao
        ,NegocioDao $NegocioDao
        ,AlertaDao $AlertaDao
        ,StatusRevisionNegocioDao $StatusRevisionNegocioDao
        ,UsuarioDao $UsuarioDao )
    {
        $this->middleware('auth');
        $this->loggerDao = $LoggerDao;
        $this->sectorDao = $SectorDao;
        $this->delegacionDao = $DelegacionDao;
        $this->coloniaDao = $ColoniaDao;
        $this->tipoAsentamientoDao = $TipoAsentamientoDao;
        $this->tipoNegocioDao = $TipoNegocioDao;
        $this->giroNegocioDao = $GiroNegocioDao;
        $this->giroNegocioGeneralDao = $GiroNegocioGeneralDao;
        $this->tipoDispositivoDao = $TipoDispositivoDao;
        $this->tipoStatusDao = $TipoStatusDao;  
        $this->negocioDao = $NegocioDao;
        $this->alertaDao = $AlertaDao;
        $this->statusRevisionNegocioDao = $StatusRevisionNegocioDao;
        $this->usuarioDao = $UsuarioDao;
    }    
 
    public function index()
    {
        $data['delegacionList']            = $this->delegacionDao->listAll();
        $data['tipoAsentamientoList']      = $this->tipoAsentamientoDao->listAll();
        $data['tipoNegocioList']           = $this->tipoNegocioDao->listAll();
        $data['giroNegocioList']           = $this->giroNegocioDao->listAll();
        $data['giroNegocioGeneralList']    = $this->giroNegocioGeneralDao->listAll();
        $data['tipoDispositivoList']       = $this->tipoDispositivoDao->listAll();
        $data['statusRevisionNegocioList'] = $this->statusRevisionNegocioDao->listAll();
        $data['sectorList']                = $this->sectorDao->listAll(); 
        return view('administracion.reportes.index' , $data );  
    }
    
    /* SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    ==========================================*/
       


}

