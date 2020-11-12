@extends('administracion.layout.master')
@section('titulo', 'Usuarios Mobile| Editar')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Usuarios Mobile| Editar ')
@section('directorio')
	<li class="breadcrumb-item"><a href="{{ url('/') }}/usuarios">Usuarios</a></li>
    <li class="breadcrumb-item active">Mobile</li>
    <li class="breadcrumb-item active">Editar</li>
@endsection 

   
@section('styles')
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
@endsection


@section('content')
<div style="margin: 25px auto; width:95%;">
   <div class="box-header with-border">
      <h4 class="box-title">Información Basica</h4>
      <br>
      <h6 class="box-title">Usuario: <strong> {{ $usuario->getNombre() }}  
         {{ $usuario->getApellidoPaterno() }} {{ $usuario->getApellidoMaterno() }} </strong>
      </h6>
      <br>
   </div>
   <!-- /.box-header -->
   <!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
   @if(Session::has('mensaje'))
   <div class="alert alert-success">
      <strong>OK! </strong> {{ Session::get('mensaje') }}
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
   {{  Form::open([ 'url' => ['/administracion/usuariosmobile' , $id ] , 'method' => 'PUT' ]) }}
   <div class="box-body">
      <!-- NOMBRE
         ================================== -->
      <div class="form-group">
         <label for="nombre">Nombre</label>
         <input type="text" value="{{ $usuario->getNombre() }}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
         @if ($errors->has('nombre'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('nombre') }}
         </div>
         @endif
      </div>
      <!-- APELLIDO PATERNO
         ================================== -->
      <div class="form-group">
         <label for="apPaterno">Apellido Paterno</label>
         <input type="text" value="{{ $usuario->getApellidoPaterno() }}" name="apPaterno" id="apPaterno" class="form-control" placeholder="Apellido Paterno">
         @if ($errors->has('apPaterno'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('apPaterno') }}
         </div>
         @endif
      </div>
      <!-- APELLIDO MATERNO
         ================================== -->
      <div class="form-group">
         <label for="apMaterno">Apellido Materno</label>
         <input type="text" value="{{ $usuario->getApellidoMaterno() }}" name="apMaterno" id="apMaterno" class="form-control" placeholder="Apellido Materno">
         @if ($errors->has('apMaterno'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('apMaterno') }}
         </div>
         @endif
      </div>
      <!-- EMAIL
         ================================== -->
      <div class="form-group">
         <label for="email">Email</label>
         <input type="email" value="{{ $usuario->getEmail() }}" name="email" id="email" class="form-control" placeholder="Email">
         @if ($errors->has('email'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('email') }}
         </div>
         @endif
      </div>

      <!-- USUARIO
         ================================== -->
      <div class="form-group">
         <label for="usuario">Usuario</label>
         <input type="text" value="{{ $usuario->getUsuario() }}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
         @if ($errors->has('usuario'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('usuario') }}
         </div>
         @endif
      </div>
      <!-- PASSWORD
         ================================== -->
      <div class="form-group">
         <label for="password">Password</label>
         <input type="password" value="{!! old('password') !!}" name="password" id="password" class="form-control" placeholder="Password">
         @if ($errors->has('password'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('password') }}
         </div>
         @endif
      </div>
      <!-- PASSWORD
         ================================== -->
      <div class="form-group">
         <label for="password_confirmation">Repetir Password</label>
         <input type="password" value="{!! old('password_confirmation') !!}" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password">
         @if ($errors->has('password_confirmation'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('password_confirmation') }}
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
   </div>
   <!-- /.box-body -->
   <br>
   <button type="submit" id="Actualizar" class="btn btn-primary">Actualizar</button>
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
                "url": "{{ url('/') }}/administracion/rest/usuariosmobile/permisos",
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
