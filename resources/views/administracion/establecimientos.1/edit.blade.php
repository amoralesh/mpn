@extends('administracion.layout.master')
@section('titulo', 'Establecimientos')
@section('dependencia', ' - Policía Preventiva - ')
@section('directorioTitle', 'Editar Establecimientos')  
@section('directorio')
    <li class="breadcrumb-item ">Establecimientos</li>
    <li class="breadcrumb-item"><a href="">Lista</a></li> 
    <li class="breadcrumb-item active">Editar</li>
@endsection  
 

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">
<!-- sweetalert 2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/fileinput.css">
 
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
{{ Form::open(array('url'=>'/establecimientos/'.$establecimiento->getId(),'method'=>'PUT','id'=>'registro', 'accept-charset'=>'UTF-8', 'files'=>true , 'enctype' => 'multipart/from-data' )) }}
         
         <div class="row">
            <div class="col-sm-4 col-md-4">
               <!-- ID
                  ================================== -->
               <div class="form-group">
                  <input type="hidden" value="{{ $establecimiento->getId() }}" name="id" id="id" class="form-control" placeholder="id">
                  @if ($errors->has('id'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('id') }}</div>
                  @endif
               </div>
               <!-- NOMBRE
                  ================================== -->
               <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" value="{{ $establecimiento->getNombre() }}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                  @if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                  @endif
               </div>
               <!-- RAZON SOCIAL
                  ================================== -->
               <div class="form-group">
                  <label for="razonSocial">Razón Social</label>
                  <input type="text" value="{{ $establecimiento->getRazonSocial() }}" name="razonSocial" id="razonSocial" class="form-control" placeholder="razonSocial">
                  @if ($errors->has('razonSocial'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('razonSocial') }}</div>
                  @endif
               </div>
               <!-- CALLE PRINCIPAL
                  ================================== -->
               <div class="form-group">
                  <label for="callePrincipal">Calle Principal</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getCallePrincipal() }}" name="callePrincipal" id="callePrincipal" class="form-control" placeholder="callePrincipal">
                  @if ($errors->has('callePrincipal'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('callePrincipal') }}</div>
                  @endif
               </div>
               <!-- CALLE 1
                  ================================== -->
               <div class="form-group">
                  <label for="calleA">Calle 1</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getCalle1() }}" name="calleA" id="calleA" class="form-control" placeholder="calleA">
                  @if ($errors->has('calleA'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleA') }}</div>
                  @endif
               </div>
            </div>
            <!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-4 col-md-4">
               <!-- CALLE 2
                  ================================== -->
               <div class="form-group">
                  <label for="calleB">Calle 2</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getCalle2() }}" name="calleB" id="calleB" class="form-control" placeholder="calleB">
                  @if ($errors->has('calleB'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleB') }}</div>
                  @endif
               </div>
               <!-- NUMERO INTERIOR
                  ================================== -->
               <div class="form-group">
                  <label for="numeroInterior">Número Interior</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getNumeroInterior() }}" name="numeroInterior" id="numeroInterior" class="form-control" placeholder="numeroInterior">
                  @if ($errors->has('numeroInterior'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroInterior') }}</div>
                  @endif
               </div>
               <!-- NUMERO EXTERIOR
                  ================================== -->
               <div class="form-group">
                  <label for="numeroExterior">Número Exterior</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getNumeroExterior() }}" name="numeroExterior" id="numeroExterior" class="form-control" placeholder="numeroExterior">
                  @if ($errors->has('numeroExterior'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroExterior') }}</div>
                  @endif
               </div>
               <!-- EDIFICIO
                  ================================== -->
               <div class="form-group">
                  <label for="edificio">Edificio</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getEdificio() }}" name="edificio" id="edificio" class="form-control" placeholder="edificio">
                  @if ($errors->has('edificio'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('edificio') }}</div>
                  @endif  
               </div>
            </div>
            <!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-4 col-md-4">
               <!-- DELEGACION
                  ================================== --> 
               <div class="form-group">
                  <label for="delegacion">Delegación</label>
                  <select name="delegacion" id="delegacion" class="form-control select2">
                  @foreach($delegacionList as $delegacion)
                  <option {{( $delegacion->getId() == $establecimiento->getDireccion()->getColonia()->getDelegacion()->getId() ? "selected" : "") }} value="{{ $delegacion->getId() }} "> {{$delegacion->getEtiqueta()}} </option>
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
                  @foreach($coloniaList as $colonia)
                  <option {{(  $colonia->getId() ==  $establecimiento->getDireccion()->getColonia()->getId() ? "selected" : "") }} value="{{ $colonia->getId() }} "> {{$colonia->getEtiqueta()}} </option>
                  @endforeach
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
                  <option {{(  $tipoAsentamiento->getId() == $establecimiento->getDireccion()->getTipoAsentamiento()->getId() ? "selected" : "") }} value="{{ $tipoAsentamiento->getId() }} "> {{$tipoAsentamiento->getEtiqueta()}} </option>
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
                  <input type="text" value="{{ $establecimiento->getDireccion()->getNombreAsentamiento() }}" name="nombreAsentamiento" id="nombreAsentamiento" class="form-control" placeholder="nombreAsentamiento">
                  @if ($errors->has('nombreAsentamiento'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombreAsentamiento') }}</div>
                  @endif
               </div>

               <!-- DELEGACIÓN VIEJA 
                    ================================== -->
                    <div class="form-group">
                        <label for="delagacionVieja">DELEGACIÓN VIEJA</label>
                        <input type="text" value="{{ $establecimiento->getDelegacionDePaso() }}" name="delagacionVieja" id="delagacionVieja" class="form-control" placeholder="delagacionVieja">
                        @if ($errors->has('delagacionVieja'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('delagacionVieja') }}</div>
                        @endif
                    </div>

                     <!-- COLONIA VIEJA 
                    ================================== -->
                    <div class="form-group">
                        <label for="coloniaVieja">COLONIA VIEJA</label>
                        <input type="text" value="{{ $establecimiento->getColoniaDePaso() }}" name="coloniaVieja" id="coloniaVieja" class="form-control" placeholder="coloniaVieja">
                        @if ($errors->has('coloniaVieja'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('coloniaVieja') }}</div>
                        @endif
                    </div>
                    
            </div>
            <!-- /col-sm-6 col-md-6 -->
         </div>
         <!-- /row -->
         <div class="row">
            <div class="col-sm-6 col-md-6">
               <!-- CODIGO POSTAL
                  ================================== -->
               <div class="form-group">
                  <label for="codigoPostal">Codigo Postal</label>
                  <input type="text" value="{{ $establecimiento->getDireccion()->getCodigoPostal() }}" name="codigoPostal" id="codigoPostal" class="form-control" placeholder="codigoPostal">
                  @if ($errors->has('codigoPostal'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('codigoPostal') }}</div>
                  @endif
               </div>
               <!-- TIPO NEGOCIO
                  ================================== -->
               <div class="form-group">
                  <label for="tipoNegocio">Tipo Negocio</label>
                  <select name="tipoNegocio" id="tipoNegocio" class="form-control">
                  @foreach($tipoNegocioList as $tipoNegocio)
                  <option {{( $tipoNegocio->getid() == $establecimiento->getTipoNegocio()->getId()  ? "selected" : "") }} value="{{ $tipoNegocio->getid() }} "> {{$tipoNegocio->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('tipoNegocio'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoNegocio') }}</div>
                  @endif
               </div>
               <!--  GIRO NEGOCIO (DENUE)
                  ================================== -->
               <div class="form-group">
                  <label for="giroNegocio">Giro Negocio</label>
                  <select name="giroNegocio" id="giroNegocio" class="form-control select2">
                  @foreach($giroNegocioList as $giroNegocio)
                  <option {{ ($giroNegocio->getid() == $establecimiento->getGiroNegocio()->getId() ? "selected" : "") }} value="{{ $giroNegocio->getId() }} "> {{$giroNegocio->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('giroNegocio'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('giroNegocio') }}</div>
                  @endif
               </div>
               <!--  GIRO NEGOCIO (MÁS GENERAL)
                  ================================== -->
               <div class="form-group">
                  <label for="giroNegocioGeneral">Giro Negocio (Más general)</label>
                  <select name="giroNegocioGeneral" id="giroNegocioGeneral" onChange="mostrar(this.value);" class="form-control select2">
                  @foreach($giroNegocioGeneralList as $giroNegocioGeneral)
                  <option {{ ($giroNegocioGeneral->getid() == $establecimiento->getGiroNegocioGeneral()->getId() ? "selected" : "") }} value="{{ $giroNegocioGeneral->getId() }} "> {{$giroNegocioGeneral->getEtiqueta()}} </option>
                  @endforeach
                  </select>
                  @if ($errors->has('giroNegocioGeneral'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('giroNegocio') }}</div>
                  @endif
               </div>

        <!-- NÚMERO DE LOCALES POR MERCADO 
   ================================== -->
<div class="form-group" id="numLocalMercado" style="display: none; z-index:1;">
    <label for="numeroDeEstablecimientosMercado">Número de locales Incorporados en el mercado</label>
    <input type="text" value="{{ $establecimiento->getNumeroDeEstablecimientos() }}" name="numeroDeEstablecimientosMercado" id="numeroDeEstablecimientosMercado" maxlength="5" class="form-control" placeholder="Número Locales">
    @if ($errors->has('numeroDeEstablecimientosMercado'))
    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroDeEstablecimientosMercado') }}</div>
    @endif
 </div>
 

 <div class="box box-default"  style="display: none; z-index:1;" id="puertas" name="puertas">
    <div class="box-header with-border">
       <br>
       <h3 class="box-title"><span>Puertas del mercado</span></h3>
       <!--<br><br><br>
          <h4 class="box-title"><b><span style="color:#B31E33">&ensp;&ensp;NOTA:&ensp;&ensp;Tener cuidado en este apartado, solo en el caso de añadir dependientes económicos, por favor no olvides elegir una opción en el campo  “Parentesco”s porque si no podría ocasionar un error al guardar</span></b></h4>-->
    </div>
    <!-- /.box-header -->
    <div class="box-body" >
       <!-- TABLA DE ELEMENTOS  TOTALES EN EL SISTEMA
          ================================================-->
       <div class="row">
          <div class="col-lg-12">
             <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                   <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="tablaMercado">
                         <thead>
                            <tr>
                               <th>Puerta</th>
                               <th>Nombre</th>
                               <th>Calle Principal</th>
                               <th>Calle 1</th>
                               <th>Calle 2</th>
                               <th>Latitud</th>
                               <th>Longitud</th>
                               <th>Tipo Dispositivo</th>
                            </tr>
                         </thead>
                         <tbody>
                                @foreach( $establecimiento->getPuertaMercado() as $indice => $puertas )
                                <tr>
                                   <td>{{$indice+1}}</td>
                                 
                                   <td><input type='text' name='nombrePuertaNueva[]' value="{{$puertas->getNombre()}}" placeholder='Nombre' class='form-control' id='nombrePuertaNueva'></td>
                                   <td><input type='text' name='callePrincipalPuertaNueva[]' value="{{$puertas->getDireccion()->getCallePrincipal()}}" placeholder='Calle Principal' class='form-control' id='callePrincipalPuertaNueva'></td>
                                   <td><input type='text' name='calle1PuertaNueva[]' value="{{$puertas->getDireccion()->getCalle1()}}" placeholder='Calle 1' class='form-control' id='calle1PuertaNueva'></td>
                                   <td><input type='text' name='calle2PuertaNueva[]' value="{{$puertas->getDireccion()->getCalle2()}}" placeholder='Calle 2' class='form-control' id='calle2PuertaNueva'></td>
                                   <td><input type='text' name='latitudPuertaNueva[]' value="{{$puertas->getLatitudPuerta()}}" placeholder='Latitud' class='form-control' id='latitudPuertaNueva'></td>
                                   <td><input type='text' name='longitudPuertaNueva[]' value="{{$puertas->getLongitudPuerta()}}" placeholder='Longitud' class='form-control' id='longitudPuertaNueva'></td>
                                   
                                   <td>
                                      <div class="form-group">
                                         <select class='form-control' style='width: 100%;' name='tipoDispositivoPuertaNueva[]' id='tipoDispositivoPuertaNueva' class='form-control'>
                                        @foreach($tipoDispositivoList as $indice2 => $tipoDis)
                                         <option {{ ($tipoDis->getId() == $puertas->getDispositivos()->getTipoDispositivo()->getId() ? "selected":"") }} value="{{$tipoDis->getId()}}">{{$tipoDis->getEtiqueta()}}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                   </td>

                                   <td id="rowArresto{{$puertas->getId()}}">
                                        <i  class='fa fa-trash-o borrarFamiliar' dato="{{$puertas->getId()}}"  style='color: red;'>&nbsp;&nbsp;&nbsp;</i>
                                      </td>
                                
                                </tr>
                                @endforeach
                         </tbody>
                      </table>
                   </div>
                   <button type="button" id="agregarPuerta" name="agregarPuerta">Añadir PUERTA 
                   </button>
                </div>
                <!-- /.panel-body -->
             </div>
             <!-- /.panel -->
          </div>
          <!-- /.col-lg-12 -->
       </div>
       <!-- /TABLA -->
    </div>
    <!-- /.box-body -->
 </div>
 <!-- /.box -->
 <!-- /.content -->



               <!-- TELEFONO
                  ================================== -->
               <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" value="{{ $establecimiento->getTelefono() }}" name="telefono" id="telefono" class="form-control" placeholder="telefono">
                  @if ($errors->has('telefono'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefono') }}</div>
                  @endif
               </div>
               <!-- EXTENSION
                  ================================== -->
               <div class="form-group">
                  <label for="extension">Extensión</label>
                  <input type="text" value="{{ $establecimiento->getExtension() }}" name="extension" id="extension" class="form-control" placeholder="extension">
                  @if ($errors->has('extension'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('extension') }}</div>
                  @endif
               </div>
               <!--PLAZA
                  ================================== -->
               <div class="form-group">
                  <label for="plaza">Plaza</label>
                  <select name="plaza" id="plaza" class="form-control select2">
                     <option selected value="0">Ninguna</option>
                     @if ( $establecimiento->getPlaza() != null)
                     @foreach($plazaList as $plaza)
                     <option {{( $plaza->getid() == $establecimiento->getPlaza()->getId() ? "selected" : "") }} value="{{ $plaza->getid() }} "> {{$plaza->getEtiqueta()}} </option>
                     @endforeach
                     @else
                     @foreach($plazaList as $plaza)
                     <option value="{{ $plaza->getid() }} "> {{$plaza->getEtiqueta()}} </option>
                     @endforeach
                     @endif
                  </select>
                  @if ($errors->has('plaza'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('plaza') }}</div>
                  @endif
               </div>
               <!-- PISO
                  ================================== -->
               <div class="form-group">
                  <label for="piso">Piso</label>
                  <input type="text" value="{{ $establecimiento->getPiso() }}" name="piso" id="piso" class="form-control" placeholder="piso">
                  @if ($errors->has('piso'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('piso') }}</div>
                  @endif
               </div>

            <!-- ¿Cuenta con placa de mi POLICÍA MI NEGOCIO? -->
           <div class="form-group">
                <label  for="especifique"><b>¿Cuenta con placa MPN?</b> </label>
              <div class="input-group">
                <input type="radio" name="placaMPN" value="2" {{($establecimiento->getPlacaMPN()== 2 ? "checked='checked'" : "") }} >SI </input><br>
                <input type="radio" name="placaMPN" value="1"  {{($establecimiento->getPlacaMPN()== 1 ? "checked='checked'" : "") }} >NO </input><br>
                <input type="radio" name="placaMPN" value="0"  {{ ( $establecimiento->getPlacaMPN()== 0 ? "checked='checked'" : "") }}>NO SE SABE</input>
             </div>
           @if ($errors->has('especifique'))
                <div class="alert alert-danger">
                <strong>Cuidado! </strong> {{ $errors->first('especifique') }}
                </div>
          @endif
          </div>

            </div>


            <!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-6 col-md-6">
               <!--DISPOSITIVOS
                  ================================== -->
               <div class="form-group">
                  <label for="tipoDispositivo">Tipo de Dispositivo</label>
                  <select name="tipoDispositivo[]" id="tipoDispositivo" multiple="multiple" data-placeholder="Selecciona uno o varios dispositivos a integrar" class="form-control select2" style="color: white; background-color: rgba(0,28,58,1);">
                     @foreach($establecimiento->getDispositivos() as $dispositivo)
                     <option selected  value="{{ $dispositivo->getTipoDispositivo()->getid() }} ">{{$dispositivo->getTipoDispositivo()->getEtiqueta()}} </option>
                     @endforeach
                     @foreach($tipoDispositivoList as $tipoDispositivo)
                     <option value="{{ $tipoDispositivo->getid() }} ">{{$tipoDispositivo->getEtiqueta()}} </option>
                     @endforeach
                  </select>
                  @if ($errors->has('tipoDispositivo'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('tipoDispositivo') }}</div>
                  @endif
               </div>
               <!-- REFERENCIAS
                  ================================== -->
               <div class="form-group">
                  <div class="box-header">
                     <h3 class="box-title">Referencias del Negocio
                        <small>Breve descripción de refererencias</small>
                     </h3>
                  </div>
                  <!-- /.box-header -->
                  <textarea class="textarea" id="referencias" name="referencias" placeholder="Referencias" style="width: 100%; height: 235px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$establecimiento->getReferencia()}}</textarea>
                  @if ($errors->has('referencias'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('referencias') }}</div>
                  @endif
               </div>

               <!--CADENA  
                  ================================== -->
               <div class="form-group">
                  <label for="cadena">Cadena</label>
                  <select name="cadena" id="cadena" class="form-control select2">
                     <option selected value="0">Ninguna</option>
                     <option selected value="0">Ninguna</option>
                     @if ( $establecimiento->getCadena() != null)
                     @foreach($cadenaList as $cadena)
                     <option {{(  $cadena->getid() == $establecimiento->getCadena()->getId() ? "selected" : "") }} value="{{ $cadena->getid() }} ">{{$cadena->getEtiqueta()}} </option>
                     @endforeach
                     @else
                     @foreach($cadenaList as $cadena)
                     <option {{(  $cadena->getid() == 0 ? "selected" : "") }} value="{{ $cadena->getid() }} ">{{$cadena->getEtiqueta()}} </option>
                     @endforeach
                     @endif
                  </select>
                  @if ($errors->has('cadena'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('cadena') }}</div>
                  @endif
               </div>

              <!--STATUS REVISIÓN DEL NEGOCIO  
                  ================================== -->
                  <div class="form-group">
                  <label for="statusRev">Status del Negocio despues de la revisión</label>
                  <select name="statusRev" id="statusRev" class="form-control">
                     <option value="" selected>Selecciona una Opción</option>
                     @if ( $establecimiento->getStatusRevisionNegocio() != null)
                     @foreach($statusRevisionNegocioList as $statusRev)
                     <option {{(  $statusRev->getid() == $establecimiento->getStatusRevisionNegocio()->getId() ? "selected" : "") }} value="{{ $statusRev->getid() }} ">{{$statusRev->getEtiqueta()}} </option>
                     @endforeach
                     @else
                     @foreach($statusRevisionNegocioList as $statusRev)
                     <option {{(  $statusRev->getId() == 0 ? "selected" : "") }} value="{{ $statusRev->getid() }} ">{{$statusRev->getEtiqueta()}} </option>
                     @endforeach
                     @endif
                  </select>
                  @if ($errors->has('statusRev'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('statusRev') }}</div>
                  @endif
               </div>

               <!-- COMENTARIOS
                  ================================== -->
               <div class="form-group">
                  <div class="box-header">
                     <h3 class="box-title">Comentarios
                        <small>Comentarios sobre la actualización del establecimiento.</small>
                     </h3>
                  </div>
                  <!-- /.box-header -->
                  <textarea class="textarea" id="comentarios" name="comentarios" placeholder="Comentarios" style="width: 100%; height: 235px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$establecimiento->getComentarios()}}</textarea>
                  @if ($errors->has('comentarios'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('comentarios') }}</div>
                  @endif
               </div>
            </div>
            <!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-12 col-md-12">
               <!--ENCARGADOS
                  ================================== -->
               <div class="row">
                  <div class="col-lg-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           Lista de Encargados global
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="dataTable_wrapper">
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
                           </div>
                           <!-- /.table-responsive -->
                           <div class="well">
                              <h4>Lista de Encargados</h4>
                              <input type="text" value="{{ implode(",",$encargadosList)  }}" name="encargadosList" id="encargadosList" class="form-control" placeholder="Encargados"> 
                           </div>
                        </div>
                        <!-- /.panel-body -->
                     </div>
                     <!-- /.panel -->
                  </div>
                  <!-- /.col-lg-12 -->
               </div>
               <!-- /TABLA -->
               <!-- BUSQUEDA AL MAPA
                  ================================== -->
               <div class="form-group">
                  <label for="busqueda">Busqueda</label>
                  <input type="text" value="" name="busqueda" id="busqueda" class="form-control" placeholder="busqueda">
                  @if ($errors->has('busqueda'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('busqueda') }}</div>
                  @endif
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <input type="button" id="buscar" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Buscar"/>
                  </div>
               </div>
               <div id="map" style="position: relative; height: 200px width: 100%;"> Ver establecimiento en Mapa</div>
               <!-- LATITUD
                  ================================== -->
               <div class="form-group">
                  <label for="lat">Latitud</label>
                  <input type="text" value="{{ $establecimiento->getLatitud() }}" name="lat" id="lat" class="form-control" placeholder="lat">
                  @if ($errors->has('lat'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('lat') }}</div>
                  @endif
               </div>
               <!-- LONGITUD
                  ================================== -->
               <div class="form-group">
                  <label for="long">Longitud</label>
                  <input type="text" value="{{ $establecimiento->getLongitud() }}" name="long" id="long" class="form-control" placeholder="long">
                  @if ($errors->has('long'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('long') }}</div>
                  @endif
               </div>
            </div>
            <!-- /col-sm-6 col-md-6 -->
         </div>
         <!-- /row -->  

         <!--FORMATO PARA LA INCORPORACION MPN
            ================================== -->
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                    <label for="oficioMPN"><strong style="color: red;"> * </strong>Oficio Incorporación</label>
                    <div class="file-loading">
                       <input id="oficioMPN" name="oficioMPN" type="file" >
                    </div>
                   </div>
                </div>
                <div class="col-md-4">
                </div>
             </div>
             <!--END FORMATO PARA LA INCORPORACION MPN
                ================================== -->
         <div class="row">
            <div class="col-md-12">
               <input  type="submit" id="crear" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Actualizar"/>
            </div>
         </div>
         {{ Form::close() }}
         <!-- /.box-bdy -->
         <div class="box-footer">
            En este apartado podemos modificar a los establecimientos
         </div>
         <!-- /.box-footer-->
      </div>
      <!-- /.box -->
   </div>
</div>
@endsection
  
  

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}">
</script>
<!--DATATABLES-->
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/AutoFill-2.1.2/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/RowReorder-1.1.2/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/datatables/Select-1.2.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.min.js"></script>

<!--SELECT 2-->
<script src="{{ url('/') }}/public/assets/global/plugins/select2/dist/js/select2.min.js"></script>
<script src="{{ url('/') }}/public/js/fileinput.js" type="text/javascript" ></script>

<!--Validacion de JQuery-->
<!--Validacion de JQuery-->
<!--Validacion de JQuery-->
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

        token = $('meta[name="csrf-token"]').attr('content');

        $(".select2").select2();

        var select = $("#delegacion");

        select.on('change', function() {
            obtenerColonias(select.val());
        });

        cargarMapa();


        $('#buscar').on('click', function(e) {

            geocode($('#busqueda').val());
        });

        var usedNames = {};
            $("#tipoDispositivo > option").each(function() {
                if (usedNames[this.text]) {
                    $(this).remove();
                } else {
                    usedNames[this.text] = this.value;
                }
            });

        /* TABLA DE PERMISOS

    $("select>option").each( function(){
 var $option = $(this);  
 $option.siblings()
       .filter( function(){ return $(this).val() == $option.val() } )
       .remove()
})
    =========================================================*/
        var rows_selected = [];

        var rows_php = {{json_encode($encargadosList)}};
        //var yourArray = JSON.parse(rows_php);
        for (x = 0; x < rows_php.length; x++) {
            rows_selected.push(rows_php[x]);
        }
        document.getElementById('encargadosList').value = rows_selected;

        var tableEncargados = $('#encargadosDT').DataTable({
            responsive: true,
            "autoWidth": false,
            "deferRender": true,
            "bProcessing": true,
            "serverSide": true,
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
                "url": "{{ url('/') }}/rest/encargados",
                "type": "POST",
                "data": {
                    _token: token
                },
                "error": function(xhr, error, thrown) {
                    console.log("error")
                    tableEncargados.ajax.reload();
                }
            },
            "columns": [{
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
                    "data": "asociacioness"
                },
                {
                    "data": "cadenas"
                },
                {
                    "data": "nombreNegocio"
                },
                {
                    "data": "razonSocial"
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
        tableEncargados.on('xhr', function(e, settings, json) {
            console.log('Ajax event occurred. Returned data: ', json);
        });

        //setInterval( function () {
        // tableEncargados.ajax.reload();
        //}, 30000 );

        // Handle click on checkbox
        $('#encargadosDT tbody').on('click', 'input[type="checkbox"]', function(e) {

            var $row = $(this).closest('tr');

            // Get row data
            var data = tableEncargados.row($row).data();

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
            // console.log( tableEncargados.rows('.selected').data().length +' row(s) selected' );
            /*
            for(var i=0; i < rows_selected.lenght; i++ ){
                console.log("Ids seleccionados: " + rows_selected[i]);
            }*/

            console.log("Ids seleccionados: " + rows_selected);
            document.getElementById('encargadosList').value = rows_selected;
            //$("#altaUsuario\\:encargadosList").text(rows_selected);
            //document.getElementById('encargadosList').value= rows_selected ; 
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(tableEncargados);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // permisosDT click on table cells with checkboxes
        $('#encargadosDT').on('click', 'tbody td, thead th:last-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', tableEncargados.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#encargadosDT tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#encargadosDT tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        tableEncargados.on('draw', function() {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(tableEncargados);
        });

    }); //finalizar con function

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

    function obtenerColonias(id) {
        var dialog;
        var select = $("#colonia");
        select.empty();
        $.ajax({
            url: "{{ url('/') }}/rest/colonias/" + id,
            type: 'GET',
            dataType: "json",
            beforeSend: function() {
                dialog = bootbox.dialog({
                    message: '<p class="text-center">Cargando Colonias...</p>',
                    closeButton: false
                });
            },
            success: function(data) {
                dialog.modal('hide');
                for (i = 0; i < data.length; i++) {
                    select.append(new Option(data[i].etiqueta, data[i].id));
                }
            },
            complete: function() {
                dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                dialog.modal('hide');
                console.log(xhr);
                console.log("error");
            }
        });
    }


    var G = google.maps;
    var map;
    var marker;
    var geocoder = new G.Geocoder();


    function cargarMapa() {

        var myLatLng = {
            lat: parseFloat('{{ $establecimiento->getLatitud() }}'),
            lng: parseFloat('{{ $establecimiento->getLongitud() }}')
        };

        var mapOptions = {
            center: new G.LatLng(myLatLng),
            zoom: 17,
            mapTypeId: G.MapTypeId.ROADMAP
        };

        map = new G.Map(document.getElementById("map"), mapOptions);

        marker = new G.Marker({
            map: map,
            draggable: true,
            animation: G.Animation.DROP,
        });

        marker.setPosition(myLatLng);

        G.event.addListenerOnce(map, 'idle', function() {
            G.event.trigger(map, 'resize');
            document.getElementById('lat').value = results[0].geometry.location.lat();
            document.getElementById('long').value = results[0].geometry.location.lng();
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

<script>
    $(document).ready(function() {

        $('#registro').validate({
            rules: {

                "tipoDispositivo[]": {
                    required: true
                },

                "nombrePuerta[]": {
                    required: true,maxlength:200,
                },
                "callePrincipalPuerta[]": {
                    required: true,maxlength:200,
                },
                "calle1Puerta[]": {
                    required: true,maxlength:200,
                    
                },
                "calle2Puerta[]": {
                    required: true,maxlength:200,   
                },
                "longitudPuerta[]": {
                    required: true,number:true,   
                },
                "latitudPuerta[]": {
                    required: true,number:true,   
                },

                "tipoDispositivoPuerta[]": {
                    required: true,digits:true,   
                },




                nombre: {
                    required: true,
                    maxlength: 200
                },
                razonSocial: {
                    required: true,
                    maxlength: 200
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
                    required: true
                },
                telefono: {
                    required: true,
                    digits: true,
                    minlength: 8
                },
                extension: {
                    digits: true
                },

                lat: {
                    required: true,
                    maxlength: 200
                },
                long: {
                    required: true,
                    maxlength: 200
                },
                statusRev: {
                    required: true,
                    
                   
                },

                numeroDeEstablecimientosMercado: {
                    required: true,
                    digits: true,
                    minlength: 1,
                    maxlength: 4
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
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
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
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },
                cadena: {
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                lat: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                long: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },
                statusRev: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Elige una opción </div>')
                },

                numeroDeEstablecimientosMercado: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    digits: jQuery.validator.format('<div class="validacion">Sólo se acepta números </div>'),
                    minlength: jQuery.validator.format('<div class="validacion">El mínimo es un 1 Digito</div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 4 digitos</div>')
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

            },

            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>

<script>
        function mostrar(id) {
            if (id == 1 || id == 40) {
                $("#puertas").show();
                $("#numLocalMercado").show();
            } else {
                $("#puertas").hide();
                $("#numLocalMercado").hide();
            }
        }
        $(document).ready(function() {
            v = $('#giroNegocioGeneral').val();
            mostrar(v);
        });
</script>

    <script>
        
        rowCount1 = $('#tablaMercado >tbody >tr').length;
             var counter = rowCount1+1;
               $("#agregarPuerta").click(function() {
        
                 // Find a <table> element with id="myTable":
                 var table = document.getElementById("tablaMercado");
        
                 // Create an empty <tr> element and add it to the 1st position of the table:
                 var row = table.insertRow(-1);
                 // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                 var cell0 = row.insertCell(0);
                 var cell1 = row.insertCell(1);
                 var cell2 = row.insertCell(2);
                 var cell3 = row.insertCell(3);
                 var cell4 = row.insertCell(4);
                 var cell5 = row.insertCell(5);
                 var cell6 = row.insertCell(6);
                 var cell7 = row.insertCell(7);
                 var cell8 = row.insertCell(8);
        
        
                 cell0.innerHTML = counter ;
                 cell1.innerHTML = "<input style='text-transform:uppercase;' type='text' name='nombrePuerta[]' placeholder='Nombre' class='form-control' id='nombrePuerta'>";
                 cell2.innerHTML = "<input style='text-transform:uppercase;' type='text' name='callePrincipalPuerta[]' placeholder='Calle Principal' class='form-control' id='callePrincipalPuerta'>";
                 cell3.innerHTML = "<input style='text-transform:uppercase;' type='text' name='calle1Puerta[]' placeholder='Calle 1' class='form-control' id='calle1Puerta'>" ;
                 cell4.innerHTML = "<input style='text-transform:uppercase;' type='text' name='calle2Puerta[]' placeholder='Calle 2' class='form-control' id='calle2Puerta'>" ;
                 cell5.innerHTML = "<input type='text' name='latitudPuerta[]' placeholder='Latitud' class='form-control' id='latitudPuerta' >" ;
                 cell6.innerHTML = "<input type='text' name='longitudPuerta[]' placeholder='Longitud' class='form-control' id='longitudPuerta' >" ;
                 cell7.innerHTML = "<select class='form-control' style='width: 100%;' name='tipoDispositivoPuerta[]' id='tipoDispositivoPuerta' class='form-control'><option value='' selected> Elige una opción </option> @foreach($tipoDispositivoList as $tpdm)<option {{ (old('tipoDispositivoPuerta') == $tpdm->getid() ? 'selected':'') }} value='{{$tpdm->getId()}}'>{{$tpdm->getEtiqueta()}}</option>@endforeach</select>@if ($errors->has('tipoDispositivoPuerta'))<div class='alert alert-danger'><strong>Cuidado! </strong> {{ $errors->first('tipoDispositivoPuerta') }}</div>@endif" ;
                 cell8.innerHTML = "<td><i id='eliminarRegistro'  class='fa fa-trash-o borr' style='color: red;'>&nbsp;&nbsp;&nbsp;</i></td>";
        
        
        
        
             counter++;
             $(".borr").click(function() {
               var $row = $(this).closest('tr');
               $row.remove();
                return false;
               });
         });
        
        
        /////end
        
        function elimanarRegistro(){
        document.getElementById("tablaMercado").deleteRow(-1) ;
        return this.counter=counter-1;
        }
        
        //Borrar Familiar
        
         //     ===========================================================*/
         $('#tablaMercado tbody').on('click', '.borrarFamiliar', function(e){
              var eliminaF = $(this).attr('dato');
               var row = $('#rowArresto'+eliminaF);
               row.addClass("rowBack");
               
             console.log(eliminaF);
        
             bootbox.confirm({
                   title: "Eliminar Puerta",
                   message: '<center>'
                       + '<h3>Está  seguro que quiere eliminar esta puerta ? </h3></center>'
                       + '</br>',
                 buttons: {
                     cancel: {
                         label: '<i class="fa fa-times"></i> Cancelar'
                     },
                     confirm: {
                         label: '<i class="fa fa-check"></i> Confirmar'
                     }
                 },
                 callback: function (result) {
        
        
                     console.log('Confirmar: ' + result);
        
                     if(result){
        
                           $.ajaxSetup({
                               headers: {
                                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               }
                           });
                            
                         $.ajax({
                             url: "{{ url('/') }}/rest/Administracion/delete/generales/familiar",
                             type: 'POST',
                             data: JSON.stringify({
                             eliminaF:eliminaF
                             }),
                             contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
                             dataType: "text",
                             beforeSend: function() {
                               dialog = bootbox.dialog({
                                   message: '<p class="text-center">Eliminando...</p>',
                                   closeButton: false
                               });
                             },
                             success: function(data) {
                               console.log(data);
        
                               if(data==200){
                               
                               dialog.modal('hide');
                               location.reload();
                               row.removeClass("rowBack");
                              }
                              else{
                               dialog.modal('hide');
                               row.removeClass("rowBack");
                               console.log(data);
                              }
        
                             },
                             complete: function() {
                               dialog.modal('hide');
                             },
                             error: function (xhr, ajaxOptions, thrownError)  {
                               console.log(xhr);
                               console.log("error");
                               row.removeClass("rowBack");
                               
                             }
                           });
        
                     }
                     else{
                       
                       row.removeClass("rowBack");
                       return true;
                     }
                 }
             });
         }); 
        
        
        </script>

<script>
    
     $(document).on('ready', function() {
  
     
       $("#oficioMPN").fileinput({
         language: 'es',
         showRemove: false,
           overwriteInitial: false,
           initialPreview: [
               '{{$oficioIncorporacion}}'
           ],
           initialPreviewAsData: false, // allows you to set a raw markup
           initialPreviewConfig: [
             {type: "{{ $oficioIncorporacionMimeType }}", caption: "Curso Basico", size: 847000, key: 1}
         ],
           resizeImage: true,
           allowedFileExtensions: ['jpg', 'png', 'gif','pdf'],
           overwriteInitial: false,
           maxFileSize: 2048,
         showCaption: false,
           showUpload: false, // hide upload button
           maxFilesNum: 1,
           initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
           purifyHtml: true, // this by default purifies HTML data for preview
           //maxImageWidth: 200,
           //maxImageHeight: 200,
           initialCaption: "Curso Basico"
       });
       

     
     });
  </script>

@endsection
