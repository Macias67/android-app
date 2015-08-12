@extends('admin.menu')

{{-- Adjuntar los links css de los plugins requeridos
@section('plugins-css')@stop --}}

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
	<h1>Registro de nuevo cliente
		<small>Información básica del cliente</small>
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
			<a href="#">Clientes</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="#">Nuevo</a>
		</li>
	</ul>
@stop

{{-- Conteindo de la vista. --}}
@section('content')
	<div class="row">
		<div class="col-md-6">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet light animated bounceInUp">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-speech"></i>
						<span class="caption-subject bold uppercase"> Categorías</span>
						<span class="caption-helper">weekly stats...</span>
					</div>
				</div>
				<div class="portlet-body form">
					{!! Form::open($array_form) !!}
					<div class="form-body">
						<div class="form-group form-md-line-input has-info form-md-floating-label" style="padding-top: 0px">
							<div class="input-group input-group-sm" style="padding-top: 0px">
								<div class="input-group-control">
									<input type="text" class="form-control input-sm" name="categoria">
									<input type="hidden" name="id_categoria" value="">
									<label for="form_control_1">Agrega Categoría</label>
								</div>
								<span class="input-group-btn btn-right">
									<button class="btn green-haze" id="add" type="button">Guardar</button>
								</span>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
					<br>
					<table class="table table-striped table-hover table-bordered" id="tabla_categorias">
						<thead>
						<tr>
							<th>Categoría</th>
							<th></th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>
		<div class="col-md-6">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet light animated bounceInRight">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-speech"></i>
						<span class="caption-subject bold uppercase"> Sub-Categorías</span>
						<span class="caption-helper">weekly stats...</span>
					</div>
				</div>
				<div class="portlet-body form">
					@if($llaves)
						<form role="form">
							<div class="form-body">
								<div class="form-group">
									{!! Form::select('categoria', $options, $llaves[0], array('class' => 'form-control')) !!}
								</div>
								<div class="form-group form-md-line-input has-info form-md-floating-label" style="padding-top: 0px">
									<div class="input-group input-group-sm" style="padding-top: 0px">
										<div class="input-group-control">
											<input type="text" class="form-control input-sm" name="subcategoria">
											<input type="hidden" name="subcategoria_id" value="">
											<label for="form_control_1">Agrega Subcategoría</label>
										</div>
								<span class="input-group-btn btn-right">
									<button class="btn green-haze" id="add_sub" type="button">Guardar</button>
								</span>
									</div>
								</div>
							</div>
						</form>
						<br>
						<table class="table table-striped table-hover table-bordered" id="tabla_subcategorias" data-url="{{route('table-json-subcategorias')}}">
							<thead>
							<tr>
								<th>Subcategoría</th>
								<th></th>
							</tr>
							</thead>
						</table>
					@else
						<h3>No hay categorías registradas.</h3>
					@endif
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>
	</div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>
@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script type="text/javascript" src="{{asset('assets/admin/pages/app/admin/categorias/categorias.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/pages/app/admin/categorias/subcategorias.js')}}"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
	Categorias.init();
	Subcategorias.init();
@stop