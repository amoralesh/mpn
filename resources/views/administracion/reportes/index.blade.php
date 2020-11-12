@extends('administracion.layout.master')
@section('titulo', 'Reportes')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Reportes')
@section('directorio')
    <li class="breadcrumb-item active">Reportes</li>
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
<!-- daterange picker -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/datepicker/datepicker3.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/timepicker/bootstrap-timepicker.min.css">

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
    .swal2-container {
        z-index: 999999;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: rgba(0,28,60,1);
            color: white;
    }
</style>
@endsection 


@section('content')
<div style="margin: 25px auto; width:95%;">
   <!-- ESTE PRIMER DIV ES NECESARIO SIEMPRE EN TODAS LAS VISTAS -->
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
   <!-- REPORTES -->
   <div class="box-header">
      <h3 class="box-title">Reportes
         <small>Selecciona el tipo de reporte a generar</small>
      </h3>
   </div>
   <div class="divider15"></div>
   <div class="nav-tab-pills-image">
      <ul class="nav nav-tabs" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#negocios1" role="tab"><i class="icon fa fa-building"></i>Negocios</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#mercados2" role="tab"><i class="icon fa fa-building"></i>Mercados</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#escuelas3" role="tab"><i class="icon fa fa-building"></i>Escuelas</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#asociaciones4" role="tab"><i class="icon fa fa-cubes"></i>Asociaciones</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cadenas5" role="tab"><i class="icon fa fa-cubes"></i>Cadenas</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#dispositivos6" role="tab"><i class="icon fa fa-cubes"></i>Dispositivos</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#plazas7" role="tab"><i class="icon fa fa-building"></i>Plazas</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#encargados8" role="tab"><i class="icon fa fa-group"></i>Encargados</a>
         </li>
      </ul>

      <div class="divider15"></div>
      <div class="tab-content">
          
         <!-- NEGOCIOS -->
         <div class="tab-pane active" id="negocios1" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150"> 
                     <section>
                         
                        <div class="row">
                            <div class="col-lg-6" >
                                <!-- RANGO DE FECHAS-->
                                <div class="form-group">
                                    <label>Rango de fechas</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="fechas" name="fechas">
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">

                            <div class="col-lg-6" >


                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="negocios" id="checkbox-squared1" name="vertical" type="checkbox">
                                            <label for="checkbox-squared1"></label>
                                            <span>Negocios</span>
                                        </div>

                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="alertas" id="checkbox-squared2" name="vertical" type="checkbox">
                                            <label for="checkbox-squared2"></label>
                                            <span>Alertas</span>
                                        </div>
                                        
                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="pruebas" id="checkbox-squared3" name="vertical" type="checkbox">
                                            <label for="checkbox-squared3"></label>
                                            <span>Pruebas</span>
                                        </div>
                                        
                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="encargados" id="checkbox-squared4" name="vertical" type="checkbox">
                                            <label for="checkbox-squared4"></label>
                                            <span>Delegación 
                                                <select name="delegacion1" id="delegacion1" class="select2">
                                                    @foreach($delegacionList as $delegacion)
                                                    <option {{ (old( "delegacion") == $delegacion->getid() ? "selected" : "") }} value="{{ $delegacion->getid() }} "> {{$delegacion->getEtiqueta()}} </option>
                                                    @endforeach 
                                                </select>
                                            </span>
                                        </div>

                                        
                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="encargados" id="checkbox-squared5" name="vertical" type="checkbox">
                                            <label for="checkbox-squared5"></label>
                                            <span>Colonia 
                                                <select name="delegacion" id="delegacion" class="select2">
                                                    @foreach($delegacionList as $delegacion)
                                                    <option {{ (old( "delegacion") == $delegacion->getid() ? "selected" : "") }} value="{{ $delegacion->getid() }} "> {{$delegacion->getEtiqueta()}} </option>
                                                    @endforeach 
                                                </select>
                                                <select name="colonia" id="colonia" class="select2">
                                                    {{-- @foreach($coloniaList as $colonia)
                                                        <option {{ (old( "colonia") == $colonia->getid() ? "selected" : "") }} value="{{ $colonia->getid() }} "> {{$colonia->getEtiqueta()}} </option>
                                                    @endforeach --}}
                                                </select>
                                            </span>
                                        </div>

                                        
                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="encargados" id="checkbox-squared6" name="vertical" type="checkbox">
                                            <label for="checkbox-squared6"></label>
                                            <span>Tipo de Asentamiento   
                                                <select name="tipoAsentamiento" id="tipoAsentamiento" class="select2">
                                                    @foreach($tipoAsentamientoList as $tipoAsentamiento)
                                                    <option {{ (old( "tipoAsentamiento") == $tipoAsentamiento->getid() ? "selected" : "") }} value="{{ $tipoAsentamiento->getid() }} "> {{$tipoAsentamiento->getEtiqueta()}} </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>

                                        <div class="checkbox-squared" style="margin: 15px 0 ;">
                                            <input value="encargados" id="checkbox-squared7" name="vertical" type="checkbox">
                                            <label for="checkbox-squared7"></label>
                                            <span>Placa Mi Policía en mi Negocio 
                                                
                                                <select name="mpn" id="mpn" class="select2">
                                                    <option value="2">SI</option>
                                                    <option value="1">NO</option>
                                                    <option value="0">NO SE SABE</option>
                                                </select>
                                                
                                            </span>
                                        </div>
                            </div>

                            <div class="col-lg-6" >

                                <div class="checkbox-squared" style="margin: 15px 0 ;">
                                    <input value="encargados" id="checkbox-squared8" name="vertical" type="checkbox">
                                    <label for="checkbox-squared8"></label>
                                    <span>Tipo Negocio
                                        <select name="tipoNegocio" id="tipoNegocio" class="select2">
                                            @foreach($tipoNegocioList as $tipoNegocio)
                                            <option {{ (old( "tipoNegocio") == $tipoNegocio->getid() ? "selected" : "") }} value="{{ $tipoNegocio->getid() }} "> {{$tipoNegocio->getEtiqueta()}} </option>
                                            @endforeach
                                        </select>
                                    </span>  
                                </div>

                                <div class="checkbox-squared" style="margin: 15px 0 ;">
                                    <input value="encargados" id="checkbox-squared9" name="vertical" type="checkbox">
                                    <label for="checkbox-squared9"></label>
                                    <span>Giro Negocio
                                        <select name="giroNegocio" id="giroNegocio" class="select2">
                                            @foreach($giroNegocioList as $giroNegocio)
                                            <option {{ (old( "giroNegocio") == $giroNegocio->getid() ? "selected" : "") }} value="{{ $giroNegocio->getid() }} "> {{$giroNegocio->getEtiqueta()}} </option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>

                                <div class="checkbox-squared" style="margin: 15px 0 ;">
                                    <input value="encargados" id="checkbox-squared10" name="vertical" type="checkbox">
                                    <label for="checkbox-squared10"></label>
                                    <span>Giro Negocio (Más general)
                                        <select name="giroNegocioGeneral" id="giroNegocioGeneral" class="select2">
                                            @foreach($giroNegocioGeneralList as $giroNegocioGeneral)
                                            <option {{ (old( "giroNegocioGeneral") == $giroNegocioGeneral->getid() ? "selected" : "") }} value="{{ $giroNegocioGeneral->getid() }} "> {{$giroNegocioGeneral->getEtiqueta()}} </option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>
                                                
                                <div class="checkbox-squared" style="margin: 15px 0 ;">
                                    <input value="encargados" id="checkbox-squared11" name="vertical" type="checkbox">
                                    <label for="checkbox-squared11"></label>
                                    <span>Sectores
                                        <select name="sector" id="sector" class="select2">
                                            @foreach($sectorList as $sector)
                                            <option {{ (old( "sector") == $sector->getid() ? "selected" : "") }} value="{{ $sector->getid() }} "> {{$sector->getEtiqueta()}} </option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>
  
    
                                <div class="checkbox-squared" style="margin: 15px 0 ;">
                                    <input value="encargados" id="checkbox-squared12" name="vertical" type="checkbox">
                                    <label for="checkbox-squared12"></label>
                                    <span>Tipo Dispositivo
                                        <select name="tipoDispositivo" id="tipoDispositivo" class="select2">
                                            @foreach($tipoDispositivoList as $tipoDispositivo)
                                            <option {{ (old( "tipoDispositivo") == $tipoDispositivo->getid() ? "selected" : "") }} value="{{ $tipoDispositivo->getid() }} "> {{$tipoDispositivo->getEtiqueta()}} </option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>

                                <div class="checkbox-squared" style="margin: 15px 0 ;">
                                    <input value="encargados" id="checkbox-squared13" name="vertical" type="checkbox">
                                    <label for="checkbox-squared13"></label>
                                    <span>Tipos de estatus de revisión de negocios
                                        <select name="statusRevisionNegocio" id="statusRevisionNegocio" class="select2">
                                            @foreach($statusRevisionNegocioList as $statusRevisionNegocio)
                                            <option {{ (old( "statusRevisionNegocio") == $statusRevisionNegocio->getid() ? "selected" : "") }} value="{{ $statusRevisionNegocio->getid() }} "> {{$statusRevisionNegocio->getEtiqueta()}} </option>
                                            @endforeach
                                        </select>   
                                    </span>
                                </div>

                            </div>
                        </div>

                        <button type="button" id="crear" class="btn btn-primary"  style="margin-bottom:30px;" >Generar Reporte </button>


                        <table class="table table-striped table-bordered table-hover" id="negociosDT">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Código Águila</th>
                                 <th>Sector</th>
                                 <th>Nombre</th>
                                 <th>Razón Social</th>
                                 <th>Tipo de Negocio</th>
                                 <th>Giro de Negocio</th>
                                 <th>Giro de Negocio General</th>
                                 <th>Teléfono</th>
                                 <th>Extensión</th>
                                 <th>Tipo de Status</th>
                                 <th>Alarmas Emitidas</th>
                                 <th>Pruebas Emitidas</th>
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
               </div>
            </div>
         </div>
         <!-- MERCADOS -->
         <div class="tab-pane" id="mercados2" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <section style="margin-top:20px;">
                     <table class="table table-striped table-bordered table-hover" id="mercadosDT">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Código Águila</th>
                              <th>Sector</th>
                              <th>Nombre</th>
                              <th>Razón Social</th>
                              <th>Tipo de Negocio</th>
                              <th>Giro de Negocio</th>
                              <th>Giro de Negocio General</th>
                              <th>Teléfono</th>
                              <th>Extensión</th>
                              <th>Tipo de Status</th>
                              <th>Alarmas Emitidas</th>
                              <th>Pruebas Emitidas</th>
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
            </div>
         </div>
         <!-- ESCUELAS -->
         <div class="tab-pane" id="escuelas3" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150">
                     <section style="margin-top:20px;">
                        <table class="table table-striped table-bordered table-hover" id="escuelasDT">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Código Águila</th>
                                 <th>Sector</th>
                                 <th>Nombre</th>
                                 <th>Razón Social</th>
                                 <th>Tipo de Negocio</th>
                                 <th>Giro de Negocio</th>
                                 <th>Giro de Negocio General</th>
                                 <th>Teléfono</th>
                                 <th>Extensión</th>
                                 <th>Tipo de Status</th>
                                 <th>Alarmas Emitidas</th>
                                 <th>Pruebas Emitidas</th>
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
               </div>
            </div>
         </div>
         <!-- ASOCIACIONES -->
         <div class="tab-pane" id="asociaciones4" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150">
                     <section style="margin-top:20px;">
                        <table class="table table-striped table-bordered table-hover" id="asociacionesDT">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Nombre</th>
                                 <th>fecha alta</th>
                                 <th>Alias</th>
                                 <th># Cadenas</th>
                                 <th>Encargados</th>
                                 <th>Status</th>
                                 <th>Acción</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </section>
                  </div>
               </div>
            </div>
         </div>
         <!-- CADENAS -->
         <div class="tab-pane" id="cadenas5" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150">
                     <section style="margin-top:20px;">
                        <table class="table table-striped table-bordered table-hover" id="cadenasDT">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Nombre</th>
                                 <th>Alias</th>
                                 <th>Asociación</th>
                                 <th># Negocios</th>
                                 <th># Encargados</th>
                                 <th>fecha alta</th>
                                 <th>Status</th>
                                 <th>Acción</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </section>
                  </div>
               </div>
            </div>
         </div>
         <!-- DISPOSITIVOS -->
         <div class="tab-pane" id="dispositivos6" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150">
                     <section style="margin-top:20px;">
                        <table class="table table-striped table-bordered table-hover" id="dispositivosDT">
                           <thead>
                              <tr>
                                 <th># </th>
                                 <th>Etiqueta </th>
                                 <th>Tipo de Dispositivo </th>
                                 <th>Cantidad</th>
                                 <th>Token </th>
                                 <th>Tipo de Status </th>
                                 <th>Número de Actualizacion </th>
                                 <th>status </th>
                                 <th>Fecha de Alta </th>
                                 <th>Acción </th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </section>
                  </div>
               </div>
            </div>
         </div>
         <!-- PLAZAS -->
         <div class="tab-pane" id="plazas7" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150">
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
               </div>
            </div>
         </div>
         <!-- ENCARGADIS -->
         <div class="tab-pane" id="encargados8" role="tabpanel">
            <div class="row">
               <div class="col-md-12 pills-height">
                  <div data-plugin="scrollbar" data-height="150">
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
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /FINALIZA EL DIV PRINCIPAL -->
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
 
<!-- date-range-picker -->
<script src="{{ url('/') }}/public/assets/global/js/global/moments.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="{{ url('/') }}/public/assets/global/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
    $(function() { 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        listAllEstablecimientos();
        listAllAsociaciones();
        listAllCadenas();
        listAllPlazas();
        listAllEncargados();

        /* DELEGACION ON CHANGE
        ======================================================================================================= */
        var select = $("#delegacion");
        select.on('change', function() {
            obtenerColoniasByDelegacion(select.val());
        });  

        $('#negociosDT td:nth-child(11)').css('background', '#FFF');
    
        var start = moment();
        var end = moment(start, "DD/MM/YYYY").add(1, 'month');
        
        $('input[name="fechas"]').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 5,
                startDate: start, 
                endDate: end,
                ranges: {
                'Hoy': [ moment().startOf('day'), moment().endOf('day') ],
                'Ayer': [moment().subtract(1, 'days').startOf('day') , moment().subtract(1, 'days').endOf('day')],
                'Hace 7 Días': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                'Últimos 30 Días': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
                'Este mes': [moment().startOf('month'), moment().endOf('month').endOf('day')],
                'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "locale": { 
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Ok",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "De",
                    "toLabel": "A",
                    "customRangeLabel": "Custom",
                    "daysOfWeek": [
                        "Dom",
                        "Lun",
                        "Mar",
                        "Mie",
                        "Jue",
                        "Vie",
                        "Sab"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agusto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                }
            },
            function( start , end , label) {
                Bitacora( start.format('YYYY-MM-DD H:mm:ss')  , end.format('YYYY-MM-DD H:mm:ss')  ); 
            } 
        );


    });

    
    function listAllEstablecimientos()
    {

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
                { "data": "id" }
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
                            acciones += '<div id="alertas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-warning"></i> Alertas</button></div>';
                            acciones += '<div id="pruebas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-warning"></i> Pruebas</button></div>';
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
    }

   
   
    
    function listAllAsociaciones()
    {
        token = $('meta[name="csrf-token"]').attr('content');
 
        var table = $('#asociacionesDT').DataTable({

            responsive: true,
            "autoWidth": false,
            "bProcessing": true,
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
                "url": "{{ url('/') }}/administracion/rest/asociaciones",
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
                { "data": "fechaAlta.date" },
                { "data": "alias" },
                { "data": "numeroCadenas" },
                { "data": "numeroEncargados" },
                { "data": "status" },
                { "data": "id" }
            ],
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</pan>';
                    },
                    "targets": 6
                },
                {
                    "render": function(data, type, row) {
                        
                        var acciones = ''; 
                            acciones += '<div id="informacion" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-info"></i> Información</button></div>';
                            acciones += '<div id="cadenas" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Ver Cadenas</button></div>';
                            acciones += '<div id="encargados" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-group"></i> Ver Encargados</button></div>';
                            acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
                        if (row.status == true) { 
                            acciones += '<div id="baja" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-down"></i> Deshabilitar</button></div>';
                        } else {
                            acciones += '<div id="alta" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-up"></i> Habilitar</button></div>';
                        } 
                        return acciones;
                    },  
                    "targets": 7
                }
            ]
        });
    }


    
    function listAllCadenas()
    {
        token = $('meta[name="csrf-token"]').attr('content');

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
                "data": {
                    _token: token
                }, 
                "error": function(xhr, error, thrown) {
                    table.ajax.reload();
                }
            },
            "columns": [
                { "data": "id"},
                { "data": "nombre"},
                { "data": "alias"},
                { "data": "asociacion"}, 
                { "data": "numeroNegocios"},
                { "data": "numeroEncargados"},
                { "data": "fechaAlta.date"},
                { "data": "status"},
                { "data": "id"}
         ],
            "columnDefs": [
                {
                    "render": function(data, type, row) {
                        return (data === true) ? '<span class="fa fa-check">  Activo</span>' : '<span class="fa fa-close"> No Activo</pan>';
                    },
                    "targets": 7
                }, 
                {
                    "render": function(data, type, row) {
                        var acciones = ''; 
                            acciones += '<div id="informacion" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-info"></i> Información</button></div>';
                            acciones += '<div id="asociaciones" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-object-group"></i> Ver Asociaciones</button></div>';
                            acciones += '<div id="encargados" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-group"></i> Ver Encargados</button></div>';
                            acciones += '<div id="editar" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-pencil"></i> Editar</button></div>';
                        if (row.status == true) { 
                            acciones += '<div id="baja" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-down"></i> Deshabilitar</button></div>';
                        } else {
                            acciones += '<div id="alta" class="" style="color: rgba(255,80,80,1);"><button type="button" class="btn btn-primary" style="width:80%; margin-top:2px"><i class="fa fa-level-up"></i> Habilitar</button></div>';
                        } 
                        return acciones;
                    },
                    "targets": 8
                }
            ]
        });
    }
    
    
    
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

    }



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

</script>

@endsection
