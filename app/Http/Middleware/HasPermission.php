<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class HasPermission
{
    protected $info = array('code' => 401, 'title' => 'Acceso denegado', 'message' => 'Verifica tus permisos!' );
    
    public function handle($request, Closure $next, $permission)
    {   
        if( !in_array( $permission , Session::get('permisos') ))
        { return \Response::view('errors.errores', $this->info , $this->info['code'] ); }

        return $next($request);
    }
}
