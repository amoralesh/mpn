 <!DOCTYPE html>
<html lang="en" class=" js no-touch">
<head>
<title>{{ config('app.name') }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="{{ url('/') }}/public/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ url('/') }}/public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/slick-team-slider.css"/>
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/style.css">
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
			    <li><a href="#service">Sistema</a></li>
			    <li><a href="#portfolio">Guía</a></li>
			    <li><a href="#version">Versión</a></li>
			    <li><a href="#about">Equipo</a></li>
			    <li><a href="#contact">Soporte</a></li>
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
				  <p class="big">Innovación y desarrollo .</p>
          <br>
          <br>
          <br>
          <secion id="login">
              <h3 style="color:white;" class="animated fadeInDown delay-07s">Inicia sesión en {{ config('app.name') }}</h3>
              <div  class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 login">
								
												<!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
												@if(Session::has('mensaje'))
													<div class="alert alert-success">
														<strong>Ok! </strong> {{ Session::get('mensaje') }}
													</div>
												@endif
												<!--si el registro se lleva a cabo, mostramos el mensaje que envíamos desde el controlador formularios-->
												@if(Session::has('errores'))
													<div class="alert alert-danger">
																<strong>Cuidado! </strong> {{ Session::get('errores') }}
													</div>
												@endif
  
                        {{  Form::open([ 'url' => ['/login' ] , 'class' => 'form-horizontal' , 'method' => 'POST' ]) }}
												
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                    <label for="usuario" style="color:white;" class="control-label">Usuario o correo</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                    <input id="usuario" class="form-control" name="usuario" value="" type="text" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                    <label for="password" style="color:white;" class="control-label">Contraseña</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                    <input id="password" class="form-control" name="password" type="password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-banner" >Iniciar sesión <i class="fa fa-send"></i></button >
                        {{ Form::close() }}
                </div>
              </div>
          </secion><!--LOGIN-->
				</div>
			</div>
		</div>
	</div>
	<!--BANNER END-->

	
  <!--CTA1 START-->
	<div class="cta-1">
		<div class="container">
			<div class="row text-center white">
				<h1 class="cta-title">Subsecretaría de inteligencia policial</h1>
				<p class="cta-sub-title">Dirección General de tecnologias de la informacion y comunicaciones.</p>
			</div>
		</div>
	</div>
	<!--CTA1 END-->



	<!--SERVICE START-->
	<div id="service" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Sistema</h1>
					<p>Breve descripción de lo que trata el sistema.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
	      <!-- FECHA PROGRAMADA A LANZAR -->
				<div class="col-md-3">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-calendar"></i></div>
						<div class="service-text">
							<h3>Fecha Programada a lanzar</h3>
							<p>26/01/2017.</p>
						</div>
					</div>
				</div>
	      <!-- FECHA DE LANZAMIENTO-->
				<div class="col-md-3">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa fa-calendar"></i></div>
						<div class="service-text">
							<h3>Fecha de Lanzamiento</h3>
							<p>Sin fecha</p>
						</div>
					</div>
				</div>
	      <!-- APLICACION MOVIL -->
				<div class="col-md-3">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-android"></i></div>
						<div class="service-text">
              <h3>Aplicación Movil</h3>
              <p>El sistema no cuenta con aplicación movil.</p>
						</div>
					</div>
				</div>
	      <!-- APLICACION MOVIL -->
				<div class="col-md-3">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-medkit"></i></div>
						<div class="service-text">
              <h3>Estatus del sistema</h3>
              <p>En desarrollo.</p>
						</div>
					</div>
				</div>
			</div><!--ROW-->
      <div class="row">
				<div class="page-title text-center">
					<h1>Trabajo Realizado</h1>
					<p>El sistema esta diseñado con seguridad Https, con frameworks como laravel, bases de datos mysql, sql server, java y android.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>

	      <!--SEGURIDAD -->
				<div class="col-md-4">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-shield"></i></div>
						<div class="service-text">
							<h3>Seguridad</h3>
              <p>El sistema cuenta con seguridad HTTPS. significa que toda la información viaja encriptada para mayor seguridad </p>
						</div>
					</div>
				</div>

	      <!--RESTRICCIONES Y BITACORAS-->
				<div class="col-md-4">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa fa-lock"></i></div>
						<div class="service-text">
              <h3>Restricciones y bitacoras</h3>
              <p>El sistema cuenta con permisos y roles por usuario asi como una bitacora para monitorear al cada usuario.</p>
						</div>
					</div>
				</div>

	      <!-- RAPIDEZ -->
				<div class="col-md-4">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-dashboard"></i></div>
						<div class="service-text"> 
              <h3>Rapidez</h3>
              <p>El sistema esta hecho de tal forma que cada vez que consultes información este respondera de una manera mas rapida.</p>
						</div>
					</div>
				</div>
			</div><!--ROW-->
		</div>
	</div>
	<!--SERVICE END-->



	<!--PORTFOLIO START-->
	<div id="portfolio" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Guía</h1>
					<p>Breve guía de como usar el sistema.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
				<div class="port-sec">
					<div class="col-md-12 fil-btn text-center">
							<div class="filter wrk-title active" data-filter="all">Ver todos</div>
							<div class="filter wrk-title" data-filter=".category-1">Design</div>
							<div class="filter wrk-title" data-filter=".category-2">Development</div>
							<div class="filter wrk-title lst-cld" data-filter=".category-3">SEO</div>
					</div>
					<div id="Container">
								<div class="filimg mix category-1 category-3 col-md-4 col-sm-4 col-xs-12" data-myorder="2">
									<img src="{{ url('/') }}/public/img/guia/1.png" class="img-responsive" width="300px" height="300px"> 
								</div>
								<div class="filimg mix category-2 col-md-4 col-sm-4 col-xs-12" data-myorder="4">
									<img src="{{ url('/') }}/public/img/guia/2.png" class="img-responsive" width="300px" height="300px">
								</div>
								<div class="filimg mix category-1 col-md-4 col-sm-4 col-xs-12" data-myorder="1">
									<img src="{{ url('/') }}/public/img/guia/3.png" class="img-responsive" width="300px" height="300px">								</div>
								<div class="filimg mix category-2 category-3 col-md-4 col-sm-4 col-xs-12" data-myorder="8">
									<img src="{{ url('/') }}/public/img/guia/4.png" class="img-responsive" width="300px" height="300px">								</div>
								<div class="filimg mix category-2 col-md-4 col-sm-4 col-xs-12" data-myorder="8">
									<img src="{{ url('/') }}/public/img/guia/4.png" class="img-responsive" width="300px" height="300px">
								</div>
								<div class="filimg mix category-2 category-3 col-md-4 col-sm-4 col-xs-12" data-myorder="8">
									<img src="{{ url('/') }}/public/img/guia/4.png" class="img-responsive" width="300px" height="300px">
								</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--PORTFOLIO END-->



	<!--SERVICE START-->
	<div id="version" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Versionamiento del sistema</h1>
					<p>Estas son las mejoras que ha tenido el sistema.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>

	      <!-- VERSION -->
				<div class="col-md-12">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-code"></i></div>
						<div class="service-text">
							<h3>Version 5</h3>
							<li>5.0.0.0- Se da inicio al sistema, se crea el apartado de usuarios , dispositivos y usuarios del sistema, asi como la generación de la base de datos</li>
              <li>5.0.0.0- Se da inicio al sistema, se crea el apartado de usuarios , dispositivos y usuarios del sistema, asi como la generación de la base de datos</li>
							<li>5.0.0.0- Se da inicio al sistema, se crea el apartado de usuarios , dispositivos y usuarios del sistema, asi como la generación de la base de datos</li>
							<li>5.0.0.0- Se da inicio al sistema, se crea el apartado de usuarios , dispositivos y usuarios del sistema, asi como la generación de la base de datos</li>
							<li>5.0.0.0- Se da inicio al sistema, se crea el apartado de usuarios , dispositivos y usuarios del sistema, asi como la generación de la base de datos</li>
							<li>5.0.0.0- Se da inicio al sistema, se crea el apartado de usuarios , dispositivos y usuarios del sistema, asi como la generación de la base de datos</li>

            </div>
					</div>
				</div>
        
			</div><!--ROW-->

		</div>
	</div>
	<!--SERVICE END-->







	<!--TEAM START-->
	<div id="about" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Equipo de desarollo</h1>
					<p>El equipo de desarrollo del sistema esta conformado por: </p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
				<div class="autoplay">

          <!-- GILBERTO -->
					<div class="col-md-4">
						<div class="team-info">
							<div class="img-sec">
								<img src="{{ url('/') }}/public/img/usuario.jpg" class="img-responsive">
							</div>
							<div class="fig-caption">
								<h3>José Gilberto Colin Velasco</h3>
								<p>Ing. Sistemas Computacionale</p>
								<p ><i class="fa fa-envelope"></i> jgcolin@ssp.cdmx.gob.mx</p>
                
							</div>
						</div>
					</div>

          <!-- GILBERTO -->
					<div class="col-md-4">
						<div class="team-info">
							<div class="img-sec">
								<img src="{{ url('/') }}/public/img/usuario.jpg" class="img-responsive">
							</div>
							<div class="fig-caption">
								<h3>José Gilberto Colin Velasco</h3>
								<p>Ing. Sistemas Computacionale</p>
								<p ><i class="fa fa-envelope"></i> jgcolin@ssp.cdmx.gob.mx</p>
							</div>
						</div>
					</div>

          <!-- GILBERTO -->
					<div class="col-md-4">
						<div class="team-info">
							<div class="img-sec">
								<img src="{{ url('/') }}/public/img/usuario.jpg" class="img-responsive">
							</div>
							<div class="fig-caption">
								<h3>José Gilberto Colin Velasco</h3>
								<p>Ing. Sistemas Computacionale</p>
								<p ><i class="fa fa-envelope"></i> jgcolin@ssp.cdmx.gob.mx</p>
							</div>
						</div>
					</div>

          <!-- GILBERTO -->
					<div class="col-md-4">
						<div class="team-info">
							<div class="img-sec">
								<img src="{{ url('/') }}/public/img/usuario.jpg" class="img-responsive">
							</div>
							<div class="fig-caption">
								<h3>José Gilberto Colin Velasco</h3>
								<p>Ing. Sistemas Computacionale</p>
								<p ><i class="fa fa-envelope"></i> jgcolin@ssp.cdmx.gob.mx</p>
							</div>
						</div>
					</div>


          <!-- GILBERTO -->
					<div class="col-md-4">
						<div class="team-info">
							<div class="img-sec">
								<img src="{{ url('/') }}/public/img/usuario.jpg" class="img-responsive">
							</div>
							<div class="fig-caption">
								<h3>José Gilberto Colin Velasco</h3>
								<p>Ing. Sistemas Computacionale</p>
								<p ><i class="fa fa-envelope"></i> jgcolin@ssp.cdmx.gob.mx</p>
							</div>
						</div>
					</div>


          <!-- GILBERTO -->
					<div class="col-md-4">
						<div class="team-info">
							<div class="img-sec">
								<img src="{{ url('/') }}/public/img/usuario.jpg" class="img-responsive">
							</div>
							<div class="fig-caption">
								<h3>José Gilberto Colin Velasco</h3>
								<p>Ing. Sistemas Computacionale</p>
								<p ><i class="fa fa-envelope"></i> jgcolin@ssp.cdmx.gob.mx</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!--TEAM END-->
    



	<!--CTA2 START-->
	<div class="cta2">
		<div class="container">
			<div class="row white text-center">
				<h3 class="wd75 fnt-24">“Tu mismo debes ser el cambio que quieres ver en el mundo”- Gandhi</h3>
				<p class="cta-sub-title"></p>
			</div>
		</div>
	</div>
	<!--CTA2 END-->




	<!--CONTACT START-->
	<div id="contact" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="page-title text-center">
					<h1>Soporte</h1>
					<p>Si experimentas problemas con el sistema <br> Envianos un correo.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
        
        <div id="sendmessage">Tu mensaje ha sido enviado! - Gracias</div>
        <div id="errormessage">Error</div>
                
				<div class="form-sec">

                	<form action="" method="post" role="form" class="contactForm">

                    	  <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control text-field-box" id="name" placeholder="Tu Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control text-field-box" name="email" id="email" placeholder="Tu correo" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control text-field-box" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <textarea class="form-control text-field-box" name="message" rows="5" data-rule="required" data-msg="Problema" placeholder="Problema"></textarea>
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <h4>Capturas de pantalla del error:</h4>
                            <br>
                            <input type='file' name='files[]' multiple />
                            <div class="validation"></div>
                        </div>
                        
                        <button class="button-medium" id="contact-submit" type="submit" name="contact">Enviar</button>


                    </form>

        </div>
			</div>
		</div>
	</div>
	<!--CONTACT END-->

	<!--FOOTER START-->
	<footer class="footer section-padding">
		<div class="container">
			<div class="row">
				<div style="visibility: visible; animation-name: zoomIn;" class="col-sm-12 text-center wow zoomIn">
					<h3>Innovación y desarrollo</h3>
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
    
</body>
</html>