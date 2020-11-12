<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="bootstrap default admin template">
    <meta name="viewport" content="width=device-width">
    <title>{{ config('app.name') }} | @yield('titulo')</title>

    <!-- Favicons -->
    <link rel="shortcut icon"                    href="{{ url('/') }}/public/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon"                 href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="57x57"   href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="72x72"   href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="76x76"   href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/') }}/public/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/public/favicon.ico" />
     
    <!-- START GLOBAL CSS --> 
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/icons_fonts/elegant_font/elegant.min.css"/>
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/layouts/layout-left-menu/css/color/light/color-default.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <!-- END GLOBAL CSS -->

    <!-- START PAGE PLUG-IN CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/AmaranJS/dist/css/amaran.min.css"/>
    <!-- END PAGE PLUG-IN CSS -->

    <!-- START TEMPLATE GLOBAL CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/global/css/components.min.css"/>
    <!-- END TEMPLATE GLOBAL CSS -->

    <!-- START LAYOUT CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/layouts/layout-left-menu/css/layout.min.css"/>
    <!-- END LAYOUT CSS -->
    <style>
        .amaran.awesome {
            width: 600px;
            min-height: 85px;
            background: #f3f3f3;
            color: #222;
            margin: 15px;
            padding: 5px 5px 5px 70px;
            font-family: "Open Sans",Helvetica,Arial,sans-serif;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 1px 1px 1px #000;
        }
        .amaran.awesome p.bold {
            padding-left: 30%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 100%;
        }
        .amaran.awesome p {
            padding-left: 30%;
        } 
        .dataTables_info {
            position:relative;
        }
        .modal-dialog {
            max-width: 1200px; 
            margin: 50px auto; 
        } 
        .daterangepicker .calendar th, .daterangepicker .calendar td {
            white-space: nowrap;
            text-align: center;
            min-width: 32px;
            color: black;
        }
    
    </style>

    @section('styles')
    @show
    
</head>
<body style="background:transparent">
    
    
<div class="wrapper">
    <div class="loader-overlay">
        @include('administracion.layout.header.loader')
    </div>

    <header id="header">
        @include('administracion.layout.header.header')
    </header>

    <div class="search-overlay">
        @include('administracion.layout.search-overlay.search-overlay')
    </div>
    <!-- END HEADER -->

    <!-- START CONTENT -->
    <section id="main" class="container-fluid">

            <div class="row">
                <!-- START NAVIGATION -->
                <aside id="sidebar" style="background:rgba(0,28,58,1);" >
                    @include('administracion.layout.aside.aside')
                </aside>
                <!-- END NAVIGATION -->

                <!-- START RIGHT CONTENT -->
                <section id="content-wrapper">
                <!-- START PAGE TITLE -->  
                    <div class="site-content-title"> 
                        <h2 class="float-xs-left content-title-main">@yield('directorioTitle')</h2>
                        <!-- START BREADCRUMB -->
                        <ol class="breadcrumb float-xs-right">
                            <li class="breadcrumb-item">
                                <span class="fs1" aria-hidden="true" data-icon=""></span>
                                <a href="#">{{ config('app.name') }}</a>
                            </li>
                            @yield('directorio')
                        </ol>
                        <!-- END BREADCRUMB -->
                    </div>
                    <!-- END PAGE TITLE -->

                    @yield('content')
                </section>
                <!-- END RIGHT CONTENT -->


            </div>

    </section>
    <!-- END CONTENT -->

    @include('administracion.layout.footer.footer')

    <!-- START SIDE SETTING -->
    <div class="right-side-bar">
        @include('administracion.layout.controls.asideControlls')
    </div>

</div> <!-- WRAPPER -->

 
<!-- START CORE JAVASCRIPT -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/tether/dist/js/tether.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/screenfull.js/dist/screenfull.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/classie/classie.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/js/socket.io.js"></script>   

<!-- END CORE JAVASCRIPT -->

<!-- START PAGE PLUGINS -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/AmaranJS/dist/js/jquery.amaran.min.js"></script>
<!-- END PAGE PLUGINS -->

<!-- START GLOBAL JAVASCRIPT -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/site.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/site-settings.min.js"></script>
<!-- END GLOBAL JAVASCRIPT -->
  
<!-- START PAGE JAVASCRIPT --> 
<!-- END PAGE JAVASCRIPT -->
       
<!-- START THEME LAYOUT JAVASCRIPT -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/layouts/layout-left-menu/js/layout.min.js"></script>

@section('scripts')  

@show

<!-- SOCKET IO -->
<script>       


    $(function () {
          
          console.log("Iniciando socket io");     
  
          var url= window.location.hostname  + ":3000";
          console.log(url);
          var socket = io( url );
    
       
          socket.on('messageAdmin{{ Auth::user()->getEmail() }}', function (data) {
              console.log( data ); 
            $.amaran({
                'theme'     :'awesome ok',
                'closeOnClick'  :false,
                'closeButton'   :true,
                'delay': 10000,
                'content'   :{
                    title:'Para: ' + data.receptor,
                    message:  data.mensaje ,
                    info:'De: ' + data.emisor,
                    icon:'fa fa-user'
                },
                'position'  :'bottom right',
                'outEffect' :'slideBottom',
                'inEffect'  :'slideRight'  
            });
          });
         
          
            @if( Auth::user()->getPermisos() != null )
                @foreach( Auth::user()->getPermisos() as $index => $permiso )
                    @if( $permiso->getNombre() == 'Administracion:Master:Notificaciones' )
                        socket.on('bitacora', function(message){
                            console.log( message );
                            $.amaran({
                                'theme'     :'awesome ok', 
                                'closeOnClick'  :false,
                                'closeButton'   :true,
                                'delay': 10000,
                                'content'   :{
                                    title:'El usuario: ' + message.usuario,
                                    message: message.accion ,
                                    info:'',
                                    icon:'fa fa-info'
                                },
                                'position'  :'bottom right',
                                'outEffect' :'slideBottom',
                                'inEffect'  :'slideRight'
                            });
                        });  
                    @endif
                @endforeach()
            @endif
            

            socket.on('notify', function( data ){
                console.log( data );
                $.amaran({
                    'theme'     :'awesome ok', 
                    'closeOnClick'  :false,
                    'closeButton'   :true,
                    'delay': 10000,
                    'content'   :{
                        title: "Nueva notificación!",
                        message: data.texto ,
                        info:'',
                        icon:'fa fa-info'
                    },
                    'position'  :'bottom right',
                    'outEffect' :'slideBottom',
                    'inEffect'  :'slideRight'
                });
            });

    
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
            $( "#busquedaUniversal" ).keyup(function() {
                var busquedaUniversalTxt = document.getElementById("busquedaUniversal");
                busquedaUniversalTxt.value = busquedaUniversalTxt.value.toUpperCase();

                $.ajax({
                    url: "{{ url('/') }}/administracion/rest/chat/comment/mobile", 
                    type: 'POST',    
                    data: JSON.stringify({
                        datos: busquedaUniversalTxt.value
                    }),
                    contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
                    dataType: "text",
                    success: function(data) {

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        
                    }
                });//AJAX
            });//BUSCAR FUNCTION
            
   });
</script>  


</body>
</html>



