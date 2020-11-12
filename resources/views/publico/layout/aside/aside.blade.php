    
    <!--BUSCAR-->
    @if( in_array( 'Publico:Aside:Buscar' , Session::get('permisos') ) )
    <div class="sidebar-search" style="background:rgba(0,28,58,1);">
        <input id="live-search-box" type="search" class="form-control input-sm" placeholder="Buscar..." style="background:white;">
        <a href="javascript:void(0)"><i class="search-close fa fa-search" style="color:#969696;"></i></a>
    </div>
    @endif 
    
    <div class="sidebar-menu" style="background:rgba(0,28,58,1);">
        <ul class="nav site-menu live-search-list" id="site-menu" data-plugin="custom-scroll" data-suppress-scroll-x="true" data-height="100%" style="background:rgba(0,28,58,1);"> 
        

            <!--TITULO-->
            <li class="menu-title"><i class="fa fa-server"></i><span>{{ config('app.name') }}</span></li>
            <br>
            
            <!--DAHSBOARD-->
            @if( in_array( 'Publico:Aside:Dashboard' , Session::get('permisos') ) )
            <li class="menu-title"><i class="fa fa-bar-chart"></i><span>Menú Principal</span>
                <ul class="main-menu">
                    <li class="sub-item">
                        <a href="{{ url('/') }}/publico/dashboard"><span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            
        </ul>
    </div>
    <div class="sidebar-extra" style="background:rgba(0,28,58,1);">
        <a href="#"><i class="fa fa-key"></i></a>
        <a href="#"><i class="icon_lock_alt"></i></a>
    </div>