<!DOCTYPE html>

<html lang = "en-US">
	<head>
		<meta charset = "UTF-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

		<link href = "{{asset('assets/tmpl/fonts/font-awesome.css')}}" rel = "stylesheet" type = "text/css">
		<link href = 'http://fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/bootstrap/css/bootstrap.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/bootstrap-select.min.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/style.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/user.style.css')}}" type = "text/css">

		{{-- Plugins Externos --}}
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/plugins/sweetalert/dist/sweetalert.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/plugins/bootstrap-social/bootstrap-social.css')}}" type = "text/css">

		<title>Spotter - Universal Directory Listing HTML Template</title>
	</head>

	<body onunload = "" class = "page-subpage page-register navigation-top-header" id = "page-top">

		{{--  Outer Wrapper --}}
		<div id = "outer-wrapper">
			{{--  Inner Wrapper  --}}
			<div id = "inner-wrapper">
				{{--  Navigation --}}
				<div class = "header">
					<div class = "wrapper">
						<div class = "brand">
							<a href = "index-directory.html"><img src = "{{asset('assets/tmpl/img/logo.png')}}" alt = "logo"></a>
						</div>
						<nav class = "navigation-items">
							<div class = "wrapper">
								<ul class = "main-navigation navigation-top-header"></ul>
								<ul class = "user-area">
									@if($isGuest)
										<li><a href = "sign-in.html">Sign In</a></li>
									@elseif($isAuth)
										<li>{{$user->nombreCompleto()}}</li>
									@endif
								</ul>
								<a href = "submit.html" class = "submit-item">
									<div class = "content"><span>Submit Your Item</span></div>
									<div class = "icon">
										<i class = "fa fa-plus"></i>
									</div>
								</a>
								<div class = "toggle-navigation">
									<div class = "icon">
										<div class = "line"></div>
										<div class = "line"></div>
										<div class = "line"></div>
									</div>
								</div>
							</div>
						</nav>
					</div>
				</div>
				{{--  end Navigation --}}
				{{--  Page Canvas --}}
				<div id = "page-canvas">
					{{-- Off Canvas Navigation --}}
					<nav class = "off-canvas-navigation">
						<header>Navigation</header>
						<div class = "main-navigation navigation-off-canvas"></div>
					</nav>
					{{-- end Off Canvas Navigation --}}

					{{-- Sub Header --}}
					<section class = "sub-header">
						<div class = "search-bar horizontal collapse" id = "redefine-search-form"></div>
						{{--  /.search-bar  --}}
						<div class = "breadcrumb-wrapper">
							<div class = "container">
								<div class = "redefine-search">
									<a href = "#redefine-search-form" class = "inner" data-toggle = "collapse" aria-expanded = "false" aria-controls = "redefine-search-form">
										<span class = "icon"></span>
										<span>Redefine Search</span>
									</a>
								</div>
								<ol class = "breadcrumb">
									<li><a href = "index-directory.html"><i class = "fa fa-home"></i></a></li>
									<li><a href = "#">Page</a></li>
									<li class = "active">Detail</li>
								</ol>
								{{--  /.breadcrumb --}}
							</div>
							{{--  /.container --}}
						</div>
						{{--  /.breadcrumb-wrapper --}}
					</section>
					{{-- end Sub Header --}}

					{{-- Page Content --}}
					<div id = "page-content">
						<section class = "container">
							<div class = "block">
								<div class = "row">
									<div class = "col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
										<header>
											<h1 class = "page-title">Regístrate</h1>
										</header>
										<a class="btn btn-block btn-social btn-facebook">
											<span class="fa fa-facebook"></span> Registrarme con Facebook
										</a>
										<hr>
										<h5 style="text-align: center"> o crea tu cuenta </h5>
										{!! Form::open($form_registro) !!}
											{{-- Nombres  --}}
											<div class = "form-group">
												<label for = "nombre">Nombre:</label>
												<input type = "text" class = "form-control" id = "nombre" name = "nombre">
											</div>
											{{-- Apellidos  --}}
											<div class = "form-group">
												<label for = "apellido">Apellido:</label>
												<input type = "text" class = "form-control" id = "apellido" name = "apellido">
											</div>
											{{-- Fecha de Nacimiento  --}}
											<div class = "form-group">
												<label for = "fecha_nacimiento">Fecha de nacimiento:</label>
												<input type = "text" class = "form-control" id = "fecha_nacimiento" name = "fecha_nacimiento">
											</div>
											{{--  Email  --}}
											<div class = "form-group">
												<label for = "email">Email:</label>
												<input type = "email" class = "form-control" id = "email" name = "email">
											</div>
											{{--  Genero  --}}
											<div class = "form-group">
												<label for = "sexo">Sexo:</label>
												<input type = "radio"  name = "sexo" value="H" checked>Hombre
												<input type = "radio" name = "sexo" value="M">Mujer
											</div>
											{{--  Password  --}}
											<div class = "form-group">
												<label for = "password">Contraseña:</label>
												<input type = "password" class = "form-control" id = "password" name = "password">
											</div>
											{{-- Confirma Contraseña --}}
											<div class = "form-group">
												<label for = "confirm_password">Confirma Contraseña:</label>
												<input type = "password" class = "form-control" id = "confirm_password" name = "confirm_password">
											</div>
											<div class = "form-group clearfix">
												<button type = "submit" class = "btn pull-right btn-default" id = "account-submit">
													Crear cuenta
												</button>
											</div>
										</form>
										<hr>
										<div class = "center">
											<figure class = "note">By clicking the “Create an Account” button you agree with our
												<a href = "terms-conditions.html" class = "link">Terms and conditions</a>
											</figure>
										</div>
									</div>
								</div>
							</div>
						</section>
						{{--  /.block --}}
					</div>
					{{--  end Page Content --}}
				</div>
				{{--  end Page Canvas --}}
				{{-- Page Footer --}}
				<footer id = "page-footer">
					<div class = "inner">
						<div class = "footer-top">
							<div class = "container">
								<div class = "row">
									<div class = "col-md-4 col-sm-4">
										{{-- New Items --}}
										<section>
											<h2>New Items</h2>
											<a href = "item-detail.html" class = "item-horizontal small">
												<h3>Cash Cow Restaurante</h3>
												<figure>63 Birch Street</figure>
												<div class = "wrapper">
													<div class = "image"><img src = "{{asset('assets/tmpl/img/items/1.jpg')}}" alt = ""></div>
													<div class = "info">
														<div class = "type">
															<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
															<span>Restaurant</span>
														</div>
														<div class = "rating" data-rating = "4"></div>
													</div>
												</div>
											</a>
											{{-- /.item-horizontal small --}}
											<a href = "item-detail.html" class = "item-horizontal small">
												<h3>Blue Chilli</h3>
												<figure>2476 Whispering Pines Circle</figure>
												<div class = "wrapper">
													<div class = "image"><img src = "{{asset('assets/tmpl/img/items/2.jpg')}}" alt = ""></div>
													<div class = "info">
														<div class = "type">
															<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
															<span>Restaurant</span>
														</div>
														<div class = "rating" data-rating = "3"></div>
													</div>
												</div>
											</a>
											{{-- /.item-horizontal small --}}
										</section>
										{{-- end New Items --}}
									</div>
									<div class = "col-md-4 col-sm-4">
										{{-- Recent Reviews --}}
										<section>
											<h2>Recent Reviews</h2>
											<a href = "item-detail.html#reviews" class = "review small">
												<h3>Max Five Lounge</h3>
												<figure>4365 Bruce Street</figure>
												<div class = "info">
													<div class = "rating" data-rating = "4"></div>
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
														<span>Restaurant</span>
													</div>
												</div>
												<p>
													Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non suscipit
													felis, sed sagittis tellus. Interdum et malesuada fames ac ante ipsum primis
													in faucibus. Cras ac placerat mauris.
												</p>
											</a>{{-- /.review --}}
											<a href = "item-detail.html#reviews" class = "review small">
												<h3>Saguaro Tavern</h3>
												<figure>2476 Whispering Pines Circle</figure>
												<div class = "info">
													<div class = "rating" data-rating = "5"></div>
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
														<span>Restaurant</span>
													</div>
												</div>
												<p>
													Pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper
													erat ut mollis curabitur
												</p>
											</a>
											{{-- /.review --}}
										</section>
										{{-- end Recent Reviews --}}
									</div>
									<div class = "col-md-4 col-sm-4">
										<section>
											<h2>About Us</h2>
											<address>
												<div>Max Five Lounge</div>
												<div>63 Birch Street</div>
												<div>Granada Hills, CA 91344</div>
												<figure>
													<div class = "info">
														<i class = "fa fa-mobile"></i>
														<span>818-832-5258</span>
													</div>
													<div class = "info">
														<i class = "fa fa-phone"></i>
														<span>+1 123 456 789</span>
													</div>
													<div class = "info">
														<i class = "fa fa-globe"></i>
														<a href = "#">www.maxfivelounge.com</a>
													</div>
												</figure>
											</address>
											<div class = "social">
												<a href = "#" class = "social-button"><i class = "fa fa-twitter"></i></a>
												<a href = "#" class = "social-button"><i class = "fa fa-facebook"></i></a>
												<a href = "#" class = "social-button"><i class = "fa fa-pinterest"></i></a>
											</div>

											<a href = "contact.html" class = "btn framed icon">Contact
												Us<i class = "fa fa-angle-right"></i></a>
										</section>
									</div>
									<!--/.col-md-4-->
								</div>
								{{-- /.row --}}
							</div>
							{{-- /.container --}}
						</div>
						{{-- /.footer-top --}}
						<div class = "footer-bottom">
							<div class = "container">
								<span class = "left">(C) ThemeStarz, All rights reserved</span>
								<span class = "right">
									<a href = "#page-top" class = "to-top roll"><i class = "fa fa-angle-up"></i></a>
								</span>
							</div>
						</div>
						{{-- /.footer-bottom --}}
					</div>
				</footer>
				{{-- end Page Footer --}}
			</div>
			{{-- end Inner Wrapper  --}}
		</div>
		{{-- end Outer Wrapper --}}

		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/jquery-2.1.0.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/before.load.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/jquery-migrate-1.2.1.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/bootstrap/js/bootstrap.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/smoothscroll.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/bootstrap-select.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/jquery.hotkeys.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/icheck.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/custom.js')}}"></script>

		{{-- Plugins externos --}}
		<script type = "text/javascript" src = "{{asset('assets/global/scripts/metronic.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/global/plugins/canvasloader-min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/plugins/inputmask/dist/jquery.inputmask.bundle.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/plugins/jquery-validation/js/localization/messages_es.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
		{{-- Scripts --}}
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/app/app.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/app/registro.js')}}"></script>

		<!--[if lte IE 9]>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/ie-scripts.js')}}"></script>
		<![endif]-->
	</body>
</html>