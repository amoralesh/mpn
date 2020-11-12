<?php

/*        
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| Actions Handled By Resource Controller
	Verb	      URI	                Action	   Route Name
	------------------------------------------------------------------
	GET	        /photos	                index	  photos.index
	GET	        /photos/create	        create	  photos.create
	POST	    /photos	                store	  photos.store
	GET	        /photos/{photo}	        show	  photos.show
	GET	        /photos/{photo}/edit	edit	  photos.edit
	PUT/PATCH	/photos/{photo}	        update	  photos.update
	DELETE	    /photos/{photo}	        destroy	  photos.destroy
*/
       
   
/*     EN MANTENIMIENTO
Si se desea poner al sistema en mantenimiento , solo basta descomentar el bloque de abajo, este tomara cualquier 
patrón de url y lo mandara a mantenimiento de la página
================================**/
/*
Route::any('{all}', function(){  
    return \Response::view('errors.mantenimiento');
})->where('all', '.*'); 
*/ 
    
/*     LOGIN ADMINISTRADOR
================================**/
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@authenticate');  
Route::get('logout', 'Auth\LoginController@logout');

/*     LOGIN PUBLICO  
================================**/
Route::get('publico/login', 'AuthPublico\LoginController@showLoginForm');
Route::post('publico/login', 'AuthPublico\LoginController@authenticate');  
Route::get('publico/logout', 'AuthPublico\LoginController@logout');

/*     LOGIN MOBILE
================================**/
//Route::get('mobile/login', 'AuthMobile\LoginController@showLoginForm');
Route::post('mobile/login', 'AuthMobile\LoginController@authenticate');  
Route::get('mobile/logout', 'AuthMobile\LoginController@logout');






 

/*     SERVICIOS WEB    SERVICIOS WEB    SERVICIOS WEB 
======================================================================================================================
====================================================================================================================== 
======================================================================================================================  **/ 

/** --------------------- INFORME ---------------------*/
Route::post('/rest/publico/ws/cco/alarma/negocio/informe', 'ServiciosWeb\CCO\Informe\MainController@crearInformeCCO');

/** --------------------- RAZÓN ---------------------*/
Route::get('/rest/publico/ws/cco/alarma/negocio/razon', 'ServiciosWeb\CCO\Razon\MainController@listAllCCO');

/** --------------------- REPORTA ---------------------*/
Route::get('/rest/publico/ws/cco/alarma/negocio/reporta', 'ServiciosWeb\CCO\Reporta\MainController@listAllCCO');

/** --------------------- PARITICPACIÓN ---------------------*/
Route::get('/rest/publico/ws/cco/alarma/negocio/participacion', 'ServiciosWeb\CCO\Participacion\MainController@listAllCCO');


/** --------------------- ALERTAS ---------------------*/
Route::post('/rest/publico/ws/cco/alarma/negocio', 'ServiciosWeb\CCO\Alertas\MainController@listAllCCO');

/** --------------------- SECTORES ---------------------*/
Route::get('/rest/publico/ws/cco/sectores', 'ServiciosWeb\CCO\Sectores\MainController@listAllCCO');



                                       
/**============================================= MPN APP ===================================================== **/

Route::post('/administracion/rest/mpnapp/delegaciones', 'ServiciosWeb\MPNAPP\Delegaciones\MainController@listAllMPNAPPDelegacion');
Route::post('/administracion/rest/mpnapp/colonias', 'ServiciosWeb\MPNAPP\Colonias\MainController@listAllMPNAPPColonias');
Route::post('/administracion/rest/mpnapp/tipoencargado', 'ServiciosWeb\MPNAPP\Encargados\MainController@listAllMPNAPPEncargados');





/**==========================================CÓDIGO ÁGUILA============================================**/
Route::post('/administracion/rest/establecimientos/codigoaguila', 'ServiciosWeb\MPN\Negocio\MainController@establecimientos');
Route::post('/administracion/rest/establecimientos/codigoaguila/ids', 'ServiciosWeb\MPN\Negocio\MainController@findByIdCodigoAguila');


