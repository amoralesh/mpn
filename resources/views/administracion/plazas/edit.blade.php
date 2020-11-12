
@extends('administracion.layout.master')
@section('titulo', 'Plaza Editar')
@section('dependencia', ' - Policía Preventiva - ')
 

@section('directorioTitle', 'Plaza')  
@section('directorio')
    <li class="breadcrumb-item ">Plaza</li>  
    <li class="breadcrumb-item active">Editar</li>
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


         {{ Form::open(array('url'=>'/administracion/plazas/'.$plaza->getId(),'method' => 'PUT','id' => 'registro','role'=>'form' )) }}
         <div class="row">
            <div class="col-sm-4 col-md-4">
               <!-- NOMBRE 
                  ================================== -->
               <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" value="{{ $plaza->getEtiqueta() }}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                  @if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                  @endif
               </div>
               <!-- ALIAS 
                  ================================== -->
               <div class="form-group">
                  <label for="alias">alias</label>
                  <input type="text" value="{{ $plaza->getAlias() }}" name="alias" id="alias" class="form-control" placeholder="alias">
                  @if ($errors->has('alias'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('alias') }}</div>
                  @endif
               </div>
               <!-- CALLE PRINCIPAL
                  ================================== -->
               <div class="form-group">
                  <label for="callePrincipal">Calle Principal</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getCallePrincipal() }}" name="callePrincipal" id="callePrincipal" class="form-control" placeholder="callePrincipal">
                  @if ($errors->has('callePrincipal'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('callePrincipal') }}</div>
                  @endif
               </div>
               <!-- CALLE 1
                  ================================== -->
               <div class="form-group">
                  <label for="calleA">Calle 1</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getCalle1() }}" name="calleA" id="calleA" class="form-control" placeholder="calleA">
                  @if ($errors->has('calleA'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleA') }}</div>
                  @endif
               </div>
               <!-- CALLE 2
                  ================================== -->
               <div class="form-group">
                  <label for="calleB">Calle 2</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getCalle2() }}" name="calleB" id="calleB" class="form-control" placeholder="calleB">
                  @if ($errors->has('calleB'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleB') }}</div>
                  @endif
               </div>
               <!-- NUMERO INTERIOR
                  ================================== -->
               <div class="form-group">
                  <label for="numeroInterior">Número Interior</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getNumeroInterior() }}" name="numeroInterior" id="numeroInterior" class="form-control" placeholder="numeroInterior">
                  @if ($errors->has('numeroInterior'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroInterior') }}</div>
                  @endif
               </div>
            </div>
            <!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-4 col-md-4">
               <!-- NUMERO EXTERIOR
                  ================================== -->
               <div class="form-group">
                  <label for="numeroExterior">Número Exterior</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getNumeroExterior() }}" name="numeroExterior" id="numeroExterior" class="form-control" placeholder="numeroExterior">
                  @if ($errors->has('numeroExterior'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroExterior') }}</div>
                  @endif
               </div>
               <!-- EDIFICIO
                  ================================== -->
               <div class="form-group">
                  <label for="edificio">Edificio</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getEdificio() }}" name="edificio" id="edificio" class="form-control" placeholder="edificio">
                  @if ($errors->has('edificio'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('edificio') }}</div>
                  @endif  
               </div>
               <!-- DELEGACION
                  ================================== --> 
               <div class="form-group">
                  <label for="delegacion">Delegación</label>
                  <select name="delegacion" id="delegacion" class="form-control select2">
                  @foreach($delegacionList as $delegacion)
                  <option {{( $delegacion->getid() == $plaza->getDireccion()->getColonia()->getDelegacion()->getId() ? "selected" : "") }} value="{{ $delegacion->getid() }} "> {{$delegacion->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('delegacion'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('delegacion') }}</div>
                  @endif
               </div>
               <!-- COLONIA
                  ================================== -->
               <div class="form-group">
                  <label for="colonia">Colonia</label>
                  <select name="colonia" id="colonia" class="form-control select2">
                  @foreach($coloniaList as $colonia)
                  <option {{(  $colonia->getid() ==  $plaza->getDireccion()->getColonia()->getId() ? "selected" : "") }} value="{{ $colonia->getid() }} "> {{$colonia->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('colonia'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('colonia') }}</div>
                  @endif
               </div>
               <!-- TIPO DE ASENTAMIENTO 
                  ================================== -->
               <div class="form-group">
                  <label for="tipoAsentamiento">Tipo de Asentamiento</label>
                  <select name="tipoAsentamiento" id="tipoAsentamiento" class="form-control">
                  @foreach($tipoAsentamientoList as $tipoAsentamiento)
                  <option {{(  $tipoAsentamiento->getid() == $plaza->getDireccion()->getTipoAsentamiento()->getId() ? "selected" : "") }} value="{{ $tipoAsentamiento->getid() }} "> {{$tipoAsentamiento->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('tipoAsentamiento'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoAsentamiento') }}</div>
                  @endif
               </div>
            </div>
            <!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-4 col-md-4">
               <!-- NOMBRE ASENTAMIENTO
                  ================================== -->
               <div class="form-group">
                  <label for="nombreAsentamiento">Nombre del Asentamiento</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getNombreAsentamiento() }}" name="nombreAsentamiento" id="nombreAsentamiento" class="form-control" placeholder="nombreAsentamiento">
                  @if ($errors->has('nombreAsentamiento'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombreAsentamiento') }}</div>
                  @endif
               </div>
               <!-- CODIGO POSTAL
                  ================================== -->
               <div class="form-group">
                  <label for="codigoPostal">Codigo Postal</label>
                  <input type="text" value="{{ $plaza->getDireccion()->getCodigoPostal() }}" name="codigoPostal" id="codigoPostal" class="form-control" placeholder="codigoPostal">
                  @if ($errors->has('codigoPostal'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('codigoPostal') }}</div>
                  @endif
               </div>
               <!-- TELEFONO
                  ================================== -->
               <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" value="{{ $plaza->getTelefono() }}" name="telefono" id="telefono" class="form-control" placeholder="telefono">
                  @if ($errors->has('telefono'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefono') }}</div>
                  @endif
               </div>
               <!-- EXTENSION
                  ================================== -->
               <div class="form-group">
                  <label for="extension">Extensión</label>
                  <input type="text" value="{{ $plaza->getExtension() }}" name="extension" id="extension" class="form-control" placeholder="extension">
                  @if ($errors->has('extension'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('extension') }}</div>
                  @endif
               </div>
            </div>
         </div>

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

@endsection



@section('scripts')
<!--DATATABLES-->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
<!--SELECT 2-->
<script src="{{ url('/') }}/public/assets/global/plugins/select2/dist/js/select2.min.js"></script>
<!-- SWEET ALERT 2--> 
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/sweetalert.js"></script>
<!--Validacion de JQuery-->
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/localization/messages_es.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/additional-methods.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js"></script>

<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        token = $('meta[name="csrf-token"]').attr('content');

        $(".select2").select2();
        var select = $("#delegacion");

        select.on('change', function() {
            obtenerColonias(select.val());
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




    function obtenerColonias(id) {
        var dialog;
        var select = $("#colonia");
        select.empty();
        $.ajax({   
            url: "{{ url('/') }}/administracion/rest/catalogo/colonias/delegacion/" + id,
            type: 'GET',  
            dataType: "json",
            beforeSend: function() {
                swal({ title: 'Recuperando Información' });
                swal.showLoading();
            },
            success: function(data) {
                swal.close();
                for (i = 0; i < data.length; i++) {
                    select.append(new Option(data[i].etiqueta, data[i].id));
                }
            },
            complete: function() {
                swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                swal.close();
                console.log(xhr);
                console.log("error");
            }
        });
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
                callePrincipal: {
                    required: true,
                    maxlength: 200
                },
                calleA: {
                    required: true,
                    maxlength: 200
                },
                calleB: {
                    required: true,
                    maxlength: 200
                },
                numeroInterior: {
                    required: true,
                    maxlength: 200
                },
                numeroExterior: {
                    required: true,
                    maxlength: 200
                },
                delegacion: {
                    required: true
                },
                colonia: {
                    required: true
                },
                tipoAsentamiento: {
                    required: true
                },
                nombreAsentamiento: {
                    required: true,
                    maxlength: 200
                },
                codigoPostal: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 5
                },
                telefono: {
                    required: true,
                    digits: true,
                    minlength: 8
                },
                extension: {
                    digits: true
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
                callePrincipal: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                calleA: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                calleB: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                numeroInterior: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                numeroExterior: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                delegacion: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elije una opción </div>')
                },
                colonia: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elije una opción </div>')
                },
                tipoAsentamiento: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elije una opción </div>')
                },
                nombreAsentamiento: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                codigoPostal: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo se acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 5 Digitos</div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 5 digitos</div>')
                },
                telefono: {
                    required: jQuery.validator.format('<div style="color:red"; class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 8 digitos</div>')
                },
                extension: {
                    digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>')
                },

            },

            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>

@endsection
