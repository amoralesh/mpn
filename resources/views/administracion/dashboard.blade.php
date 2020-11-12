@extends('administracion.layout.master')
@section('titulo', 'Dashboard')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Dashboard')
@section('directorio')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection


@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection


@section('content')
<div style="margin: 25px auto; width:95%;">
        <!-- ESTE PRIMER DIV ES NECESARIO SIEMPRE EN TODAS LAS VISTAS -->
        <!--  START DASHBOARD -->
        <div class="contain-inner dashboard-v2">
           <div class="row">
              <div class="col-md-12 col-lg-12">
                 <div class="row">
                    <!-- USUARIOS DEL SISTEMA -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                       <div class="dashboard-widget widget-box dashboard-xs-widget">
                          <div class="widget-content text-xs-right">
                             <div class="product-icon bg-primary">
                                <i class="product-hover fa fa-user"></i>
                                <i class="display-icon fa fa-user"></i>
                             </div>
                             <span>Usuarios del sistema</span>
                             <h4 class="text-danger">{{ $usuariosTotal }}</h4>
                          </div>
                       </div>
                    </div>
                    <!-- PERMISOS DE ADMINISTRACION -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                       <div class="dashboard-widget widget-box dashboard-xs-widget">
                          <div class="widget-content text-xs-right">
                             <div class="product-icon bg-primary">
                                <i class="product-hover fa fa-list"></i>
                                <i class="display-icon fa fa-list"></i>
                             </div>
                             <span>Permisos administrativos</span>
                             <h4 class="text-danger">{{ $usuariosPermisos }}</h4>
                          </div>
                       </div>
                    </div>
                    <div class="divider-lg-spacing"></div>
                    <!-- USUARIOS DE APLICACIÓN MOVIL -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                       <div class="dashboard-widget widget-box dashboard-xs-widget">
                          <div class="widget-content text-xs-right">
                             <div class="product-icon bg-primary">
                                <i class="product-hover fa fa-user"></i>
                                <i class="display-icon fa fa-user"></i>
                             </div>
                             <span>Usuarios de aplicación movil</span>
                             <h4 class="text-danger">{{ $usuariosMobileTotal }}</h4>
                          </div>
                       </div>
                    </div>
                    <!-- USUARIOS DEL SISTEMA BLOQUEADOS -->
                    <div class="col-md-6 col-lg-6 col-xl-3">
                       <div class="dashboard-widget widget-box">
                          <div class="widget-content text-xs-right">
                             <div class="product-icon bg-primary">
                                <i class="product-hover fa fa-mobile"></i>
                                <i class="display-icon fa fa-mobile"></i>
                             </div>
                             <span>Dispositivos</span>
                             <h4 class="text-danger">{{ $dispositivosTotal }}</h4>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <!-- USUARIOS Y PERMISOS DEL SISTEMA-->
           <!-- USUARIOS Y PERMISOS DEL SISTEMA-->
           <br><br>
           <!-- CIFRAS DURAS 
              =============================================== -->
           <div class="row">
              <div class="col-xs-3">
                 <div class="widget-box" style="background-color:#E1E3E3;">
                    <div class="widget-info">
                       <div class="widget-content">
                          <h5 class="crm-title text-xs-center">Establecimientos</h5>
                          <div class="text-xs-center">
                             <input data-plugin="jknob" type="text" data-angleArc=360
                                data-bgColor="rgba(255,72,89,0.1)"
                                data-fgColor="#07A0BB"
                                data-thickness=".2"
                                value="{{ $establecimientos }}"
                                data-skin="tron" 
                                data-max="20000"
                                data-width="100"
                                data-height="100"
                                data-readonly="true">
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- /.col -->
   
              <!-- /.col -->
              <div class="col-xs-3">
                 <div class="widget-box" style="background-color:#E1E3E3;">
                    <div class="widget-info">
                       <div class="widget-content">
                          <h5 class="crm-title text-xs-center">Pruebas</h5>
                          <div class="text-xs-center">
                             <input data-plugin="jknob" type="text" data-angleArc=360
                                data-bgColor="rgba(255,72,89,0.1)"
                                data-fgColor="#07A0BB"
                                data-thickness=".2"
                                value="{{ $pruebasEmitidas }}"
                                data-skin="tron" 
                                data-max="20000"
                                data-width="100"
                                data-height="100"
                                data-readonly="true">
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-3">
                 <div class="widget-box" style="background-color:#E1E3E3;">
                    <div class="widget-info">
                       <div class="widget-content">
                          <h5 class="crm-title text-xs-center">Dispositivos en Línea</h5>
                          <div class="text-xs-center">
                             <input data-plugin="jknob" type="text" data-angleArc=360
                                data-bgColor="rgba(255,72,89,0.1)"
                                data-fgColor="#07A0BB"
                                data-thickness=".2"
                                value="{{ $dispositivos }}"
                                data-skin="tron" 
                                data-max="50000"
                                data-width="100"
                                data-height="100"
                                data-readonly="true">
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- /.col -->
           </div>
           <!-- /.row -->
           <!-- =======END CIFRAS DURAS ====
              ============================== -->
           <br><br>
           <!-- =======GRAFICAS CIRCULARES ====
              ============================== -->
           <div class="row">
              <div class="col-md-4">
                 <div class="contain-inner real-esate-dashboard">
                    <div class="content chart-real">
                       <div class="detail-chart-real">
                          <div class="customer-section-real float-xs-left">
                             <h2 class="title-name-real">Total de Alertas Emitidas</h2>
                             <h3 class="value-real text-warning">{{$alertasEmitidas}}</h3>
                          </div>
                          <div class="customer-section-real float-xs-left">
                             <h2 class="title-name-real">Efectivas</h2>
                             <h3 class="value-real" style="color:red">{{$alertasEfectivas}}</h3>
                          </div>
                          <div class="customer-section-real float-xs-left">
                             <h2 class="title-name-real">No Efectivas</h2>
                             <h3 class="value-real" style="color:green">{{$alertasNoEfectivas}}</h3>
                          </div>
                       </div>
                       <canvas id="chart-area"></canvas>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-4">
                 <div class="content">
                    <div class="dashboard-content">
                       <div class="dashboard-header">
                          <h4 class="page-content-title float-xs-left">ALTAS EN EL SISTEMA</h4>
                          <div class="dashboard-action">
                             <ul class="right-action float-xs-right">
                                <li data-widget="collapse"><a href="javascript:void(0)"
                                   aria-hidden="true"><span
                                   class="icon_minus-06"
                                   aria-hidden="true"></span></a></li>
                                <li data-widget="close"><a href="javascript:void(0)"><span
                                   class="icon_close" aria-hidden="true"></span></a>
                                </li>
                             </ul>
                          </div>
                       </div>
                       <div class="dashboard-box">
                          <div id="donut-color" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <!-- =======END GRAFICAS CIRCULARES ====
              ============================== -->
           <br><br> 
           <!--ESTABLECIMIENTOS AND ASOCIACIONES
              =======================
              =====================-->
           <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                 <!--PP-->
                 <div class="content">
                    <div class="dashboard-header">
                       <h2 class="page-content-title float-xs-left" ><b>Establecimientos</b></h2>
                       <div class="dashboard-action">
                          <ul class="right-action float-xs-right">
                             <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span
                                aria-hidden="true" class="icon_minus-06"></span></a></li>
                             <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true"
                                class="icon_close"></span></a>
                             </li>
                          </ul>
                       </div>
                       <div class="dashboard-box">
                          <div id="area-chart_negocio" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
                 <!--PP-->
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{1000}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES TOTALES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES FALTANTES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL APROBADOS</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL NO APROBADOS</span>
                    </div>
                 </div>
              </div>
              <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <!--PP-->
                 <div class="content">
                    <div class="dashboard-header">
                       <h2 class="page-content-title float-xs-left" ><b>Asociaciones</b></h2>
                       <div class="dashboard-action">
                          <ul class="right-action float-xs-right">
                             <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span
                                aria-hidden="true" class="icon_minus-06"></span></a></li>
                             <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true"
                                class="icon_close"></span></a>
                             </li>
                          </ul>
                       </div>
                       <div class="dashboard-box">
                          <div id="area-chart_asociaciones" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
                 <!--PP-->
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{1000}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES TOTALES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES FALTANTES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL APROBADOS</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL NO APROBADOS</span>
                    </div>
                 </div>
              </div>
           </div>
           <!--END ESTABLECIMIENTOS AND ASOCIACIONES
              =======================
              =====================-->
           <br><br> 
           <!--CADENAS AND PLAZAS
              =======================
              =====================-->
           <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                 <!--PP-->
                 <div class="content">
                    <div class="dashboard-header">
                       <h2 class="page-content-title float-xs-left" ><b>CADENAS</b></h2>
                       <div class="dashboard-action">
                          <ul class="right-action float-xs-right">
                             <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span
                                aria-hidden="true" class="icon_minus-06"></span></a></li>
                             <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true"
                                class="icon_close"></span></a>
                             </li>
                          </ul>
                       </div>
                       <div class="dashboard-box">
                          <div id="area-chart_cadenas" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
                 <!--PP-->
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{1000}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES TOTALES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES FALTANTES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL APROBADOS</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL NO APROBADOS</span>
                    </div>
                 </div>
              </div>
              <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <!--PP-->
                 <div class="content">
                    <div class="dashboard-header">
                       <h2 class="page-content-title float-xs-left" ><b>PLAZAS</b></h2>
                       <div class="dashboard-action">
                          <ul class="right-action float-xs-right">
                             <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span
                                aria-hidden="true" class="icon_minus-06"></span></a></li>
                             <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true"
                                class="icon_close"></span></a>
                             </li>
                          </ul>
                       </div>
                       <div class="dashboard-box">
                          <div id="area-chart_plazas" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
                 <!--PP-->
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{1000}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES TOTALES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES FALTANTES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL APROBADOS</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL NO APROBADOS</span>
                    </div>
                 </div>
              </div>
           </div>
           <!--CADENAS AND PLAZAS
              =======================
              =====================-->
           <br><br> 
           <!--ALERTAS AND PRUEBAS
              =======================
              =====================-->
           <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <!--PP-->
                 <div class="content">
                    <div class="dashboard-header">
                       <h2 class="page-content-title float-xs-left" ><b>ALERTAS Y PRUEBAS</b></h2>
                       <div class="dashboard-action">
                          <ul class="right-action float-xs-right">
                             <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span
                                aria-hidden="true" class="icon_minus-06"></span></a></li>
                             <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true"
                                class="icon_close"></span></a>
                             </li>
                          </ul>
                       </div>
                       <div class="dashboard-box">
                          <div id="area-chart_alertas_pruebas" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
                 <!--PP-->
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{1000}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES TOTALES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES FALTANTES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL APROBADOS</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL NO APROBADOS</span>
                    </div>
                 </div>
              </div>
           </div>
           <!--ALERTAS AND PRUEBAS
              =======================
              =====================-->
           <br><br>
           <!--ALERTAS EFECTIVAS Y NO EFECTIVAS
              =======================
              =====================-->
           <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <!--PP-->
                 <div class="content">
                    <div class="dashboard-header">
                       <h2 class="page-content-title float-xs-left" ><b>ALERTAS EFECTIVAS Y NO EFECTIVAS</b></h2>
                       <div class="dashboard-action">
                          <ul class="right-action float-xs-right">
                             <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span
                                aria-hidden="true" class="icon_minus-06"></span></a></li>
                             <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true"
                                class="icon_close"></span></a>
                             </li>
                          </ul>
                       </div>
                       <div class="dashboard-box">
                          <div id="area-chart_alertas_efectivas_noEfectivas" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
                 <!--PP-->
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{1000}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES TOTALES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">FORMACIONES FALTANTES</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL APROBADOS</span>
                    </div>
                 </div>
                 <div class="col-sm-1 col-xs-1">
                 </div>
                 <div class="col-sm-2 col-xs-1">
                    <div class="description-block border-right">
                       <span class="description-percentage text-green">
                          <h6 class="description-header"><strong style="color:red">{{300}}</strong></h6>
                       </span>
                       <span class="description-text">TOTAL NO APROBADOS</span>
                    </div>
                 </div>
              </div>
           </div>
           <!--ALERTAS EFECTIVAS Y NO EFECTIVAS
              =======================
              =====================-->
           <br><br>
           <!-- =======GRAFICAS FINALES ====
              ============================== -->
           <div class="row">
              <div class="col-md-4">
                 <div class="dashboard-header content">
                    <h4 class="page-content-title float-xs-left">Activaciones Efectivas</h4>
                    <div class="dashboard-action">
                       <ul class="right-action float-xs-right">
                          <li data-widget="collapse">
                             <a aria-hidden="true" href="javascript:void(0)">
                             <span aria-hidden="true" class="icon_minus-06"></span>
                             </a>
                          </li>
                          <li data-widget="close">
                             <a href="javascript:void(0)">
                             <span aria-hidden="true" class="icon_close"></span>
                             </a>
                          </li>
                       </ul>
                    </div>
                    <div class="dashboard-box">
                       <div id="order-chart"></div>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="contain-inner real-esate-dashboard">
                    <div class="content chart-real">
                       <div class="detail-chart-real">
                          <div class="customer-section-real float-xs-left">
                             <h2 class="title-name-real">Total de Alertas Emitidas</h2>
                             <h3 class="value-real text-warning">{{100}}</h3>
                          </div>
                          <div class="customer-section-real float-xs-left">
                             <h2 class="title-name-real">Efectivas</h2>
                             <h3 class="value-real text-success">{{50}}</h3>
                          </div>
                          <div class="customer-section-real float-xs-left">
                             <h2 class="title-name-real">No Efectivas</h2>
                             <h3 class="value-real text-danger">{{50}}</h3>
                          </div>
                       </div>
                       <canvas id="chart-area"></canvas>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                 <div class="content">
                    <div class="dashboard-content">
                       <div class="dashboard-header">
                          <h4 class="page-content-title float-xs-left">Status de Revisión</h4>
                          <div class="dashboard-action">
                             <ul class="right-action float-xs-right">
                                <li data-widget="collapse"><a href="javascript:void(0)"
                                   aria-hidden="true"><span
                                   class="icon_minus-06"
                                   aria-hidden="true"></span></a></li>
                                <li data-widget="close"><a href="javascript:void(0)"><span
                                   class="icon_close" aria-hidden="true"></span></a>
                                </li>
                             </ul>
                          </div>
                       </div>
                       <div class="dashboard-box">
                          <div id="donut-color" class="chart-height"></div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <!-- =======END GRAFICAS FINALES ====
              ============================== -->
           <br><br> 
        </div>
        <!--  END DASHBOARD -->
     </div>
     <!-- /FINALIZA EL DIV PRINCIPAL -->
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/chart.js/dist/Chart.bundle.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/chart.js/samples/utils.js"></script>