Route::post('/administracion/rest/encargados/codigoaguila'      ,'ServiciosWeb\MPN\Encargado\MainController@listAll');
Route::post('/administracion/rest/encargados/codigoaguila/ids'  ,'ServiciosWeb\MPN\Encargado\MainController@findByIdCodigoAguila');
 

/*		 CATALOGOS		 CATALOGOS		 CATALOGOS		 CATALOGOS		 CATALOGOS		 CATALOGOS		 CATALOGOS
======================================================================================================================
====================================================================================================================== 
======================================================================================================================   */

/*     DELEGACIONES     OK
================================**/
Route::get('/administracion/rest/catalogo/delegaciones', 'Administracion\Catalogos\Delegacion\MainController@listAll');  
Route::resource('/administracion/catalogo/delegaciones', 'Administracion\Catalogos\Delegacion\MainController');
     
/*     MOTIVO ALARMA        OK 
================================**/  
Route::get('/administracion/rest/catalogo/motivoAlarmas', 'Administracion\Catalogos\MotivoAlarma\MainController@listAll');  
Route::resource('/administracion/catalogo/motivoAlarmas', 'Administracion\Catalogos\MotivoAlarma\MainController');
   
/*     TIPO DE ALARMAS   OK
================================**/   
Route::get('/administracion/rest/catalogo/tipoAlarmas', 'Administracion\Catalogos\TipoAlarma\MainController@listAll');  
Route::resource('/administracion/catalogo/tipoAlarmas', 'Administracion\Catalogos\TipoAlarma\MainController');
 
/*     PARTICIPACION   OK
================================**/
Route::get('/administracion/rest/catalogo/participaciones', 'Administracion\Catalogos\Participacion\MainController@listAll');  
Route::resource('/administracion/catalogo/participaciones', 'Administracion\Catalogos\Participacion\MainController');

/*     RAZONES   OK
================================**/ 
Route::get('/administracion/rest/catalogo/razones', 'Administracion\Catalogos\Razones\MainController@listAll');  
Route::resource('/administracion/catalogo/razones', 'Administracion\Catalogos\Razones\MainController');

/*     REPORTA    OK
================================**/
Route::get('/administracion/rest/catalogo/reporta', 'Administracion\Catalogos\Reporta\MainController@listAll');  
Route::resource('/administracion/catalogo/reporta', 'Administracion\Catalogos\Reporta\MainController');
   
/*     STATUS    OK
================================**/ 
Route::get('/administracion/rest/catalogo/tipostatus', 'Administracion\Catalogos\TipoStatus\MainController@listAll');  
Route::resource('/administracion/catalogo/tipostatus', 'Administracion\Catalogos\TipoStatus\MainController');

/*     TIPO ASENTAMIENTO   OK
================================**/ 
Route::get('/administracion/rest/catalogo/tipoAsentamientos', 'Administracion\Catalogos\TipoAsentamiento\MainController@listAll');  
Route::resource('/administracion/catalogo/tipoAsentamientos', 'Administracion\Catalogos\TipoAsentamiento\MainController'); 
 
/*     TIPO DISPOSITIVO    OK
================================**/
Route::get('/administracion/rest/catalogo/tipoDispositivo', 'Administracion\Catalogos\TipoDispositivo\MainController@listAll');  
Route::resource('/administracion/catalogo/tipoDispositivo', 'Administracion\Catalogos\TipoDispositivo\MainController'); 

/*     TIPO NEGOCIO      OK
================================**/
Route::get('/administracion/rest/catalogo/tipoNegocios', 'Administracion\Catalogos\TipoNegocio\MainController@listAll');  
Route::resource('/administracion/catalogo/tipoNegocios', 'Administracion\Catalogos\TipoNegocio\MainController');
 
/*     TIPO GIRO    OK
================================**/
Route::get('/administracion/rest/catalogo/tipoGiros', 'Administracion\Catalogos\TipoGiro\MainController@listAll');  
Route::resource('/administracion/catalogo/tipoGiros', 'Administracion\Catalogos\TipoGiro\MainController');

