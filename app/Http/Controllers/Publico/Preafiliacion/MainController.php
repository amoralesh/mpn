<?php

namespace App\Http\Controllers\Publico\Preafiliacion;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */
use App\Entities\PreAfiliacion;

/* DAOS */
use App\Daos\DelegacionDao;
use App\Daos\PreAfiliacionDao;
use App\Daos\StatusPreAfiliacionDao;
      
/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Predis\Connection\ConnectionException;
use Illuminate\Http\Request;
use File;


class MainController extends Controller
{

  /* ENTITIES DAO */
  protected $delegacionDao;
 
  public function __construct( 
   DelegacionDao           $DelegacionDao
  ,PreAfiliacionDao        $PreAfiliacionDao
  ,StatusPreAfiliacionDao  $StatusPreAfiliacionDao)   
  {
    /* ENTITIES DAO */
    $this->delegacionDao            = $DelegacionDao;
    $this->preAfiliacionDao         = $PreAfiliacionDao;
    $this->statusPreAfiliacionDao   = $StatusPreAfiliacionDao;
   
  }
  
  public function index()
  { 

    $data['delegacionList']       = $this->delegacionDao->listAll();
     return view('publico.preafiliacion.index',$data);
  }


    
  public function store(Request $request)
  { 
    $nombre          = $request->get('nombre');
    $apellidoP       = $request->get('apellidoP');
    $apellidoM       = $request->get('apellidoM');
    $nombreNegocio   = $request->get('nombreNegocio');
    $telefono        = $request->get('telefono');
    $extension       = $request->get('extension');
    $celular         = $request->get('celular');
    $email           = $request->get('email');  
    $delegacion      = $request->get('delegacion');   
 
   

    $rules = array(
      'nombre'        => 'required|max:250',
      'apellidoP'     => 'required|max:250',
      'apellidoM'     => 'required|max:250',
      'telefono'      => 'required|max:250',
      'extension'     => 'required|max:250',
      'celular'       => 'required|max:250',
      'email'         => 'required|max:250',
      'extension'     => 'required|max:250',
      'delegacion'    => 'required'
     
   
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
    return Redirect::to("/preafiliacion")->with('errores', 'Woops algo esta mal!.')->withErrors($validation)->withInput();

     }else {


     


      $preAfiliacion = new PreAfiliacion;
      $preAfiliacion->setNombre($nombre);
      $preAfiliacion->setApellidoP($apellidoP);
      $preAfiliacion->setApellidoM($apellidoM);
      $preAfiliacion->setNombreNegocio($nombreNegocio);
      $preAfiliacion->setTelefono($telefono);
      $preAfiliacion->setExt($extension);
      $preAfiliacion->setCelular($celular);
      $preAfiliacion->setCorreo($email);

      $delegacionD = $this->delegacionDao->findById($delegacion);
      $preAfiliacion->setDelegacion($delegacionD);

      $statusPre = $this->statusPreAfiliacionDao->findById(1);
      $preAfiliacion->setStatusPreAfiliacion($statusPre);


      $preAfiliacionCreada = $this->preAfiliacionDao->create($preAfiliacion);

  

      return Redirect::to("/preafiliacion")->with('mensaje', 'Registrado correctamente. Pronto nos pondremos en contacto con usted!. Su Folio de registro es : SSP-CDMX-'.$preAfiliacionCreada->getId());


    }

  }




}


