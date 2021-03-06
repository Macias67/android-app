@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
@stop

{{-- Sobreescribir el CSS  --}}
@section('override-css')
	<style>
		.layer {
			border-radius: 4px;
			background-attachment: scroll;
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;
		}

		.layer > .portlet.light {
			background: rgba(64, 64, 64, 0.1);
			background: -moz-radial-gradient(center, ellipse cover, rgba(64, 64, 64, 0.1) 0%, rgba(64, 64, 64, 0.1) 0%, rgba(0, 0, 0, 0.46) 100%);
			background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(64, 64, 64, 0.1)), color-stop(0%, rgba(64, 64, 64, 0.1)), color-stop(100%, rgba(0, 0, 0, 0.46)));
			background: -webkit-radial-gradient(center, ellipse cover, rgba(64, 64, 64, 0.1) 0%, rgba(64, 64, 64, 0.1) 0%, rgba(0, 0, 0, 0.46) 100%);
			background: -o-radial-gradient(center, ellipse cover, rgba(64, 64, 64, 0.1) 0%, rgba(64, 64, 64, 0.1) 0%, rgba(0, 0, 0, 0.46) 100%);
			background: -ms-radial-gradient(center, ellipse cover, rgba(64, 64, 64, 0.1) 0%, rgba(64, 64, 64, 0.1) 0%, rgba(0, 0, 0, 0.46) 100%);
			background: radial-gradient(ellipse at center, rgba(64, 64, 64, 0.1) 0%, rgba(64, 64, 64, 0.1) 0%, rgba(0, 0, 0, 0.46) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#404040', endColorstr='#000000', GradientType=1);

			-webkit-box-shadow: 0px 0px 11px -3px rgba(0, 0, 0, 0.75);
			-moz-box-shadow: 0px 0px 11px -3px rgba(0, 0, 0, 0.75);
			box-shadow: 0px 0px 11px -3px rgba(0, 0, 0, 0.75);
		}

		.layer > .portlet > .portlet-title > .caption > .caption-helper a {
			color: white;
		}

		.layer > .portlet > .portlet-body {
			color: white;
		}
	</style>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
	<h1>Promociones
		<small>Vista de promociones</small>
	</h1>
@stop

{{-- Sobreescribir el toolbar de pagina
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de pagina --}}
@section('page-breadcrumb')
	<ul class = "page-breadcrumb breadcrumb">
		<li>
			<a href = "">Inicio</a>
			<i class = "fa fa-circle"></i>
		</li>
		<li>
			<a href = "#">Page Layouts</a>
			<i class = "fa fa-circle"></i>
		</li>
		<li>
			<a href = "#">Blank Page</a>
		</li>
	</ul>
@stop