/*     TIPO GIRO GENERAL     OK  
================================**/
Route::get('/administracion/rest/catalogo/tipogirosgenerales', 'Administracion\Catalogos\TipoGiroGeneral\MainController@listAll');  
Route::resource('/administracion/catalogo/tipogirosgenerales', 'Administracion\Catalogos\TipoGiroGeneral\MainController');

/*     TIPO ENCARGADO   OK
================================**/
Route::get('/administracion/rest/catalogo/tipoencargado', 'Administracion\Catalogos\TipoEncargado\MainController@listAll');
Route::resource('/administracion/catalogo/tipoencargado', 'Administracion\Catalogos\TipoEncargado\MainController');
  
/*     COLONIAS    OK
================================**/
    
Route::get ('/administracion/rest/catalogo/colonias/delegacion/{id}', 'Administracion\Catalogos\Colonias\MainController@findByIdDelegacion');     
Route::post('/administracion/rest/catalogo/colonias', 'Administracion\Catalogos\Colonias\MainController@listAll');
Route::resource('/administracion/catalogo/colonias','Administracion\Catalogos\Colonias\MainController');

          
/*		
======================================================================================================================
====================================================================================================================== 
======================================================================================================================   */
            
/*     INVITACION   OK
================================**/
Route::resource('/administracion/invitacion', 'Administracion\Invitacion\MainController');


/*     ENCARGADOS   OK
================================**/  
Route::post('/administracion/rest/encargados/habilitar', 'Administracion\Encargados\MainController@habilitar');
Route::post('/administracion/rest/encargados/deshabilitar', 'Administracion\Encargados\MainController@deshabilitar');

Route::get('/administracion/rest/encargados/establecimiento/{idEstablecimiento}', 'Administracion\Encargados\MainController@encargadosEstablecimiento');
Route::get('/administracion/rest/encargados/plaza/{idPlaza}', 'Administracion\Encargados\MainController@encargadosPlaza'); 
Route::get('/administracion/rest/encargados/cadena/{idCadena}', 'Administracion\Encargados\MainController@encargadosCadena'); 
Route::get('/administracion/rest/encargados/asociacion/{idAsociacion}', 'Administracion\Encargados\MainController@encargadosAsociacion');
Route::get('/administracion/rest/encargados/findById/{id}', 'Administracion\Encargados\MainController@findById');
   
Route::post('/administracion/rest/encargados', 'Administracion\Encargados\MainController@listAll');
Route::resource('/administracion/encargados','Administracion\Encargados\MainController');
  
/*     ASOCIACIONES   OK 
================================**/
Route::post('/administracion/rest/asociaciones/habilitar', 'Administracion\Asociaciones\MainController@habilitar');
Route::post('/administracion/rest/asociaciones/deshabilitar', 'Administracion\Asociaciones\MainController@deshabilitar');
        
Route::get ('/administracion/rest/asociaciones/establecimiento/{idEstablecimiento}', 'Administracion\Asociaciones\MainController@asociacionesEstablecimiento');    
Route::get ('/administracion/rest/asociaciones/encargado/{idEncargado}', 'Administracion\Asociaciones\MainController@asociacionesEncargado');      
Route::get ('/administracion/rest/asociaciones/cadena/{idCadena}', 'Administracion\Asociaciones\MainController@asociacionesCadena'); 
Route::get ('/administracion/rest/asociaciones/findById/{idAsociacion}', 'Administracion\Asociaciones\MainController@findById');

Route::post('/administracion/rest/asociaciones', 'Administracion\Asociaciones\MainController@listAll');
Route::post('/administracion/rest/asociaciones/escuelas', 'Administracion\Asociaciones\MainController@listAllAsociacionesEscuelas');
Route::post('/administracion/rest/asociaciones/mercados', 'Administracion\Asociaciones\MainController@listAllAsociacionesMercados');
Route::resource('/administracion/asociaciones', 'Administracion\Asociaciones\MainController');  
     
