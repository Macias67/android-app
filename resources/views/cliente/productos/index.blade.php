@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos
@section('plugins-css')@stop --}}

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
            <div class="col-md-6">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-puzzle font-grey-gallery"></i>
						<span class="caption-subject bold font-grey-gallery uppercase">Más gustados</span>
						<span class="caption-helper">more samples...</span>
					</div>
					<div class="tools">
						<a href="" class="collapse"></a>
						<a href="#portlet-config" data-toggle="modal" class="config"></a>
						<a href="" class="reload"></a>
						<a href="javascript:;" class="fullscreen"></a>
						<a href="" class="remove"></a>
					</div>
				</div>
				<div class="portlet-body">
					<h4>Heading text goes here...</h4>
					<p>
						Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
					</p>
				</div>
			{{--</div>--}}
            </div>
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
	<script src="{{asset('assets/admin/pages/app/cliente/productos/index.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
{{--Productos.init();--}}
@stop