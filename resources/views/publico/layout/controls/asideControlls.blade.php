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

                        <!-- CHAT -->
                        @if( in_array( 'Publico:AsideControlls:Chat' , Session::get('permisos') ) )
                        <li> 
                            <a href="{{ url('/') }}/publico/chat"><span class="system-option"><i class="fa fa-wechat"></i> Chat</span></a>
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

                        
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- END SIDE SETTING -->