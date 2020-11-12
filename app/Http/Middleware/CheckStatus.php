<?php

namespace App\Http\Middleware;

use Closure; 
use Session;

use App\Daos\AsociacionDao;
use App\Daos\CadenaDao;
use App\Daos\DelegacionDao;
        
class CheckStatus
{     
    protected $info0  = array('code' => 500, 'title' => 'Error', 'message' => 'Algo salió mal en el middleware "CheckStatus"!' );
    protected $info1  = array('code' => 401, 'title' => 'Acceso denegado', 'message' => 'Verifica tus permisos!' );
    protected $info2  = array('code' => 410, 'title' => 'Acción no valida', 'message' => 'Deshabilitado, no se puede modificar de ningún modo!' );
         
    public function __construct( AsociacionDao $AsociacionDao
    ,CadenaDao $CadenaDao
    ,DelegacionDao $DelegacionDao ) {
        $this->asociacionDao = $AsociacionDao;
        $this->cadenaDao = $CadenaDao;
        $this->delegacionDao = $DelegacionDao;
    }

  
    public function handle( $request , Closure $next )   
    {  
        $activo = true; 
        //var_dump(  $request->route()->parameters() ); 
        if( !in_array( 'Administracion:Master:Actualizar' , Session::get('permisos') ))
        {
            if ( $request->isMethod('post') ) {
    
            } else if( $request->isMethod('get') || $request->isMethod('PUT') ){
                $activo = $this->isActivo( $request );  
            }

            if( !$activo ){ 
                return \Response::view('errors.errores', $this->info2 , $this->info2['code'] );
            }
        }
        return $next($request); 
    }

    

    /**
     * 
     * FUNCIONES 
     */
    public function isActivo( $request ) {  

        $activo = true;
        $asociacion = $request->route('asociacione') !== NULL ? $request->route('asociacione') : null;
        $cadena = $request->route('cadena') !== NULL ? $request->route('cadena') : null;
        $delegacion = $request->route('delegacione') !== NULL ? $request->route('delegacione') : null;

        if( $asociacion != NULL ){
            $activo = $this->validarAsociacion( $asociacion );   
        } 
        if( $cadena != NULL ){
            $activo = $this->validarCadena( $cadena );   
        }
        if( $delegacion != NULL ){
            $activo = $this->validarDelegacion( $delegacion );   
        }
        return $activo;
    }

    public function validarAsociacion( $id )
    {
        $asociacion = $this->asociacionDao->findById( $id ); // PERSONAL QUE VAMOS A VALIDAR
        return $asociacion->getStatus(); 
    }


    public function validarCadena( $id )
    {
        $cadena = $this->cadenaDao->findById( $id ); // PERSONAL QUE VAMOS A VALIDAR
        return $cadena->getStatus(); 
    }
    
    public function validarDelegacion( $id )
    {
        $delegacion = $this->delegacionDao->findById( $id ); // PERSONAL QUE VAMOS A VALIDAR
        return true; // POR QUE LA ENTIDAD NO TIENE STATUS 
        //return $delegacion->getStatus(); 
    }
    

}
