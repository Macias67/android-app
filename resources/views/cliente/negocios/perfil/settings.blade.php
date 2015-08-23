@extends('cliente.negocios.perfil.perfil')

@section('profile-content')
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
							</li>
							<li>
								<a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
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
							<div class="tab-pane active" id="tab_1_1">
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
							<!-- END PERSONAL INFO TAB -->

							<!-- CHANGE AVATAR TAB -->
							<div class="tab-pane" id="tab_1_2">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
								</p>
								<form action="#" role="form">
									<div class="form-group">
										<div id="logo" style="height: 250px; width: 250px; display: block; position:relative; border: 1px dotted black;" data-id="{{$current_cliente_id}}" data-upload="{{route('global-upload-logo-negocio')}}" data-crop="{{route('global-crop-logo-negocio')}}">
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