<script src="{{ url('/') }}/public/assets/global/plugins/knob/jquery.knob.js"></script>

<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/raphael/raphael.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/morris.js/morris.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/chartist/dist/chartist.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/Flot/jquery.flot.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/Flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/Flot/jquery.flot.crosshair.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/Flot/jquery.flot.pie.js"></script>



<script type="text/javascript">
    /*---- Donut color ----*/
    var donutcolor = Morris.Donut({
        element: 'donut-color',
        data: [
            {value: ({{$asociaciones}}), label: 'Asociaciones'},
            {value: ({{$cadenas}}), label: 'Cadenas'},
            {value: ({{$encargados}}), label: 'Encargados'},
            {value: ({{$plazas}}), label: 'Plazas'}
        ],
        backgroundColor: '#ccc',
        labelColor: '#ccc',
        colors: ['#459E82', '#c9302c', '#477988', '#EAE30F'  ],
        resize: true,
        redraw: true,
        stack: true,
        formatter: function (x) {
            return x + " Creados"
        }
    });
    
    </script>

<script type="text/javascript">
    var randomScalingFactorPie = function() {
        return Math.round(Math.random() * 100);
    };

    var configpie = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    {{$alertasNoEfectivas}},
                    {{$alertasEfectivas}},
                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.green,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "No Efectivas",
                "Efectivas"
            ]
        },
        options: {
            responsive: true
        }
    };

    var ctxpie = document.getElementById("chart-area").getContext("2d"),
        myPie = new Chart(ctxpie, configpie);
