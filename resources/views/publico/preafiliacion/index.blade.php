<!DOCTYPE html>
<html lang="en" class=" js no-touch">
<head>
  <title>{{ config('app.name') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="shortcut icon" href="{{ url('/') }}/public/favicon.ico" />

  <link rel="stylesheet" href="{{ url('/') }}/public/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/slick-team-slider.css"/>
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/style.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <!-- =======================================================
        Theme Name: Tempo
        Theme URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
<style>
.slick-prev:before,
      .slick-next:before {

        font-size: 60px;
        line-height: 1;
        opacity: 1;
        color: #ff149c;
    }

		.modal-body {
			height: 780px;
			overflow-y: scroll;
	}
	.carousel, .carousel-inner > .item > img {
          top: 20px;
         left: 10px;
        width: 900px;
        height: 600px;
        }

	.validacion{
         color:red;
         }

				          .content {
         border: 2px solid #4BB495;
         margin: 25px;
         font-size: 15px;
         line-height: 20px;
         padding: 0 20px;
         text-align: justify;
         }



         .p {
         text-indent: 60px;
         }
         ol.c {
         list-style-type: upper-roman;
         }

         ul.a {
         list-style-type: square;
}

</style>

</head>

<body>
	<!--HEADER START-->
	<div class="main-navigation navbar-fixed-top">
		<nav class="navbar navbar-default">
			<div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>
        <img src="{{ url('/') }}/public/img/logo.png" />
			  <!--<a class="navbar-brand" href="index.html">Gilberto</a>-->
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
			    <li class="active"><a href="#banner">Inicio</a></li>
			    <li><a href="#service">INFORMACIÓN</a></li>
			    <li><a href="#portfolio">Guía</a></li>
			    <li><a href="#version">Versión</a></li>
			    <li><a href="#about">Equipo</a></li>
			    <li><a href="#preregistro">Pre-Registro</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
	</div>
	<!--HEADER END-->

	<!--BANNER START-->
	<div id="banner" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="jumbotron">
				  <h1 class="small">Bienvenido a <span class="bold">{{ config('app.name') }}</span></h1>
				  <p class="big">MI POLICIA EN MI NEGOCIO.</p>
          <br>

		  
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
          <br>
          <br>



				</div>
			</div>
		</div>
	</div>
	<!--BANNER END-->

	
  <!--CTA1 START-->
	<div class="cta-1">
		<div class="container">
			<div class="row text-center white">
				<h1 class="cta-title">Subsecretaría de Inteligencia e Información Policial</h1>
				<p class="cta-sub-title">Dirección General de Tecnologías de la Información y Comunicaciones.</p>
				<p class="cta-sub-title">Innovación y Desarrollo.</p>
			</div>
		</div>
	</div>
	<!--CTA1 END-->




	<!--SERVICE START-->
	<div id="service" class="section-padding">
		<div class="container">

			<div class="row">
			
				<div class="page-title text-center">
					<h1>Información</h1>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>

	
	<!-- =======CAROUSE=========
	===========================-->
	<div class="col-md-12">

	<div id="myCarousel" style="width:100%" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="{{ url('/') }}/public/img/presentacion/1.jpg" alt="INFORMACION" style="width:100%;">
        <div class="carousel-caption">
          <h3>MI POLICIA EN MI NEGOCIO.</h3>
          <p></p>
        </div>
      </div>

      <div class="item">
        <img src="{{ url('/') }}/public/img/presentacion/2.jpg" alt="iNFORMACION2" style="width:100%;">
        <div class="carousel-caption">
          <h3>MI POLICIA EN MI NEGOCIO.</h3>
          <p></p>
        </div>
      </div>
    
      <div class="item">
        <img src="{{ url('/') }}/public/img/presentacion/3.jpg" alt="INFORMACION3" style="width:100%;">
        <div class="carousel-caption">
          <h3>MI POLICIA EN MI NEGOCIO.</h3>
          <p></p>
        </div>
      </div>
  
    </div>


    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <br></br>
  <br></br>
<!-- =======END CAROUSE=========
	===========================-->

	      <!-- MI POLICIA EN MI NEGOCIO -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> MI POLICÍA EN MI NEGOCIO </strong> </h3>
								<p>friend and colleague, Dave Paradi, conducts a
biennial poll on the aspects of PowerPoint that annoy people.
Most people talk with abstraction about their objections
with the software; Dave actually finds out and quantifies
it (thinkoutsidetheslide.com/survey2011.htm). And
since 2005, the issue of text on a slide—too much text, to
be specific—has never not been ranked in the top three of
PowerPoint annoyances.
So this topic strikes me as the ideal place to begin the discussion
on slide design. And because I’m not actually a
graphic designer by trade, I will not attempt to create jawdroppingly
beautiful slides that might inspire and intimidate
you.
Instead, my goal for everything we do in this chapter and
the ones that follow is to make you think hey, I can do that</p>

										<h5><strong>DOCUMENTACIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>SOFTWARE REQUERIDO EN EL SERVIDOR</strong></h5>

										<p align="justify"></p>
										<h5><strong>REQUERIMIENTOS DE LA APLICACIÓN (IIS, Framework, otros)</strong></h5>

										<p align="justify"></p>
										<h5><strong>DETALLE DEL ARCHIVO Y POSICION DE LA CADENA DE CONEXIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>CARACTERÍSTICAS DE LA COMPILACIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>DIAGRAMA DE BLOQUES DE LA SOLUCIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>DICCIONARIO DE DATOS</strong></h5>

										<p align="justify"></p>
										<h5><strong>DIAGRAMA DE BASE DE DATOS</strong></h5>

										<p align="justify"></p>
										<h5><strong>CODIGÓ FUENTE</strong></h5>
										
										<p align="justify"></p>
										<h5><strong>CODIGÓ FUENTE APP MOVIL</strong></h5>

										<p align="justify"></p>
							</div>
						</div>
					</div>

	 
	      <!-- MERCADO SEGURO -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> MERCADO SEGURO </strong> </h3>
								<p>friend and colleague, Dave Paradi, conducts a
biennial poll on the aspects of PowerPoint that annoy people.
Most people talk with abstraction about their objections
with the software; Dave actually finds out and quantifies
it (thinkoutsidetheslide.com/survey2011.htm). And
since 2005, the issue of text on a slide—too much text, to
be specific—has never not been ranked in the top three of
PowerPoint annoyances.
So this topic strikes me as the ideal place to begin the discussion
on slide design. And because I’m not actually a
graphic designer by trade, I will not attempt to create jawdroppingly
beautiful slides that might inspire and intimidate
you.
Instead, my goal for everything we do in this chapter and
the ones that follow is to make you think hey, I can do that</p>

										<h5><strong>DOCUMENTACIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>SOFTWARE REQUERIDO EN EL SERVIDOR</strong></h5>

										<p align="justify"></p>
										<h5><strong>REQUERIMIENTOS DE LA APLICACIÓN (IIS, Framework, otros)</strong></h5>

										<p align="justify"></p>
										<h5><strong>DETALLE DEL ARCHIVO Y POSICION DE LA CADENA DE CONEXIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>CARACTERÍSTICAS DE LA COMPILACIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>DIAGRAMA DE BLOQUES DE LA SOLUCIÓN</strong></h5>

										<p align="justify"></p>
										<h5><strong>DICCIONARIO DE DATOS</strong></h5>

										<p align="justify"></p>
										<h5><strong>DIAGRAMA DE BASE DE DATOS</strong></h5>

										<p align="justify"></p>
										<h5><strong>CODIGÓ FUENTE</strong></h5>
										
										<p align="justify"></p>
										<h5><strong>CODIGÓ FUENTE APP MOVIL</strong></h5>

										<p align="justify"></p>
							</div>
						</div>
					</div>
			</div><!--ROW-->
		</div>
	</div>
	<!--SERVICE END-->

	<!--preregistro START-->
	<div id="preregistro" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Pre-Registro</h1>
					<p>Si experimentas problemas con algun sistema <br> Envianos un correo.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
        
        <div id="sendmessage">Tu mensaje ha sido enviado! - Gracias</div>
        <div id="errormessage">Error</div>
				<!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
				@if(Session::has('mensaje'))
				<div class="alert alert-success">
						<strong>Actualizado! </strong> {{ Session::get('mensaje') }}
				</div>
				@endif
				<!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
				@if(Session::has('errores'))
				<div class="alert alert-danger">
						<strong>Cuidado! </strong> {{ Session::get('errores') }}
				</div>
				@endif

				

				<div class="form-sec">
				{{ Form::open(array('url'=>'/preafiliacion','role'=>'form' ,'method' => 'POST','enctype' => 'multipart/form-data','id' => 'regristro', 'onsubmit' =>'miFuncion()')) }}

         <div class="row">
            <div class="col-sm-4">

				<div class="form-group">
				<label for="nombre" style="color:darkcyan;" class="control-label"><strong style="color: red;"> * </strong>NOMBRE:</label>
				<input type="text" name="nombre" class="form-control text-field-box" id="nombre" placeholder="Tu Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('nombre') }}</div>
                @endif
				</div>

				<div class=" form-group">
				<label for="apellidoP" style="color:darkcyan;" class="control-label">APELLIDO PATERNO:</label>
				<input type="text" name="apellidoP" class="form-control text-field-box" id="apellidoP" placeholder="Apellido Paterno" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('apellidoP') }}</div>
                @endif
				</div>

				<div class="form-group">
				<label for="apellidoM" style="color:darkcyan;" class="control-label">APELLIDO MATERNO:</label>
				<input type="text" name="apellidoM" class="form-control text-field-box" id="apellidoM" placeholder="Apellido Materno" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('apellidoM') }}</div>
                @endif
				</div>

             </div>
               
             <div class="col-sm-4">
				<div class="form-group">
				<label for="nombreNegocio" style="color:darkcyan;" class="control-label"><strong style="color: red;"> * </strong>NOMBRE DEL NEGOCIO:</label>
				<input type="text" name="nombreNegocio" class="form-control text-field-box" id="nombreNegocio" placeholder="Nombre del Negocio" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				<div class="validation"></div>
				</div>

				<div class="form-group">
				<label for="telefono" style="color:darkcyan;" class="control-label">NÚMERO TELEFÓNICO:</label>
				<input type="text" name="telefono" class="form-control text-field-box" id="telefono" placeholder="Télefono" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('telefono') }}</div>
                @endif
				</div>

				<div class="form-group">
				<label for="extension" style="color:darkcyan;" class="control-label">NÚMERO DE EXTENSIÓN:</label>
				<input type="text" name="extension" class="form-control text-field-box" id="extension" placeholder="Número de Extensión" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('extension') }}</div>
                @endif
				</div>

            </div>

            <div class="col-sm-4">

				<div class="form-group">
				<label for="celular" style="color:darkcyan;" class="control-label">NÚMERO DE CELULAR:</label>
				<input type="text" name="celular" class="form-control text-field-box" id="celular" placeholder="Número de Celular" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('celular') }}</div>
                @endif
				</div>

				<div class="form-group">
				<label for="email" style="color:darkcyan;" class="control-label"><strong style="color: red;"> * </strong>CORREO ELECTRÓNICO:</label>
				<input type="email" class="form-control text-field-box" name="email" id="email" placeholder="Tu Correo" data-rule="email" data-msg="Please enter a valid email" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('email') }}</div>
                @endif
				</div>

				<div class="form-group">
				<label for="emailc" style="color:darkcyan;" class="control-label"><strong style="color: red;"> * </strong>CONFIRMACIÓN DE CORREO:</label>
				<input type="emailc" class="form-control text-field-box" name="emailc" id="emailc" placeholder="Confirmación del Correo" data-rule="email" data-msg="Please enter a valid email" />
				@if ($errors->has('nombre'))
                  <div class="alert alert-danger"><strong>Cuidado! </strong> {{ $errors->first('emailc') }}</div>
                @endif
				</div>
             </div>

				<div class="form-group-md">
                        <label for="delegacion" style="color:darkcyan;"><strong style="color: red;"> * </strong><center>DELEGACIÓN DONDE SE UBICA EL NEGOCIO, ESCUELA,MERCADO O PLAZA.</center></label>
                        <select class="form-control text-field-box" style="width: 100%;" name="delegacion" id="delegacion" class="form-control">
                           <option selected> Elige una opción </option>
                           @foreach($delegacionList as $del)
                           <option {{ (old("delegacion") == $del->getid() ? "selected" : "") }} value="{{$del->getId()}}">{{$del->getEtiqueta()}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('delegacion'))
                        <div class="alert alert-danger">
                           <strong>Cuidado! </strong> {{ $errors->first('delegacion') }}
                        </div>
                        @endif
                     </div>
			

			

               


    <!-- AVISO AVISO AVISO AVISO AVISO AVISO
 AVISO AVISO AVISO AVISO AVISO
  AVISO AVISO AVISO AVISO AVISO
