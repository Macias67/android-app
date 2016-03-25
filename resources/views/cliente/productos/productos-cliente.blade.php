{{-- Extender de menú cliente o menú admin--}}
@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
	<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
      <h1>Productos de {{$cliente->nombre}}
            <small>Todos los productos registrados.</small>
      </h1>
@stop

{{-- Sobreescribir el toolbar de pagina
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de pagina --}}
@section('page-breadcrumb')
      <ul class="page-breadcrumb breadcrumb">
            <li>
                  <a href="{{route('cliente')}}">Inicio</a>
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
            <div class="col-md-4">
	            <!-- BEGIN Productos por Categoria PORTLET-->
	            <div class="portlet light animated bounceInUp">
		            <div class="portlet-title">
			            <div class="caption">
				            <i class="icon-speech"></i>
				            <span class="caption-subject bold uppercase"> Por Nombre</span>
			            </div>
		            </div>
		            <div class="portlet-body form">
			            <input type="hidden" name="id_cliente" value="{{$cliente->id}}">
			            <table class="table table-striped table-hover table-bordered" id="productos_nombre" data-url="{{route('cliente-table-datatable-productos-categoria')}}">
				            <thead>
				            <tr>
					            <th>Nombre</th>
					            <th></th>
				            </tr>
				            </thead>
			            </table>
		            </div>
	            </div>
	            <!-- END Productos por Categoria PORTLET-->
            </div>

	      <div class="col-md-4">
		      <!-- BEGIN Productos por Nombre PORTLET-->
		      <div class="portlet light animated bounceInUp">
			      <div class="portlet-title">
				      <div class="caption">
					      <i class="icon-speech"></i>
					      <span class="caption-subject bold uppercase"> Por Categoría</span>
				      </div>
			      </div>
			      <div class="portlet-body form">
				      {!! Form::open($array_form) !!}
				      <div class="form-body">
					      <div class="form-group">
						      {!! Form::select('categoria_id', $categorias, $llaves[0], ['class' => 'form-control']) !!}
					      </div>
				      </div>
				      {!! Form::close() !!}
				      <br>
				      <table class="table table-striped table-hover table-bordered" id="productos_categorias" data-url="{{route('cliente-table-datatable-productos-categoria')}}">
					      <thead>
					      <tr>
						      <th>Nombre</th>
						      <th></th>
					      </tr>
					      </thead>
				      </table>
			      </div>
		      </div>
		      <!-- END Productos por Nombre PORTLET-->
	      </div>
      </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/datatables.all.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/select2/js/select2.min.js')}}"></script>
@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script src="{{asset('assets/admin/pages/app/cliente/productos/producto-cliente.js')}}" type="text/javascript"></script>
@stop