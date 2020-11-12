@extends('administracion.layout.master')
@section('titulo', 'Soporte ')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Soporte ')
@section('directorio')
    <li class="breadcrumb-item">Soporte</li>
@endsection


    
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">
<!-- sweetalert 2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
@endsection


@section('content')
<div style="margin: 25px auto; width:95%;">
   <!-- TABLA DE ELEMENTOS  TOTALES EN EL SISTEMA
      ================================================-->
   <div class="row">
      <div class="col-lg-12">  
         <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
               <div class="dataTable_wrapper">
                  <table class="table table-striped table-bordered table-hover" id="soporteDT">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>nombre</th>
                           <th>email</th>
                           <th>asunto</th>
                           <th>problema</th>
                           <th>Imagen</th>
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

        var table = $('#soporteDT').DataTable({

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
                "url": "{{ url('/') }}/administracion/rest/soporte",
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
                    "data": "nombre"
                },
                {
                    "data": "email"
                },
                {
                    "data": "asunto"
                },
                {
                    "data": "problema"
                },
                {   "data": "id", "width": "300px"  }//foto
            ],
            "columnDefs": [
                {  
				    "render": function (data, type, row) {
                        var acciones = "";
                        for( var i=0; i< row.documento.length ; i++ ){
						    acciones += '<img style="width: 100%; height: auto;" src="data:image/*;base64,'+ row.documento[i].documentos +' "/>';
                        }
						return acciones;
					},
					"targets": 5
				} 
            ]
        });


        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });

        // Handle click on checkbox
        $('#soporteDT tbody').on('click', '#modificarDispositivo', function(e) {
            var $row = $(this).closest('tr');
            // Get row data
            var data = table.row($row).data();
            // Get row ID
            var id = data.id;
            console.log(id);

            document.location.href = "{{ url('/') }}/dispositivos/" + id + "/edit";

            e.stopPropagation();
        });


        // Handle click on checkbox
        $('#soporteDT tbody').on('click', '#bajaUsuario', function(e) {
            swal({
                title: 'Deshabilitar dispositivo?',
                text: 'El dispositivo ya no podrá iniciar sesión',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, deshabilitar!',
                cancelButtonText: 'No, cancelar'
            }).then(function() {
                $.ajax({
                    url: "scriptDelete.php",
                    type: "POST",
                    data: {
                        id: 5
                    },
                    dataType: "html",
                    success: function() {
                        swal('Deshabilitado!', 'El dispositivo ha sido deshabilitado.', 'success')
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
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

        $("#nuevoUsuario").click(function() {
            document.location.href = "{{ url('/') }}/dispositivos/create"; //+ "/edit";
        });


    });
</script>
@endsection
