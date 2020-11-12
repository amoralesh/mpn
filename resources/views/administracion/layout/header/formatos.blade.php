

                <div class="float-default mail">
                    <div class="right-icon">
                        <a href="javascript:void(0)" data-toggle="dropdown" data-open="true" aria-expanded="true">
                            <i class="fa fa-file-excel-o"></i>
                            <span class="mail-no">2</span>
                        </a>
                        <div class="dropdown-menu messagetoggle" role="menu">
                            <div class="nav-tab-horizontal">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#messages"
                                           role="tab">DESCARGAR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#resendmessage"
                                           role="tab">SUBIR</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="messages" role="tabpanel" data-plugin="custom-scroll" data-height="320">
                                    <ul class="userMessagedrop">
                                           
        <!-- DESCARGAR FORMATO
          ==========================================================================================
          ========================================================================================== -->
         @if( in_array( 'Administracion:Header:Descargar:Formato:Establecimiento' , Session::get('permisos') ) ) 
                                        <li>
                                            <a href="{{ url('/') }}/generar/excel/establecimiento" method="get">
                                                <div class="media">
                                                    <div class="media-left float-xs-left">
                                                        <span class="label label-primary"><i
                                                                class="icon_download"></i></span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6>Formato</h6>
                                                        <p>Mi Policía en mi Negocio</p>
                                                        <div class="meta-tag text-nowrap">
                                                            <time datetime="2016-12-10T20:27:48+07:00"
                                                                  class="text-muted">Mi Policía en mi Negocio
                                                            </time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <center><p>Última actualización 18/Dic/2017</p></center>
                                        </li>
        @endif

                                    </ul>
                                </div>
                                <div class="tab-pane" id="resendmessage" role="tabpanel" data-plugin="custom-scroll" data-height="320">
                                    <ul class="userMessagedrop">
        <!-- SUBIR INFORMACION
          ==========================================================================================
          ========================================================================================== -->
         @if( in_array( 'Administracion:Header:Cargar:Establecimientos' , Session::get('permisos') ) ) 
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <div class="media-left float-xs-left">
                                                        <span class="label label-primary"><i
                                                                class="icon_upload"></i></span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6>Cargar Información</h6>
                                                        <p>
 {{ Form::open(array('url'=>'/establecimientos/carga/masiva','method'=>'POST', 'target' => '_blank', 'accept-charset'=>'UTF-8', 'files'=>true)) }}
 <input id="negocio" name="negocio" type="file" multiple class="file-loading"></input>
 <br>
 <button type="submit" class="btn btn-primary">Subir</button>
{{  Form::close() }}</p>
                                                        <div class="meta-tag text-nowrap">
                                                            <time datetime="2016-12-10T20:27:48+07:00"
                                                                  class="text-muted">Mi Policía en mi Negocio
                                                            </time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
          @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       
       