{{-- Conteindo de la vista. --}}
@section('content')
	<div class = "row">
		<div class = "col-md-6">
			<!-- BEGIN Portlet PORTLET-->
			<div class = "portlet light">
				<div class = "portlet-title">
					<div class = "caption font-green-sharp">
						<i class = "icon-like font-green-sharp"></i>
						<span class = "caption-subject bold uppercase"> Los más gustados</span>
						<span class = "caption-helper">Top 10 mas gustados.</span>
					</div>
					<div class = "actions">
						<a href = "{{route('cliente.promociones.create')}}" class = "btn btn-circle bg-green-jungle  hvr-grow"><i class = "fa fa-plus"></i></a>
					</div>
				</div>
				<div class = "portlet-body">
					<!-- BEGIN PAGE CONTENT-->
					<div class = "tiles">
						<div class = "col-md-12">

							@foreach($promocionesMasGustadas as $index => $promocion)
								<div class = "layer animated flipInX" style = "background-image: url('{{$promocion->imagen}}')">
									<div class = "portlet light">
										<div class = "portlet-title">
											<div class = "caption font-yellow-crusta">
												<span class = "caption-subject bold font-yellow-crusta uppercase">{{ ($index+1).'. '.$promocion->nombre_promocion}} </span>
												<br>
												<span class = "caption-helper">
													<a href = "{{route('cliente.negocio.perfil', [$promocion->cliente_id])}}" class = "faa-parent animated-icon-hover">
														<i class = "fa fa-angle-double-right faa-horizontal"></i> <b>{{$promocion->nombre_cliente}}</b>
													</a>
												</span>


											</div>
										</div>
										<div class = "portlet-body">

											<div class = "col-md-6">
											<span class = "label bg-red-thunderbird">
												<i class = "fa fa-heart faa-pulse animated-icon faa-fast"></i>
												<b>{{$promocion->totalLikes}} les gusta</b>
											</span>
											</div>
											<div class = "col-md-6">
												<a href = "{{route('cliente.promociones.show', [$promocion->id])}}" class = "btn bg-green-jungle btn-xs pull-right faa-parent animated-icon-hover  hvr-grow">
													<i class = "icon-pencil faa-ring"></i> Editar
												</a>
												{{--<button type="button" class="btn bg-green-jungle btn-xs pull-right"><i class="icon-pencil"></i> Editar</button>--}}
											</div>
											<div class = "clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach

						</div>
					</div>
					<!-- END PAGE CONTENT-->
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>
		<div class = "col-md-6">
			<!-- BEGIN Por Negocio PORTLET-->
			<div class = "portlet light">
				<div class = "portlet-title">
					<div class = "caption font-green-sharp">
						<i class = "fa fa-home font-green-sharp"></i>
						<span class = "caption-subject bold uppercase"> Por negocio</span>
					</div>
				</div>
				<div class = "portlet-body">
					<div class = "row">
						@foreach($negocios as $negocio)
							<div class = "col-sm-6 col-md-4">
								<a href = "{{route('promociones.id.cliente', [$negocio->id])}}" class = "thumbnail">
									<img src = "{{$negocio->logo()}}" alt = "100%x180" style = "height: 100%; width: 100%; display: block;">
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- END Por Negocio PORTLET-->

			<!-- BEGIN Ultimos Registrados PORTLET-->
			<div class = "portlet light">
				<div class = "portlet-title">
					<div class = "caption font-green-sharp">
						<i class = "fa fa-bars font-green-sharp"></i>
						<span class = "caption-subject bold uppercase"> Últimos registrados</span>
					</div>
					<div class = "actions">
						<a href = "{{route('cliente.promociones.create')}}" class = "btn btn-circle bg-green-jungle hvr-grow"><i class = "fa fa-plus"></i></a>
					</div>
				</div>
				<div class = "portlet-body">
					<div class = "scroller" style = "height:500px" data-rail-visible = "1" data-rail-color = "gray" data-handle-color = "#a1b2bd">
						<!-- BEGIN PAGE CONTENT-->
						<div class = "tiles">
							<div class = "col-md-12">
								@foreach($ultimosRegistrados as $index => $promocion)
									<div class = "layer animated flipInX" style = "background-image: url('{{$promocion->imagen}}')">
										<div class = "portlet light">
											<div class = "portlet-title">
												<div class = "caption font-yellow-crusta">
													<span class = "caption-subject bold font-yellow-crusta uppercase">{{ ($index+1).'. '.$promocion->nombre}} </span>
													<br>
													<span class = "caption-helper">
														<a href = "{{route('cliente.negocio.perfil', [$promocion->cliente_id])}}" class = "faa-parent animated-icon-hover">
															<i class = "fa fa-angle-double-right faa-horizontal"></i>
															<b>{{$promocion->nombre_cliente}}</b>
														</a>
													</span>
												</div>
											</div>
											<div class = "portlet-body">
												<div class = "col-md-12">
													<h4 style = "margin-top: 5px">{{$promocion->descripcion_corta}}</h4>
												</div>
												<div class = "col-md-6">
													<span class = "label bg-yellow-saffron">
														<i class = "fa fa-calendar"></i>
														<b>{{$promocion->fecha}}</b>
													</span>
												</div>
												<div class = "col-md-6">
													<a href = "{{route('cliente.promociones.show', [$promocion->id])}}" class = "btn bg-green-jungle btn-xs pull-right faa-parent animated-icon-hover  hvr-grow">
														<i class = "icon-pencil faa-ring"></i> Editar
													</a>
													{{--<button type="button" class="btn bg-green-jungle btn-xs pull-right"><i class="icon-pencil"></i> Editar</button>--}}
												</div>
												<div class = "clearfix"></div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
						<!-- END PAGE CONTENT-->
					</div>
				</div>
			</div>
			<!-- END Ultimos Registrados PORTLET-->
		</div>
	</div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	{{--<script src="{{asset('assets/admin/pages/app/cliente/promociones/index.js')}}" type="text/javascript"></script>--}}
@stop
