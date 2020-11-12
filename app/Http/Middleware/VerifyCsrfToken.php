<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * 
     * @var array
     */
    protected $except = [
        
        '/ws/cco/alertas/rango',
        '/ws/cco/establecimiento/{idEstablecimiento}',
        '/ws/cco/asociaciones/establecimiento/{idEstablecimiento}',
        '/ws/cco/cadenas/establecimiento/{idEstablecimiento}',
        '/ws/cco/plazas/establecimiento/{idEstablecimiento}',
        
        '/rest/publico/ws/cco/alarma/negocio',
        '/rest/publico/ws/cco/sectores',
        '/rest/publico/ws/cco/alarma/negocio/razon',
        '/rest/publico/ws/cco/alarma/negocio/reporta',
        '/rest/publico/ws/cco/alarma/negocio/participacion',
        '/rest/publico/ws/cco/alarma/negocio/informe',

        '/administracion/rest/establecimientos/codigoaguila',
        '/administracion/rest/establecimientos/codigoaguila/ids',
        '/administracion/rest/encargados/codigoaguila',
        '/administracion/rest/encargados/codigoaguila/ids',

        // APLICACION MOVIL 
        '/mobile/login',
        '/mobile/logout',
        '/mobile/rest/establecimientos/mapa',
        '/mobile/rest/establecimientos',
        '/mobile/rest/pruebas',
        '/mobile/rest/alertas',
        '/mobile/rest/dispositivos',
        '/mobile/rest/retroalimentacion',

        '/administracion/rest/mpnapp/delegaciones',
        '/administracion/rest/mpnapp/colonias',
        '/administracion/rest/mpnapp/tipoencargado'
    ];    
}
     