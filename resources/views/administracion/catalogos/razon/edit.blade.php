@extends('administracion.layout.master')
@section('titulo', 'Razones')
@section('dependencia', ' - Policía Preventiva - ')

@section('directorioTitle', 'Editar Razones') 
@section('directorio')
    <li class="breadcrumb-item ">Razones</li>
    <li class="breadcrumb-item"><a href="">Lista</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection  
   
  
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">

<style>
    .validacion {  
        color: red;
        font-size: large;
    }
</style>
@endsection 




@section('content') 
<div style="margin: 25px auto; width:95%;">
   <!-- Default box -->
   <div class="box">
   
      <div class="box-body">
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
         {{ Form::open(array('url'=>'/administracion/catalogo/razones/'.$razon->getId(),'method' => 'PUT','id' => 'registro','role'=>'form' )) }}
         <div class="row">
            <div class="col-sm-12 col-md-12">
               <!-- Tipo Alarma
                  ================================== -->
               <div class="form-group">
                  <label for="tipoAlarma">Tipo Alarma</label>
                  <select name="tipoAlarma" id="tipoAlarma" class="form-control select2">
                  
                  @foreach($tipoAlarmaList as $tipoAlarma)
                    <option {{(  $tipoAlarma->getid() == $razon->getTipoAlarma()->getId() ? "selected" : "") }} value="{{ $tipoAlarma->getid() }} "> {{$tipoAlarma->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('tipoAlarma'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoAlarma') }}</div>
                  @endif
               </div>
               <!-- NOMBRE
                  ================================== -->
               <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" value="{{$razon->getEtiqueta()}}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                  @if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                  @endif
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <input  type="submit" id="crear" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Actualizar"/>
            </div>
         </div>
         {{ Form::close() }}
         <!-- /.box-bdy -->
         <div class="box-footer">
            En este apartado podemos modificar cadenas
         </div>
         <!-- /.box-footer-->
      </div>
      <!-- /.box -->
   </div>
</div>
@endsection



@section('scripts')

<!-- Select2 -->
<script src="{{ url('/') }}/public/assets/global/plugins/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js"></script>

<!--Validacion de JQuery-->    <!--Validacion de JQuery-->  <!--Validacion de JQuery-->  <!--Validacion de JQuery-->
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

        $(".select2").select2();

 });
 </script>

      <script>
   $(document).ready(function(){
   
   $('#registro').validate({
       rules:{ 

         tipoAlarma: { required: true},
         nombre: {required: true,maxlength: 200},
       },
   
       messages:{
        nombre: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')},
         tipoAlarma: { required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>')},
       },
   
       submitHandler: function(form) {
         form.submit();
       } 
     });
        
   });
</script>
@endsection