/*     CADENAS   OK
================================**/
Route::post('/administracion/rest/cadenas/habilitar', 'Administracion\Cadenas\MainController@habilitar');
Route::post('/administracion/rest/cadenas/deshabilitar', 'Administracion\Cadenas\MainController@deshabilitar');
   
Route::get ('/administracion/rest/cadenas/establecimiento/{idEstablecimiento}', 'Administracion\Cadenas\MainController@cadenasEstablecimiento');
Route::get ('/administracion/rest/cadenas/encargado/{idEncargado}', 'Administracion\Cadenas\MainController@cadenasEncargado');
Route::get ('/administracion/rest/cadenas/asociacion/{idAsociacion}', 'Administracion\Cadenas\MainController@cadenasAsociacion');
Route::get ('/administracion/rest/cadenas/findById/{id}', 'Administracion\Cadenas\MainController@findById');

Route::post('/administracion/rest/cadenas', 'Administracion\Cadenas\MainController@cadenas');
Route::resource('/administracion/cadenas', 'Administracion\Cadenas\MainController');


/*     PLAZAS PUERTAS   
================================**/

Route::get ('/administracion/rest/dispositivos/plazas/puertas/{idPlazas}'       , 'Administracion\Plazas\PuertasPlazas\MainController@dispositivosMercados');

Route::post('/administracion/rest/plazas/puertas'		,'Administracion\Plazas\PuertasPlazas\MainController@listAllJsonPlazasPuertas');
Route::resource('/administracion/plazas/puertas'        ,'Administracion\Plazas\PuertasPlazas\MainController');


/*     PLAZAS     OK
================================**/
Route::post('/administracion/rest/plazas/habilitar', 'Administracion\Plazas\MainController@habilitar');
Route::post('/administracion/rest/plazas/deshabilitar', 'Administracion\Plazas\MainController@deshabilitar');
              
Route::get ('/administracion/rest/plazas/establecimiento/{idEstablecimiento}', 'Administracion\Plazas\MainController@plazasEstablecimiento');
Route::get ('/administracion/rest/plazas/encargado/{idEncargado}', 'Administracion\Plazas\MainController@plazasEncargado');//AUN NO
Route::get ('/administracion/rest/plazas/findById/{id}', 'Administracion\Plazas\MainController@findById');
     
Route::post('/administracion/rest/plazas', 'Administracion\Plazas\MainController@plazas');
Route::resource('/administracion/plazas','Administracion\Plazas\MainController');
     
/*     ESTABLECIMIENTOS   OK
================================**/    
  
Route::get ('/administracion/rest/dispositivos/establecimiento/{idEstablecimiento}', 'Administracion\Establecimientos\MainController@dispositivosEstablecimiento');
Route::post('/administracion/rest/dispositivos/habilitar'                          , 'Administracion\Establecimientos\MainController@habilitarDispositivo'); 
Route::post('/administracion/rest/dispositivos/deshabilitar'                       , 'Administracion\Establecimientos\MainController@deshabilitarDispositivo'); 
Route::post('/administracion/rest/dispositivos/real'                               , 'Administracion\Establecimientos\MainController@dispositivoAReal'); 
Route::post('/administracion/rest/dispositivos/pruebas'                            , 'Administracion\Establecimientos\MainController@dispositivoAPruebas'); 
Route::post('/administracion/rest/dispositivos/actualizar/token'                   , 'Administracion\Establecimientos\MainController@actualizarToken'); 

Route::post('/administracion/rest/establecimientos/habilitar'					   , 'Administracion\Establecimientos\MainController@habilitar');
Route::post('/administracion/rest/establecimientos/deshabilitar'				   , 'Administracion\Establecimientos\MainController@deshabilitar');
   
Route::post('/administracion/rest/establecimientos/oficioIncorporacion/actualizar' , 'Administracion\Establecimientos\MainController@oficioIncorporacionActualizar');
Route::post('/administracion/rest/establecimientos/oficioIncorporacion/borrar'     , 'Administracion\Establecimientos\MainController@oficioIncorporacionBorrar');

