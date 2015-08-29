<!DOCTYPE html>
<!--[if IE 8]>
<html lang="es" class="ie8 no-js"><![endif]-->
<!--[if IE 9]>
<html lang="es" class="ie9 no-js"><![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->

	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<title>Metronic | Page Layouts - Blank Page</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
		<!-- END GLOBAL MANDATORY STYLES -->

		<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
		@yield('plugins-css')
		<link href="{{asset('assets/global/plugins/hover/css/hover-min.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/global/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome-animation.min.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/global/plugins/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">
		<!-- END PAGE LEVEL PLUGIN STYLES -->

		<!-- BEGIN THEME STYLES -->
		<link href="{{asset('assets/global/css/components-rounded.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/admin/layout4/css/layout.css')}}" rel="stylesheet" type="text/css"/>
		<link id="style_color" href="{{asset('assets/admin/layout4/css/themes/light.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/admin/layout4/css/custom.css')}}" rel="stylesheet" type="text/css"/>

		@yield('override-css')

		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
	</head>
	<!-- END HEAD -->

	<!-- BEGIN BODY -->
	<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
	<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
	<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
	<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
	<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
	<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
	<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-footer-fixed" token="{{csrf_token()}}">

		<!-- BEGIN HEADER -->
		<div class="page-header navbar navbar-fixed-top animated bounceInDown">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner">

				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="#"><img src="{{asset('assets/admin/layout4/img/logo-light.png')}}" alt="logo" class="logo-default"/></a>
					<div class="menu-toggler sidebar-toggler">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
					</div>
				</div>
				<!-- END LOGO -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->

				<!-- BEGIN PAGE ACTIONS -->

				<!-- DOC: Remove "hide" class to enable the page header actions -->
				@yield('header-actions')
				<!-- END PAGE ACTIONS -->

				<!-- BEGIN PAGE TOP -->
				<div class="page-top">

					<!-- BEGIN HEADER SEARCH BOX -->

					<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
					<form class="search-form" action="#" method="GET">
						<div class="input-group">
							<input type="text" class="form-control input-sm" placeholder="Search..." name="query">
							<span class="input-group-btn">
								<a href="javascript:" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END HEADER SEARCH BOX -->

					<!-- BEGIN TOP NAVIGATION MENU -->
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">

							<li class="separator hide"></li>

							<!-- BEGIN NOTIFICATION DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
								<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-bell"></i>
									<span class="badge badge-success"> 7</span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3><span class="bold">12 pending</span> notifications</h3>
										<a href="">view all</a>
									</li>
								</ul>
							</li>
							<!-- END NOTIFICATION DROPDOWN -->

							<li class="separator hide"></li>

							<!-- BEGIN INBOX DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
								<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-envelope-open"></i>
									<span class="badge badge-danger">4</span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3>You have<span class="bold">7 New</span> Messages</h3>
										<a href="">view all</a>
									</li>
								</ul>
							</li>
							<!-- END INBOX DROPDOWN -->

							<li class="separator hide"></li>

							<!-- BEGIN CALENDAR DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
								<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-calendar"></i>
									<span class="badge badge-primary">3</span>
								</a>
								<ul class="dropdown-menu extended tasks">
									<li class="external">
										<h3>You have<span class="bold">12 pending</span> tasks</h3>
										<a href="">view all</a>
									</li>
								</ul>
							</li>
							<!-- END CALENDAR DROPDOWN -->

							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-user dropdown-dark">
								<a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<span class="username username-hide-on-mobile">{{$user->nombreCompleto()}}</span>

								<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
								<img alt="" class="img-circle" src="{{asset('assets/admin/layout4/img/avatar9.jpg')}}"/>
								</a>
								<ul class="dropdown-menu dropdown-menu-default">
									<li>
										<a href=""><i class="icon-user"></i> My Profile</a>
									</li>
									<li>
										<a href=""><i class="icon-calendar"></i> My Calendar</a>
									</li>
									<li>
										<a href=""><i class="icon-envelope-open"></i> My Inbox<span class="badge badge-danger">3</span></a>
									</li>
									<li>
										<a href=""><i class="icon-rocket"></i> My Tasks<span class="badge badge-success">7</span></a>
									</li>
									<li class="divider"></li>
									<li>
										<a href=""><i class="icon-lock"></i> Lock Screen</a>
									</li>
									<li>
										<a href="{{route('logout.admin')}}"><i class="icon-key"></i> Salir</a>
									</li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->
						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
				</div>
				<!-- END PAGE TOP -->
			</div>
			<!-- END HEADER INNER -->
		</div>
		<!-- END HEADER -->

		<div class="clearfix"></div>

		<!-- BEGIN CONTAINER -->
		<div class="page-container">

			<!-- BEGIN SIDEBAR -->
			@yield('sidebar')
			<!-- END SIDEBAR -->

			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
					@section('modal')
					<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">Modal title</h4>
								</div>
								<div class="modal-body">Widget settings form goes here</div>
								<div class="modal-footer">
									<button type="button" class="btn blue">Save changes</button>
									<button type="button" class="btn default" data-dismiss="modal">Close</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					@show
					<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

					<!-- BEGIN PAGE HEADER-->

					<!-- BEGIN PAGE HEAD -->
					<div class="page-head">
						<!-- BEGIN PAGE TITLE -->
						<div class="page-title">
							@yield('page-title')
						</div>
						<!-- END PAGE TITLE -->

						@section('page-toolbar')
						<!-- BEGIN PAGE TOOLBAR -->
						<div class="page-toolbar">
							<!-- BEGIN THEME PANEL -->
							<div class="btn-group btn-theme-panel">
								<a href="javascript:" class="btn dropdown-toggle" data-toggle="dropdown">
									<i class="icon-settings"></i>
								</a>

								<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-12">
											<h3>THEME</h3>
											<ul class="theme-colors">
												<li class="theme-color theme-color-default active" data-theme="default">
													<span class="theme-color-view"></span>
													<span class="theme-color-name">Dark Header</span>
												</li>
												<li class="theme-color theme-color-light" data-theme="light">
													<span class="theme-color-view"></span>
													<span class="theme-color-name">Light Header</span>
												</li>
											</ul>
										</div>
										<div class="col-md-8 col-sm-8 col-xs-12 seperator">
											<h3>LAYOUT</h3>
											<ul class="theme-settings">
												<li>
													Theme Style
													<select class="layout-style-option form-control input-small input-sm">
														<option value="square" selected="selected">Square corners</option>
														<option value="rounded">Rounded corners</option>
													</select>
												</li>
												<li>
													Layout
													<select class="layout-option form-control input-small input-sm">
														<option value="fluid" selected="selected">Fluid</option>
														<option value="boxed">Boxed</option>
													</select>
												</li>
												<li>
													Header
													<select class="page-header-option form-control input-small input-sm">
														<option value="fixed" selected="selected">Fixed</option>
														<option value="default">Default</option>
													</select>
												</li>
												<li>
													Top Dropdowns
													<select class="page-header-top-dropdown-style-option form-control input-small input-sm">
														<option value="light">Light</option>
														<option value="dark" selected="selected">Dark</option>
													</select>
												</li>
												<li>
													Sidebar Mode
													<select class="sidebar-option form-control input-small input-sm">
														<option value="fixed">Fixed</option>
														<option value="default" selected="selected">Default</option>
													</select>
												</li>
												<li>
													Sidebar Menu
													<select class="sidebar-menu-option form-control input-small input-sm">
														<option value="accordion" selected="selected">Accordion</option>
														<option value="hover">Hover</option>
													</select>
												</li>
												<li>
													Sidebar Position
													<select class="sidebar-pos-option form-control input-small input-sm">
														<option value="left" selected="selected">Left</option>
														<option value="right">Right</option>
													</select>
												</li>
												<li>
													Footer
													<select class="page-footer-option form-control input-small input-sm">
														<option value="fixed">Fixed</option>
														<option value="default" selected="selected">Default</option>
													</select>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- END THEME PANEL -->
						</div>
						<!-- END PAGE TOOLBAR -->
						@show
					</div>
					<!-- END PAGE HEAD -->

					<!-- BEGIN PAGE BREADCRUMB -->
					@yield('page-breadcrumb')
					<!-- END PAGE BREADCRUMB -->

					<!-- END PAGE HEADER-->

					<!-- BEGIN PAGE CONTENT-->
					@yield('content')
					<!-- END PAGE CONTENT-->
				</div>
			</div>
			<!-- END CONTENT -->
		</div>
		<!-- END CONTAINER -->

		<!-- BEGIN FOOTER -->
		<div class="page-footer">
			<div class="page-footer-inner">
				@section('page-footer-inner')
				{{date('Y')}} &copy; Metronic by keenthemes.
				@show
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
		<!-- END FOOTER -->

		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

		<!-- BEGIN CORE PLUGINS -->
		<!--[if lt IE 9]>
		<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
		<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
		<![endif]-->

		<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
		<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/canvasloader-min.js')}}" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->

		<!-- BEGIN PAGE LEVEL PLUGINS -->
		@yield('plugins-core-js')
		<script src="{{asset('assets/global/plugins/bootstrap-sessiontimeout/jquery.sessionTimeout.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->

		<script src="{{asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/scripts/app.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/admin/layout4/scripts/layout.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/admin/layout4/scripts/demo.js')}}" type="text/javascript"></script>
		@yield('page-level-js')

		<script>
			jQuery(document).ready(function () {
				Metronic.init(); // init metronic core components
				App.init();
				Layout.init(); // init current layout
				Demo.init(); // init demo features
				@yield('init-js')
			});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>