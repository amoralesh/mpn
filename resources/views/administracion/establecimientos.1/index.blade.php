@extends('administracion.layout.master')
@section('titulo', 'Establecimientos')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Establecimientos')
@section('directorioTitle', 'Establecimientos') 
@section('directorio')  
    <li class="breadcrumb-item ">Establecimientos</li>
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
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: rgba(0,28,60,1);
        color: white;
    }
    .modal-dialog {
        max-width: 1500px; 
        margin: 50px auto; 
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

    <button type="button" id="crear" class="btn btn-primary">Crear nuevo establecimiento</button>
   
    <section style="margin-top:20px;">
        <table class="table table-striped table-bordered table-hover" id="negociosDT">
            <thead>
                <tr>  
                    <th>#</th>
                    <th>Código Águila</th>
                    <th>Sector</th>
                    <!--<th>Placa MPN</th>-->
                    <th>Nombre</th>
                    <th>Razón Social</th>
                    <th>Tipo de Negocio</th>
                    <th>Giro de Negocio</th>
                    <th>Giro de Negocio General</th>
                    <!--<th>Comentarios</th>-->
                    <!--<th>Plaza</th>-->
                    <!--<th>Piso</th>-->
                    <!--<th>Referencia</th>-->
                    <!--<th>Latitud</th>-->
                    <!--<th>Longitud</th>-->
                    <th>Teléfono</th>
                    <th>Extensión</th>
                    <!--<th>Número de Encargados</th>-->
                    <!--<th>Número de Usuarios Moviles</th>-->
                    <!--<th>Número de Dispositivos</th>-->
                    <th>Tipo de Status</th>
                    <th>Alarmas Emitidas</th>
                    <th>Pruebas Emitidas</th>
                    <!--<th>Número de Cadenas</th>-->
                    <!--<th>Número de Asociaciones</th>-->
                    <th>Status de Revisión</th>
                    <th>Status</th>
                    <th>Fecha de Alta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>

</div>
@endsection

      

@section('scripts')
<!-- GOOGLE -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}"></script>

<!-- DATATABLES -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>

<!-- SWEET ALERT 2-->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/sweetalert.js"></script>

