<?php
namespace App\Http\Controllers\Administracion\Soporte;

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

    public function __construct(SoporteDao $SoporteDao)
    {
        $this->middleware('auth');
        $this->middleware('hasPermission:Administracion:AsideControlls:Soporte',[ 'only' => ['index','listadoJsonSoporte']] );
        $this->soporteDao = $SoporteDao;
    }
      
    public function index()     
    {   
        return view('administracion.soporte.index');
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

            return Redirect::to('/')->with('mensaje','Mensaje enviado correctamente!. Su folio es: ' . $soporteE->getId() );
        }
    }



    public function listadoJsonSoporte()     
    {   
        //, "foto" => base64_encode(stream_get_contents( $masBuscados->getFoto() ) )
        $soporteList = $this->soporteDao->listAll(); 
        $soporteArray = array();
        
        foreach ($soporteList as $index => $soporte) {
            $documentosArray = array();    
            foreach ( $soporte->getDocumentosSoporte() as $index2 => $documento) {
                $arreglo = array( "documentos" => base64_encode( pack( 'H*' , stream_get_contents( $documento->getDocumento() ) )  ));
                $documentosArray[] = $arreglo;   
            }
            $arreglo = array( "id" => $soporte->getId()
                        , "nombre" => $soporte->getNombre()
                        , "email" =>  $soporte->getEmail()
                        , "asunto" => $soporte->getAsunto()
                        , "problema" => $soporte->getProblema()
                        , "documento" => $documentosArray
                    );
            $soporteArray[] = $arreglo;
        }
        return response( $soporteArray , 200)->header('Content-Type', 'application/json;');
    }  

}

