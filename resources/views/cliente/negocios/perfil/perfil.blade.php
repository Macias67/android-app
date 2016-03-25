@extends('cliente.menu')

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
      <div class="row">
            <div class="col-md-12 animated bounceInUp">
                  <!-- BEGIN PROFILE SIDEBAR -->
                  <div class="profile-sidebar" style="width: 250px;">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet">
                              <!-- SIDEBAR USERPIC -->
                              <div class="profile-userpic">
                                    <img id="logo" src="{{$cliente->logo()}}" class="img-responsive" alt="">
                              </div>
                              <!-- END SIDEBAR USERPIC -->
                              <!-- SIDEBAR USER TITLE -->
                              <div class="profile-usertitle">
                                    <div class="profile-usertitle-name">
                                          {{$cliente->nombre}}
                                    </div>
                                    <div class="profile-usertitle-job">
	                                    {{$categoria}}
                                    </div>
                              </div>
                              <!-- END SIDEBAR USER TITLE -->
                              <!-- SIDEBAR BUTTONS -->
                              <div class="profile-userbuttons">
                                    <button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
                                    <button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
                              </div>
                              <!-- END SIDEBAR BUTTONS -->
                              <!-- SIDEBAR MENU -->
                              <div class="profile-usermenu">
                                    <ul class="nav">
                                          <li id="perfil">
                                                <a href="{{route('cliente.negocio.perfil', [$current_cliente_id])}}">
                                                      <i class="icon-home"></i> Perfil
                                                </a>
                                          </li>
                                          <li id="misdatos">
	                                          <a href="{{route('cliente.negocio.perfil', [$current_cliente_id, 'settings'])}}">
                                                      <i class="icon-settings"></i> Mis datos
	                                          </a>
                                          </li>
                                          <li>
                                                <a href="page_todo.html" target="_blank">
                                                      <i class="icon-check"></i>
                                                      Tasks </a>
                                          </li>
                                          <li>
                                                <a href="extra_profile_help.html">
                                                      <i class="icon-info"></i>
                                                      Help </a>
                                          </li>
                                    </ul>
                              </div>
                              <!-- END MENU -->
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

{{-- Cargar los archivos de js --}}
@section('page-level-js')
    <script src="{{asset('assets/admin/pages/app/cliente/negocios/perfil.js')}}" type="text/javascript"></script>
@append
