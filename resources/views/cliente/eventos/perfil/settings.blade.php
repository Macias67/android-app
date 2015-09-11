@extends('cliente.eventos.perfil.perfil')

@section('profile-content')
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Mis Datos</span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_principal" data-toggle="tab">Información Principal</a>
							</li>
							<li>
								<a href="#tab_logotipo" data-toggle="tab">Imagen del evento</a>
							</li>
						</ul>
					</div>
					<div class="portlet-body form">
						<div class="tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane active" id="tab_principal">
								{!! Form::open($param) !!}
									<input type="hidden" name="cliente_id" value="{{$evento->cliente_id}}">
									<input type="hidden" name="id" value="{{$evento->id}}">
									<div class="col-md-6">
										<!-- Nombre del evento -->
										<div class="form-group">
											<label class="col-md-3 control-label">Nombre<span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-institution"></i>
													<input type="text" class="form-control" name="nombre" placeholder="Nombre del evento" value="{{$evento->nombre}}">
												</div>
											</div>
										</div>
										<!-- Slug -->
										<div class="form-group">
											<label class="col-md-3 control-label">Slug <span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<input type="text" class="form-control" name="slug" placeholder="Slug" value="{{$evento->slug}}" readonly>
												</div>
											</div>
										</div>
										<!-- Descripción -->
										<div class="form-group">
											<label class="control-label col-md-3">Descripción <span class="required">*</span></label>
											<div class="col-md-9">
												<textarea class="form-control" name="descripcion" maxlength="255" rows="3" style="resize: none;">{{$evento->descripcion}}</textarea>
												<span class="help-block">Descripción del evento. </span>
											</div>
										</div>
										<!-- Cupo -->
										<div class="form-group">
											<label class="control-label col-md-3">Cupo</label>
											<div class="col-md-9">
												<div class="input-inline input-medium">
													<input id="cantidad" type="text" name="cupo" class="form-control" value="{{$evento->cupo}}">
												</div>
											</div>
										</div>
										<!-- Precio -->
										<div class="form-group">
											<label class="control-label col-md-3">Precio</label>
											<div class="col-md-9">
												<div class="input-inline input-medium">
													<input id="precio" type="text" name="costo" class="form-control" value="{{$evento->costo}}">
												</div>
											</div>
										</div>
										<!-- Dirección -->
										<div class="form-group">
											<label class="col-md-3 control-label">Dirección</label>
											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
													<input type="text" class="form-control" name="direccion" placeholder="Dirección" value="{{$evento->direccion}}">
												</div>
												<span class="help-block">Ejemplo: Cuarzo No. 9A, Ocotlán</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
                                        <div class="form-body">
                                            <!-- Estatus -->
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Estatus<span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="clearfix">
                                                        <div class="btn-group" data-toggle="buttons">

                                                            @if ($evento->estatus == 'proximo')

                                                            <label class="btn btn-default active">
                                                                <input id="option1" type="radio" name="estatus" class="toggle" value="proximo" checked> Próximo </label>

                                                                <label class="btn btn-default">
                                                                    <input id="option2" type="radio" name="estatus" class="toggle" value="ahora"> Ahora </label>

                                                                <label class="btn btn-default">
                                                                    <input id="option3" type="radio" name="estatus" class="toggle" value="caduco"> Caduco </label>

                                                            @elseif ($evento->estatus == 'ahora')

                                                                <label class="btn btn-default">
                                                                    <input id="option1" type="radio" name="estatus" class="toggle" value="proximo"> Próximo </label>

                                                                <label class="btn btn-default active">
                                                                    <input id="option2" type="radio" name="estatus" class="toggle" value="ahora" checked> Ahora </label>

                                                                <label class="btn btn-default">
                                                                    <input id="option3" type="radio" name="estatus" class="toggle" value="caduco"> Caduco </label>

                                                            @elseif($evento->estatus == 'caduco')

                                                                <label class="btn btn-default">
                                                                    <input id="option1" type="radio" name="estatus" class="toggle" value="proximo"> Próximo </label>

                                                                <label class="btn btn-default">
                                                                    <input id="option2" type="radio" name="estatus" class="toggle" value="ahora"> Ahora </label>

                                                                <label class="btn btn-default active">
                                                                    <input id="option3" type="radio" name="estatus" class="toggle" value="caduco" checked> Caduco </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Disponible -->
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Disponible<span class="required">*</span></label>

                                                @if($evento->disponible == 'online')
                                                    <div class="col-md-9">
                                                        <input type="checkbox" class="make-switch" name="disponible"
                                                               data-size="small"
                                                               data-on-text="Online" data-off-text="Offline"
                                                               data-on-color="success"
                                                               data-off-color="default" checked>
                                                    </div>
                                                @else
                                                    <div class="col-md-9">
                                                        <input type="checkbox" class="make-switch" name="disponible"
                                                               data-size="small"
                                                               data-on-text="Online" data-off-text="Offline"
                                                               data-on-color="success"
                                                               data-off-color="default">
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- URL externa extra -->
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Url externa</label>
                                                <div class="col-md-9">
                                                    <div class="input-icon">
                                                        <i class="fa fa-institution"></i>
                                                        <input type="text" class="form-control" name="url_exterior" placeholder="Url externa" value="{{$evento->url_exterior}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Horario -->
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="button" class="btn default" id="reportrange">
                                                        <i class="fa fa-calendar">
                                                        </i> Horario<i class="fa fa-angle-down">
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Inicio <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" class="form-control" name="finicio" readonly>
                                                        <input type="hidden" class="form-control" name="fecha_inicio" value="{{$evento->fecha_inicio}}">
                                                        <input type="hidden" class="form-control" name="hora_inicio" value="{{$evento->hora_inicio}}">
														<input type="hidden" class="form-control" name="disp_inicio" value="{{$disp_inicio}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Final <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" class="form-control" name="ffin" readonly>
                                                        <input type="hidden" class="form-control" name="fecha_termina" value="{{$evento->fecha_termina}}">
                                                        <input type="hidden" class="form-control" name="hora_termina" value="{{$evento->hora_termina}}">
														<input type="hidden" class="form-control" name="disp_fin" value="{{$disp_fin}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									</div>

									{{--Mapas--}}
									<div class="col-md-12">
										<h4 class="form-section">Google Maps</h4>
										<div class="form-group">
											<div class="col-md-offset-2 col-md-9">
												<div class="input-group">
													<input type="text" class="form-control" id="calle_registrada" placeholder="Calle No. Colonia, Ciudad Estado" value="{{$evento->direccion}}">
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
											<div class="col-md-offset-2 col-md-9">
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
											<div class="col-md-offset-2 col-md-9">
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

                                    <div class="col-md-12">
                                        {{-- Botón Enviar --}}
                                        <div class="margin-top-20">
                                            <button type="submit" class="btn green-haze">Guardar cambios</button>
                                            {{--<a href="javascript:;" class="btn default">Cancelar </a>--}}
                                        </div>
                                    </div>
								</form>
								<div class="clearfix"></div>
							</div>
							<!-- END PERSONAL INFO TAB -->

							<!-- CAMBIO DE IMAGEN DE EVENTO -->
							<div class="tab-pane" id="tab_logotipo">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>
								<form action="#" role="form">
									<div class="form-group">
                                        <div id="newImage"
                                             style="height: 503px; width: 503px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$img_evento}}') "
                                             data-evento-id="{{$current_evento_id}}"
                                             data-cliente-id="{{$evento->cliente_id}}"
                                             data-upload="{{route('global-upload-image-evento')}}"
                                             data-crop="{{route('global-crop-image-evento')}}">
                                        </div>
										<div class="clearfix margin-top-10">
											<span class="label label-danger">NOTE! </span>
											<span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
										</div>
									</div>
								</form>
							</div>
							<!-- END CHANGE AVATAR TAB -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop