@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
	<link href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
	<h1>Registro de nuevo producto
		<small>Información básica del producto</small>
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
			<a href="{{route('productos-cliente')}}">Productos</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="">Nuevo</a>
		</li>
	</ul>
@stop

{{-- Conteindo de la vista. --}}
@section('content')
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet light animated bounceInUp">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-bag"></i>
						<span class="caption-subject bold uppercase"> Producto</span>
						<span class="caption-helper">Registro de producto</span>
					</div>
					<div class="actions">
						<button class="btn btn-circle bg-green-turquoise" id="agregar"><i class="fa fa-plus"></i> Agregar </button>
						<a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
					</div>
				</div>
				<div class="portlet-body form">
					{!! Form::open($param) !!}
					<div class="col-md-6">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Negocio <span class="required">*</span></label>

								<div class="col-md-9">
									{!! Form::select('cliente_id', $negocios, NULL, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Producto <span class="required">*</span></label>

								<div class="col-md-9">
									<div class="input-icon">
										<i class="fa fa-star"></i>
										<input type="text" class="form-control" name="nombre" placeholder="Nombre del producto">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Slug <span class="required">*</span></label>

								<div class="col-md-9">
									<div class="input-icon">
										<i class="fa fa-desktop"></i>
										<input type="text" class="form-control" name="slug" placeholder="Url del producto" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Descripción <span class="required">*</span></label>

								<div class="col-md-9">
									<textarea class="form-control" name="descripcion" maxlength="255" rows="3" style="resize: none;"></textarea>
									<span class="help-block">Descripción detallada del producto. </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Descripción corta <span class="required">*</span></label>

								<div class="col-md-9">
									<textarea class="form-control" name="descripcion_corta" maxlength="45" rows="2" style="resize: none;"></textarea>
									<span class="help-block">Descripción resumida del producto. </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Estatus <span class="required">*</span></label>

								<div class="col-md-9">
									<input type="checkbox" class="make-switch" name="estatus"
									       data-size="small"
									       data-on-text="Online" data-off-text="Offline"
									       data-on-color="success"
									       data-off-color="default">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Precio <span class="required">*</span></label>

								<div class="col-md-9">
									<div class="input-inline input-medium">
										<input id="precio" type="text" name="precio" class="form-control" value="0">
									</div>
									<span class="help-block">Solo dos deciamles (99.99), 0 es gratis </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Cantidad</label>

								<div class="col-md-9">
									<div class="input-inline input-medium">
										<input id="cantidad" type="text" name="cantidad" class="form-control" value="0">
									</div>
									<span class="help-block">Unidades enteras</span>
								</div>
							</div>

							<div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn default" id="reportrange"><i class="fa fa-calendar"></i> Disposición <i class="fa fa-angle-down"></i></button>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Inicio <span class="required">*</span></label>

								<div class="col-md-9">
									<div class="input-icon">
										<i class="fa fa-calendar"></i>
										<input type="text" class="form-control" name="disp_inicio" placeholder="Url del producto" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Final <span class="required">*</span></label>

								<div class="col-md-9">
									<div class="input-icon">
										<i class="fa fa-calendar"></i>
										<input type="text" class="form-control" name="disp_fin" placeholder="Url del producto" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-2 col-md-10">
									<button type="submit" class="btn green">Registrar</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					<div class="clearfix"></div>
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
	<script src="{{asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/moment-with-locales.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
	{!! \Html::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/jquery-validation/js/localization/messages_es.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Cargar los archivos de js  --}}
@section('page-level-js')
	{!! \Html::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/select2/select2.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/admin/pages/app/cliente/productos/nuevo-producto.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Inicializo los js --}}
@section('init-js')
	NuevoProducto.init();
@stop