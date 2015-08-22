@extends('_base.main')

@section('header-actions')
	<div class="page-actions">
		<div class="btn-group">
			<button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<span class="hidden-sm hidden-xs">Acciones Rápidas&nbsp;</span><i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="{{route('adm.nuevo.propietario')}}"><i class="icon-user-follow"></i> Nuevo Propietario</a></li>
				<li><a href="{{route('adm.nuevo.cliente')}}"><i class="icon-user-follow"></i> Nuevo Cliente</a></li>
				<li><a href="javascript:"><i class="icon-share"></i> Share</a></li>
				<li class="divider"></li>
				<li>
					<a href="javascript:">
						<i class="icon-flag"></i> Comments
						<span class="badge badge-success">4</span>
					</a>
				</li>
				<li>
					<a href="javascript:">
						<i class="icon-users"></i> Feedbacks
						<span class="badge badge-danger">2</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
@stop

@section('sidebar')
	<div class="page-sidebar-wrapper animated bounceInLeft">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">

			<!-- BEGIN SIDEBAR MENU -->
			{{--<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->--}}
			{{--<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->--}}
			{{--<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->--}}
			{{--<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->--}}
			{{--<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->--}}
			{{--<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->--}}
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start {{isset($activo_inicio) == TRUE ? 'active' : ''}}">
					<a href="{{route('admin')}}">
						<i class="icon-home"></i>
						<span class="title">Inicio</span>
					</a>
				</li>
				<li {!! isset($activo_clientes) == TRUE ? ' class="active open" ' : '' !!}>
					<a href="{{route('clientes')}}">
						<i class="icon-users"></i>
						<span class="title">Clientes</span>
					</a>
				</li>
				<li {!! isset($activo_usuarios) == TRUE ? ' class="active open" ' : '' !!}>
					<a href="{{route('usuarios-admin')}}">
						<i class="icon-users"></i>
						<span class="title">Usuarios</span>
					</a>
				</li>
				<li {!! isset($activo_propietarios) == TRUE ? ' class="active open" ' : '' !!}>
					<a href="{{route('propietarios')}}">
						<i class="icon-users"></i>
						<span class="title">Propietarios</span>
					</a>
				</li>
				<li {!! isset($activo_ciudades) == TRUE ? ' class="active open" ' : '' !!}>
					<a href="{{route('ciudades')}}">
						<i class="icon-globe"></i>
						<span class="title">Ciudades</span>
					</a>
				</li>
				<li {!! isset($activo_categorias) == TRUE ? ' class="active open" ' : '' !!}>
					<a href="{{route('categorias-admin')}}">
						<i class="icon-list"></i>
						<span class="title">Categorias</span>
					</a>
				</li>
				<li class="last ">
					<a href="javascript:">
						<i class="icon-pointer"></i>
						<span class="title">Último</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li><a href="">Google Maps</a></li>
						<li><a href="">Vector Maps</a></li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
@stop