</script>

<script>
    function chart_order_survey() {

        var d1 = [],
            series = Math.floor(Math.random() * 6) + 3;

        d1[0] = {
            label: "Alterar el orden público",
            data: 28
        };
        d1[1] = {
            label: "Robo a transeúnte",
            data: 4
        };
        d1[2] = {
            label: "Intento de fraude (no quiere pagar)",
            data: 4
        };
        d1[3] = {
            label: "Robo con violencia a negocio",
            data: 4
        };
        d1[4] = {
            label: "Sospechosos en el local",
            data: 28
        };
        d1[5] = {
            label: "Farderos (robo sin violencia)",
            data: 28
        };
        d1[6] = {
            label: "Otros apoyos",
            data: 28
        };
        $.plot('#order-chart', d1, {
            series: {
                pie: {
                    innerRadius: 0.4,
                    show: true,
                    stroke: {
                        width: 1
                    },
                    label: {
                        show: true,
                        threshold: 0.01
                    }
                }
            },
            colors: ['#15b315', '#febf34', '#ff4a5d', '#363b5b', '#3A8DEA', '#D939F0', '#26FFFF'],
            grid: {
                hoverable: false
            }
        });
    }
    chart_order_survey();
</script>





<!--=======NEGOCIO=======-->
<script type="text/javascript">
    $(function() {
        obtenerEstablecimientosEstadisticas();
    });


    /* ADMINISTRACION DEL PERSONAL
    ==============================================================
    ==============================================================*/
    function obtenerEstablecimientosEstadisticas() {
        var dialog;

        $.ajax({
            url: "{{ url('/') }}/res/administracion/dashboard/establecimientos/altas",
            type: 'GET',
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data);


                var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

                var meses = [{
                        month: '2018-01',
                        a: 0
                    },
                    {
                        month: '2018-02',
                        a: 0
                    },
                    {
                        month: '2018-03',
                        a: 0
                    },
                    {
                        month: '2018-04',
                        a: 0
                    },
                    {
                        month: '2018-05',
                        a: 0
                    },
                    {
                        month: '2018-06',
                        a: 0
                    },
                    {
                        month: '2018-07',
                        a: 0
                    },
                    {
                        month: '2018-08',
                        a: 0
                    },
                    {
                        month: '2018-09',
                        a: 0
                    },
                    {
                        month: '2018-10',
                        a: 0
                    },
                    {
                        month: '2018-11',
                        a: 0
                    },
                    {
                        month: '2018-12',
                        a: 0
                    }
                ];

                for (i = 0; i < data.length; i++) {
                    if (data[i].mesAlta != null) {
                        meses[data[i].mesAlta - 1].a = data[i].totalAlta;
                    }
                }

                config = {
                    data: meses,
                    xkey: 'month',
                    ykeys: ['a'],
                    labels: ['Altas'],
                    xLabelFormat: function(x) {
                        return months[x.getMonth()];
                    },
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['red'],
                    lineColors: ['#364C95']
                };
                config.element = 'area-chart_negocio';
                Morris.Area(config);

            },
            complete: function() {
                //dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //dialog.modal('hide');
                console.log(xhr);
                console.log("error");
                obtenerEstablecimientosEstadisticas();
            }
        });
    }
