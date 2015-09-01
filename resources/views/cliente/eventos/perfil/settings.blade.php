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
								<a href="#tab_adicional" data-toggle="tab">Información Adicional</a>
							</li>
							<li>
								<a href="#tab_sociales" data-toggle="tab">Redes Sociales</a>
							</li>
							<li>
								<a href="#tab_logotipo" data-toggle="tab">Imagen del evento</a>
							</li>
							<li>
								<a href="#tab_1_3" data-toggle="tab">Change Password</a>
							</li>
							<li>
								<a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
							</li>
						</ul>
					</div>
					<div class="portlet-body form">
						<div class="tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane active" id="tab_principal">
								{!! Form::open($param) !!}
									<div class="col-md-6">
										<!-- Nombre del evento -->
										<div class="form-group">
											<label class="col-md-3 control-label">Nombre<span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-institution"></i>
													<input type="text" class="form-control" name="nombre" placeholder="Nombre del evento" value="{{$evento->nombre}}">
                                                    <input type="hidden" name="cliente_id" value="{{$user->id}}">
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
                                                        <input type="text" class="form-control" name="finicio" value="{{$finicio}}"  readonly>
                                                        <input type="hidden" class="form-control" name="fecha_inicio">
                                                        <input type="hidden" class="form-control" name="hora_inicio">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Final <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" class="form-control" name="ffin" value="{{$ffin}}" readonly>
                                                        <input type="hidden" class="form-control" name="fecha_termina">
                                                        <input type="hidden" class="form-control" name="hora_termina">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="col-md-12">
										{{--Mapas--}}
										<h4 class="form-section">Coordenadas y ubicación</h4>
										<div class="form-group">
											<label class="control-label">Latitud y Longitud <span class="required" aria-required="true">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" id="gmap_geocoding_address" placeholder="Dirección completa..." value="{{$evento->direccion}}">
												<span class="input-group-btn">
													<button class="btn blue" id="gmap_geocoding_btn">
													<i class="fa fa-map-marker"></i></button>
												</span>
											</div>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Readonly" name="latlng_gmaps" readonly>
										</div>
										<div class="form-group">
											<div id="gmap_geocoding" class="gmaps"></div>
											<span class="help-block">El indicador es solo una referencia muy cercana al lugar. </span>
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

							<!-- ADICIONAL INFO TAB -->
							<div class="tab-pane" id="tab_adicional">
								<form role="form" action="#" class="form-horizontal form-row-sepe">
                                    <h4 class="form-section">Dias y horarios</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Dias</label>
                                        <div class="col-md-10">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="1"> Lunes </label>
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="2"> Martes </label>
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="3"> Miércoles </label>
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="4"> Jueves </label>
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="5"> Viernes </label>
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="6"> Sábado </label>
                                                <label class="btn btn-default"><input type="checkbox" class="toggle" value="7"> Domingo </label>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-2 control-label">Abre</label>
										<div class="col-md-9">
											<div class="input-group input-small">
												<input type="text" class="form-control timepicker abre">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
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
												<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
												</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button type="button" class="btn blue btn-sm">Añadir horario</button>
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

							<!-- CAMBIO DE IMAGEN DE EVENTO -->
							<div class="tab-pane" id="tab_logotipo">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>
								<form action="#" role="form">
									<div class="form-group">
                                        <div id="newlogo"
                                             style="height: 503px; width: 503px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$img_evento}}') "
                                             data-evento-id="{{$current_evento_id}}"
                                             data-cliente-id="{{$evento->cliente_id}}"
                                             data-upload="{{route('global-upload-logo-evento')}}"
                                             data-crop="{{route('global-crop-logo-evento')}}">
                                        </div>
										<div class="clearfix margin-top-10">
											<span class="label label-danger">NOTE! </span>
											<span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
										</div>
									</div>
								</form>
							</div>
							<!-- END CHANGE AVATAR TAB -->

							<!-- CHANGE PASSWORD TAB -->
							<div class="tab-pane" id="tab_1_3">
								<form action="#">
									<div class="form-group">
										<label class="control-label">Current Password</label>
										<input type="password" class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">New Password</label>
										<input type="password" class="form-control"/>
									</div>
									<div class="form-group">
										<label class="control-label">Re-type New Password</label>
										<input type="password" class="form-control"/>
									</div>
									<div class="margin-top-10">
										<a href="javascript:;" class="btn green-haze">
											Change Password </a>
										<a href="javascript:;" class="btn default">
											Cancel </a>
									</div>
								</form>
							</div>
							<!-- END CHANGE PASSWORD TAB -->

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
													<input type="checkbox" value=""/> Yes </label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class="uniform-inline">
													<input type="checkbox" value=""/> Yes </label>
											</td>
										</tr>
										<tr>
											<td>
												Enim eiusmod high life accusamus terry richardson ad squid wolf moon
											</td>
											<td>
												<label class="uniform-inline">
													<input type="checkbox" value=""/> Yes </label>
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