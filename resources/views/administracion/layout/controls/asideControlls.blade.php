    <div class="float-xs-left icon-right site-setting-animation how-it-works">
        <div id="site_setting_icon" class="animation">
            <img src="{{ url('/') }}/public/assets/global/image/site-setting-icon.png" alt="" class="icon1" />
            <img src="{{ url('/') }}/public/assets/global/image/site-setting-icon.png" alt="" class="icon2">
            <img src="{{ url('/') }}/public/assets/global/image/site-setting-icon.png" alt="" class="icon3">
        </div>
    </div>

    <div class="right-side-box float-xs-right" data-plugin="custom-scroll" data-height="100%">
        <div class="right-side-inner-box">

            <div class="globle-right-content">
                <h5><span class="default" aria-hidden="true"></span> Usuarios</h5>
                <div class="settings-sidebox">
                    <ul class="list-unstyled">   

                        <!-- USUARIOS -->
                        @if( in_array( 'Administracion:AsideControlls:Administracion:Usuarios' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/usuarios"><span class="system-option"><i class="fa fa-user"></i> Usuarios Administración</span></a>
                        </li> 
                        @endif   
                        <!-- USUARIOS PUBLICO -->
                        @if( in_array( 'Administracion:AsideControlls:Publico:Usuarios' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/usuariospublico"><span class="system-option"><i class="fa fa-user"></i> Usuarios Público</span></a>
                        </li> 
                        @endif

                        <!-- USUARIOS PUBLICOS- ESTABLECIMIENTOS -->
                        @if( in_array( 'Administracion:AsideControlls:Publico:Usuarios:Establecimientos' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/publico/usuarios/establecimientos"><span class="system-option"><i class="fa fa-exchange"></i> Usuarios Públicos - Establecimientos</span></a>
                        </li>   
                        @endif

                        <!-- USUARIOS MOVIL -->
                        @if( in_array( 'Administracion:AsideControlls:Mobile:Usuarios' , Session::get('permisos') ) )
                        <li>
                            <a href="{{ url('/') }}/administracion/usuariosmobile"><span class="system-option"><i class="fa fa-mobile"></i> Usuarios App Movil</span></a>
                        </li>
                        @endif 

                        <!-- DISPOSITIVOS -->
                        @if( in_array( 'Administracion:AsideControlls:Dispositivos:Mobile' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/dispositivos/mobile"><span class="system-option"><i class="fa fa-cube"></i> Dispositivos</span></a>
                        </li>
                        @endif 

                        <!-- USUARIOS MOBILE - DISPOSITIVOS --> 
                        @if( in_array( 'Administracion:AsideControlls:Mobile:Usuarios:Dispositivos' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/mobile/usuarios/dispositivos"><span class="system-option"><i class="fa fa-exchange"></i> Usuarios app movil - Dispositivos</span></a>
                        </li> 
                        @endif
                        
                        <!-- USUARIOS MOBILE - ESTABLECIMIENTOS -->
                        @if( in_array( 'Administracion:AsideControlls:Mobile:Usuarios:Establecimientos' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/mobile/usuarios/establecimientos"><span class="system-option"><i class="fa fa-exchange"></i> Usuarios app movil - Establecimientos</span></a>
                        </li>
                        @endif

                        
                        <!-- CHAT -->
                        @if( in_array( 'Administracion:AsideControlls:Chat' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/administracion/chat"><span class="system-option"><i class="fa fa-wechat"></i> Chat</span></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="globle-right-content">
                <h5><span class="default" aria-hidden="true"></span> Sistema</h5>
                <div class="settings-sidebox">
                    <ul class="list-unstyled">

                        <!--
                        <li>
                            <a href="javascript:void(0)"> 
                                <span class="system-option"><i class="icon_lock"></i> Último logeo</span>
                                <span class="time float-xs-right">2h ago</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> 
                                <span class="system-option"><i class="icon_calendar"></i> Pendientes</span>
                                <span class="time float-xs-right">06</span>
                            </a>
                        </li>
                        -->

                        <!-- SESIONES -->
                        @if( in_array( 'Administracion:AsideControlls:Sessions' , Session::get('permisos') ) )
                        <li>
                            <a href="{{ url('/') }}/administracion/sesiones"><span class="system-option"><i class="fa fa-users"></i> Sesiones</span></a>
                        </li>
                        @endif

                        <!-- BITACORA -->
                        @if( in_array( 'Administracion:AsideControlls:Bitacora' , Session::get('permisos') ) )
                        <li>
                            <a href="{{ url('/') }}/administracion/bitacora"><span class="system-option"><i class="fa fa-list-alt"></i> Bitacora</span></a>
                        </li>
                        @endif

                        <!-- SOPORTE -->
                        @if( in_array( 'Administracion:AsideControlls:Soporte' , Session::get('permisos') ) )
                        <li>
                            <a href="{{ url('/') }}/administracion/soporte"><span class="system-option"><i class="fa fa-warning"></i> Soporte</span></a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- END SIDE SETTING -->