</script>

<!--=======ASOCIACIONES=======-->
<script type="text/javascript">
    $(function() {
        obtenerAsociacionesEstadisticas();
    });


    /* ADMINISTRACION DEL PERSONAL
    ==============================================================
    ==============================================================*/
    function obtenerAsociacionesEstadisticas() {
        var dialog;

        $.ajax({
            url: "{{ url('/') }}/res/administracion/dashboard/asociaciones/altas",
            type: 'GET',
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data);

                var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

                var meses = [{
                        month: '2018-01',
                        a: 0
                    },
                    {
                        month: '2018-02',
                        a: 0
                    },
                    {
                        month: '2018-03',
                        a: 0
                    },
                    {
                        month: '2018-04',
                        a: 0
                    },
                    {
                        month: '2018-05',
                        a: 0
                    },
                    {
                        month: '2018-06',
                        a: 0
                    },
                    {
                        month: '2018-07',
                        a: 0
                    },
                    {
                        month: '2018-08',
                        a: 0
                    },
                    {
                        month: '2018-09',
                        a: 0
                    },
                    {
                        month: '2018-10',
                        a: 0
                    },
                    {
                        month: '2018-11',
                        a: 0
                    },
                    {
                        month: '2018-12',
                        a: 0
                    }
                ];

                for (i = 0; i < data.length; i++) {
                    if (data[i].mesAlta != null) {
                        meses[data[i].mesAlta - 1].a = data[i].totalAlta;
                    }
                }

                config = {
                    data: meses,
                    xkey: 'month',
                    ykeys: ['a'],
                    labels: ['Altas'],
                    xLabelFormat: function(x) {
                        return months[x.getMonth()];
                    },
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['red'],
                    lineColors: ['#7E3695']
                };
                config.element = 'area-chart_asociaciones';
                Morris.Area(config);

            },
            complete: function() {
                //dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //dialog.modal('hide');
                console.log(xhr);
                console.log("error");
                obtenerAsociacionesEstadisticas();
            }
        });
    }
