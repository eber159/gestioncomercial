<!DOCTYPE html>
<html lang="en">
<head>
<title>VRD PERÚ | @yield('title-page')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="myHOME - real estate template project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/bootstrap-4.1.2/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/plugins/OwlCarousel2-2.3.4/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/plugins/OwlCarousel2-2.3.4/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/plugins/OwlCarousel2-2.3.4/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/responsive.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets_int/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets_int/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">

	<style type="text/css">

		.header_bar {
		    width: 100%;
		    height: 55px;
		    background: #040c50;
		    padding-left: 64px;
		    padding-right: 62px;
		}

		.social ul li {
		    width: 32px;
		    height: 32px;
		    border-radius: 50%;
		    background: #040c50;
		    text-align: center;
		    -webkit-transition: all 200ms ease;
		    -moz-transition: all 200ms ease;
		    -ms-transition: all 200ms ease;
		    -o-transition: all 200ms ease;
		    transition: all 200ms ease;
		}

		.sidebar {
		    position: fixed;
		    height: 100%;
		    width: 0;
		    top: 0;
		    left: 0;
		    z-index: 1;
		    background-color: #040c50;
		    overflow-x: hidden;
		    transition: 0.4s;
		    padding: 1rem 0;
		    box-sizing:border-box;
		}

		.sidebar .boton-cerrar {
		    position: absolute;
		    top: 0.5rem;
		    right: 1rem;
		    font-size: 2rem;
		    display: block;
		    padding: 0;
		    line-height: 1.5rem;
		    margin: 0;
		    height: 32px;
		    width: 32px;
		    text-align: center;
		    vertical-align: top;
		}

		.sidebar ul, .sidebar li{
		    margin:0;
		    padding:10;
		    list-style:none inside;
		}

		.sidebar ul {
		    margin: 4rem auto;
		    display: block;
		    width: 80%;
		    min-width:200px;
		}

		.sidebar a {
		    display: block;
		    font-size: 130%;
		    color: #333;
		    text-decoration: none;
		    padding: 7px;
		}

		.sidebar a:hover{
		    color:#fff;
		    background-color: #081442;

		}

		h1 {
		    color:#081442;
		    font-size:180%;
		    font-weight:normal;
		}
		#contenido {
		    transition: margin-left .4s;
		    padding: 1rem;
		}

		.abrir-cerrar {
		    color: #2E88C7;
		    font-size:1rem;   
		}

		#abrir {
		    
		}
		#cerrar {
		    display:none;
		}

		.contact {
		    background: #ffffff;
		    padding-top: 105px;
		    padding-bottom: 85px;
		}

		.contact_row {
		    margin-top: 37px;
		}

		.footer_content {
			    padding-top: 88px;
			    padding-bottom: 83px;
			    background-color: #040c50;
			    background: #040c50
			}

		.fa {
		    display: inline-block;
		    font: normal normal normal 14px/1 FontAwesome;
		    font-size: inherit;
		    text-rendering: auto;
		    -webkit-font-smoothing: antialiased;
		    color: whitesmoke;
		}

		.submit {
		    background: #afafaf;
		}

		.home_price_tag {
		    background: #afafaf;
		}

		.home_slider_nav {
		    background: #afafaf;
		}

		.home_content {
		    width: 423px;
		    background: #040c50;
		    padding-left: 47px;
		    padding-top: 41px;
		    padding-bottom: 48px;
		    padding-right: 50px;
		}

	</style>

</head>

<body>

