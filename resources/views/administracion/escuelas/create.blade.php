@extends('administracion.layout.master')
@section('titulo', 'Escuela Nueva')
@section('dependencia', ' - Policía Preventiva - ')
@section('directorioTitle', 'Escuela Nueva') 



@section('directorioTitle', 'Escuela Nueva')
@section('directorio')
    <li class="breadcrumb-item ">Escuela</li>
    <li class="breadcrumb-item active">Nueva</li>
@endsection
 

       
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- sweetalert 2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">
<!-- FILE INPUT -->
<link href="{{ url('/') }}/public/assets/global/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>    
<link href="{{ url('/') }}/public/assets/global/plugins/fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
<style>  
   #map{
        width: 100%; height: 500px;
   }
   #map > div  {
        width: 100%; height: 100%;
   }
   .validacion {  
        color: red;
        font-size: large;
   }
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: rgba(0,28,60,1);
        color: white;
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
        {{ Form::open(array('url'=>'/administracion/escuelas','method' => 'POST','enctype' => 'multipart/form-data','id' => 'registro','role'=>'form' )) }}
        <div class="row">
           <!-- ================================== FILA 1 ================================== -->
           <div class="col-sm-4 col-md-4">
              <!-- NOMBRE  
                 ================================== -->
              <div class="form-group">
                 <label for="nombre">Nombre</label>
                 <input type="text" value="{!! old('nombre') !!}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                 @if ($errors->has('nombre'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                 @endif
              </div>
              <!-- RAZON SOCIAL
                 ================================== -->
              <div class="form-group">
                 <label for="razonSocial">Razón Social</label>
                 <input type="text" value="{!! old('razonSocial') !!}" name="razonSocial" id="razonSocial" class="form-control" placeholder="Razón social">
                 @if ($errors->has('razonSocial'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('razonSocial') }}</div>
                 @endif
              </div>
              <!-- CALLE PRINCIPAL
                 ================================== -->
              <div class="form-group">
                 <label for="callePrincipal">Calle Principal</label>
                 <input type="text" value="{!! old('callePrincipal') !!}" name="callePrincipal" id="callePrincipal" class="form-control" placeholder="Calle Principal">
                 @if ($errors->has('callePrincipal'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('callePrincipal') }}</div>
                 @endif
              </div>
              <!-- CALLE 1
                 ================================== -->
              <div class="form-group">
                 <label for="calleA">Calle 1</label>
                 <input type="text" value="{!! old('calleA') !!}" name="calleA" id="calleA" class="form-control" placeholder="Calle 1">
                 @if ($errors->has('calleA'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleA') }}</div>
                 @endif
              </div>
           </div>
           <!-- ================================== FILA 2 ================================== -->
           <div class="col-sm-4 col-md-4">
              <!-- CALLE 2
                 ================================== -->
              <div class="form-group">
                 <label for="calleB">Calle 2</label>
                 <input type="text" value="{!! old('calleB') !!}" name="calleB" id="calleB" class="form-control" placeholder="Calle 2">
                 @if ($errors->has('calleB'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleB') }}</div>
                 @endif
              </div>
              <!-- NUMERO INTERIOR
                 ================================== -->
              <div class="form-group">
                 <label for="numeroInterior">Número Interior</label>
                 <input type="text" value="{!! old('numeroInterior') !!}" name="numeroInterior" id="numeroInterior" class="form-control" placeholder="Número Interior">
                 @if ($errors->has('numeroInterior'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroInterior') }}</div>
                 @endif
              </div>
              <!-- NUMERO EXTERIOR
                 ================================== -->
              <div class="form-group">
                 <label for="numeroExterior">Número Exterior</label>
                 <input type="text" value="{!! old('numeroExterior') !!}" name="numeroExterior" id="numeroExterior" class="form-control" placeholder="Número Exterior">
                 @if ($errors->has('numeroExterior'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroExterior') }}</div>
                 @endif
              </div>
              <!-- EDIFICIO
                 ================================== -->
              <div class="form-group">
                 <label for="edificio">Edificio</label>
                 <input type="text" value="{!! old('edificio') !!}" name="edificio" id="edificio" class="form-control" placeholder="Edificio">
                 @if ($errors->has('edificio'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('edificio') }}</div>
                 @endif
              </div>
           </div>
           <!-- ================================== FILA 3 ================================== -->
           <div class="col-sm-4 col-md-4">
              <!-- DELEGACION
                 ================================== -->
              <div class="form-group">
                 <label for="delegacion">Delegación</label>
                 <select name="delegacion" id="delegacion" class="form-control select2">
                    <option value="" selected> Elige una opción </option>
                    @foreach($delegacionList as $delegacion)
                    <option {{ (old( "delegacion") == $delegacion->getid() ? "selected" : "") }} value="{{ $delegacion->getid() }} "> {{$delegacion->getEtiqueta()}} </option>
                    @endforeach
                 </select>
                 @if ($errors->has('delegacion'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('delegacion') }}</div>
                 @endif
              </div>
              <!-- COLONIA
                 ================================== -->
              <div class="form-group">
                 <label for="colonia">Colonia</label>
                 <select name="colonia" id="colonia" class="form-control select2">
                 {{-- @foreach($coloniaList as $colonia)
                 <option {{ (old( "colonia") == $colonia->getid() ? "selected" : "") }} value="{{ $colonia->getid() }} "> {{$colonia->getEtiqueta()}} </option>
                 @endforeach --}}
                 </select>
                 @if ($errors->has('colonia'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('colonia') }}</div>
                 @endif
              </div>
              <!-- TIPO DE ASENTAMIENTO 
                 ================================== -->
              <div class="form-group">
                 <label for="tipoAsentamiento">Tipo de Asentamiento</label>
                 <select name="tipoAsentamiento" id="tipoAsentamiento" class="form-control">
                 @foreach($tipoAsentamientoList as $tipoAsentamiento)
                 <option {{ (old( "tipoAsentamiento") == $tipoAsentamiento->getid() ? "selected" : "") }} value="{{ $tipoAsentamiento->getid() }} "> {{$tipoAsentamiento->getEtiqueta()}} </option>
                 @endforeach
                 </select>
                 @if ($errors->has('tipoAsentamiento'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoAsentamiento') }}</div>
                 @endif  
              </div>
              <!-- NOMBRE ASENTAMIENTO
                 ================================== -->
              <div class="form-group">
                 <label for="nombreAsentamiento">Nombre del Asentamiento</label>
                 <input type="text" value="{!! old('nombreAsentamiento') !!}" name="nombreAsentamiento" id="nombreAsentamiento" class="form-control" placeholder="Nombre del Asentamiento">
                 @if ($errors->has('nombreAsentamiento'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombreAsentamiento') }}</div>
                 @endif
              </div>
           </div>
           <!-- /FILA -->
        </div>
        <!-- /row -->
        <div class="row">
           <div class="col-sm-6 col-md-6">
              <!-- CODIGO POSTAL
                 ================================== -->
              <div class="form-group">
                 <label for="codigoPostal">Codigo Postal</label>
                 <input type="text" value="{!! old('codigoPostal') !!}" name="codigoPostal" id="codigoPostal" maxlength="5" class="form-control" placeholder="Codigo Postal">
                 @if ($errors->has('codigoPostal'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('codigoPostal') }}</div>
                 @endif
              </div>
              <!-- TELEFONO
                 ================================== -->
              <div class="form-group">
                 <label for="telefono">Teléfono</label>
                 <input type="text" value="{!! old('telefono') !!}" name="telefono" id="telefono" class="form-control" placeholder="telefono">
                 @if ($errors->has('telefono'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefono') }}</div>
                 @endif
              </div>
              <!-- EXTENSION
                 ================================== -->
              <div class="form-group">
                 <label for="extension">Extensión</label>
                 <input type="text" value="{!! old('extension') !!}" name="extension" id="extension" class="form-control" placeholder="extension">
                 @if ($errors->has('extension'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('extension') }}</div>
                 @endif
              </div>
              <!--PLAZA
                 ================================== -->
              <div class="form-group">
                 <label for="plaza">Plaza</label>
                 <select name="plaza" id="plaza" class="form-control select2">
                    <option value="" selected> Elige una opción </option>
                    @foreach($plazaList as $plaza)
                    <option {{ (old( "plaza") == $plaza->getid() ? "selected" : "") }} value="{{ $plaza->getid() }} "> {{$plaza->getEtiqueta()}} </option>
                    @endforeach
                 </select>
                 @if ($errors->has('plaza'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('plaza') }}</div>
                 @endif
              </div>
              <br><br><br><br><br><br>
              <!-- ASOCIACIONES
                 ================================== -->
              <section >
                 <h4>Asociaciones</h4>
                 <table class="table table-striped table-bordered table-hover" id="asociacionesDT">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Alias</th>
                          <th><input name="select_all" type="checkbox" value="1"/> Todos</th>
                       </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                 </table>
                 <input type="text" value="{!! old('asociacionesList') !!}" name="asociacionesList" id="asociacionesList" class="form-control" placeholder="Asociaciones">
              </section>
              <br><br>
              <!-- CADENAS
                 ================================== -->
              <section >
                 <h4>Cadenas</h4>
                 <table class="table table-striped table-bordered table-hover" id="cadenasDT">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Alias</th>
                          <th>Asociaciones</th>
                          <th><input name="select_all" type="checkbox" value="1"/> Todos</th>
                       </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                 </table>
                 <input type="text" value="{!! old('cadenasList') !!}" name="cadenasList" id="cadenasList" class="form-control" placeholder="Cadenas">
              </section>
           </div>
           <!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 -->
           <!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 -->
           <div class="col-sm-6 col-md-6">
              <!-- PISO
                 ================================== -->
              <div class="form-group">
                 <label for="piso">Piso</label>
                 <input type="text" value="{!! old('piso') !!}" name="piso" id="piso" class="form-control" placeholder="Piso">
                 @if ($errors->has('piso'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('piso') }}</div>
                 @endif
              </div>
         
              <!-- TIPO NEGOCIO
                 ================================== -->
              <div class="form-group">
                 <label for="tipoNegocio">Tipo Negocio</label>
                 <select name="tipoNegocio" id="tipoNegocio" class="form-control select2">
                 @foreach($tipoNegocioList as $tipoNegocio)
                 <option {{ (16 == $tipoNegocio->getid() ? "selected" : "") }} value="{{ $tipoNegocio->getid() }} "> {{$tipoNegocio->getEtiqueta()}} </option>
                 @endforeach
                 </select>
                 @if ($errors->has('tipoNegocio'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoNegocio') }}</div>
                 @endif
              </div>
              <!-- GIRO NEGOCIO (DENUE)
                 ================================== -->
              <div class="form-group">
                 <label for="giroNegocio">Giro Negocio</label>
                 <select name="giroNegocio" id="giroNegocio" class="form-control select2">
                    <option value="" selected> Elige una opción </option>
                    @foreach($giroNegocioList as $giroNegocio)
                    <option {{ (old( "giroNegocio") == $giroNegocio->getId() ? "selected" : "") }} value="{{ $giroNegocio->getId() }} "> {{$giroNegocio->getEtiqueta()}} </option>
                    @endforeach
                 </select>
                 @if ($errors->has('giroNegocio'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('giroNegocio') }}</div>
                 @endif
              </div>
              <!-- GIRO NEGOCIO (MÁS GENERAL)
                 ================================== -->
              <div class="form-group">
                 <label for="giroNegocioGeneral">Giro Negocio (Más general)</label>
                 <select name="giroNegocioGeneral" id="giroNegocioGeneral" onChange="mostrar(this.value);" class="form-control select2">
                 @foreach($giroNegocioGeneralList as $giroNegocioGeneral)
                 <option {{ (2 == $giroNegocioGeneral->getId() ? "selected" : "") }} value="{{ $giroNegocioGeneral->getId() }} "> {{$giroNegocioGeneral->getEtiqueta()}} </option>
                 @endforeach
                 </select>
                 @if ($errors->has('giroNegocioGeneral'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('giroNegocio') }}</div>
                 @endif
              </div>

 <div class="row">
   <div class="col-sm-6 col-md-6">
      <!-- CUENTA CON PLACA DE MI POLICÍA MI NEGOCIO? -->
      <div class="form-group">
         <label  for="placaMPN"> ¿Cuenta con placa MPN? </label>
         <div class="radio-vertical">
            <div class="radio-button"> 
               <input value="2" id="radio-button1" name="placaMPN" type="radio" >
               <label for="radio-button1"></label>
               <span>SI</span>
            </div>
            <div class="radio-button">
               <input value="1" id="radio-button2" name="placaMPN" type="radio">
               <label for="radio-button2"></label>
               <span>NO</span>
            </div>
            <div class="radio-button">
               <input value="0" id="radio-button3" name="placaMPN" type="radio" checked="">
               <label for="radio-button3"></label>
               <span>NO SE SABE</span>
            </div>
         </div>
         @if ($errors->has('especifique'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('placaMPN') }}
         </div>
         @endif
      </div>
   </div>
   <div class="col-sm-6 col-md-6">
      <!-- ¿CUENTA CON OFICIO? -->
      <div class="form-group">
         <label  for="cuentaConOficio"> ¿Cuenta con Oficio? </label>
         <div class="radio-vertical">
            <div class="radio-button">
               <input value="1" id="radio-button4" name="cuentaConOficio" type="radio">
               <label for="radio-button4"></label>
               <span>SI</span>
            </div>
            <div class="radio-button">
               <input value="0" id="radio-button5" name="cuentaConOficio" type="radio" checked="">
               <label for="radio-button5"></label>
               <span>NO</span>
            </div>
         </div>
         @if ($errors->has('especifique'))
         <div class="alert alert-danger">
            <strong>Cuidado! </strong> {{ $errors->first('cuentaConOficio') }}
         </div>
         @endif
      </div>
   </div>
</div>



              <!-- DIPOSITIVO
                 ================================== -->
              <section style="margin-top:20px;  z-index:1;" id="dispo" name="dispo">
                 <br> <br>
                 <h3 class="box-title"><span>Dispositivos de la escuela</span></h3>
                 <table class="table table-striped table-bordered table-hover" id="dispositivos" name="dispositivos" >
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Dispositivo</th>
                          <th>Cantidad</th>
                       </tr>
                    </thead>
                    <tbody>
                       @foreach($tipoDispositivoList as $i => $tpd) 
                       <tr>
                          <td><input name="idTipoDispositivo[]" id="idTipoDispositivo" value="{{$tpd->getId()}}" ></td>
                          <td><input name="tipoDispositivo[]" id="tipoDispositivo" value="{{$tpd->getEtiqueta()}}" ></td>
                          <td><input type="text" name="cantidad[]" id="cantidad[]" ></td>
                       </tr>
                       @endforeach
                    </tbody>
                 </table>
              </section>
              <br><br><br>
              <!-- REFERENCIAS
                 ================================== -->
              <div class="form-group">
                 <div class="box-header">
                    <h3 class="box-title">Referencias del Negocio
                       <small>Breve descripción de referencias</small>   
                    </h3>
                 </div>
                 <!-- /.box-header -->
                 <textarea class="textarea" id="referencias" name="referencias" placeholder="Referencias" style="width: 100%; height: 235px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('referencias') }}</textarea>
                 @if ($errors->has('referencias'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('referencias') }}</div>
                 @endif
              </div>
              <br><br><br>
              <!-- COMENTARIOS
                 ================================== -->
              <div class="form-group">
                 <div class="box-header">
                    <h3 class="box-title">Comentarios
                       <small>Comentarios sobre la actualización del establecimiento.</small>
                    </h3>
                 </div>
                 <!-- /.box-header -->
                 <textarea class="textarea" id="comentarios" name="comentarios" placeholder="Comentarios" style="width: 100%; height: 235px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('comentarios') }}</textarea>
                 @if ($errors->has('comentarios'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('comentarios') }}</div>
                 @endif
              </div>
           </div>
           <!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 -->
        </div>
        <!-- /row --><!-- /row --><!-- /row --><!-- /row -->
        </br>     
        </br>   <br>
        <h4>Mapa</h4>
        <div class="row">
           <div class="col-sm-4 col-md-4">
              <!-- BUSQUEDA AL MAPA
                 ================================== -->
              <div class="form-group">
                 <label for="busqueda">Busqueda</label>
                 <input type="text" value="" name="busqueda" id="busqueda" class="form-control" placeholder="busqueda">
                 @if ($errors->has('busqueda'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('busqueda') }}</div>
                 @endif
              </div>
              <!-- LATITUD
                 ================================== -->
              <div class="form-group">
                 <label for="lat">Latitud</label>
                 <input type="text" value="{!! old('lat') !!}" name="lat" id="lat" class="form-control" placeholder="lat">
                 @if ($errors->has('lat'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('lat') }}</div>
                 @endif
              </div>
              <!-- LONGITUD
                 ================================== -->
              <div class="form-group">
                 <label for="long">Longitud</label>
                 <input type="text" value="{!! old('long') !!}" name="long" id="long" class="form-control" placeholder="long">
                 @if ($errors->has('long'))
                 <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('long') }}</div>
                 @endif
              </div>
              <input type="button" id="buscar" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Buscar"/>
           </div>
           <!-- /col-sm-6 col-md-6 -->
           <div class="col-sm-8 col-md-8">
              <div id="map" style="position: relative; height: 400px width: 100%;"> Ver establecimiento en Mapa</div>
           </div>
           <!-- /col-sm-6 col-md-6 -->
        </div>
        <!-- /row -->
        </br> 
        </br> 
        <!--ENCARGADOS
           ================================== -->
        <section >
           <h4>Encargados</h4>
           <table class="table table-striped table-bordered table-hover" id="encargadosDT">
              <thead>
                 <tr>
                    <th>#</th>
                    <th>correo</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Teléfono Celular</th>
                    <th>Asociaciones</th>
                    <th>Cadenas</th>
                    <th>Establecimiento</th>
                    <th><input name="select_all" type="checkbox" value="1"/> Todos</th>
                 </tr>
              </thead>
              <tbody> 
              </tbody>
           </table>
           <input type="text" value="{!! old('encargadosList') !!}" name="encargadosList" id="encargadosList" class="form-control" placeholder="Encargados">
        </section>
        </br> 
        </br>
        <!--FORMATO PARA LA INCORPORACION MPN
           ================================== -->
        <div class="row">
           <div class="col-md-4">
              <label for="oficioMPN">Oficio Incorporación</label>
              <div class="file-loading">
                 <input id="oficioMPN" name="oficioMPN" type="file" >
              </div>
           </div>
           <div class="col-md-4">
              <label for="comprobanteDomicilio">Comprobante de domicilio</label>
              <div class="file-loading">
                 <input id="comprobanteDomicilio" name="comprobanteDomicilio" type="file" >
              </div>
           </div>
           <div class="col-md-4">
              <label for="comprobanteFiscal">Comprobante Fiscal</label>
              <div class="file-loading">
                 <input id="comprobanteFiscal" name="comprobanteFiscal" type="file" >
              </div>
           </div>
        </div>
        <br>
        <br>
        <br>
        <input  type="submit" id="crear" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Crear"/>
        {{ Form::close() }}
     </div>
@endsection


@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}"></script>
<!--DATATABLES-->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>

<!--SELECT 2-->
<script src="{{ url('/') }}/public/assets/global/plugins/select2/dist/js/select2.min.js"></script>

<!--Validacion de JQuery-->
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/localization/messages_es.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/additional-methods.js"></script>

<!-- FILE INPUT -->
<script src="{{ url('/') }}/public/assets/global/plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/fileinput/js/locales/es.js" type="text/javascript"></script>

<!-- SWEET ALERT -->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- BOOTBOX -->
<script src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js" type="text/javascript"></script>

<script>
    $(document).on('ready', function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        /* DELEGACION ON CHANGE
        ======================================================================================================= */
        var select = $("#delegacion");
        select.on('change', function() {
            obtenerColoniasByDelegacion(select.val());
        });

        listAllEncargados();
        listAllAsociaciones();
        listAllCadenas();

        /* MAPA
        ======================================================================================================= */
        cargarMapa();

        /* BUSQUEDA EN EL MAPA ON CLICK
        ======================================================================================================= */
        $('#buscar').on('click', function(e) {
            
            var calle             = $('#callePrincipal').val();
            var delegacion        = $("#delegacion :selected").text(); // The text content of the selected option
            var colonia           = $("#colonia :selected").text();
            var numeroExterior    = $('#numeroExterior').val();

            $('#busqueda').val(calle+" "+numeroExterior+" "+colonia+" "+delegacion);
      


            if( $('#busqueda').val() != null || $('#busqueda').val() != "" ){
                geocode($('#busqueda').val());
            }
        });


        /* SELECT 2 
        ======================================================================================================= */
        $(".select2").select2();


        /* AL SELECCIONAR EL GIRO NEGOCIO GENERAL MUESTRA LA PUERTAS DEL MERCADO
        ======================================================================================================= */
        v = $('#giroNegocioGeneral').val();
        mostrar(v);

        /* OFICIO 
        ======================================================================================================= */
        $("#oficioMPN").fileinput({
            language: 'es',
            showRemove: false,
            maxFileSize: 1000,
            showCaption: false,
            showUpload: false, // hide upload button
            maxFilesNum: 1,
            fileActionSettings: {
                browseIcon: '<i class="fa fa-trash"></i>',
                removeIcon: '',
                uploadIcon: '<i class="fa fa-trash"></i>',
                zoomIcon: '<i class="fa fa-search"></i>',
            },
            previewZoomButtonIcons: {
                prev: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                toggleheader: '<i class="fa  fa-compress"></i>',
                fullscreen: '<i class="fa fa-expand"></i>',
                borderless: '<i class="fa fa-arrows-alt"></i>',
                close: '<i class="fa fa-close"></i>'
            },
            resizeImage: true,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
            overwriteInitial: false,
            purifyHtml: true
        });

        /* COMPROBANTE DE DOMICILIO 
        ======================================================================================================= */
        $("#comprobanteDomicilio").fileinput({
            language: 'es',
            showRemove: false,
            maxFileSize: 1000,
            showCaption: false,
            showUpload: false, // hide upload button
            maxFilesNum: 1,
            fileActionSettings: {
                browseIcon: '<i class="fa fa-trash"></i>',
                removeIcon: '',
                uploadIcon: '<i class="fa fa-trash"></i>',
                zoomIcon: '<i class="fa fa-search"></i>',
            },
            previewZoomButtonIcons: {
                prev: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                toggleheader: '<i class="fa  fa-compress"></i>',
                fullscreen: '<i class="fa fa-expand"></i>',
                borderless: '<i class="fa fa-arrows-alt"></i>',
                close: '<i class="fa fa-close"></i>'
            },
            resizeImage: true,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
            overwriteInitial: false,
            purifyHtml: true
        });


        /* COMPROBANTE FISCAL
        ======================================================================================================= */
        $("#comprobanteFiscal").fileinput({
            language: 'es',
            showRemove: false,
            maxFileSize: 1000,
            showCaption: false,
            showUpload: false, // hide upload button
            maxFilesNum: 1,
            fileActionSettings: {
                browseIcon: '<i class="fa fa-trash"></i>',
                removeIcon: '',
                uploadIcon: '<i class="fa fa-trash"></i>',
                zoomIcon: '<i class="fa fa-search"></i>',
            },
            previewZoomButtonIcons: {
                prev: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                toggleheader: '<i class="fa  fa-compress"></i>',
                fullscreen: '<i class="fa fa-expand"></i>',
                borderless: '<i class="fa fa-arrows-alt"></i>',
                close: '<i class="fa fa-close"></i>'
            },
            resizeImage: true,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
            overwriteInitial: false,
            purifyHtml: true
        });



    }); // TERMINA  $(document).on('ready', function() {

    function listAllAsociaciones() {

        var rows_selected = [];

        var table = $('#asociacionesDT').DataTable({
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
                "url": "{{ url('/') }}/administracion/rest/asociaciones/escuelas",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    table.ajax.reload();
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "alias"
                },
                {
                    "data": "id"
                }
            ],
            "columnDefs": [{
                "render": function(data, type, row) {
                    return '<input type="checkbox">';
                },
                "targets": 3
            }],
            'rowCallback': function(row, data, dataIndex) {
                var rowId = data.id;
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });


        // Handle click on checkbox
        $('#asociacionesDT tbody').on('click', 'input[type="checkbox"]', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();
            var rowId = data.id;
            var index = $.inArray(rowId, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(rowId);
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }
            if (this.checked) {
                current_row.addClass('selected');
            } else {
                current_row.removeClass('selected');
            }
            console.log("Ids seleccionados: " + rows_selected);
            document.getElementById('asociacionesList').value = rows_selected;
            updateDataTableSelectAllCtrl(table);
            e.stopPropagation();
        });

        $('#asociacionesDT').on('click', 'tbody td, thead th:last-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#asociacionesDT tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#asociacionesDT tbody input[type="checkbox"]:checked').trigger('click');
            }
            e.stopPropagation();
        });

        table.on('draw', function() {
            updateDataTableSelectAllCtrl(table);
        });

    }

    function listAllCadenas() {

        var rows_selected = [];
        var table = $('#cadenasDT').DataTable({
            responsive: true,
            "autoWidth": false,
            "deferRender": true,
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
                "url": "{{ url('/') }}/administracion/rest/cadenas",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    table.ajax.reload();
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "alias"
                },
                {
                    "data": "asociacion"
                },
                {
                    "data": "id"
                }
            ],
            "columnDefs": [{
                "render": function(data, type, row) {
                    return '<input type="checkbox">';
                },
                "targets": 4
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


        $('#cadenasDT tbody').on('click', 'input[type="checkbox"]', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();

            var rowId = data.id;

            var index = $.inArray(rowId, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(rowId);
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                current_row.addClass('selected');
            } else {
                current_row.removeClass('selected');
            }

            console.log("Ids seleccionados: " + rows_selected);
            document.getElementById('cadenasList').value = rows_selected;
            updateDataTableSelectAllCtrl(table);
            e.stopPropagation();
        });
        // permisosDT click on table cells with checkboxes
        $('#cadenasDT').on('click', 'tbody td, thead th:last-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });
        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#cadenasDT tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#cadenasDT tbody input[type="checkbox"]:checked').trigger('click');
            }
            e.stopPropagation();
        });

        table.on('draw', function() {
            updateDataTableSelectAllCtrl(table);
        });

    }

    function listAllEncargados() {

        /* TABLA DE PERMISOS
          =========================================================*/
        var rows_selected = [];
        var table = $('#encargadosDT').DataTable({
            responsive: true,
            "autoWidth": false,
            "deferRender": true,
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
                "error": function(xhr, error, thrown) {
                    console.log("error")
                    table.ajax.reload();
                }
            },
            "columns": [

                {
                    "data": "id"
                },
                {
                    "data": "correo"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "telefono"
                },
                {
                    "data": "celular"
                },
                {
                    "data": "asociaciones"
                },
                {
                    "data": "cadenas"
                },
                {
                    "data": "establecimientos"
                },
                {
                    "data": "id"
                }
            ],
            "columnDefs": [{
                    "render": function(data, type, row) {
                        return '<input type="checkbox">';
                    },
                    "targets": 8
                },
                {
                    "render": function(data, type, row) {
                        return row.nombre + " " + row.apellidoPaterno + " " + row.apellidoMaterno;
                    },
                    "targets": 2
                }
            ],
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
        table.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });

        //setInterval( function () {
        // table.ajax.reload();
        //}, 30000 );

        // Handle click on checkbox
        $('#encargadosDT tbody').on('click', 'input[type="checkbox"]', function(e) {
            var current_row = $(this).parents('tr');
            if (current_row.hasClass('child')) {
                current_row = current_row.prev();
            }
            var data = table.row(current_row).data();

            var rowId = data.id;

            var index = $.inArray(rowId, rows_selected);
            if (this.checked && index === -1) {
                rows_selected.push(rowId);
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                current_row.addClass('selected');
            } else {
                current_row.removeClass('selected');
            }
            // console.log( table.rows('.selected').data().length +' row(s) selected' );
            /*
            for(var i=0; i < rows_selected.lenght; i++ ){
                console.log("Ids seleccionados: " + rows_selected[i]);
            }*/

            console.log("Ids seleccionados: " + rows_selected);
            document.getElementById('encargadosList').value = rows_selected;
            //$("#altaUsuario\\:encargadosList").text(rows_selected);
            //document.getElementById('encargadosList').value= rows_selected ; 
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // permisosDT click on table cells with checkboxes
        $('#encargadosDT').on('click', 'tbody td, thead th:last-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#encargadosDT tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#encargadosDT tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        table.on('draw', function() {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });
    }
</script>

<!-- FUNCIONES POR SEPARADO 
=======================================================================================================================-->
<script>
    /* MUESTRA LAS PUERTAS SI EL NEGOCIO ES UN MERCADO
        ================================================================================= */
    function mostrar(id) {
        if (id == 1 || id == 40) {
            $("#puertas").show();
            $("#numLocalMercado").show();
        } else {
            $("#puertas").hide();
            $("#numLocalMercado").hide();
        }
    }

    /* ACTUALIZA LA TABLA ENCARGADOS
    ================================================================================= */
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

    /* OBTIENE LAS COLONIAS MEDIANTE UN ID
    ================================================================================= */
    function obtenerColoniasByDelegacion(id) {
        var dialog;
        var select = $("#colonia");
        select.empty();
        $.ajax({
            url: "{{ url('/') }}/administracion/rest/catalogo/colonias/delegacion/" + id,
            type: 'GET',
            dataType: "json",
            beforeSend: function() {
                swal({
                    title: 'Recuperando Información'
                });
                swal.showLoading();
            },
            success: function(data) {
                swal.close();
                for (i = 0; i < data.length; i++) {
                    select.append(new Option(data[i].etiqueta, data[i].id));
                }
            },
            complete: function() {
                swal.close();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                swal.close();
                console.log(xhr);
                console.log("error");
            }
        });
    }


    /* INICIA EL MAPA
    ================================================================================= */
    var G = google.maps;
    var map;
    var marker;
    var geocoder = new G.Geocoder();

    function cargarMapa() {
        var myLatLng = {
            lat: 19.424398,
            lng: -99.163611
        };
        var mapOptions = {
            center: new G.LatLng(myLatLng),
            zoom: 17,
            mapTypeId: G.MapTypeId.ROADMAP
        };
        map = new G.Map(document.getElementById("map"), mapOptions);
        G.event.addListenerOnce(map, 'idle', function() {
            G.event.trigger(map, 'resize');
        });
        marker = new G.Marker({
            map: map,
            draggable: true,
            animation: G.Animation.DROP,
        });
        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
    }

    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('long').value = event.latLng.lng();
    }

    function geocode(address) {
        geocoder.geocode({
            'address': (address ? address : "Secretaría de Seguridad Pública")
        }, function(results, status) {
            if (status == G.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                document.getElementById('lat').value = results[0].geometry.location.lat();
                document.getElementById('long').value = results[0].geometry.location.lng();
            } else {
                alert("No se pudo encontrar el lugar: " + status);
            }
        });
    }
</script>

<!-- MERCADO 
================================================================================================ -->
<script>
    rowCount1 = $('#tablaMercado > tbody >tr').length;
    var counter = rowCount1 + 1;

    $("#agregarPuerta").click(function() {
        var table = document.getElementById("tablaMercado");
        var row = table.insertRow(-1);
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        var cell4 = row.insertCell(4);
        var cell5 = row.insertCell(5);
        var cell6 = row.insertCell(6);
        var cell7 = row.insertCell(7);
        var cell8 = row.insertCell(8);

        cell0.innerHTML = counter;
        cell1.innerHTML = "<input style='text-transform:uppercase;' type='text' name='nombrePuerta[]' placeholder='Nombre' class='form-control' id='nombrePuerta'>";
        cell2.innerHTML = "<input style='text-transform:uppercase;' type='text' name='callePrincipalPuerta[]' placeholder='Calle Principal' class='form-control' id='callePrincipalPuerta'>";
        cell3.innerHTML = "<input style='text-transform:uppercase;' type='text' name='calle1Puerta[]' placeholder='Calle 1' class='form-control' id='calle1Puerta'>";
        cell4.innerHTML = "<input style='text-transform:uppercase;' type='text' name='calle2Puerta[]' placeholder='Calle 2' class='form-control' id='calle2Puerta'>";
        cell5.innerHTML = "<input type='text' name='latitudPuerta[]' placeholder='Latitud' class='form-control' id='latitudPuerta' >";
        cell6.innerHTML = "<input type='text' name='longitudPuerta[]' placeholder='Longitud' class='form-control' id='longitudPuerta' >";
        cell7.innerHTML = "<select class='form-control' style='width: 100%;' name='tipoDispositivoPuerta[]' id='tipoDispositivoPuerta' class='form-control'><option value='' selected> Elige una opción </option> @foreach($tipoDispositivoList as $tpdm)<option {{ (old('tipoDispositivoPuerta') == $tpdm->getid() ? 'selected':'') }} value='{{$tpdm->getId()}}'>{{$tpdm->getEtiqueta()}}</option>@endforeach</select>@if ($errors->has('tipoDispositivoPuerta'))<div class='alert alert-danger'><strong>Cuidado! </strong> {{ $errors->first('tipoDispositivoPuerta') }}</div>@endif";
        cell8.innerHTML = "<td><i id='eliminarRegistro' class='fa fa-trash-o borr' style='color: red;'>&nbsp;&nbsp;&nbsp;</i></td>";

        counter++;

        $(".borr").click(function() {
            var $row = $(this).closest('tr');
            $row.remove();
            return false;
        });

    });
</script>

<script>
    $(document).ready(function() {

        $('#registro').validate({
            rules: {

                "tipoDispositivo[]": {
                    required: true
                },

                "nombrePuerta[]": {
                    required: true,
                    maxlength: 200,
                },

                "callePrincipalPuerta[]": {
                    required: true,
                    maxlength: 200,
                },

                "calle1Puerta[]": {
                    required: true,
                    maxlength: 200,
                },

                "calle2Puerta[]": {
                    required: true,
                    maxlength: 200,
                },

                "longitudPuerta[]": {
                    required: true,
                    number: true,
                },

                "latitudPuerta[]": {
                    required: true,
                    number: true,
                },

                "tipoDispositivoPuerta[]": {
                    required: true,
                    digits: true,
                },

                nombre: {
                    required: true,
                    maxlength: 200
                },

                razonSocial: {
                    required: true,
                    maxlength: 200
                },

                referencias: {
                    required: true,
                },

                callePrincipal: {
                    required: true,
                    maxlength: 200
                },

                calleA: {
                    required: true,
                    maxlength: 200
                },

                calleB: {
                    required: true,
                    maxlength: 200
                },

                numeroInterior: {
                    required: true,
                    maxlength: 200
                },

                numeroExterior: {
                    required: true,
                    maxlength: 200
                },

                edificio: {
                    maxlength: 200
                },

                delegacion: {
                    required: true
                },

                colonia: {
                    required: true
                },

                tipoAsentamiento: {
                    required: true
                },

                nombreAsentamiento: {
                    required: true,
                    maxlength: 200
                },

                codigoPostal: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 5
                },

                tipoNegocio: {
                    required: true
                },

                giroNegocio: {
                    required: true
                },

                giroNegocioGeneral: {
                    required: true,
                    maxlength: 200
                },

                telefono: {
                    required: true,
                    digits: true,
                    minlength: 8
                },

                extension: {
                    digits: true
                },

                cadena: {
                    required: true,
                },

                plaza: {
                    required: true,
                },

                lat: {
                    required: true,
                    maxlength: 200
                },

                long: {
                    required: true,
                    maxlength: 200
                },

                piso: {
                    maxlength: 3
                },

                numeroDeEstablecimientosMercado: {
                    required: true,
                    digits: true,
                    minlength: 1,
                    maxlength: 4
                },

                placaMPN: {
                    required: true
                },

                cuentaConOficio: {
                    required: true
                },

                "cantidad[]": {
                    required: true,
                    digits: true,
                    minlength: 1,
                    maxlength: 2
                },

                oficioMPN: {
                    required: true,
                    extension: 'png|jpeg|jpg|pdf'
                },

            },
            messages: {
                nombre: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                razonSocial: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                referencias: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>')
                },

                callePrincipal: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                calleA: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                calleB: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                numeroInterior: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                numeroExterior: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                delegacion: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                colonia: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                tipoAsentamiento: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                nombreAsentamiento: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                codigoPostal: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo se acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 5 Digitos</div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 5 digitos</div>')
                },

                tipoNegocio: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                giroNegocio: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                giroNegocioGeneral: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                telefono: {
                    required: jQuery.validator.format('<div style="color:red"; class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 8 digitos</div>')
                },

                extension: {
                    digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>')
                },

                plaza: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción</div>')
                },

                cadena: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción</div>')
                },

                lat: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                long: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },



                piso: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 3 caracteres</div>')
                },

                numeroDeEstablecimientosMercado: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo se acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo es un 1 Digito</div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 4 digitos</div>')
                },

                placaMPN: {
                    required: jQuery.validator.format('<div class="validacion">Elige una opción</div>')
                },

                cuentaConOficio: {
                    required: jQuery.validator.format('<div class="validacion">Elige una opción</div>')
                },

                oficioMPN: {
                    required: jQuery.validator.format('<div style="color:red"; class="validacion">El campo es requerido </div>')
                },

                "tipoDispositivo[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>')
                },

                "nombrePuerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                "callePrincipalPuerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                "calle1Puerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                "calle2Puerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                "longitudPuerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    number: jQuery.validator.format('<div class="validacion">Sólo se acepta números y decimales</div>'),
                },

                "latitudPuerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    number: jQuery.validator.format('<div class="validacion">Sólo se acepta números y decimales</div>'),
                },

                "tipoDispositivoPuerta[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>')
                },

                "cantidad[]": {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo se acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo es un 1 Digito</div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 4 digitos</div>')
                },



            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

@endsection