<!--SELECT 2-->
<script src="{{ url('/') }}/public/assets/global/plugins/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js"></script>
 
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        listAllEstablecimientos();

        $('#negociosDT td:nth-child(11)').css('background', '#FFF');

        $('#crear').on('click', function(e) {
            document.location.href = "{{ url('/') }}/administracion/establecimientos/create";
            e.stopPropagation();
        });

    });
   

    
    function listAllEstablecimientos(){

        token = $('meta[name="csrf-token"]').attr('content');

        var table = $('#negociosDT').DataTable({

            responsive: true,
            "autoWidth": false,
            "bProcessing": true,
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
                "url": "{{ url('/') }}/administracion/rest/establecimientos",
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
                { "data": "codigoAguila" },
                { "data": "sector" },
                //{ "data": "placaMpn" },
                { "data": "nombre" },
                { "data": "razonSocial" },
                { "data": "tipoNegocio" },
                { "data": "giroNegocio" },
                { "data": "giroNegocioGeneral" },
                //{ "data": "comentarios" },
                //{ "data": "plaza" },
                //{ "data": "piso" },
                //{ "data": "referencia" },
                //{ "data": "latitud" },
                //{ "data": "longitud" },
                { "data": "telefono" },
                { "data": "extension" },
                //{ "data": "numeroEncargados" }, 
                //{ "data": "numeroUsuariosMovil" }, 
                //{ "data": "numeroDispositivos" }, 
                { "data": "tipoStatus" }, 
                { "data": "alarmasEmitidas" }, 
                { "data": "pruebasEmitidas" }, 
                //{ "data": "numeroCadenas" },
                //{ "data": "numeroAsociaciones" },
                { "data": "statusRevision" },
                { "data": "status" },
                { "data": "fechaAlta.date" },
                { "data": "id", "width": "80px" }
            ],    
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Tiene</span>' : '<span class="fa fa-close"> No Tiene</pan>';
                    },
                    "targets": 1 
                },  
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</pan>';
                    },
                    "targets": 14
                },     
                {     
                    "render": function(data, type, row) {
                        var acciones = '';   
                            acciones += '<div id="Seguimientos" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-comments-o"></i> Seguimientos</button></div>';
                            acciones += '<div id="informacion" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-info"></i> Información</button></div>';
                            acciones += '<div id="dispositivos" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-cubes"></i> Dispositivos</button></div>';
                            acciones += '<div id="asociaciones" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Asociaciones</button></div>';
                            acciones += '<div id="cadenas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Cadenas</button></div>';
                            acciones += '<div id="plazas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Plaza</button></div>';
                            acciones += '<div id="alertas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-warning"></i> Alertas</button></div>';
                            acciones += '<div id="pruebas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-warning"></i> Pruebas</button></div>';
                            acciones += '<div id="usuariosMovil" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-group"></i> Usuarios Movil</button></div>';
                            acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
                        if (row.status == true) { 
                            acciones += '<div id="baja" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-down"></i> Deshabilitar</button></div>';
                        } else {
                            acciones += '<div id="alta" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-up"></i> Habilitar</button></div>';
                        } 
                        return acciones;       


                    },
                    "targets": 16
                } 
            ],
            'rowCallback': function(row, data, dataIndex) {
                var tipoStatus = data.tipoStatus;
                if (tipoStatus == "Alerta") {
                    $(row).addClass('alert alert-danger');
                }
            }
        });


        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });
        
        $('#negociosDT tbody').on('click', '#Seguimientos', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            document.location.href = "{{ url('/') }}/administracion/seguimientos/" + data.id  
            e.stopPropagation();
        });


        $('#negociosDT tbody').on('click', '#informacion', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findEstablecimientoById( data );
            e.stopPropagation();
        });


        $('#negociosDT tbody').on('click', '#asociaciones', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findAsociacionesByIdEstablecimiento( data );  
            e.stopPropagation();
        });


        $('#negociosDT tbody').on('click', '#cadenas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findCadenasByIdEstablecimiento( data );  
            e.stopPropagation();
        });


        $('#negociosDT tbody').on('click', '#plazas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findPlazasByIdEstablecimiento( data );  
            e.stopPropagation();
        });
        

        $('#negociosDT tbody').on('click', '#puertas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findMercadoByIdEstablecimiento( data );  
            e.stopPropagation();
        });

        $('#negociosDT tbody').on('click', '#alertas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findAlertasByIdEstablecimiento( data );  
            e.stopPropagation();
        });

        $('#negociosDT tbody').on('click', '#pruebas', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findPruebasByIdEstablecimiento( data );  
            e.stopPropagation();
        });

        $('#negociosDT tbody').on('click', '#dispositivos', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            findDispositivosByIdEstablecimiento( data );  
            e.stopPropagation();
        });


        $('#negociosDT tbody').on('click', '#editar', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            document.location.href = "{{ url('/') }}/administracion/establecimientos/" + data.id + "/edit";
            e.stopPropagation();
        });

        

        $('#negociosDT tbody').on('click', '#alta', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();

            var idEstablecimiento = data.id; 
            var nombre = data.nombre;

            swal({
                title: 'Habilitar Establecimiento ?',
                text: 'El establecimiento ' + nombre + ' ya podrá ser editado y podra recibir alertas y pruebas',
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
                                url: "{{ url('/') }}/administracion/rest/establecimientos/habilitar",
                                type: "POST",
                                data: { 
                                    id: idEstablecimiento,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Habilitado!','El establecimiento ha sido habilitado.','success')
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


        $('#negociosDT tbody').on('click', '#baja', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();

            var idEstablecimiento = data.id; 
            var nombre = data.nombre;

            swal({
                title: 'Deshabilitar Establecimiento ?',
                text: 'El establecimiento ' + nombre + ' ya NO podrá ser editado NI podra recibir alertas y pruebas',
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
                                url: "{{ url('/') }}/administracion/rest/establecimientos/deshabilitar",
                                type: "POST",
                                data: { 
                                    id: idEstablecimiento,
                                    motivoAltaBaja: motivo
                                }, 
                                dataType: "html",
                                success: function () {
                                    swal('Deshabilitado!','El establecimiento ha sido deshabilitado.','success')
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

    }//LISTALLESTABLECIMEINTOS 

   
    function findEstablecimientoById( data ) {      

        $.ajax({   
                url: "{{ url('/') }}/administracion/rest/establecimientos/findById/" + data.id,
                type: "GET",    
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( negocio ) { 
                    
                    // MOTIVOS DE ALTA Y DE BAJA
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

                            jQuery.each( negocio.motivosAltaBaja , function( indice , motivoAltaBaja ) { 
                                
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
                    

                    //ENCARGADOS
                    var encargadosInfo =
                        '<table class="table table-striped table-bordered table-hover" id="encargadosInfoDT">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Nombre</th>'+
                                    '<th style="color: black;">Tipo</th>'+
                                    '<th style="color: black;">Teléfono</th>'+
                                    '<th style="color: black;">Extensión</th>'+
                                    '<th style="color: black;">Celular</th>'+
                                    '<th style="color: black;">Correo</th>'+
                                    '<th style="color: black;">Asociaciones</th>'+
                                    '<th style="color: black;">Cadenas</th>'+
                                    '<th style="color: black;">Negocios</th>'+
                                    '<th style="color: black;">Plazas</th>'+
                                    '<th style="color: black;">Fecha de alta</th>'+
                                    '<th style="color: black;">Status</th>'+
                                '</tr>'+ 
                            '</thead>'+
                            '<tbody>';

                            jQuery.each( negocio.encargados , function( indice , encargado ) { 
                                
                                encargadosInfo += 
                                '<tr>' +
                                    '<td>' + encargado.id + '</td>' +
                                    '<td>' + encargado.nombre + " " +  encargado.apellidoPaterno + " " +  encargado.apellidoMaterno + '</td>' +
                                    '<td>' + encargado.tipoEncargado + '</td>' +
                                    '<td>' + encargado.telefono + '</td>' +
                                    '<td>' + encargado.extension + '</td>' +
                                    '<td>' + encargado.celular + '</td>' +
                                    '<td>' + encargado.correo + '</td>' +
                                    '<td>' + encargado.numeroAsociaciones + '</td>' +
                                    '<td>' + encargado.numeroCadenas + '</td>' +
                                    '<td>' + encargado.numeroNegocios + '</td>' +
                                    '<td>' + encargado.numeroPlazas + '</td>' +
                                    '<td>' + encargado.fechaAlta.date + '</td>' +
                                    '<td>' + encargado.status + '</td>' +
                                '</tr>';

                            });
                            encargadosInfo += '</tbody>'+
                                        '</table>';
            
                    var table3 = $('#encargadosInfoDT').DataTable(); 
                    

                    
                    var direccionNegocio = "";
                    direccionNegocio +=  
                        "<div style='margin-left: 50px;'>"+ 
                            "<strong>Id:</strong> " + negocio.direccion.id + 
                            "</br>" +
                            "<strong>Calle Principal:</strong> " + negocio.direccion.callePrincipal + 
                            "</br>" +
                            "<strong>Calle 1:</strong> " + negocio.direccion.calle1 + 
                            "</br>" +
                            "<strong>Calle 2:</strong> " + negocio.direccion.calle2 + 
                            "</br>" +
                            "<strong>Número Interior:</strong> " + negocio.direccion.numeroInterior + 
                            "</br>" +
                            "<strong>Número Exterior:</strong> " + negocio.direccion.numeroExterior + 
                            "</br>" +
                            "<strong>Edificio:</strong> " + negocio.direccion.edificio + 
                            "</br>" +
                            "<strong>Tipo de asentamiento:</strong> " + negocio.direccion.tipoAsentamiento + 
                            "</br>" +
                            "<strong>Nombre de asentamiento:</strong> " + negocio.direccion.nombreAsentamiento + 
                            "</br>" +
                            "<strong>Colonia:</strong> " + negocio.direccion.colonia + 
                            "</br>" +
                            "<strong>Delegación:</strong> " + negocio.direccion.delegacion + 
                            "</br>" +
                            "<strong>Código Postal:</strong> " + negocio.direccion.codigoPostal + 
                            "</br>" +
                        "</div>";

                    var mitad1 = "";
                    mitad1 += 
                        "<div style='padding-left: 50px;'>"+ 
                            "<strong>Id:</strong> " + negocio.id + 
                            "</br>" +
                            "<strong>Tiene placa MPN ? :</strong> " + negocio.placaMpn + 
                            "</br>" +
                            "<strong>Nombre:</strong> " + negocio.nombre + 
                            "</br>" +
                            "<strong>Razón Social:</strong> " + negocio.razonSocial +
                            "</br>" +
                            "<strong>Dirección:</strong> " + direccionNegocio +
                            "</br>" +
                            "<strong>Tipo de Negocio:</strong> " + negocio.tipoNegocio +
                            "</br>" +
                            "<strong>Giro del Negocio:</strong> " + negocio.giroNegocio +
                            "</br>" +
                            "<strong>Giro del Negocio General:</strong> " + negocio.negocioGeneral +
                            "</br>" +
                            "<strong>Piso:</strong> " + negocio.piso +
                            "</br>" +
                            "<strong>Referencias:</strong> " + negocio.referencia +
                            "</br>" +
                            "<strong>Latitud:</strong> " + negocio.latitud +
                            "</br>" +
                            "<strong>Longitud:</strong> " + negocio.longitud +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + negocio.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + negocio.extension +
                            "</br>" +
                            "<strong>Tipo de status:</strong> " + negocio.tipoStatus +
                            "</br>" +
                            "<strong>Fecha de alta:</strong> " + negocio.fechaAlta.date +
                            "</br>" +
                            "<strong>Status de Revisión del Negocio:</strong> " + negocio.statusRevisionNegocio +
                            "</br>" +
                            "<strong>Status:</strong> " + negocio.status +
                            "</br>" +
                            "</br>" +
                            "<strong>Motivos de alta y baja:</strong> " + motivosAltaBaja + 
                        "</div>";
                        
                    var mitad2 = "";
                    mitad2 += 
                        "<div style='padding-left: 50px;'>"+ 
                            '<div id="map" style="position: relative;  width: 100%; height: 500px"> Ver establecimiento en Mapa</div>' + 
                            '</br>' + 
                            "<strong>Comentarios:</strong> " + negocio.comentarios +
                            "</br>" +
                            "<strong>Còdigo Àguila:</strong> " + negocio.codigoAguila +
                            "</br>" +
                            "<strong>Sector:</strong> " + negocio.sector +
                            "</br>" +
                        "</div>";
                        
      
                    var informacion = "";
                    informacion += 
                    '<div class="row">'+ 
                        '<div class="col-sm-6 col-md-6 col-lg-6">'+
                            mitad1 +
                        '</div>'+
                        '<div class="col-sm-6 col-md-6 col-lg-6">'+
                            mitad2 +
                        '</div>'+
                    '</div>' + 
                    
                    '<div class="row">'+ 
                        '<div class="col-sm-12 col-md-12 col-lg-12">'+

                            "<div style='padding-left: 50px;'>"+ 
                                "<strong>Encargados:</strong> " + 
                                "</br>" +
                            '</div>'+

                            encargadosInfo +
                        '</div>'+
                    '</div>';

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
                    }).init(function() {
                        cargarMapa(negocio.latitud, negocio.longitud);
                    });
                    swal.close();
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    swal.close();
                }
            });
        }       


         
        function findDispositivosByIdEstablecimiento( data )
        {   
            $.ajax({         
                  url: "{{ url('/') }}/administracion/rest/dispositivos/establecimiento/" + data.id,
                  type: "GET",       
                  dataType : 'json',   
                  beforeSend: function( xhr ) {
                      swal({ title: 'Recuperando Información' });
                      swal.showLoading();
                  },
                  success: function ( dispositivos ) { 
                      
                    var dispositivosInfo =
                        '<table class="table table-striped table-bordered table-hover" id="dispositivosDT">'+
                            '<thead>'+
                                '<tr>'+   
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Etiqueta</th>'+
                                    '<th style="color: black;">Tipo de Dispositivo</th>'+
                                    '<th style="color: black;">Token</th>'+ 
                                    '<th style="color: black;">Tipo de Status</th>'+
                                    '<th style="color: black;">Número de Actualizacion</th>'+
                                    '<th style="color: black;">status</th>'+
                                    '<th style="color: black;">Fecha de Alta</th>'+
                                '</tr>'+       
                            '</thead>'+  
                            '<tbody>';

                            
                            jQuery.each( dispositivos , function( indice , dispositivo ) { 
                                
                                dispositivosInfo +=   
                                '<tr>' +
                                    '<td>' + dispositivo.id + '</td>' +
                                    '<td>' + dispositivo.etiqueta + '</td>' +
                                    '<td>' + dispositivo.tipoDispositivo + '</td>' +
                                    '<td>' + dispositivo.token + '</td>' +
                                    '<td>' + dispositivo.tipoStatus + '</td>' +
                                    '<td>' + dispositivo.numeroActualizacion + '</td>' +
                                    '<td>' + dispositivo.status + '</td>' + 
                                    '<td>' + dispositivo.fechaAlta.date + '</td>' + 
                                '</tr>';

                            });
                            dispositivosInfo += '</tbody>'+
                                        '</table>';
                    
                    var table2 = $('#dispositivosDT').DataTable(); 
    
                      var informacion = "";
                      informacion += 
                          "<div style='padding-left: 50px;'>"+ 
                              "<strong>Nombre:</strong> " + data.nombre + 
                              "</br>" +
                              "<strong>Razón Social:</strong> " + data.razonSocial +
                              "</br>" +
                              "<strong>Teléfono:</strong> " + data.telefono +
                              "</br>" +
                              "<strong>Extensión:</strong> " + data.extension +
                              "</br>" +
                              "</br>" +
                              "<strong>Dispositivos:</strong> " + dispositivosInfo +
                          "</div>"; 
                          
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


        
        function findAsociacionesByIdEstablecimiento( data ){    
            
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/asociaciones/establecimiento/" + data.id,   
                type: "GET",      
                dataType : 'json', 
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( asociaciones ) { 
                    
                    if( asociaciones != null || asociaciones != "" ){
                        
                            var asociacionInfo =
                                '<table class="table table-striped table-bordered table-hover" id="asociacionDT">'+
                                    '<thead>'+
                                        '<tr>'+ 
                                            '<th style="color: black;">#</th>'+    
                                            '<th style="color: black;">Nombre</th>'+
                                            '<th style="color: black;">Alias</th>'+
                                            '<th style="color: black;"># Encargados</th>'+
                                            '<th style="color: black;"># Cadenas</th>'+
                                            '<th style="color: black;">Fecha</th>'+
                                            '<th style="color: black;">Status</th>'+ 
                                        '</tr>'+ 
                                    '</thead>'+
                                    '<tbody>';

                                    jQuery.each( asociaciones , function( indice , asociacion ) { 
                                        
                                        asociacionInfo += 
                                        '<tr>' +
                                            '<td>' + asociacion.id + '</td>' +
                                            '<td>' + asociacion.etiqueta + '</td>' +
                                            '<td>' + asociacion.alias + '</td>' +
                                            '<td>' + asociacion.numeroEncargados + '</td>' +
                                            '<td>' + asociacion.numeroCadenas + '</td>' +
                                            '<td>' + asociacion.fechaAlta.date + '</td>' +
                                            '<td>' + asociacion.status + '</td>' +
                                        '</tr>';

                                    });
                                    asociacionInfo += '</tbody>'+
                                                '</table>';
                            
                            var table2 = $('#asociacionDT').DataTable(); 

                            var informacion = "";
                            informacion += 
                                "<p style='padding-left: 50px;'>"+ 
                                    "<strong>Nombre:</strong> " + data.nombre + 
                                    "</br>" +
                                    "<strong>Razón Social:</strong> " + data.razonSocial +
                                    "</br>" +
                                    "<strong>Teléfono:</strong> " + data.telefono +
                                    "</br>" +
                                    "<strong>Extensión:</strong> " + data.extension +
                                    "</br>" +
                                    "</br>" +
                                    "<strong>Asociaciones:</strong> " + asociacionInfo +
                                    "</br>" +
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
                    }

                    swal.close();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal.close();
                }
            });
        }

    
    function findCadenasByIdEstablecimiento( data ){   
              
            $.ajax({   
                url: "{{ url('/') }}/administracion/rest/cadenas/establecimiento/" + data.id,
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
                            "<strong>Razón Social:</strong> " + data.razonSocial +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + data.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + data.extension +
                            "</br>" +
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
 

    function findPlazasByIdEstablecimiento( data ){   
              
            $.ajax({        
                url: "{{ url('/') }}/administracion/rest/plazas/establecimiento/" + data.id,
                type: "GET",       
                dataType : 'json',   
                beforeSend: function( xhr ) {
                    swal({ title: 'Recuperando Información' });
                    swal.showLoading();
                },
                success: function ( plaza ) { 
           
                    var plazaInfo = "Sin Plaza";
                    var direccion = "";

                    if( plaza.length != 0  ){
                        direccion += 
                            "<div style='margin-left: 50px;'>"+ 
                                "<strong>Id:</strong> " + plaza.direccion.id + 
                                "</br>" +
                                "<strong>Calle Principal:</strong> " + plaza.direccion.callePrincipal + 
                                "</br>" +
                                "<strong>Calle 1:</strong> " + plaza.direccion.calle1 + 
                                "</br>" +
                                "<strong>Calle 2:</strong> " + plaza.direccion.calle2 + 
                                "</br>" +
                                "<strong>Número Interior:</strong> " + plaza.direccion.numeroInterior + 
                                "</br>" +
                                "<strong>Número Exterior:</strong> " + plaza.direccion.numeroExterior + 
                                "</br>" +
                                "<strong>Edificio:</strong> " + plaza.direccion.edificio + 
                                "</br>" +
                                "<strong>Tipo de asentamiento:</strong> " + plaza.direccion.tipoAsentamiento + 
                                "</br>" +
                                "<strong>Nombre de asentamiento:</strong> " + plaza.direccion.nombreAsentamiento + 
                                "</br>" +
                                "<strong>Colonia:</strong> " + plaza.direccion.colonia + 
                                "</br>" +
                                "<strong>Delegación:</strong> " + plaza.direccion.delegacion + 
                                "</br>" +
                                "<strong>Código Postal:</strong> " + plaza.direccion.codigoPostal + 
                                "</br>" +
                                "</br>" +
                            "</div>"; 
            
                        
                        plazaInfo += 
                            "<div style='margin-left: 50px;'>"+ 
                                "<strong>Nombre:</strong> " + plaza.nombre + 
                                "</br>" +
                                "<strong>Alias:</strong> " + plaza.alias +
                                "</br>" +
                                "<strong>Teléfono:</strong> " + plaza.telefono +
                                "</br>" +
                                "<strong>Extensión:</strong> " + plaza.extension +
                                "</br>" +
                                "<strong>Fecha de alta:</strong> " + plaza.fechaAlta.date +
                                "</br>" +
                                "<strong>Status:</strong> " + status +
                                "</br>" +
                                "<strong>Dirección:</strong> " + direccion +
                                "</br>" +
                            "</div>"; 
            
                    }
                    var informacion = "";
                    informacion += 
                        "<div style='padding-left: 50px;'>"+ 
                            "<strong>Nombre:</strong> " + data.nombre + 
                            "</br>" +
                            "<strong>Razón Social:</strong> " + data.razonSocial +
                            "</br>" +
                            "<strong>Teléfono:</strong> " + data.telefono +
                            "</br>" +
                            "<strong>Extensión:</strong> " + data.extension +
                            "</br>" +
                            "</br>" +
                            "<strong>Plaza:</strong> " + plazaInfo +
                        "</div>"; 
                        
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

      

        function findPuertasMercadoByIdEstablecimiento( data ){
                 
              $.ajax({     
                  url: "{{ url('/') }}/administracion/rest/plazas/establecimiento/" + data.id,
                  type: "GET",       
                  dataType : 'json',   
                  beforeSend: function( xhr ) {
                      swal({ title: 'Recuperando Información' });
                      swal.showLoading();
                  },
                  success: function ( plaza ) { 
             
                      var plazaInfo = "Sin Plaza";
                      var direccion = "";
  
                      if( plaza.length != 0  ){
                          direccion += 
                              "<div style='margin-left: 50px;'>"+ 
                                  "<strong>Id:</strong> " + plaza.direccion.id + 
                                  "</br>" +
                                  "<strong>Calle Principal:</strong> " + plaza.direccion.callePrincipal + 
                                  "</br>" +
                                  "<strong>Calle 1:</strong> " + plaza.direccion.calle1 + 
                                  "</br>" +
                                  "<strong>Calle 2:</strong> " + plaza.direccion.calle2 + 
                                  "</br>" +
                                  "<strong>Número Interior:</strong> " + plaza.direccion.numeroInterior + 
                                  "</br>" +
                                  "<strong>Número Exterior:</strong> " + plaza.direccion.numeroExterior + 
                                  "</br>" +
                                  "<strong>Edificio:</strong> " + plaza.direccion.edificio + 
                                  "</br>" +
                                  "<strong>Tipo de asentamiento:</strong> " + plaza.direccion.tipoAsentamiento + 
                                  "</br>" +
                                  "<strong>Nombre de asentamiento:</strong> " + plaza.direccion.nombreAsentamiento + 
                                  "</br>" +
                                  "<strong>Colonia:</strong> " + plaza.direccion.colonia + 
                                  "</br>" +
                                  "<strong>Delegación:</strong> " + plaza.direccion.delegacion + 
                                  "</br>" +
                                  "<strong>Código Postal:</strong> " + plaza.direccion.codigoPostal + 
                                  "</br>" +
                                  "</br>" +
                              "</div>"; 
              
                          
                          plazaInfo += 
                              "<div style='margin-left: 50px;'>"+ 
                                  "<strong>Nombre:</strong> " + plaza.nombre + 
                                  "</br>" +
                                  "<strong>Alias:</strong> " + plaza.alias +
                                  "</br>" +
                                  "<strong>Teléfono:</strong> " + plaza.telefono +
                                  "</br>" +
                                  "<strong>Extensión:</strong> " + plaza.extension +
                                  "</br>" +
                                  "<strong>Fecha de alta:</strong> " + plaza.fechaAlta.date +
                                  "</br>" +
                                  "<strong>Status:</strong> " + status +
                                  "</br>" +
                                  "<strong>Dirección:</strong> " + direccion +
                                  "</br>" +
                              "</div>"; 
              
                      }
                      var informacion = "";
                      informacion += 
                          "<div style='padding-left: 50px;'>"+ 
                              "<strong>Nombre:</strong> " + data.nombre + 
                              "</br>" +
                              "<strong>Razón Social:</strong> " + data.razonSocial +
                              "</br>" +
                              "<strong>Teléfono:</strong> " + data.telefono +
                              "</br>" +
                              "<strong>Extensión:</strong> " + data.extension +
                              "</br>" +
                              "</br>" +
                              "<strong>Plaza:</strong> " + plazaInfo +
                          "</div>"; 
                          
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


        

        function findPruebasByIdEstablecimiento( data ){
            
            $.ajax({         
                  url: "{{ url('/') }}/administracion/rest/pruebas/establecimiento/" + data.id,
                  type: "GET",       
                  dataType : 'json',   
                  beforeSend: function( xhr ) {
                      swal({ title: 'Recuperando Información' });
                      swal.showLoading();
                  },
                  success: function ( pruebas ) { 
  
                    var pruebasInfo =
                        '<table class="table table-striped table-bordered table-hover" id="pruebasDt">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Cadena</th>'+
                                    '<th style="color: black;">Establecimiento</th>'+
                                    '<th style="color: black;">Fecha Prueba</th>'+ 
                                    '<th style="color: black;">Contenido</th>'+
                                    '<th style="color: black;">Zona</th>'+
                                    '<th style="color: black;">Sector</th>'+
                                    '<th style="color: black;">Dispositivo</th>'+
                                '</tr>'+       
                            '</thead>'+  
                            '<tbody>';

                            jQuery.each( pruebas , function( indice , prueba ) { 
                                
                                pruebasInfo +=   
                                '<tr>' +
                                    '<td>' + prueba.id + '</td>' +
                                    '<td>' + prueba.cadenas + '</td>' +
                                    '<td>' + prueba.negocio + '</td>' +
                                    '<td>' + prueba.fechaAlta.date + '</td>' +
                                    '<td>' + prueba.contenido + '</td>' +
                                    '<td>' + prueba.zonas + '</td>' +
                                    '<td>' + prueba.sector + '</td>' + 
                                    '<td>' + prueba.dispositivo + '</td>' + 
                                '</tr>';

                            });
                            pruebasInfo += '</tbody>'+
                                        '</table>';
                    
                    var table2 = $('#pruebasDt').DataTable(); 
    
                      var informacion = "";
                      informacion += 
                          "<div style='padding-left: 50px;'>"+ 
                              "<strong>Nombre:</strong> " + data.nombre + 
                              "</br>" +
                              "<strong>Razón Social:</strong> " + data.razonSocial +
                              "</br>" +
                              "<strong>Teléfono:</strong> " + data.telefono +
                              "</br>" +
                              "<strong>Extensión:</strong> " + data.extension +
                              "</br>" +
                              "</br>" +
                              "<strong>Pruebas:</strong> " + pruebasInfo +
                          "</div>"; 
                          
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

        function findAlertasByIdEstablecimiento( data ){
            
            $.ajax({         
                  url: "{{ url('/') }}/administracion/rest/alertas/establecimiento/" + data.id,
                  type: "GET",       
                  dataType : 'json',   
                  beforeSend: function( xhr ) {
                      swal({ title: 'Recuperando Información' });
                      swal.showLoading();
                  },
                  success: function ( alertas ) { 

                    var alertasInfo =
                        '<table class="table table-striped table-bordered table-hover" id="alertasDt">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th style="color: black;">#</th>'+    
                                    '<th style="color: black;">Cadena</th>'+
                                    '<th style="color: black;">Establecimiento</th>'+
                                    '<th style="color: black;">Fecha Alerta</th>'+ 
                                    '<th style="color: black;">Tipo de Alerta</th>'+
                                    '<th style="color: black;">Status</th>'+
                                    '<th style="color: black;">Zona</th>'+
                                    '<th style="color: black;">Sector</th>'+
                                    '<th style="color: black;">Motivo de Alarma</th>'+
                                    '<th style="color: black;">Dispositivo</th>'+
                                '</tr>'+       
                            '</thead>'+  
                            '<tbody>';
  
                            jQuery.each( alertas , function( indice , alerta ) { 
                                
                                alertasInfo +=   
                                '<tr>' +
                                    '<td>' + alerta.id + '</td>' +
                                    '<td>' + alerta.cadenas + '</td>' +
                                    '<td>' + alerta.negocio + '</td>' +
                                    '<td>' + alerta.fechaAlta.date + '</td>' +
                                    '<td>' + alerta.tipoAlarma + '</td>' +
                                    '<td>' + alerta.tipoStatus + '</td>' +
                                    '<td>' + alerta.zonas + '</td>' +
                                    '<td>' + alerta.sector + '</td>' + 
                                    '<td>' + alerta.motivoAlarma + '</td>' + 
                                    '<td>' + alerta.dispositivo + '</td>' + 
                                '</tr>';

                            });
                            alertasInfo += '</tbody>'+
                                        '</table>';
                    
                    var table2 = $('#alertasDt').DataTable(); 
    
                      var informacion = "";
                      informacion += 
                          "<div style='padding-left: 50px;'>"+ 
                              "<strong>Nombre:</strong> " + data.nombre + 
                              "</br>" +
                              "<strong>Razón Social:</strong> " + data.razonSocial +
                              "</br>" +
                              "<strong>Teléfono:</strong> " + data.telefono +
                              "</br>" +
                              "<strong>Extensión:</strong> " + data.extension +
                              "</br>" +
                              "</br>" +
                              "<strong>Alertas:</strong> " + alertasInfo +
                          "</div>"; 
                          
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


        function cargarMapa(lat, long) {

            var myLatLng = {  
                lat: lat,
                lng: long
            };

            var mapOptions = {
                center: new google.maps.LatLng(myLatLng),
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Hello World!'
            });

            google.maps.event.addListenerOnce(map, 'idle', function() {
                google.maps.event.trigger(map, 'resize');
                map.setCenter(marker.getPosition());
            });
        }

</script>


@endsection
