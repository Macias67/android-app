@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/croppic/croppic.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/pages/css/profile.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/pages/css/tasks.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css"/>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
      <h1>Página en blanco
            <small>Página en blanco</small>
      </h1>
@stop

{{-- Sobreescribir el toolbar de pagina
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de pagina --}}
@section('page-breadcrumb')
      <ul class="page-breadcrumb breadcrumb">
            <li>
                  <a href="">Inicio</a>
                  <i class="fa fa-circle"></i>
            </li>
            <li>
                  <a href="#">Page Layouts</a>
                  <i class="fa fa-circle"></i>
            </li>
            <li>
                  <a href="#">Blank Page</a>
            </li>
      </ul>
@stop

{{-- Conteindo de la vista. --}}
@section('content')
      <style>
          .layer {
              border-radius: 4px;
              background-attachment: scroll;
              background-repeat: no-repeat;
              background-position: center center;
              background-size: cover;
          }

          .layer > .portlet.light {
              background: rgba(64,64,64,0.1);
              background: -moz-radial-gradient(center, ellipse cover, rgba(64,64,64,0.1) 0%, rgba(64,64,64,0.1) 0%, rgba(0,0,0,0.46) 100%);
              background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(64,64,64,0.1)), color-stop(0%, rgba(64,64,64,0.1)), color-stop(100%, rgba(0,0,0,0.46)));
              background: -webkit-radial-gradient(center, ellipse cover, rgba(64,64,64,0.1) 0%, rgba(64,64,64,0.1) 0%, rgba(0,0,0,0.46) 100%);
              background: -o-radial-gradient(center, ellipse cover, rgba(64,64,64,0.1) 0%, rgba(64,64,64,0.1) 0%, rgba(0,0,0,0.46) 100%);
              background: -ms-radial-gradient(center, ellipse cover, rgba(64,64,64,0.1) 0%, rgba(64,64,64,0.1) 0%, rgba(0,0,0,0.46) 100%);
              background: radial-gradient(ellipse at center, rgba(64,64,64,0.1) 0%, rgba(64,64,64,0.1) 0%, rgba(0,0,0,0.46) 100%);
              filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#404040', endColorstr='#000000', GradientType=1 );

              -webkit-box-shadow: 0px 0px 5px -3px rgba(0,0,0,0.75);
              -moz-box-shadow: 0px 0px 5px -3px rgba(0,0,0,0.75);
              box-shadow: 0px 0px 5px -3px rgba(0,0,0,0.75);
          }

          .profile-usertitle-name {
              color: #ffe400;
              font-size: 20px;
              font-weight: 600;
              margin-bottom: 5px;
          }
      </style>
      <div class="row">
            <div class="col-md-12 animated bounceInUp">
                  <!-- BEGIN PROFILE SIDEBAR -->
                  <div class="profile-sidebar" style="width: 250px;">

                        <!-- PORTLET MAIN -->
                      <div class="layer animated flipInX" style="background-image: url('{{$img_producto}}');">
                          <div class="portlet light profile-sidebar-portlet picture">
                              <!-- SIDEBAR USERPIC -->
                              <div class="profile-userpic">
                                    {{--<img id="logo" src="{{$img_producto}}" class="img-responsive" alt="">--}}
                              </div>
                              <!-- END SIDEBAR USERPIC -->
                              <!-- SIDEBAR USER TITLE -->
                              <div class="profile-usertitle">
                                    <div class="profile-usertitle-name">
                                          {{$producto->nombre}}
                                    </div>
                                    <div class="profile-usertitle-job">
	                                   Negocio
                                    </div>
                              </div>
                              <!-- END SIDEBAR USER TITLE -->
                              <!-- SIDEBAR BUTTONS -->
                              <div class="profile-userbuttons">
                                    <button type="button" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-star"></i> 4.2</button>
                                    <button type="button" class="btn btn-circle green-haze btn-xs"><i class="fa fa-heart"></i> 58</button>
                              </div>
                              <!-- END SIDEBAR BUTTONS -->
	                        <br>

                        </div>
                      </div>
                        <!-- END PORTLET MAIN -->
                      
                        <!-- PORTLET MAIN -->
                        <div class="portlet light">
                              <!-- STAT -->
                              <div class="row list-separated profile-stat">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                          <div class="uppercase profile-stat-title">
                                                37
                                          </div>
                                          <div class="uppercase profile-stat-text">
                                                Projects
                                          </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                          <div class="uppercase profile-stat-title">
                                                51
                                          </div>
                                          <div class="uppercase profile-stat-text">
                                                Tasks
                                          </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                          <div class="uppercase profile-stat-title">
                                                61
                                          </div>
                                          <div class="uppercase profile-stat-text">
                                                Uploads
                                          </div>
                                    </div>
                              </div>
                              <!-- END STAT -->
                              <div>
                                    <h4 class="profile-desc-title">About Marcus Doe</h4>
                                    <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                                    <div class="margin-top-20 profile-desc-link">
                                          <i class="fa fa-globe"></i>
                                          <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                                    </div>
                                    <div class="margin-top-20 profile-desc-link">
                                          <i class="fa fa-twitter"></i>
                                          <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                    </div>
                                    <div class="margin-top-20 profile-desc-link">
                                          <i class="fa fa-facebook"></i>
                                          <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                    </div>
                              </div>
                        </div>
                        <!-- END PORTLET MAIN -->
                  </div>
                  <!-- END BEGIN PROFILE SIDEBAR -->

                  <!-- BEGIN PROFILE CONTENT -->
	            @yield('profile-content')
                  <!-- END PROFILE CONTENT -->
            </div>
      </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/croppic/croppic.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>

@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
    <script src="{{asset('assets/admin/pages/app/cliente/negocios/perfil.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/pages/app/cliente/negocios/info-adicional.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js  --}}
@section('init-js')
Profile.init();
InfoAdicional.init();
@stop