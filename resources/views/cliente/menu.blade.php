@extends('_base.main')

@section('header-actions')
<div class="page-actions">
    <div class="btn-group">
        <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="hidden-sm hidden-xs">Acciones Rápidas&nbsp;</span><i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('cliente.negocio.create')}}"><i class="icon-home"></i> Nuevo Negocio</a></li>
	        <li><a href="{{route('cliente.producto.create')}}"><i class="icon-bag"></i> Nuevo Producto</a></li>
            <li><a href="{{route('cliente.servicios.create')}}"><i class="icon-badge"></i> Nuevo Servicio</a></li>
            <li><a href="{{route('cliente.promociones.create')}}"><i class="icon-present"></i> Nueva Promoción</a></li>
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
                    <a href="{{route('cliente')}}">
                        <i class="fa fa-dashboard"></i>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li {!! isset($activo_negocio) == TRUE ? ' class="active open" ' : '' !!}>
                    <a href="">
                        <i class="icon-home"></i>
                        <span class="title">Mis Negocios</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu {!! isset($activo_negocio) == TRUE ? 'open" ' : '' !!}">
                        @if(count($clientesRegistrados) == 0)
                            <li {!! isset($activo_negocio_nuevo) == TRUE ? ' class="active" ' : '' !!}>
                                <a href="{{route('cliente.negocio.create')}}">
                                    <i class="fa fa-plus"></i> Registrar negocio
                                </a>
                            </li>
                        @else
                            <li {!! isset($activo_negocio_index) == TRUE ? ' class="active" ' : '' !!}>
                                <a href="{{route('negocios-cliente')}}">
                                    <i class="fa fa-dashboard"></i> General
                                </a>
                            </li>
                            {{--*/ $current_cliente_id = (isset($current_cliente_id) ? $current_cliente_id : NULL) /*--}}
                            @foreach($clientesRegistrados as $cliente)
                                <li {!! ($cliente->id == $current_cliente_id) ? ' class="active" ' : '' !!}>
                                <a href="{{route('cliente.negocio.perfil',[$cliente->id])}}">
                                    <i class="fa fa-star "></i>
                                    <b>{{str_limit($cliente->nombre, 15)}}</b>
                                </a>
                            </li>
                            @endforeach
                            <li {!! isset($activo_negocio_nuevo) == TRUE ? ' class="active" ' : '' !!}>
                                <a href="{{route('cliente.negocio.create')}}">
                                    <i class="fa fa-plus"></i> Registrar negocio
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li {!! isset($activo_clientes) == TRUE ? ' class="active open" ' : '' !!}>
                    <a href="{{route('usuarios-cliente')}}">
                        <i class="icon-user-following"></i>
                        <span class="title">Seguidores</span>
                    </a>
                </li>
                <li {!! isset($activo_productos) == TRUE ? ' class="active open" ' : '' !!}>
                    <a href="{{route('productos-cliente')}}">
                        <i class="icon-bag"></i>
                        <span class="title">Productos</span>
                    </a>
                </li>
                <li {!! isset($activo_servicios) == TRUE ? ' class="active open" ' : '' !!}>
                    <a href="{{route('servicios')}}">
                        <i class="icon-badge"></i>
                        <span class="title">Servicios</span>
                    </a>
                </li>
                <li {!! isset($activo_promociones) == TRUE ? ' class="active open" ' : '' !!}>
                    <a href="{{route('promociones')}}">
                        <i class="icon-present"></i>
                        <span class="title">Promociones</span>
                    </a>
                </li>
                <li {!! isset($activo_eventos) == TRUE ? ' class="active open" ' : '' !!}>
                    <a href="{{route('eventos')}}">
                        <i class="icon-calendar"></i>
                        <span class="title">Eventos</span>
                    </a>
                </li>
	            <li {!! isset($activo_categorias) == TRUE ? ' class="active open" ' : '' !!}>
		            <a href="{{route('categorias-cliente')}}">
			            <i class="icon-tag"></i>
			            <span class="title">Categorías</span>
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