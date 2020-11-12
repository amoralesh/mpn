@extends('administracion.layout.master')
@section('titulo', 'Encargados')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Encargados') 
@section('directorio')
    <li class="breadcrumb-item ">Encargados</li>
@endsection 
     

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES --> 
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
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
   
    <button type="button" id="crear" class="btn btn-primary">Crear nuevo encargado</button>
    
    <section style="margin-top:20px;">
        <table class="table table-striped table-bordered table-hover" id="encargadosDT">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono Celular</th>
                    <th>Teléfono</th>
                    <th>Extensión</th>
                    <th>Tipo Encargado</th>
                    <th># Asociaciones</th>
                    <th># Cadenas</th>
                    <th># Establecimiento</th>
                    <th>Fecha Alta</th>
                    <th>Status</th>
                    <th>Accion</th>
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

        $('#crear').on('click', function(e) {
            document.location.href = "{{ url('/') }}/administracion/encargados/create";
            e.stopPropagation();
        });

        listAllEncargados();
    
    });



    function listAllEncargados(){
        
        token = $('meta[name="csrf-token"]').attr('content');

        var table = $('#encargadosDT').DataTable({
            responsive: true,
            "autoWidth": false,
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
                { "data": "correo" },
                { "data": "celular" },
                { "data": "telefono" },
                { "data": "extension" },
                { "data": "tipoEncargado" },
                { "data": "asociaciones" },
                { "data": "cadenas" },
                { "data": "establecimientos" },  
                { "data": "fechaAlta.date" },
                { "data": "status" },
                { "data": "id" }

            ],
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        return row.nombre + " " + row.apellidoPaterno + " " + row.apellidoMaterno;
                    },
                    "targets": 1
                },
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</pan>';
                    },
                    "targets": 11
                },
                {
                    "render": function(data, type, row) {
                        
                        var acciones = ''; 
                            acciones += '<div id="informacion" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-info"></i> Información</button></div>';
                            acciones += '<div id="asociaciones" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Ver Asociaciones</button></div>';
                            acciones += '<div id="cadenas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Ver Cadenas</button></div>';
                            acciones += '<div id="establecimientos" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-building"></i> Ver Establecimientos</button></div>';
                            acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
                        if (row.status == true) {
                            acciones += '<div id="baja" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-down"></i> Deshabilitar</button></div>';
                        } else {
                            acciones += '<div id="alta" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-up"></i> Habilitar</button></div>';
                        }

                        return acciones;
                    },
                    "targets": 12
                }
            ],
            'rowCallback': function(row, data, dataIndex) {

            }
        });



        /*  <div class='col-lg-12 col-md-12'> <button type='button' class='btn btn-danger' id='buttonBorrarRegistro'><i class='fa fa-trash-o fa-fw'></i> Borrar registro</button></div>*/
        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });


        $('#encargadosDT tbody').on('click', '#editar', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            var id = data.id;
            document.location.href = "{{ url('/') }}/administracion/encargados/" + id + "/edit";
            e.stopPropagation();
        });


        $('#encargadosDT tbody').on('click', '#informacion', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) { current_row = current_row.prev(); }
            var data = table.row(current_row).data();

            findEncargadoById( data );
            e.stopPropagation();
        });


        $('#encargadosDT tbody').on('click', '#asociaciones', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) { current_row = current_row.prev(); }
            var data = table.row(current_row).data();

            findAsociacionByIdEncargado( data );
            e.stopPropagation();
        });
        
        $('#encargadosDT tbody').on('click', '#cadenas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) { current_row = current_row.prev(); }
            var data = table.row(current_row).data();

            findCadenaByIdEncargado( data );
            e.stopPropagation();
        });
        
        $('#encargadosDT tbody').on('click', '#establecimientos', function(e) { 
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) { current_row = current_row.prev(); }
            var data = table.row(current_row).data(); 

            findEstablecimientoByIdEncargado( data );
            e.stopPropagation();
        });
        

        $('#encargadosDT tbody').on('click', '#alta', function(e) {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            var idEncargado = data.id; 
            var nombre = data.nombre;

            swal({ 
                title: 'Habilitar Encargado ?',
                text: 'El encargado ' + nombre + ' ya podrá ser editado y se podra usar para futuras asignaciones a entidads',
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
                                url: "{{ url('/') }}/administracion/rest/encargados/habilitar",
                                type: "POST",
                                data: { 
                                    id: idEncargado,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Habilitado!','El encargado ha sido habilitado.','success')
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


        $('#encargadosDT tbody').on('click', '#baja', function(e) {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            var idEncargado = data.id; 
            var nombre = data.nombre;

            swal({
                title: 'Deshabilitar Encargado ?',
                text: 'El encargado ' + nombre + ', ya NO podrá ser editado NI se podra usar para futuras asignaciones a entidades',
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
                                swal("Error al Deshabilitar!", "No dejes campos vacíos", "error");
                                return false;
                            }    
                            $.ajax({
                                url: "{{ url('/') }}/administracion/rest/encargados/deshabilitar",
                                type: "POST",
                                data: { 
                                    id: idEncargado,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Deshabilitado!','El encargado ha sido deshabilitado.','success')
                                    table.ajax.reload();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    swal("Error al Deshabilitar!", "Intenta más tarde", "error");
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
    }// TERMINA EL LIST ALL

  
    

        function findEncargadoById( data ){

            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/encargados/findById/" + data.id,
                type: "GET",    
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( encargado ) { 
                     
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

                            jQuery.each( encargado.motivosAltaBaja , function( indice , motivoAltaBaja ) { 
                                
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
                            "<strong>Nombre:</strong> " + encargado.nombre + 
                            "</br>" +
                            "<strong>Apellido Paterno:</strong> " + encargado.apellidoPaterno +
                            "</br>" +
                            "<strong>Apellido Materno:</strong> " + encargado.apellidoMaterno +
                            "</br>" +
                            "<strong>Correo:</strong> " + encargado.correo +
                            "</br>" +
                            "<strong>Teléfono Celular:</strong> " + encargado.celular +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + encargado.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + encargado.extension +
                            "</br>" +
                            "<strong>Tipo de Encargado:</strong> " + encargado.tipoEncargado +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + encargado.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + encargado.status +
                            "</br>" +
                            "<strong>Motivos de alta y baja:</strong> " + motivosAltaBaja + 
                        "</p>";
   
                    bootbox.dialog({
                        title: encargado.nombre + " " + encargado.apellidoPaterno + " " + encargado.apellidoMaterno ,
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


 
        function findAsociacionByIdEncargado( data ){
   
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/asociaciones/encargado/" + data.id,
                type: "GET",     
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( asociaciones ) { 

                    var asociacioness =
                        '<table class="table table-striped table-bordered table-hover" id="asociacionesDT">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Nombre</th>'+
                                    '<th style="color: black;">Alias</th>'+
                                    '<th style="color: black;">Numero de Encargados</th>'+
                                    '<th style="color: black;">Numero de Cadenas</th>'+
                                    '<th style="color: black;">Fecha Alta</th>'+
                                    '<th style="color: black;">Status</th>'+
                                '</tr>'+     
                            '</thead>'+
                            '<tbody>';

                            jQuery.each( asociaciones , function( indice , asociacion ) { 
                                
                                asociacioness +=   
                                '<tr>' +
                                    '<td>' + asociacion.id + '</td>' +
                                    '<td>' + asociacion.etiqueta + '</td>' +
                                    '<td>' + asociacion.alias + '</td>' +
                                    '<td>' + asociacion.encargados + '</td>' +
                                    '<td>' + asociacion.numeroCadenas + '</td>' +
                                    '<td>' + asociacion.fechaAlta.date + '</td>' +
                                    '<td>' + asociacion.status + '</td>' +  
                                '</tr>';

                            });
                            asociacioness += '</tbody>'+
                                        '</table>';
                    
                    var table2 = $('#asociacionesDT').DataTable(); 

                    var informacion = "";
                    informacion += 
                        "<p style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + data.nombre + 
                            "</br>" +
                            "<strong>Correo:</strong> " + data.correo +
                            "</br>" +
                            "<strong>Teléfono Celular:</strong> " + data.celular +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + data.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + data.extension +
                            "</br>" +
                            "<strong>Tipo de Encargado:</strong> " + data.tipoEncargado +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + data.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + data.status +
                            "</br>" +
                            "<strong>Asociaciones a cargo:</strong> " + asociacioness +
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

        

        function findCadenaByIdEncargado( data ){

            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/cadenas/encargado/" + data.id,
                type: "GET",     
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                }, 
                success: function ( cadenas ) { 

                    console.log( cadenas );

                    var cadenass =
                        '<table class="table table-striped table-bordered table-hover" id="cadenasDT">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Nombre</th>'+
                                    '<th style="color: black;">Alias</th>'+
                                    '<th style="color: black;">Asociación</th>'+ 
                                    '<th style="color: black;">Numero de Negocios</th>'+
                                    '<th style="color: black;">Numero de Encargados</th>'+
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
                                    '<td>' + cadena.asociacion + '</td>' +
                                    '<td>' + cadena.numeroNegocios + '</td>' +
                                    '<td>' + cadena.numeroEncargados + '</td>' +
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
                            "<strong>Correo:</strong> " + data.correo +
                            "</br>" +
                            "<strong>Teléfono Celular:</strong> " + data.celular +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + data.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + data.extension +
                            "</br>" +
                            "<strong>Tipo de Encargado:</strong> " + data.tipoEncargado +
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
    
 
        function findEstablecimientoByIdEncargado( data ){
 
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/establecimientos/encargado/" + data.id,
                type: "GET",     
                dataType : 'json',     
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( establecimientos ) { 

                    var establecimientoss =
                        '<table class="table table-striped table-bordered table-hover" id="establecimientosDT">'+
                            '<thead>'+
                                '<tr>'+ 
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Nombre</th>'+
                                    '<th style="color: black;">Dirección</th>'+ 
                                    '<th style="color: black;">Cadenas</th>'+
                                    '<th style="color: black;">Giro</th>'+
                                    '<th style="color: black;">Tipo de Negocio</th>'+
                                    '<th style="color: black;">Teléfono</th>'+
                                    '<th style="color: black;">Extensión</th>'+
                                    '<th style="color: black;">Referencias</th>'+
                                    '<th style="color: black;">Fecha Alta</th>'+  
                                    '<th style="color: black;">Status</th>'+  
                                '</tr>'+     
                            '</thead>'+
                            '<tbody>';

                            jQuery.each( establecimientos , function( indice , establecimiento ) { 
                                
                                var cadenasInfo=""
                                jQuery.each( establecimiento.cadenas , function( indice , cadena ) { 
                                    cadenasInfo += cadena.etiqueta + "<br>";
                                });
                                establecimientoss +=   
                                '<tr>' +
                                    '<td>' + establecimiento.id + '</td>' +
                                    '<td>' + establecimiento.nombre + '</td>' +
                                    '<td>' + establecimiento.direccion + '</td>' +
                                    '<td>' + cadenasInfo + '</td>' +
                                    '<td>' + establecimiento.giro + '</td>' +
                                    '<td>' + establecimiento.tipoNegocio + '</td>' +
                                    '<td>' + establecimiento.telefono + '</td>' +
                                    '<td>' + establecimiento.extension + '</td>' +
                                    '<td>' + establecimiento.referencias + '</td>' +
                                    '<td>' + establecimiento.fechaAlta.date + '</td>' +
                                    '<td>' + establecimiento.status + '</td>' + 
                                '</tr>';

                            });
                            establecimientoss += '</tbody>'+ 
                                        '</table>';
                    
                    var table2 = $('#establecimientosDT').DataTable(); 


                    var informacion = "";
                    informacion += 
                        "<p style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + data.nombre + 
                            "</br>" +
                            "<strong>Correo:</strong> " + data.correo +
                            "</br>" +
                            "<strong>Teléfono Celular:</strong> " + data.celular +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + data.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + data.extension +
                            "</br>" +
                            "<strong>Tipo de Encargado:</strong> " + data.tipoEncargado +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + data.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + data.status +
                            "</br>" +
                            "<strong>Establecimientos:</strong> " + establecimientoss +
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
