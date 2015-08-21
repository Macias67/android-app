@extends('admin.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
	{!! \Html::style('assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['rel' => 'stylesheet']) !!}
	{!! \Html::style('assets/global/plugins/select2/select2.css', ['rel' => 'stylesheet']) !!}
	{!! \Html::style('assets/global/plugins/jquery-multi-select/css/multi-select.css', ['rel' => 'stylesheet']) !!}
@stop

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
		<div class="col-md-12">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet light animated bounceInUp">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-user-follow"></i>
						<span class="caption-subject bold uppercase"> Cliente</span>
						<span class="caption-helper">Registro de cliente</span>
					</div>
					<div class="actions">
						<a href="{{route('adm.nuevo.propietario')}}" class="btn btn-circle btn-success">
							<i class="fa fa-plus"></i> Añadir Propietario
						</a>
						<a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
					</div>
				</div>
				<div class="portlet-body form">
					{!! Form::open($param) !!}
                        {{--Datos basicos--}}
                        <div class="col-md-6">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Estatus <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        <input type="checkbox" class="make-switch" name="estatus"
                                               data-size="small"
                                               data-on-text="Online" data-off-text="Offline"
                                               data-on-color="success"
                                               data-off-color="default">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Propietario <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        <input type="hidden" id="propietario" name="propietario_id" class="form-control select2" data-url="{{route('select-json-propietarios')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Lugar <span class="required" aria-required="true">*</span> </label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-institution"></i>
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre del lugar">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Calle <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-map-marker"></i>
                                            <input type="text" class="form-control" name="calle" placeholder="Calle">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Número <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-icon input-small">
                                            <i class="fa fa-slack"></i>
                                            <input type="text" class="form-control" name="numero" placeholder="Número">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Colonia <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-map-marker"></i>
                                            <input type="text" class="form-control" name="colonia" placeholder="Colonia">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Código Postal <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-icon input-small">
                                            <i class="fa fa-globe"></i>
                                            <input type="text" class="form-control" name="codigo_postal" placeholder="Código Postal">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Referencias <span class="required" aria-required="true">*</span></label>

                                    <div class="col-md-8">
                                        <textarea class="form-control" name="referencia" rows="3" style="resize: none;"></textarea>
                                        <span class="help-block">Descripción de lugares, monumentos, calles o algún indicador cercano al lugar. </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Ciudad <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        {!! Form::select('ciudad_id', $options_ciudades, NULL, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Categoría 1 <span class="required" aria-required="true">*</span></label>
                                    <div class="col-md-8">
                                        {!! Form::select('categoria1', $options_categorias, NULL, ['class' => 'form-control select2', 'id' => 'categoria', 'data-url' => route('select-subcategorias')]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        {!! Form::select('subcategoria1', [], NULL, ['class' => 'form-control select2', 'id' => 'subcategoria']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Categoría 2</label>
                                    <div class="col-md-8">
                                        {!! Form::select('categoria2', $options_categorias, NULL, ['class' => 'form-control select2', 'id' => 'categoria2', 'data-url' => route('select-subcategorias')]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        {!! Form::select('subcategoria2', [], NULL, ['class' => 'form-control select2', 'id' => 'subcategoria2']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Categoría 3</label>
                                    <div class="col-md-8">
                                        {!! Form::select('categoria3', $options_categorias, NULL, ['class' => 'form-control select2', 'id' => 'categoria3', 'data-url' => route('select-subcategorias')]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        {!! Form::select('subcategoria3', [], NULL, ['class' => 'form-control select2', 'id' => 'subcategoria3']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Mapas--}}
                        <div class="col-md-12">
                            <h4 class="form-section">Coordenadas y ubicación</h4>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Latitud y Longitud <span class="required" aria-required="true">*</span></label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="gmap_geocoding_address" placeholder="Dirección completa...">
                                            <span class="input-group-btn">
                                                  <button class="btn blue" id="gmap_geocoding_btn">
                                                      <i class="fa fa-map-marker"></i></button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input type="text" class="form-control" placeholder="Readonly" name="latlng_gmaps" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <div id="gmap_geocoding" class="gmaps"></div>
                                    <span class="help-block">El indicador es solo una referencia muy cercana al lugar. </span>
                                </div>
                            </div>
                        </div>
                        {{--Accion--}}
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
	{!! \Html::script('assets/global/plugins/jquery-inputmask/dist/jquery.inputmask.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/jquery-validation/js/localization/messages_es.js', array('type' => 'text/javascript')) !!}
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	{!! \Html::script('assets/global/plugins/gmaps/gmaps.min.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Cargar los archivos de js  --}}
@section('page-level-js')
	{!! \Html::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/select2/select2.min.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', array('type' => 'text/javascript')) !!}
	{!! \Html::script('assets/admin/pages/app/admin/clientes/nuevo-cliente.js', array('type' => 'text/javascript')) !!}
@stop

{{-- Inicializo los js --}}
@section('init-js')
	NuevoCliente.init();
@stop