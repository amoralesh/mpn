@extends('administracion.layout.master')
@section('titulo', 'Dispositivos Mobile | Editar')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Dispositivos Mobile | Editar ')
@section('directorio')
	<li class="breadcrumb-item"><a href="{{ url('/') }}/dispositivos/mobile">Dispositivos Mobile</a></li>
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
@endsection
 



@section('content')
<div style="margin: 25px auto; width:95%;">
   <div class="box-header with-border">
      <h4 class="box-title">Información Basica</h4>
      <br>
      <h6 class="box-title">Editar dispositivo: <strong> {{ $dispositivo->getIdUnico() }} | {{ $dispositivo->getAlias() }} </strong>
      </h6>
      <br>
   </div>
   <!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
   @if(Session::has('mensaje'))
   <div class="alert alert-success">
      <strong>Actualizado! </strong> {{ Session::get('mensaje') }}
   </div>
   @endif
   <!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
   @if(Session::has('errores'))
   <div class="alert alert-danger">
      <strong>Cuidado! </strong> {{ Session::get('errores') }}
   </div>
   @endif
   <!-- FORMULARIO PRINCIPAL
      ================================== --> 
   <!-- form start -->
   {{  Form::open([ 'url' => ['/administracion/dispositivos/mobile' , $id ] , 'method' => 'PUT' ]) }}
   <div class="box-body">

        <!-- ID_UNICO
        ================================== -->
        <div class="form-group">
            <label for="idUnico">ID - único</label>
            <input type="text" value="{{ $dispositivo->getIdUnico() }}" name="idUnico" id="idUnico" class="form-control" placeholder="ID - Único ó IMEI">
            @if ($errors->has('idUnico'))
            <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('idUnico') }}
            </div>
            @endif
        </div>

        <!-- ALIAS
        ================================== -->
        <div class="form-group">
            <label for="alias">Alias</label>
            <input type="text" value="{{ $dispositivo->getAlias() }}" name="alias" id="alias" class="form-control" placeholder="Alias">
            @if ($errors->has('alias'))
            <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('alias') }}
            </div>
            @endif
        </div>

        <!-- NUMERO
        ================================== -->
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" value="{{ $dispositivo->getNumero() }}" name="numero" id="numero" class="form-control" placeholder="Número">
            @if ($errors->has('numero'))
            <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('numero') }}
            </div>
            @endif
        </div>

        <!-- MODELO
        ================================== -->
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="modelo" value="{{ $dispositivo->getModelo() }}" name="modelo" id="modelo" class="form-control" placeholder="Modelo (Sony xperia m2) ">
            @if ($errors->has('modelo'))
            <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('modelo') }}
            </div>
            @endif
        </div>
        
        <!-- VERSION
        ================================== -->
        <div class="form-group">
            <label for="version">Versión</label>
            <input type="text" value="{{ $dispositivo->getVersion() }}" name="version" id="version" class="form-control" placeholder="Versión (5.3)">
            @if ($errors->has('version'))
            <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('version') }}
            </div>
            @endif
        </div>

        <!-- TIPO DE DISPOSITIVO
        ================================== -->
        <div class="form-group">
            <label for="tipo">Tipo de dispositivo</label>
            <select name="tipo" id="tipo" class="form-control">
                @foreach($tipoDispositivoList as $tipo)
                <option {{ ( $dispositivo->getTipoDispositivo()->getId()  == $tipo->getId() ? "selected" : "") }} value="{{$tipo->getId()}}">{{$tipo->getEtiqueta()}}</option>
                @endforeach
            </select>
            @if ($errors->has('tipo'))
            <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('tipo') }}
            </div> 
            @endif
        </div>


      <!-- TABLA DE ROLES
         ================================================-->
      <div class="row">
         <div class="col-lg-12">
            <div class="panel panel-default">
               <div class="panel-heading">
                  Permisos en el sistema actuales
               </div>
               <!-- /.panel-heading -->
               <div class="panel-body">
                  <div class="dataTable_wrapper">
                     <table class="table table-striped table-bordered table-hover" id="permisosDT">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Permiso</th>
                              <th>Descripcion</th>
                              <th><input name="select_all" type="checkbox" value="1"/> Todos</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.table-responsive -->
                  <div class="well">
                     <h4>La tabla muestra a los permisos en el sistema</h4>
                     <input type="text" value="{{ implode(",",$permisosList)  }}" name="permisosElegidos" id="permisosElegidos" class="form-control" placeholder="Permisos Elegidos">
                     <!-- <div class='col-lg-12 col-md-12'><button type='button' class='btn btn-success' id='buttonCrearRegistro' ><i class='fa fa-pencil fa-fw'></i> Crear registro</button></div> -->   
                  </div>
               </div>
               <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
         </div>
         <!-- /.col-lg-12 -->
      </div>
      <!-- /TABLA -->
      <!--
         <div class="checkbox">
           <label>
             <input type="checkbox"/> Acepto, He revisado la información anterior 
           </label>
         </div>
          -->
   </div><!-- /.box-body -->
   <br>
   <div class="box-footer">
      <button type="submit" id="Actualizar" class="btn btn-primary">Actualizar</button>
   </div>
   {{ Form::close() }}
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

