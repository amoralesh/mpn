<?php

namespace App\Http\Controllers\Administracion\Invitacion;

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
use Storage;
use Config;
   
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
  protected $documentos;
  
    
  public function __construct(
    NegocioDao $NegocioDao,
    SeguimientosDao $SeguimientosDao,
    UsuarioDao $UsuarioDao,  
    TipoEncargadoDao $TipoEncargadoDao, 
    EncargadoDao $EncargadoDao)
  {
      $this->middleware('auth');
        
      $this->middleware('hasPermission:Administracion:Aside:Invitacion',[ 'only' => ['index' ]] );
      $this->middleware('hasPermission:Administracion:Invitacion:Crear',[ 'only' => ['create' ]] );
      $this->middleware('hasPermission:Administracion:Invitacion:Guardar',[ 'only' => ['store' ]] );

      $this->middleware('formatearTexto',[ 'only' => [ 'store' , 'update' ]] );

      /* ENTITIES DAO */ 
      $this->negocioDao = $NegocioDao;
      $this->seguimientosDao = $SeguimientosDao;
      $this->usuarioDao = $UsuarioDao;
      $this->tipoEncargadoDao = $TipoEncargadoDao;
      $this->encargadoDao = $EncargadoDao;
  }
 
  public function index()
  {    
    $data['tipoEncargadoList'] = $this->tipoEncargadoDao->listAll();
    return view('administracion.invitacion.index', $data); 
  }
   
   
    
  public function store(Request $request)
  {
      $nombre          = $request->get('nombre');
      $apellidoPaterno = $request->get('apellidoPaterno');
      $apellidoMaterno = $request->get('apellidoMaterno');
      $correo          = $request->get('correo');
      $telefonoCelular = $request->get('telefonoCelular');
      $telefono        = $request->get('telefono');
      $extension       = $request->get('extension');
      $tipoEncargado   = $request->get('tipoEncargado');
      $mensajeCorreo   = $request->get('mensajeCorreo');
      $documentos      = $request->file('documentos');

      $rules = array(
        'nombre'            => 'required|max:100',
        'apellidoPaterno'   => 'required|max:100',
        'apellidoMaterno'   => 'required|max:100', 
        'correo'            => 'required|email', 
        'telefonoCelular'   => 'required_without_all:telefono',   
        'telefono'          => 'required_without_all:telefonoCelular',
        'tipoEncargado'     => 'required',
        'mensajeCorreo'     => 'required'
      );
      $messages = array(
          'required' => 'El campo :attribute es obligatorio.',
          'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
          'max' => 'El campo :attribute no puede tener más de :max carácteres.',
          'unique' => 'El contenido en :attribute, ya existe en la base de datos'
      );

      $validation = Validator::make($request->all(), $rules, $messages);
      if ($validation->fails())
      {
          return Redirect::to("/administracion/invitacion")->with('errores','Woops algo esta mal!.')->withErrors($validation)->withInput();
      }
      else 
      { 
             
          $encargado = $this->encargadoDao->findByCorreo($correo);
          
          if( $encargado == FALSE ){
              $encargado = new Encargado;
              $encargado->setNombre( $nombre );
              $encargado->setApellidoPaterno( $apellidoPaterno );
              $encargado->setApellidoMaterno( $apellidoMaterno );
              $encargado->setCorreo( $correo );    
              $encargado->setCelular( $telefonoCelular );
              $encargado->setTelefono( $telefono );
              $encargado->setExtension( $extension );
              
              $tipoEncargadoE = $this->tipoEncargadoDao->findById($tipoEncargado );
              $encargado->setTipoEncargado($tipoEncargadoE);
              
              $this->encargadoDao->create( $encargado );
          }


          try {

              $this->setDocumentos( $documentos );
              $this->setTitulo( "Invitación Mi Policía en mi Negocio" );
              $this->setContenido( $mensajeCorreo );
              $this->setTo( $correo );
              
              //$usuario  = "jgcolin@ssp.df.gob.mx";
              $usuarioRecuperado = $this->usuarioDao->findByUser( session('usuario') );
              $usuario = $usuarioRecuperado->getUsuario();
              $password = $usuarioRecuperado->getPassword();
              
              Config::set('mail.driver', "smtp" );
              Config::set('mail.host', "correo.ssp.df.gob.mx"  );
              Config::set('mail.port', 25 );
              Config::set('mail.encryption', "tls" );   
              Config::set('mail.username', $usuario  );
              Config::set('mail.password', $password );
              
              Mail::send( [] , [], function ($message) {

                  $message->to( $this->getTo() );
                  $message->subject( $this->getTitulo() );
                  $message->setBody( $this->getContenido(), 'text/html' ); 
                  $message->cc('jgcolin@ssp.cdmx.gob.mx', 'José Gilberto Colin');
                  $message->cc('afrappe@ssp.cdmx.gob.mx', 'Arturo Frappe Muñoz');

                  foreach( $this->getDocumentos() as $indice => $documento ){
                    $message->attach( $documento );   
                  }

                  $path = "/invitacion/prueba.pdf";
                  $message->attach( storage_path($path) ); 

              });
              
              return Redirect::to("/administracion/invitacion")->with('mensaje','Correo enviado con exito!.');

          } catch( \Exception $e ) {
              return Redirect::to("/administracion/invitacion")->with('errores','Correo no enviado!.')->withErrors($validation)->withInput();
          }

      }
    }    



  function getTitulo(){
    return $this->title;
  }
    
  function setTitulo($titulo){
    $this->title = $titulo;
  }

  function getContenido(){
    return $this->content;
  }
      
  function setContenido($content){
    $this->content = $content;
  }

  function getTo(){
    return $this->to;
  }

  function setTo( $to ){
    $this->to = $to;
  }
  

  function getDocumentos(){
    return $this->documentos;
  }

  function setDocumentos( $documentos ){
    $this->documentos = $documentos;
  }
  
  
  
      
}

