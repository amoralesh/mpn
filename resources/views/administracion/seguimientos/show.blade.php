@extends('administracion.layout.master')
@section('titulo', 'Seguimientos')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Seguimientos')
@section('directorioTitle', 'Seguimientos') 
@section('directorio')  
    <li class="breadcrumb-item ">Seguimientos</li>
@endsection  
 
    
      
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- sweetalert 2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
<style>     
    .validacion {   
        color: red;   
        font-size: large;       
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: rgba(0,28,60,1);
        color: white;
    }
    .modal-dialog {
        max-width: 1500px; 
        margin: 50px auto; 
    }
    .swal2-container {
        z-index: 999999;
    }
</style>
@endsection



@section('content') 
<div style="margin: 25px auto; width:95%;">
   @if(Session::has('mensaje'))
   <div class="alert alert-success">
      <strong>OK! </strong> {{ Session::get('mensaje') }} 
   </div>
   @endif
   @if(Session::has('errores'))
   <div class="alert alert-danger">
      <strong>CUIDADO! </strong> {{ Session::get('errores') }}
   </div>   
   @endif

    <button type="button" id="nuevoSeguimiento" class="btn btn-primary">Nuevo Seguimiento</button>
   
    <div class="content-timeline">
        <ul id="timeline">

            <li class="timeline-heading">
                <div class="timeline-date"><h4><b>Fecha de alta:{{ $negocio->getFechaAlta()->format('d-m-Y') }}</b> </h4></div>
            </li>

            @foreach( $negocio->getSeguimientos() as $indice => $seguimiento )
                    
                    <li class="timeline-item {{ ($indice%2) != 0 ? 'timeline-right': 'timeline-left' }} ">
                    
                        <div class="timeline-icon"> 
                            <img src="{{ url('/') }}/public/img/usuario.jpg" alt="Timeline image"/>
                        </div>

                        <div class="timeline-content">
                            <div class="timeline-header">
                                <div class="float-xs-left">
                                    <h4 class="timeline_title">{{ $seguimiento->getUsuario()->getNombre() }} {{ $seguimiento->getUsuario()->getApellidoPaterno() }} {{ $seguimiento->getUsuario()->getApellidoMaterno() }}</h4>
                                </div>
                                <div class="float-xs-right">
                                    <div class="timeline_date"> 
                                        <div class="d-inline-block">
                                        <span class="day font-weight-bold"> {{ $seguimiento->getFechaAlta()->format('d') }}</span>
                                        </div>
                                        <div class="d-inline-block">
                                        <span class="d-block week-day"></span>
                                        <span class="d-block month">{{ $seguimiento->getFechaAlta()->format('m-Y') }}</span>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="timeline-body">
                                <p> <h5><b>{{ $seguimiento->getComentario() }}</b><h5></p>
                            </div>
                            <div class="timeline-footer">
                                <div class="more">
                                    
                                    <div class="float-xs-left">
                                        <ul class="list-inline">
                                            <!--
                                            <li>
                                                <a href="#"><i class="icon_like_alt"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="social_share"></i></a>
                                            </li>
                                            -->
                                            <li>
                                                <span class="time"><h6>{{ $seguimiento->getFechaAlta()->format('h:i:s a')  }}</h6></span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="float-xs-right">
                                        <ul class="list-inline">
                                            <!--
                                            <li>
                                                <a href="#">50 <i class="icon_comment"></i></a>
                                            </li>
                                            <li>
                                                <a href="#">35 <i class="icon_heart"></i></a>
                                            </li>
                                            -->
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </li>

            @endforeach
            
        </ul>
   </div>

</div>
@endsection

      

@section('scripts')
<!-- SWEET ALERT 2-->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/sweetalert.js"></script>

<!--SELECT 2-->
<script src="{{ url('/') }}/public/assets/global/plugins/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js"></script>

<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#nuevoSeguimiento').on('click', function(e) {
            nuevoSeguimiento();
            e.stopPropagation();
        });
 
    });
   
   function nuevoSeguimiento(  ){

            swal({
                title: 'Nuevo Seguimiento',
                text: 'Indica el seguimiento que se le ha dado al establecimiento',
                input: 'textarea',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Mandar seguimiento',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true, 
                preConfirm: function (motivo) { 
                    return new Promise(function (resolve, reject) {
                        setTimeout(function() {
                            if (motivo === false) return false;
                            if (motivo === "") {
                                swal("Error al mandar el seguimiento!", "No dejes campos vacíos", "error");
                                return false;
                            }    
                            $.ajax({
                                url: "{{ url('/') }}/administracion/rest/seguimientos/admin/crear",
                                type: "POST",
                                data: { 
                                    id: {{ $negocio->getId() }},
                                    contenido: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('OK!','Se ha añadido un seguimiento.','success');
                                    location.reload();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    swal("Error al enviar seguimiento!", "Intenta más tarde", "error");
                                }
                            });
                        }, 3000)
                    })
                },
                allowOutsideClick: false
            }).then(function (idUnico) {
                
            }, function(dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                    'Cancelado',
                    'cancelaste la operación',
                    'error'
                    )
                }
            });

   }

</script>
@endsection
