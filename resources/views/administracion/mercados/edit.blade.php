@extends('administracion.layout.master')
@section('titulo', 'Mercado Editar')
@section('dependencia', ' - Policía Preventiva - ')
@section('directorioTitle', 'Mercado Editar') 



@section('directorioTitle', 'Mercado Editar')
@section('directorio')
    <li class="breadcrumb-item ">Mercado</li>
    <li class="breadcrumb-item active">Editar</li>
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

    {{ Form::open(array('url'=>'/administracion/mercados/' . $negocio->getId(),'method' => 'PUT','enctype' => 'multipart/form-data','id' => 'registro','role'=>'form' )) }}
           
        <div class="row">
        
            <!-- ================================== FILA 1 ================================== -->
            <div class="col-sm-4 col-md-4">

                <!-- NOMBRE  
                    ================================== -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" value="{{ $negocio->getNombre() }}" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    @if ($errors->has('nombre'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                    @endif
                </div>

                <!-- RAZON SOCIAL
                    ================================== -->
                <div class="form-group">
                    <label for="razonSocial">Razón Social</label>
                    <input type="text" value="{{ $negocio->getRazonSocial() }}" name="razonSocial" id="razonSocial" class="form-control" placeholder="Razón social">
                    @if ($errors->has('razonSocial'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('razonSocial') }}</div>
                    @endif
                </div>

                <!-- CALLE PRINCIPAL
                    ================================== -->
                <div class="form-group">
                    <label for="callePrincipal">Calle Principal</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getCallePrincipal() }}" name="callePrincipal" id="callePrincipal" class="form-control" placeholder="Calle Principal">
                    @if ($errors->has('callePrincipal'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('callePrincipal') }}</div>
                    @endif
                </div>

                <!-- CALLE 1
                    ================================== -->
                <div class="form-group">
                    <label for="calleA">Calle 1</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getCalle1() }}" name="calleA" id="calleA" class="form-control" placeholder="Calle 1">
                    @if ($errors->has('calleA'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleA') }}</div>
                    @endif
                </div>

                  <!-- CALLE 2
                ================================== -->
                <div class="form-group">
                    <label for="calleB">Calle 2</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getCalle2() }}" name="calleB" id="calleB" class="form-control" placeholder="Calle 2">
                    @if ($errors->has('calleB'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('calleB') }}</div>
                    @endif
                </div> 

            </div>

            <!-- ================================== FILA 2 ================================== -->
            <div class="col-sm-4 col-md-4">

              

                <!-- NUMERO INTERIOR
                ================================== -->
                <div class="form-group">
                    <label for="numeroInterior">Número Interior</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getNumeroInterior() }}" name="numeroInterior" id="numeroInterior" class="form-control" placeholder="Número Interior">
                    @if ($errors->has('numeroInterior'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroInterior') }}</div>
                    @endif
                </div>
   
                <!-- NUMERO EXTERIOR
                ================================== -->
                <div class="form-group">
                    <label for="numeroExterior">Número Exterior</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getNumeroExterior() }}" name="numeroExterior" id="numeroExterior" class="form-control" placeholder="Número Exterior">
                    @if ($errors->has('numeroExterior'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('numeroExterior') }}</div>
                    @endif
                </div>
 
                <!-- EDIFICIO
                ================================== -->
                <div class="form-group">
                    <label for="edificio">Edificio</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getEdificio() }}" name="edificio" id="edificio" class="form-control" placeholder="Edificio">
                    @if ($errors->has('edificio'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('edificio') }}</div>
                    @endif
                </div>

                   <!-- DELEGACION
                ================================== -->
                <div class="form-group">
                    <label for="delegacion">Delegación</label>
                    <select name="delegacion" id="delegacion" class="form-control select2">
                    @foreach($delegacionList as $delegacion)
                    <option {{ ( $negocio->getDireccion()->getColonia()->getDelegacion()->getId() == $delegacion->getId() ? "selected" : "") }} value="{{ $delegacion->getId() }} "> {{$delegacion->getEtiqueta()}} </option>
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
                    <option {{ ( $negocio->getDireccion()->getColonia()->getId() == $colonia->getId() ? "selected" : "") }} value="{{ $colonia->getId() }} "> {{$colonia->getEtiqueta()}} </option>
                    @endforeach 
                    </select>
                    @if ($errors->has('colonia'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('colonia') }}</div>
                    @endif
                </div>

            </div>

            
            <!-- ================================== FILA 3 ================================== -->
            <div class="col-sm-4 col-md-4">

             
                  <!-- DELEGACIÓN VIEJA 
                    ================================== -->
                    <div class="form-group">
                        <label for="delagacionVieja">DELEGACIÓN VIEJA</label>
                        <input type="text" value="{{ $negocio->getDelegacionDePaso() }}" name="delagacionVieja" id="delagacionVieja" class="form-control" placeholder="delagacionVieja">
                        @if ($errors->has('delagacionVieja'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('delagacionVieja') }}</div>
                        @endif
                    </div>

                     <!-- COLONIA VIEJA 
                    ================================== -->
                    <div class="form-group">
                        <label for="coloniaVieja">COLONIA VIEJA</label>
                        <input type="text" value="{{ $negocio->getColoniaDePaso() }}" name="coloniaVieja" id="coloniaVieja" class="form-control" placeholder="coloniaVieja">
                        @if ($errors->has('coloniaVieja'))<div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('coloniaVieja') }}</div>
                        @endif
                    </div>

                <!-- TIPO DE ASENTAMIENTO 
                ================================== -->
                <div class="form-group">
                    <label for="tipoAsentamiento">Tipo de Asentamiento</label>
                    <select name="tipoAsentamiento" id="tipoAsentamiento" class="form-control">
                    @foreach($tipoAsentamientoList as $tipoAsentamiento)
                    <option {{ ( $negocio->getDireccion()->getTipoAsentamiento()->getId() == $tipoAsentamiento->getId() ? "selected" : "") }} value="{{ $tipoAsentamiento->getId() }} "> {{$tipoAsentamiento->getEtiqueta()}} </option>
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
                    <input type="text" value="{{ $negocio->getDireccion()->getNombreAsentamiento() }}" name="nombreAsentamiento" id="nombreAsentamiento" class="form-control" placeholder="Nombre del Asentamiento">
                    @if ($errors->has('nombreAsentamiento'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombreAsentamiento') }}</div>
                    @endif
                </div>

            </div><!-- /FILA -->
         </div><!-- /row -->



         <div class="row">

            <div class="col-sm-6 col-md-6">

                
                <!-- CODIGO POSTAL
                    ================================== -->
                <div class="form-group">
                    <label for="codigoPostal">Codigo Postal</label>
                    <input type="text" value="{{ $negocio->getDireccion()->getCodigoPostal() }}" name="codigoPostal" id="codigoPostal" maxlength="5" class="form-control" placeholder="Codigo Postal">
                    @if ($errors->has('codigoPostal'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('codigoPostal') }}</div>
                    @endif
                </div>
  
                <!-- TELEFONO
                ================================== -->
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" value="{{ $negocio->getTelefono() }}" name="telefono" id="telefono" class="form-control" placeholder="telefono">
                    @if ($errors->has('telefono'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefono') }}</div>
                    @endif
                </div>
 
                <!-- EXTENSION
                ================================== -->
                <div class="form-group">
                    <label for="extension">Extensión</label>
                    <input type="text" value="{{ $negocio->getExtension() }}" name="extension" id="extension" class="form-control" placeholder="extension">
                    @if ($errors->has('extension'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('extension') }}</div>
                    @endif
                </div>

                   <!-- PISO
                ================================== -->
                <div class="form-group"> 
                        <label for="piso">Piso</label>
                        <input type="text" value="{{ $negocio->getPiso() }}" name="piso" id="piso" class="form-control" placeholder="Piso">
                        @if ($errors->has('piso'))
                        <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('piso') }}</div>
                        @endif
                    </div>
   
                <!--PLAZA
                ================================== -->
                <div class="form-group">
                    <label for="plaza">Plaza</label>
                    <select name="plaza" id="plaza" class="form-control select2">
                        @foreach($plazaList as $plaza)
                        <option {{ ( $negocio->getPlaza() != null ? ($negocio->getPlaza()->getId() == $plaza->getId() ? "selected" : "") : "" ) }} value="{{ $plaza->getId() }} "> {{$plaza->getEtiqueta()}} </option>
                        @endforeach
                    </select> 
                    @if ($errors->has('plaza'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('plaza') }}</div>
                    @endif
                </div>
                   
                <br><br><br><br><br>
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
                    <input type="text" value="{{ implode(",",$asociacionesList)  }}" name="asociacionesList" id="asociacionesList" class="form-control" placeholder="Asociaciones">
                </section>  
 
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
                    <input type="text" value="{{ implode(",",$cadenasList)  }}" name="cadenasList" id="cadenasList" class="form-control" placeholder="Cadenas">
                </section>
                  <br>

             
                

            </div><!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 -->
            

            <!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 -->
            <div class="col-sm-6 col-md-6">
                 
                    
                    <!-- TIPO NEGOCIO
                    ================================== -->
                    <div class="form-group">
                        <label for="tipoNegocio">Tipo Negocio</label>
                        <select name="tipoNegocio" id="tipoNegocio" class="form-control select2">
                        @foreach($tipoNegocioList as $tipoNegocio)
                        <option {{ ( $negocio->getTipoNegocio()->getId() == $tipoNegocio->getId() ? "selected" : "") }} value="{{ $tipoNegocio->getId() }} "> {{$tipoNegocio->getEtiqueta()}} </option>
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
                        @foreach($giroNegocioList as $giroNegocio)
                            <option {{ ( $negocio->getGiroNegocio()->getId() == $giroNegocio->getId() ? "selected" : "") }} value="{{ $giroNegocio->getId() }} "> {{$giroNegocio->getEtiqueta()}} </option>
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
                        <option {{ ( $negocio->getGiroNegocioGeneral()->getId()  == $giroNegocioGeneral->getId() ? "selected" : "") }} value="{{ $giroNegocioGeneral->getId() }} "> {{$giroNegocioGeneral->getEtiqueta()}} </option>
                        @endforeach
                        </select>
                        @if ($errors->has('giroNegocioGeneral'))
                        <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('giroNegocio') }}</div>
                        @endif
                    </div>

                     <!--STATUS REVISIÓN DEL NEGOCIO  
                  ================================== -->
                  <div class="form-group">
                  <label for="statusRev">Status del Negocio despues de la revisión</label>
                  <select name="statusRev" id="statusRev" class="form-control">
                     <option value="" selected>Selecciona una Opción</option>
                     @if ( $negocio->getStatusRevisionNegocio() != null)
                     @foreach($statusRevisionNegocioList as $statusRev)
                     <option {{(  $statusRev->getid() == $negocio->getStatusRevisionNegocio()->getId() ? "selected" : "") }} value="{{ $statusRev->getid() }} ">{{$statusRev->getEtiqueta()}} </option>
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

                       
               <div class="row">
               <div class="col-sm-6 col-md-6">
                  <!-- ¿Cuenta con placa de mi POLICÍA MI NEGOCIO? -->
                  <div class="form-group">
                     <label  for="placaMPN"> ¿ Cuenta con placa MPN? </label>
                     <div class="radio-vertical">
                        <div class="radio-button"> 
                           <input value="2" id="radio-button1" name="placaMPN" type="radio"  {{ $negocio->getPlacaMPN() == 2 ? "checked" : "" }}  >
                           <label for="radio-button1"></label>
                           <span>SI</span>
                        </div>
                        <div class="radio-button">
                           <input value="1" id="radio-button2" name="placaMPN" type="radio"  {{ $negocio->getPlacaMPN() == 1 ? "checked" : "" }}  > 
                           <label for="radio-button2"></label>
                           <span>NO</span>
                        </div>
                        <div class="radio-button">
                           <input value="0" id="radio-button3" name="placaMPN" type="radio"  {{ $negocio->getPlacaMPN() == 0 ? "checked" : "" }} >
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
                           <input value="1" id="radio-button4" name="cuentaConOficio" type="radio"  {{ $negocio->getCuentaConOficio() == 1 ? "checked" : "" }}  >
                           <label for="radio-button4"></label>
                           <span>SI</span>
                        </div>
                        <div class="radio-button">
                           <input value="0" id="radio-button5" name="cuentaConOficio" type="radio"  {{ $negocio->getCuentaConOficio() == 0 ? "checked" : "" }}  >
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
                    <br>
          
          <h3 class="box-title"><span>Puertas del mercado</span></h3>
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
                                                 @foreach( $negocio->getPuertaMercado() as $indice => $puertas )
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

               <br><br><br><br>

                  <!-- REFERENCIAS
                ================================== -->
                <div class="form-group">
                        <div class="box-header">
                            <h3 class="box-title">Referencias del Negocio
                                <small>Breve descripción de referencias</small>   
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <textarea class="textarea" id="referencias" name="referencias" placeholder="Referencias" style="width: 100%; height: 235px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $negocio->getReferencia() }}</textarea>
                        @if ($errors->has('referencias'))
                        <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('referencias') }}</div>
                        @endif
                    </div>

                <!-- COMENTARIOS
                ================================== -->
                <div class="form-group">
                    <div class="box-header">
                        <h3 class="box-title">Comentarios
                            <small>Comentarios sobre la actualización del mercado.</small>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <textarea class="textarea" id="comentarios" name="comentarios" placeholder="Comentarios" style="width: 100%; height: 235px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $negocio->getComentarios() }}</textarea>
                    @if ($errors->has('comentarios'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('comentarios') }}</div>
                    @endif
                </div>

            </div><!-- /col-sm-6 col-md-6 --><!-- /col-sm-6 col-md-6 -->
            
        </div><!-- /row --><!-- /row --><!-- /row --><!-- /row -->

        </br>     
        </br>

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
                    <input type="text" value="{{ $negocio->getLatitud() }}" name="lat" id="lat" class="form-control" placeholder="lat">
                    @if ($errors->has('lat'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('lat') }}</div>
                    @endif
                </div>

                <!-- LONGITUD
                ================================== -->
                <div class="form-group">
                    <label for="long">Longitud</label>
                    <input type="text" value="{{ $negocio->getLongitud() }}" name="long" id="long" class="form-control" placeholder="long">
                    @if ($errors->has('long'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('long') }}</div>
                    @endif
                </div>

                <input type="button" id="buscar" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Buscar"/>

            </div><!-- /col-sm-6 col-md-6 -->

            <div class="col-sm-8 col-md-8">

                <div id="map" style="position: relative; height: 400px width: 100%;"> Ver establecimiento en Mapa</div>

            </div><!-- /col-sm-6 col-md-6 -->

        </div><!-- /row -->

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
            <input type="text" value="{{ implode(",",$encargadosList)  }}" name="encargadosList" id="encargadosList" class="form-control" placeholder="Encargados">
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
                @if ($errors->has('oficioMPN'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('oficioMPN') }}</div>
                @endif
            </div>
            <div class="col-md-4">
                <label for="comprobanteDomicilio">Comprobante de domicilio</label>
                <div class="file-loading">
                    <input id="comprobanteDomicilio" name="comprobanteDomicilio" type="file" >
                </div>
                @if ($errors->has('comprobanteDomicilio'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('comprobanteDomicilio') }}</div>
                @endif
            </div>
            <div class="col-md-4">
                <label for="comprobanteFiscal">Comprobante Fiscal</label>
                <div class="file-loading">
                    <input id="comprobanteFiscal" name="comprobanteFiscal" type="file" >
                </div>
                @if ($errors->has('comprobanteFiscal'))
                    <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('comprobanteFiscal') }}</div>
                @endif
            </div>
        </div> 
             
        <br>
        <br>
        <br>
        <input  type="submit" id="Actualizar" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Actualizar"/>

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
			uploadUrl: "{{ url('/') }}/administracion/rest/establecimientos/oficioIncorporacion/actualizar", // ACTUALIZAR
            deleteUrl: "{{ url('/') }}/administracion/rest/establecimientos/oficioIncorporacion/borrar", //BORRAR
    		uploadAsync: true,
            language: 'es',
            overwriteInitial: false,
            maxFileSize: 1000,
            showCaption: false,  
			showUpload: true,
            maxFilesNum: 3,
			uploadExtraData: function() {
				return {
				    id: {{ $negocio->getOficioIncorporacion()->last() != null ? $negocio->getOficioIncorporacion()->last()->getId() : 0 }}
				};
			},  
			deleteExtraData: function() {
				return {
				    id: {{ $negocio->getOficioIncorporacion()->last()  != null ? $negocio->getOficioIncorporacion()->last()->getId() : 0 }}
				};
			},
            fileActionSettings: { 
                showRemove: true,
                browseIcon: '<i class="fa fa-search"></i>', 
                removeIcon: '<i class="fa fa-trash"></i>',
                uploadIcon: '<i class="fa fa-cloud-upload"></i>',
                zoomIcon  : '<i class="fa fa-expand"></i>'
            },
            previewZoomButtonIcons: {
                prev: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                toggleheader: '<i class="fa fa-compress"></i>',
                fullscreen: '<i class="fa fa-expand"></i>',
                borderless: '<i class="fa fa-arrows-alt"></i>',
                close: '<i class="fa fa-close"></i>'
            },
            initialPreview: [   
                "{{ $oficioIncorporacion }}"
            ],
            initialPreviewAsData: true, 
            initialPreviewConfig: [
                {type: '{{ $oficioIncorporacionMimeType }}', caption: "{{ $negocio->getOficioIncorporacion()->last() != null ? $negocio->getOficioIncorporacion()->last()->getNombreDocumento() : 'Oficio' }}", size: {{ $negocio->getOficioIncorporacion()->last() != null ? $negocio->getOficioIncorporacion()->last()->getTamanoDocumento() : 0 }}, key: 1}
            ], 
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            purifyHtml: true
        });
    
        /* COMPROBANTE DE DOMICILIO 
        ======================================================================================================= */
        $("#comprobanteDomicilio").fileinput({
			uploadUrl: "{{ url('/') }}/administracion/rest/establecimientos/comprobanteDomicilio/actualizar", // ACTUALIZAR
            deleteUrl: "{{ url('/') }}/administracion/rest/establecimientos/comprobanteDomicilio/borrar", //BORRAR
    		uploadAsync: true,
            language: 'es',
            overwriteInitial: false,
            maxFileSize: 1000,
            showCaption: false,  
			showUpload: true,
            maxFilesNum: 3,
			uploadExtraData: function() {
				return {
				    id: {{ $negocio->getComprobanteDomicilio()->last() != null ? $negocio->getComprobanteDomicilio()->last()->getId() : "0" }}
				};
			},  
			deleteExtraData: function() {
				return {
				    id: {{ $negocio->getComprobanteDomicilio()->last() != null ? $negocio->getComprobanteDomicilio()->last()->getId() : "0" }}
				};
			},
            fileActionSettings: { 
                showRemove: true,
                browseIcon: '<i class="fa fa-search"></i>', 
                removeIcon: '<i class="fa fa-trash"></i>',
                uploadIcon: '<i class="fa fa-cloud-upload"></i>',
                zoomIcon  : '<i class="fa fa-expand"></i>'
            },
            previewZoomButtonIcons: {
                prev: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                toggleheader: '<i class="fa fa-compress"></i>',
                fullscreen: '<i class="fa fa-expand"></i>',
                borderless: '<i class="fa fa-arrows-alt"></i>',
                close: '<i class="fa fa-close"></i>'
            },
            initialPreview: [   
                "{{ $comprobanteDomicilio }}"
            ],
            initialPreviewAsData: true, 
            initialPreviewConfig: [
                {type: '{{ $comprobanteDomicilioMimeType }}', caption: "{{  $negocio->getComprobanteDomicilio()->last() !=null ? $negocio->getComprobanteDomicilio()->last()->getNombreDocumento() : '' }}", size: {{ $negocio->getComprobanteDomicilio()->last() != null ? $negocio->getComprobanteDomicilio()->last()->getTamanoDocumento() : 0 }}, key: 1}
            ], 
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            purifyHtml: true
        });

        /* COMPROBANTE FISCAL
        ======================================================================================================= */
        $("#comprobanteFiscal").fileinput({
			uploadUrl: "{{ url('/') }}/administracion/rest/establecimientos/comprobanteFiscal/actualizar", // ACTUALIZAR
            deleteUrl: "{{ url('/') }}/administracion/rest/establecimientos/comprobanteFiscal/borrar", //BORRAR
    		uploadAsync: true,
            language: 'es',
            overwriteInitial: false,
            maxFileSize: 1000,
            showCaption: false,  
			showUpload: true,
            maxFilesNum: 3,
			uploadExtraData: function() {
				return {
				    id: {{ $negocio->getComprobanteFiscal()->last() != null ? $negocio->getComprobanteFiscal()->last()->getId() : "0" }}
				};
			},  
			deleteExtraData: function() {
				return {
				    id: {{ $negocio->getComprobanteFiscal()->last() != null ? $negocio->getComprobanteFiscal()->last()->getId() : "0" }}
				};
			},
            fileActionSettings: { 
                showRemove: true,
                browseIcon: '<i class="fa fa-search"></i>', 
                removeIcon: '<i class="fa fa-trash"></i>',
                uploadIcon: '<i class="fa fa-cloud-upload"></i>',
                zoomIcon  : '<i class="fa fa-expand"></i>'
            },
            previewZoomButtonIcons: {
                prev: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                toggleheader: '<i class="fa fa-compress"></i>',
                fullscreen: '<i class="fa fa-expand"></i>',
                borderless: '<i class="fa fa-arrows-alt"></i>',
                close: '<i class="fa fa-close"></i>'
            },
            initialPreview: [   
                "{{ $comprobanteFiscal }}"
            ],
            initialPreviewAsData: true, 
            initialPreviewConfig: [
                {type: '{{ $comprobanteFiscalMimeType }}', caption: "{{  $negocio->getComprobanteFiscal()->last() !=null ? $negocio->getComprobanteFiscal()->last()->getNombreDocumento() : '' }}", size: {{ $negocio->getComprobanteFiscal()->last() != null ? $negocio->getComprobanteFiscal()->last()->getTamanoDocumento() : 0 }}, key: 1}
            ], 
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            purifyHtml: true
        });
        
        
    }); // TERMINA  $(document).on('ready', function() {

     
    function listAllAsociaciones(){
         
        var rows_selected = [];

        var rows_php = {{json_encode($asociacionesList)}};
        //var yourArray = JSON.parse(rows_php);
        for (x = 0; x < rows_php.length; x++) {
            rows_selected.push(rows_php[x]);
        }
        document.getElementById('asociacionesList').value = rows_selected;

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
                "url": "{{ url('/') }}/administracion/rest/asociaciones/mercados",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    table.ajax.reload();
                }
            },
            "columns": [
                { "data": "id" }, 
                { "data": "nombre" },
                { "data": "alias" },
                { "data": "id" }
            ],
            "columnDefs": [
                {
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
                    "targets": 3
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

    function listAllCadenas(){
        
        var rows_selected = [];
        var rows_php = {{json_encode($cadenasList)}};
        for (x = 0; x < rows_php.length; x++) {
            rows_selected.push(rows_php[x]);
        }
        document.getElementById('cadenasList').value = rows_selected;

        var table = $('#cadenasDT').DataTable({
            responsive    : true,
            "autoWidth"   : false,
            "deferRender" : true,
            "serverSide"  : true,
            "deferRender" : true,
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
            "columns": [
                { "data": "id"},
                { "data": "nombre"},
                { "data": "alias"},
                { "data": "asociacion"},
                { "data": "id"}
            ],
            "columnDefs": [
                {
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
                    "targets": 4
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

    function listAllEncargados(){
    
        var rows_selected = [];
        var rows_php = {{json_encode($encargadosList)}};
        for (x = 0; x < rows_php.length; x++) {
            rows_selected.push(rows_php[x]);
        }
        document.getElementById('encargadosList').value = rows_selected;
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
                
                { "data": "id" },
                { "data": "correo" },
                { "data": "nombre" },
                { "data": "telefono" },
                { "data": "celular" },
                { "data": "asociaciones"},
                { "data": "cadenas" },
                { "data": "establecimientos" },
                { "data": "id" }
            ],
            "columnDefs": [
                {
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
                swal({ title: 'Recuperando Información' });
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
            lat: parseFloat('{{ $negocio->getLatitud() }}'),
            lng: parseFloat('{{ $negocio->getLongitud() }}')
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
        cell7.innerHTML = "<select class='form-control' style='width: 100%;' name='tipoDispositivoPuerta[]' id='tipoDispositivoPuerta' class='form-control'><option value='' selected> Elige una opción </option> @foreach($tipoDispositivoList as $tpdm)<option {{ (old('tipoDispositivoPuerta') == $tpdm->getId() ? 'selected':'') }} value='{{$tpdm->getId()}}'>{{$tpdm->getEtiqueta()}}</option>@endforeach</select>@if ($errors->has('tipoDispositivoPuerta'))<div class='alert alert-danger'><strong>Cuidado! </strong> {{ $errors->first('tipoDispositivoPuerta') }}</div>@endif";
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

                comentarios: {
                    required: true,
                    maxlength: 500
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

                comentarios: {
                    required: jQuery.validator.format('<div class="validacion">El campo es requerido </div>'),
                    maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
                },

                placaMPN: {
                    required: jQuery.validator.format('<div class="validacion">Elige una opción</div>')
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
@endsection