</script>



<!--=======CADENAS=======-->
<script type="text/javascript">
    $(function() {
        obtenerCadenasEstadisticas();
    });


    function obtenerCadenasEstadisticas() {
        var dialog;

        $.ajax({
            url: "{{ url('/') }}/res/administracion/dashboard/cadenas/altas",
            type: 'GET',
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data);

                var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

                var meses = [{
                        month: '2018-01',
                        a: 0
                    },
                    {
                        month: '2018-02',
                        a: 0
                    },
                    {
                        month: '2018-03',
                        a: 0
                    },
                    {
                        month: '2018-04',
                        a: 0
                    },
                    {
                        month: '2018-05',
                        a: 0
                    },
                    {
                        month: '2018-06',
                        a: 0
                    },
                    {
                        month: '2018-07',
                        a: 0
                    },
                    {
                        month: '2018-08',
                        a: 0
                    },
                    {
                        month: '2018-09',
                        a: 0
                    },
                    {
                        month: '2018-10',
                        a: 0
                    },
                    {
                        month: '2018-11',
                        a: 0
                    },
                    {
                        month: '2018-12',
                        a: 0
                    }
                ];
                for (i = 0; i < data.length; i++) {
                    if (data[i].mesAlta != null) {
                        meses[data[i].mesAlta - 1].a = data[i].totalAlta;
                    }
                }
                config = {
                    data: meses,
                    xkey: 'month',
                    ykeys: ['a'],
                    labels: ['Altas'],
                    xLabelFormat: function(x) {
                        return months[x.getMonth()];
                    },
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['red'],
                    lineColors: ['#00124D']
                };
                config.element = 'area-chart_cadenas';
                Morris.Area(config);

            },
            complete: function() {
                //dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //dialog.modal('hide');
                console.log(xhr);
                console.log("error");
                obtenerCadenasEstadisticas();
            }
        });
    }
