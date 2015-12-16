@extends('cliente.negocios.perfil.perfil')

{{-- Adjuntar los links css de los plugins requeridos --}}
@section('plugins-css')
	<link href = "{{asset('assets/admin/pages/css/profile.css')}}" rel = "stylesheet" type = "text/css"/>
	<link href = "{{asset('assets/global/plugins/croppic/croppic.css')}}" rel = "stylesheet" type = "text/css"/>
	<link href = "{{asset('assets/global/plugins/select2/select2.css')}}" rel = "stylesheet" type = "text/css"/>
	<link href = "{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel = "stylesheet" type = "text/css"/>

	{{-- --}}
	<link href = "{{asset('assets/global/plugins/fancybox/source/jquery.fancybox.css')}}" rel = "stylesheet" type = "text/css"/>
	<link href = "{{asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}" rel = "stylesheet" type = "text/css"/>
	<link href = "{{asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css')}}" rel = "stylesheet" type = "text/css"/>
	<link href = "{{asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel = "stylesheet" type = "text/css"/>
@stop

@section('profile-content')
	<div class = "profile-content">
		<div class = "row">
			<div class = "col-md-12">
				<div class = "portlet light">
					<div class = "portlet-title tabbable-line">
						<div class = "caption caption-md">
							<i class = "icon-globe theme-font hide"></i>
							<span class = "caption-subject font-blue-madison bold uppercase">Información</span>
						</div>
						<ul class = "nav nav-tabs">
							<li class = "active">
								<a href = "#tab_principal" data-toggle = "tab">Principal</a>
							</li>
							<li>
								<a href = "#tab_adicional" data-toggle = "tab">Adicional</a>
							</li>
							<li>
								<a href = "#tab_sociales" data-toggle = "tab">Redes Sociales</a>
							</li>
							<li>
								<a href = "#tab_horarios" data-toggle = "tab">Horarios</a>
							</li>
							<li>
								<a href = "#tab_logotipo" data-toggle = "tab">Logotipo</a>
							</li>
							<li>
								<a href = "#tab_galeria" data-toggle = "tab">Galería</a>
							</li>
							<li>
								<a href = "#tab_1_4" data-toggle = "tab">Privacy Settings</a>
							</li>
						</ul>
					</div>
					<div class = "portlet-body">
						<div class = "tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class = "tab-pane active" id = "tab_principal">
								{!! Form::model($cliente, $formprincipal) !!}
								{!! Form::hidden('id') !!}
								{!! Form::hidden('propietario_id') !!}
									{{--Datos basicos--}}
									<div class = "col-md-6">
										<div class = "form-body">
											{{--Estatus--}}
											<div class = "form-group">
												<label class = "control-label col-md-4">Estatus
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													<input type = "checkbox" class = "make-switch" name = "estatus"
													       @if($cliente->estatus == 'online')
													       checked
													       @endif
													       data-size = "small"
													       data-on-text = "Online" data-off-text = "Offline"
													       data-on-color = "success"
													       data-off-color = "default">
												</div>
											</div>
											{{--Lugar--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Lugar
													<span class = "required" aria-required = "true">*</span>
												</label>

												<div class = "col-md-8">
													<div class = "input-icon">
														<i class = "fa fa-institution"></i>
														{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del lugar']) !!}
													</div>
												</div>
											</div>
											{{--Calle--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Calle
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													<div class = "input-icon">
														<i class = "fa fa-map-marker"></i>
														{!! Form::text('calle', null, ['class' => 'form-control', 'placeholder' => 'Calle']) !!}
													</div>
												</div>
											</div>
											{{--Numero--}}
											<div class = "form-group">
												<label class = "control-label col-md-4">Número
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													<div class = "input-icon input-small">
														<i class = "fa fa-slack"></i>
														{!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Número']) !!}
													</div>
												</div>
											</div>
											{{--Colonia--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Colonia
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													<div class = "input-icon">
														<i class = "fa fa-map-marker"></i>
														{!! Form::text('colonia', null, ['class' => 'form-control', 'placeholder' => 'Colonia']) !!}
													</div>
												</div>
											</div>
											{{--Codigo Postal--}}
											<div class = "form-group">
												<label class = "control-label col-md-4">Código Postal
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													<div class = "input-icon input-small">
														<i class = "fa fa-globe"></i>
														{!! Form::text('codigo_postal', null, ['class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
													</div>
												</div>
											</div>
											{{--Referencias--}}
											<div class = "form-group">
												<label class = "control-label col-md-4">Referencias
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													{!! Form::textarea('referencia', null, ['class' => 'form-control', 'rows' => 3, 'style' => 'resize: none;']) !!}
													<span class = "help-block">Descripción de lugares, monumentos, calles o algún indicador cercano al lugar. </span>
												</div>
											</div>
											{{--Ciudad--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Ciudad
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													{!! Form::select('ciudad_id', $options_ciudades, null, ['class' => 'form-control']) !!}
												</div>
											</div>
										</div>
									</div>
										<div class = "col-md-6">
										<div class = "form-body">
											{{--Categoria 1--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Categoría 1
													<span class = "required" aria-required = "true">*</span></label>

												<div class = "col-md-8">
													{!! Form::select('categoria1', $options_categorias, $cl_categorias[0]['categoria'], ['class' => 'form-control select2', 'id' => 'categoria', 'data-url' => route('global-select-subcategorias')]) !!}
												</div>
											</div>
											{{--SubCategoria 1--}}
											<div class = "form-group">
												<div class = "col-md-offset-4 col-md-8">
													{!! Form::select('subcategoria1', [], null, ['class' => 'form-control select2', 'id' => 'subcategoria', 'sub' => $cl_categorias[0]['subcategoria']]) !!}
												</div>
											</div>
											{{--Categoria 2--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Categoría 2</label>

												<div class = "col-md-8">
													{!! Form::select('categoria2', $options_categorias, $cl_categorias[1]['categoria'], ['class' => 'form-control select2', 'id' => 'categoria2', 'data-url' => route('global-select-subcategorias')]) !!}
												</div>
											</div>
											{{--SubCategoria 2--}}
											<div class = "form-group">
												<div class = "col-md-offset-4 col-md-8">
													{!! Form::select('subcategoria2', [], null, ['class' => 'form-control select2', 'id' => 'subcategoria2',  'sub' => $cl_categorias[1]['subcategoria']]) !!}
												</div>
											</div>
											{{--Categoria 3--}}
											<div class = "form-group">
												<label class = "col-md-4 control-label">Categoría 3</label>

												<div class = "col-md-8">
													{!! Form::select('categoria3', $options_categorias, $cl_categorias[2]['categoria'], ['class' => 'form-control select2', 'id' => 'categoria3', 'data-url' => route('global-select-subcategorias')]) !!}
												</div>
											</div>
											{{--SubCategoria 3--}}
											<div class = "form-group">
												<div class = "col-md-offset-4 col-md-8">
													{!! Form::select('subcategoria3', [], null, ['class' => 'form-control select2', 'id' => 'subcategoria3', 'sub' => $cl_categorias[2]['subcategoria']]) !!}
												</div>
											</div>
										</div>
									</div>

										{{--Mapas--}}
										<div class = "col-md-12">
											<h4 class = "form-section">Google Maps</h4>
											<hr>
											<div class = "form-group">
												<div class = "col-md-offset-2 col-md-10">
													<div class = "input-group">
														<input type = "text" class = "form-control" id = "calle_registrada" placeholder = "Calle No. Colonia, Ciudad Estado">
														<span class = "input-group-btn">
															<button class = "btn blue faa-parent animated-icon-hover" id = "gmap_geocoding_btn">
																<i class = "fa fa-map-marker faa-vertical"></i> Ubicar
															</button>
														</span>
													</div>
													<span class = "help-block">Dirección formada en base a los datos del formulario. Presione ubicar para mostrarlo en el mapa.</span>
												</div>
											</div>

											<div class = "form-group">
												<div class = "col-md-offset-2 col-md-10">
													<div class = "input-group">
														<input type = "text" class = "form-control" id = "gmap_geocoding_address" placeholder = "Dirección de Google Maps" readonly>
														<span class = "input-group-btn">
															<button class = "btn red faa-parent animated-icon-hover" id = "gmap_address_replace">
																<i class = "fa fa-repeat faa-spin"></i> Remplazar
															</button>
														</span>
													</div>
													<span class = "help-block">Dirección formada pro Google Maps. Presione Remplazar para sustituir la dirección por los valores de Google Maps.</span>
												</div>
											</div>

											<div class = "form-group">
												<div class = "col-md-offset-2 col-md-10">
													<div class = "col-md-6">
														<label class = "control-label">Latitud</label>
														{!! Form::text('latitud', null, ['class' => 'form-control input-medium', 'placeholder' => 'Latitud', 'readonly']) !!}
													</div>
													<div class = "col-md-6">
														<label class = "control-label">Longitud</label>
														{!! Form::text('longitud', null, ['class' => 'form-control input-medium', 'placeholder' => 'Longitud', 'readonly']) !!}
													</div>
												</div>
											</div>

											<div class = "form-group">
												<div class = "col-md-offset-2 col-md-10">
													<div id = "gmap_geocoding" class = "gmaps"></div>
													<span class = "help-block">El indicador es solo una referencia muy cercana al lugar. </span>
												</div>
											</div>
										</div>

										{{--Accion--}}
										<div class = "col-md-offset-2 col-md-10">
											<div class = "margin-top-20">
												<button type = "submit" class = "btn green-haze hvr-grow">Guardar cambios</button>
											</div>
										</div>
								</form>
								<div class = "clearfix"></div>
							</div>
							<!-- END PERSONAL INFO TAB -->

							<!-- ADICIONAL INFO TAB -->
							<div class = "tab-pane" id = "tab_adicional">
								{!! Form::model($cliente->detalles, $formadicional) !!}
								{!! Form::hidden ('id', $cliente->id) !!}
								{!! Form::hidden ('propietario_id', $cliente->propietario_id) !!}
								<div class = "col-md-6">
									<div class = "form-body">
										{{--Descripcion--}}
										<div class = "form-group">
											<label class = "control-label col-md-4">Descripción </label>

											<div class = "col-md-8">
												<div class = "input-icon">
													<i class = "fa fa-edit"></i>
													{!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 3, 'style' => 'resize: none;', 'maxlength' => 200]) !!}
												</div>
												<span class = "help-block">Descripción detallado del negocio. </span>
											</div>
										</div>
										{{--Slogan--}}
										<div class = "form-group">
											<label class = "col-md-4 control-label">Slogan </label>

											<div class = "col-md-8">
												<div class = "input-icon">
													<i class = "fa fa-star"></i>
													{!! Form::textarea('slogan', null, ['class' => 'form-control', 'rows' => 2, 'style' => 'resize: none;', 'maxlength' => 140]) !!}
												</div>
											</div>
										</div>
										{{--Website--}}
										<div class = "form-group">
											<label class = "control-label col-md-4">Website </label>

											<div class = "col-md-8">
												<div class = "input-icon">
													<i class = "fa fa-desktop"></i>
													{!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Website']) !!}
												</div>
											</div>
										</div>
										{{--Email--}}
										<div class = "form-group">
											<label class = "col-md-4 control-label">Email </label>

											<div class = "col-md-8">
												<div class = "input-icon">
													<i class = "fa fa-envelope-o"></i>
													{!! Form::text('email_negocio', null, ['class' => 'form-control', 'placeholder' => 'Email del Negocio']) !!}
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class = "col-md-6">
									<div class = "form-body">
										{{--Telefono 1--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Teléfono 1 </label>

											<div class = "col-md-7">
												<div class = "input-icon input-small">
													<i class = "fa fa-phone"></i>
													{!! Form::text('telefono1', null, ['class' => 'form-control', 'placeholder' => 'Teléfono 1']) !!}
												</div>
											</div>
										</div>
										{{--Telefono 2--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Teléfono 2</label>

											<div class = "col-md-7">
												<div class = "input-icon input-small">
													<i class = "fa fa-phone"></i>
													{!! Form::text('telefono2', null, ['class' => 'form-control', 'placeholder' => 'Teléfono 2']) !!}
												</div>
											</div>
										</div>
										{{--Telefono 3--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Teléfono 3 </label>

											<div class = "col-md-7">
												<div class = "input-icon input-small">
													<i class = "fa fa-phone"></i>
													{!! Form::text('telefono3', null, ['class' => 'form-control', 'placeholder' => 'Teléfono 3']) !!}
												</div>
											</div>
										</div>
										{{--Tarjeta Débito/Crédito--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Tarjeta Débito/Crédito </label>

											<div class = "col-md-7">
												<input type = "checkbox" class = "make-switch" name = "pago_tarjeta"
												       @if($cliente->detalles->pago_tarjeta)
												       checked
												       @endif
												       data-size = "small"
												       data-on-text = "Sí" data-off-text = "No"
												       data-on-color = "success"
												       data-off-color = "default">
											</div>
										</div>
										{{--Reservaciones--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Reservaciones </label>

											<div class = "col-md-7">
												<input type = "checkbox" class = "make-switch" name = "reservaciones"
												       @if($cliente->detalles->reservaciones)
												       checked
												       @endif
												       data-size = "small"
												       data-on-text = "Sí" data-off-text = "No"
												       data-on-color = "success"
												       data-off-color = "default">
											</div>
										</div>
										{{--Servicio domicilio--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Servicio a domicilio </label>

											<div class = "col-md-7">
												<input type = "checkbox" class = "make-switch" name = "servicio_domicilio"
												       @if($cliente->detalles->servicio_domicilio)
												       checked
												       @endif
												       data-size = "small"
												       data-on-text = "Sí" data-off-text = "No"
												       data-on-color = "success"
												       data-off-color = "default">
											</div>
										</div>
										{{--Mesas al aire libre--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Mesas al aire libre </label>

											<div class = "col-md-7">
												<input type = "checkbox" class = "make-switch" name = "mesa_aire_libre"
												       @if($cliente->detalles->mesa_aire_libre)
												       checked
												       @endif
												       data-size = "small"
												       data-on-text = "Sí" data-off-text = "No"
												       data-on-color = "success"
												       data-off-color = "default">
											</div>
										</div>
										{{--Wifi--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Wifi </label>

											<div class = "col-md-7">
												<input type = "checkbox" class = "make-switch" name = "wifi"
												       @if($cliente->detalles->wifi)
												       checked
												       @endif
												       data-size = "small"
												       data-on-text = "Sí" data-off-text = "No"
												       data-on-color = "success"
												       data-off-color = "default">
											</div>
										</div>
										{{--Estacionamiento--}}
										<div class = "form-group">
											<label class = "control-label col-md-5">Estacionamiento </label>

											<div class = "col-md-7">
												<input type = "checkbox" class = "make-switch" name = "estacionamiento"
												       @if($cliente->detalles->estacionamiento)
												       checked
												       @endif
												       data-size = "small"
												       data-on-text = "Sí" data-off-text = "No"
												       data-on-color = "success"
												       data-off-color = "default">
											</div>
										</div>
									</div>
								</div>
								{{--Accion--}}
								<div class = "col-md-offset-2 col-md-10">
									<div class = "margin-top-20">
										<button type = "submit" class = "btn green-haze hvr-grow">Guardar cambios</button>
									</div>
								</div>
								<div class = "clearfix"></div>
								</form>
							</div>
							<!-- END ADICIONAL INFO TAB -->

							<!-- SOCIALES INFO TAB -->
							<div class = "tab-pane" id = "tab_sociales">
								{!! Form::model($cliente->redesSociales, $formredessociales) !!}
								{!! Form::hidden ('id', $cliente->id) !!}
								{!! Form::hidden ('propietario_id', $cliente->propietario_id) !!}
								<div class = "col-md-9">
									<div class = "form-body">
										{{--Facebook--}}
										<div class = "form-group">
											<label class = "control-label col-md-3">Facebook </label>

											<div class = "col-md-7">
												<div class = "input-icon">
													<i class = "fa fa-facebook"></i>
													{!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'Facebook']) !!}
												</div>
												<span class = "help-block">Ejemplo: <b>https://www.facebook.com/mi-negocio</b> </span>
											</div>
										</div>
										{{--Twitter--}}
										<div class = "form-group">
											<label class = "control-label col-md-3">Twitter </label>

											<div class = "col-md-7">
												<div class = "input-icon">
													<i class = "fa fa-twitter"></i>
													{!! Form::text('twitter', null, ['class' => 'form-control', 'placeholder' => 'Twitter']) !!}
												</div>
												<span class = "help-block">Ejemplo: <b>https://twitter.com/MiNegocio</b> </span>
											</div>
										</div>
										{{--Instagram--}}
										<div class = "form-group">
											<label class = "control-label col-md-3">Instagram </label>

											<div class = "col-md-7">
												<div class = "input-icon">
													<i class = "fa fa-instagram"></i>
													{!! Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'Instagram']) !!}
												</div>
												<span class = "help-block">Ejemplo: <b>https://instagram.com/mi-cuenta</b> </span>
											</div>
										</div>
										{{--YouTube--}}
										<div class = "form-group">
											<label class = "control-label col-md-3">YouTube </label>

											<div class = "col-md-7">
												<div class = "input-icon">
													<i class = "fa fa-youtube-play"></i>
													{!! Form::text('youtube', null, ['class' => 'form-control', 'placeholder' => 'YouTube']) !!}
												</div>
												<span class = "help-block">Ejemplo: <b>https://www.youtube.com/watch?v=fIeBpbNpJz0</b> </span>
											</div>
										</div>
										{{--Google Plus--}}
										<div class = "form-group">
											<label class = "control-label col-md-3">Google Plus </label>

											<div class = "col-md-7">
												<div class = "input-icon">
													<i class = "fa fa-google-plus"></i>
													{!! Form::text('googleplus', null, ['class' => 'form-control', 'placeholder' => 'Google Plus']) !!}
												</div>
												<span class = "help-block">Ejemplo: <b>https://plus.google.com/+MiCuenta</b> </span>
											</div>
										</div>
									</div>
								</div>

								{{--Accion--}}
								<div class = "col-md-offset-2 col-md-10">
									<div class = "margin-top-20">
										<button type = "submit" class = "btn green-haze hvr-grow">Guardar cambios</button>
									</div>
								</div>
								</form>
								<div class = "clearfix"></div>
							</div>
							<!-- END SOCIALES INFO TAB -->

							<!-- HORARIOS INFO TAB -->
							<div class = "tab-pane" id = "tab_horarios">
								{!! Form::open($formhorarios) !!}
								{!! Form::hidden ('id', $cliente->id) !!}
								{!! Form::hidden ('propietario_id', $cliente->propietario_id) !!}
								<h4 class = "form-section">Dias y horarios</h4>
								<hr>
								<div class = "form-group">
									<label class = "col-md-2 control-label">Dias</label>

									<div class = "col-md-10">
										<div class = "btn-group" data-toggle = "buttons">
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "1"> Lunes
											</label>
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "2"> Martes
											</label>
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "3"> Miércoles
											</label>
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "4"> Jueves
											</label>
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "5"> Viernes
											</label>
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "6"> Sábado
											</label>
											<label class = "btn btn-default">
												<input type = "checkbox" name = "dias[]" class = "toggle" value = "7"> Domingo
											</label>
										</div>
									</div>
								</div>
								<div class = "form-group">
									<label class = "col-md-2 control-label">Abre</label>

									<div class = "col-md-9">
										<div class = "input-group input-small">
											<input type = "text" name = "abre" class = "form-control timepicker abre">
												<span class = "input-group-btn">
												<button class = "btn default" type = "button">
													<i class = "fa fa-clock-o"></i>
												</button>
												</span>
										</div>
									</div>
								</div>
								<div class = "form-group">
									<label class = "col-md-2 control-label">Cierra</label>

									<div class = "col-md-9">
										<div class = "input-group input-small">
											<input type = "text" name = "cierra" class = "form-control timepicker cierra">
												<span class = "input-group-btn">
												<button class = "btn default" type = "button">
													<i class = "fa fa-clock-o"></i>
												</button>
												</span>
										</div>
									</div>
								</div>
								<div class = "form-group">
									<div class = "col-md-offset-2 col-md-10">
										<button type = "button" class = "btn blue btn-sm" id = "addHorario">Añadir horario</button>
									</div>
								</div>

								<hr>

								<div class = "form-group">
									<div class = "col-md-offset-2 col-md-10" id = "horarios">
										@if(count($horarios) > 0)
											@foreach($horarios as $horario)
												<div class = "alert alert-info horario" grupo-id = "{{$horario['grupo_id']}}" delete-url = "{{route('cliente.negocio.destroy.horario')}}" id = "{{$current_cliente_id}}">
													<button type = "button" class = "close"></button>
													{{$horario['dias']}} - <strong>{{$horario['horario']}}</strong>
												</div>
											@endforeach
										@endif
									</div>
								</div>
								</form>
							</div>
							<!-- END HORARIOS INFO TAB -->

							<!-- CHANGE AVATAR TAB -->
							<div class = "tab-pane" id = "tab_logotipo">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon
									officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>

								<form action = "#" role = "form">
									<div class = "form-group">
										<div id = "newlogo" style = "height: 502px; width: 502px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$cliente->logo()}}'); background-size: cover; " data-id = "{{$current_cliente_id}}" data-upload = "{{route('global-upload-logo-negocio')}}" data-crop = "{{route('global-crop-logo-negocio')}}">
										</div>
										<div class = "clearfix margin-top-10">
											<span class = "label label-danger">NOTE! </span>
											<span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
										</div>
									</div>
								</form>
							</div>
							<!-- END CHANGE AVATAR TAB -->

							<!-- GALERIA  TAB -->
							<div class = "tab-pane" id = "tab_galeria">
								<div class = "m-heading-1 border-green m-bordered">
									<h3>jQuery Validation Plugin</h3>
									<p> File Upload widget with multiple file selection, drag&amp;drop support, progress bars and preview images
										for jQuery.
										<br> Supports cross-domain, chunked and resumable file uploads and client-side image resizing.
										<br> Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that
										supports standard HTML form file uploads. </p>
									<p> For more info please check out
										<a class = "btn red btn-outline" href = "https://github.com/blueimp/jQuery-File-Upload" target = "_blank">the official documentation</a>
									</p>
								</div>
								{!! Form::open($formgaleria) !!}
									{!! Form::hidden ('id', $cliente->id) !!}
									{!! Form::hidden ('propietario_id', $cliente->propietario_id) !!}
									<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
									<div class = "row fileupload-buttonbar">
										<div class = "col-lg-7">
											<!-- The fileinput-button span is used to style the file input field as button -->
											<span class = "btn green fileinput-button">
												<i class = "fa fa-plus"></i>
												<span> Subir fotos... </span>
												<input type = "file" name = "files[]" multiple = "">
											</span>
											<button type = "submit" class = "btn blue start">
												<i class = "fa fa-upload"></i>
												<span> Iniciar subida </span>
											</button>
											<button type = "reset" class = "btn warning cancel">
												<i class = "fa fa-ban-circle"></i>
												<span> Cancelar subida </span>
											</button>
											<button type = "button" class = "btn red delete">
												<i class = "fa fa-trash"></i>
												<span> Borrar </span>
											</button>
											<input type = "checkbox" class = "toggle">
											<!-- The global file processing state -->
											<span class = "fileupload-process"> </span>
										</div>
										<!-- The global progress information -->
										<div class = "col-lg-5 fileupload-progress fade">
											<!-- The global progress bar -->
											<div class = "progress progress-striped active" role = "progressbar" aria-valuemin = "0" aria-valuemax = "100">
												<div class = "progress-bar progress-bar-success" style = "width:0%;"></div>
											</div>
											<!-- The extended global progress information -->
											<div class = "progress-extended"> &nbsp; </div>
										</div>
									</div>
									<!-- The table listing the files available for upload/download -->
									<table role = "presentation" class = "table table-striped clearfix">
										<tbody class = "files"></tbody>
									</table>
								</form>
								<div class = "panel panel-success">
									<div class = "panel-heading">
										<h3 class = "panel-title">Demo Notes</h3>
									</div>
									<div class = "panel-body">
										<ul>
											<li> The maximum file size for uploads in this demo is
												<strong>5 MB</strong> (default file size is unlimited).
											</li>
											<li> Only image files (
												<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no
												file type restriction).
											</li>
											<li> Uploaded files will be deleted automatically after
												<strong>5 minutes</strong> (demo setting).
											</li>
										</ul>
									</div>
								</div>

								<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
								<script id = "template-upload" type = "text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
						                        <tr class="template-upload fade">
						                            <td>
						                                <span class="preview"></span>
						                            </td>
						                            <td>
						                                <p class="name">{%=file.name%}</p>
						                                <strong class="error text-danger label label-danger"></strong>
						                            </td>
						                            <td>
						                                <p class="size">Processing...</p>
						                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
						                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
						                                </div>
						                            </td>
						                            <td> {% if (!i && !o.options.autoUpload) { %}
						                                <button class="btn blue start" disabled>
						                                    <i class="fa fa-upload"></i>
						                                    <span>Start</span>
						                                </button> {% } %} {% if (!i) { %}
						                                <button class="btn red cancel">
						                                    <i class="fa fa-ban"></i>
						                                    <span>Cancel</span>
						                                </button> {% } %} </td>
						                        </tr> {% } %}
								</script>
								<!-- The template to display files available for download -->
								<script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
						                        <tr class="template-download fade">
						                            <td>
						                                <span class="preview"> {% if (file.thumbnailUrl) { %}
						                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
						                                        <img src="{%=file.thumbnailUrl%}">
						                                    </a> {% } %} </span>
						                            </td>
						                            <td>
						                                <p class="name"> {% if (file.url) { %}
						                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
						                                    <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
						                                <div>
						                                    <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
						                            <td>
						                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
						                            </td>
						                            <td> {% if (file.deleteUrl) { %}
						                                <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
						                                    <i class="fa fa-trash-o"></i>
						                                    <span>Delete</span>
						                                </button>
						                                <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
						                                <button class="btn yellow cancel btn-sm">
						                                    <i class="fa fa-ban"></i>
						                                    <span>Cancel</span>
						                                </button> {% } %} </td>
						                        </tr> {% } %}
						                 </script>
							</div>
							<!-- GALERIA  TAB -->

							<!-- PRIVACY SETTINGS TAB -->
							<div class = "tab-pane" id = "tab_1_4">
								<form action = "#">
									<table class = "table table-light table-hover">
										<tr>
											<td>
												Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
											</td>
											<td>
												<label class = "uniform-inline">
													<input type = "radio" name = "optionsRadios1" value = "option1"/>
													Yes </label>
												<label class = "uniform-inline">
													<input type = "radio" name = "optionsRadios1" value = "option2" checked/>
													No </label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class = "uniform-inline">
													<input type = "checkbox" value = ""/> Yes
												</label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class = "uniform-inline">
													<input type = "checkbox" value = ""/> Yes
												</label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class = "uniform-inline">
													<input type = "checkbox" value = ""/> Yes
												</label>
											</td>
										</tr>
									</table>
									<!--end profile-settings-->
									<div class = "margin-top-10">
										<a href = "javascript:;" class = "btn green-haze">
											Save Changes </a>
										<a href = "javascript:;" class = "btn default">
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
	<script src = "{{asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-inputmask/dist/jquery.inputmask.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/croppic/croppic.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/select2/select2.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js')}}" type = "text/javascript"></script>
	<script src = "http://maps.google.com/maps/api/js?sensor=false" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/gmaps/gmaps.min.js')}}" type = "text/javascript"></script>


	{{----}}
	<script src = "{{asset('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js')}}" type = "text/javascript"></script>
@stop

{{-- Cargar los archivos de js --}}
@section('page-level-js')
	<script src = "{{asset('assets/admin/pages/app/cliente/negocios/edita-negocio.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/admin/pages/app/cliente/negocios/info-adicional.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/admin/pages/app/cliente/negocios/redes-sociales.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/admin/pages/app/cliente/negocios/horarios.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/admin/pages/app/cliente/negocios/logotipo.js')}}" type = "text/javascript"></script>
	<script src = "{{asset('assets/admin/pages/app/cliente/negocios/galeria.js')}}" type = "text/javascript"></script>
@stop

{{-- Inicializo los js  --}}
@section('init-js')
	EditaCliente.init();
	InfoAdicional.init();
	RedesSociales.init();
	Horarios.init();
	Logo.init();
@stop