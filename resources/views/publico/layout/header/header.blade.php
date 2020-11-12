<!-- START HEADER -->
<div class="row" style="background:rgba(0,28,58,1);">
<div class="col-sm-4 col-xl-2 header-left" style="background:rgba(0,28,58,1);">
   <div class="logo float-xs-left" style="color:white; width:55%; height:100%;">
      <a href="#"><img src="{{ url('/') }}/public/img/logo2.png" alt="logo" style="width:100%; height:100%;"></a>
   </div>
   <button class="left-menu-toggle float-xs-right">
   <i class="icon_menu toggle-icon"></i>
   </button>
   <button class="right-menu-toggle float-xs-right">
   <i class="arrow_carrot-left toggle-icon"></i>
   </button>
</div>
<div class="col-sm-8 col-xl-10 header-right" style="background:rgba(0,28,58,1);">
   <div class="header-inner-right">
      <!-- ICONO DE BUSQUEDA -->
      @include('publico.layout.header.busqueda')
      <!-- ICONO DE CORREO -->
      @include('publico.layout.header.correo')
      <!-- ICONO DE CHAT -->
      @include('publico.layout.header.chat')
      <!-- ICONO DE EXPANDIR -->
      <div class="float-default chat">
         <div class="right-icon">
            <a href="#" data-plugin="fullscreen">
            <i class="arrow_expand"></i>
            </a>
         </div>
      </div>
      <!-- ICONO DE USUARIO -->  
      <div class="user-dropdown" style="background:rgba(0,28,58,1);">
         <div class="btn-group">
            <a href="#" class="user-header dropdown-toggle" data-toggle="dropdown"
               data-animation="slideOutUp" aria-haspopup="true"
               aria-expanded="false">
            <img src="{{ url('/') }}/public/assets/global/image/img_128x128.png" alt="Profile image"/>
            </a>
            <div class="dropdown-menu drop-profile">
               <div class="userProfile">
                  <img src="{{ url('/') }}/public/assets/global/image/img_128x128.png" alt="Profile image"/>
                  <h5> {{ Auth::guard('webpublico')->user()->getUsuario() }}  </h5> 
                  <p> {{ Auth::guard('webpublico')->user()->getEmail() }} </p>
               </div>
               <div class="dropdown-divider"></div>
               <!--<a class="btn left-spacing link-btn" href="#" role="button">Link</a>
                  <a class="btn left-second-spacing link-btn" href="#" role="button">Link 2</a>-->
               <a class="btn btn-primary float-xs-right right-spacing" href="{{ url('/') }}/publico/logout" role="button" style="background:rgba(0,28,58,1);">Cerrar sesión</a>
            </div>
         </div>
      </div>
   </div>
</div>
</div>