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
      <h1>Promociones de {{$cliente->nombre}}
            <small>Todos las promociones registradas.</small>
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
						  <span class="caption-subject bold uppercase"> Promociones Vigentes</span>
					  </div>
				  </div>
				  <div class="portlet-body form">
					  <input type="hidden" name="id_cliente" value="{{$cliente->id}}">
					  <table class="table table-striped table-hover table-bordered" id="promociones_vigentes" data-url="{{route('cliente-table-datatable-promociones-categoria')}}">
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
			  <!-- BEGIN Productos por Categoria PORTLET-->
			  <div class="portlet light animated bounceInUp">
				  <div class="portlet-title">
					  <div class="caption">
						  <i class="icon-speech"></i>
						  <span class="caption-subject bold uppercase"> Promociones fijas</span>
					  </div>
				  </div>
				  <div class="portlet-body form">
					  <input type="hidden" name="id_cliente" value="{{$cliente->id}}">
					  <table class="table table-striped table-hover table-bordered" id="promociones_fijas" data-url="{{route('cliente-table-datatable-promociones-categoria')}}">
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
			  <!-- BEGIN Productos por Categoria PORTLET-->
			  <div class="portlet light animated bounceInUp">
				  <div class="portlet-title">
					  <div class="caption">
						  <i class="icon-speech"></i>
						  <span class="caption-subject bold uppercase"> Promociones Caducas</span>
					  </div>
				  </div>
				  <div class="portlet-body form">
					  <input type="hidden" name="id_cliente" value="{{$cliente->id}}">
					  <table class="table table-striped table-hover table-bordered" id="promociones_caducas" data-url="{{route('cliente-table-datatable-promociones-categoria')}}">
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

      </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js
@section('plugins-core-js')@stop --}}

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.min.js')}}"></script>
	<script src="{{asset('assets/admin/pages/app/cliente/promociones/promociones-cliente.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
	PromocionesCliente.init();
@stop