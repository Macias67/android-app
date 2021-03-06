@extends('cliente.promociones.perfil.perfil')

@section('profile-content')
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Información de la Promoción</span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_principal" data-toggle="tab">Información Principal</a>
							</li>
							<li>
								<a href="#tab_logotipo" data-toggle="tab">Imagen de la Promoción</a>
							</li>
						</ul>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane active" id="tab_principal">
								{!! Form::open($param) !!}
								{!! Form::model($promocion) !!}
								{!! Form::hidden('id') !!}
								{!! Form::hidden('cliente_id') !!}
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-md-3 control-label">Nombre<span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-star"></i>
													{!! Form::text('nombre', NULL, ['class' => 'form-control', 'placeholder' => 'Nombre del evento']) !!}
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Slug <span class="required">*</span></label>

											<div class="col-md-9">
												<div class="input-icon">
													<i class="fa fa-desktop"></i>
													{!! Form::text('slug', NULL, ['class' => 'form-control', 'placeholder' => 'Slug', 'readonly']) !!}
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Descripción<span class="required">*</span></label>

											<div class="col-md-9">
												{!! Form::textarea('descripcion', NULL, ['class' => 'form-control', 'style' => 'resize: none;','maxlength'=>'255','rows'=>'3']) !!}
												<span class="help-block">Descripción detallada de la promoción. </span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-body">
											<div class="form-group">
												<label class="control-label col-md-3">Estatus<span class="required">*</span></label>

												<div class="col-md-9">
													<input type="checkbox" class="make-switch" name="estatus"
													       @if($promocion->estatus == 'online')
														       checked
													       @endif
													       data-size="small"
													       data-on-text="Online" data-off-text="Offline"
													       data-on-color="success"
													       data-off-color="default">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Inicio <span class="required">*</span></label>

												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-calendar"></i>
														<input type="text" class="form-control" name="finicio"  readonly>
														<input type="hidden" class="form-control" name="disp_inicio" value="{{$promocion->disp_inicio}}">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Final <span class="required">*</span></label>

												<div class="col-md-9">
													<div class="input-icon">
														<i class="fa fa-calendar"></i>
														<input type="text" class="form-control" name="ffin" placeholder="Url del promoción" readonly>
														<input type="hidden" class="form-control" name="disp_fin" value="{{$promocion->disp_fin}}">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-3 col-md-9">
													<button type="button" class="btn default" id="reportrange">
														<i class="fa fa-calendar"></i> Disposición
														<i class="fa fa-angle-down"></i></button>
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
                                             style="height: 503px; width: 503px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$img_promocion}}') "
											 data-id="{{$current_promocion_id}}"
                                             data-cliente-id="{{$promocion->cliente_id}}"
                                             data-upload="{{route('global-upload-logo-promocion')}}"
                                             data-crop="{{route('global-crop-logo-promocion')}}">
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