@extends('administracion.layout.master')
@section('titulo', 'Asociación Editar')
@section('dependencia', ' - Policía Preventiva - ')
 
@section('directorioTitle', 'Asociación Editar') 
@section('directorio')
    <li class="breadcrumb-item ">Asociación</li>
    <li class="breadcrumb-item active">Editar</li>
@endsection  
  

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES --> 
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<style>    
    .validacion {  
        color: red;
        font-size: large;
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
   
    {{ Form::open(array('url'=>'/administracion/asociaciones/'.$asociacion->getId() ,'method' => 'PUT','id' => 'registro','role'=>'form' )) }}
        <div class="row">
            <div class="col-sm-12 col-md-12">

                <!-- NOMBRE 
                ================================== -->
                <div class="form-group">  
                   <label for="nombre">Nombre</label>
                   <input type="text" value="{{ $asociacion->getEtiqueta() }}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                   @if ($errors->has('nombre'))
                   <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                   @endif
                </div>

                <!-- ALIAS
                ================================== -->
                <div class="form-group">
                   <label for="alias">Alias</label>
                   <input type="text" value="{{ $asociacion->getAlias() }}" name="alias" id="alias" class="form-control" placeholder="alias">
                   @if ($errors->has('alias'))
                   <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('alias') }}</div>
                   @endif
                </div>    

            </div>  <!-- Col -->
        </div> <!-- row -->
    
        <section style="margin-top:20px;">
            <table class="table table-striped table-bordered table-hover" id="encargadosDT">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>correo</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Teléfono Celular</th>
                        <th>Asociaciones</th>
                        <th>Cadenas</th>
                        <th>Establecimiento</th>
                        <th><input name="select_all" type="checkbox" value="1"/> Todos</th>
                    </tr>
                </thead>
                <tbody> 
                </tbody>   
            </table>
            <input type="text" value="{!! old('encargadosList') !!}" name="encargadosList" id="encargadosList" class="form-control" placeholder="Encargados">

        </section>
        
        <input  type="submit" id="crear" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Actualizar"/>
        

    {{ Form::close() }}
  
</div>  
@endsection  
      


@section('scripts')

<!-- DATATABLES -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
<!--Validacion de JQuery-->
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/localization/messages_es.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/additional-methods.js"></script>

<script>
   
    $(function() {

        $.ajaxSetup({ 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        listAllEncargados();

    }); //finalizar con function




    function listAllEncargados(){
 
        var rows_selected = [];
        var rows_php = {{json_encode($encargadosList)}};

        for (x = 0; x < rows_php.length; x++) {
            rows_selected.push(rows_php[x]);
        }

        document.getElementById('encargadosList').value = rows_selected;

        var table = $('#encargadosDT').DataTable({
            responsive: true,
            "autoWidth": false,
            "deferRender": true,
            "serverSide": true,
            "deferRender": true,
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
                "url": "{{ url('/') }}/administracion/rest/encargados",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    table.ajax.reload();
                }
            },
            "columns": [
                { "data": "id" },
                { "data": "correo" },
                { "data": "nombre" },
                { "data": "telefono" },
                { "data": "celular" },
                { "data": "asociaciones"},
                { "data": "cadenas" },
                { "data": "establecimientos" },
                { "data": "id" }
            ],
            "columnDefs": [{
                    "render": function(data, type, row) {
                        var check = "";
                        var clase = "";
                        for (x = 0; x < rows_php.length; x++) {
                            if (rows_php[x] == row.id) {
                                check = '<input type="checkbox" checked>';
                                clase = "selected";
                                break;
                            } else {
                                check = '<input type="checkbox">';
                                clase = "";
                            }
                        }
                        return check;
                        row.addClass(clase);
                    },
                    "targets": 8
                },
                {
                    "render": function(data, type, row) {
                        return row.nombre + " " + row.apellidoPaterno + " " + row.apellidoMaterno;
                    },
                    "targets": 2
                }
            ],
            'rowCallback': function(row, data, dataIndex) {

                var rowId = data.id;
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }

            }
        });


        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });


        $('#encargadosDT tbody').on('click', 'input[type="checkbox"]', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            var rowId = data.id;

            var index = $.inArray(rowId, rows_selected);

            if (this.checked && index === -1) {
                rows_selected.push(rowId);
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) { 
                current_row.addClass('selected');
            } else {
                current_row.removeClass('selected');
            }
            console.log("Ids seleccionados: " + rows_selected);
            document.getElementById('encargadosList').value = rows_selected;
            updateDataTableSelectAllCtrl(table);
            e.stopPropagation();
        });

        $('#encargadosDT').on('click', 'tbody td, thead th:last-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#encargadosDT tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#encargadosDT tbody input[type="checkbox"]:checked').trigger('click');
            }
            e.stopPropagation();
        });

        table.on('draw', function() {
            updateDataTableSelectAllCtrl(table);
        });

    }


    function updateDataTableSelectAllCtrl(table) {

        var $table = table.table().node();
        var $chkbox_all = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if ($chkbox_checked.length === 0) {
            chkbox_select_all.checked = false;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length) {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = true;
            }
        }
    }

</script>

<script>
    $(document).ready(function() {

        $('#registro').validate({
            rules: {
                nombre: {
                    required: true,
                    maxlength: 200
                },
                alias: {
                    required: true,
                    maxlength: 200
                },
            },
            messages: {
                nombre: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                alias: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

            },

            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
@endsection
