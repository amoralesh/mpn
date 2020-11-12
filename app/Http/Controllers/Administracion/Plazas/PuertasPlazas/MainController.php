<?php

namespace App\Http\Controllers\Administracion\Plazas\PuertasPlazas;

/* CONTROLADOR */ 
use App\Http\Controllers\Controller;

/* ENTITIES */
use App\Entities\Plaza;
use App\Entities\Direccion;
use App\Entities\Dispositivo;
use App\Entities\Negocio;
use App\Entities\MotivoAltaBaja;
use App\Entities\Logger;
use App\Entities\StatusRevisionNegocio;
use App\Entities\PuertasPlazas;
use App\Entities\OficioIncorporacion;
use App\Entities\Seguimientos;
use App\Entities\ComprobanteDomicilio;
use App\Entities\ComprobanteFiscal;


/* DAOS */
use App\Daos\DivisionTerritorial\SectorDao;
use App\Daos\PlazaDao;
use App\Daos\EncargadoDao; 
use App\Daos\DelegacionDao;
use App\Daos\ColoniaDao;
use App\Daos\TipoAsentamientoDao;
use App\Daos\TipoNegocioDao;
use App\Daos\GiroNegocioDao;
use App\Daos\GiroNegocioGeneralDao;
use App\Daos\DispositivoDao;
use App\Daos\TipoDispositivoDao;
use App\Daos\TipoStatusDao;  
use App\Daos\NegocioDao;
use App\Daos\MotivoAltaBajaDao;
use App\Daos\AsociacionDao;
use App\Daos\CadenaDao;
use App\Daos\AlertaDao;
use App\Daos\TipoEncargadoDao;
use App\Daos\LoggerDao;
use App\Daos\StatusRevisionNegocioDao;
use App\Daos\PuertasPlazasDao;
use App\Daos\OficioIncorporacionDao;
use App\Daos\SeguimientosDao;
use App\Daos\Usuarios\UsuarioDao;
use App\Daos\PID\EstablecimientoDao;


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
    protected $sectorDao;
    protected $plazaDao;
    protected $encargadoDao;
    protected $seguimientosDao;
    protected $usuarioDao;
    protected $delegacionDao;
    protected $coloniaDao;
    protected $tipoAsentamientoDao;
    protected $tipoNegocioDao;
    protected $giroNegocioDao;
    protected $giroNegocioGeneralDao;
    protected $dispositivoDao;
    protected $tipoDispositivoDao;
    protected $tipoStatusDao;
    protected $negocioDao;
    protected $motivoAltaBajaDao;
    protected $asociacionDao;
    protected $cadenaDao;
    protected $alarmaDao;
    protected $loggerDao;
    protected $statusRevisionNegocioDao;
    protected $puertasPlazasDao;
    protected $oficioIncorporacionDao;
    protected $establecimientoDao;
    
    public function __construct(PlazaDao $PlazaDao,
    SectorDao $SectorDao,
    DelegacionDao $DelegacionDao,
    SeguimientosDao $SeguimientosDao,
    UsuarioDao $UsuarioDao,
    ColoniaDao $ColoniaDao,
    TipoAsentamientoDao $TipoAsentamientoDao,
    TipoNegocioDao $TipoNegocioDao,
    GiroNegocioDao $GiroNegocioDao,
    GiroNegocioGeneralDao $GiroNegocioGeneralDao,
    EncargadoDao $EncargadoDao,
    DispositivoDao $DispositivoDao,
    TipoDispositivoDao $TipoDispositivoDao,
    TipoStatusDao $TipoStatusDao,
    NegocioDao $NegocioDao,
    AsociacionDao $AsociacionDao,
    CadenaDao $CadenaDao,
    MotivoAltaBajaDao $MotivoAltaBajaDao,
    AlertaDao $AlertaDao,
    LoggerDao $LoggerDao,
    StatusRevisionNegocioDao $StatusRevisionNegocioDao,
    PuertasPlazasDao     $PuertasPlazasDao,
    EstablecimientoDao   $EstablecimientoDao,
    OficioIncorporacionDao $OficioIncorporacionDao)

    { 
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:Aside:Establecimientos',[ 'only' => ['index' ]] );
        $this->middleware('hasPermission:Administracion:Establecimientos:Crear',[ 'only' => ['create' ]] );
        $this->middleware('hasPermission:Administracion:Establecimientos:Editar',[ 'only' => ['edit' ]] );
        $this->middleware('hasPermission:Administracion:Establecimientos:Guardar',[ 'only' => ['store' ]] );
        $this->middleware('hasPermission:Administracion:Establecimientos:Actualizar',[ 'only' => ['update' ]] );

        $this->middleware('hasPermission:Administracion:Establecimientos:Habilitar',[ 'only' => ['habilitar' ]] );
        $this->middleware('hasPermission:Administracion:Establecimientos:Deshabilitar',[ 'only' => ['deshabilitar' ]] );

        $this->middleware('hasPermission:Administracion:Rest:Establecimientos',[ 'only' => [ 'listAll' ]] );
        $this->middleware('hasPermission:Administracion:Establecimientos:Actualizar:Token',[ 'only' => ['actualizarToken' ]] );

        $this->middleware('checkStatus',[ 'only' => [ 'edit','update' ]] );
        $this->middleware('formatearTexto',[ 'only' => [ 'store','update','habilitar','deshabilitar' ]] );
        /* ENTITIES DAO */
        $this->sectorDao                = $SectorDao;
        $this->plazaDao                 = $PlazaDao;
        $this->usuarioDao               = $UsuarioDao;
        $this->seguimientosDao          = $SeguimientosDao;
        $this->encargadoDao             = $EncargadoDao;
        $this->delegacionDao            = $DelegacionDao;
        $this->coloniaDao               = $ColoniaDao;
        $this->tipoAsentamientoDao      = $TipoAsentamientoDao;
        $this->tipoNegocioDao           = $TipoNegocioDao;
        $this->giroNegocioDao           = $GiroNegocioDao;
        $this->giroNegocioGeneralDao    = $GiroNegocioGeneralDao;
        $this->tipoDispositivoDao       = $TipoDispositivoDao;
        $this->tipoStatusDao            = $TipoStatusDao;
        $this->negocioDao               = $NegocioDao;
        $this->asociacionDao            = $AsociacionDao;
        $this->cadenaDao                = $CadenaDao;
        $this->alarmaDao                = $AlertaDao;
        $this->dispositivoDao           = $DispositivoDao;
        $this->motivoAltaBajaDao        = $MotivoAltaBajaDao;
        $this->statusRevisionNegocioDao = $StatusRevisionNegocioDao;
        $this->puertasPlazasDao         = $PuertasPlazasDao;
        $this->oficioIncorporacionDao   = $OficioIncorporacionDao;
        $this->establecimientoDao       = $EstablecimientoDao;
        $this->loggerDao                = $LoggerDao; 
    }
    
    
    public function index()
    {
        return view('administracion.plazas.puertas.index');
    }
    

    public function create()     
    {
        $data['plazaList']                 = $this->plazaDao->listAll();
        $data['cadenaList']                = $this->cadenaDao->listAll();
        $data['encargadosList']            = $this->encargadoDao->listAll();
        $data['delegacionList']            = $this->delegacionDao->listAll();
        $data['tipoAsentamientoList']      = $this->tipoAsentamientoDao->listAll();
        $data['tipoNegocioList']           = $this->tipoNegocioDao->listAllPlazas();
        $data['giroNegocioList']           = $this->giroNegocioDao->listAll();
        $data['tipoDispositivoList']       = $this->tipoDispositivoDao->listAll();
        $data['giroNegocioGeneralList']    = $this->giroNegocioGeneralDao->listAllPlazas();
        $data['statusRevisionNegocioList'] = $this->statusRevisionNegocioDao->listAll();
        return view('administracion.plazas.puertas.create', $data);
    }

    
    public function edit($id)        
    {
        $negocio = $this->negocioDao->findById($id);
        
        $data['negocio']                   = $negocio;
        $data['coloniaList']               = $this->coloniaDao->listAll();
        $data['plazaList']                 = $this->plazaDao->listAll();
        $data['cadenaList']                = $this->cadenaDao->listAll();
        $data['delegacionList']            = $this->delegacionDao->listAll();
        $data['tipoAsentamientoList']      = $this->tipoAsentamientoDao->listAll();
        $data['tipoNegocioList']           = $this->tipoNegocioDao->listAllPlazas();
        $data['giroNegocioList']           = $this->giroNegocioDao->listAll();
        $data['tipoDispositivoList']       = $this->tipoDispositivoDao->listAll();
        $data['giroNegocioGeneralList']    = $this->giroNegocioGeneralDao->listAllPlazas();
        $data['statusRevisionNegocioList'] = $this->statusRevisionNegocioDao->listAll();

        $sinImagen='data:image/jpeg;base64,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';
        
        /** OFICIO DE INCORPORACION */
        if( $negocio->getOficioIncorporacion()->last() != NULL)
        {
            $data['oficioIncorporacion']         = 'data:' . $negocio->getOficioIncorporacion()->last()->getMimeTypeDocumento() . ';base64,' . base64_encode( pack( 'H*' , stream_get_contents( $negocio->getOficioIncorporacion()->last()->getDocumento())  ));
            $data['oficioIncorporacionMimeType'] = $negocio->getOficioIncorporacion()->last()->getMimeTypeDocumento() != "application/pdf" ? "image" : "pdf";
        }else {
            $data['oficioIncorporacion']         =  $sinImagen;
            $data['oficioIncorporacionMimeType'] = 'image'; 
        }
        /** COMPROBANTE DE DOMICILIO */
        if( $negocio->getComprobanteDomicilio()->last()!=NULL)
        {
            $data['comprobanteDomicilio']         = 'data:' . $negocio->getComprobanteDomicilio()->last()->getMimeTypeDocumento() . ';base64,' . base64_encode( pack( 'H*' , stream_get_contents( $negocio->getComprobanteDomicilio()->last()->getDocumento()) ));
            $data['comprobanteDomicilioMimeType'] = $negocio->getComprobanteDomicilio()->last()->getMimeTypeDocumento() != "application/pdf" ? "image" : "pdf";
        }else {
            $data['comprobanteDomicilio']         =  $sinImagen;
            $data['comprobanteDomicilioMimeType'] = 'image';
        }
        /** COMPROBANTE FISCAL */
        if( $negocio->getComprobanteFiscal()->last()!=NULL)
        {
            $data['comprobanteFiscal']         = 'data:' . $negocio->getComprobanteFiscal()->last()->getMimeTypeDocumento() . ';base64,' . base64_encode(pack( 'H*' , stream_get_contents( $negocio->getComprobanteFiscal()->last()->getDocumento()) ));
            $data['comprobanteFiscalMimeType'] = $negocio->getComprobanteFiscal()->last()->getMimeTypeDocumento() != "application/pdf" ? "image" : "pdf";
        }else {
            $data['comprobanteFiscal']         =  $sinImagen;
            $data['comprobanteFiscalMimeType'] = 'image';
        }

        $encargadosArreglo = array();
        foreach ( $negocio->getEncargados() as $indice => $encargado) {  array_push($encargadosArreglo, $encargado->getId()); }
        $data['encargadosList'] = $encargadosArreglo;
        
        $asociacionesArreglo = array();
        foreach ( $negocio->getAsociaciones() as $indice => $asociacion) {  array_push($asociacionesArreglo, $asociacion->getId()); }
        $data['asociacionesList'] = $asociacionesArreglo;

        $cadenasArreglo = array();
        foreach ( $negocio->getCadenas() as $indice => $cadena) {  array_push($cadenasArreglo, $cadena->getId()); }
        $data['cadenasList'] = $cadenasArreglo;
        
        return view('administracion.plazas.puertas.edit', $data);
    }
    

    
    
    public function store(Request $request)
    {  
        $nombre             = $request->get('nombre');
        $razonSocial        = $request->get('razonSocial');
        $callePrincipal     = $request->get('callePrincipal');
        $calleA             = $request->get('calleA');
        $calleB             = $request->get('calleB');
        $numeroInterior     = $request->get('numeroInterior');
        $numeroExterior     = $request->get('numeroExterior');
        $edificio           = $request->get('edificio');  
        $colonia            = $request->get('colonia');   
        $tipoAsentamiento   = $request->get('tipoAsentamiento');
        $nombreAsentamiento = $request->get('nombreAsentamiento'); 
        $codigoPostal       = $request->get('codigoPostal');      
        $telefono           = $request->get('telefono');
        $extension          = $request->get('extension');  
        $plaza              = $request->get('plaza');
        $asociacionesList   = $request->get('asociacionesList');
        $cadenasList        = $request->get('cadenasList');
        $piso               = $request->get('piso');  
        $placaMPN           = $request->get('placaMPN');
        $cuentaConOficio    = $request->get('cuentaConOficio');
        $tipoNegocio        = $request->get('tipoNegocio');
        $giroNegocio        = $request->get('giroNegocio');
        $giroNegocioGeneral = $request->get('giroNegocioGeneral');      
        /** DISPOSITIVOS */
        $idTipoDispositivo    = $request->get('idTipoDispositivo');
        $tipoDispositivo      = $request->get('tipoDispositivo');
        $cantidad             = $request->get('cantidad');
        $referencias        = $request->get('referencias');
        $comentarios        = $request->get('comentarios');
        /** UBICACION */
        $lat                = $request->get('lat');
        $long               = $request->get('long');
        $encargadosList     = $request->get('encargadosList');

        /*PUERTAS MERCADO*/
        $nombrePuerta                    = $request->get('nombrePuerta');
        $callePrincipalPuerta            = $request->get('callePrincipalPuerta');
        $calle1Puerta                    = $request->get('calle1Puerta');
        $calle2Puerta                    = $request->get('calle2Puerta');
        $longitudPuerta                  = $request->get('longitudPuerta');
        $latitudPuerta                   = $request->get('latitudPuerta');
        $tipoDispositivoPuerta           = $request->get('tipoDispositivoPuerta');
        $numeroDeEstablecimientosMercado = $request->get('numeroDeEstablecimientosMercado');

        /** DOCUMENTOS */
        $oficioMPN             = $request->file('oficioMPN');
        $comprobanteDomicilio  = $request->file('comprobanteDomicilio');
        $comprobanteFiscal     = $request->file('comprobanteFiscal');
        
        $rules = array(
            'nombre'              => 'required|max:100',
            'razonSocial'         => 'required|max:100',
            'callePrincipal'      => 'required|max:100',
            'calleA'              => 'required|max:100',
            'calleB'              => 'required|max:100',
            'numeroInterior'      => 'required|required_without:numeroExterior',
            'numeroExterior'      => 'required|required_without:numeroInterior',
            'colonia'             => 'required',
            'tipoAsentamiento'    => 'required', 
            'nombreAsentamiento'  => 'required_unless:tipoAsentamiento,1', 
            'codigoPostal'        => 'required|min:1|max:8',
            'telefono'            => 'required',   
            'placaMPN'            => 'required|numeric',   
            'tipoNegocio'         => 'required',
            'giroNegocio'         => 'required',
            'giroNegocioGeneral'  => 'required',
            //'tipoDispositivo'     => 'required', 
            //'cantidad'            => 'required', 
            'referencias'         => 'required',
            //'comentarios'         => 'required',
            'lat'                 => 'required',
            'long'                => 'required',
            'encargadosList'      => 'required', 
            'oficioMPN'           => 'required'
        );
        
        $messages = array(
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
            'max' => 'El campo :attribute no puede tener más de :max carácteres.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'required_without' => 'El campo :attribute .',
            'required_unless' => 'El campo :attribute debe ser completado si el tipo de asentamiento es diferente de colonia.'
        );
        
        $validation = Validator::make($request->all(), $rules, $messages);

        if ( $validation->fails() ) {
            //var_dump( $validation->messages() );
            return Redirect::to("/administracion/plazas/puertas/create")->with('errores', 'Woops algo esta mal!.')->withErrors($validation)->withInput();
        
        } else {
            
            $negocio = new Negocio;
            $negocio->setNombre($nombre);
            $negocio->setRazonSocial($razonSocial);

            // -------------------------- DIRECCION --------------------------
            $direccion = new Direccion;
            $direccion->setCallePrincipal($callePrincipal);
            $direccion->setCalle1($calleA);
            $direccion->setCalle2($calleB);
            $direccion->setNumeroInterior($numeroInterior);
            $direccion->setNumeroExterior($numeroExterior);
            $direccion->setEdificio($edificio);

            $coloniaE = $this->coloniaDao->findById($colonia);
            $direccion->setColonia($coloniaE);

            $tipoAsentamientoE = $this->tipoAsentamientoDao->findById($tipoAsentamiento);
            $direccion->setTipoAsentamiento($tipoAsentamientoE);

            $direccion->setNombreAsentamiento($nombreAsentamiento);  

            $direccion->setCodigoPostal($codigoPostal);
            $negocio->setDireccion($direccion);
            
            //--
            $negocio->setTelefono($telefono);
            $negocio->setExtension($extension);

            // -------------------------- PLAZA --------------------------
            $plazaE = $this->plazaDao->findById($plaza);
            $negocio->setPlaza($plazaE);
            

            // -------------------------- ASOCIACIONES --------------------------
            $asociacionesArray = explode(',', $asociacionesList);
            $asociaciones = $this->asociacionDao->listAllByIDS($asociacionesArray);
            $negocio->setAsociaciones($asociaciones);
   
            // -------------------------- CADENAS --------------------------
            $cadenasArray = explode(',', $cadenasList); 
            $cadenas = $this->cadenaDao->listAllByIDS($cadenasArray);
            $negocio->setCadenas($cadenas);


            $negocio->setPiso($piso); 
            $negocio->setPlacaMPN($placaMPN);
            $negocio->setCuentaConOficio($cuentaConOficio);

            $tipoNegocioE = $this->tipoNegocioDao->findById(12);
            $negocio->setTipoNegocio($tipoNegocioE);

            $giroNegocioE = $this->giroNegocioDao->findById($giroNegocio);
            $negocio->setGiroNegocio($giroNegocioE);

            $giroNegocioGeneralE = $this->giroNegocioGeneralDao->findById(40);
            $negocio->setGiroNegocioGeneral($giroNegocioGeneralE);
              
            $negocio->setReferencia($referencias);
            $negocio->setComentarios($comentarios);
            $negocio->setLatitud($lat);
            $negocio->setLongitud($long);

            $statusRevisionNegocioE = $this->statusRevisionNegocioDao->findById(1);
            $negocio->setStatusRevisionNegocio($statusRevisionNegocioE);

            $idSector = $this->sectorDao->findByLatLng( $negocio->getLongitud() , $negocio->getLatitud() );
            $sector = $this->sectorDao->findById( intval( $idSector["id"] ) ); 
            $negocio->setSector( $sector );
               
            // -------------------------- ENCARGADOS --------------------------
            $encargadosArray = explode(',', $encargadosList);
            $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);
            $negocio->setEncargados($encargadosListE);

            // -------------------------- OFICIO MPN --------------------------
            if( $oficioMPN != NULL ) 
            {
                $arrayOficio           = array();
                $OficioIncoporacionMPN = new OficioIncorporacion;
           
                $OficioIncoporacionMPN->setDocumento(File::get($oficioMPN));
                $OficioIncoporacionMPN->setNombreDocumento($oficioMPN->getClientOriginalName());
                $OficioIncoporacionMPN->setExtensionDocumento($oficioMPN->getClientOriginalExtension());
                $OficioIncoporacionMPN->setMimeTypeDocumento($oficioMPN->getMimeType());
                $OficioIncoporacionMPN->setTamanoDocumento($oficioMPN->getSize());
                $OficioIncoporacionMPN->setFechaAltaDocumento(new \DateTime());
                $OficioIncoporacionMPN->setNegocio($negocio);
                $arrayOficio[] = $OficioIncoporacionMPN;
                $negocio->setOficioIncorporacion($arrayOficio);
            }

            // -------------------------- COMPROBANTE DE DOMICILIO --------------------------
            if( $comprobanteDomicilio != NULL ){        
                $arrayComprobanteDomicilio   = array();
                $comproDomi = new ComprobanteDomicilio;
       
                $comproDomi->setDocumento(File::get($comprobanteDomicilio));
                $comproDomi->setNombreDocumento($comprobanteDomicilio->getClientOriginalName());
                $comproDomi->setExtensionDocumento($comprobanteDomicilio->getClientOriginalExtension());
                $comproDomi->setMimeTypeDocumento($comprobanteDomicilio->getMimeType());
                $comproDomi->setTamanoDocumento($comprobanteDomicilio->getSize());
                $comproDomi->setFechaAltaDocumento(new \DateTime());
                $comproDomi->setNegocio($negocio);
                $arrayComprobanteDomicilio[] = $comproDomi;
                $negocio->setComprobanteDomicilio($arrayComprobanteDomicilio);
            }

            // -------------------------- COMPROBANTE FISCAL --------------------------
            if( $comprobanteFiscal != NULL ){      

                $arrayComprobanteFiscal   = array();
                $comproFiscal = new ComprobanteFiscal;
        
                $comproFiscal->setDocumento(File::get($comprobanteFiscal));
                $comproFiscal->setNombreDocumento($comprobanteFiscal->getClientOriginalName());
                $comproFiscal->setExtensionDocumento($comprobanteFiscal->getClientOriginalExtension());
                $comproFiscal->setMimeTypeDocumento($comprobanteFiscal->getMimeType());
                $comproFiscal->setTamanoDocumento($comprobanteFiscal->getSize());
                $comproFiscal->setFechaAltaDocumento(new \DateTime());
                $comproFiscal->setNegocio($negocio);
                $arrayComprobanteFiscal[] = $comproFiscal;
                $negocio->setComprobanteFiscal($arrayComprobanteFiscal);
            }
        
            $tipoStatusE = $this->tipoStatusDao->findById(1);
            $negocio->setTipoStatus($tipoStatusE);
  
            $negocioCreado = $this->negocioDao->create($negocio);
            
            // ------------------ SEGUIMIENTO ----------------------
            $usuario = $this->usuarioDao->findByUser( session('usuario') );
            $seguimientos = new Seguimientos;
            $seguimientos->setComentario("Se da de alta la plaza por el usuario: " . $usuario->getNombre() . " " . $usuario->getApellidoPaterno() . " "  . $usuario->getApellidoMaterno() );
            $seguimientos->setNegocio($negocioCreado);
            $seguimientos->setUsuario($usuario); 
            $seguimientos->setEsAdmin(1);
            $this->seguimientosDao->create($seguimientos); 



            /*=============PUERTAS PLAZA===============
            ============================================*/
            $arrayPuertasPlazas  = array();
            $length              = count($nombrePuerta); 
            for ($i = 0; $i < $length; $i++) {
                
                $puertasPl = new PuertasPlazas;
                $puertasPl->setNombre($nombrePuerta[$i]);
                $puertasPl->setLatitudPuerta($latitudPuerta[$i]);
                $puertasPl->setLongitudPuerta($longitudPuerta[$i]);
                
                $direccion = new Direccion;
                $direccion->setCallePrincipal($callePrincipalPuerta[$i]);
                $direccion->setCalle1($calle1Puerta[$i]);
                $direccion->setCalle2($calle2Puerta[$i]);
                $direccion->setNumeroInterior($numeroInterior);
                $direccion->setNumeroExterior($numeroExterior);
                $direccion->setEdificio($edificio);
                $direccion->setTipoAsentamiento($tipoAsentamientoE);
                $direccion->setNombreAsentamiento($nombreAsentamiento);
                $direccion->setColonia($coloniaE);
                $direccion->setCodigoPostal($codigoPostal);
                $puertasPl->setDireccion($direccion);

                
                
                $tipoDispositivoE = $this->tipoDispositivoDao->findById($tipoDispositivoPuerta[$i]);
                $dispositivo      = new Dispositivo;
                $dispositivo->setEtiqueta($tipoDispositivoE->getEtiqueta());
                $dispositivo->setTipoDispositivo($tipoDispositivoE);
                $dispositivo->setToken(sha1($negocioCreado->getId() . $negocioCreado->getNombre() . $tipoDispositivoE->getId().$i."PLAZA"));
                $tipoStatusE = $this->tipoStatusDao->findById(1);
                $dispositivo->setTipoStatus($tipoStatusE);
               
                
                $puertasPl->setDispositivos($dispositivo);
                $puertasPl->setNegocio($negocioCreado);
                $arrayPuertasPlazas[] = $puertasPl;
                $this->puertasPlazasDao->create($puertasPl); 
            }

              /* VIEJA PLATAFORMA
              $result = $this->establecimientoDao->create( $negocioCreado , $dispositivo );    
              if( $result ){  
                  $idViejo = $this->establecimientoDao->findByToken( $dispositivo->getToken() );
                  $negocioCreado->setIdNegocio(  $idViejo['idEstablecimiento'] );
                  $this->negocioDao->update( $negocioCreado );
              }*/

            $this->loggerDao->create(new Logger("Ha creado la plaza (negocio): " . $nombre));
            return Redirect::to("/administracion/plazas/puertas")->with('mensaje', 'Creado correctamente!.');
        }
    }
    
    
    
    
    public function update(Request $request, $id)
    {
        $nombre             = $request->get('nombre');
        $razonSocial        = $request->get('razonSocial');
        $callePrincipal     = $request->get('callePrincipal');
        $calleA             = $request->get('calleA');
        $calleB             = $request->get('calleB');
        $numeroInterior     = $request->get('numeroInterior');
        $numeroExterior     = $request->get('numeroExterior');
        $edificio           = $request->get('edificio');  
        $colonia            = $request->get('colonia');   
        $tipoAsentamiento   = $request->get('tipoAsentamiento');
        $nombreAsentamiento = $request->get('nombreAsentamiento'); 
        $codigoPostal       = $request->get('codigoPostal');      
        $telefono           = $request->get('telefono');
        $extension          = $request->get('extension');  
        $plaza              = $request->get('plaza');
        $asociacionesList   = $request->get('asociacionesList');
        $cadenasList        = $request->get('cadenasList');
        $piso               = $request->get('piso');  
        $placaMPN           = $request->get('placaMPN');
        $cuentaConOficio    = $request->get('cuentaConOficio');
        $tipoNegocio        = $request->get('tipoNegocio');
        $giroNegocio        = $request->get('giroNegocio');
        $giroNegocioGeneral = $request->get('giroNegocioGeneral');   
        $statusRev          = $request->get('statusRev');   
        /** DISPOSITIVOS */
        $idDispositivo      = $request->get('idDispositivo');
        $idTipoDispositivo  = $request->get('idTipoDispositivo');
        $tipoDispositivo    = $request->get('tipoDispositivo');
        $cantidad           = $request->get('cantidad');
        $referencias        = $request->get('referencias');
        $comentarios        = $request->get('comentarios');
        /** UBICACION */
        $lat                = $request->get('lat');
        $long               = $request->get('long');
        $encargadosList     = $request->get('encargadosList');

        //**PUERTAS PLAZAS YA CREADAS**//
         $nombrePuerta                    = $request->get('nombrePuerta');
         $callePrincipalPuerta            = $request->get('callePrincipalPuerta');
         $calle1Puerta                    = $request->get('calle1Puerta');
         $calle2Puerta                    = $request->get('calle2Puerta');
         $latitudPuerta                   = $request->get('latitudPuerta');
         $longitudPuerta                  = $request->get('longitudPuerta');
         $tipoDispositivoPuerta           = $request->get('tipoDispositivoPuerta');
         $numeroDeEstablecimientosMercado = $request->get('numeroDeEstablecimientosMercado');
         
         
         //**PUERTAS PLAZAS NUEVAS**//
         $nombrePuertaNueva          = $request->get('nombrePuertaNueva');
         $callePrincipalPuertaNueva  = $request->get('callePrincipalPuertaNueva');
         $calle1PuertaNueva          = $request->get('calle1PuertaNueva');
         $calle2PuertaNueva          = $request->get('calle2PuertaNueva');
         $latitudPuertaNueva         = $request->get('latitudPuertaNueva');
         $longitudPuertaNueva        = $request->get('longitudPuertaNueva');
         $tipoDispositivoPuertaNueva = $request->get('tipoDispositivoPuertaNueva');


        /** DOCUMENTOS */
        $oficioMPN             = $request->file('oficioMPN');
        $comprobanteDomicilio  = $request->file('comprobanteDomicilio');
        $comprobanteFiscal     = $request->file('comprobanteFiscal');
        
        $rules = array(
            'nombre'              => 'required|max:100',
            'razonSocial'         => 'required|max:100',
            'callePrincipal'      => 'required|max:100',
            'calleA'              => 'required|max:100',
            'calleB'              => 'required|max:100',
            'numeroInterior'      => 'required|required_without:numeroExterior',
            'numeroExterior'      => 'required|required_without:numeroInterior',
            'colonia'             => 'required',
            'tipoAsentamiento'    => 'required', 
            'nombreAsentamiento'  => 'required_unless:tipoAsentamiento,1', 
            'codigoPostal'        => 'required|min:1|max:8',
            'telefono'            => 'required',   
            'placaMPN'            => 'required|numeric',   
            'tipoNegocio'         => 'required',
            'giroNegocio'         => 'required',
            'giroNegocioGeneral'  => 'required',
            //'tipoDispositivo'     => 'required', 
            //'cantidad'            => 'required', 
            'referencias'         => 'required',
            //'comentarios'         => 'required',
            'lat'                 => 'required',
            'long'                => 'required',
            'encargadosList'      => 'required'
        );
        
        $messages = array(
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
            'max' => 'El campo :attribute no puede tener más de :max carácteres.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'required_without' => 'El campo :attribute .',
            'required_unless' => 'El campo :attribute debe ser completado si el tipo de asentamiento es diferente de colonia.'
        );
        
        $validation = Validator::make($request->all(), $rules, $messages);

        if ( $validation->fails() ) {
            //var_dump( $validation->messages() );
            return Redirect::to("/administracion/plazas/puertas/" . $id . "/edit" )->with('errores', 'Woops algo esta mal!.')->withErrors($validation)->withInput();
        
        } else {
              
            $negocio = $this->negocioDao->findById( $id );       
            $negocio->setNombre($nombre);
            $negocio->setRazonSocial($razonSocial);

            // -------------------------- DIRECCION --------------------------
            $direccion = $negocio->getDireccion();
            $direccion->setCallePrincipal($callePrincipal);
            $direccion->setCalle1($calleA);
            $direccion->setCalle2($calleB);
            $direccion->setNumeroInterior($numeroInterior);
            $direccion->setNumeroExterior($numeroExterior);
            $direccion->setEdificio($edificio);

            $coloniaE = $this->coloniaDao->findById($colonia);
            $direccion->setColonia($coloniaE);

            $tipoAsentamientoE = $this->tipoAsentamientoDao->findById($tipoAsentamiento);
            $direccion->setTipoAsentamiento($tipoAsentamientoE);

            $direccion->setNombreAsentamiento($nombreAsentamiento);  

            $direccion->setCodigoPostal($codigoPostal);
            $negocio->setDireccion($direccion);
            
            //--
            $negocio->setTelefono($telefono);
            $negocio->setExtension($extension);

            // -------------------------- PLAZA --------------------------
            $plazaE = $this->plazaDao->findById($plaza);
            $negocio->setPlaza($plazaE);
            

            // -------------------------- ASOCIACIONES --------------------------
            $asociacionesArray = explode(',', $asociacionesList);
            $asociaciones = $this->asociacionDao->listAllByIDS($asociacionesArray);
            $negocio->setAsociaciones($asociaciones);
   
            // -------------------------- CADENAS --------------------------
            $cadenasArray = explode(',', $cadenasList); 
            $cadenas = $this->cadenaDao->listAllByIDS($cadenasArray);
            $negocio->setCadenas($cadenas);

            $negocio->setPiso($piso); 
            $negocio->setPlacaMPN($placaMPN);
            $negocio->setCuentaConOficio($cuentaConOficio);

            $tipoNegocioE = $this->tipoNegocioDao->findById(12);
            $negocio->setTipoNegocio($tipoNegocioE);

            $giroNegocioE = $this->giroNegocioDao->findById($giroNegocio);
            $negocio->setGiroNegocio($giroNegocioE);

            $giroNegocioGeneralE = $this->giroNegocioGeneralDao->findById(40);
            $negocio->setGiroNegocioGeneral($giroNegocioGeneralE);
              
            $negocio->setReferencia($referencias);
            $negocio->setComentarios($comentarios);
            $negocio->setLatitud($lat);
            $negocio->setLongitud($long);

            $statusRevisionNegocioE = $this->statusRevisionNegocioDao->findById($statusRev);
            $negocio->setStatusRevisionNegocio($statusRevisionNegocioE);

            $idSector = $this->sectorDao->findByLatLng( $negocio->getLongitud() , $negocio->getLatitud() );
            $sector = $this->sectorDao->findById( intval( $idSector["id"] ) ); 
            $negocio->setSector( $sector );
               
            // -------------------------- ENCARGADOS --------------------------
            $encargadosArray = explode(',', $encargadosList);
            $encargadosListE = $this->encargadoDao->listAllByIDS($encargadosArray);
            $negocio->setEncargados($encargadosListE);

            // -------------------------- OFICIO MPN --------------------------
            if ($oficioMPN != NULL) {
                $oficioRecuperado  = $negocio->getOficioIncorporacion()->last();
                $arrayOficio = array();
                if ( $oficioRecuperado != false ){ 
                    $OficioIncoporacionMPN = $oficioRecuperado;
                    $OficioIncoporacionMPN->setDocumento(File::get($oficioMPN));
                    $OficioIncoporacionMPN->setNombreDocumento($oficioMPN->getClientOriginalName());
                    $OficioIncoporacionMPN->setExtensionDocumento($oficioMPN->getClientOriginalExtension());
                    $OficioIncoporacionMPN->setMimeTypeDocumento($oficioMPN->getMimeType());
                    $OficioIncoporacionMPN->setTamanoDocumento($oficioMPN->getSize());
                    $OficioIncoporacionMPN->setFechaAltaDocumento(new \DateTime());
                    $OficioIncoporacionMPN->setNegocio($negocio);
                    $negocio->addOficioIncorporacion( $OficioIncoporacionMPN );

                } else {
                    $OficioIncoporacionMPN = new OficioIncorporacion;
                    $OficioIncoporacionMPN->setDocumento(File::get($oficioMPN));
                    $OficioIncoporacionMPN->setNombreDocumento($oficioMPN->getClientOriginalName());
                    $OficioIncoporacionMPN->setExtensionDocumento($oficioMPN->getClientOriginalExtension());
                    $OficioIncoporacionMPN->setMimeTypeDocumento($oficioMPN->getMimeType());
                    $OficioIncoporacionMPN->setTamanoDocumento($oficioMPN->getSize());
                    $OficioIncoporacionMPN->setFechaAltaDocumento(new \DateTime());
                    $OficioIncoporacionMPN->setNegocio($negocio);
                    $negocio->addOficioIncorporacion( $OficioIncoporacionMPN ); 
                } 
            } 

            // -------------------------- COMPROBANTE DE DOMICILIO --------------------------
            if ($comprobanteDomicilio != NULL) {
                $comprobanteDomiRecuperado  = $negocio->getComprobanteDomicilio()->last();
                if ( $comprobanteDomiRecuperado != false ){ 
                    $comporbanteDom = $comprobanteDomiRecuperado;
                    $comporbanteDom->setDocumento(File::get($comprobanteDomicilio));
                    $comporbanteDom->setNombreDocumento($comprobanteDomicilio->getClientOriginalName());
                    $comporbanteDom->setExtensionDocumento($comprobanteDomicilio->getClientOriginalExtension());
                    $comporbanteDom->setMimeTypeDocumento($comprobanteDomicilio->getMimeType());
                    $comporbanteDom->setTamanoDocumento($comprobanteDomicilio->getSize());
                    $comporbanteDom->setFechaAltaDocumento(new \DateTime());
                    $comporbanteDom->setNegocio($negocio);
                    $negocio->addComprobanteDomicilio( $comporbanteDom );
                } else {
                    $comporbanteDom = new ComprobanteDomicilio;
                    $comporbanteDom->setDocumento(File::get($comprobanteDomicilio));
                    $comporbanteDom->setNombreDocumento($comprobanteDomicilio->getClientOriginalName());
                    $comporbanteDom->setExtensionDocumento($comprobanteDomicilio->getClientOriginalExtension());
                    $comporbanteDom->setMimeTypeDocumento($comprobanteDomicilio->getMimeType());
                    $comporbanteDom->setTamanoDocumento($comprobanteDomicilio->getSize());
                    $comporbanteDom->setFechaAltaDocumento(new \DateTime());
                    $comporbanteDom->setNegocio($negocio);
                    $negocio->addComprobanteDomicilio( $comporbanteDom );
                } 
            } 

            // -------------------------- COMPROBANTE FISCAL --------------------------
            if ($comprobanteFiscal != NULL) {
                $comprobanteFisRecuperado  = $negocio->getComprobanteFiscal()->last();
                if ( $comprobanteFisRecuperado != false ){ 
                    $comporbanteFis = $comprobanteFisRecuperado;
                    $comporbanteFis->setDocumento(File::get($comprobanteFiscal));
                    $comporbanteFis->setNombreDocumento($comprobanteFiscal->getClientOriginalName());
                    $comporbanteFis->setExtensionDocumento($comprobanteFiscal->getClientOriginalExtension());
                    $comporbanteFis->setMimeTypeDocumento($comprobanteFiscal->getMimeType());
                    $comporbanteFis->setTamanoDocumento($comprobanteFiscal->getSize());
                    $comporbanteFis->setFechaAltaDocumento(new \DateTime());
                    $comporbanteFis->setNegocio($negocio);
                    $negocio->addComprobanteFiscal( $comporbanteFis );
                } else {
                    $comporbanteFis = new ComprobanteFiscal;
                    $comporbanteFis->setDocumento(File::get($comprobanteFiscal));
                    $comporbanteFis->setNombreDocumento($comprobanteFiscal->getClientOriginalName());
                    $comporbanteFis->setExtensionDocumento($comprobanteFiscal->getClientOriginalExtension());
                    $comporbanteFis->setMimeTypeDocumento($comprobanteFiscal->getMimeType());
                    $comporbanteFis->setTamanoDocumento($comprobanteFiscal->getSize());
                    $comporbanteFis->setFechaAltaDocumento(new \DateTime());
                    $comporbanteFis->setNegocio($negocio);
                    $negocio->addComprobanteFiscal( $comporbanteFis );
                } 
            } 
    
            $tipoStatusE = $this->tipoStatusDao->findById(1);
            //$negocio->setTipoStatus($tipoStatusE);
  
            $negocioActualizado = $this->negocioDao->update($negocio);
            
            /* ------------------ SEGUIMIENTO ----------------------*/
            $usuario = $this->usuarioDao->findByUser( session('usuario') );
            $seguimientos = new Seguimientos;
            $seguimientos->setComentario("Se actualizo la plaza por el usuario: " . $usuario->getNombre() . " " . $usuario->getApellidoPaterno() . " "  . $usuario->getApellidoMaterno() );
            $seguimientos->setNegocio($negocioActualizado);
            $seguimientos->setUsuario($usuario); 
            $seguimientos->setEsAdmin(1);
            $this->seguimientosDao->create($seguimientos);    
        

         

              /*========PUERTAS PLAZAS YA CREADAS========
              ============================================*/
  
            $puertasRecuperadas  = $negocio->getPuertaPlazas();
            $lengPuertas         = count($puertasRecuperadas);
            $arrayPuertasPlazas = array();
            
            foreach ($puertasRecuperadas as $i => $puertaMe) {
                

                $puertasPl = $puertaMe;
                $puertasPl->setNombre($nombrePuertaNueva[$i]);
                $puertasPl->setLatitudPuerta($latitudPuertaNueva[$i]);
                $puertasPl->setLongitudPuerta($longitudPuertaNueva[$i]);
                
                $direccion = $puertasPl->getDireccion();
                $direccion->setCallePrincipal($callePrincipalPuertaNueva[$i]);
                $direccion->setCalle1($calle1PuertaNueva[$i]);
                $direccion->setCalle2($calle2PuertaNueva[$i]);
                $direccion->setNumeroInterior($numeroInterior);
                $direccion->setNumeroExterior($numeroExterior);
                $direccion->setEdificio($edificio);
                $direccion->setTipoAsentamiento($tipoAsentamientoE);
                $direccion->setNombreAsentamiento($nombreAsentamiento);
                $direccion->setColonia($coloniaE);
                $direccion->setCodigoPostal($codigoPostal);
                $puertasPl->setDireccion($direccion);
                
                $tipoDispositivoE = $this->tipoDispositivoDao->findById($tipoDispositivoPuertaNueva[$i]);
                
                $dispositivo = $puertasPl->getDispositivos();
                $dispositivo->setEtiqueta($tipoDispositivoE->getEtiqueta());
                $dispositivo->setTipoDispositivo($tipoDispositivoE);
                $dispositivo->setToken($dispositivo->getToken());
                $tipoStatusE = $this->tipoStatusDao->findById(1);
                $dispositivo->setTipoStatus($tipoStatusE);
               
                
                $puertasPl->setDispositivos($dispositivo);
                $puertasPl->setNegocio($negocio);
                $arrayPuertasPlazas[] = $puertasPl;
                
                $this->puertasPlazasDao->update($puertasPl);
                
            }
            /*========PUERTAS PLAZAS YA CREADAS========
              ============================================*/

            
                /*========PUERTAS PLAZAS NUEVAS========
                ============================================*/

            if ($nombrePuerta > 0) {
                
                $arrayPuertasPlazas  = array();
                $length              = count($nombrePuerta);
                for ($i = 0; $i < $length; $i++) {
                    
                    $puertasPl = new PuertasPlazas;
                    $puertasPl->setNombre($nombrePuerta[$i]);
                    $puertasPl->setLatitudPuerta($latitudPuerta[$i]);
                    $puertasPl->setLongitudPuerta($longitudPuerta[$i]);
                    
                    $direccion = new Direccion;
                    $direccion->setCallePrincipal($callePrincipalPuerta[$i]);
                    $direccion->setCalle1($calle1Puerta[$i]);
                    $direccion->setCalle2($calle2Puerta[$i]);
                    $direccion->setNumeroInterior($numeroInterior);
                    $direccion->setNumeroExterior($numeroExterior);
                    $direccion->setEdificio($edificio);
                    $direccion->setTipoAsentamiento($tipoAsentamientoE);
                    $direccion->setNombreAsentamiento($nombreAsentamiento);
                    $direccion->setColonia($coloniaE);
                    $direccion->setCodigoPostal($codigoPostal);
                    
                    $puertasPl->setDireccion($direccion);

                    $tipoDispositivoE = $this->tipoDispositivoDao->findById($tipoDispositivoPuerta[$i]);
                    $dispositivo      = new Dispositivo;
                    $dispositivo->setEtiqueta($tipoDispositivoE->getEtiqueta());
                    $dispositivo->setTipoDispositivo($tipoDispositivoE);
                    $dispositivo->setNumeroActualizacion( "0" );
                    $dispositivo->setToken(sha1($negocio->getId() . $negocio->getNombre() . $tipoDispositivoE->getId().$i."PLAZAS"));
                    $tipoStatusE = $this->tipoStatusDao->findById(1);
                    $dispositivo->setTipoStatus($tipoStatusE);
                    
                    $puertasPl->setDispositivos($dispositivo);
                    $puertasPl->setNegocio($negocio);
                    $arrayPuertasPlazas[] = $puertasPl;
                    
                    $this->puertasPlazasDao->create($puertasPl);
                    
                }
                
            }
          //END 

            $this->loggerDao->create(new Logger("Ha actualizado a la plaza: " . $nombre));
            return Redirect::to("/administracion/plazas/puertas/" . $id . "/edit" )->with('mensaje', 'actualizado correctamente!.');
        } /*==END ELSE==*/
    }/*==UPDATE==*/
    


        
    /**===========================================================================================================================================
    ***===========================================================================================================================================
    *   
    *                                       SERVICIOS REST  SERVICIOS REST SERVICIOS REST
    *===========================================================================================================================================
    *===========================================================================================================================================*/

    /**  VALIDADO */
    public function listAllJsonPlazasPuertas(Request $request)
    {
        $firstResult = $request->get('start');
        $maxResult   = $request->get('length');
        $draw        = $request->get('draw');
        $buscar      = $request->get('search')['value'];
        $data = $this->negocioDao->listAllJsonPlazasPuertas( $draw,  $maxResult , $firstResult , $buscar );
        return response( $data , 200 )->header('Content-Type', 'application/json');
    } 
   
    
    /**  VALIDADO */  
    public function establecimientosPlaza( $id ) 
    {        
        $establecimientos = $this->negocioDao->findByIdPlaza($id);       

        $establecimientoArreglo = array();
        foreach( $establecimientos as $indice => $establecimiento ){
 
            $cadenasArreglo = array();
            foreach( $establecimiento->getCadenas() as $indice => $cadena ){
                $arreglo = array(
                    "id" => $cadena->getId(),
                    "etiqueta" => $cadena->getEtiqueta(),
                    "fechaAlta" => $cadena->getFechaAlta(), 
                    "status" => $cadena->getStatus() ? "Activo" : "No activo" 
                ); 
                $cadenasArreglo[] = $arreglo;
            }    

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
                "cadenas"     => $cadenasArreglo, 
                "giro"        => $establecimiento->getGiroNegocio()->getEtiqueta(), 
                "tipoNegocio" => $establecimiento->getTipoNegocio()->getEtiqueta(), 
                "telefono"    => $establecimiento->getTelefono(), 
                "extension"   => $establecimiento->getExtension(), 
                "referencias" => $establecimiento->getReferencia(), 
                "fechaAlta"   => $establecimiento->getFechaAlta(), 
                "status"      => $establecimiento->getStatus() ? "Activo" : "No activo" 
            ); 
            $establecimientoArreglo[] = $arreglo;

        } 
        return response( $establecimientoArreglo , 200)->header('Content-Type', 'application/json');
    }        



    /**  VALIDADO */  
    public function establecimientosEncargado($id) 
    {     
        $establecimientos = $this->negocioDao->findByIdEncargado($id);       

        $establecimientoArreglo = array();
        foreach( $establecimientos as $indice => $establecimiento ){

            $cadenasArreglo = array();
            foreach( $establecimiento->getCadenas() as $indice => $cadena ){
                $arreglo = array(
                    "id" => $cadena->getId(),
                    "etiqueta" => $cadena->getEtiqueta(),
                    "fechaAlta" => $cadena->getFechaAlta(), 
                    "status" => $cadena->getStatus() ? "Activo" : "No activo" 
                ); 
                $cadenasArreglo[] = $arreglo;
            }   

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
                "cadenas"     => $cadenasArreglo, 
                "giro"        => $establecimiento->getGiroNegocio()->getEtiqueta(), 
                "tipoNegocio" => $establecimiento->getTipoNegocio()->getEtiqueta(), 
                "telefono"    => $establecimiento->getTelefono(), 
                "extension"   => $establecimiento->getExtension(), 
                "referencias" => $establecimiento->getReferencia(), 
                "fechaAlta"   => $establecimiento->getFechaAlta(), 
                "status"      => $establecimiento->getStatus() ? "Activo" : "No activo" 
            ); 
            $establecimientoArreglo[] = $arreglo;

        } 
        return response( $establecimientoArreglo , 200)->header('Content-Type', 'application/json');
    }        


    public function findById($id)
    { 
        $negocio      =  $this->negocioDao->findById($id);  
        
        // MOTIVOS DE ALTA Y DE BAJA
        $motivoAltaBajaArreglo = array();   
        foreach( $negocio->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
            $arreglo = array(    
              "id" => $motivoAltaBaja->getId(),
              "contenido" => $motivoAltaBaja->getContenido(),   
              "tipo" => $motivoAltaBaja->getTipo(), 
              "usuario" => $motivoAltaBaja->getUsuario(),    
              "fechaAlta" => $motivoAltaBaja->getFechaAlta()
            );
            $motivoAltaBajaArreglo[] = $arreglo;
        }   

        // ENCARGADOS
        $encargadosArreglo = array();      
        foreach( $negocio->getEncargados() as $indice => $encargado ){
            $arreglo = array(        
              "id"              => $encargado->getId(),
              "nombre"          => $encargado->getNombre(),   
              "apellidoPaterno" => $encargado->getApellidoPaterno(), 
              "apellidoMaterno" => $encargado->getApellidoMaterno(),      
              "tipoEncargado"   => $encargado->getTipoEncargado()->getEtiqueta(),   
              "telefono"        => $encargado->getTelefono(),
              "extension"       => $encargado->getExtension(),    
              "celular"         => $encargado->getCelular(),    
              "correo"          => $encargado->getCorreo(),    
              "numeroAsociaciones"    => COUNT( $encargado->getAsociaciones() ),    
              "numeroCadenas"         => COUNT( $encargado->getCadenas() ),   
              "numeroNegocios"        => COUNT( $encargado->getNegocios() ),   
              "numeroPlazas"          => COUNT( $encargado->getPlazas() ),   
              "fechaAlta"       => $encargado->getFechaAlta(),
              "status"          => $encargado->getStatus()  
            );
            $encargadosArreglo[] = $arreglo;
        }   

        // DIRECCION DEL NEGOCIO
        $direccionE = $negocio->getDireccion();
        $direccion = array(    
            "id" => $direccionE->getId(),
            "callePrincipal" => $direccionE->getCallePrincipal(),   
            "calle1" => $direccionE->getCalle1(), 
            "calle2" => $direccionE->getCalle2(),    
            "numeroInterior" => $direccionE->getNumeroInterior(),    
            "numeroExterior" => $direccionE->getNumeroExterior(),    
            "edificio" => $direccionE->getEdificio(),    
            "tipoAsentamiento" => $direccionE->getTipoAsentamiento()->getEtiqueta(),    
            "nombreAsentamiento" => $direccionE->getNombreAsentamiento(),
            "colonia" => $direccionE->getColonia()->getEtiqueta(),
            "delegacion" => $direccionE->getColonia()->getDelegacion()->getEtiqueta(),
            "codigoPostal" => $direccionE->getCodigoPostal()
        );    

        // DIRECCION DE LA PLAZA
        $plazaE = $negocio->getPlaza();  
        $plaza = "No tiene";
        $direccionPlaza = "No tiene";
        if( $plazaE != null ){
            $direccionPlazaE = $plazaE->getDireccion();  
            $direccionPlaza = array(    
                "id" => $direccionPlazaE->getId(),
                "callePrincipal" => $direccionPlazaE->getCallePrincipal(),   
                "calle1" => $direccionPlazaE->getCalle1(), 
                "calle2" => $direccionPlazaE->getCalle2(),    
                "numeroInterior" => $direccionPlazaE->getNumeroInterior(),    
                "numeroExterior" => $direccionPlazaE->getNumeroExterior(),    
                "edificio" => $direccionPlazaE->getEdificio(),    
                "tipoAsentamiento" => $direccionPlazaE->getTipoAsentamiento()->getEtiqueta(),    
                "nombreAsentamiento" => $direccionPlazaE->getNombreAsentamiento(),
                "colonia" => $direccionPlazaE->getColonia()->getEtiqueta(),
                "delegacion" => $direccionPlazaE->getColonia()->getDelegacion()->getEtiqueta(),
                "codigoPostal" => $direccionPlazaE->getCodigoPostal()
            );    
            // PLAZA 
            $plaza = array(        
                "id" => $plazaE->getId(),  
                "etiqueta" => $plazaE->getEtiqueta(),    
                "alias" => $plazaE->getAlias(),
                "direccion" => $direccionPlaza, 
                "telefono" => $plazaE->getTelefono(),    
                "extension" => $plazaE->getExtension(),    
                "status" => $plazaE->getStatus(),    
                "fechaAlta" => $plazaE->getFechaAlta(),     
            );
        }

        // NEGOCIO
        $arreglo = array(
            "id"     => $negocio->getId(),
            "placaMpn"  => $negocio->getPlacaMPN() ? "Tiene" : "No Tiene",
            "nombre" => $negocio->getNombre(),     
            "razonSocial"  => $negocio->getRazonSocial(),    
            "direccion"  => $direccion,     
            "tipoNegocio"  => $negocio->getTipoNegocio()->getEtiqueta(),          
            "giroNegocio"  => $negocio->getGiroNegocio()->getEtiqueta(),        
            //"plaza"  => $plaza,
            "piso"  => $negocio->getPiso() != null ? $negocio->getPiso() : "No Tiene",       
            "referencia"  => $negocio->getReferencia(),

            "encargados" => $encargadosArreglo,
 
            "latitud" => $negocio->getLatitud(),     
            "longitud" => $negocio->getLongitud(),    
            "telefono" => $negocio->getTelefono(),    
            "extension" => $negocio->getExtension(),    
            "tipoStatus" => $negocio->getTipoStatus()->getEtiqueta(),      
            "negocioGeneral" => $negocio->getGiroNegocioGeneral()->getEtiqueta(),      
            "statusRevisionNegocio" => $negocio->getStatusRevisionNegocio() ==null ? "No Tiene" : $negocio->getStatusRevisionNegocio()->getEtiqueta(),   

            "fechaAlta" => $negocio->getFechaAlta(),
            "status" => $negocio->getStatus() ? "Activo" : "No activo",
            "motivosAltaBaja" => $motivoAltaBajaArreglo
        );
        return response( $arreglo , 200)->header('Content-Type', 'application/json');   
    }


      
    public function dispositivosMercados($id)
    { 
        $negocio =  $this->negocioDao->findById($id);  

        // DISPOSITIVOS DEL NEGOCIO  
    
        foreach( $negocio->getPuertaPlazas() as $indice => $puerta ){
       
        

            // MOTIVOS DE ALTA Y DE BAJA
            $motivoAltaBajaArreglo = array();   

            foreach( $puerta->getDispositivos()->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
                $arreglo = array(      
                    "id" => $motivoAltaBaja->getId(),
                    "contenido" => $motivoAltaBaja->getContenido(),   
                    "tipo" => $motivoAltaBaja->getTipo(), 
                    "usuario" => $motivoAltaBaja->getUsuario(),    
                    "fechaAlta" => $motivoAltaBaja->getFechaAlta()
                );  
                $motivoAltaBajaArreglo[] = $arreglo;
            }
            $arreglo = array(
              "id" => $puerta->getDispositivos()->getId(),
              "etiqueta" => $puerta->getDispositivos()->getEtiqueta(),   
              "tipoDispositivo" => $puerta->getDispositivos()->getTipoDispositivo()->getEtiqueta(),    
              "token" => $puerta->getDispositivos()->getToken(),    
              "cantidad" => $puerta->getDispositivos()->getCantidad(),    
              "tipoStatus" => $puerta->getDispositivos()->getTipoStatus()->getEtiqueta(),    
              "numeroActualizacion" => $puerta->getDispositivos()->getNumeroActualizacion(),
              "status" => $puerta->getDispositivos()->getStatus() ? "Activo" : "No activo",
              "fechaAlta" => $puerta->getDispositivos()->getFechaAlta(),
              "motivosAltaBaja" => $motivoAltaBajaArreglo
            );    
            $dispositivosArreglo[] = $arreglo;
        
    }
        return response( $dispositivosArreglo , 200)->header('Content-Type', 'application/json');   
    }


    public function dispositivosEstablecimiento($id)
    { 
        $negocio =  $this->negocioDao->findById($id);  

        // DISPOSITIVOS DEL NEGOCIO   
        $dispositivosArreglo = array();   
        foreach( $negocio->getDispositivos() as $indice => $dispositivo ){

            // MOTIVOS DE ALTA Y DE BAJA
            $motivoAltaBajaArreglo = array();   
            foreach( $dispositivo->getMotivosAltaBaja() as $indice => $motivoAltaBaja ){
                $arreglo = array(      
                    "id" => $motivoAltaBaja->getId(),
                    "contenido" => $motivoAltaBaja->getContenido(),   
                    "tipo" => $motivoAltaBaja->getTipo(), 
                    "usuario" => $motivoAltaBaja->getUsuario(),    
                    "fechaAlta" => $motivoAltaBaja->getFechaAlta()
                );  
                $motivoAltaBajaArreglo[] = $arreglo;
            }
            $arreglo = array(
              "id" => $dispositivo->getId(),
              "etiqueta" => $dispositivo->getEtiqueta(),   
              "tipoDispositivo" => $dispositivo->getTipoDispositivo()->getEtiqueta(),    
              "token" => $dispositivo->getToken(),    
              "cantidad" => $dispositivo->getCantidad(),    
              "tipoStatus" => $dispositivo->getTipoStatus()->getEtiqueta(),    
              "numeroActualizacion" => $dispositivo->getNumeroActualizacion(),
              "status" => $dispositivo->getStatus() ? "Activo" : "No activo",
              "fechaAlta" => $dispositivo->getFechaAlta(),
              "motivosAltaBaja" => $motivoAltaBajaArreglo
            );    
            $dispositivosArreglo[] = $arreglo;
        }
        return response( $dispositivosArreglo , 200)->header('Content-Type', 'application/json');   
    }

    

    public function deshabilitar(Request $request)
    {

        $usuario = $this->usuarioDao->findByUser( session('usuario') );
        
        


        $request->merge(array_map('trim', $request->all() ));
        $id              = $request->get('id');
        $motivoAltaBaja  = $request->get('motivoAltaBaja');

        $negocio = $this->negocioDao->findById($id);

        $negocio->setStatus(false);

        $negocioArray = array();
        $negocioArray[] = $negocio;

        $motivoAltaBajaE = new MotivoAltaBaja;
        $motivoAltaBajaE->setContenido( $motivoAltaBaja );
        $motivoAltaBajaE->setNegocios( $negocioArray );
        $motivoAltaBajaE->setTipo( "Deshabilitado" );
        $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );

        $negocio->addMotivoAltaBaja($motivoAltaBajaE);

        $usuario = $this->usuarioDao->findByUser( session('usuario') );
        
         $seguimientos = new Seguimientos;
         $seguimientos->setComentario($motivoAltaBaja);
         $seguimientos->setNegocio($negocio);
         $seguimientos->setUsuario($usuario); 
         $seguimientos->setEsAdmin(1);
 
        $this->seguimientosDao->create($seguimientos); 
   
        $this->negocioDao->update( $negocio );
        $this->loggerDao->create( new Logger("Ha deshabilitado al negocio (plaza): ". $negocio->getNombre()." con el ID: ".$negocio->getId() ) );

        return response( 200 , 200)->header('Content-Type', 'application/json');   
    }

     
    public function habilitar(Request $request)
    {
        $request->merge(array_map('trim', $request->all() ));
        $id              = $request->get('id');
        $motivoAltaBaja  = $request->get('motivoAltaBaja');

        $negocio = $this->negocioDao->findById($id);

        $negocio->setStatus(true);

        $negocioArray = array();
        $negocioArray[] = $negocio;

        $motivoAltaBajaE = new MotivoAltaBaja;
        $motivoAltaBajaE->setContenido( $motivoAltaBaja );
        $motivoAltaBajaE->setNegocios( $negocioArray );
        $motivoAltaBajaE->setTipo( "Habilitado" );
        $motivoAltaBajaE->setUsuario( $request->session()->get('usuario') );

        $negocio->addMotivoAltaBaja($motivoAltaBajaE);

        $usuario = $this->usuarioDao->findByUser( session('usuario') );

         $seguimientos = new Seguimientos;
         $seguimientos->setComentario($motivoAltaBaja);
         $seguimientos->setNegocio($negocio);
         $seguimientos->setUsuario($usuario); 
         $seguimientos->setEsAdmin(1);
 
        $this->seguimientosDao->create($seguimientos); 

        $this->negocioDao->update( $negocio );
        $this->loggerDao->create( new Logger("Ha habilitado al establecimiento (plaza): ". $negocio->getNombre()." con el ID: ".$negocio->getId() ) );
        
        return response( 200 , 200)->header('Content-Type', 'application/json');  
    }
   

    public function obtenerEstablecimientosRango($fechaInicio, $fechaFin)
    {
        $json = $this->negocioDao->listAllRangoJson($fechaInicio, $fechaFin);
        echo json_encode($json);
    }   



    public function actualizarToken(Request $request){
        
        $idDispositivo = $request->get('idDispositivo');
        $dispositivo = $this->dispositivoDao->findById($idDispositivo);  
        $negocio = $dispositivo->getNegocio();
        $isPlaza = $negocio;
        $tipoDispositivo = $dispositivo->getTipoDispositivo();
        
        if( $isPlaza == null ){//ES UNA PLAZA
            $puertasPlazas = $dispositivo->getPuertasPlazas();   
            $negocio = $puertasPlazas->getNegocio();
        } 
        
        if( $dispositivo->getNumeroActualizacion() == null ){
            $dispositivo->setToken( sha1($negocio->getId() . $negocio->getNombre() . $tipoDispositivo->getId().$dispositivo->getId()."1"."actualizado") );
            $dispositivo->setNumeroActualizacion("1");
        } else{
            $numeroActualizacion = ( intval( $dispositivo->getNumeroActualizacion() ) + 1);
            $dispositivo->setToken( sha1($negocio->getId() . $negocio->getNombre() . $tipoDispositivo->getId().$dispositivo->getId() . $numeroActualizacion ) );
            $dispositivo->setNumeroActualizacion( $numeroActualizacion);
        }
        $this->dispositivoDao->update( $dispositivo );
    }



}
