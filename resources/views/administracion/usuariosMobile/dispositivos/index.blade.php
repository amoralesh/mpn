@extends('administracion.layout.master')
@section('titulo', 'Usuarios Movil | Dispositivos')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Usuarios Movil | Dispositivos')
@section('directorio')
    <li class="breadcrumb-item">Usuarios Movil - Dispositivos</li>
@endsection 

   
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
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



@section('content') <div style="margin: 25px auto; width:95%;">
<div style="margin: 25px auto; width:95%;">
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
                           <th>E-mail</th>
                           <th>Dependencia</th>
                           <th>Dispositivos</th>
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
   <!--  END Chartist CHART -->
</div>
@endsection



@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/pdfmake-0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/AutoFill-2.1.2/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Buttons-1.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Buttons-1.2.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Buttons-1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Buttons-1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/KeyTable-2.1.3/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/RowReorder-1.1.2/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Select-1.2.0/js/dataTables.select.min.js"></script>

<!-- START PAGE PLUGINS -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/es6-promise/es6-promise.auto.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- END PAGE PLUGINS -->

<!-- START PAGE JAVASCRIPT -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/sweetalert.js"></script>
<script>
    $('[data-plugin="sweetalert"]').on('click', function() {
        var $this = $(this),
            $options = $.extend({}, $this.data());
        swal($options).catch(swal.noop)
    });
</script>
<!-- END PAGE JAVASCRIPT -->

<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        token = $('meta[name="csrf-token"]').attr('content');

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
                "url": "{{ url('/') }}/administracion/rest/mobile/usuarios/dispositivos",
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
                    "data": "email"
                },
                {
                    "data": "depend"
                },
                {
                    "data": "status"//dispositivos
                },
                {
                    "data": "status"
                },
                {
                    "data": "status"//accion
                }
            ],
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        var acciones = row.nombre + ' ' + row.apellidoPaterno + ' ' + row.apellidoMaterno;
                        return acciones;
                    },
                    "targets": 2
                },
                {
                    "render": function(data, type, row) {
                        var acciones = "";
                        row.dispositivos.forEach(function(dispositivo) {
                            acciones += "<p><strong>IdUnico: </strong>" + dispositivo.idUnico 
                                    + "<br><strong>Alias: </strong>" + dispositivo.alias + " " 
                                    + "<br><strong>Número: </strong>" + dispositivo.numero + " " 
                                    + "<br><strong>Modelo: </strong>" + dispositivo.modelo + " " 
                                    + "<br><strong>Version: </strong>" + dispositivo.version + " " 
                                    + "<br><strong>Tipo: </strong>" + dispositivo.tipo + " " 
                                    + "<br><strong>Status: </strong>" + dispositivo.status + " " 
                                    + "</p>" 
                        });
                        return acciones; 
                    },
                    "targets": 5
                },
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</span>';
                    },
                    "targets": 6
                },
                {
                    "render": function(data, type, row) {
                        var acciones = '<i id="anadirDispositivo" class="fa fa-plus" style="color: #ff1c9b;">&nbsp;&nbsp;&nbsp; Añadir Dispositivo</i>';
                        acciones += '<br><i id="removerDispositivo" class="fa fa-minus" style="color: #ff1c9b;">&nbsp;&nbsp;&nbsp; Remover Dispositivo</i>';
                      
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
        $('#usuariosDT tbody').on('click', '#anadirDispositivo', function(e) {

            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var idUsuario = data.id;

             swal({
                title: 'Ingrese el ID Unico del dispositivo',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Añadir',
                showLoaderOnConfirm: true, 
                cancelButtonText: 'Cancelar', 
                preConfirm: function (idUnico) {
                    return new Promise(function (resolve, reject) {
                        setTimeout(function() {
                            $.ajax({   
                                url: "{{ url('/') }}/administracion/rest/mobile/usuarios/dispositivos/dispositivo/add",
                                type: "POST",
                                data: {
                                    idUnico: idUnico,
                                    idUsuario : idUsuario
                                },
                                dataType: "html",
                                success: function(response) {
                                    swal('Añadido!', 'El dispositivo ha sido añadido correctamente.', 'success');
                                    table.ajax.reload();
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    swal("Error al añadir!", "Intenta más tarde ó contacte con el administrador", "error");
                                }
                            });
                        }, 3000)
                    })
                },
                allowOutsideClick: false
            }).then(function (idUnico) {
                
            });
            e.stopPropagation();
        });


        // Handle click on checkbox
        $('#usuariosDT tbody').on('click', '#removerDispositivo', function(e) {

            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var idUsuario = data.id;
            swal({
                title: 'Ingrese el ID Unico del dispositivo a remover',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Remover',
                showLoaderOnConfirm: true, 
                cancelButtonText: 'Cancelar', 
                preConfirm: function (idUnico) {
                    return new Promise(function (resolve, reject) {
                        setTimeout(function() {
                            $.ajax({
                                url: "{{ url('/') }}/administracion/rest/mobile/usuarios/dispositivos/dispositivo/remove",
                                type: "POST",
                                data: {
                                    idUnico: idUnico,
                                    idUsuario : idUsuario
                                },
                                dataType: "html",
                                success: function(response) {
                                    swal('Removido!', 'El dispositivo ha sido removido correctamente.', 'success');
                                    table.ajax.reload();
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    swal("Error al remover!", "Intenta más tarde ó contacte con el administrador", "error");
                                }
                            });
                        }, 3000)
                    })
                },
                allowOutsideClick: false
            }).then(function (idUnico) {
                
            });
            e.stopPropagation();
        });



    });
</script>
@endsection
  