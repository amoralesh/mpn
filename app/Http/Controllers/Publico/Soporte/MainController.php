<?php
namespace App\Http\Controllers\Publico\Soporte;

/* ENTITIES */  
use App\Entities\Soporte\Soporte;
use App\Entities\Soporte\DocumentoSoporte;

/* DAOS */
use App\Daos\Soporte\SoporteDao;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Hash;
use Session; 
use File;  

class MainController extends Controller
{ 
    
    protected $soporteDao;
    protected $info = array('code' => 403, 'title' => 'Acceso denegado', 'message' => 'Verifica tus permisos!' );

    public function __construct(SoporteDao $SoporteDao)
    {

        $this->soporteDao = $SoporteDao;
    }
     
    public function index()     
    {   
        if( Session::get('permisos') == null){
            return Redirect::to('login')->with('errores','Sesión expirada!.');
        }
        if( !in_array( 'AsideControlls:soporte' , Session::get('permisos') ))
        {  return \Response::view('errors.errores', $this->info , $this->info['code'] ); }

        return view('administracion.soporte.Listado');
    }  
  

    public function store(Request $request)
    { 
        $nombre = $request->get("nombre");
        $email = $request->get("email");
        $asunto = $request->get("asunto");
        $problema = $request->get("problema");
        $documentoSoporteList = $request->file("documentoSoporteList");

        $rules = array(
            'nombre'             => 'required',
            'email'              => 'required',
            'asunto'             => 'required',
            'problema'           => 'required',
            'documentoSoporteList'   => 'required'
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El :attribute ya existe'
        );

       $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {
            return Redirect::to('/')->withErrors($validation)->withInput()->with('errores','Error al enviar el mensaje!.');
        } else {

            $soporte = new Soporte;
            $soporte->setNombre($nombre);
            $soporte->setEmail($email);
            $soporte->setAsunto($asunto);
            $soporte->setProblema($problema);

            $arrayDocumentoSoporte = array();
            foreach ( $documentoSoporteList as $indice => $documentoo) {
                $documentoSoporte = new DocumentoSoporte;
                $documentoSoporte->setDocumento( File::get($documentoo) );   
                $documentoSoporte->setNombre( $documentoo->getClientOriginalName() );
                $documentoSoporte->setExtension( $documentoo->getClientOriginalExtension() );
                $documentoSoporte->setMimeType( $documentoo->getMimeType() );
                $documentoSoporte->setTamano( $documentoo->getSize() ); 
                $documentoSoporte->setSoporte($soporte);
                $arrayDocumentoSoporte[] = $documentoSoporte;
            }
            $soporte->setDocumentosSoporte($arrayDocumentoSoporte);
   
            $soporteE = $this->soporteDao->create( $soporte );

            return Redirect::to('/')->with('mensaje','Mensaje enviado correctamente!. Su folio es: <strong>' . $soporteE->getId() .'</strong>' );
        }
    }


    public function listadoJsonSoporte()     
    {   
        //, "foto" => base64_encode(stream_get_contents( $masBuscados->getFoto() ) )
        $soporteList = $this->soporteDao->listAllJson();
        

        $documentosArray = array();
        foreach ($soporteList as $index => $soporte) {
            $arreglo = array( "documentos" =>  base64_encode( pack('H*',stream_get_contents( $soporte['documento'] ) ))  );
            $documentosArray[] = $arreglo;
        }

        $soporteArray = array();
        foreach ($soporteList as $index => $soporte) {

            if( !in_array( "id".$soporte['id'] , $soporteArray )){

                $arreglo = array( "id" => $soporte['id']
                                , "nombre" => $soporte['nombre']
                                , "email" => $soporte['email']
                                , "asunto" => $soporte['asunto']
                                , "problema" => $soporte['problema']
                                , "documento" => $documentosArray
                                );
                $soporteArray[] = $arreglo;
                
            }
            
        }
        return response( array_unique($soporteArray, SORT_REGULAR) , 200)->header('Content-Type', 'application/json;');
    }  


}

