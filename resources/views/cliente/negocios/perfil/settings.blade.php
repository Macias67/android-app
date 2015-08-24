@extends('cliente.negocios.perfil.perfil')

@section('profile-content')
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Información Principal</span>
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
								<a href="#tab_logotipo" data-toggle="tab">Logotipo</a>
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
								<form role="form" action="#">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Nombre</label>
											<input type="text" value="{{$cliente->nombre}}" class="form-control"/>
											<input type="hidden" name="id" value="{{$cliente->id}}">
										</div>
										<div class="form-group">
											<label class="control-label">Calle</label>
											<input type="text" value="{{$cliente->calle}}" class="form-control input-large"/>
										</div>
										<div class="form-group">
											<label class="control-label">Número</label>
											<input type="text" value="{{$cliente->numero}}" class="form-control input-small"/>
										</div>
										<div class="form-group">
											<label class="control-label">Colonia</label>
											<input type="text" value="{{$cliente->colonia}}" class="form-control input-small"/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Código Postal</label>
											<input type="text" value="{{$cliente->codigo_postal}}" class="form-control input-small"/>
										</div>
										<div class="form-group">
											<label class="control-label">Referencía</label>
											<textarea class="form-control" rows="3" placeholder="">{{$cliente->referencia}}</textarea>
										</div>
										<div class="form-group">
											<label class="control-label">Estatus</label><br>
											<input type="checkbox" class="form-control make-switch" name="estatus"
											       data-size="small"
											       data-on-text="Online" data-off-text="Offline"
											       data-on-color="success"
											       data-off-color="default">
										</div>
									</div>
									{{--Mapas--}}
									<div class="col-md-12">
										<h4 class="form-section">Coordenadas y ubicación</h4>
										<hr>
										<div class="form-group">
											<label class="control-label">Latitud y Longitud <span class="required" aria-required="true">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" id="gmap_geocoding_address" placeholder="Dirección completa...">
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
										<div class="margin-top-20">
											<a href="javascript:;" class="btn green-haze">Save Changes </a>
											<a href="javascript:;" class="btn default">Cancel </a>
										</div>
									</div>
								</form>
								<div class="clearfix"></div>
							</div>
							<!-- END PERSONAL INFO TAB -->

							<!-- ADICIONAL INFO TAB -->
							<div class="tab-pane" id="tab_adicional">
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

							<!-- CHANGE AVATAR TAB -->
							<div class="tab-pane" id="tab_logotipo">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>
								<form action="#" role="form">
									<div class="form-group">
										<div id="newlogo" style="height: 502px; width: 502px; display: block; position:relative; border: 1px dotted black; background-image: url('{{$logo}}') " data-id="{{$current_cliente_id}}" data-upload="{{route('global-upload-logo-negocio')}}" data-crop="{{route('global-crop-logo-negocio')}}">
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