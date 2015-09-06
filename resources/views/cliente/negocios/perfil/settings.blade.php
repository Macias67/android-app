@extends('cliente.negocios.perfil.perfil')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
	<link href="{{asset('assets/admin/pages/css/profile.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/croppic/croppic.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('profile-content')
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Información</span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_principal" data-toggle="tab">Principal</a>
							</li>
							<li>
								<a href="#tab_adicional" data-toggle="tab">Adicional</a>
							</li>
							<li>
								<a href="#tab_sociales" data-toggle="tab">Redes Sociales</a>
							</li>
							<li>
								<a href="#tab_horarios" data-toggle="tab">Horarios</a>
							</li>
							<li>
								<a href="#tab_logotipo" data-toggle="tab">Logotipo</a>
							</li>
							<li>
								<a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
							</li>
						</ul>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane active" id="tab_principal">
								{!! Form::model($cliente, $formprincipal) !!}
								{{--Datos basicos--}}
								<div class="col-md-6">
									<div class="form-body">
										{{--Estatus--}}
										<div class="form-group">
											<label class="control-label col-md-4">Estatus
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												<input type="checkbox" class="make-switch" name="estatus"
												       @if($cliente->estatus == 'online')
												       checked
												       @endif
												       data-size="small"
												       data-on-text="Online" data-off-text="Offline"
												       data-on-color="success"
												       data-off-color="default">
											</div>
										</div>
										{{--Lugar--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Lugar
												<span class="required" aria-required="true">*</span>
											</label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-institution"></i>
													{!! Form::text('nombre', NULL, ['class' => 'form-control', 'placeholder' => 'Nombre del lugar']) !!}
													{!! Form::hidden ('propietario_id') !!}
													{!! Form::hidden ('id') !!}
												</div>
											</div>
										</div>
										{{--Calle--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Calle
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													{!! Form::text('calle', NULL, ['class' => 'form-control', 'placeholder' => 'Calle']) !!}
												</div>
											</div>
										</div>
										{{--Numero--}}
										<div class="form-group">
											<label class="control-label col-md-4">Número
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												<div class="input-icon input-small">
													<i class="fa fa-slack"></i>
													{!! Form::text('numero', NULL, ['class' => 'form-control', 'placeholder' => 'Número']) !!}
												</div>
											</div>
										</div>
										{{--Colonia--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Colonia
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													{!! Form::text('colonia', NULL, ['class' => 'form-control', 'placeholder' => 'Colonia']) !!}
												</div>
											</div>
										</div>
										{{--Codigo Postal--}}
										<div class="form-group">
											<label class="control-label col-md-4">Código Postal
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												<div class="input-icon input-small">
													<i class="fa fa-globe"></i>
													{!! Form::text('codigo_postal', NULL, ['class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
												</div>
											</div>
										</div>
										{{--Referencias--}}
										<div class="form-group">
											<label class="control-label col-md-4">Referencias
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												{!! Form::textarea('referencia', NULL, ['class' => 'form-control', 'rows' => 3, 'style' => 'resize: none;']) !!}
												<span class="help-block">Descripción de lugares, monumentos, calles o algún indicador cercano al lugar. </span>
											</div>
										</div>
										{{--Ciudad--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Ciudad
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												{!! Form::select('ciudad_id', $options_ciudades, NULL, ['class' => 'form-control']) !!}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-body">
										{{--Categoria 1--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Categoría 1
												<span class="required" aria-required="true">*</span></label>

											<div class="col-md-8">
												{!! Form::select('categoria1', $options_categorias, $cl_categorias[0]['categoria'], ['class' => 'form-control select2', 'id' => 'categoria', 'data-url' => route('global-select-subcategorias')]) !!}
											</div>
										</div>
										{{--SubCategoria 1--}}
										<div class="form-group">
											<div class="col-md-offset-4 col-md-8">
												{!! Form::select('subcategoria1', [], NULL, ['class' => 'form-control select2', 'id' => 'subcategoria', 'sub' => $cl_categorias[0]['subcategoria']]) !!}
											</div>
										</div>
										{{--Categoria 2--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Categoría 2</label>

											<div class="col-md-8">
												{!! Form::select('categoria2', $options_categorias, $cl_categorias[1]['categoria'], ['class' => 'form-control select2', 'id' => 'categoria2', 'data-url' => route('global-select-subcategorias')]) !!}
											</div>
										</div>
										{{--SubCategoria 2--}}
										<div class="form-group">
											<div class="col-md-offset-4 col-md-8">
												{!! Form::select('subcategoria2', [], NULL, ['class' => 'form-control select2', 'id' => 'subcategoria2',  'sub' => $cl_categorias[1]['subcategoria']]) !!}
											</div>
										</div>
										{{--Categoria 3--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Categoría 3</label>

											<div class="col-md-8">
												{!! Form::select('categoria3', $options_categorias, $cl_categorias[2]['categoria'], ['class' => 'form-control select2', 'id' => 'categoria3', 'data-url' => route('global-select-subcategorias')]) !!}
											</div>
										</div>
										{{--SubCategoria 3--}}
										<div class="form-group">
											<div class="col-md-offset-4 col-md-8">
												{!! Form::select('subcategoria3', [], NULL, ['class' => 'form-control select2', 'id' => 'subcategoria3', 'sub' => $cl_categorias[2]['subcategoria']]) !!}
											</div>
										</div>
									</div>
								</div>

								{{--Mapas--}}
								<div class="col-md-12">
									<h4 class="form-section">Google Maps</h4>
									<hr>
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
												{!! Form::text('latitud', NULL, ['class' => 'form-control input-medium', 'placeholder' => 'Latitud', 'readonly']) !!}
											</div>
											<div class="col-md-6">
												<label class="control-label">Longitud</label>
												{!! Form::text('longitud', NULL, ['class' => 'form-control input-medium', 'placeholder' => 'Longitud', 'readonly']) !!}
											</div>
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
								<div class="col-md-offset-2 col-md-10">
									<div class="margin-top-20">
										<button type="submit" class="btn green-haze hvr-grow">Guardar cambios</button>
									</div>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
							<!-- END PERSONAL INFO TAB -->

							<!-- ADICIONAL INFO TAB -->
							<div class="tab-pane" id="tab_adicional">
								{!! Form::model($cliente->detalles, $formadicional) !!}
								{!! Form::hidden ('id', $cliente->id) !!}
								{!! Form::hidden ('propietario_id', $cliente->propietario_id) !!}
								<div class="col-md-6">
									<div class="form-body">
										{{--Descripcion--}}
										<div class="form-group">
											<label class="control-label col-md-4">Descripción </label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													{!! Form::textarea('descripcion', NULL, ['class' => 'form-control', 'rows' => 3, 'style' => 'resize: none;']) !!}
												</div>
												<span class="help-block">Descripción detallado del negocio. </span>
											</div>
										</div>
										{{--Slogan--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Slogan </label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													{!! Form::textarea('slogan', NULL, ['class' => 'form-control', 'rows' => 2, 'style' => 'resize: none;']) !!}
												</div>
											</div>
										</div>
										{{--Website--}}
										<div class="form-group">
											<label class="control-label col-md-4">Website </label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-slack"></i>
													{!! Form::text('website', NULL, ['class' => 'form-control', 'placeholder' => 'Website']) !!}
												</div>
											</div>
										</div>
										{{--Email--}}
										<div class="form-group">
											<label class="col-md-4 control-label">Email </label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													{!! Form::text('email_negocio', NULL, ['class' => 'form-control', 'placeholder' => 'Email del Negocio']) !!}
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-body">
										{{--Telefono 1--}}
										<div class="form-group">
											<label class="control-label col-md-5">Teléfono 1 </label>

											<div class="col-md-7">
												<div class="input-icon input-small">
													<i class="fa fa-globe"></i>
													{!! Form::text('telefono1', NULL, ['class' => 'form-control', 'placeholder' => 'Teléfono 1']) !!}
												</div>
											</div>
										</div>
										{{--Telefono 2--}}
										<div class="form-group">
											<label class="control-label col-md-5">Teléfono 2</label>

											<div class="col-md-7">
												<div class="input-icon input-small">
													<i class="fa fa-globe"></i>
													{!! Form::text('telefono2', NULL, ['class' => 'form-control', 'placeholder' => 'Teléfono 2']) !!}
												</div>
											</div>
										</div>
										{{--Telefono 3--}}
										<div class="form-group">
											<label class="control-label col-md-5">Teléfono 3 </label>

											<div class="col-md-7">
												<div class="input-icon input-small">
													<i class="fa fa-globe"></i>
													{!! Form::text('telefono3', NULL, ['class' => 'form-control', 'placeholder' => 'Teléfono 3']) !!}
												</div>
											</div>
										</div>
										{{--Tarjeta Débito/Crédito--}}
										<div class="form-group">
											<label class="control-label col-md-5">Tarjeta Débito/Crédito </label>

											<div class="col-md-7">
												<input type="checkbox" class="make-switch" name="pago_tarjeta"
												       data-size="small"
												       data-on-text="Sí" data-off-text="No"
												       data-on-color="success"
												       data-off-color="default">
											</div>
										</div>
										{{--Reservaciones--}}
										<div class="form-group">
											<label class="control-label col-md-5">Reservaciones </label>

											<div class="col-md-7">
												<input type="checkbox" class="make-switch" name="reservaciones"
												       data-size="small"
												       data-on-text="Sí" data-off-text="No"
												       data-on-color="success"
												       data-off-color="default">
											</div>
										</div>
										{{--Servicio domicilio--}}
										<div class="form-group">
											<label class="control-label col-md-5">Servicio a domicilio </label>

											<div class="col-md-7">
												<input type="checkbox" class="make-switch" name="servicio_domicilio"
												       data-size="small"
												       data-on-text="Sí" data-off-text="No"
												       data-on-color="success"
												       data-off-color="default">
											</div>
										</div>
										{{--Mesas al aire libre--}}
										<div class="form-group">
											<label class="control-label col-md-5">Mesas al aire libre </label>

											<div class="col-md-7">
												<input type="checkbox" class="make-switch" name="mesa_aire_libre"
												       data-size="small"
												       data-on-text="Sí" data-off-text="No"
												       data-on-color="success"
												       data-off-color="default">
											</div>
										</div>
										{{--Wifi--}}
										<div class="form-group">
											<label class="control-label col-md-5">Wifi </label>

											<div class="col-md-7">
												<input type="checkbox" class="make-switch" name="wifi"
												       data-size="small"
												       data-on-text="Sí" data-off-text="No"
												       data-on-color="success"
												       data-off-color="default">
											</div>
										</div>
									</div>
								</div>
								{{--Accion--}}
								<div class="col-md-offset-2 col-md-10">
									<div class="margin-top-20">
										<button type="submit" class="btn green-haze hvr-grow">Guardar cambios</button>
									</div>
								</div>
								<div class="clearfix"></div>
								</form>
							</div>
							<!-- END ADICIONAL INFO TAB -->

							<!-- SOCIALES INFO TAB -->
							<div class="tab-pane" id="tab_sociales">
								<form role="form" action="#">
									<div class="form-group">
										<label class="control-label">First Name</label>
										<input type="text" placeholder="John" class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">Last Name</label>
										<input type="text" placeholder="Doe" class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">Mobile Number</label>
										<input type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">Interests</label>
										<input type="text" placeholder="Design, Web etc." class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">Occupation</label>
										<input type="text" placeholder="Web Developer" class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">About</label>
										<textarea class="form-control" rows="3" placeholder="We are KeenThemes!!!"></textarea>
									</div>
									<div class="form-group">
										<label class="control-label">Website Url</label>
										<input type="text" placeholder="http://www.mywebsite.com" class="form-control"/>
									</div>
									<div class="margiv-top-10">
										<a href="javascript:;" class="btn green-haze">
											Save Changes </a>
										<a href="javascript:;" class="btn default">
											Cancel </a>
									</div>
								</form>
							</div>
							<!-- END SOCIALES INFO TAB -->

							<!-- HORARIOS INFO TAB -->
							<div class="tab-pane" id="tab_horarios">
								<form role="form" action="#" class="form-horizontal form-row-sepe">
									<h4 class="form-section">Dias y horarios</h4>
									<hr>
									<div class="form-group">
										<label class="col-md-2 control-label">Dias</label>

										<div class="col-md-10">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="1"> Lunes
												</label>
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="2"> Martes
												</label>
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="3"> Miércoles
												</label>
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="4"> Jueves
												</label>
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="5"> Viernes
												</label>
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="6"> Sábado
												</label>
												<label class="btn btn-default"><input type="checkbox" class="toggle" value="7"> Domingo
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Abre</label>

										<div class="col-md-9">
											<div class="input-group input-small">
												<input type="text" class="form-control timepicker abre">
												<span class="input-group-btn">
												<button class="btn default" type="button">
													<i class="fa fa-clock-o"></i>
												</button>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Cierra</label>

										<div class="col-md-9">
											<div class="input-group input-small">
												<input type="text" class="form-control timepicker cierra">
												<span class="input-group-btn">
												<button class="btn default" type="button">
													<i class="fa fa-clock-o"></i>
												</button>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-offset-2 col-md-10">
											<button type="button" class="btn blue btn-sm">Añadir horario</button>
										</div>
									</div>

									<hr>

									<div class="form-group">
										<div class="col-md-offset-2 col-md-10">
											<div class="alert alert-info alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												Lun, Mar, Mie, Jue, Vie -
												<strong>9:00 a 14:00</strong>
											</div>
											<div class="alert alert-info alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												Lun, Mar, Mie, Jue, Vie -
												<strong>16:00 a 20:30</strong>
											</div>
											<div class="alert alert-info alert-dismissable">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												Sáb - <strong>09:00 a 14:30</strong>
											</div>
										</div>
									</div>

									<div class="margiv-top-10">
										<a href="javascript:;" class="btn green-haze">
											Save Changes </a>
										<a href="javascript:;" class="btn default">
											Cancel </a>
									</div>
								</form>
							</div>
							<!-- END HORARIOS INFO TAB -->

							<!-- CHANGE AVATAR TAB -->
							<div class="tab-pane" id="tab_logotipo">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>

								<form action="#" role="form">
									<div class="form-group">
										<div id="newlogo" style="height: 502px; width: 502px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$logo}}'); background-size: cover; " data-id="{{$current_cliente_id}}" data-upload="{{route('global-upload-logo-negocio')}}" data-crop="{{route('global-crop-logo-negocio')}}">
										</div>
										<div class="clearfix margin-top-10">
											<span class="label label-danger">NOTE! </span>
											<span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
										</div>
									</div>
								</form>
							</div>
							<!-- END CHANGE AVATAR TAB -->

							<!-- PRIVACY SETTINGS TAB -->
							<div class="tab-pane" id="tab_1_4">
								<form action="#">
									<table class="table table-light table-hover">
										<tr>
											<td>
												Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
											</td>
											<td>
												<label class="uniform-inline">
													<input type="radio" name="optionsRadios1" value="option1"/>
													Yes </label>
												<label class="uniform-inline">
													<input type="radio" name="optionsRadios1" value="option2" checked/>
													No </label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class="uniform-inline">
													<input type="checkbox" value=""/> Yes
												</label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class="uniform-inline">
													<input type="checkbox" value=""/> Yes
												</label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class="uniform-inline">
													<input type="checkbox" value=""/> Yes
												</label>
											</td>
										</tr>
									</table>
									<!--end profile-settings-->
									<div class="margin-top-10">
										<a href="javascript:;" class="btn green-haze">
											Save Changes </a>
										<a href="javascript:;" class="btn default">
											Cancel </a>
									</div>
								</form>
							</div>
							<!-- END PRIVACY SETTINGS TAB -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

{{-- Cargar los plugins de js --}}
@section('plugins-core-js')
	<script src="{{asset('assets/global/plugins/jquery-inputmask/dist/jquery.inputmask.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/croppic/croppic.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js')}}" type="text/javascript"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyARXL3JkbiYGEd5OK-82-ybYj2t9W9qldo&sensor=false" type="text/javascript"></script>
	<script src="{{asset('assets/global/plugins/gmaps/gmaps.min.js')}}" type="text/javascript"></script>
@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script src="{{asset('assets/admin/pages/app/cliente/negocios/edita-negocio.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/admin/pages/app/cliente/negocios/info-adicional.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/admin/pages/app/cliente/negocios/horarios.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/admin/pages/app/cliente/negocios/logotipo.js')}}" type="text/javascript"></script>
@stop

{{-- Inicializo los js  --}}
@section('init-js')
	EditaCliente.init();
	InfoAdicional.init();
	Horarios.init();
	Logo.init();
@stop