@extends('administracion.layout.master')
@section('titulo', 'Tipo Encargado')
@section('dependencia', ' - Policía Preventiva - ')
 

@section('directorioTitle', 'Tipo Encargado') 
@section('directorio')
    <li class="breadcrumb-item ">Tipo Encargado</li>
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
   
    <button type="button" id="crear" class="btn btn-primary">Crear nuevo tipo de encargado</button>
    
    <section style="margin-top:20px;"> 
        <table class="table table-striped table-bordered table-hover" id="TipoEncargadoDT">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo Encargado</th>
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
		
		$('#crear').on('click', function(e){
			document.location.href = "{{ url('/') }}/administracion/catalogo/tipoencargado/create";
			e.stopPropagation();
		});

		listAllTipoEncargado();

 	});

	function listAllTipoEncargado(){
		
		var table = $('#TipoEncargadoDT').DataTable({

			            responsive: true,
			            "autoWidth": false,
			            "deferRender": true,
			            "bProcessing": true,
         				   //"serverSide": true,
			            //autoFill: true,
						"language": {
							"decimal":        "",
		    				"emptyTable":     "No hay datos disponibles en la tabla",
		            		"info": 		  "Mostrando pagina _PAGE_ de _PAGES_",
		   			 		"infoEmpty":      "Mostrando 0 de 0 de 0 registros",
		    				"infoFiltered":   "(Filtrados de _MAX_ registros totales)",
		    				"infoPostFix":    "",
		    				"thousands":      ",",
		            		"lengthMenu":     "Mostrar _MENU_ registros por pagina",
		   			 		"loadingRecords": "Cargando...",
		    				"processing":     "Procesando...",
		    				"search":         "Buscar: ",
		    				"zeroRecords":    "No se encontraron registros que coincidan",
		    				"paginate": {
		       			 		"first":      "Primera pagina",
		        				"last":       "Ultima Pagina",
		        				"next":       "Siguiente",
		        				"previous":   "Anterior"
		   				 	},
		    				"aria": {
		        				"sortAscending":  ": Activar para mostrar en acendencia",
		       			 		"sortDescending": ": Activar para mostrar en descendencia"
		    				}
						},
						"processing" : true,
						"ajax"   :  {
		    				"url"  : "{{ url('/') }}/administracion/rest/catalogo/tipoencargado",
		    				"type" : "GET",
								"dataSrc": "",
		      				"error" : function (xhr, error, thrown) {
		      					console.log("error")
		      					table.ajax.reload();
							}
		  				},
						"columns": [
		            			{ "data": "id" },
		            			{ "data": "etiqueta" },
		            			{ "data": "id" }
		    	        ],
		       			"columnDefs":
			       			[
								{
									"render": function (data, type, row) {
										var acciones = ''; 
											acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
										return acciones;
									},
									"targets": 2
								}
		       		   		]
		        });

 
				table.on( 'xhr', function ( e, settings, json ) {
				   	console.log( 'Ajax event occurred. Returned data: ', json );
				});


				$('#TipoEncargadoDT tbody').on('click', '#editar', function(e){

					var current_row = $(this).parents('tr');
				    if (current_row.hasClass('child')) { current_row = current_row.prev(); }
    				var data = table.row(current_row).data();

					var id = data.id;

					document.location.href = "{{ url('/') }}/administracion/catalogo/tipoencargado/" + id + "/edit";
					e.stopPropagation();
				});
	}

 </script>
@endsection
