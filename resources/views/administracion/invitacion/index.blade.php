
@extends('administracion.layout.master')
@section('titulo', 'Invitación')
@section('dependencia', ' - Invitación - ')


@section('directorioTitle', 'Invitación')
@section('directorio')
    <li class="breadcrumb-item ">Invitación</li>
@endsection



@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ url('/') }}/public/assets/global/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>    
<link href="{{ url('/') }}/public/assets/global/plugins/fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>

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



    {{ Form::open(array('url'=>'/administracion/invitacion','method' => 'post','enctype' => 'multipart/form-data','id' => 'registro','role'=>'form' )) }}
           
		<div class="row">
			<div class="col-sm-6 col-md-6">
  
					<!-- NOMBRE
					================================== -->
					<div class="form-group">
					    <label for="nombre">Nombre</label>
					    <input type="text" value="{!! old('nombre') !!}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
					    @if ($errors->has('nombre'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
					    @endif
					</div>

					<!-- APELLIDO PATERNO
					================================== -->
					<div class="form-group">
					    <label for="apellidoPaterno">Apellido Paterno</label>
					    <input type="text" value="{!! old('apellidoPaterno') !!}" name="apellidoPaterno" id="apellidoPaterno" class="form-control" placeholder="apellidoPaterno">
					    @if ($errors->has('apellidoPaterno'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('apellidoPaterno') }}</div>
					    @endif
					</div>

					<!-- APELLIDO MATERNO
					================================== -->
					<div class="form-group">
					    <label for="apellidoMaterno">Apellido Materno</label>
					    <input type="text" value="{!! old('apellidoMaterno') !!}" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="apellidoMaterno">
					    @if ($errors->has('apellidoMaterno'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('apellidoMaterno') }}</div> 
					    @endif
					</div>
					    
					<!-- CORREO
					================================== -->
					<div class="form-group">
					    <label for="correo">Correo</label>
					    <input type="text" value="{!! old('correo') !!}" name="correo" id="correo" class="form-control" placeholder="correo">
					    @if ($errors->has('correo'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('correo') }}</div> 
					    @endif
					</div>

   				</div>
				   
				   <!-- /col-sm-6 col-md-6 -->

				<div class="col-sm-6 col-md-6">

					<!-- TELEFONO CELULAR
					================================== -->
					<div class="form-group">
					    <label for="telefonoCelular">Teléfono Celular</label>
					    <input type="text" value="{!! old('telefonoCelular') !!}" name="telefonoCelular" id="telefonoCelular" class="form-control" placeholder="telefonoCelular">
					    @if ($errors->has('telefonoCelular'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefonoCelular') }}</div>
					    @endif
					</div>


					<!-- TELEFONO
					================================== -->
					<div class="form-group">
					    <label for="telefono">Teléfono</label>
					    <input type="text" value="{!! old('telefono') !!}" name="telefono" id="telefono" class="form-control" placeholder="telefono">
					    @if ($errors->has('telefono'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefono') }}</div>
					    @endif
					</div>

					<!-- EXTENSION
					================================== -->
					<div class="form-group">
					    <label for="extension">Extensión</label>
					    <input type="text" value="{!! old('extension') !!}" name="extension" id="extension" class="form-control" placeholder="extension">
					    @if ($errors->has('extension'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('extension') }}</div>
					    @endif
					</div>

					 <!-- TIPO DE ENCARGADO
			        ================================== -->
					<div class="form-group">
					    <label for="tipoEncargado">Tipo de Encargado</label>
					    <select name="tipoEncargado" id="tipoEncargado" class="form-control select2">
								<option value="" selected> Elige una opción </option>
					        @foreach($tipoEncargadoList as $tipoEncargado)
					        	<option {{ (old( "tipoEncargado") == $tipoEncargado->getId() ? "selected" : "") }} value="{{ $tipoEncargado->getId() }} "> {{$tipoEncargado->getEtiqueta()}} </option>
					        @endforeach
					    </select>
					   @if ($errors->has('tipoEncargado'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoEncargado') }}</div>@endif
					</div>

   				</div><!-- /col-sm-6 col-md-6 -->
   			</div><!-- /row -->
  			
			  
			<!-- MENSAJE
            ================================== -->
            <div class="box">
                <div class="box-header">
					<h3 class="box-title">Mensaje
						<small>Modifica el texto dentro de "<[  ]>"  !</small>
					</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body pad">
					<textarea class="textarea" value="{!! old('mensajeCorreo') !!}" id="mensajeCorreo" name="mensajeCorreo" placeholder="Descripción" 
					style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					@if ($errors->has('mensajeCorreo'))
						<div class="alert alert-danger">
							<strong>Cuidado! </strong> {{ $errors->first('mensajeCorreo') }}
						</div>
					@endif
                </div>
            </div>

            <!-- DOCUMENTOS
            ================================== -->
            <div class="form-group">
                <label for="documentos">Documentos</label> 
                <input id="documentos" name="documentos[]" multiple type="file" class="file-loading">
                @if ($errors->has('documentos'))   
                    <div class="alert alert-danger">
                        <strong>Cuidado! </strong> {{ $errors->first('documentos') }}
                    </div> 
                @endif
			</div>
			

        <input  type="submit" id="crear" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Enviar"/>

    {{ Form::close() }}

</div>
@endsection



@section('scripts')

<script src="{{ url('/') }}/public/assets/global/plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/fileinput/js/locales/es.js" type="text/javascript"></script>


<!--Validacion de JQuery-->    <!--Validacion de JQuery-->  <!--Validacion de JQuery-->  <!--Validacion de JQuery-->
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/localization/messages_es.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/additional-methods.js"></script>

<script type="text/javascript">

$(document).ready(function() {

	/* IMAGENES  */
	$("#documentos").fileinput({ 
		language: 'es',
		overwriteInitial: false,
		maxFileSize: 1000,
		showCaption: false,
		showUpload: false, // hide upload button
		maxFilesNum: 3,
		fileActionSettings: { 
			showRemove: true,
			browseIcon: '<i class="fa fa-trash"></i>', 
			removeIcon: '<i class="fa fa-trash"></i>',
			uploadIcon: '<i class="fa fa-trash"></i>',
			zoomIcon  : '<i class="fa fa-search"></i>'
		},
		previewZoomButtonIcons: {
			prev: '<i class="fa fa-angle-left"></i>',
			next: '<i class="fa fa-angle-right"></i>',
			toggleheader: '<i class="fa fa-compress"></i>',
			fullscreen: '<i class="fa fa-expand"></i>',
			borderless: '<i class="fa fa-arrows-alt"></i>',
			close: '<i class="fa fa-close"></i>'
		},
		allowedFileExtensions: ['jpg', 'png', 'gif'],
		overwriteInitial: false,
		purifyHtml: true
	});
	

});
</script>

 <script>
   $(document).ready(function(){
   
   $('#registro').validate({
       rules:{ 

         nombre: {required: true,maxlength: 200},
		 apellidoPaterno: {required: true,maxlength: 200},
		 apellidoMaterno: {required: true,maxlength: 200},
		 correo: {required: true,email: true},
		 telefonoCelular: {required: true,digits: true,minlength: 8},
		 telefono: {required: true,digits: true,minlength: 8},
		 extension: {digits: true},
		 tipoEncargado: {required: true},
		 mensajeCorreo: {required: true,maxlength: 500}

       },
       messages:{
    
        nombre: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')},
		apellidoPaterno: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')},
		apellidoMaterno: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')},
		correo: {required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),email: jQuery.validator.format('<div class="validacion">Por favor introduzca un correo válido"</div>')},
		telefono: {required: jQuery.validator.format('<div style="color:red"; class="validacion">El campo es requerido </div>'),digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>'),minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 8 digitos</div>')},
		extension: {digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>')},
		tipoEncargado: {required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'), digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')},
		telefonoCelular: {required: jQuery.validator.format('<div style="color:red"; class="validacion">El campo es requerido </div>'),digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>'),minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 8 digitos</div>')},
		mensajeCorreo: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 500 caracteres</div>')},
      
       },
   
       submitHandler: function(form) {
         form.submit();
       } 
     });
        
   });
   
</script>

@endsection
