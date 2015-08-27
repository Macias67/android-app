@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
<link href="{{asset('assets/admin/pages/css/search.css')}}" rel="stylesheet" type="text/css">
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
      <div class="row">
            <div class="col-md-8">
			<div class="portlet light animated fadeIn" ng-app="ang-app" ng-controller="productos">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-puzzle font-grey-gallery"></i>
						<span class="caption-subject bold font-grey-gallery uppercase">Más gustados</span>
						<span class="caption-helper">more samples...</span>
					</div>
					<div class="inputs">
						<div class="portlet-input input-inline input-medium">
							{!! Form::select('cliente_id', $negocios, NULL, $param) !!}
						</div>
					</div>
				</div>
				<div class="portlet-body">

					<!-- BEGIN PAGE CONTENT-->
					<div class="tiles">
						<div class="col-md-12"  ng-repeat="elemento in listado">
							<h4 class="animated bounceInLeft"><b><% elemento.categoria %></b></h4>
							<hr class="animated bounceInLeft">
							<div class="tile image double animated bounceIn" ng-repeat="producto in elemento.productos">
								<div class="tile-body">
									<img src="{{asset('assets/admin/pages/media/gallery/image3.jpg')}}" alt="">
								</div>
								<div class="tile-object" style="background-color: rgba(0,0,0, 0.5)">
									<div class="name">
										<b><% producto.nombre %></b>
									</div>
									<div class="number" style="margin-bottom: 4px">
										<a href="<% producto.id %>" class="btn bg-red-flamingo btn-xs"><i class="icon-pencil"></i> Editar</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE CONTENT-->


					{{--<div class="col-md-12"  ng-repeat="elemento in listado">--}}
						{{--<h4 class="animated bounceInLeft"><b><% elemento.categoria %></b></h4>--}}
						{{--<hr class="animated bounceInLeft">--}}
						{{--<div class="col-sm-12 col-md-4 animated bounceIn" ng-repeat="producto in elemento.productos">--}}
							{{--<div class="thumbnail">--}}
								{{--<img src="{{asset('assets/admin/pages/media/search/1.jpg')}}" class="img-responsive" alt="">--}}
								{{--<div class="caption">--}}
									{{--<h5><b><% producto.nombre %></b></h5>--}}
									{{--<p>--}}
										{{--<a href="javascript:;" class="btn blue btn-xs">Button </a>--}}
										{{--<a href="javascript:;" class="btn default btn-xs">Button </a>--}}
									{{--</p>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}

					{{--<div class="col-md-6" ng-repeat="producto in productos">--}}
						{{--<div class="booking-offer">--}}
							{{--<img src="{{asset('assets/admin/pages/media/search/1.jpg')}}" class="img-responsive" alt="">--}}
							{{--<div class="booking-offer-in">--}}
								{{--<span>London, UK </span>--}}
								{{--<em>Sign Up Today and Get 30% Discount!</em>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
					<div class="clearfix"></div>
				</div>
                  </div>
            </div>
      </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js" type="text/javascript"></script>
@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script src="{{asset('assets/admin/pages/app/cliente/productos/ang-app/index.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
{{--Productos.init();--}}
@stop