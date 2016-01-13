<!DOCTYPE html>

<html lang = "en-US">
	<head>
		<meta charset = "UTF-8"/>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

		<link href = "{{asset('assets/tmpl/fonts/font-awesome.css')}}" rel = "stylesheet" type = "text/css">
		<link href = 'http://fonts.googleapis.com/css?family=Montserrat:400,700' rel = 'stylesheet' type = 'text/css'>
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/bootstrap/css/bootstrap.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/bootstrap-select.min.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/owl.carousel.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/jquery.mCustomScrollbar.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/style.css')}}" type = "text/css">
		<link rel = "stylesheet" href = "{{asset('assets/tmpl/css/user.style.css')}}" type = "text/css">

		<title>Spotter - Universal Directory Listing HTML Template</title>
	</head>
	
	<body onunload = "" class = "map-fullscreen page-homepage navigation-off-canvas" id = "page-top" token="{{csrf_token()}}">

		{{-- Outer Wrapper --}}
		<div id = "outer-wrapper">
			{{-- Inner Wrapper  --}}
			<div id = "inner-wrapper">
				{{-- Navigation --}}
				<div class = "header">
					<div class = "wrapper">
						<div class = "brand">
							<a href = "{{route('app.principal')}}"><img src = "{{asset('assets/tmpl/img/logo.png')}}" alt = "logo"></a>
						</div>
						<nav class = "navigation-items">
							<div class = "wrapper">
								<ul class = "main-navigation navigation-top-header"></ul>
								<ul class = "user-area">
									@if($isGuest)
										<li><a href = "{{route('app.signin')}}">Entrar</a></li>
										<li><a href = "{{route('app.registro')}}"><strong>Regístrate</strong></a></li>
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
				{{-- end Navigation --}}
				{{-- Page Canvas --}}
				<div id = "page-canvas">
					{{-- Off Canvas Navigation --}}
					<nav class = "off-canvas-navigation">
						<header>Navigation</header>
						<div class = "main-navigation navigation-off-canvas"></div>
					</nav>
					{{-- end Off Canvas Navigation --}}
					{{-- Page Content --}}
					<div id = "page-content">
						{{-- Map Canvas --}}
						<div class = "map-canvas list-width-30">
							{{-- Map  --}}
							<div class = "map">
								<div class = "toggle-navigation">
									<div class = "icon">
										<div class = "line"></div>
										<div class = "line"></div>
										<div class = "line"></div>
									</div>
								</div>
								{{-- /.toggle-navigation --}}
								<div id = "map" class = "has-parallax"></div>
								{{-- /#map --}}
								<div class = "search-bar horizontal">
									<form class = "main-search border-less-inputs" role = "form" method = "post">
										<div class = "input-row">
											<div class = "form-group">
												<input type = "text" class = "form-control" id = "keyword" placeholder = "Enter Keyword">
											</div>
											{{-- /.form-group  --}}
											<div class = "form-group">
												<div class = "input-group location">
													<input type = "text" class = "form-control" id = "location" placeholder = "Enter Location">
													<span class = "input-group-addon"><i class = "fa fa-map-marker geolocation" data-toggle = "tooltip" data-placement = "bottom" title = "Find my position"></i></span>
												</div>
											</div>
											{{-- /.form-group  --}}
											<div class = "form-group">
												<select name = "category" multiple title = "Select Category" data-live-search = "true">
													<option value = "1">Stores</option>
													<option value = "2" class = "sub-category">Apparel</option>
													<option value = "3" class = "sub-category">Computers</option>
													<option value = "4" class = "sub-category">Nature</option>
													<option value = "5">Tourism</option>
													<option value = "6">Restaurant & Bars</option>
													<option value = "7" class = "sub-category">Bars</option>
													<option value = "8" class = "sub-category">Vegetarian</option>
													<option value = "9" class = "sub-category">Steak & Grill</option>
													<option value = "10">Sports</option>
													<option value = "11" class = "sub-category">Cycling</option>
													<option value = "12" class = "sub-category">Water Sports</option>
													<option value = "13" class = "sub-category">Winter Sports</option>
												</select>
											</div>
											{{-- /.form-group  --}}
											<div class = "form-group">
												<button type = "submit" class = "btn btn-default"><i class = "fa fa-search"></i>
												</button>
											</div>
											{{-- /.form-group  --}}
										</div>
										{{-- /.input-row  --}}
									</form>
									{{-- /.main-search  --}}
								</div>
								{{-- /.search-bar  --}}
							</div>
							{{-- end Map  --}}
							{{-- Items List --}}
							<div class = "items-list">
								<div class = "inner">
									<header>
										<h3>Results</h3>
									</header>
									<ul class = "results list">

									</ul>
								</div>
								{{-- results --}}
							</div>
							{{-- end Items List --}}
						</div>
						{{-- end Map Canvas --}}
						{{-- Featured --}}
						<section id = "featured" class = "block background-color-grey-dark equal-height">
							<div class = "container">
								<header><h2>Featured</h2></header>
								<div class = "row">
									<div class = "col-md-3 col-sm-3">
										<div class = "item featured">
											<div class = "image">
												<div class = "quick-view" id = "1" data-url="{{route('quick-view')}}">
													<i class = "fa fa-eye"></i><span>Quick View</span></div>
												<a href = "item-detail.html">
													<div class = "overlay">
														<div class = "inner">
															<div class = "content">
																<h4>Description</h4>
																<p>Curabitur odio nibh, luctus non pulvinar a,
																	ultricies ac diam. Donec neque massa</p>
															</div>
														</div>
													</div>
													<div class = "item-specific">
														<span title = "Bedrooms"><img src = "{{asset('assets/tmpl/img/bedrooms.png')}}" alt = "">2</span>
														<span title = "Bathrooms"><img src = "{{asset('assets/tmpl/img/bathrooms.png')}}" alt = "">2</span>
														<span title = "Area"><img src = "{{asset('assets/tmpl/img/area.png')}}" alt = "">240m<sup>2</sup></span>
														<span title = "Garages"><img src = "{{asset('assets/tmpl/img/garages.png')}}" alt = "">1</span>
													</div>
													<div class = "icon">
														<i class = "fa fa-thumbs-up"></i>
													</div>
													<img src = "{{asset('assets/tmpl/img/items/1.jpg')}}" alt = "">
												</a>
											</div>
											<div class = "wrapper">
												<a href = "item-detail.html"><h3>Steak House Restaurant</h3></a>
												<figure>63 Birch Street</figure>
												<div class = "info">
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
														<span>Restaurant</span>
													</div>
													<div class = "rating" data-rating = "4"></div>
												</div>
											</div>
										</div>
										{{-- /.item --}}
									</div>
									{{-- /.col-sm-4 --}}
									<div class = "col-md-3 col-sm-3">
										<div class = "item featured">
											<div class = "image">
												<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span></div>
												<a href = "item-detail.html">
													<div class = "overlay">
														<div class = "inner">
															<div class = "content">
																<h4>Description</h4>
																<p>Curabitur odio nibh, luctus non pulvinar a,
																	ultricies ac diam. Donec neque massa</p>
															</div>
														</div>
													</div>
													<img src = "{{asset('assets/tmpl/img/items/2.jpg')}}" alt = "">
												</a>
											</div>
											<div class = "wrapper">
												<a href = "item-detail.html"><h3>Benny’s Cafeteria</h3></a>
												<figure>63 Birch Street</figure>
												<div class = "info">
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/cafetaria.png')}}" alt = ""></i>
														<span>Cafeteria</span>
													</div>
													<div class = "rating" data-rating = "4"></div>
												</div>
											</div>
										</div>
										{{-- /.item --}}
									</div>
									{{-- /.col-sm-4 --}}
									<div class = "col-md-3 col-sm-3">
										<div class = "item featured">
											<div class = "image">
												<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span></div>
												<a href = "item-detail.html">
													<div class = "overlay">
														<div class = "inner">
															<div class = "content">
																<h4>Description</h4>
																<p>Curabitur odio nibh, luctus non pulvinar a,
																	ultricies ac diam. Donec neque massa</p>
															</div>
														</div>
													</div>
													<div class = "item-specific">
														<span>Daily menu from: $6</span>
													</div>
													<img src = "{{asset('assets/tmpl/img/items/restaurant/9.jpg')}}" alt = "">
												</a>
											</div>
											<div class = "wrapper">
												<a href = "item-detail.html"><h3>Big Bamboo</h3></a>
												<figure>4662 Bruce Street</figure>
												<div class = "info">
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/japanese-food.png')}}" alt = ""></i>
														<span>Sushi</span>
													</div>
													<div class = "rating" data-rating = "3"></div>
												</div>
											</div>
										</div>
										{{-- /.item --}}
									</div>
									{{-- /.col-sm-4 --}}
									<div class = "col-md-3 col-sm-3">
										<div class = "item featured">
											<div class = "image">
												<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span></div>
												<a href = "item-detail.html">
													<div class = "overlay">
														<div class = "inner">
															<div class = "content">
																<h4>Description</h4>
																<p>Curabitur odio nibh, luctus non pulvinar a,
																	ultricies ac diam. Donec neque massa</p>
															</div>
														</div>
													</div>
													<div class = "item-specific">
														<span>Daily menu from: $6</span>
													</div>
													<img src = "{{asset('assets/tmpl/img/items/restaurant/10.jpg')}}" alt = "">
												</a>
											</div>
											<div class = "wrapper">
												<a href = "item-detail.html"><h3>Sushi Wooshi Bar</h3></a>
												<figure>357 Trainer Avenue</figure>
												<div class = "info">
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/fishchips.png')}}" alt = ""></i>
														<span>Sushi Bar</span>
													</div>
													<div class = "rating" data-rating = "3"></div>
												</div>
											</div>
										</div>
										{{-- /.item --}}
									</div>
									{{-- /.col-sm-4 --}}
								</div>
								{{-- /.row --}}
							</div>
							{{-- /.container --}}
						</section>
						{{-- end Featured --}}

						{{-- Popular --}}
						<section id = "popular" class = "block background-color-white">
							<div class = "container">
								<header><h2>Popular</h2></header>
								<div class = "owl-carousel wide carousel">
									<div class = "slide">
										<div class = "inner">
											<div class = "image">
												<div class = "item-specific">
													<div class = "inner">
														<div class = "content">
															<dl>
																<dt>Bedrooms</dt>
																<dd>2</dd>
																<dt>Bathrooms</dt>
																<dd>2</dd>
																<dt>Area</dt>
																<dd>240m<sup>2</sup></dd>
																<dt>Garages</dt>
																<dd>1</dd>
																<dt>Build Year</dt>
																<dd>1990</dd>
															</dl>
														</div>
													</div>
												</div>
												<img src = "{{asset('assets/tmpl/img/items/restaurant/8.jpg')}}" alt = "">
											</div>
											<div class = "wrapper">
												<a href = "item-detail.html"><h3>Magma Bar and Grill</h3></a>
												<figure>
													<i class = "fa fa-map-marker"></i>
													<span>970 Chapel Street, Rosenberg, TX 77471</span>
												</figure>
												<div class = "info">
													<div class = "rating" data-rating = "4">
														<aside class = "reviews">6 reviews</aside>
													</div>
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
														<span>Restaurant</span>
													</div>
												</div>
												{{-- /.info --}}
												<p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa,
													viverra interdum eros ut,
													imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec
													semper semper erat ut mollis.
													Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra dui...
												</p>
												<a href = "item-detail.html" class = "read-more icon">Read More</a>
											</div>
											{{-- /.wrapper --}}
										</div>
										{{-- /.inner --}}
									</div>
									{{-- /.slide --}}
									<div class = "slide">
										<div class = "inner">
											<div class = "image">
												<div class = "item-specific">
													<div class = "inner">
														<div class = "content">
															<dl>
																<dt>Bedrooms</dt>
																<dd>2</dd>
																<dt>Bathrooms</dt>
																<dd>2</dd>
																<dt>Area</dt>
																<dd>240m<sup>2</sup></dd>
																<dt>Garages</dt>
																<dd>1</dd>
																<dt>Build Year</dt>
																<dd>1990</dd>
															</dl>
														</div>
													</div>
												</div>
												<img src = "{{asset('assets/tmpl/img/items/restaurant/9.jpg')}}" alt = "">
											</div>
											<div class = "wrapper">
												<a href = "item-detail.html"><h3>Saguaro Tavern</h3></a>
												<figure>
													<i class = "fa fa-map-marker"></i>
													<span>2476 Whispering Pines Circle</span>
												</figure>
												<div class = "info">
													<div class = "rating" data-rating = "4">
														<aside class = "reviews">6 reviews</aside>
													</div>
													<div class = "type">
														<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
														<span>Restaurant</span>
													</div>
												</div>
												{{-- /.info --}}
												<p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa,
													viverra interdum eros ut,
													imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec
													semper semper erat ut mollis.
													Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra dui...
												</p>
												<a href = "item-detail.html" class = "read-more icon">Read More</a>
											</div>
											{{-- /.wrapper --}}
										</div>
										{{-- /.inner --}}
									</div>
									{{-- /.slide --}}
								</div>
								{{-- /.owl-carousel --}}
							</div>
							{{-- /.container --}}
						</section>
						{{-- end Popular --}}
						<section class = "block equal-height">
							<div class = "container">
								<div class = "row">
									<div class = "col-md-9">
										<header><h2>Popular Listings</h2></header>
										<div class = "row">
											<div class = "col-md-4 col-sm-4">
												<div class = "item">
													<div class = "image">
														<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span>
														</div>
														<a href = "item-detail.html">
															<div class = "overlay">
																<div class = "inner">
																	<div class = "content">
																		<h4>Description</h4>
																		<p>Curabitur odio nibh, luctus non
																			pulvinar a, ultricies ac
																			diam. Donec neque massa</p>
																	</div>
																</div>
															</div>
															<div class = "item-specific">
																<span title = "Bedrooms"><img src = "{{asset('assets/tmpl/img/bedrooms.png')}}" alt = "">2</span>
																<span title = "Bathrooms"><img src = "{{asset('assets/tmpl/img/bathrooms.png')}}" alt = "">2</span>
																<span title = "Area"><img src = "{{asset('assets/tmpl/img/area.png')}}" alt = "">240m<sup>2</sup></span>
																<span title = "Garages"><img src = "{{asset('assets/tmpl/img/garages.png')}}" alt = "">1</span>
															</div>
															<div class = "icon">
																<i class = "fa fa-thumbs-up"></i>
															</div>
															<img src = "{{asset('assets/tmpl/img/items/1.jpg')}}" alt = "">
														</a>
													</div>
													<div class = "wrapper">
														<a href = "item-detail.html"><h3>Steak House Restaurant</h3></a>
														<figure>63 Birch Street</figure>
														<div class = "info">
															<div class = "type">
																<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
																<span>Restaurant</span>
															</div>
															<div class = "rating" data-rating = "4"></div>
														</div>
													</div>
												</div>
												{{-- /.item --}}
											</div>
											{{-- /.col-sm-4 --}}
											<div class = "col-md-4 col-sm-4">
												<div class = "item">
													<div class = "image">
														<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span>
														</div>
														<a href = "item-detail.html">
															<div class = "overlay">
																<div class = "inner">
																	<div class = "content">
																		<h4>Description</h4>
																		<p>Curabitur odio nibh, luctus non
																			pulvinar a, ultricies ac
																			diam. Donec neque massa</p>
																	</div>
																</div>
															</div>
															<img src = "{{asset('assets/tmpl/img/items/2.jpg')}}" alt = "">
														</a>
													</div>
													<div class = "wrapper">
														<a href = "item-detail.html"><h3>Benny’s Cafeteria</h3></a>
														<figure>63 Birch Street</figure>
														<div class = "info">
															<div class = "type">
																<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/cafetaria.png')}}" alt = ""></i>
																<span>Cafeteria</span>
															</div>
															<div class = "rating" data-rating = "4"></div>
														</div>
													</div>
												</div>
												{{-- /.item --}}
											</div>
											{{-- /.col-sm-4 --}}
											<div class = "col-md-4 col-sm-4">
												<div class = "item">
													<div class = "image">
														<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span>
														</div>
														<a href = "item-detail.html">
															<div class = "overlay">
																<div class = "inner">
																	<div class = "content">
																		<h4>Description</h4>
																		<p>Curabitur odio nibh, luctus non
																			pulvinar a, ultricies ac
																			diam. Donec neque massa</p>
																	</div>
																</div>
															</div>
															<div class = "item-specific">
																<span>Daily menu from: $6</span>
															</div>
															<img src = "{{asset('assets/tmpl/img/items/restaurant/9.jpg')}}" alt = "">
														</a>
													</div>
													<div class = "wrapper">
														<a href = "item-detail.html"><h3>Big Bamboo</h3></a>
														<figure>4662 Bruce Street</figure>
														<div class = "info">
															<div class = "type">
																<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/japanese-food.png')}}" alt = ""></i>
																<span>Sushi</span>
															</div>
															<div class = "rating" data-rating = "3"></div>
														</div>
													</div>
												</div>
												{{-- /.item --}}
											</div>
											{{-- /.col-sm-4 --}}
										</div>
										{{-- /.row --}}

										{{-- Recent --}}
										<section id = "recent">
											<header><h2>Recent</h2></header>
											<div class = "item list">
												<div class = "image">
													<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span>
													</div>
													<a href = "item-detail.html">
														<div class = "overlay">
															<div class = "inner">
																<div class = "content">
																	<h4>Description</h4>
																	<p>Curabitur odio nibh, luctus non pulvinar
																		a, ultricies ac diam. Donec neque
																		massa</p>
																</div>
															</div>
														</div>
														<div class = "item-specific">
															<span title = "Bedrooms"><img src = "{{asset('assets/tmpl/img/bedrooms.png')}}" alt = "">2</span>
															<span title = "Bathrooms"><img src = "{{asset('assets/tmpl/img/bathrooms.png')}}" alt = "">2</span>
															<span title = "Area"><img src = "{{asset('assets/tmpl/img/area.png')}}" alt = "">240m<sup>2</sup></span>
															<span title = "Garages"><img src = "{{asset('assets/tmpl/img/garages.png')}}" alt = "">1</span>
														</div>
														<div class = "icon">
															<i class = "fa fa-thumbs-up"></i>
														</div>
														<img src = "{{asset('assets/tmpl/img/items/1.jpg')}}" alt = "">
													</a>
												</div>
												<div class = "wrapper">
													<a href = "item-detail.html"><h3>Cash Cow Restaurante</h3></a>
													<figure>63 Birch Street</figure>
													<div class = "info">
														<div class = "type">
															<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
															<span>Restaurant</span>
														</div>
														<div class = "rating" data-rating = "4"></div>
													</div>
												</div>
											</div>
											{{-- /.item --}}
											<div class = "item list">
												<div class = "image">
													<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span>
													</div>
													<a href = "item-detail.html">
														<div class = "overlay">
															<div class = "inner">
																<div class = "content">
																	<h4>Description</h4>
																	<p>Curabitur odio nibh, luctus non pulvinar
																		a, ultricies ac diam. Donec neque
																		massa</p>
																</div>
															</div>
														</div>
														<img src = "{{asset('assets/tmpl/img/items/2.jpg')}}" alt = "">
													</a>
												</div>
												<div class = "wrapper">
													<a href = "item-detail.html"><h3>Benny’s Cafeteria</h3></a>
													<figure>63 Birch Street</figure>
													<div class = "info">
														<div class = "type">
															<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/cafetaria.png')}}" alt = ""></i>
															<span>Cafeteria</span>
														</div>
														<div class = "rating" data-rating = "4"></div>
													</div>
												</div>
											</div>
											{{-- /.item --}}
											<div class = "item list">
												<div class = "image">
													<div class = "quick-view"><i class = "fa fa-eye"></i><span>Quick View</span>
													</div>
													<a href = "item-detail.html">
														<div class = "overlay">
															<div class = "inner">
																<div class = "content">
																	<h4>Description</h4>
																	<p>Curabitur odio nibh, luctus non pulvinar
																		a, ultricies ac diam. Donec neque
																		massa</p>
																</div>
															</div>
														</div>
														<div class = "item-specific">
															<span>Daily menu from: $6</span>
														</div>
														<img src = "{{asset('assets/tmpl/img/items/restaurant/9.jpg')}}" alt = "">
													</a>
												</div>
												<div class = "wrapper">
													<a href = "item-detail.html"><h3>Big Bamboo</h3></a>
													<figure>4662 Bruce Street</figure>
													<div class = "info">
														<div class = "type">
															<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/japanese-food.png')}}" alt = ""></i>
															<span>Sushi</span>
														</div>
														<div class = "rating" data-rating = "3"></div>
													</div>
												</div>
											</div>
											{{-- /.item --}}
										</section>
										{{-- end Recent --}}
										{{-- Categories --}}
										<section id = "categories">
											<header><h2>Categories</h2></header>
											<ul class = "categories">
												<li><a href = "#">Arts & Humanities</a>
													<ul class = "sub-category">
														<li><a href = "#">Photography</a></li>
														<li><a href = "#">History</a></li>
														<li><a href = "#">Literature</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Business & Economy</a>
													<ul class = "sub-category">
														<li><a href = "#">B2B</a></li>
														<li><a href = "#">Finance</a></li>
														<li><a href = "#">Shopping</a></li>
														<li><a href = "#">Jobs</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Computer & Internet</a>
													<ul class = "sub-category">
														<li><a href = "#">Hardware</a></li>
														<li><a href = "#">Software</a></li>
														<li><a href = "#">Web</a></li>
														<li><a href = "#">Games</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Education</a>
													<ul class = "sub-category">
														<li><a href = "#">Colleges</a></li>
														<li><a href = "#">K-12</a></li>
														<li><a href = "#">Distance Learning</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Entertainment</a>
													<ul class = "sub-category">
														<li><a href = "#">Movies</a></li>
														<li><a href = "#">TV Shows</a></li>
														<li><a href = "#">Music</a></li>
														<li><a href = "#">Humor</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Government</a>
													<ul class = "sub-category">
														<li><a href = "#">Elections</a></li>
														<li><a href = "#">Military</a></li>
														<li><a href = "#">Law</a></li>
														<li><a href = "#">Taxes</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "">Health</a>
													<ul class = "sub-category">
														<li><a href = "#">Disease</a></li>
														<li><a href = "#">Drugs</a></li>
														<li><a href = "#">Fitness</a></li>
														<li><a href = "#">Nutrition</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">News & Media</a>
													<ul class = "sub-category">
														<li><a href = "#">Newspapers</a></li>
														<li><a href = "#">Radio</a></li>
														<li><a href = "#">Weather</a></li>
														<li><a href = "#">Blogs</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Recreation & Sports</a>
													<ul class = "sub-category">
														<li><a href = "#">Sports</a></li>
														<li><a href = "#">Travel</a></li>
														<li><a href = "#">Autos</a></li>
														<li><a href = "#">Outdoors</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Reference</a>
													<ul class = "sub-category">
														<li><a href = "#">Phone Numbers</a></li>
														<li><a href = "#">Dictionaries</a></li>
														<li><a href = "#">Quotes</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Science</a>
													<ul class = "sub-category">
														<li><a href = "#">Animals</a></li>
														<li><a href = "#">Astronomy</a></li>
														<li><a href = "#">Earth Science</a></li>
													</ul>{{-- /.sub-category --}}
												</li>
												<li><a href = "#">Social Science</a>
													<ul class = "sub-category">
														<li><a href = "#">Languages</a></li>
														<li><a href = "#">Archaeology</a></li>
														<li><a href = "#">Psychology</a></li>
													</ul>
													{{-- /.sub-category --}}
												</li>
											</ul>
											{{-- /.categories --}}
										</section>
										{{-- end Categories --}}
									</div>
									{{-- /.col-md-9 --}}
									<div class = "col-md-3">
										<aside id = "sidebar">
											<section>
												<header><h2>New Places</h2></header>
												<a href = "item-detail.html" class = "item-horizontal small">
													<h3>Cash Cow Restaurante</h3>
													<figure>63 Birch Street</figure>
													<div class = "wrapper">
														<div class = "image"><img src = "{{asset('assets/tmpl/img/items/1.jpg')}}" alt = "">
														</div>
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
														<div class = "image"><img src = "{{asset('assets/tmpl/img/items/2.jpg')}}" alt = "">
														</div>
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
												<a href = "item-detail.html" class = "item-horizontal small">
													<h3>Eddie’s Fast Food</h3>
													<figure>4365 Bruce Street</figure>
													<div class = "wrapper">
														<div class = "image"><img src = "{{asset('assets/tmpl/img/items/3.jpg')}}" alt = "">
														</div>
														<div class = "info">
															<div class = "type">
																<i><img src = "{{asset('assets/tmpl/icons/restaurants-bars/restaurants/restaurant.png')}}" alt = ""></i>
																<span>Restaurant</span>
															</div>
															<div class = "rating" data-rating = "5"></div>
														</div>
													</div>
												</a>
												{{-- /.item-horizontal small --}}
											</section>
											<section>
												<header><h2>Categories</h2></header>
												<ul class = "bullets">
													<li><a href = "#">Restaurant</a></li>
													<li><a href = "#">Steak House & Grill</a></li>
													<li><a href = "#">Fast Food</a></li>
													<li><a href = "#">Breakfast</a></li>
													<li><a href = "#">Winery</a></li>
													<li><a href = "#">Bar & Lounge</a></li>
													<li><a href = "#">Pub</a></li>
												</ul>
											</section>
											<section>
												<header><h2>Events</h2></header>
												<div class = "form-group">
													<select class = "framed" name = "events">
														<option value = "">Select Your City</option>
														<option value = "1">London</option>
														<option value = "2">New York</option>
														<option value = "3">Barcelona</option>
														<option value = "4">Moscow</option>
														<option value = "5">Tokyo</option>
													</select>
												</div>
												{{-- /.form-group  --}}
											</section>
										</aside>
										{{-- /#sidebar --}}
									</div>
									{{-- /.col-md-3 --}}
								</div>
								{{-- /.row --}}
							</div>
						</section>

						{{-- Banner --}}
						<section>
							<div class = "container">
								<div class = "block">
									<a href = "#"><img src = "{{asset('assets/tmpl/img/ad-banner.png')}}" alt = ""></a>
								</div>
							</div>
						</section>
						{{-- end Banner --}}
						{{-- Subscribe --}}
						<section id = "subscribe" class = "block">
							<div class = "container">
								<header><h2>Subscribe</h2></header>
								<form class = "subscribe form-inline border-less-inputs" action = "?" method = "post" role = "form">
									<div class = "input-group">
										<input type = "email" class = "form-control" id = "subscribe_email" placeholder = "Enter your email and get the newest updates">
						                                <span class = "input-group-btn">
						                                    <button type = "submit" class = "btn btn-default btn-large">Subscribe<i class = "fa fa-angle-right"></i></button>
						                                </span>
									</div>
								</form>
								{{-- /.subscribe --}}
							</div>
							{{-- /.container --}}
						</section>
						{{-- end Subscribe --}}
						{{-- Partners --}}
						<section id = "partners" class = "block">
							<div class = "container">
								<header><h2>Partners</h2></header>
								<div class = "logos">
									<div class = "logo"><a href = "#"><img src = "{{asset('assets/tmpl/img/logo-partner-01.png')}}" alt = ""></a></div>
									<div class = "logo"><a href = "#"><img src = "{{asset('assets/tmpl/img/logo-partner-02.png')}}" alt = ""></a></div>
									<div class = "logo"><a href = "#"><img src = "{{asset('assets/tmpl/img/logo-partner-03.png')}}" alt = ""></a></div>
									<div class = "logo"><a href = "#"><img src = "{{asset('assets/tmpl/img/logo-partner-04.png')}}" alt = ""></a></div>
									<div class = "logo"><a href = "#"><img src = "{{asset('assets/tmpl/img/logo-partner-05.png')}}" alt = ""></a></div>
								</div>
							</div>
							{{-- /.container --}}
						</section>
						{{-- end Partners --}}
					</div>
					{{-- end Page Content --}}
				</div>
				{{-- end Page Canvas --}}
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
									{{-- /.col-md-4 --}}
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
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/jquery.nouislider.all.min.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
		<script type = "text/javascript" src = "http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/infobox.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/richmarker-compiled.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/markerclusterer.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/custom.js')}}"></script>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/maps.js')}}"></script>

		<!--[if lte IE 9]>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/ie-scripts.js')}}"></script>
		<![endif]-->

		<script>
			var _latitude = 20.3417485;
			var _longitude = -102.76523259;
			//var jsonPath = '{{asset('assets/tmpl/json/items.json')}}';
			var jsonPath = '{{route('get-clientes')}}';

			{{-- Load JSON data and create Google Maps  --}}

			$.getJSON(jsonPath)
				.done(function (json) {
					createHomepageGoogleMap(_latitude, _longitude, json);
				})
				.fail(function (jqxhr, textStatus, error) {
					console.log(error);
				})
			;

			{{-- Set if language is RTL and load Owl Carousel  --}}

			$(window).load(function () {
				var rtl = false;
				initializeOwl(rtl);
			});


			autoComplete();

		</script>

		<!--[if lte IE 9]>
		<script type = "text/javascript" src = "{{asset('assets/tmpl/js/ie-scripts.js')}}"></script>
		<![endif]-->
	</body>
</html>