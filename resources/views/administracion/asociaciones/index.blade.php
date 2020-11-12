
@extends('administracion.layout.master')
@section('titulo', 'Asociación')
@section('dependencia', ' - Policía Preventiva - ') 
 
@section('directorioTitle', 'Asociación')
@section('directorio')
    <li class="breadcrumb-item ">Asociación</li>
@endsection 
   

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- sweetalert 2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
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
   
    <button type="button" id="crear" class="btn btn-primary">Crear nueva Asociación</button>
    
    <section style="margin-top:20px;">
        <table class="table table-striped table-bordered table-hover" id="asociacionesDT">
            <thead>
                <tr>  
                    <th>#</th>
                    <th>Nombre</th>
                    <th>fecha alta</th>
                    <th>Alias</th>
                    <th># Cadenas</th>
                    <th>Encargados</th>
                    <th>Status</th>
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

<!-- SWEET ALERT 2-->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/sweetalert.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js"></script>

<script>
    $(function() { 
           
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        token = $('meta[name="csrf-token"]').attr('content');
 
        var table = $('#asociacionesDT').DataTable({

            responsive: true,
            "autoWidth": false,
            "bProcessing": true,
            "serverSide": true,
            "deferRender": true,
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
                "url": "{{ url('/') }}/administracion/rest/asociaciones",
                "type": "POST",
                "data": {
                    _token: token
                },
                "error": function(xhr, error, thrown) {
                    table.ajax.reload();
                }
            },
            "columns": [
                { "data": "id" }, 
                { "data": "nombre" },
                { "data": "fechaAlta.date" },
                { "data": "alias" },
                { "data": "numeroCadenas" },
                { "data": "numeroEncargados" },
                { "data": "status" },
                { "data": "id" }
            ],
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</pan>';
                    },
                    "targets": 6
                },
                {
                    "render": function(data, type, row) {
                        
                        var acciones = ''; 
                            acciones += '<div id="informacion" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-info"></i> Información</button></div>';
                            acciones += '<div id="cadenas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Ver Cadenas</button></div>';
                            acciones += '<div id="encargados" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-group"></i> Ver Encargados</button></div>';
                            acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
                        if (row.status == true) { 
                            acciones += '<div id="baja" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-down"></i> Deshabilitar</button></div>';
                        } else {
                            acciones += '<div id="alta" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-up"></i> Habilitar</button></div>';
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


        $('#crear').on('click', function(e) {
            document.location.href = "{{ url('/') }}/administracion/asociaciones/create";
            e.stopPropagation();
        });
 
 
        $('#asociacionesDT tbody').on('click', '#encargados', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data(); 

            findEncargadosByIdAsociacion( data );  

            e.stopPropagation();
        });
 
        $('#asociacionesDT tbody').on('click', '#cadenas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data(); 

            findCadenaByIdAsociacion( data );  

            e.stopPropagation();
        });

  
        $('#asociacionesDT tbody').on('click', '#informacion', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data(); 

            findAsociacionById( data );

            e.stopPropagation();
        });

  

        $('#asociacionesDT tbody').on('click', '#editar', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            var id = data.id;

            document.location.href = "{{ url('/') }}/administracion/asociaciones/" + id + "/edit";
            e.stopPropagation();
        });

        
        $('#asociacionesDT tbody').on('click', '#alta', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            var idAsociacion = data.id; 
            var nombre = data.nombre;

            swal({
                title: 'Habilitar Asociación ?',
                text: 'La asociación ' + nombre + ' ya podrá ser editada y se le podrá asignar con nuevos establecimientos',
                input: 'textarea',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Habilitar!',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true, 
                preConfirm: function (motivo) {
                    return new Promise(function (resolve, reject) {
                        setTimeout(function() {
                            if (motivo === false) return false;
                            if (motivo === "") {
                                swal("Error al habilitar!", "No dejes campos vacíos", "error");
                                return false;
                            }    
                            $.ajax({
                                url: "{{ url('/') }}/administracion/rest/asociaciones/habilitar",
                                type: "POST",
                                data: { 
                                    id: idAsociacion,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Habilitado!','La asociación ha sido habilitada.','success')
                                    table.ajax.reload();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    swal("Error al habilitar!", "Intenta más tarde", "error");
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
        });

        
        // Handle click on checkbox
        $('#asociacionesDT tbody').on('click', '#baja', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            var idAsociacion = data.id;
            var nombre = data.nombre;

            swal({
                title: 'Deshabilitar Asociación ?',
                text: 'La asociación ' + nombre + ' ya no podrá ser editada y no se podrá asignar con nuevos establecimientos ni cadenas',
                input: 'textarea',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Deshabilitar!',
                cancelButtonText: 'No, cancelar',
                showLoaderOnConfirm: true, 
                preConfirm: function (motivo) {
                    return new Promise(function (resolve, reject) {
                        setTimeout(function() {
                            if (motivo === false) return false;
                            if (motivo === "") {
                                swal("Error al deshabilitar!", "No dejes campos vacíos", "error");
                                return false;
                            }    
                            $.ajax({
                                url: "{{ url('/') }}/administracion/rest/asociaciones/deshabilitar",
                                type: "POST", 
                                data: { 
                                    id: idAsociacion,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Deshabilitado!','La asociación ha sido deshabilitada.','success')
                                    table.ajax.reload();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    swal("Error al deshabilitar!", "Intenta más tarde", "error");
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
        });
    });




        

        function findAsociacionById( data ){

            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/asociaciones/findById/" + data.id,
                type: "GET",    
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( asociacion ) { 

                    var motivosAltaBaja =
                        '<table class="table table-striped table-bordered table-hover" id="motivosAltaBajaDT">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Contenido</th>'+
                                    '<th style="color: black;">Tipo</th>'+
                                    '<th style="color: black;">Fecha</th>'+
                                    '<th style="color: black;">Usuario responsable</th>'+
                                '</tr>'+ 
                            '</thead>'+
                            '<tbody>';

                            jQuery.each( asociacion.motivosAltaBaja , function( indice , motivoAltaBaja ) { 
                                
                                motivosAltaBaja += 
                                '<tr>' +
                                    '<td>' + motivoAltaBaja.id + '</td>' +
                                    '<td>' + motivoAltaBaja.contenido + '</td>' +
                                    '<td>' + motivoAltaBaja.tipo + '</td>' +
                                    '<td>' + motivoAltaBaja.fechaAlta.date + '</td>' +
                                    '<td>' + motivoAltaBaja.usuario + '</td>' +
                                '</tr>';

                            });
                            motivosAltaBaja += '</tbody>'+
                                        '</table>';
                    
                    var table2 = $('#motivosAltaBajaDT').DataTable(); 

                    var informacion = "";
                    informacion += 
                        "<p style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + data.nombre + 
                            "</br>" +
                            "<strong>Alias:</strong> " + data.alias +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + data.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + data.status +
                            "</br>" +
                            "<strong>Motivos de alta y baja:</strong> " + motivosAltaBaja + 
                        "</p>";

                    bootbox.dialog({
                        title: data.nombre,
                        message: informacion,
                        buttons: {
                            success: {
                                label: "Cerrar",
                                className: "btn-primary",
                                callback: function() {
                                    $('.bootbox').modal('hide');
                                }
                            }
                        }
                    });
                    swal.close();
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    swal.close();
                }
            });
        }


        function findCadenaByIdAsociacion( data ){

            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/cadenas/asociacion/" + data.id,
                type: "GET",    
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( cadenas ) { 

                    var cadenass =
                        '<table class="table table-striped table-bordered table-hover" id="cadenasDT">'+
                            '<thead>'+  
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Nombre</th>'+
                                    '<th style="color: black;">Alias</th>'+
                                    '<th style="color: black;">Numero de Negocios</th>'+
                                    '<th style="color: black;">Encargados</th>'+
                                    '<th style="color: black;">Fecha Alta</th>'+
                                    '<th style="color: black;">Status</th>'+
                                '</tr>'+ 
                            '</thead>'+
                            '<tbody>';

                            jQuery.each( cadenas , function( indice , cadena ) { 
                                
                                cadenass += 
                                '<tr>' +
                                    '<td>' + cadena.id + '</td>' +
                                    '<td>' + cadena.etiqueta + '</td>' +
                                    '<td>' + cadena.alias + '</td>' +
                                    '<td>' + cadena.numeroNegocios + '</td>' +
                                    '<td>' + cadena.encargados + '</td>' +
                                    '<td>' + cadena.fechaAlta.date + '</td>' +
                                    '<td>' + cadena.status + '</td>' +
                                '</tr>';

                            });
                            cadenass += '</tbody>'+
                                        '</table>';
                    
                    var table2 = $('#cadenasDT').DataTable(); 

                    var informacion = "";
                    informacion += 
                        "<p style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + data.nombre + 
                            "</br>" +
                            "<strong>Alias:</strong> " + data.alias +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + data.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + data.status +
                            "</br>" +
                            "<strong>Cadenas:</strong> " + cadenass + 
                        "</p>";

                    bootbox.dialog({
                        title: data.nombre,
                        message: informacion,
                        buttons: {
                            success: {
                                label: "Cerrar",
                                className: "btn-primary",
                                callback: function() {
                                    $('.bootbox').modal('hide');
                                }
                            }
                        }
                    });
                    swal.close();
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    swal.close();
                }
            });
        }
 

        function findEncargadosByIdAsociacion( data ){ 
  
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/encargados/asociacion/" + data.id,
                type: "GET",    
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                }, 
                success: function ( encargados ) { 

                    var encargadoss =
                        '<table class="table table-striped table-bordered table-hover" id="encargadosDT">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Nombre</th>'+
                                    '<th style="color: black;">Teléfono</th>'+
                                    '<th style="color: black;">Extensión</th>'+
                                    '<th style="color: black;">Celular</th>'+
                                    '<th style="color: black;">correo</th>'+
                                    '<th style="color: black;">Asociaciones</th>'+
                                    '<th style="color: black;">Cadenas</th>'+
                                    '<th style="color: black;">Negocios</th>'+
                                    '<th style="color: black;">Plazas</th>'+
                                    '<th style="color: black;">Tipo de Encargado</th>'+
                                    '<th style="color: black;">Fecha Alta</th>'+
                                    '<th style="color: black;">Status</th>'+
                                '</tr>'+ 
                            '</thead>'+
                            '<tbody>';

                            jQuery.each( encargados , function( indice , encargado ) {

                                encargadoss += 
                                '<tr>' +
                                    '<td>' + encargado.id + '</td>' +
                                    '<td>' + encargado.nombre + " " + encargado.apellidoPaterno + " " + encargado.apellidoMaterno + '</td>' +
                                    '<td>' + encargado.telefono + '</td>' +
                                    '<td>' + encargado.extension + '</td>' +
                                    '<td>' + encargado.celular + '</td>' +
                                    '<td>' + encargado.correo + '</td>' +
                                    '<td>' + encargado.asociaciones + '</td>' +
                                    '<td>' + encargado.cadenas + '</td>' +
                                    '<td>' + encargado.negocios + '</td>' +
                                    '<td>' + encargado.plazas + '</td>' +
                                    '<td>' + encargado.tipoEncargado + '</td>' +
                                    '<td>' + encargado.fechaAlta.date + '</td>' +
                                    '<td>' + encargado.status + '</td>' +
                                '</tr>';

                            });
                            encargadoss += '</tbody>'+
                                        '</table>';
                     
                    var table2 = $('#encargadosDT').DataTable(); 

                    var informacion = "";
                    informacion += 
                        "<p style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + data.nombre + 
                            "</br>" +
                            "<strong>Alias:</strong> " + data.alias +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + data.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + data.status +
                            "</br>" +
                            "<strong>Encargados:</strong> " + encargadoss + 
                        "</p>";

                    bootbox.dialog({
                        title: data.nombre,
                        message: informacion,
                        buttons: {
                            success: {
                                label: "Cerrar",
                                className: "btn-primary",
                                callback: function() {
                                    $('.bootbox').modal('hide');
                                }
                            }
                        }
                    });
                    swal.close();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal.close();
                }
            });
        }



</script>
@endsection