================================== -->
    <section class="main-section alabaster" id="aviso">
        <!--main-section-start-->
        <div class="container">
            <center><h2>Aviso de Privacidad</h2></center>
            
            <div class="row">

                <div class="col-sm-12">                                                                                                                     
                    <!-- Petición de Inscripción   -->
              <div class="alert alert-dismissable alert-warning">
                <center>
              <button type="button" id="avisoPrivacidad" name="avisoPrivacidad" style="background-color:#34B7BF;color:white" >Leer el aviso de Privacidad</button>
              </br></br>
              <div class="form-group">
                <input type="checkbox" value="{!! old('avisodePrivacidad') !!}" name="avisodePrivacidad" id="avisodePrivacidad" required>
                <label for="avisodePrivacidad">Acepto el aviso de privacidad</label>
                </input>
                </center>
              </div>
              </div>
                </div>
     </div>

	 <div class="row">
                <div class="col-sm-4">
                </div>
				<div class="col-sm-4">
				<div class="g-recaptcha" data-sitekey="6LdtQ3QUAAAAAGkkN79g0JEBqXGdpfLOtPytF80o"></div>
                </div>
				<div class="col-sm-4">
                </div>   
    </div>

		<br><br>	

            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <button target="_blank" id="preregistro" type="submit" name="preregistro" style="background: rgba(231,15,137,1); float:left; color: white; width: 100%; height: 50px;border-radius: 45px" class="btn">Solicitar PreAfiliación</button>
                </div>
            </div>

        </div>
    </section>
    <!--main-section-end-->
                      
                     
	{{ Form::close() }}

        </div>
			</div>
		</div>
	</div>
	<!--preregistro END-->

	<!--FOOTER START-->
	<footer class="footer section-padding">
		<div class="container">
			<div class="row">
				<div style="visibility: visible; animation-name: zoomIn;" class="col-sm-12 text-center wow zoomIn">
					<h3>  Innovación y desarrollo  </h3>
					<div class="footer_social">
						<ul>
							<li><a class="f_facebook" href="#"><i class="fa fa-envelope"></i></a></li>
						</ul>
					</div>																
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</footer>
	<!--FOOTER END-->
	<div class="footer-bottom">
		<div class="container">
			<div style="visibility: visible; animation-name: zoomIn;" class="col-md-12 text-center wow zoomIn">
				<div class="footer_copyright">
					<p> ©Secretaría de Seguridad Pública CDMX Copyright.</p>					
					<div class="credits">
            Diseñado por <a href="#">Innovación y desarrollo</a>
          </div>
				</div>
			</div>
		</div>
	</div>

  <script src="{{ url('/') }}/public/js/jquery.min.js"></script>
  <script src="{{ url('/') }}/public/js/jquery.easing.min.js"></script>
  <script src="{{ url('/') }}/public/js/bootstrap.min.js"></script>
  <script src="{{ url('/') }}/public/js/jquery.mixitup.js" type="text/javascript"></script>
  <script src="{{ url('/') }}/public/js/slick.min.js" type="text/javascript" ></script>
  <script src="{{ url('/') }}/public/js/custom.js" type="text/javascript" ></script>



  <!--Validacion de JQuery-->
  <script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/localization/messages_es.js"></script>
