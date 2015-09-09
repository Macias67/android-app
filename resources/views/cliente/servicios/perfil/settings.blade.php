@extends('cliente.servicios.perfil.perfil')

@section('profile-content')
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Información del servicio</span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_principal" data-toggle="tab">Información Principal</a>
							</li>
							<li>
								<a href="#tab_logotipo" data-toggle="tab">Imagen del servicio</a>
							</li>
							<li>
								<a href="#tab_1_3" data-toggle="tab">Change Password</a>
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
								{!! Form::open($param) !!}
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-md-3 control-label">Categoría<span class="required">*</span></label>

											<div class="col-md-9">
												{!! Form::select('categoria_id', $categorias, $servicio->categoria_id, ['class' => 'form-control']) !!}
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Nombre<span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-star"></i>
													<input type="text" class="form-control" name="nombre" placeholder="Nombre de la servicio" value="{{$servicio->nombre}}">
                                                    <input type="hidden" name="id" value="{{$servicio->id}}">
                                                    <input type="hidden" name="cliente_id" value="{{$servicio->cliente_id}}">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Slug <span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													<input type="text" class="form-control" name="slug" placeholder="Url de la servicio" value="{{$servicio->slug}}" readonly>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Descripción<span class="required">*</span></label>

											<div class="col-md-9">
												<textarea class="form-control" name="descripcion" maxlength="255" rows="3" style="resize: none;">{{$servicio->descripcion}}</textarea>
												<span class="help-block">Descripción detallada del servicio. </span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Descripción corta
												<span class="required">*</span></label>

											<div class="col-md-9">
												<textarea class="form-control" name="descripcion_corta" maxlength="45" rows="2" style="resize: none;">{{$servicio->descripcion_corta}}</textarea>
												<span class="help-block">Descripción resumida del servicio. </span>
											</div>
										</div>

									</div>
									<div class="col-md-6">
										<div class="form-body">
											<div class="form-group">
												<label class="control-label col-md-3">Estatus<span class="required">*</span></label>

												<div class="col-md-9">
													<input type="checkbox" class="make-switch" name="estatus"
													       @if($servicio->estatus == 'online')
														       checked
													       @endif
													       data-size="small"
													       data-on-text="Online" data-off-text="Offline"
													       data-on-color="success"
													       data-off-color="default">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Precio
													<span class="required">*</span></label>

												<div class="col-md-9">
													<div class="input-inline input-medium">
														<input id="precio" type="text" name="precio" class="form-control" value="{{$servicio->precio}}">
													</div>
													<span class="help-block">Solo dos deciamles (99.99), 0 es gratis </span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-3 col-md-9">
													<button type="button" class="btn default" id="reportrange">
														<i class="fa fa-calendar"></i> Disposición
														<i class="fa fa-angle-down"></i></button>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Inicio <span class="required">*</span></label>

												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-calendar"></i>
														<input type="text" class="form-control" name="finicio"  readonly>
														<input type="hidden" class="form-control" name="disp_inicio" value="{{$servicio->disp_inicio}}">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Final <span class="required">*</span></label>

												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-calendar"></i>
														<input type="text" class="form-control" name="ffin" placeholder="Url del servicio" readonly>
														<input type="hidden" class="form-control" name="disp_fin" value="{{$servicio->disp_fin}}">
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="margin-top-20">
                                            <button type="submit" class="btn green-haze">Guardar cambios</button>
										</div>
									</div>
								</form>
								<div class="clearfix"></div>
							</div>
							<!-- END PERSONAL INFO TAB -->

							<!-- CHANGE AVATAR TAB -->
							<div class="tab-pane" id="tab_logotipo">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>
								<form action="#" role="form">
									<div class="form-group">
										<div id="newlogo"
                                             style="height: 503px; width: 503px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$img_servicio}}') "
											 data-id="{{$current_servicio_id}}"
                                             data-cliente-id="{{$servicio->cliente_id}}"
                                             data-upload="{{route('global-upload-logo-servicios')}}"
                                             data-crop="{{route('global-crop-logo-servicios')}}">
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