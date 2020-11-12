@extends('administracion.layout.master')
@section('titulo', 'Tipo Status')
@section('dependencia', ' - Policía Preventiva - ')


@section('directorioTitle', 'Tipo Status') 
@section('directorio')
    <li class="breadcrumb-item"><a href="{{ url('/') }}/administracion/catalogo/tipostatus">Tipo Status</a></li> 
    <li class="breadcrumb-item active">Nueva</li> 
@endsection    
  
 
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

    {{ Form::open(array('url'=>'/administracion/catalogo/tipostatus','method' => 'post','id' => 'registro','role'=>'form' )) }}
        
        <!-- NOMBRE
        ================================== -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" value="{!! old('nombre') !!}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
            @if ($errors->has('nombre'))
                <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
            @endif
        </div>

        <input  type="submit" id="crear" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Crear"/>

    {{ Form::close() }} 

</div>
@endsection



@section('scripts')

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

 });
 </script>
<script>
   $(document).ready(function(){
   
   $('#registro').validate({
       rules:{ 
         nombre: {required: true,maxlength: 200},
       },
   
       messages:{
        nombre: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')},
       },
   
       submitHandler: function(form) {
         form.submit();
       } 
     });
        
   });
</script>
@endsection