<script src="{{ url('/') }}/public/assets/global/plugins/jquery-validation/additional-methods.js"></script>

  <script type="text/javascript" src="{{ url('/') }}/public/assets/global/js/global/bootbox.min.js"></script>

	<script type="text/javascript">

$("#avisoPrivacidad").click(function() {
bootbox.dialog({
	className : "my-custom-class",
	title: "<center><h3><b>Aviso de privacidad</b></h3></center>",
	message: '<b>Denominación del Responsable</b><br><br><p align="justify"><center><h2><b>“MI POLICÍA EN MI NEGOCIO”<b><h2></center><br><div class="box"><div class="left"><div class="content" ALIGN="justify"><h4>En el presente apartado le damos a conocer e informamos sobre nuestra Política de Privacidad, así como las condiciones de uso y funcionamiento para la Plataforma Tecnológica  <b>“MI POLICÍA EN MI NEGOCIO”.</b> Para la presente “Política de Privacidad” se entenderá por:</h4><br><h5><b>• 	Cuadrante: </b></h5><h5>División territorial en materia de seguridad considerando factores geográficos, incidencia delictiva, vialidades, habitantes y número de policías.</h5><br><h5><b>•	“MPN”:</b></h5><h5> Mi Policía en Mi Negocio. </h5><br><h5><b> •  SSPCDMX: </b></h5><h5> Secretaría de Seguridad Pública de la Ciudad de México.</h5><br><h5><b>•	 Usuario:</b></h5><h5> Aquella persona, nacional o extranjera que labore y/o sea dueño de un establecimiento ubicado en la Ciudad de México, que utiliza la Plataforma Tecnológica  “MPN”.</h5><br><h5><b>•	 UCS:</b></h5><h5> Unidad de Contacto del Secretario.</h5><br><h5><b>•  URL:</b></h5><h5> (Uniform Resource Locator) Localizador Uniforme de Recursos.</h5><br><h5><b>En el presente apartado se abordan los siguientes puntos:</b></h5><ol class="c"><li><h5>De “Mi Policía en Mi Negocio”</h5></li><br><li><h5>Del Objetivo</h5></li><br><li><h5>De la incorporación y Baja de los Establecimientos</h5></li><br><li><h5>Del Uso, Funcionamiento</h5></li><br><li><h5>De la protección de Datos Personales</h5></li><br><li><h5>De la Propiedad Intelectual</h5></li><br><li><h5>De las Responsabilidades y Garantías de Servicio</h5></ol><br><h5>•  Es importante mencionar que la información que se presenta en la presente sección podrá actualizarse y/o modificarse total o parcialmente, con o sin previo aviso, por lo que todos los usuarios de la plataforma tecnológica “MPN” deberán consultar la “Última actualización” ubicada en la parte final del presente apartado,  lo anterior con la finalidad de quedar debidamente enterados de cualquier cambio, actualización o modificación que se realice en relación a las Políticas de privacidad, así como cualquiera de los puntos mencionados en el párrafo anterior, ya que el uso continuado de nuestra tecnología “MPN” será considerado como la aprobación y aceptación de todos los cambios.</h5><h5> (Uniform Resource Locator) Localizador Uniforme de Recursos.</h5><br><h5><b>I.	DE “MI POLICÍA EN MI NEGOCIO”.</b></h5><h5>La SSPCDMX desde el mes de julio de 2014, pone a disposición de toda la población en general que laboren, representen o sean dueños de establecimientos en la Ciudad de México, una nueva forma de poder solicitar el auxilio de la policía capitalina, aprovechando al máximo las nuevas tecnologías en información y comunicaciones, denominada <b>“MI POLICÍA EN MI NEGOCIO”</b>.<b>“MPN”</b> es una herramienta tecnológica de seguridad diseñada, pensada y creada por la SSPCDMX, con una interfaz de fácil uso, logrando mediante la implementación de las nuevas tecnológicas, crear un medio de comunicación eficiente y oportuno, logrando con esto un mayor acercamiento entre los ciudadanos y la policía de la Ciudad de México. Con el desarrollo de la plataforma tecnológica “MPN”, esta Secretaría de Seguridad Pública ha logrado:</h5><br><h5> •	Dotar a los ciudadanos de la CDMX de una herramienta tecnológica para solicitar la presencia policial en los establecimientos;</h5><br><h5> •	Crear un medio de comunicación eficiente y oportuno, logrando un  contacto directo entre ciudadano/policía CDMX;</h5><br><h5> •	Mayor prontitud de atención a las emergencias;</h5><br><h5> •	Con un solo toque solicitar el auxilio policial.</h5><br><h5><b>•  URL:</b></h5><h5> (Uniform Resource Locator) Localizador Uniforme de Recursos.</h5><br><h5><b>“MPN”</b> es una herramienta tecnológica en materia de seguridad que funciona como unmedio de comunicación directo que vincula a los establecimientos con la SSPCDMX, puesto a disposición de todos los ciudadanos de la CDMX que así lo soliciten, que de acuerdo a sus necesidades y posibilidades, podrán contar con uno o más modos de activación como son: botón virtual (en Smartphone, PC o Tablet), botón físico (botón de pánico tradicional) o sensores magnéticos.<b>“MPN”</b>, cuyo servicio es totalmente gratuito, no se encuentra disponible en ninguna de las tiendas de aplicaciones, por lo que para contar con el botón virtual y/o físico, el interesado tendrá que solicitar a la SSPCDMX la incorporación de  su establecimiento a nuestra tecnología.<b>“MPN”</b> se suma a otras herramientas tecnológicas como la App <b>“MI POLICÍA”</b> y el número de <b>“Emergencia 911”</b>, por lo que el ciudadano no debe descartar hacer uso de ellas cuando su seguridad se encuentre en riesgo.</h5><br><br><h5><b>II.	DEL OBJETIVO.</b></h5><h5>•	Poner al alcance de los ciudadanos una herramienta tecnológica de seguridad que sea a su vez un medio de comunicación eficiente y oportuno;</h5><h5>• 	Acercar los servicios de la policía al ciudadano;</h5><h5>•    Reducir el tiempo de respuesta a las emergencias (cuando los factores y circunstancias así lo permitan, ver apartado VII. De las Responsabilidades y Garantías de Servicio);</h5><h5>•	Recibir de manera directa la solicitud de emergencias;</h5><h5>•  	Tener una mejor comunicación y coordinación entre el ciudadano y la policía;</h5><h5>•    Prevenir e inhibir el delito, por medio de una activación pronta y oportuna.</h5><br><h5><b>III.	DE LA INCORPORACIÓN Y BAJA DE LOS ESTABLECIMIENTOS</b></h5><h5> -De la “Incorporación”</h5><h5> Todas las personas mayores de edad, nacional o extranjero, que laboren o sea dueños de algún establecimiento podrán solicitar la incorporación de los establecimientos localizados en la Ciudad de México a “MPN”, llevando a cabo los siguientes pasos:</h5><br><br><h5><b>1.	Requisitar el formato de “Solicitud de incorporación” (Word):</b> Este documento debe ser necesariamente requisitado por el interesado e ingresado en el área de Oficialía de Partes de la SSPCDMX, ubicada en Calle Liverpool #136 Col. Juárez, Planta Baja, de lunes a viernes de 09:00 a 18:00 horas. </h5><h5><b>2.	Requisitar el formato “Datos Generales MPN” (Excel):</b> en este archivo registrará toda la información necesaria del establecimiento a incorporarse a “MPN” para llevar a cabo la creación de las “URL”, el cual es necesario para configurar los dispositivos móviles y/o botones físicos (este archivo se remite vía correo electrónico al servidor público que este coordinando su incorporación).</h5><h5><b>3.	Recibir el Curso de Inducción-Capacitación en el que se abordarán los siguientes puntos:</b></h5><h5>•	Funcionamiento de la Plataforma <b>“MPN”</b></h5><br><h5>•	Configuración de los equipos celulares y de computo</h5><br><h5>•	Modos de Activación de las alertas silenciosas (Fase 1 y Fase 2)</h5><br><h5>•	Pruebas de funcionamiento del botón virtual</h5><br><h5>•	Derechos, obligaciones y uso responsable de “MPN”.</h5><br><h5>Los formatos de <b>“Solicitud de incorporación”</b> podrán ser proporcionados por personal autorizado de la SSPCDMX.</h5><h5>En todo el proceso de incorporación, el ciudadano interesado en integrarse a <b>“MPN”</b> se coordinará con un servidor público debidamente identificado perteneciente a la SSPCDMX, quien desde el principio y hasta el final de dicho proceso, le asesorará, guiará y capacitará, para un adecuado, eficiente y pronta integración a <b>“MPN”</b>.</h5><h5>Cuando la SSPCDMX reciba una solicitud de incorporación se pondrá en contacto con el interesado vía telefónica y correo electrónico para dar inicio con la etapa de coordinación de información.</h5><h5>Una vez enviado el primer correo electrónico al interesado, este tendrá tres días hábiles para responder al mismo con la información requerida, por lo que al no remitir dicha información, esta SSPCDMX enviará hasta tres recordatorios de solicitud de información, con lo que al hacer caso omiso del último correo electrónico (<b>“3er. Recordatorio”</b>), esta se tomará como perdida de interés para la incorporación a <b>“MPN”</b>, dejando sin efecto la solicitud de incorporación. En dado caso de que el ciudadano quisiera nuevamente integrarse a <b>“MPN”</b>, este tendría que ingresar nuevamente el oficio de  <b>“Solicitud de incorporación”</b>.</h5><h5>La prontitud de incorporación de los establecimientos a <b>MPN”</b> una vez ingresado la solicitud de incorporación, dependerá de los siguientes factores:</h5><h5>•	Estar atento a la recepción del primer correo electrónico por parte de la SSPCDMX (algunos correos llegan a la “Bandeja de correo no deseado” o “Spam”)</h5><br><h5>•	Remitir en tiempo los datos del establecimiento (archivo Excel) para su validación (vía correo electrónico);</h5><br><h5>•	Que los datos proporcionados del establecimiento sean los correctos;</h5><br><h5>•	Disponibilidad de tiempo del interesado para recibir el curso de Inducción-Capacitación <b>“MPN”</b>.</h5><br><h5>-De la <b>“Baja de los Establecimientos”</b></h5><h5>Previa solicitud por escrito y debidamente identificados, los dueños o representantes de cada establecimiento podrán dar de baja a los mismos de <b>“MPN”</b> o solicitar el cambio de URL de producción.</h5><br><h5><b>IV.	DEL USO Y FUNCIONAMIENTO.</b></h5><h5>Los usuarios de <b>“MPN”</b> podrán utilizar el servicio en toda la Ciudad de México, la cual a su vez se encuentra dividida en 847 cuadrantes de seguridad, operando las 24 horas los 365 días del año. Una vez activada la alerta de <b>“MPN”</b>, está no podrá cancelarse, con lo cual se mandará una señal a Puesto de Mando de la SSPCDMX, quien recibe y canaliza la emergencia al policía más cercano al lugar donde se haya activado dicha alerta. El usuario podrá activar las alertas de <b>“MPN”</b> en los siguientes supuestos:</h5><h5>•	Robo con y sin  violencia;</h5><h5>•	Presuntos  sospechosos;</h5><h5>•	Personas que se niegan a pagar;</h5><h5>•	Farderos;</h5><h5>•	Personas alterando el orden público en el establecimiento;</h5><h5>•	Clonadores  de tarjetas  de  crédito;</h5><h5>•	Agresiones en el interior del establecimiento;</h5><h5>•	Extorsión.</h5><br><h5>Para el funcionamiento adecuado de esta tecnología, el usuario deberá:</h5> <h5>•	Tener acceso a internet o datos en cualquiera de sus dispositivos fijos o móviles;</h5><br><h5>•	Contar con un Smartphone (celular) o tableta con sistema operativo Android, iOS o Windows Phone y/o equipo de cómputo;</h5><br><h5>•	Llevar a cabo una adecuada configuración del botón virtual o físico.</h5><br><h5>•	Realizar pruebas de funcionamiento de <b>“MPN”</b> para confirmar una adecuada conexión del dispositivo con la SSPCDMX.</h5><br><h5><b>Se podrá llevar a cabo la activación de las alertas MPN de la siguiente manera:</b></h5><h5><b>1.	Fase</b></h5><h5><b>1.-</b> De manera virtual: por medio del Smartphone (celulares) o tabletas y por medio del equipo de cómputo (dando doble clic o por combinación de teclas)</h5><h5><b>2.	Fase</b></h5><h5><b>2.-</b> Por medios físicos electrónicos: botón de pánico tradicional y sensores (magnéticos, de movimiento e infrarrojo) </h5><br><h5>En caso de que el usuario le interesase la <b>Fase 2</b>, este tendrá que cubrir el costo de los materiales y adquirirlos con el proveedor que mejor le convenga, en el entendido que esta SSPCDMX no tiene ningún acuerdo, convenio, trato, pacto, compromiso o arreglo con establecimiento alguno para la adquisición, venta o distribución de ningún material electrónico en referencia a <b>“MPN”</b>;  los materiales tendrán que cumplir con las especificaciones técnicas y cantidades que la SSPCDMX ha preestablecido mediante una Lista de Materiales, el cual será proporcionado al dueño, representante o encargado del establecimiento que así lo solicite. La SSPCDMX le orientará, guiará y apoyará en el armado del botón físico, procediendo a su configuración y realización de pruebas de funcionamiento.</h5><br><h5><b><u>V.	DE LA PROTECCIÓN DE DATOS PERSONALES.</u></b></h5><h5><u>La SSPCDMX protegerá, incorporará y dará el tratamiento adecuado a los <b>“Datos Personales”</b> que se pudieran generar por la realización de solicitudes de incorporación, de los obtenidos a través del archivo en Excel <b>“Datos Generales”</b>, así como de los derivados por la atención a las emergencias en los establecimientos, de conformidad con la Ley de Protección de Datos Personales para el Distrito Federal.</u></h5><br><h5><b>A.</b>	Los datos recopilados para la incorporación a <b>“MPN”</b> son:</h5><ol class="c"><li><h5><b>Del solicitante:</b>nombre, número telefónico, correo electrónico, cargo.</h5></li><li><h5><b>Del establecimiento:</b> nombre, razón social, asociación, cadena, tipo de negocio, giro del negocio,  dirección, número telefónico, coordenadas y referencias de ubicación.</h5></li><li><h5><b>Del encargado:</b> nombre, número telefónico, correo electrónico, cargo.</h5></li></ol><br><h5><u>La información obtenida de los establecimientos y de los usuarios serán utilizados para generar la URL de producción <b>“MPN”</b>, dicha URL será esencial para configurar los dispositivos móviles, de cómputo y botones físicos.</u></h5><br><h5><b>B.</b>	Cuando se lleve a cabo la atención a una emergencia, la SSPCDMX recopilará en campo, los datos siguientes:</h5><br><ol class="c"><li><h5><b>Del establecimiento:</b> nombre, giro del negocio,  dirección, número telefónico.</h5></li><li><h5><b>Del responsable del negocio:</b> nombre, número telefónico, correo, cargo.</h5></li><li><h5><b>Breve descripción de lo acontecido.</b></h5></li></ol> <br> <h5>Los datos que se mencionan en el apartado <b>B</b> tendrán la siguiente finalidad:</h5><br><ul class="a"> <li><h5>Generar estadísticas de carácter informativo, como son: tipos de alertas, tiempo promedio de atención; niveles de incidencia delictiva.</h5></li> <li><h5>Creación de un reloj victimológico</h5></li> <li><h5>Generación de inteligencia para la implementación de dispositivos de seguridad.</h5></li></ul><br> <h5><u>Los datos especificados en el apartado A y B serán ingresados a una base de datos <b>“MPN”</b> administrada y resguardada por la Secretaría de Seguridad Pública a través del área de Innovación y Desarrollo. El titular de los mismos podrá actualizar o dar de baja la información proporcionada en cualquier momento, para lo cual tendrá que hacer la solicitud vía telefónica al 5242-5100 Ext. 5285 o al correo jgcolin@ssp.cdmx.gob.mx, dirigido al C. Gilberto Colín Velasco, JUD de Innovación y Desarrollo de la SSPCDMX. Toda la información y/o datos no serán difundidos ni compartidos sin el consentimiento expreso del titular, salvo en las excepciones previstas por la ley. </u></h5><br><h5><b>VI.	DE LA PROPIEDAD INTELECTUAL.</b></h5> <br> <h5>Todo el material informático, código fuente, software, diseños gráficos, imágenes, fotografías, sonidos, animaciones, textos, nombre, así como la información y los contenidos puestos a disposición del usuario mediante <b>“MPN”</b>, están protegidos por derechos de autor y/o propiedad industrial cuyo titular es la Secretaría de Seguridad Pública de la Ciudad de México, y únicamente se permite su uso con fines de seguridad pública y/o consulta, quedando estrictamente prohibido su uso y/o reproducción total o parcial con fines comerciales y distintos de los previstos; su modificación, transformación o de compilación, será realizada única y exclusivamente por la propia SSPCDMX.</h5><h5>Todos los derechos derivados de la propiedad intelectual de <b>“Mi Policía en Mi Negocio”</b> están expresamente reservados para la Secretaría de Seguridad Pública de la Ciudad de México. </h5><br> <h5><b>VII.	DE LAS RESPONSABILIDADES Y GARANTÍAS DE SERVICIO.</b></h5> <br><h5>El peticionario, dueño, representante, encargado o usuario final, será en todo momento responsable del uso legítimo que se haga de <b>“MPN”</b>, por lo que este debe considerar los siguientes puntos:</h5><br><ul class="a"><li><h5>Hacer un uso responsable de la activación de las alertas;</h5></li><li><h5>Tener un control interno de las personas que les comparten la URL;</h5></li><li><h5>Informará a la SSPCDMX cualquier anomalía que detecte respecto al funcionamiento de <b>“MPN”</b>;</h5></li><li><h5>Atender al personal policial que cubre la emergencia;</h5></li>'+
           '<li><h5>Atender al personal policial que cubre la emergencia;</h5></li></ul><br><h5>En caso de ser necesario, previa petición del usuario y con aprobación del titular de la JUD de Innovación y Desarrollo, se podrá sustituir la URL que le corresponde aun establecimiento en particular.</h5><br><h5>El usuario deberá realizar pruebas de funcionamiento del botón virtual de manera periódica, con el objetivo de verificar su funcionamiento adecuado, por lo que antes deberá de leerlos manuales, guías y protocolos que esta SSPCDMX pone a su disposición.</h5><br><h5>La SSPCDMX, se reserva el derecho de suspender temporal o definitivamente con o sin previo aviso el uso y acceso a la plataforma <b>“MPN”</b> cuando se detecte un uso inadecuado o no responsabledel servicio del botón de emergencia o se constate un uso con fines distintos a los autorizados, respetando en todo momento el derecho que tiene el usuario de  realizar las aclaraciones que crea convenientes.</h5>              <br><h5>De igual manera, se podrá suspender de forma temporal, con o sin previo aviso el uso de <b>“MPN”</b> por motivos de operaciones de mantenimiento, reparación, actualización o mejora del sistema,por lo que el usuario no deberá descartar usar la App <b>“Mi Policía”</b> o marcar al <b>911</b>, en caso necesario, que sumados a otras tecnologías forman un sistema integral de seguridad. </h5><br><h5>Para una eficiente y pronta atención a las emergencias mediante la plataforma  <b>“MPN”</b>, se considerarán los siguientes factores:</h5><br><ul class="a"><li><h5>Activaciones responsables del botón de emergencia;</h5></li><li><h5>Número de policías designados a un cuadrante;</h5></li><li><h5>Ubicación y/o dimensión del cuadrante;</h5></li><li><h5>Facilidad de acceso al lugar requerido;</h5></li><li><h5>Hora del día;</h5></li><li><h5>Cierres o bloqueos de calles, avenidas, etc.;</h5></li><li><h5>Una comunicación adecuada;</h5></li><li><h5>Datos correctos del establecimiento (Nombre, coordenadas, referencias, etc);</h5></li><li><h5>Emergencias simultaneas en un cuadrante.</h5></li></ul><h5>Esta <b>Secretaría de Seguridad Pública</b> no se hace responsable por cualquier daño que pudiera sufrir o surgir en cualquiera de los dispositivos móviles o equipos de cómputo en el que se instale el botón virtual <b>MPN</b> (<b>Fase 1</b>), por lo que el usuario en todo momento deberá tomar las medidas preventivas pertinentes necesarias para evitar que cualquier programa informático malicioso (virus) dañe, afecte o altere el funcionamiento de dicho equipo. </h5><br><h5>La SSPCDMX, no garantiza el funcionamiento adecuado en los dispositivos móviles o equipo de cómputo, en los cuales se haga uso de <b>“MPN”</b>, considerando en el presente punto los siguientes aspectos:</h5><br><ul class="a"><li><h5>Servicio de internet o paquetes de datos contratados; </h5></li><li><h5>Versión del Software del dispositivo;</h5></li><li><h5>Compatibilidad del sistema;</h5></li><li><h5>Autorización de consumo de datos;</h5></li><li><h5>Permisos del sistema para un adecuado funcionamiento;</h5></li><li><h5>Fallas de conexión;</h5></li><li><h5>Entre otros.</h5></li></ul><br><h5>Todos los servicios que se ofrece esta SSPCDMX a través de la plataforma <b>“MPN”</b> son totalmente gratuitos, ajenos a todo tipo de condición, por lo que el usuario podrá reportar cualquier anomalía o situación que detecte a la UCS, en un horario de atención 24 horas / 7 días: </h5><ul class="a"><li><h5 class="fa fa-phone"> 5208-9898</h5></li><li><h5 class="fa fa-envelope"> ucontacto@ssp.df.gob.mx</h5></li><li><h5 class="fa fa-twitter"> @UCS_CDMX</h5></li></ul><h5>Al hacer uso de la plataforma <b>“MPN”</b>, el usuario se da por enterado y acepta las políticas sobre el <b>“Aviso de Privacidad y Condiciones de Uso”</b>, de las cuales esta Secretaría de Seguridad Pública se reserva el derecho de modificar total o parcialmente, con o sin previo aviso. En este sentido, el usuario deberá consultar periódicamente la fecha de actualización del presente documento, a fin de quedar debidamente enterado sobre cualquier cambio que se pudiera realizar en relación al mismo, ya que el uso continuado de <b>“MPN”</b> será considerado como la aprobación y aceptación de dichos cambios.</h5>',
		buttons: {
			success: {
				label: "Entendido",
				className: "btn-primary",
				callback: function() {
					$('.bootbox').modal('hide');
				}
			}
		}
	});
});
</script>