</script>

<!--=======PLAZAS=======-->
<script type="text/javascript">
    $(function() {
        obtenerPlazasEstadisticas();
    });


    function obtenerPlazasEstadisticas() {
        var dialog;

        $.ajax({
            url: "{{ url('/') }}/res/administracion/dashboard/plazas/altas",
            type: 'GET',
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data);
                var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

                var meses = [{
                        month: '2018-01',
                        a: 0
                    },
                    {
                        month: '2018-02',
                        a: 0
                    },
                    {
                        month: '2018-03',
                        a: 0
                    },
                    {
                        month: '2018-04',
                        a: 0
                    },
                    {
                        month: '2018-05',
                        a: 0
                    },
                    {
                        month: '2018-06',
                        a: 0
                    },
                    {
                        month: '2018-07',
                        a: 0
                    },
                    {
                        month: '2018-08',
                        a: 0
                    },
                    {
                        month: '2018-09',
                        a: 0
                    },
                    {
                        month: '2018-10',
                        a: 0
                    },
                    {
                        month: '2018-11',
                        a: 0
                    },
                    {
                        month: '2018-12',
                        a: 0
                    }
                ];
                for (i = 0; i < data.length; i++) {
                    if (data[i].mesAlta != null) {
                        meses[data[i].mesAlta - 1].a = data[i].totalAlta;
                    }
                }

                config = {
                    data: meses,
                    xkey: 'month',
                    ykeys: ['a'],
                    labels: ['Altas'],
                    xLabelFormat: function(x) {
                        return months[x.getMonth()];
                    },
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['red'],
                    lineColors: ['#36955E']
                };

                config.element = 'area-chart_plazas';
                Morris.Area(config);
            },
            complete: function() {
                //dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //dialog.modal('hide');
                console.log(xhr);
                console.log("error");
                obtenerPlazasEstadisticas();
            }
        });
    }
</script>



<!--=======ALERTAS Y PRUEBAS=======-->
<script type="text/javascript">
    $(function() {
        obtenerAlertasPruebasEstadisticas();
    });


    function obtenerAlertasPruebasEstadisticas() {
        var dialog;

        $.ajax({
            url: "{{ url('/') }}/res/administracion/dashboard/alertaspruebas/altas",
            type: 'GET',
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data);
                var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

                var meses = [{
                        month: '2018-01',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-02',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-03',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-04',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-05',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-06',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-07',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-08',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-09',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-10',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-11',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-12',
                        a: 0,
                        b: 0
                    }
                ];

                for (i = 0; i < data.length; i++) {
                    if (data[i].mesAlarma != null) {
                        meses[data[i].mesAlarma - 1].a = data[i].totalAlarma;
                    }
                }

                for (i = 0; i < data.length; i++) {

                    if (data[i].mesPrueba != null) {
                        meses[data[i].mesPrueba - 1].b = data[i].totalPrueba;
                    }
                }

                config = {
                    data: meses,
                    xkey: 'month',
                    ykeys: ['a', 'b'],
                    labels: ['Alertas', 'Pruebas'],
                    xLabelFormat: function(x) {
                        return months[x.getMonth()];
                    },
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['blue'],
                    lineColors: ['gray', 'red']
                };
                config.element = 'area-chart_alertas_pruebas';
                Morris.Area(config);

            },
            complete: function() {
                //dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //dialog.modal('hide');
                console.log(xhr);
                console.log("error");
                obtenerAlertasPruebasEstadisticas();
            }
        });
    }
</script>

<!--=======ALERTAS EFECTIVAS Y NO EFECTIVAS=======-->
<script type="text/javascript">
    $(function() {
        obtenerAlertasEfectivasNoEfectivas();
    });


    function obtenerAlertasEfectivasNoEfectivas() {
        var dialog;

        $.ajax({
            url: "{{ url('/') }}/res/administracion/dashboard/alertas/efectivasNoEfectivas",
            type: 'GET',
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                console.log(data);
                var months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

                var meses = [{
                        month: '2018-01',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-02',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-03',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-04',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-05',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-06',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-07',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-08',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-09',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-10',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-11',
                        a: 0,
                        b: 0
                    },
                    {
                        month: '2018-12',
                        a: 0,
                        b: 0
                    }
                ];

                for (i = 0; i < data.length; i++) {
                    if (data[i].mesEfectiva != null) {
                        meses[data[i].mesEfectiva - 1].a = data[i].totalEfectiva;
                    }
                }

                for (i = 0; i < data.length; i++) {

                    if (data[i].mesNoEfectiva != null) {
                        meses[data[i].mesNoEfectiva - 1].b = data[i].totalNoEfectiva;
                    }
                }

                config = {
                    data: meses,
                    xkey: 'month',
                    ykeys: ['a', 'b'],
                    labels: ['Efectivas', 'No Efectivas'],
                    xLabelFormat: function(x) {
                        return months[x.getMonth()];
                    },
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['blue'],
                    lineColors: ['#971FA4', 'blue']
                };
                config.element = 'area-chart_alertas_efectivas_noEfectivas';
                Morris.Area(config);

            },
            complete: function() {
                //dialog.modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //dialog.modal('hide');
                console.log(xhr);
                console.log("error");
                obtenerAlertasEfectivasNoEfectivas();
            }
        });
    }
</script>
@endsection
