@extends('cliente.menu')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
	<link href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css"/>
@stop

{{-- Sobreescribir el sidebar
@section('sidebar')@stop --}}

{{-- Modales de la vista
@section('modal')@stop --}}

{{-- Sobreescribir el título de pagina--}}
@section('page-title')
	<h1>Registro de nuevo negocio
		<small>Información básica del negocio</small>
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
			<a href="{{route('negocios-cliente')}}">Clientes</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="{{URL::current()}}">Nuevo</a>
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
                                    <label class="col-md-4 control-label">Lugar <span class="required" aria-required="true">*</span> </label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-institution"></i>
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre del lugar">
                                            <input type="hidden" name="propietario_id" value="{{$user->id}}">
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
                                        {!! Form::select('categoria1', $options_categorias, NULL, ['class' => 'form-control select2', 'id' => 'categoria', 'data-url' => route('global-select-subcategorias')]) !!}
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
                                        {!! Form::select('categoria2', $options_categorias, NULL, ['class' => 'form-control select2', 'id' => 'categoria2', 'data-url' => route('global-select-subcategorias')]) !!}
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
                                        {!! Form::select('categoria3', $options_categorias, NULL, ['class' => 'form-control select2', 'id' => 'categoria3', 'data-url' => route('global-select-subcategorias')]) !!}
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
                            <h4 class="form-section">Google Maps</h4>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="calle_registrada" placeholder="Calle No. Colonia, Ciudad Estado">
                                        <span class="input-group-btn">
                                            <button class="btn blue faa-parent animated-icon-hover" id="gmap_geocoding_btn">
                                                <i class="fa fa-map-marker faa-vertical"></i> Ubicar
                                            </button>
                                        </span>
                                    </div>
                                    <span class="help-block">Dirección formada en base a los datos del formulario. Presione ubicar para mostrarlo en el mapa.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="gmap_geocoding_address" placeholder="Dirección de Google Maps" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn red faa-parent animated-icon-hover" id="gmap_address_replace">
                                                <i class="fa fa-repeat faa-spin"></i> Remplazar
                                            </button>
                                        </span>
                                    </div>
                                    <span class="help-block">Dirección formada pro Google Maps. Presione Remplazar para sustituir la dirección por los valores de Google Maps.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <div class="col-md-6">
                                        <label class="control-label">Latitud</label>
                                        <input type="text" class="form-control input-large" placeholder="Latitud" name="latitud" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Longitud</label>
                                        <input type="text" class="form-control input-large" placeholder="Longitud" name="longitud" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <div id="gmap_geocoding" class="gmaps" style="height: 500px"></div>
                                    <span class="help-block">El indicador es solo una referencia muy cercana al lugar. </span>
                                </div>
                            </div>
                        </div>

                        {{--Accion--}}
                        <div class="col-md-12">
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn green hvr-grow"><b>Registrar</b></button>
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
<script src="{{asset('assets/global/plugins/jquery-inputmask/dist/jquery.inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/select2.js')}}" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/gmaps/gmaps.min.js')}}" type="text/javascript"></script>
@stop

{{-- Cargar los archivos de js  --}}
@section('page-level-js')
	<script src="{{asset('assets/admin/pages/app/cliente/negocios/nuevo-negocio.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js --}}
@section('init-js')
	NuevoCliente.init();
@stop