Route::post('/administracion/rest/establecimientos/comprobanteDomicilio/actualizar' , 'Administracion\Establecimientos\MainController@comprobanteDomicilioActualizar');
Route::post('/administracion/rest/establecimientos/comprobanteDomicilio/borrar'     , 'Administracion\Establecimientos\MainController@comprobanteDomicilioBorrar');

Route::post('/administracion/rest/establecimientos/comprobanteFiscal/actualizar' , 'Administracion\Establecimientos\MainController@comprobanteFiscalActualizar');
Route::post('/administracion/rest/establecimientos/comprobanteFiscal/borrar'     , 'Administracion\Establecimientos\MainController@comprobanteFiscalBorrar');

Route::get ('/administracion/rest/establecimientos/plaza/{idPlaza}'				   , 'Administracion\Establecimientos\MainController@establecimientosPlaza');   
Route::get ('/administracion/rest/establecimientos/encargado/{idEncargado}'		   , 'Administracion\Establecimientos\MainController@establecimientosEncargado');
Route::get ('/administracion/rest/establecimientos/findById/{id}'				   , 'Administracion\Establecimientos\MainController@findById');
Route::get('/administracion/establecimientos/dispositivos/pruebas'				   , 'Administracion\Establecimientos\MainController@dispositivosPruebas');
Route::post('/administracion/rest/establecimientos/pruebas'						   , 'Administracion\Establecimientos\MainController@listAllPruebas');
Route::post('/administracion/rest/establecimientos'								   , 'Administracion\Establecimientos\MainController@listAll');
Route::resource('/administracion/establecimientos'								   , 'Administracion\Establecimientos\MainController');
  
/*     SEGUIMIENTOS       
================================**/
Route::post('/administracion/rest/seguimientos/admin/crear', 'Administracion\Seguimientos\MainController@nuevoSeguimiento'); 
Route::resource('/administracion/seguimientos', 'Administracion\Seguimientos\MainController'); 

/*     ESCUELAS   
================================**/  

Route::post('/administracion/rest/escuelas/habilitar'					   , 'Administracion\Escuelas\MainController@habilitar');
Route::post('/administracion/rest/escuelas/deshabilitar'				   , 'Administracion\Escuelas\MainController@deshabilitar');

Route::post ('/administracion/rest/escuelas', 'Administracion\Escuelas\MainController@listAll');   
Route::resource('/administracion/escuelas','Administracion\Escuelas\MainController');   

/*     MERCADOS   
================================**/
Route::get ('/administracion/rest/mercados/puertas/{idMercado}'     , 'Administracion\Mercados\MainController@mercadosPuertasEstablecimiento');  

Route::get ('/administracion/rest/dispositivos/mercados/{idMercado}'       , 'Administracion\Mercados\MainController@dispositivosMercados');

Route::post('/administracion/rest/mercados/habilitar'					   , 'Administracion\Mercados\MainController@habilitar');
Route::post('/administracion/rest/mercados/deshabilitar'				   , 'Administracion\Mercados\MainController@deshabilitar');

Route::post('/administracion/rest/mercados'					        , 'Administracion\Mercados\MainController@listAllJsonMercados');
Route::resource('/administracion/mercados'                          , 'Administracion\Mercados\MainController');

/*    REPORTES
================================**/
Route::resource('/administracion/reportes','Administracion\Reportes\MainController');
  
 
/*     ALERTAS          OK
================================**/   
Route::get('/administracion/rest/alertas/establecimiento/{idEstablecimiento}', 'Administracion\Alertas\MainController@alertasEstablecimiento');  
Route::get('/rest/alertas/activar/{token}', 'Administracion\Alertas\MainController@activar');// --  ! ALERTAS
Route::post('/administracion/rest/alertas/rango', 'Administracion\Alertas\MainController@listAll');
Route::resource('/administracion/alertas','Administracion\Alertas\MainController');


