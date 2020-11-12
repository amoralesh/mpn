
@extends('administracion.layout.master')
@section('titulo', 'Plazas')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Plazas') 
@section('directorio')
    <li class="breadcrumb-item ">Plazas</li>
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
   
    <button type="button" id="crear" class="btn btn-primary">Crear nueva plaza</button>
    
    <section style="margin-top:20px;">
        <table class="table table-striped table-bordered table-hover" id="plazasDT">
            <thead>
                <tr>
                    <th>#</th>
                    <th>fecha alta</th>
                    <th>Nombre</th>
                    <th>Alias</th>
                    <th>Teléfono</th>
                    <th>Extension</th>
                    <th># Encargados</th>
                    <th># Negocios</th>
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

        $('#crear').on('click', function(e) {
            document.location.href = "{{ url('/') }}/administracion/plazas/create";
            e.stopPropagation();
        });

        listAllPlazas();
    
    });


    function listAllPlazas(){
        
        token = $('meta[name="csrf-token"]').attr('content');
        var table = $('#plazasDT').DataTable({

            responsive: true,
            "autoWidth": false,
            "deferRender": true,
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
                "url": "{{ url('/') }}/administracion/rest/plazas",
                "type": "POST",   
                "data": {
                    _token: token
                },
                "error": function(xhr, error, thrown) {
                    console.log("error")
                    table.ajax.reload();
                }
            },
            "columns": [ 
                { "data": "id" },
                { "data": "fechaAlta.date" },
                { "data": "etiqueta" },
                { "data": "alias" },
                { "data": "telefono" },
                { "data": "extension" }, 
                { "data": "numeroEncargados" }, 
                { "data": "numeroNegocios" },  
                { "data": "status" },
                { "data": "id" } 
            ],
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        var acciones = ''; 
                         if (row.status == true) {
                            acciones += 'Activo';
                        } else {
                            acciones += 'No Activo';
                        }
                        return acciones;
                    },
                    "targets":8
                },
                {
                    "render": function(data, type, row) {
                        var acciones = ''; 
                            acciones += '<div id="informacion" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-info"></i> Información</button></div>';
                            acciones += '<div id="encargados" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-group"></i> Ver Encargados</button></div>';
                            acciones += '<div id="establecimientos" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-building"></i> Ver Establecimientos</button></div>';
                            acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
                        if (row.status == true) {
                            acciones += '<div id="baja" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-down"></i> Deshabilitar</button></div>';
                        } else {
                            acciones += '<div id="alta" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-up"></i> Habilitar</button></div>';
                        }

                        return acciones;
                    },
                    "targets": 9
                }
            ]
        });


        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });


        $('#plazasDT tbody').on('click', '#informacion', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();

            findPlazaById( data );
            e.stopPropagation();
        });
    
        $('#plazasDT tbody').on('click', '#editar', function(e) {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            var id = data.id;
            document.location.href = "{{ url('/') }}/administracion/plazas/" + id + "/edit";
            e.stopPropagation();
        });

    
        $('#plazasDT tbody').on('click', '#encargados', function(e) {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            findEncargadosByIdPlaza( data ); 

            e.stopPropagation();
        });

    
        $('#plazasDT tbody').on('click', '#establecimientos', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findEstablecimientosByIdPlaza( data ); 
            e.stopPropagation();
        });

        
        $('#plazasDT tbody').on('click', '#alta', function(e) {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            var idPlaza = data.id; 
            var nombre = data.nombre;

            swal({
                title: 'Habilitar plaza ?',
                text: 'La plaza ' + nombre + ' ya podrá ser editada y se podra usar para futuras asignaciones a entidades',
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
                                url: "{{ url('/') }}/administracion/rest/plazas/habilitar",
                                type: "POST", 
                                data: { 
                                    id: idPlaza,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Habilitado!','La plaza ha sido habilitada.','success')
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


        $('#plazasDT tbody').on('click', '#baja', function(e) {

            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            
            var idPlaza = data.id; 
            var nombre = data.nombre;

            swal({
                title: 'Deshabilitar plaza ?',
                text: 'La plaza ' + nombre + ' ya NO podrá ser editada NI se podra usar para futuras asignaciones a entidades',
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
                                url: "{{ url('/') }}/administracion/rest/plazas/deshabilitar",
                                type: "POST",
                                data: { 
                                    id: idPlaza,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Deshabilitada!','La plaza ha sido deshabilitada.','success')
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
    }// FIN LIST ALL   

  
        function findPlazaById( data ){

            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/plazas/findById/" + data.id,
                type: "GET",      
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },   
                success: function ( plaza ) { 

                    console.log( plaza );
                     
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

                            jQuery.each( plaza.motivosAltaBaja , function( indice , motivoAltaBaja ) { 
                                
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

                    
                    var direccion = "";
                    direccion += "<p style='padding-left: 50px;'> " +
                            "<strong>Calle Principal: </strong> " + plaza.direccion.callePrincipal +
                            "</br>" +
                            "<strong>Calle 1: </strong> " + plaza.direccion.calle1 +
                            "</br>" +
                            "<strong>Calle 2: </strong> " + plaza.direccion.calle2 +
                            "</br>" +
                            "<strong>Número Interior: </strong> " + plaza.direccion.numeroInterior +
                            "</br>" +
                            "<strong>Número Exterior: </strong> " + plaza.direccion.numeroExterior +
                            "</br>" +
                            "<strong>Edificio: </strong> " + plaza.direccion.edificio +
                            "</br>" +
                            "<strong>Tipo de Asentamiento: </strong> " + plaza.direccion.tipoAsentamiento +
                            "</br>" +
                            "<strong>Nombre del Asentamiento: </strong> " + plaza.direccion.nombreAsentamiento +
                            "</br>" +
                            "<strong>Colonia: </strong> " + plaza.direccion.colonia +
                            "</br>" +
                            "<strong>Codigo Postal: </strong> " + plaza.direccion.codigoPostal +
                        "</p>"; 

                    var informacion = "";
                    informacion += 
                        "<div style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + plaza.etiqueta + 
                            "</br>" +
                            "<strong>Alias:</strong> " + plaza.alias +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + plaza.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + plaza.extension +
                            "</br>" + 
                            "<strong>Dirección</strong> " + direccion +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + plaza.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + plaza.status +
                            "</br>" +
                            "</br>" +
                            "<strong>Motivos de alta y baja:</strong> " + motivosAltaBaja + 
                        "</div>";

                    bootbox.dialog({
                        title: plaza.etiqueta ,
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

        function findEstablecimientosByIdPlaza( data ){ 
        
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/establecimientos/plaza/" + data.id,
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
        
        function findEncargadosByIdPlaza( data ){ 
    
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/encargados/plaza/" + data.id,
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
                            "<strong>Nombre:</strong> " + data.etiqueta + 
                            "</br>" +
                            "<strong>Alias:</strong> " + data.alias +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + data.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + data.extension +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + data.fechaAlta.date +
                            "</br>" +
                            "<strong>Status:</strong> " + data.status +
                            "</br>" +
                            "<strong>Encargados:</strong> " + encargadoss + 
                        "</p>"; 

                    bootbox.dialog({
                        title: data.etiqueta,
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
