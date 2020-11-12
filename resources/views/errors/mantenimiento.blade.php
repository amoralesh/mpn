<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | 0000</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ url('/') }}/public/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ url('/') }}/public/css/font-awesome.min.css">
    <!-- Google fonts - Roboto for copy, Montserrat for headings-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ url('/') }}/public/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ url('/') }}/public/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ url('/') }}/public/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="container-fluid">
      <div class="row intro">
        <div class="col-md-6 col-sm-8 intro-left"> 
          <div class="intro-left-content">
            <p> <img src="{{ url('/') }}/public/img/logo.png" alt="ssp cdmx"></p>
            <h1>En mantenimiento.</h1>
            <p class="lead">{{ config('app.name') }}.</p>
            <p>Estamos trabajando para mejorar el sistema , ten paciencia , si tienes alguna duda comunicate al número 52425100 Ext. 4059</p>
            <p class="social">
                <a href="#" class="email"><i class="fa fa-envelope"> </i></a>
            </p>
            <p class="credit">&copy; 2017 Secretaría de Seguridad Pública CDMX | Creado por <a href="" class="external">Innovación y desarrollo</a>  </p>
            <!-- Please do not remove the backlink to bootstrapious unless you support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :) -->
          </div>
        </div>
        <div style="background-image: url('{{ url('/') }}/public/img/banner-bg.jpg');" class="col-md-6 col-sm-4 intro-right background-gray"></div>
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ url('/') }}/public/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/public/js/jquery.cookie.js"> </script>
    <script src="{{ url('/') }}/public/js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>