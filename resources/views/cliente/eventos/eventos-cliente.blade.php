{{-- Extender de menú cliente o menú admin--}}
@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos
@section('plugins-css')@stop --}}

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
	<h1>Eventos de {{$cliente->nombre}}
		<small>Todos los eventos registrados.</small>
	</h1>
@stop

{{-- Sobreescribir el toolbar de pagina
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de pagina --}}
@section('page-breadcrumb')
	<ul class = "page-breadcrumb breadcrumb">
		<li>
			<a href = "{{route('cliente')}}">Inicio</a>
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

{{-- Contenido de la vista. --}}
@section('content')
	<div class = "row">
		<!-- BEGIN Productos por Eventos Activos PORTLET-->
		<div class = "col-md-4">
			<div class = "portlet light animated bounceInUp">
				<div class = "portlet-title">
					<div class = "caption">
						<i class = "icon-speech"></i>
						<span class = "caption-subject bold uppercase"> Eventos activos</span>
					</div>
				</div>
				<div class = "portlet-body form">
					<input type = "hidden" name = "id_cliente" value = "{{$cliente->id}}">
					<table class = "table table-striped table-hover table-bordered" id = "eventos_activos" data-url = "{{route('cliente-table-datatableActivos-eventos')}}">
						<thead>
						<tr>
							<th>Nombre</th>
							<th></th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- END Productos por Eventos Activos PORTLET-->

		<!-- BEGIN Productos por Eventos Pasados PORTLET-->
		<div class = "col-md-4">
			<div class = "portlet light animated bounceInUp">
				<div class = "portlet-title">
					<div class = "caption">
						<i class = "icon-speech"></i>
						<span class = "caption-subject bold uppercase"> Eventos pasados</span>
					</div>
				</div>
				<div class = "portlet-body form">
					<input type = "hidden" name = "id_cliente" value = "{{$cliente->id}}">
					<table class = "table table-striped table-hover table-bordered" id = "eventos_pasados" data-url = "{{route('cliente-table-datatablePasados-eventos')}}">
						<thead>
						<tr>
							<th>Nombre</th>
							<th></th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- END Productos por Eventos Pasados PORTLET-->
	</div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js
@section('plugins-core-js')@stop --}}

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/datatables.all.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/select2/js/select2.min.js')}}"></script>
	<script type = "text/javascript" src = "{{asset('assets/admin/pages/app/cliente/eventos/evento-cliente.js')}}"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
	EventosCliente.init();
@stop