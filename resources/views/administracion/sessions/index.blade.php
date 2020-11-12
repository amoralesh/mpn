@extends('administracion.layout.master')
@section('titulo', 'Sesiones | Lista')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Sesiones | Lista')
@section('directorio')
    <li class="breadcrumb-item">Sesiones</li>
@endsection


   
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">

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
                  <table class="table table-striped table-bordered table-hover" id="sesionesDT">
                     <thead>
                        <tr>
                           <th>Usuario</th>
                           <th>Dirección IP</th>
                           <th>User Agent</th>
                           <th>Última Actividad</th>
                           <th>Datos</th>
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
</div>
@endsection


@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/pdfmake-0.1.18/build/pdfmake.min.js">
</script>
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
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        var table = $('#sesionesDT').DataTable({

            responsive: true,
            "autoWidth": false,
            fixedHeader: true,
            fixedColumns: true,
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
                "url": "{{ url('/') }}/administracion/rest/sesiones", 
                "type": "GET",
                "dataSrc": "",
                "error": function(xhr, error, thrown) {
                    console.log("error")
                    table.ajax.reload();
                }
            },
            "columns": [
                {
                    "data": "user_id"
                },
                {
                    "data": "ip_address"
                },
                {
                    "data": "user_agent"
                },
                {
                    "data": "last_activity"
                },
                {
                    "data": "payload" //DATOS
                },
                {
                    "data": "user_id"
                }
            ],
            "columnDefs": [
                {  
                    "render": function(data, type, row) {
                        var date = new Date(data*1000);
                        var month = date.getMonth() + 1;
                        return  date.getMonth()+1 +"/"+ date.getDate()+ "/" +date.getFullYear() +" "+ date.getHours() +":"+ date.getMinutes() +":"+ date.getSeconds();
                    },
                    "targets": 3
                },
                {
                    "render": function(data, type, row) {
                        var acciones = "";
                        @if( in_array( 'Administracion:AsideControlls:Sessions:Eliminar' , Session::get('permisos') ) )
                            acciones = '<i id="eliminar" class="fa fa-trash-o" style="color: red;">&nbsp;&nbsp;&nbsp;</i>';
                        @endif
                        return acciones;
                    },
                    "targets": 5
                }
                        
            ] 
        });
        

        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
            

        });

        
        @if( in_array( 'Administracion:AsideControlls:Sessions:Eliminar' , Session::get('permisos') ) )
            // Handle click on checkbox
            $('#sesionesDT tbody').on('click', '#eliminar', function(e) {
                var $row = $(this).closest('tr');
                // Get row data
                var data = table.row($row).data();
                // Get row ID
                var id = data.id;
                console.log(id);

                swal({
                    title: 'Cerrar sesión del usuario?',
                    text: 'Esto permitira deslogear al usuario automaticamente',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, cerrar sesión!',
                    cancelButtonText: 'No, cancelar'
                }).then(function() {
                    $.ajax({
                        url: "{{ url('/') }}/administracion/rest/sesiones/cerrarsesion",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function() {
                            swal('Sesión cerrada!', 'La sesión ha sido cerrada.', 'success')
                            table.ajax.reload();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            swal("Error al cerrar sesión!", "Intenta más tarde", "error");
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
        @endif
    });
</script>
@endsection