/*     PRUEBAS   OK
================================**/
Route::get('/administracion/rest/pruebas/establecimiento/{idEstablecimiento}', 'Administracion\Pruebas\MainController@pruebasEstablecimiento');  
Route::get('/rest/pruebas/activar/{token}', 'Administracion\Pruebas\MainController@activar');// --  ! ALERTAS
Route::post('/administracion/rest/pruebas/rango', 'Administracion\Pruebas\MainController@listAll');
Route::resource('/administracion/pruebas','Administracion\Pruebas\MainController');

/*     RETROALIMENTACION 
================================**/   
Route::resource('/administracion/retroalimentacion','Administracion\Retroalimentacion\MainController');


  
/*    APP MOVIL SESION
================================**/
Route::post('/rest/movil/retroalimentacion', 'Movil\MainController@retroalimentacion');
Route::get ('/rest/movil/inicio/establecimientos', 'Movil\MainController@obtenerEstablecimientos'); 
Route::get ('/rest/movil/establecimientos', 'Movil\MainController@obtenerEstablecimientosCompleto'); 
Route::get ('/rest/movil/alertas', 'Movil\MainController@obtenerAlertas');    
Route::get ('/rest/movil/pruebas', 'Movil\MainController@obtenerPruebas');   
Route::get ('/rest/movil/solicitarreporte', 'Movil\MainController@solicitarReporte'); 
Route::get('/movil/salir', 'MovilAuth\AppMovilController@getLogout');
Route::post('/movil/iniciarsesion','MovilAuth\AppMovilController@authenticate');
 
/*    ADMINISTRACION     OK
================================**/

Route::get('/administracion/welcome','Administracion\MainController@welcome');    
Route::post('/administracion/rest/buscar/universal','Administracion\MainController@busquedaUniversal');
Route::get('/administracion/dashboard','Administracion\MainController@index');  
Route::resource('/administracion/dashboard','Administracion\MainController');


/*    DASHBOARD NEGOCIO
================================**/
Route::get('/res/administracion/dashboard/establecimientos/altas','Administracion\Establecimientos\Dashboard\MainController@obtenerEstablecimientosEstadisticas');
Route::get('/res/administracion/dashboard/asociaciones/altas','Administracion\Establecimientos\Dashboard\MainController@obtenerAsociacionesEstadisticas');
Route::get('/res/administracion/dashboard/cadenas/altas','Administracion\Establecimientos\Dashboard\MainController@obtenerCadenasEstadisticas');
Route::get('/res/administracion/dashboard/plazas/altas','Administracion\Establecimientos\Dashboard\MainController@obtenerPlazasEstadisticas');
Route::get('/res/administracion/dashboard/alertaspruebas/altas','Administracion\Establecimientos\Dashboard\MainController@obtenerAlertasPruebasEstadisticas');
Route::get('/res/administracion/dashboard/alertas/efectivasNoEfectivas','Administracion\Establecimientos\Dashboard\MainController@obtenerAlertasEfectivasNoEfectivas');
Route::get('/administracion/dashboard/establecimiento'                 ,'Administracion\Establecimientos\Dashboard\MainController@index');

Route::resource('/administracion/dashboardnegocio/establecimiento'            ,'Administracion\Establecimientos\Dashboard\MainController');





   

/* ---------------------- USUARIOS DEL SISTEMA ---------------------- */
Route::post('/administracion/rest/usuarios/usuarios/habilitar', 'Administracion\Usuarios\MainController@habilitar');
Route::post('/administracion/rest/usuarios/usuarios/deshabilitar', 'Administracion\Usuarios\MainController@deshabilitar');
Route::get('/administracion/rest/usuarios/usuarios', 'Administracion\Usuarios\MainController@listAllJsonUsuarios');
Route::get('/administracion/rest/usuarios/permisos', 'Administracion\Usuarios\MainController@listAllJsonPermisos');
Route::resource('/administracion/usuarios','Administracion\Usuarios\MainController'); 
       