<script>
    $(function() {

        /* TABLA DE PERMISOS
		=========================================================*/
        var rows_selected = [];

        var rows_php = {{json_encode($permisosList)}}
        //var yourArray = JSON.parse(rows_php);
        for (x = 0; x < rows_php.length; x++) {
            rows_selected.push(rows_php[x]);
        }
        document.getElementById('permisosElegidos').value = rows_selected;


        //console.log(permisosUsuario.toString());

        var tableRoles = $('#permisosDT').DataTable({
            responsive: true,
            "autoWidth": false,
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
            // 
            // Alarmas vecinales
            // 
            "processing": true,
            "ajax": {
                "url": "{{ url('/') }}/administracion/rest/dispositivos/mobile/permisos", 
                "type": "GET",
                "dataSrc": "",
                "error": function(xhr, error, thrown) {
                    console.log("error")
                    tableRoles.ajax.reload();
                }
            },    
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "id"
                }

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
                "targets": 3
            }],
            'rowCallback': function(row, data, dataIndex) {

                var rowId = data.id;
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        /*  <div class='col-lg-12 col-md-12'> <button type='button' class='btn btn-danger' id='buttonBorrarRegistro'><i class='fa fa-trash-o fa-fw'></i> Borrar registro</button></div>*/
        tableRoles.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });



        //setInterval( function () {
        //	tableRoles.ajax.reload();
        //}, 30000 );

        // Handle click on checkbox
        $('#permisosDT tbody').on('click', 'input[type="checkbox"]', function(e) {

            var $row = $(this).closest('tr');

            // Get row data
            var data = tableRoles.row($row).data();

            // Get row ID
            var rowId = data.id;

            // Determine whether row ID is in the list of selected row IDs 
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }
            // console.log( tableRoles.rows('.selected').data().length +' row(s) selected' );
            /*
            for(var i=0; i < rows_selected.lenght; i++ ){
                console.log("Ids seleccionados: " + rows_selected[i]);
            }*/

            console.log("Ids seleccionados: " + rows_selected);
            document.getElementById('permisosElegidos').value = rows_selected;
            //$("#altaUsuario\\:permisosElegidos").text(rows_selected);
            //document.getElementById('permisosElegidos').value= rows_selected ; 
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(tableRoles);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // permisosDT click on table cells with checkboxes
        $('#permisosDT').on('click', 'tbody td, thead th:last-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', tableRoles.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#permisosDT tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#permisosDT tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        tableRoles.on('draw', function() {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(tableRoles);
        });
    });



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
@endsection