<div class="super_container">
	<div class="super_overlay"></div>
	
	<!-- Header -->

	<header class="header">
		

		<div id="sidebar" class="sidebar">
			<a href="#" class="boton-cerrar" onclick="ocultar()">&times;</a>
			<ul class="menu2">
				<li><a href="busquedajoyas"><i class="fa fa-search"></i> Búsqueda Rápida </a></li>
				<li><a href="busquedadiamantes"><i class="fa fa-diamond"></i> Buscar Diamantes </a></li>
				<li><a href="busquedanuevasjoyas"><i class="fa fa-plus"></i> Nuevas Joyas</a></li>
				<li><a href="mispedidos"><i class="fa fa-list-alt"></i> Pedidos</a></li>
			</ul>
		</div>

		<!-- Header Bar -->
		<div class="header_bar d-flex flex-row align-items-center justify-content-start">
			<div class="header_list">
				<ul class="d-flex flex-row align-items-center justify-content-start">
					<!-- Phone -->
					<li class="d-flex flex-row align-items-center justify-content-start">
						<div><a href="#" onclick="mostrar()"><i class="fa fa-bars"></i></a></div>
					</li>
					<li class="d-flex flex-row align-items-center justify-content-start">
						<!--<div><img src="{{ asset('adminstyleextranet/images/phone-call.svg') }}" alt=""></div>-->
						<i class="fa fa-phone"></i>
						<span>+51 987 525 752 - (01) 225 8106</span>
					</li>
					<!-- Address -->
					<li class="d-flex flex-row align-items-center justify-content-start">
						<!--<div><img src="{{ asset('adminstyleextranet/images/placeholder.svg') }}" alt=""></div>-->
						<i class="fa fa-map-marker"></i>
						<span>Av. Del Parque Sur 381 - San Isidro, Lima</span>
					</li>
					<!-- Email -->
					<li class="d-flex flex-row align-items-center justify-content-start">
						<!--<div><img src="{{ asset('adminstyleextranet/images/envelope.svg') }}" alt=""></div>-->
						<i class="fa fa-envelope"></i>
						<span>info@vrdperu.com</span>
					</li>
				</ul>
			</div>
			<div class="ml-auto d-flex flex-row align-items-center justify-content-start">
				<div class="social">
					<ul class="d-flex flex-row align-items-center justify-content-start">
						<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="log_reg d-flex flex-row align-items-center justify-content-start">
					<ul class="d-flex flex-row align-items-start justify-content-start">
						<!--
						@if(Session::get('idusuario')!= '')
							<li><a href="">{{ Session::get('nombreusuario') }}</a></li>
						@else
							<li><a href="login">Login</a></li>
							<li><a href="registro">Registro</a></li>
						@endif
						-->
						<li><a href="login">Login</a></li>
						<li><a href="registro">Registro</a></li>
					</ul>
				</div>
			</div>
		</div>

		<!-- Header Content -->
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			<div class="logo">
				<a href="{{ URL::to('inicio') }}"><img src="{{ asset('img/logo2.png') }}" alt="" width="50px"></a>  VRD PERÚ 
			</div>
			<div class="logo">
				<img src="{{  asset('img/GIA_Logo.png') }}"  style="height: 45px" />
			</div>
			<nav class="main_nav">
				<ul class="d-flex flex-row align-items-start justify-content-start">
					<li><a href="{{ URL::to('/') }}">Inicio</a></li>
					<li><a href="">Nosotros</a></li>
					<li><a href="">Joyas</a></li>
				</ul>
			</nav>
			<div class="submit ml-auto"><a href="#"> Contacto </a></div>
			<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
		</div>

	</header>

	<!-- Menu -->

	<div class="menu text-right">
		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="menu_log_reg">
			<div class="log_reg d-flex flex-row align-items-center justify-content-end">
				<ul class="d-flex flex-row align-items-start justify-content-start">
					<li><a href="login">Login</a></li>
					<li><a href="registro">Registro</a></li>
				</ul>
			</div>
			<nav class="menu_nav">
				<ul>
					<li><a href="">Inicio</a></li>
					<li><a href="">Nosotros</a></li>
					<li><a href="">Joyas</a></li>
					<li><a href="">Contacto</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<!-- Home -->
	@yield('slider')
	@yield('content')


	<!--
	<div class="home">
		<div class="home_slider_container">
			 <div class="owl-carousel owl-theme home_slider">
			 	<div class="slide">
			 		<div class="background_image" style="background-image:url({{ asset('adminstyleextranet/images/index.jpg') }})"></div>
			 		<div class="home_container">
			 			<div class="container">
			 				<div class="row">
			 					<div class="col">
			 						<div class="home_content">
			 							<div class="home_title"><h1>1243 Main Avenue Left Town</h1></div>
			 							<div class="home_price_tag">$ 482 900</div>
			 						</div>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			 	<div class="slide">
			 		<div class="background_image" style="background-image:url({{ asset('adminstyleextranet/images/index.jpg') }})"></div>
			 		<div class="home_container">
			 			<div class="container">
			 				<div class="row">
			 					<div class="col">
			 						<div class="home_content">
			 							<div class="home_title"><h1>1243 Main Avenue Left Town</h1></div>
			 							<div class="home_price_tag">$ 482 900</div>
			 						</div>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			 	<div class="slide">
			 		<div class="background_image" style="background-image:url({{ asset('adminstyleextranet/images/index.jpg') }})"></div>
			 		<div class="home_container">
			 			<div class="container">
			 				<div class="row">
			 					<div class="col">
			 						<div class="home_content">
			 							<div class="home_title"><h1>1243 Main Avenue Left Town</h1></div>
			 							<div class="home_price_tag">$ 482 900</div>
			 						</div>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>

			 </div>
			 <div class="home_slider_nav"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			 
		</div>
	</div>
	-->

	<!-- Search -->
	<!--
	<div class="search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="search_container">
						<div class="search_title">Find your home</div>
						<div class="search_form_container">
							<form action="#" class="search_form" id="search_form">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
									<div class="search_inputs d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
										<input type="text" class="search_input" placeholder="Property type" required="required">
										<input type="text" class="search_input" placeholder="No rooms" required="required">
										<input type="text" class="search_input" placeholder="Location" required="required">
									</div>
									<button class="search_button">submit listing</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	-->
	<!-- Featured -->
	<!--
	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">the best deals</div>
						<div class="section_title"><h1>Featured Properties</h1></div>
					</div>
				</div>
			</div>
			<div class="row featured_row">
				
				<div class="col-lg-4">
					<div class="listing">
						<div class="listing_image">
							<div class="listing_image_container">
								<img src="images/listing_1.jpg" alt="">
							</div>
							<div class="tags d-flex flex-row align-items-start justify-content-start flex-wrap">
								<div class="tag tag_house"><a href="listings.html">house</a></div>
								<div class="tag tag_sale"><a href="listings.html">for sale</a></div>
							</div>
							<div class="tag_price listing_price">$ 217 346</div>
						</div>
						<div class="listing_content">
							<div class="prop_location listing_location d-flex flex-row align-items-start justify-content-start">
								<img src="images/icon_1.png" alt="">
								<a href="single.html">280 Doe Meadow Drive Landover, MD 20785</a>
							</div>
							<div class="listing_info">
								<ul class="d-flex flex-row align-items-center justify-content-start flex-wrap">
									<li class="property_area d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_2.png" alt="">
										<span>2500 sq ft</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_3.png" alt="">
										<span>2</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_4.png" alt="">
										<span>5</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_5.png" alt="">
										<span>2</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="listing">
						<div class="listing_image">
							<div class="listing_image_container">
								<img src="images/listing_2.jpg" alt="">
							</div>
							<div class="tags d-flex flex-row align-items-start justify-content-start flex-wrap">
								<div class="tag tag_house"><a href="listings.html">house</a></div>
								<div class="tag tag_rent"><a href="listings.html">for rent</a></div>
							</div>
							<div class="tag_price listing_price">$ 515 957</div>
						</div>
						<div class="listing_content">
							<div class="prop_location listing_location d-flex flex-row align-items-start justify-content-start">
								<img src="images/icon_1.png" alt="">
								<a href="single.html">4812 Haul Road Saint Paul, MN 55102</a>
							</div>
							<div class="listing_info">
								<ul class="d-flex flex-row align-items-center justify-content-start flex-wrap">
									<li class="property_area d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_2.png" alt="">
										<span>1234 sq ft</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_3.png" alt="">
										<span>2</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_4.png" alt="">
										<span>5</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_5.png" alt="">
										<span>2</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="listing">
						<div class="listing_image">
							<div class="listing_image_container">
								<img src="images/listing_3.jpg" alt="">
							</div>
							<div class="tags d-flex flex-row align-items-start justify-content-start flex-wrap">
								<div class="tag tag_house"><a href="listings.html">house</a></div>
								<div class="tag tag_sale"><a href="listings.html">for sale</a></div>
							</div>
							<div class="tag_price listing_price">$ 375 255</div>
						</div>
						<div class="listing_content">
							<div class="prop_location listing_location d-flex flex-row align-items-start justify-content-start">
								<img src="images/icon_1.png" alt="">
								<a href="single.html">4067 Wolf Pen Road Mountain View, CA 94041</a>
							</div>
							<div class="listing_info">
								<ul class="d-flex flex-row align-items-center justify-content-start flex-wrap">
									<li class="property_area d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_2.png" alt="">
										<span>2000 sq ft</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_3.png" alt="">
										<span>2</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_4.png" alt="">
										<span>5</span>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<img src="images/icon_5.png" alt="">
										<span>2</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	-->

	<!-- Map Section -->
	<!--
	<div class="map_section container_reset">
		<div class="container">
			<div class="row row-xl-eq-height">

				<div class="col-xl-7 order-xl-1 order-2">
					<div class="map">
						<div id="google_map" class="google_map">
							<div class="map_container">
								<div id="map"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-5 order-xl-2 order-1">
					<div class="map_section_content">
						<div class="map_overlay">
							<svg fill="#55407d" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
								<path d="M100,0 a-200,150 0 0 0 -100,100 h100 v-100 z" />
							</svg>
						</div>
						<div class="section_title_container">
							<div class="section_subtitle">the best deals</div>
							<div class="section_title"><h1>Choose a location</h1></div>
						</div>
						<div class="locations_list d-flex flex-column align-items-start justify-content-start">
							<label class="location_contaner" data-lat="25.794923" data-lng="-80.133661"> 
								<input type="radio" name="location_radio">
								<span></span>
								Downtown Miami
							</label>
							<label class="location_contaner" data-lat="41.872883" data-lng="-87.660943">
								<input type="radio" name="location_radio">
								<span></span>
								Chicago
							</label>
							<label class="location_contaner" data-lat="40.779528" data-lng="-73.960561">
								<input type="radio" name="location_radio" checked>
								<span></span>
								Manhattan - New York
							</label>
							<label class="location_contaner" data-lat="34.082539" data-lng="-118.380126">
								<input type="radio" name="location_radio">
								<span></span>
								West Hollywood
							</label>
							<label class="location_contaner" data-lat="38.910263" data-lng="-77.020496">
								<input type="radio" name="location_radio">
								<span></span>
								Washington
							</label>
							<label class="location_contaner" data-lat="39.296713" data-lng="-76.634918">
								<input type="radio" name="location_radio">
								<span></span>
								Maryland
							</label>
							<label class="location_contaner" data-lat="37.806964" data-lng="-122.411291">
								<input type="radio" name="location_radio">
								<span></span>
								San Francisco
							</label>
							<label class="location_contaner" data-lat="33.627738" data-lng="-117.909449">
								<input type="radio" name="location_radio">
								<span></span>
								Orange County
							</label>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	-->



	<!-- hot -->
	<!--
	<div class="hot">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">the best deals</div>
						<div class="section_title"><h1>Today's Hot Deal</h1></div>
					</div>
				</div>
			</div>
			<div class="row hot_row row-eq-height">
				
				<div class="col-lg-6">
					<div class="hot_image">
						<div class="background_image" style="background-image:url(images/hot.jpg)"></div>
						<div class="tags d-flex flex-row align-items-start justify-content-start flex-wrap">
							<div class="tag tag_house"><a href="listings.html">house</a></div>
							<div class="tag tag_sale"><a href="listings.html">for sale</a></div>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="hot_content">
						<div class="hot_deal">
							<div class="tag_price">$ 562 346</div>
							<div class="hot_title"><a href="#">Villa for sale</a></div>
							<div class="prop_location d-flex flex-row align-items-start justify-content-start">
								<img src="images/icon_1.png" alt="">
								<span>280 Doe Meadow Drive Landover, MD 20785</span>
							</div>
							<div class="prop_text">
								<p>Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in.</p>
							</div>
							<div class="prop_agent d-flex flex-row align-items-center justify-content-start">
								<div class="prop_agent_image"><img src="images/agent_1.jpg" alt=""></div>
								<div class="prop_agent_name"><a href="#">Maria Smith,</a> Agent</div>
							</div>
						</div>
						<div class="prop_info">
							<ul class="d-flex flex-row align-items-center justify-content-start flex-wrap">
								<li class="d-flex flex-row align-items-center justify-content-start">
									<img src="images/icon_2_large.png" alt="">
									<div>
										<div>1234</div>
										<div>sq ft</div>
									</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<img src="images/icon_3_large.png" alt="">
									<div>
										<div>2</div>
										<div>baths</div>
									</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<img src="images/icon_4_large.png" alt="">
									<div>
										<div>5</div>
										<div>beds</div>
									</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<img src="images/icon_5_large.png" alt="">
									<div>
										<div>2</div>
										<div>garages</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	-->


	<!-- Testimonials -->
	<!--
	<div class="testimonials container_reset">
		<div class="container">
			<div class="row row-eq-height">
				
				<div class="col-xl-6">
					<div class="testimonials_image">
						<div class="background_image" style="background-image:url(images/testimonials.jpg)"></div>
						<div class="testimonials_image_overlay"></div>
					</div>
				</div>

				<div class="col-xl-6">
					<div class="testimonials_content">
						<div class="section_title_container">
							<div class="section_subtitle">the best deals</div>
							<div class="section_title"><h1>Clients testimonials</h1></div>
						</div>

						<div class="testimonials_slider_container">
							<div class="owl-carousel owl-theme test_slider">
								
								<div class="test_slide">
									<div class="test_quote">"They helped us find our home"</div>
									<div class="test_text">
										<p>Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in. Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in.</p>
									</div>
									<div class="test_author"><a href="#">Cristinne Smith</a>, Client</div>
								</div>

								<div class="test_slide">
									<div class="test_quote">"They helped us find our home"</div>
									<div class="test_text">
										<p>Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in. Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in.</p>
									</div>
									<div class="test_author"><a href="#">Cristinne Smith</a>, Client</div>
								</div>

								<div class="test_slide">
									<div class="test_quote">"They helped us find our home"</div>
									<div class="test_text">
										<p>Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in. Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in.</p>
									</div>
									<div class="test_author"><a href="#">Cristinne Smith</a>, Client</div>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	-->
	
	<footer class="footer">
		<div class="footer_content">
			<div class="container">
				<div class="row">
					
					<!-- Footer Column -->
					<div class="col-xl-3 col-lg-6 footer_col">
						<div class="footer_about">
							<div class="footer_logo"><a href="#"><span>VRD PERÚ</span><br/>Diamond wholesaler</a></div>
							<div class="footer_text">
								<p>Dealer internacional de Diamantes . Diamantes certificados GIA . Calidad excepcional en nuestros diamantes. Dedicados a la venta por mayor de diamantes certificados a partir de 0.18 ct.</p>
							</div>
							<div class="social">
								<ul class="d-flex flex-row align-items-center justify-content-start">
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-xl-3 col-lg-6 footer_col">
						<div class="footer_column">
							<div class="footer_title">Información</div>
							<div class="footer_info">
								<ul>
									<!-- Phone -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<i class="fa fa-phone"></i>
										<span>+51 987 525 752 - (01) 225 8106</span>
									</li>
									<!-- Address -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<i class="fa fa-map-marker"></i>
										<span>Av. Del Parque Sur 381 - San Isidro, Lima</span>
									</li>
									<!-- Email -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<i class="fa fa-envelope"></i>
										<span>info@vrdperu.com</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-lg-6 footer_col">
						<div class="footer_column">
							<div class="footer_title">Links</div>
							<div class="footer_info">
								<ul>
									<!-- Phone -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<a href="#">Inicio</a>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<a href="#">Nosotros</a>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<a href="#">Contacto</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="footer_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_bar_content d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-start">
							<div class="copyright order-md-1 order-2"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados - Imelda de Valery EIRL
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>


<script src="{{ asset('adminstyleextranet/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/styles/bootstrap-4.1.2/popper.js') }}"></script>
<script src="{{ asset('adminstyleextranet/styles/bootstrap-4.1.2/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/OwlCarousel2-2.3.4/owl.carousel.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/progressbar/progressbar.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('adminstyleextranet/js/custom.js') }}"></script>
<script src="{{ asset('assets_int/plugins/bootbox.min.js')}}"></script>
<script src="{{ asset('assets_int/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('assets_int/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript">
	function mostrar() {
	    document.getElementById("sidebar").style.width = "300px";
	    document.getElementById("contenido").style.marginLeft = "300px";
	    document.getElementById("abrir").style.display = "none";
	    document.getElementById("cerrar").style.display = "inline";
	}

	function ocultar() {
	    document.getElementById("sidebar").style.width = "0";
	    document.getElementById("contenido").style.marginLeft = "0";
	    document.getElementById("abrir").style.display = "inline";
	    document.getElementById("cerrar").style.display = "none";
	}
</script>

@yield('scripts')

</body>
</html>