/* ---------------------- USUARIOS PUBLICO ---------------------- */ 
Route::post('/administracion/rest/usuariospublico/habilitar', 'Administracion\UsuariosPublico\MainController@habilitar');
Route::post('/administracion/rest/usuariospublico/deshabilitar', 'Administracion\UsuariosPublico\MainController@deshabilitar');
Route::get('/administracion/rest/usuariospublico/usuarios', 'Administracion\UsuariosPublico\MainController@listAllJsonUsuarios');
Route::get('/administracion/rest/usuariospublico/permisos', 'Administracion\UsuariosPublico\MainController@listAllJsonPermisos');
Route::resource('/administracion/usuariospublico','Administracion\UsuariosPublico\MainController'); 

/* ---------------------- USUARIOS PUBLICO - ESTABLECIMIENTOS ---------------------- */
Route::post('/administracion/rest/publico/usuarios/establecimientos/negocio/add', 'Administracion\UsuariosPublico\Establecimientos\MainController@addEstablecimiento');
Route::post('/administracion/rest/publico/usuarios/establecimientos/negocio/remove', 'Administracion\UsuariosPublico\Establecimientos\MainController@removeEstablecimiento');
Route::get ('/administracion/rest/publico/usuarios/establecimientos', 'Administracion\UsuariosPublico\Establecimientos\MainController@listAllJson');
Route::resource ('/administracion/publico/usuarios/establecimientos', 'Administracion\UsuariosPublico\Establecimientos\MainController');
 
/* ---------------------- USUARIOS MOBILE ---------------------- */ 
Route::post('/administracion/rest/usuariosmobile/habilitar', 'Administracion\UsuariosMobile\MainController@habilitar');
Route::post('/administracion/rest/usuariosmobile/deshabilitar', 'Administracion\UsuariosMobile\MainController@deshabilitar');
Route::get('/administracion/rest/usuariosmobile/usuarios', 'Administracion\UsuariosMobile\MainController@listAllJsonUsuarios');
Route::get('/administracion/rest/usuariosmobile/permisos', 'Administracion\UsuariosMobile\MainController@listAllJsonPermisos');
Route::resource('/administracion/usuariosmobile','Administracion\UsuariosMobile\MainController'); 
          
/* ---------------------- DISPOSITIVOS ---------------------- */ 
Route::post('/administracion/rest/dispositivos/mobile/habilitar', 'Administracion\DispositivosMobile\MainController@habilitar');
Route::post('/administracion/rest/dispositivos/mobile/deshabilitar', 'Administracion\DispositivosMobile\MainController@deshabilitar');
Route::get('/administracion/rest/dispositivos/mobile/permisos', 'Administracion\DispositivosMobile\MainController@listAllJsonPermisos');
Route::get('/administracion/rest/dispositivos/mobile', 'Administracion\DispositivosMobile\MainController@listAllJsonDispositivos');
Route::resource('/administracion/dispositivos/mobile', 'Administracion\DispositivosMobile\MainController');
        
/* ----------------------  USUARIOS MOBILE - DISPOSITIVOS  ---------------------- */    
Route::post('/administracion/rest/mobile/usuarios/dispositivos/dispositivo/add', 'Administracion\UsuariosMobile\Dispositivos\MainController@addDispositivo');
Route::post('/administracion/rest/mobile/usuarios/dispositivos/dispositivo/remove', 'Administracion\UsuariosMobile\Dispositivos\MainController@removeDispositivo');
Route::get('/administracion/rest/mobile/usuarios/dispositivos', 'Administracion\UsuariosMobile\Dispositivos\MainController@listAllJson');
Route::resource('/administracion/mobile/usuarios/dispositivos', 'Administracion\UsuariosMobile\Dispositivos\MainController');
 
/* ---------------------- USUARIOS MOBILE - ESTABLECIMIENTOS ---------------------- */
Route::post('/administracion/rest/mobile/usuarios/establecimientos/negocio/add', 'Administracion\UsuariosMobile\Establecimientos\MainController@addEstablecimiento');
Route::post('/administracion/rest/mobile/usuarios/establecimientos/negocio/remove', 'Administracion\UsuariosMobile\Establecimientos\MainController@removeEstablecimiento');
Route::get ('/administracion/rest/mobile/usuarios/establecimientos', 'Administracion\UsuariosMobile\Establecimientos\MainController@listAllJson');
Route::resource('/administracion/mobile/usuarios/establecimientos', 'Administracion\UsuariosMobile\Establecimientos\MainController');
  

