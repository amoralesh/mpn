<?php

namespace App\Http\Controllers\Administracion\Seguimientos;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */  
use App\Entities\Seguimientos;
use App\Entities\Encargado;

/* DAOS */
use App\Daos\NegocioDao;
use App\Daos\SeguimientosDao;
use App\Daos\Usuarios\UsuarioDao;
use App\Daos\TipoEncargadoDao;
use App\Daos\EncargadoDao;

/* EVENTOS SOCKET */    

     
/* LIBRERIAS */   
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use File;  
use Mail;
use Session;

class MainController extends Controller
  {
    
    /* ENTITIES DAO */
    protected $negocioDao;
    protected $seguimientosDao;
    protected $usuarioDao;
    protected $tipoEncargadoDao;
    protected $encargadoDao;

    protected $title;
    protected $content;
    protected $to;
    
    public function __construct(

    NegocioDao $NegocioDao,
    SeguimientosDao $SeguimientosDao,
    UsuarioDao $UsuarioDao,
    TipoEncargadoDao $TipoEncargadoDao, 
    EncargadoDao $EncargadoDao)
    {
        $this->middleware('auth');
        /* ENTITIES DAO */
        $this->negocioDao = $NegocioDao;
        $this->seguimientosDao = $SeguimientosDao;
        $this->usuarioDao = $UsuarioDao;
        $this->tipoEncargadoDao = $TipoEncargadoDao;
        $this->encargadoDao = $EncargadoDao;
    }


    public function index()
    {  
        return view('administracion.seguimientos.index'); 
    }     
    

    public function show($id)
    {
        $data['negocio'] = $this->negocioDao->findById( $id );
        
        return view('administracion.seguimientos.show', $data ); 
        //echo "hola";
    }


    public function nuevoSeguimiento( Request $request )
    {
        $id = $request->get('id');  
        $contenido = $request->get('contenido'); 
     
        $negocio = $this->negocioDao->findById( $id ); 
        $usuario = $this->usuarioDao->findByUser( session('usuario') );
       
        $seguimientos = new Seguimientos;
        $seguimientos->setComentario($contenido);
        $seguimientos->setNegocio($negocio);
        $seguimientos->setUsuario($usuario); 
        $seguimientos->setEsAdmin(1);

        $this->seguimientosDao->create($seguimientos);  
        return response( 200 , 200)->header('Content-Type', 'application/json');   
    }

    


}

