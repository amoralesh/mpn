@extends('administracion.layout.master')
@section('titulo', 'Usuarios Mobile| Lista')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Usuarios Mobile| Lista')
@section('directorio')
    <li class="breadcrumb-item">Usuarios</li>
    <li class="breadcrumb-item">Mobile</li>
@endsection

       
@section('styles')
<meta name="_token" content="{!! csrf_token() !!}"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/AutoFill-2.1.2/css/autoFill.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Buttons-1.2.2/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/FixedColumns-3.2.2/css/fixedColumns.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/FixedHeader-3.1.2/css/fixedHeader.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/KeyTable-2.1.3/css/keyTable.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/RowReorder-1.1.2/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Scroller-1.4.2/css/scroller.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Select-1.2.0/css/select.dataTables.min.css"/>

<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
@endsection 


@section('content')
<div style="margin: 25px auto; width:95%;">

   <!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
   @if(Session::has('mensaje'))
   <div class="alert alert-success">
      <strong>Creado! </strong> {{ Session::get('mensaje') }}
   </div>
   @endif
   <!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
   @if(Session::has('errores'))
   <div class="alert alert-danger">
      <strong>Cuidado! </strong> {{ Session::get('errores') }}
   </div>
   @endif
   
   <!-- TABLA DE ELEMENTOS  TOTALES EN EL SISTEMA
      ================================================-->
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
               <div class="dataTable_wrapper">
                  <table class="table table-striped table-bordered table-hover" id="usuariosDT">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Usuario</th>
                           <th>Nombre</th>
                           <th>Apellido P</th>
                           <th>Apellido M</th>
                           <th>E-mail</th>
                           <th>Status</th>
                           <th>Acción</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- /.panel-body -->
         </div>
         <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
   </div>
   <!-- /TABLA -->
   <div class="box-footer">
      <button type="button" id="nuevoUsuario" name="nuevoUsuario" class="btn btn-primary">Nuevo Usuario</button>
      
   </div>
   <!--  END Chartist CHART -->
</div>
@endsection

  
@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/RowReorder-1.1.2/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Select-1.2.0/js/dataTables.select.min.js"></script>

<!-- START PAGE PLUGINS -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- END PAGE PLUGINS -->

<!-- START PAGE JAVASCRIPT --> 
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/sweetalert.js"></script>
<script>
    $('[data-plugin="sweetalert"]').on('click',function () {
        var $this = $(this),
            $options = $.extend({}, $this.data());
        swal($options).catch(swal.noop)
    });
</script>
<!-- END PAGE JAVASCRIPT -->

<script type="text/javascript">



    $(document).ready(function() {
        
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        var table = $('#usuariosDT').DataTable({

            responsive: true,
            "autoWidth": false,
            fixedColumns: true,
            fixedHeader: true,
            "deferRender": true,
            "pageLength": 50,
            //autoFill: true,
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Mostrando 0 de 0 de 0 registros",
                "infoFiltered": "(Filtrados de _MAX_ registros totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros por pagina",
                "loadingRecords": "Cargando...",
                "processing": "<img style='width:170px;' src='{{ url('/') }}/public/img/cargando3.gif'/>",
                "search": "Buscar: ",
                "zeroRecords": "No se encontraron registros que coincidan",
                "paginate": {
                    "first": "Primera pagina",
                    "last": "Ultima Pagina", 
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para mostrar en acendencia",
                    "sortDescending": ": Activar para mostrar en descendencia"
                }
            },
            "processing": true,
            "ajax": {
                "url": "{{ url('/') }}/administracion/rest/usuariosmobile/usuarios",
                "type": "GET",
                "dataSrc": "",
                "error": function(xhr, error, thrown) {
                    console.log("error")
                    table.ajax.reload();
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "usuario"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "apellidoPaterno"
                },
                {
                    "data": "apellidoMaterno"
                },
                {
                    "data": "email"
                },
                {
                    "data": "status"
                },
                {
                    "data": "status"
                }
            ],
            "columnDefs": [{
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</pan>';
                    },
                    "targets": 6
                },
                {
                    "render": function(data, type, row) {
                        var acciones = '<i id="modificarUsuario" class="fa fa-pencil" style="color: #ff1c9b;">&nbsp;&nbsp;&nbsp;</i>';

                        if (data === true) {
                            acciones += '<i id="bajaUsuario" class="fa fa-trash-o" style="color: red;">&nbsp;&nbsp;&nbsp;</i>';
                        } else {
                            acciones += '<i id="altaUsuario" class="fa fa-check" style="color: green;">&nbsp;&nbsp;&nbsp;</i>';
                        }
                        return acciones;
                    },
                    "targets": 7
                }
            ]
        });


        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });

        // Handle click on checkbox
        $('#usuariosDT tbody').on('click', '#modificarUsuario', function(e) {
            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var id = data.id;

            console.log(id);

            document.location.href = "{{ url('/') }}/administracion/usuariosmobile/" + id + "/edit";
 
            e.stopPropagation();
        });

        // Handle click on checkbox
        $('#usuariosDT tbody').on('click', '#bajaUsuario', function(e) {

            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var idUsuario = data.id;

            swal({
                title: 'Deshabilitar usuario?',
                text: 'El usuario ya no podrá iniciar sesión',
                type: 'warning',
                showCancelButton: true,  
                confirmButtonText: 'Si, deshabilitar!',
                cancelButtonText: 'No, cancelar'
                }).then(function() {
                    $.ajax({
                        url: "{{ url('/') }}/administracion/rest/usuariosmobile/deshabilitar",
                        type: "POST",
                        data: {
                            id: idUsuario
                        },
                        dataType: "html",
                        success: function () {
                            swal('Deshabilitado!','El usuario ha sido deshabilitado.','success')
                            table.ajax.reload();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error al deshabilitar!", "Intenta más tarde", "error");
                        }
                    });
                }, function(dismiss) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                        'Cancelado',
                        'cancelaste la operación',
                        'error'
                        )
                    }
                })
        });

        
        // Handle click on checkbox
        $('#usuariosDT tbody').on('click', '#altaUsuario', function(e) {

            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var idUsuario = data.id;

            swal({
                title: 'Habilitar usuario?',
                text: 'El usuario ya podrá iniciar sesión',
                type: 'warning',
                showCancelButton: true,  
                confirmButtonText: 'Si, Habilitar!',
                cancelButtonText: 'No, cancelar'
                }).then(function() {
                    $.ajax({
                        url: "{{ url('/') }}/administracion/rest/usuariosmobile/habilitar",
                        type: "POST",
                        data: {
                            id: idUsuario
                        },
                        dataType: "html",
                        success: function () {
                            swal('Habilitado!','El usuario ha sido habilitado.','success')
                            table.ajax.reload();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error al habilitar!", "Intenta más tarde", "error");
                        }
                    });
                }, function(dismiss) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                        'Cancelado',
                        'cancelaste la operación',
                        'error'
                        )
                    }
                })
        });

        $("#nuevoUsuario").click(function() {
            document.location.href = "{{ url('/') }}/administracion/usuariosmobile/create"; //+ "/edit";
        });

    });
</script>
@endsection