/* ---------------------- CHAT ---------------------- */  
Route::get ('/administracion/rest/chat/comment/publico/{idUSer}/{idFriend}/{num}', 'Administracion\Chat\MainController@mensajesChatPublico');
Route::get ('/administracion/rest/chat/comment/mobile/{idUSer}/{idFriend}/{num}', 'Administracion\Chat\MainController@mensajesChatMobile');
Route::get ('/administracion/rest/chat/comment/publico/leido/{id}', 'Administracion\Chat\MainController@mensajeLeidoPublico');
Route::post('/administracion/rest/chat/comment/publico', 'Administracion\Chat\MainController@commentPublico'); 
Route::post('/administracion/rest/chat/comment/mobile', 'Administracion\Chat\MainController@commentMobile'); 
Route::resource('/administracion/chat', 'Administracion\Chat\MainController');
     
/* ---------------------- SESIONES ---------------------- */
Route::post('/administracion/rest/sesiones/cerrarsesion', 'Administracion\Sesiones\MainController@cerrarSesion');
Route::get ('/administracion/rest/sesiones', 'Administracion\Sesiones\MainController@listadoJsonSesiones');
Route::resource ('/administracion/sesiones', 'Administracion\Sesiones\MainController');
 
/* ---------------------- BITACORA ---------------------- */
Route::get('/administracion/rest/bitacora/{fechaInicio}/{fechaFin}','Administracion\Bitacora\MainController@listByDate');
Route::resource('/administracion/bitacora','Administracion\Bitacora\MainController');
  
/* ---------------------- SOPORTE ---------------------- */
Route::get('/administracion/rest/soporte', 'Administracion\Soporte\MainController@listadoJsonSoporte');
Route::resource('/administracion/soporte', 'Administracion\Soporte\MainController');

  





/*     PUBLICO
================================**/
/*     PUBLICO
================================**/
/*     PUBLICO
================================**/
/*     PUBLICO
================================**/
/*     PUBLICO
================================**/

Route::resource('/','MainController');  

/*    PUBLICO DASHBOARD  
================================**/
Route::get('/publico/dashboard','Publico\MainController@index');
Route::resource('/publico/dashboard','Publico\MainController');

/* ---------------------- CHAT ---------------------- */  
Route::get ('/publico/rest/chat/comment/admin/{idUSer}/{idFriend}/{num}', 'Publico\Chat\MainController@mensajesChatAdministrador');
Route::post('/publico/rest/chat/comment/admin', 'Publico\Chat\MainController@commentAdmin'); 
Route::get ('/publico/rest/chat/comment/leido/{id}', 'Publico\Chat\MainController@mensajeLeido');
Route::resource('/publico/chat', 'Publico\Chat\MainController');

 
/* ---------------------- SOPORTE ---------------------- */
Route::resource('/publico/soporte', 'Publico\Soporte\MainController');


Route::resource('/preafiliacion', 'Publico\Preafiliacion\MainController');





/*     APLICACION MOVIL
================================**/
/*     APLICACION MOVIL
================================**/
/*     APLICACION MOVIL
================================**/
/*     APLICACION MOVIL
================================**/
/*     APLICACION MOVIL
================================**/    
  
Route::get('/mobile/rest/establecimientos/mapa'  	, 'Mobile\Establecimientos\MainController@listAllMapa');
Route::get('/mobile/rest/establecimientos'	     	, 'Mobile\Establecimientos\MainController@listAllEstablecimientos');
Route::get('/mobile/rest/pruebas'				 	,' Mobile\Pruebas\MainController@listAll');
Route::get('/mobile/rest/alertas'				 	,' Mobile\Alertas\MainController@listAll');
Route::get('/mobile/rest/dispositivos'				,' Mobile\Dispositivos\MainController@listAll');
Route::get('/mobile/rest/retroalimentacion'			,' Mobile\RetroAlimentacion\MainController@listAll');
 