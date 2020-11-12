@extends('administracion.layout.master')
@section('titulo', 'Chat')
@section('dependencia', ' - Policía Preventiva - ')



@section('directorioTitle', 'Chat')
@section('directorio')
    <li class="breadcrumb-item">Chat</li>
@endsection  
  

   
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- DATATABLES -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/DataTables-1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/global/plugins/datatables/Responsive-2.1.0/css/responsive.dataTables.min.css"/>
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/select2/dist/css/select2.min.css">

<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/sweetalert2/dist/sweetalert2.min.css"/>
<!--chat-->
<link rel="stylesheet" href="{{ url('/') }}/public/assets/global/plugins/chat/css/style.css" type="text/css" media="all">

<style>
#map{
    width: 100%; height: 500px;
}
#map > div  {
  width: 100%; height: 100%;
}
.conversation{
	height: 600px;
	/*overflow: auto;*/
}
body{user-select: none;}
</style>
@endsection




@section('content')
<div style="margin: 25px auto; width:95%;">

   <div class="box-body">
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
      <div class="row">
         <div class="col-md-12">
            <!-- <div class="container app"> -->
            <div class="row app-one">
               <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 side">
                  <div class="side-one">

                    <!-- MAIN HEADER IN CHAT -->
                    <div class="row heading">
                        <!-- IMAGEN DE AVATAR -->
                        <div class="col-sm-3 col-xs-3 heading-avatar">
                           <div class="heading-avatar-icon">
                              <img src="{{ url('/') }}/public/img/usuario.jpg">
                           </div>
                        </div>
                       
                        <!-- IMAGEN DE MENÚ -->
                        <div class="col-sm-8 col-xs-8">
                          <strong>Tú | {{ Session::get('usuario') }} | {{ Session::get('nombreUsuario') }} </strong>
                        </div>

                        <!-- IMAGEN DE MENÚ 
                        <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                           <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                        </div>-->

                        <!-- IMAGEN DE COMENTARIOS 
                        <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                           <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                        </div>-->

                     </div>

                    <!-- BARRA DE BUSQUEDA DE USUARIOS -->
                     <div class="row searchBox">
                        <div class="col-sm-12 searchBox-inner">
                           <div class="form-group has-feedback">
                              <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Buscar usuario">
                              <span class="glyphicon glyphicon-search form-control-feedback"></span>
                           </div>
                        </div>
                     </div>

                    

                    <!-- NOMBRE DE LOS USUARIOS -->
                    <div class="row sideBar">
                    
                        @foreach($usuarios as $i => $usuario)

                                <div class="row sideBar-body" chat="chat{{$i}}" 
                                nameUser="{{$usuario['usuario'] }}  | {{$usuario['email'] }} | {{$usuario['nombre'] }} 
                                {{$usuario['apellidoPaterno'] }} {{ $usuario['apellidoMaterno'] }}" 
                                emailElemento="{{$usuario['email']}}" typeOfUser="{{$usuario['tipo'] }}"  
                                >

                                <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                    <div class="avatar-icon">
                                        <img src="{{ url('/') }}/public/img/usuario.jpg">
                                    </div>   
                                </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8 sideBar-name">
                                            <span class="name-meta"><strong>{{$usuario['usuario'] }}</strong> | {{$usuario['email'] }}  
                                            </span>
                                            <br> 
                                            <span class="name-meta">{{$usuario['nombre'] }} {{$usuario['apellidoPaterno'] }} {{$usuario['apellidoMaterno']}}   
                                                   | {{ $usuario['tipo'] }}   
                                            </span>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                            <span class="time-meta pull-right">18:18 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach()
                    </div>
                  </div>
               </div>

               
               <!--=============== CONVERSACION =============-->
               <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8 conversation" id="">
                  <div class="row heading">
                     <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon">
                           <img src="{{ url('/') }}/public/img/usuario.jpg">
                        </div>
                     </div>
                     <div class="col-sm-8 col-xs-7 heading-name">
                        <a class="heading-name-meta" id="nameUser">Usuario
                        </a>
                        <span class="heading-online">Online</span>
                     </div>
                     <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                        <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                     </div>
                  </div>
                  <div class="row message-previous">
                     <div class="col-sm-12 previous">
                        <a  id="ankitjain28" idFriend="" class="moreMesagges" name="20">
                        Ver mensajes anteriores (últimos 40 mensajes)
                        </a> 
                     </div>
                  </div>
                  <div class="row message " id="conversation" >
                    <div class="row message-body">
                        <div class="col-sm-12 message-main-receiver">
                          <div class="receiver">
                            <div class="message-text">
                             Hola, Selecciona un usuario para comenzar a enviar mensajes
                            </div>
                            <span class="message-time pull-right">
                              Hoy
                            </span>
                          </div>
                        </div>
                        </div> 
                     <div class="row message-body">
                        <div class="col-sm-12 message-main-sender">
                          <div class="sender">
                            <div class="message-text">
                             Entendido! &nbsp;&nbsp; <li style="color: rgb(52, 152, 219);" class="fa  fa-angle-double-right fa-2x"></li> 
                          </div>
                        <span class="message-time pull-right">
                          Hoy
                     </span>
                        </div>
                        </div>
                        </div>
                  </div>
               </div>
               <div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 side">
               </div>
               <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8 side">
                  <div class="row reply">
                    <!--EMOJIS
                     <div class="col-sm-1 col-xs-1 reply-emojis">
                        <i class="fa fa-smile-o fa-2x"></i>
                     </div>-->
                     <!--AREA DE COMENTARIOS-->
                     <div class="col-sm-11 col-xs-11 reply-main">
                        <textarea class="form-control" rows="1" id="comment"></textarea>
                     </div>
                     <!--BNOTOTN DE ENVIO-->
                     <div class="col-sm-1 col-xs-1 reply-send">
                        <button id="send" chat="" class="btn btn-block btn-sm btn-lg" style="background-color: rgba(255,20,155,1); color: white;">
                           <li class="fa fa-chevron-circle-right fa-lg"></li>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--col 12-->
      </div>
      <!-- <div class="row">
         <div class="col-md-12">
             <input  type="submit" id="reordenar" class="btn btn-block btn-lg" style="background-color: rgba(255,20,155,1); color: white;" value="Guardar"/>
         </div>
         </div> -->
   </div>
   <!-- /.box-bdy -->