<script>
  function miFuncion() {
    var response = grecaptcha.getResponse();

    if(response.length == 0){
      alert("Captcha no verificado")
    } else {
      alert("Captcha verificado");
    }
  }
</script>


<script>
    $(document).ready(function() {

        $('#regristro').validate({
            rules: {

        
							nombre: {
								required: true,
								maxlength: 200
						 },
		
						 apellidoP: {
								required: true,
								maxlength: 200
						 },
		
						 apellidoM: {
								required: true,
			maxlength: 200
						 },
		
						 nombreNegocio: {
								required: true,
								maxlength: 30
						 },
								 
						 telefono: {
								required: true,
								digits: true,
								minlength: 8
						 },

		 celular: {
								required: true,
								digits: true,
								minlength: 10
						 },

		 email: {
								required: true,
								email: true
						 },
		
	 },
		
					messages: {
		
						 nombre: {
								required: jQuery.validator.format('<div class="validacion">El campo Nombre es requerido </div>'),
								maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
						 },
		
						 apellidoP: {
								required: jQuery.validator.format('<div class="validacion">El campo Apellido Paterno es requerido </div>'),
								maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
						 },

		 apellidoM: {
								required: jQuery.validator.format('<div class="validacion">El campo Apellido Materno es requerido </div>'),
								maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 200 caracteres</div>')
						 },

		 nombreNegocio: {
								required: jQuery.validator.format('<div class="validacion">El campo Nombre del Negocio es requerido </div>'),
								maxlength: jQuery.validator.format('<div class="validacion">El máximo permitido son 30 caracteres</div>')
						 },

		 telefono: {
								required: jQuery.validator.format('<div  class="validacion">El campo Número Teléfonico es requerido </div>'),
								digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>'),
								minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 8 digitos</div>')
						 },

		 celular: {
								required: jQuery.validator.format('<div  class="validacion">El campo Número de Celular es requerido </div>'),
								digits: jQuery.validator.format('<div class="validacion">Sólo acepta números </div>'),
								minlength: jQuery.validator.format('<div class="validacion">El mínimo permitido son 10 digitos</div>')
						 },
		
						 email: {
								required: jQuery.validator.format('<div class="validacion">El campo Correo es requerido </div>'),
								email: jQuery.validator.format('<div class="validacion">Por favor introduzca un correo válido"</div>')
						 },
		
					},
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
    
</body>
</html>