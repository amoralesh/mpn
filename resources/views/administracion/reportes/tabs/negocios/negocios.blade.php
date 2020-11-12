  

    <!-- NEGOCIOS -->
    <div class="box">
        <div class="box-header">
			<h3 class="box-title">Negocios
				<small>Selecciona </small>
			</h3>
		</div>
        <!-- /.box-header -->
		<div class="box-body pad">
        
            <div class="nav-tab-pills-image">
                <ul role="tablist" class="nav nav-tabs">

                    <li class="nav-item">
                        <a role="tab" href="#negociosAlertas" data-toggle="tab" class="nav-link active">
                            <i class="icon icon_house_alt"></i>Alertas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" href="#negociosPruebas" data-toggle="tab" class="nav-link ">
                            <i class="icon icon_house_alt"></i>Pruebas
                        </a>
                    </li>
                
                </ul>
                <div class="divider15"></div>
                <div class="tab-content">
                
                    <!-- ALERTAS -->
                    <div role="tabpanel" id="negociosAlertas" class="tab-pane active">
                        <div class="pills-height">
                            <div data-height="1000" data-plugin="custom-scroll" style="height: 1000px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                @include('administracion.reportes.tabs.negocios.tabs.alertas')        
                            </div> 
                        </div> 
                    </div> 
                    
                    <!-- PRUEBAS -->
                    <div role="tabpanel" id="negociosPruebas" class="tab-pane">
                        <div class="pills-height">
                            <div data-height="1000" data-plugin="custom-scroll" style="height: 1000px;" class="ps-container ps-theme-default ps-active-y" data-ps-id="5edeb2f7-9e1f-7ee7-3de9-f24b4c579c4e">
                                  
                            </div> 
                        </div>
                    </div> 
                    
                    
                </div>
            </div>
            
        </div>
    </div><!-- /NEGOCIOS -->