</div>
@endsection


@section('scripts')

<script type="text/javascript" src="{{ url('/') }}/public/assets/global/plugins/bootbox.js/bootbox.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/js/socket.io.js"></script>

<script>
   $(document).ready(function() {
        $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        console.log("Iniciando socket io");     
        var url= window.location.hostname  + ":3000";
        console.log(url);
        var socket = io( url );

        socket.on('messageAdmin{{ Auth::user()->getEmail() }}', function (data) {
            var mensaje = "";
            if (data.emisor != "{{  Auth::user()->getEmail() }}") {
                mensaje = friendPush(data);
                $('#conversation').append(mensaje);
                $('#conversation').scrollTop(1000);
            }
        });    
    });
</script>

<script>
    var row;
    var idChat;
    var userName;
    var emailElemento;
    var typeOfUser;
    var getMensajesPublicoInterval;
    var getMensajesMobileInterval;

    /* BUSCAR PERSONA*/
    $("#searchText").on("keyup", buscarPersona);
    function buscarPersona() {
        var tarjetas = $(".sideBar-body");
        var texto = $("#searchText").val();
        texto = texto.toLowerCase();
        tarjetas.show();
        for (var i = 0; i < tarjetas.size(); i++) {
            var contenido = tarjetas.eq(i).text();
            contenido = contenido.toLowerCase();
            var index = contenido.indexOf(texto);
            if (index == -1) {
                tarjetas.eq(i).hide();
            }
        }
    }
    /*END BUSCAR PERSONA*/


    /* SELECCIONAR CHAT*/
    $('.sideBar-body').on("click", function() {
        idChat = $(this).attr("chat");
        userName = $(this).attr("nameUser");
        emailElemento = $(this).attr("emailElemento");
        typeOfUser = $(this).attr("typeOfUser");

        console.log( idChat + " userName " + userName+ " emailElemento " + emailElemento+ " typeOfUser " + typeOfUser);
       
        $("#nameUser").text(userName);
        $('.conversation').attr('id', idChat);
        $("#send").attr('chat', emailElemento);
        //*Limpiamos mensajes de otro chat antes de cargar otro*/
        $(".message-body").empty();
        var dialog = bootbox.dialog({
            title: 'Cargando mensajes del chat',
            message: '<p><i class="fa fa-spin fa-spinner"></i> Cargando...</p>'
        });
        if( typeOfUser == "Movil" ){
            getMensajesMobile("{{  Auth::user()->getEmail() }}", emailElemento, 0, dialog);
        } else if( typeOfUser == "Publico" ){
            getMensajesPublico("{{  Auth::user()->getEmail() }}", emailElemento, 0, dialog); 
        } else {
            getMensajesPublico("{{  Auth::user()->getEmail() }}", emailElemento, 0, dialog);
        }

        $('#conversation').scrollTop(1000);
    });
    /* END SELECCIONAR CHAT*/


    /* MOSTRAR MENSAJES ANTERIORES*/
    $('.moreMesagges').on("click", function() {
        row = $(this).attr('row');
        //bootbox.alert("el ultimo es:"+row);
        if (row != null) {
            dialog = bootbox.dialog({
                title: 'Cargando mensajes anteriores de este chat',
                message: '<p><i class="fa fa-spin fa-spinner"></i> Cargando...</p>'
            });
           if( typeOfUser == "Movil" ){
                //*Limpiamos mensajes de otro chat antes de cargar otro*/
                $(".message-body").empty();
                getMensajesMobile("{{  Auth::user()->getEmail() }}", emailElemento,row, dialog);
            } else if( typeOfUser == "Publico" ){
                //*Limpiamos mensajes de otro chat antes de cargar otro*/
                $(".message-body").empty();
                getMensajesPublico("{{  Auth::user()->getEmail() }}", emailElemento, row, dialog); 

            } else {
                //*Limpiamos mensajes de otro chat antes de cargar otro*/
                $(".message-body").empty();
                getMensajesPublico("{{  Auth::user()->getEmail() }}", emailElemento, row, dialog);
            }
            $('#conversation').scrollTop();
        } else {
            bootbox.alert("Selecciona un chat");
        }
    });
    /* END SELECCIONAR CHAT*/






    $(function() {

        $('#send').on('click', function(e) {
            //var emailElemento=$(this).attr("chat");
            var mensaje = $("#comment").val();
            texto = mensaje.trim();

            if (texto != "") {
                if( typeOfUser == "Movil" ){
                    addMesaggeApp(texto, emailElemento);
                } else if( typeOfUser == "Publico" ){
                    addMesaggePublico(texto, emailElemento);
                } else {
                    addMesaggePublico(texto, emailElemento);
                }
                $('#conversation').scrollTop(1000);
                $('#comment').val('');
            }
        });
    });

    function addMesaggeApp(text, emailReceptor) {
        var yoAdd = `<div class="row message-body">
					<div class="col-sm-12 message-main-sender">
			            <div class="sender">
			            	<div class="message-text">
			               		${text}
			              	</div>
			              	<span class="message-time pull-right">hoy &nbsp;&nbsp;<li class="status"></li></span>
			            </div>
			        </div>
		        </div>`;
        $('#conversation').append(yoAdd);
        ajaxMensajeApp(text, emailReceptor);
    }  

    function ajaxMensajeApp(texto, emailReceptor) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            url: "{{ url('/') }}/administracion/rest/chat/comment/mobile", 
            type: 'POST',
            data: JSON.stringify({
                message: texto, 
                emisor: "{{  Auth::user()->getEmail() }}",  
                receptor: emailReceptor
            }),
            contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
            dataType: "text",
            success: function(data) {
                data = parseInt( data );
                if (data == 200) {
                    //$(".status").attr('style',  'color: rgb(52, 152, 219)').slideUp( 300 ).fadeIn( 400 );//EFECTO VISTO
                    $(".status").addClass("fa fa-angle-double-right fa-2x"); //EFECTO ENVIADO
                    //$(".fa").removeClass("status");
                } 
                if (data == 500) {
                    //$(".status").attr('style',  'color: rgb(52, 152, 219)').slideUp( 300 ).fadeIn( 400 );//EFECTO VISTO
                    $(".status").addClass("fa fa-remove fa-2x"); //EFECTO ENVIADO
                    //$(".fa").removeClass("status");
                } 
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                if( xhr.status == 500 ){ 
                      //$(".status").attr('style',  'color: rgb(52, 152, 219)').slideUp( 300 ).fadeIn( 400 );//EFECTO VISTO
                      $(".status").addClass("fa fa-remove fa-2x"); //EFECTO ENVIADO
                      //$(".fa").removeClass("status");
                }
                //ajaxMensajeApp(texto, emailReceptor);
            }
        });
    }

    
    function addMesaggePublico(text, emailReceptor) {
        var yoAdd = `<div class="row message-body">
					<div class="col-sm-12 message-main-sender">
			            <div class="sender">
			            	<div class="message-text">
			               		${text}
			              	</div>
			              	<span class="message-time pull-right">
			                	hoy &nbsp;&nbsp;<li class="status"></li>
			              	</span>
			            </div>
			        </div>
		        </div>`;
        $('#conversation').append(yoAdd);
        ajaxMensajePublico(text, emailReceptor);
    }  

    function ajaxMensajePublico(texto, emailReceptor) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });  
        $.ajax({
            url: "{{ url('/') }}/administracion/rest/chat/comment/publico",
            type: 'POST',
            data: JSON.stringify({
                message: texto, 
                emisor: "{{  Auth::user()->getEmail() }}",  
                receptor: emailReceptor
            }),
            contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
            dataType: "text",
            success: function(data) {
                data = parseInt(data);
                if (data == 200) {
                    //$(".status").attr('style',  'color: rgb(52, 152, 219)').slideUp( 300 ).fadeIn( 400 );//EFECTO VISTO
                    $(".status").addClass("fa fa-angle-double-right fa-2x"); //EFECTO ENVIADO
                    $(".fa").removeClass("status");

                } else if (data == 501) {
                    $(".status").addClass("fa fa-times fa-2x"); //EFECTO ENVIADO
                    $(".fa").removeClass("status");
                }
            },
            complete: function() {},
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                ajaxMensajePublico(texto, emailReceptor);
            }
        });
    }







    function getMensajesPublico(idUSer, emailElemento, row, dialog) {
        $.ajax({
            url: "{{ url('/') }}/administracion/rest/chat/comment/publico/" + idUSer + "/" + emailElemento + "/" + row,
            type: 'GET',
            contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
            dataType: "text",    
            success: function(data) {
                dialog.modal('hide');
                var mensaje = "";
                if (row == 0) {
                    data = JSON.parse(data);
                    console.log( data );
                    var c = false;
                    for (var i = data.length - 1; i >= 0; i--) {
                        if (c == false) {
                            //colocamos el id menor de los ultimos mensajes para obtener los demas mensajes en cola
                            $('.moreMesagges').attr('row',  data.length + 40 );
                            c = true;
                        }
                        if (data[i].emisor == "{{  Auth::user()->getEmail() }}") {
                            mensaje = mio(data[i]);
                        } else {
                            mensaje = friend(data[i]);
                        }
                        $('#conversation').append(mensaje);
                        $('#conversation').scrollTop(1000);
                    }
                } else {
                    var datos = JSON.parse(data);
                    $('.moreMesagges').attr('row', datos.length  + 40 );

                    $.each(JSON.parse(data), function(key, value) {
                        if (value.emisor == "{{  Auth::user()->getEmail() }}") {
                            mensaje = mio(value);
                        } else {
                            mensaje = friend(value);
                        }
                        $('#conversation').prepend(mensaje);
                    });
                }
            },
            complete: function() {},
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log("error");
                getMensajesPublico(idUSer, emailElemento, row, dialog);
            }
        });
    }







    function getMensajesMobile(idUSer, emailElemento, row, dialog) {
        $.ajax({
            url: "{{ url('/') }}/administracion/rest/chat/comment/mobile/" + idUSer + "/" + emailElemento + "/" + row,
            type: 'GET',
            contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
            dataType: "text",
            success: function(data) {
                dialog.modal('hide');
                var mensaje = "";
                if (row == 0) {
                    data = JSON.parse(data);
                    var c = false;
                    for (var i = data.length - 1; i >= 0; i--) {
                        if (c == false) {
                            //colocamos el id menor de los ultimos mensajes para obtener los demas mensajes en cola
                            $('.moreMesagges').attr('row',  data.length + 40 );
                            c = true;
                        }
                        if (data[i].emisor == "{{  Auth::user()->getEmail() }}") {
                            mensaje = mio(data[i]);
                        } else {
                            mensaje = friend(data[i]);
                        }
                        $('#conversation').append(mensaje);
                        $('#conversation').scrollTop(1000);
                    }
                } else {
                    var datos = JSON.parse(data);
                    $('.moreMesagges').attr('row', datos.length  + 40 );

                    $.each(JSON.parse(data), function(key, value) {
                        if (value.emisor == "{{  Auth::user()->getEmail() }}") {
                            mensaje = mio(value);
                        } else {
                            mensaje = friend(value);
                        }
                        $('#conversation').prepend(mensaje);
                    });
                }
            },
            complete: function() {},
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log("error");
                getMensajesMobile(idUSer, emailElemento, row, dialog);
            }
        });
    }

    function mio(data) {
        if (data.leido == true) {
            leido = `<li class="fa  fa-angle-double-right fa-2x" style="color: rgb(52, 152, 219)"></li>`;
        } else {
            leido = `<li class="fa  fa-angle-double-right fa-2x status"></li>`;
        } 
        var yoAdd = `<div class="row message-body">
					<div class="col-sm-12 message-main-sender">
			            <div class="sender">
			            	<div class="message-text">
			               		${data.texto}
			              	</div>
			              	<span class="message-time pull-right">
			                	${data.fechaAlta.date}&nbsp;&nbsp; ` + leido + `
			              	</span>
			            </div>
			        </div>       
		</div>`;
        return yoAdd;
    }

    function friend(data) {
        if ( data.leido != true ) {
            sendMensajeLeidoPublico( data.id );
        } 
        var friendAdd = `<div class="row message-body">
					<div class="col-sm-12 message-main-receiver">
			            <div class="receiver">
						    <div class="message-text">
			               		${data.texto}
			              	</div>
			              	<span class="message-time pull-right">
			                	${data.fechaAlta.date}&nbsp;&nbsp; ` + status + `
			              	</span>
			            </div>
			        </div>
				</div>`;
        return friendAdd;
    }


    
    function friendPush(data) {
        if ( data.leido != true ) {
            sendMensajeLeidoPublico( data.id );
        } 
        var friendAdd = `<div class="row message-body">
					<div class="col-sm-12 message-main-receiver">
			            <div class="receiver">
						    <div class="message-text">
			               		${data.mensaje}
			              	</div>
			              	<span class="message-time pull-right">
			                	${data.fechaAlta.date}&nbsp;&nbsp; ` + status + `
			              	</span>
			            </div>
			        </div>
				</div>`;
        return friendAdd;
    }

    
    function sendMensajeLeidoPublico(id) { 
        $.ajax({
            url: "{{ url('/') }}/administracion/rest/chat/comment/publico/leido/" + id,
            type: 'GET',
            contentType: "application/json", //TIPO DE TEXTO QUE SE ENVIA
            dataType: "text",    
            success: function(data) {
                console.log("MENSAJE LEIDO");
            },
            complete: function() {},
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log("error");
                //sendMensajeLeido(id);
            }
        });
    }



    $(function() {
        $(".heading-compose").click(function() {
            $(".side-two").css({
                "left": "0"
            });
        });
        $(".newMessage-back").click(function() {
            $(".side-two").css({
                "left": "-100%"
            });
        });
    });

    
</script>


  




@endsection
