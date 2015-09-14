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
                                {!! Form::model($evento) !!}
                                {!! Form::hidden('id') !!}
                                {!! Form::hidden('cliente_id') !!}
									<div class="col-md-6">
										<!-- Nombre del evento -->
										<div class="form-group">
											<label class="col-md-4 control-label">Nombre<span class="required">*</span></label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-institution"></i>
                                                    {!! Form::text('nombre', NULL, ['class' => 'form-control', 'placeholder' => 'Nombre del evento']) !!}
												</div>
											</div>
										</div>

										<!-- Slug -->
										<div class="form-group">
											<label class="col-md-4 control-label">Slug <span class="required">*</span></label>

											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
                                                    {!! Form::text('slug', NULL, ['class' => 'form-control', 'placeholder' => 'Slug', 'readonly']) !!}
												</div>
											</div>
										</div>

										<!-- Descripción -->
										<div class="form-group">
											<label class="control-label col-md-4">Descripción <span class="required">*</span></label>
											<div class="col-md-8">
                                                {!! Form::textarea('descripcion', NULL, ['class' => 'form-control', 'style' => 'resize: none;','maxlength'=>'255','rows'=>'3']) !!}
												<span class="help-block">Descripción del evento. </span>
											</div>
										</div>

										<!-- Cupo -->
										<div class="form-group">
											<label class="control-label col-md-4">Cupo</label>
											<div class="col-md-8">
												<div class="input-inline input-medium">
                                                    {!! Form::text('cupo', NULL, ['class' => 'form-control', 'id'=>'cupo']) !!}
												</div>
											</div>
										</div>

										<!-- Precio -->
										<div class="form-group">
											<label class="control-label col-md-4">Precio</label>
											<div class="col-md-8">
												<div class="input-inline input-medium">
                                                    {!! Form::text('costo', NULL, ['class' => 'form-control', 'id'=>'costo']) !!}
												</div>
											</div>
										</div>

										<!-- Dirección -->
										<div class="form-group">
											<label class="col-md-4 control-label">Dirección</label>
											<div class="col-md-8">
												<div class="input-icon">
													<i class="fa fa-map-marker"></i>
                                                    {!! Form::text('direccion', NULL, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
												</div>
												<span class="help-block">Ejemplo: Cuarzo No. 9A, Ocotlán</span>
											</div>
										</div>
									</div>

									<div class="col-md-6">
                                        <div class="form-body">
                                            <!-- Estatus -->
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Estatus<span class="required">*</span></label>
                                                <div class="col-md-8">
                                                    <div class="clearfix">
                                                        <div class="btn-group" data-toggle="buttons">
                                                            @if($evento->estatus == 'proximo')
                                                                <label class="btn btn-default active">
                                                            @else
                                                                <label class="btn btn-default">
                                                            @endif
                                                                <input id="option1" type="radio" name="estatus" class="toggle" value="proximo" @if($evento->estatus == 'proximo') checked @endif> Próximo </label>

                                                            @if($evento->estatus == 'ahora')
                                                                <label class="btn btn-default active">
                                                            @else
                                                                <label class="btn btn-default">
                                                            @endif
                                                                <input id="option2" type="radio" name="estatus" class="toggle" value="ahora" @if($evento->estatus == 'ahora') checked @endif> Ahora </label>

                                                            @if($evento->estatus == 'caduco')
                                                                <label class="btn btn-default active">
                                                            @else
                                                                <label class="btn btn-default">
                                                            @endif
                                                                <input id="option3" type="radio" name="estatus" class="toggle" value="caduco" @if($evento->estatus == 'caduco') checked @endif> Caduco </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Disponible -->
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Disponible<span class="required">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="checkbox" class="make-switch" name="disponible"
                                                               data-size="small"
                                                               data-on-text="Online" data-off-text="Offline"
                                                               data-on-color="success"
                                                               data-off-color="default"
                                                                @if($evento->disponible == 'online')
                                                                    checked
                                                                @endif>
                                                    </div>
                                            </div>

                                            <!-- URL externa extra -->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Url externa</label>
                                                <div class="col-md-8">
                                                    <div class="input-icon">
                                                        <i class="fa fa-institution"></i>
                                                        {!! Form::text('url_exterior', NULL, ['class' => 'form-control', 'placeholder' => 'Url externa']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hora -->
                                            <div class="form-group">
                                                <div class="col-md-offset-4 col-md-9">
                                                    <button type="button" class="btn default faa-parent animated-icon-hover" id="reportrange">
                                                        <i class="fa fa-calendar faa-ring">
                                                        </i> Hora <i class="fa fa-angle-down">
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Inicio <span class="required">*</span></label>
                                                <div class="col-md-8">
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
                                                <label class="col-md-4 control-label">Final <span class="required">*</span></label>
                                                <div class="col-md-8">
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

									<div class="col-md-12">
										<h4 class="form-section">Google Maps</h4>
										<div class="form-group">
											<div class="col-md-offset-2 col-md-10">
												<div class="input-group">
                                                    {!! Form::text('direccion', NULL, ['class' => 'form-control', 'id'=>'calle_registrada', 'placeholder'=>'Calle No. Colonia, Ciudad Estado']) !!}
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
												<div id="gmap_geocoding" class="gmaps" style="height: 500px"></div>
												<span class="help-block">El indicador es solo una referencia muy cercana al lugar. </span>
											</div>
										</div>
									</div>

                                    <div class="col-md-offset-2 col-md-10">
                                        {{-- Botón Enviar --}}
                                        <div class="margin-top-20">
                                            <button type="submit" class="btn green-haze hvr-grow">Guardar cambios</button>
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