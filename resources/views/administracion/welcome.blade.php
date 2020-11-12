@extends('administracion.layout.master')
@section('titulo', 'Bienvenido')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Bienvenido')
@section('directorio')
    <li class="breadcrumb-item active">Bienvenido</li>
@endsection


@section('styles')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>
@endsection 


@section('content')
<div style="margin: 25px auto; width:95%;"><!-- ESTE PRIMER DIV ES NECESARIO SIEMPRE EN TODAS LAS VISTAS -->
    
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
 

    <!-- INVITACION -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Invitación
				<small>Breve introducción sobre el apartado de invitación</small>
			</h3> 
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item">
                        <a role="tab" href="#invitacionCreacion" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Creación
                        </a>
                    </li>
                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                    <div role="tabpanel" id="invitacionCreacion" class="tab-pane active">

                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>Contenido</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- NEGOCIOS -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Negocios
				<small>Breve introducción sobre el apartado de Negocios</small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item">
                        <a role="tab" href="#negociosDashboard" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#negociosCreacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Creación
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#negociosActualizacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Actualización
                        </a>
                    </li>
                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                
                    <!-- DASHBOARD -->
                    <div role="tabpanel" id="negociosDashboard" class="tab-pane active">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado se tienen las estadisticas generales de los negocios</p>
                            </div>
                        </div>
                    </div>

                    <!-- CREACION -->
                    <div role="tabpanel" id="negociosCreacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de creación</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actualizacion -->
                    <div role="tabpanel" id="negociosActualizacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de actualización</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div><!-- /NEGOCIOS -->


    <!-- Mercados -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Mercados
				<small>Breve introducción sobre el apartado de Mercados</small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item">
                        <a role="tab" href="#mercadosDashboard" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#mercadosCreacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Creación
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#mercadosActualizacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Actualización
                        </a>
                    </li>
                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                
                    <!-- DASHBOARD -->
                    <div role="tabpanel" id="mercadosDashboard" class="tab-pane active">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado se tienen las estadisticas generales de los mercados</p>
                            </div>
                        </div>
                    </div>

                    <!-- CREACION -->
                    <div role="tabpanel" id="mercadosCreacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de creación</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actualizacion -->
                    <div role="tabpanel" id="mercadosActualizacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de actualización</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div><!-- /MERCADOS -->




    <!-- ESCUELAS -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Escuelas
				<small>Breve introducción sobre el apartado de escuelas</small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">
                    <li class="nav-item">
                        <a role="tab" href="#escuelasDashboard" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#escuelasCreacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Creación
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#escuelasActualizacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Actualización
                        </a>
                    </li>
                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                
                    <!-- DASHBOARD -->
                    <div role="tabpanel" id="escuelasDashboard" class="tab-pane active">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado se tienen las estadisticas generales de los escuelas</p>
                            </div>
                        </div>
                    </div>

                    <!-- CREACION -->
                    <div role="tabpanel" id="escuelasCreacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de creación</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actualizacion -->
                    <div role="tabpanel" id="escuelasActualizacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de actualización</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div><!-- /ESCUELAS -->



    
    <!-- DASHBOARD -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Dashboard
				<small>Breve introducción sobre el apartado de Dashboard</small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">

                    <li class="nav-item">
                        <a role="tab" href="#dashboard" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Dashboard
                        </a>
                    </li>
                    
                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                
                    <!-- DASHBOARD -->
                    <div role="tabpanel" id="dashboard" class="tab-pane active">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado se tienen las estadisticas generales de los escuelas</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div><!-- /ESCUELAS -->




    <!-- encargados -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Encargados
				<small>Breve introducción sobre el apartado de encargados</small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">
                
                    <li class="nav-item">
                        <a role="tab" href="#encargadosCreacion" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Creación
                        </a>
                    </li>

                    <li class="nav-item">
                        <a role="tab" href="#encargadosActualizacion" data-toggle="tab" class="nav-link">
                            <i class="icon icon_house_alt"></i>Actualización
                        </a>
                    </li>

                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                
                    <!-- CREACION -->
                    <div role="tabpanel" id="encargadosCreacion" class="tab-pane active">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de creación</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actualizacion -->
                    <div role="tabpanel" id="encargadosActualizacion" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="105" data-plugin="custom-scroll" style="height: 150px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                <p>En este apartado de actualización</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div><!-- /encargados -->

    <!-- encargados -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Posibles Errores
				<small>Breve introducción sobre el apartado de errores</small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <table>
                <tr>
                    <th style="background:#0F1332;color:aliceblue" align="right"><center><strong><b>CÓDIGO DE ERROR</b></strong></center></th>
                    <th style="background:#0F1332;color:aliceblue;" align="right"><center><strong><b>DESCRIPCIÓN</b></strong></center></th>
                </tr>
                <tr>
                    <td>200</td>
                    <td>Es un código de respuesta, que nos ofrecerá el estatus ante una <strong><b>petición correcta</b></strong> a la que puede responder sin problemas.</td>
                </tr>
                <tr>
                    <td>210</td>
                    <td>El estatus del <strong><b>dispositivo esta en prueba,</b></strong> por lo cual no puedes emitir una alerta real.</td>
                </tr>
                <tr>
                    <td>401</td>
                    <td>Significa que <strong><b>no tienes permisos</b></strong> para acceder o crear algún apartado.</td>
                </tr>
                <tr>
                    <td>404</td>
                    <td>El Error 404 significa que la página que estaba intentando abrir, no pudo ser encontrada, puede deberse a un <strong><b>Error del usuario o programador</b></strong> es necesario verificar la URL de producción, para validar que esta sea la correcta.</td>
                </tr>
                <tr>
                    <td>415</td>
                    <td>El <strong><b>Negocio ha sido deshabilitado,</b></strong>no puedes emitir una alerta real.</td>
                </tr>
                <tr>
                    <td>416</td>
                    <td>El <strong><b>dispositivo ha sido deshabilitado,</b></strong>no puedes emitir una alerta real.</td>
                </tr>
                <tr>
                    <td>500</td>
                    <td>Generalmente cuando sucede esto es porque hay algún <strong><b>fallo en la programación,</b></strong>  o se ha llevado a cabo algún cambio en la plantilla o tema del sitio web,</td>
                </tr>
                <tr>
                    <td>501</td>
                    <td>Sucede esto es porque hay algún <strong><b>fallo en el Id negocio de la base de datos anterior.</b></strong> Comentar al administrador.</td>
                </tr>
                <tr>
                    <td>Mantenimiento</td>
                    <td>Es <strong><b>corte del servicio temporal,</b></strong>  conocido como “modo de mantenimiento”, que básicamente consiste en mostrar al usuario un mensaje informándole qué no puede acceder a la web de forma normal, por lo que se le están haciendo mejoras al sistema.</td>
                </tr>
              </table>
        </div>
    </div><!-- /encargados -->




</div><!-- /FINALIZA EL DIV PRINCIPAL -->
@endsection

  


@section('scripts')

@endsection
