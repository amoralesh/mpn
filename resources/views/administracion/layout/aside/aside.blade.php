    
    <!--BUSCAR-->
    @if( in_array( 'Administracion:Aside:Buscar' , Session::get('permisos') ) )
    <div class="sidebar-search" style="background:rgba(0,28,58,1);">
        <input id="live-search-box" type="search" class="form-control input-sm" placeholder="Buscar..." style="background:white;">
        <a href="javascript:void(0)"><i class="search-close fa fa-search" style="color:#969696;"></i></a>
    </div>
    @endif 
    
    <div class="sidebar-menu" style="background:rgba(0,28,58,1);">
        <ul class="nav site-menu live-search-list" id="site-menu" data-plugin="custom-scroll" data-suppress-scroll-x="true" data-height="100%" style="background:rgba(0,28,58,1);"> 
         

            <!--TITULO-->
            <li class="menu-title"><i class="fa fa-server"></i><span>{{ config('app.name') }}</span>
                <ul class="main-menu">
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/welcome"><span>Bienvenido</span></a>
                    </li>
                    <!--INVITACION-->
                    @if( in_array( 'Administracion:Aside:Invitacion' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/invitacion"><span>Invitación</span></a>
                    </li>
                    @endif

                </ul>    
            </li>
            
            <!--PRINCIPAL-->
            <li class="menu-title"><i class="fa fa-building-o"></i><span>Establecimientos</span>
                <ul class="main-menu">
                
                    <!--NEGOCIOS-->
                    @if( in_array( 'Administracion:Aside:Establecimientos' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="javascript:void(0)">Negocios<span class="float-xs-right"><i class="icon_plus"></i></span></a>
                        <ul class="sub-menu">                            
                            <li><a href="{{ url('/') }}/administracion/dashboardnegocio/establecimiento" method ="get"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                            <li><a href="{{ url('/') }}/administracion/establecimientos"><i class="fa fa-building-o"></i>Negocios</a></li>
                            <li><a href="{{ url('/') }}/administracion/establecimientos/dispositivos/pruebas"><i class="fa fa-building-o"></i>Dispositivos a Prueba</a></li>
                        </ul>
                    </li>
                    @endif

                    <!--MERCADOS-->
                    @if( in_array( 'Administracion:Aside:Mercados' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="javascript:void(0)">Mercados<span class="float-xs-right"><i class="icon_plus"></i></span></a>
                        <ul class="sub-menu">                            
                            <li><a href="{{ url('/') }}/administracion/mercado/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                            <li><a href="{{ url('/') }}/administracion/mercados"><i class="fa fa-building-o"></i>Mercados</a></li>
                        </ul>  
                    </li>
                    @endif

                    <!--ESCUELA-->
                    @if( in_array( 'Administracion:Aside:Escuelas' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="javascript:void(0)">Escuelas<span class="float-xs-right"><i class="icon_plus"></i></span></a>
                        <ul class="sub-menu">                            
                            <li><a href="{{ url('/') }}/administracion/escuelas/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                            <li><a href="{{ url('/') }}/administracion/escuelas"><i class="fa fa-building-o"></i>Escuelas</a></li>
                        </ul>
                    </li>
                    @endif

                     <!--PLAZAS-->
                     @if( in_array( 'Administracion:Aside:Escuelas' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="javascript:void(0)">Plazas<span class="float-xs-right"><i class="icon_plus"></i></span></a>
                        <ul class="sub-menu">                            
                            <li><a href="{{ url('/') }}/administracion/plazas/puertas/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                            <li><a href="{{ url('/') }}/administracion/plazas/puertas"><i class="fa fa-building-o"></i>Plazas</a></li>
                        </ul>  
                    </li>
                    @endif


                </ul>    
            </li>     

            <li class="menu-title"><i class="fa fa-bar-chart"></i><span>Menú Principal</span>

                <ul class="main-menu">

                    <!--DAHSBOARD-->
                    @if( in_array( 'Administracion:Aside:Dashboard' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/dashboard"><span>Dashboard</span></a>
                    </li>
                    @endif
  
                    <!--CATALOGOS-->
                    @if( in_array( 'Administracion:Aside:Catalogos' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="javascript:void(0)">Catalogos<span class="float-xs-right"><i class="icon_plus"></i></span></a>
                        <ul class="sub-menu">
                            @if( in_array( 'Administracion:Aside:Catalogos:Delegaciones' , Session::get('permisos') ) )
                                <li><a href="{{ url('/') }}/administracion/catalogo/delegaciones"><i class="fa fa-sort-amount-asc"></i>Delegaciones</a></li>
                            @endif 
                            @if( in_array( 'Administracion:Aside:Catalogos:MotivoAlarma' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/motivoAlarmas"><i class="fa fa-sort-amount-asc"></i>Motivo Alarma</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoAlarma' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipoAlarmas"><i class="fa fa-sort-amount-asc"></i>Tipo Alarma</a></li>
                            @endif 
                            @if( in_array( 'Administracion:Aside:Catalogos:Participaciones' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/participaciones"><i class="fa fa-sort-amount-asc"></i>Participación</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:Razones' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/razones"><i class="fa fa-sort-amount-asc"></i>Razón</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:Reporta' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/reporta"><i class="fa fa-sort-amount-asc"></i>Reporta</a></li>
                            @endif 
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoStatus' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipostatus"><i class="fa fa-sort-amount-asc"></i>Tipo Status</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoAsentamiento' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipoAsentamientos"><i class="fa fa-sort-amount-asc"></i>Tipo Asentamiento</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoDispositivo' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipoDispositivo"><i class="fa fa-sort-amount-asc"></i>Tipo Dispositivo</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoNegocio' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipoNegocios"><i class="fa fa-sort-amount-asc"></i>Tipo Negocio</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoGiro' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipoGiros"><i class="fa fa-sort-amount-asc"></i>Tipo Giro</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoGiroGeneral' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipogirosgenerales"><i class="fa fa-sort-amount-asc"></i>Tipo Giro General</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:TipoEncargado' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/tipoencargado"><i class="fa fa-sort-amount-asc"></i>Tipo Encargado</a></li>
                            @endif
                            @if( in_array( 'Administracion:Aside:Catalogos:Colonia' , Session::get('permisos') ) )
                            <li><a href="{{ url('/') }}/administracion/catalogo/colonias"><i class="fa fa-sort-amount-asc"></i>Colonias</a></li>
                            @endif
                        </ul>  
                    </li>
                    @endif
                    
                    <!--Encargado-->
                    @if( in_array( 'Administracion:Aside:Encargado' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/encargados"><span>Encargados</span></a>
                    </li>
                    @endif

                    <!--Asociaciones-->
                    @if( in_array( 'Administracion:Aside:Asociaciones' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/asociaciones"><span>Asociaciones</span></a>
                    </li>
                    @endif

                     <!--Cadenas-->
                     @if( in_array( 'Administracion:Aside:Cadenas' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/cadenas"><span>Cadenas</span></a>
                    </li>
                    @endif
            
                    <!--Plaza-->
                    @if( in_array( 'Administracion:Aside:Plaza' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/plazas"><span>Plaza</span></a>
                    </li>
                    @endif
                    
                    <!--REPORTES-->
                    @if( in_array( 'Administracion:Aside:Reportes' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/reportes">Reportes</a>
                    </li>
                    @endif
                     

                    <!--Alertas-->
                    @if( in_array( 'Administracion:Aside:Alertas' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/alertas"><span>Alertas</span></a>
                    </li>
                    @endif

                    <!--Pruebas-->
                    @if( in_array( 'Administracion:Aside:Pruebas' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/pruebas"><span>Pruebas</span></a>
                    </li>
                    @endif

                    <!--RetroAlimentacion-->
                    @if( in_array( 'Administracion:Aside:RetroAlimentacion' , Session::get('permisos') ) )
                    <li class="sub-item">
                        <a href="{{ url('/') }}/administracion/retroalimentacion"><span>RetroAlimentacion</span></a>
                    </li>
                    @endif

                </ul>
            </li>

        </ul>
    </div>
    <div class="sidebar-extra" style="background:rgba(0,28,58,1);">
        <a href="#"><i class="fa fa-key"></i></a>
        <a href="#"><i class="icon_lock_alt"></i></a>
    </div>