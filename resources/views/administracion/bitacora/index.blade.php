@extends('administracion.layout.master')
@section('titulo', 'Bitacora | Lista')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Bitacora | Lista')
@section('directorio')
    <li class="breadcrumb-item">Bitacora</li>
@endsection


   
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">
<!-- Sweet alert -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
<!-- daterange picker -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/datepicker/datepicker3.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/timepicker/bootstrap-timepicker.min.css">

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

   <div class="col-lg-6">
      <div class="form-group"><!-- Date and time range --> 
         <label>Rango de fechas</label>
         <div class="input-group">
            <div class="input-group-addon">
               <i class="fa fa-clock-o"></i>
            </div>
            <input type="text" class="form-control pull-right" id="fechas" name="fechas">
         </div>
         <!-- /.input group -->
      </div>
   </div>

   <br>  
   <br>
   <br>
   <br>

    <h4>Mostrando la bitacora del día de hoy</h4>

    <section style="margin-top:20px;">
        <table class="table table-striped table-bordered table-hover" id="bitacoraDT">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>

</div>
@endsection



@section('scripts')
<!-- DATATABLES -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>

<!-- date-range-picker -->
<script src="{{ url('/') }}/public/assets/global/js/global/moments.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="{{ url('/') }}/public/assets/global/plugins/datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        Bitacora( moment().startOf('day').format('YYYY-MM-DD H:mm:ss') , moment().endOf('day').format('YYYY-MM-DD H:mm:ss') );

        var start = moment();
        var end = moment(start, "DD/MM/YYYY").add(1, 'month');
        
        $('input[name="fechas"]').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 5,
                startDate: start, 
                endDate: end,
                ranges: {
                'Hoy': [ moment().startOf('day'), moment().endOf('day') ],
                'Ayer': [moment().subtract(1, 'days').startOf('day') , moment().subtract(1, 'days').endOf('day')],
                'Hace 7 Días': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                'Últimos 30 Días': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
                'Este mes': [moment().startOf('month'), moment().endOf('month').endOf('day')],
                'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "locale": { 
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Ok",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "De",
                    "toLabel": "A",
                    "customRangeLabel": "Custom",
                    "daysOfWeek": [
                        "Dom",
                        "Lun",
                        "Mar",
                        "Mie",
                        "Jue",
                        "Vie",
                        "Sab"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agusto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                }
            },
            function( start , end , label) {
                Bitacora( start.format('YYYY-MM-DD H:mm:ss')  , end.format('YYYY-MM-DD H:mm:ss')  ); 
            } 
        );

    }); //FIN SCRIPT

    
        function Bitacora(fechaInicio, fechaFin) { 

            $('#bitacoraDT').dataTable().fnDestroy();
            var table = $('#bitacoraDT').DataTable({
  
                responsive: true,
                "autoWidth": false,
                "deferRender": true, 	
	            "pageLength": 50,
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
                    "url": "{{ url('/') }}/administracion/rest/bitacora/" + fechaInicio + "/" + fechaFin + "",
                    "type": "GET",  
                    "dataSrc": "",
                    "error": function(xhr, error, thrown) {
                        table.ajax.reload();
                    }
                },
                "columns": [
                    { "data": "id"  },
                    { "data": "fecha.date" },
                    { "data": "usuario" },
                    { "data": "accion" }
                ],
                "columnDefs": []
            });
        }
</script>

@endsection
