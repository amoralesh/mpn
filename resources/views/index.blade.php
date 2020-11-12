<!DOCTYPE html>
<html lang="en" class=" js no-touch">
<head>
  <title>{{ config('app.name') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="{{ url('/') }}/public/favicon.ico" />

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
			    <li><a href="#service">Sistemas</a></li>
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
				  <p class="big">Área de Innovación y desarrollo .</p>
          <br>
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
					<h1>Sistemas</h1>
					<p>En este apartado se enlistan los sistemas que ha llevado el área de innovación y desarrollo.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
			
	      <!-- MI POLICIA -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> MI POLICÍA </strong> </h3>
								<p align="justify">Mi Policía “En Defensa de la Sociedad” es una aplicación para Smartphone, 
									tiene el objetivo de acercar los servicios de la policía al ciudadano,
									y reducir a menos de tres minutos los tiempos de respuesta en las llamadas de 
									emergencia.
									
									Esta aplicación es una herramienta que forma parte de un programa integral de seguridad pública, 
									denominado Programa de Cuadrantes (Policía de Proximidad), 
									que consiste en realizar una división territorial de la ciudad en 847 cuadrantes, 
									delimitados por factores geográficos, incidencia delictiva, vialidades, 
									habitantes y población flotante. En dicho perímetro, 
									tres policías (uno por turno) serán los responsables de la incidencia delictiva que se registre 
									y de la vinculación con las personas que habiten o laboren en esta zona. 
									La aplicación conecta a dichos policías con los ciudadanos que se encuentran en el cuadrante.
										
									Mi Policía “En Defensa de la Sociedad” integra la tecnología a la seguridad pública,
									permitiendo a los ciudadanos, de manera gratuita, 
									acceder a información del cuadrante en el que se ubica, 
									al contacto del policía más cercano a su ubicación, 
									la posibilidad de realizar llamadas de emergencia y tener una respuesta más rápida de la 
									policía.
										
									Como parte de la estrategia de seguridad pública de la ciudad, 
									está el conocer la percepción de inseguridad para tomar acciones preventivas y correctivas, 
									disminuir la incidencia delictiva y facilitar la localización de vehículos trasladados a 
									corralones por infracciones al Reglamento de Tránsito.</p>

										<h5><strong>DOCUMENTACIÓN</strong></h5>

											<p align="justify">  </p>
												<h5><strong>SOFTWARE REQUERIDO EN EL SERVIDOR</strong></h5>

												<p align="justify"> Este sistema es una aplicación movil, por lo que se ha programado de forma nativa en ANDROID , y se ha usado un framework llamado
													Ionic para IOS y WINDOWS PHONE , se enlista el software requerido para el desarrollo del sistema

												<ul> <h6><strong>Aplicación Movil</strong></h6>
													
													<h6><strong>ANDROID</strong></h6>
													<li>Android </li>
													<li>minSdkVersion  16</li>
													<li>targetSdkVersion 16</li>
													<li>com.android.support:appcompat-v7:26.+</li>
													<li>com.android.support:design:26.+</li>
													<li>com.android.support.constraint:constraint-layout:1.0.2</li>
													<li>com.github.amlcurran.showcaseview:library:5.4.3</li>
													<li>com.github.paolorotolo:appintro:4.0.0</li>
													<li>com.google.code.gson:gson:2.3</li>
													<li>com.android.support:multidex:1.0.1</li>
													<li>org.jboss.aerogear:aerogear-android-push:2.2.1</li>
													<li>com.google.android.gms:play-services:10.0.1</li>
													<li>com.android.support:support-v4:26.+</li>
													<li>com.google.maps.android:android-maps-utils:0.5</li>
													<li>junit:junit:4.12</li>


													<h6><strong>IONIC (IOS , WINDOWS PHONE) </strong></h6>
													<li> Ionic 3.0 </li>
													<li> android ^6.2.3</li>
													<li> cordova-plugin-device ^1.1.4</li>
													<li> cordova-plugin-splashscreen ^4.0.3</li>
													<li> cordova-plugin-statusbar ^2.2.2</li>
													<li> cordova-plugin-whitelist ^1.3.1</li>
													<li> ionic-plugin-keyboard ^2.2.1</li>
													<li> cordova-plugin-geolocation ^2.4.3</li>
													<li> cordova-plugin-googlemaps ^2.0.11</li>
													<li> mx.ferreyra.callnumber ~0.0.2</li>
													<li> cordova-plugin-advanced-http ^1.6.1</li>
													<li> cordova-plugin-nativestorage ^2.2.2</li>
												</ul>
											</p>

										<h5><strong>REQUERIMIENTOS DE LA APLICACIÓN (IIS, Framework, otros)</strong></h5>

											<p align="justify">
													<ul> <h6><strong>Aplicación Movil</strong></h6>
															<li>ANDROID - 16 (4.1.1)</li>
															<li>IONIC (IOS , WINDOWS PHONE) - 3.0</li>
													</ul>
													<ul> <h6><strong>Aplicación Web (Servicios Web), La aplicación esta alojada en la IP (10.13.77.87) ó PID</strong></h6>
															<li>Apache tomcat 2.2</li>
															<li>CodeIgniter 2</li>
															<li>PHP 5.6</li>
													</ul>
											</p>

										<h5><strong>DETALLE DEL ARCHIVO Y POSICION DE LA CADENA DE CONEXIÓN</strong></h5>

											<p align="justify">No visible al público (Inicie sesión)</p>

										<h5><strong>CARACTERÍSTICAS DE LA COMPILACIÓN</strong></h5>

											<p align="justify">
													<ul> <h6><strong>Aplicación Movil</strong></h6>
															<li>ANDROID - 16 (4.1.1)</li>
															<li>IONIC (IOS , WINDOWS PHONE) - 3.0</li>
													</ul>
													<ul> <h6><strong>Aplicación Web (Servicios Web), La aplicación esta alojada en la IP (10.13.77.87) ó PID</strong></h6>
															<li>Apache tomcat 2.2</li>
															<li>CodeIgniter 2</li>
															<li>PHP 5.6</li>
													</ul>
											</p>

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

	      <!-- MI POLICÍA EN MI TRANSPORTE -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> MI POLICÍA EN MI TRANSPORTE </strong> </h3>
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

	      <!-- CUP -->
				<div class="col-md-12">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-calendar"></i></div>
						<div class="service-text">
							<h3> <strong> CUP </strong> </h3>
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
				

	      <!-- BACHILLERATO -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> BACHILLERATO </strong> </h3>
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
					

	      <!-- SISTEMA MOVIL DE ACCIONES DE MANDO (APP MOVIL) -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> SISTEMA MOVIL DE ACCIONES DE MANDO (APP MOVIL) </strong> </h3>
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
					

	      <!-- CONSIGNAS INTELIGENTES -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> CONSIGNAS INTELIGENTES </strong> </h3>
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


	      <!-- PREBECARIOS -->
				<div class="col-md-12">
						<div class="service-box">
							<div class="service-icon"><i class="fa fa-calendar"></i></div>
							<div class="service-text">
								<h3> <strong> PRE-BECARIOS </strong> </h3>
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


					<!-- SISTEMA MOVIL DE ASCENSOS -->
					<div class="col-md-12">
							<div class="service-box">
								<div class="service-icon"><i class="fa fa-calendar"></i></div>
								<div class="service-text">
									<h3> <strong> SISTEMA MOVIL DE ASCENSOS </strong> </h3>
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
	
					<!-- KARDEX ( CARRERA POLICIAL ) -->
					<div class="col-md-12">
							<div class="service-box">
								<div class="service-icon"><i class="fa fa-calendar"></i></div>
								<div class="service-text">
									<h3> <strong> KARDEX ( CARRERA POLICIAL ) </strong> </h3>
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
	

					<!-- NOTIFICACIONES CCC -->
					<div class="col-md-12">
							<div class="service-box">
								<div class="service-icon"><i class="fa fa-calendar"></i></div>
								<div class="service-text">
									<h3> <strong> NOTIFICACIONES CCC </strong> </h3>
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
      <div class="row">


				<div class="page-title text-center">
					<h1>Trabajo Realizado</h1>
					<p>Todo sistema esta diseñado con seguridad Https, con frameworks como laravel, bases de datos mysql, sql server, java y android.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>

	      <!--SEGURIDAD -->
				<div class="col-md-4">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-shield"></i></div>
						<div class="service-text">
							<h3>  Seguridad  </h3>
              <p>Todo sistema cuenta con seguridad HTTPS. significa que toda la información viaja encriptada para mayor seguridad </p>
						</div>
					</div>
				</div>

	      <!--RESTRICCIONES Y BITACORAS-->
				<div class="col-md-4">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa fa-lock"></i></div>
						<div class="service-text">
              <h3>  Restricciones y bitacoras  </h3>
              <p>Todo sistema cuenta con permisos y roles por usuario asi como una bitacora para monitorear al cada usuario.</p>
						</div>
					</div>
				</div>

	      <!-- RAPIDEZ -->
				<div class="col-md-4">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-dashboard"></i></div>
						<div class="service-text"> 
              <h3>  Rapidez  </h3>
              <p>Todo sistema esta hecho de tal forma que cada vez que consultes información este respondera de una manera mas rápida.</p>
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
					<h1>Guías de uso, presentaciones y documentos</h1>
					<hr class="pg-titl-bdr-btm"></hr>
				</div>
				<div class="port-sec">
					<div class="col-md-12 fil-btn text-center">
							<div class="filter wrk-title active" data-filter="all">Ver todos</div>
							<div class="filter wrk-title" data-filter=".mipolicia">Mi Policía</div>
							<div class="filter wrk-title" data-filter=".category-2">Development</div>
							<div class="filter wrk-title lst-cld" data-filter=".category-3">SEO</div>
					</div>
					<div id="Container">
								<div class="filimg mix mipolicia category-3 col-md-4 col-sm-4 col-xs-12" data-myorder="2">
									<img src="{{ url('/') }}/public/img/guia/1.png" class="img-responsive" width="300px" height="300px"> 
								</div>

								<div class="filimg mix mipolicia col-md-4 col-sm-4 col-xs-12" data-myorder="1">
										<img src="{{ url('/') }}/public/img/guia/3.png" class="img-responsive" width="300px" height="300px">								
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
					<h1>Plantillas de los sitemas</h1>
					<p>Estas son las mejoras que ha tenido el sistema.</p>
					<hr class="pg-titl-bdr-btm"></hr>
				</div> 

	      <!-- VERSION -->
				<div class="col-md-12">
					<div class="service-box">
						<div class="service-icon"><i class="fa fa-code"></i></div>
						<div class="service-text">
							<h3>  Version 5  </h3>
							<p>La plantilla contiene las siguientes librerias por defecto.</p>
							<li>Laravel 5.4 </li>
							<li>laravel-doctrine/orm 1.3 </li>
							<li>anouar/fpdf 1.0.2 </li>
							<li>laravelcollective/html ~5.0 </li>
							<li>maatwebsite/excel ~2.1.0 </li>
							<li>phpunit/phpunit ~5.0</li>
							<li>laravel/tinker ~1.0 </li>
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
					<p>El equipo de desarrollo de los sistemas esta conformado por: </p>
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
								<h3> José Gilberto Colin Velasco  </h3>
								<p>Ing. Sistemas Computacionales</p>
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
								<h3>Alonso Morales Hernandez</h3>
								<p>Ing. Sistemas Computacionales</p>
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
								<h3>Angela Aviles Bernal</h3>
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
				<h3 class="wd75 fnt-24">“Tu mismo debes ser el cambio que quieres ver en el mundo”- Gandhi  </h3>
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
           {{  Form::open([ 'url' => ['/publico/soporte' ] , 'class' => 'contactForm' , 'method' => 'POST', 'enctype' => 'multipart/form-data' ]  ) }}

                    	  <div class="col-md-4 form-group">
                            <input type="text" name="nombre" class="form-control text-field-box" id="nombre" placeholder="Tu Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control text-field-box" name="email" id="email" placeholder="Tu correo" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control text-field-box" name="asunto" id="asunto" placeholder="Asunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <textarea class="form-control text-field-box" name="problema" rows="5" data-rule="required" data-msg="Problema" placeholder="Problema"></textarea>
                            <div class="validation"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <h4>Capturas de pantalla del error:</h4>
                            <br>
                            <input type='file' name='documentoSoporteList[]' id="documentoSoporteList" multiple />
                            <div class="validation"></div>
                        </div>
                      
                        <button class="button-medium" id="contact-submit" type="submit" name="contact">Enviar</button>
						 {{ Form::close() }}

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
    
</body>
</html>