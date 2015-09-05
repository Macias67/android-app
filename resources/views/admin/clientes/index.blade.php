@extends('admin.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
    <link href="{{asset('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css">
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
    <h1>Gestión de clientes
        <small>Detalles de todos los clientes registrados.</small>
    </h1>
@stop

{{-- Sobreescribir el toolbar de pagina
@section('page-toolbar')@stop --}}

{{-- Sobreescribir el breadcrumb de pagina --}}
@section('page-breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{route('admin')}}">Inicio</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{route('clientes')}}">Clientes</a>
        </li>
    </ul>
@stop

{{-- Conteindo de la vista. --}}
@section('content')
      <div class="row">
            <div class="col-md-8">
                  <!-- BEGIN Portlet PORTLET-->
                  <div class="portlet light animated bounceInUp">
                        <div class="portlet-title">
                              <div class="caption font-green-sharp">
                                    <i class="fa fa-list-ul font-green-sharp"></i>
                                    <span class="caption-subject bold uppercase"> Listado de clintes</span>
                                    <span class="caption-helper">Clientes registrados en toda la aplicación</span>
                              </div>
                              <div class="actions">
                                    <a href="{{route('adm.nuevo.cliente')}}" class="btn btn-circle bg-green-turquoise"><i class="fa fa-plus"></i> Nuevo Cliente </a>
	                              <a href="{{route('adm.nuevo.propietario')}}" class="btn btn-circle bg-green-turquoise"><i class="fa fa-plus"></i> Nuevo Propietario </a>
                              </div>
                        </div>
                        <div class="portlet-body">
                              <table class="table table-striped table-bordered table-advance table-hover" id="clientes" data-url="{{route('table-json-clientes')}}" token="{{csrf_token()}}">
                                    <thead>
                                          <tr>
                                                <th><i class="fa fa-power-off"></i></th>
                                                <th width="30%"><i class="fa fa-university"></i> Nombre</th>
                                                <th width="20%"><i class="fa fa-user"></i> Propietario</th>
                                                <th width="20%"><i class="fa fa-globe"></i> Ciudad</th>
                                                <th width="23%"><i class="fa fa-calendar"></i> Registrado desde</th>
                                                <th width="7%"></th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                              </table>
                        </div>
                  </div>
                  <!-- END Portlet PORTLET-->
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
@stop

{{-- Sobreescribir el encabezado de pagina
@section('page-footer-inner')@stop --}}

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
    {!! \Html::script('assets/global/plugins/select2/select2.min.js', array('type' => 'text/javascript')) !!}
    {!! \Html::script('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js', array('type' => 'text/javascript')) !!}
    {!! \Html::script('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Cargar los archivos de js  --}}
@section('page-level-js')
    {!! \Html::script('assets/admin/pages/app/admin/clientes/clientes.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Inicializo los js --}}
@section('init-js')
    Clientes.init();
@stop