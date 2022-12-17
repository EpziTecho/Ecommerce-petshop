<?php
$cantCarrito = 0;
if (isset($_SESSION['arrCarrito']) and count($_SESSION['arrCarrito']) > 0) {
	foreach ($_SESSION['arrCarrito'] as $product) {
		$cantCarrito += $product['cantidad'];
	}
}

$arrProductos = $data['productos'];


$tituloPreguntas = !empty(getInfoPage(PPREGUNTAS)) ? getInfoPage(PPREGUNTAS)['titulo'] : "";
$infoPreguntas = !empty(getInfoPage(PPREGUNTAS)) ? getInfoPage(PPREGUNTAS)['contenido'] : "";
?>




<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $data['page_tag'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= media() ?>/tienda/images/img/logo.svg" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
	<!--===============================================================================================-->
</head>

<body class="animsition">
	<!-- Modal preguntas frecuentes -->
	<div class="modal fade" id="modalAyuda" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?= $tituloPreguntas ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="page-content">
						<?= $infoPreguntas; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<div id="divLoading">
		<div>
			<img src="<?= media(); ?>/images/loading.svg" alt="Loading">
		</div>
	</div>
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar flex-w" >
						<!-- <b>¡Aprovecha!</b> Envíos gratis por compras mayores a S/200 -->
						<?php if (isset($_SESSION['login'])) { ?>
						    <?= "<p style='margin-right: 5px;' data-section='header_tienda' data-value='navbar-negro-bienvenido'>". "Bienvenido: " ."</p>".$_SESSION['userData']['nombres'] . '' . $_SESSION['userData']['apellidos'] ?>
						<?php } ?>
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25" data-toggle="modal" data-target="#modalAyuda">
							Help & FAQs
						</a>
						<?php if (isset($_SESSION['login'])) { ?>
							<a href="<?= base_url() ?>/dashboard" class="flex-c-m trans-04 p-lr-25" data-section='header_tienda' data-value='navbar-negro-mi-cuenta'>
								Mi cuenta
							</a>
						<?php }

						if (isset($_SESSION['login'])) { ?>

							<a href="<?= base_url(); ?>/logout" class="flex-c-m trans-04 p-lr-25" data-section='header_tienda' data-value='navbar-negro-salir'>
								Salir
							</a>
						<?php } else { ?>


							<a href="<?= base_url(); ?>/login" class="flex-c-m trans-04 p-lr-25">
								Iniciar Sesion
							</a>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop" style="top: 40px;">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="<?= base_url(); ?>" class="logo">
						<img src="<?= media() ?>/tienda/images/img/logo-svg1.svg" alt="Oh my pet-Petshop">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="">
								<!-- active-menu-->
								<a href="<?= base_url() ?>" data-section="header_tienda" data-value="navbar-inicio">Inicio</a>
								<!--<ul class="sub-menu">
									<li><a href="index.html">Homepage 1</a></li>
									<li><a href="home-02.html">Homepage 2</a></li>
									<li><a href="home-03.html">Homepage 3</a></li>
								</ul>-->
							</li>

							<li class="">
								<a href="<?= base_url() ?>/tienda" data-section="header_tienda" data-value="navbar-tienda">Tienda</a>
								<!-- <ul class="sub-menu">
									<li><a href="#">Comida para perros</a></li>
									<li><a href="#">Juguetes para perros</a></li>
									<li><a href="#">Ropa para perros</a></li>
									<li><a href="#">Correas para perros</a></li>
								</ul> -->
							</li>

							<!-- <li class="">
								<a href="index.html">Gatos</a>
								<ul class="sub-menu">
									<li><a href="#">Comida para gatos</a></li>
									<li><a href="#">Juguetes para gatos</a></li>
									<li><a href="#">Ropa para gatos</a></li>
									<li><a href="#">Arena para gatos</a></li>
								</ul>
							</li>

							<li class="">
								<a href="index.html">Otras mascotas</a>
								<ul class="sub-menu">
									<li><a href="#">Comida para hamsters</a></li>
									<li><a href="#">Accesorios para hamsters</a></li>
									<li><a href="#">Comida para conejos</a></li>
									<li><a href="#">Accesorios para conejos</a></li>
									<li><a href="#">Comida para aves</a></li>
									<li><a href="#">Accesorios para aves</a></li>
								</ul>
							</li> -->

							<!-- <li class="label1" data-label1="<?= $cantCarrito; ?> ">
							<a href="<?= base_url() ?>/carrito"data-section="header_tienda" data-value="navbar-carrito">Carrito</a>
							</li> -->

							<li class="label1" data-label1="Sale">
								<a href="<?= base_url() ?>/promocion" data-section="header_tienda" data-value="navbar-ofertas">Ofertas</a>
							</li>
							<li>
								<a href="<?= base_url() ?>/nosotros" data-section="header_tienda" data-value="navbar-nosotros">Nosotros</a>
							</li>
							<li>
								<a href="<?= base_url() ?>/contacto" data-section="header_tienda" data-value="navbar-contacto">Contacto</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<?php if ($data['page_name'] != "carrito" and $data['page_name'] != "procesarpago") { ?>
							<div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= $cantCarrito; ?> ">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						<?php } ?>
						<div id="flags" class="flex-w flex-r-m">
							<div class="cl2 trans-04 p-l-20 p-r-5 flags__item" data-language="es">
								<img src="<?= media() ?>/images/es.svg" alt="españa">
								<span class="text-language">ES</span>
							</div>
							<div class="cl2  trans-04 p-l-20 p-r-5 flags__item" data-language="en">
								<img src="<?= media() ?>/images/us.svg" alt="usa">
								<span class="text-language">EN</span>
							</div>
							<span class="nav-icon"></span>							
							<div class="tooltip tooltip-language">
								<div id="flags" class="flex-w flex-r-m">
									<div class="cl2 trans-04 flags__item item-tooltip" data-language="es">
										<input type="radio" checked="true">ES</input>
										<img src="<?= media() ?>/images/es.svg" alt="españa">
									</div>
									<div class="cl2  trans-04 flags__item item-tooltip" data-language="en">
										<input type="radio" checked="true">EN</input>
										<img src="<?= media() ?>/images/us.svg" alt="usa">
									</div>							
								</div>
							</div>
						</div>

						<!-- icono de corzon/favoritos -->
						<!-- <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a> -->

					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="<?= base_url() ?>"><img src="<?= media() ?>/tienda/images/img/logo-svg1.svg" alt="Oh my pet-Petshop"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<?php if ($data['page_name'] != "carrito" and $data['page_name'] != "procesarpago") { ?>
					<div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= $cantCarrito; ?>">
						<i class="zmdi zmdi-shopping-cart"></i>
					</div>
				<?php } ?>

				<div id="flags" class="flex-w flex-r-m">
					<div class="cl2 trans-04 p-l-20 p-r-5 flags__item" data-language="es">
						<img src="<?= media() ?>/images/es.svg" alt="españa">
						<span class="text-language">ES</span>
					</div>
					<div class="cl2  trans-04 p-l-20 p-r-5 flags__item" data-language="en">
						<img src="<?= media() ?>/images/us.svg" alt="usa">
						<span class="text-language">EN</span>
					</div>
					<span class="nav-icon"></span>							
					<div class="tooltip tooltip-language">
						<div id="flags" class="flex-w flex-r-m">
							<div class="cl2 trans-04 flags__item item-tooltip" data-language="es">
								<input type="radio" checked="true">ES</input>
								<img src="<?= media() ?>/images/es.svg" alt="españa">
							</div>
							<div class="cl2  trans-04 flags__item item-tooltip" data-language="en">
								<input type="radio" checked="true">EN</input>
								<img src="<?= media() ?>/images/us.svg" alt="usa">
							</div>							
						</div>
					</div>
				</div>
				<!-- icono de favoritos
				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a> -->
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						<!-- <b>¡Aprovecha!</b> Envíos gratis por compras mayores a S/200 -->
						Bienvenido usuario :
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							¿Cómo comprar? Y Preguntas Frecuentes
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Mi cuenta
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Salir
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li class="">
					<!-- active-menu-->
					<a href="<?= base_url() ?>">Inicio</a>
					<!--<ul class="sub-menu">
									<li><a href="index.html">Homepage 1</a></li>
									<li><a href="home-02.html">Homepage 2</a></li>
									<li><a href="home-03.html">Homepage 3</a></li>
								</ul>-->
				</li>

				<li class="">
					<a href="<?= base_url() ?>/tienda">Tienda</a>
					<!-- <ul class="sub-menu">
									<li><a href="#">Comida para perros</a></li>
									<li><a href="#">Juguetes para perros</a></li>
									<li><a href="#">Ropa para perros</a></li>
									<li><a href="#">Correas para perros</a></li>
								</ul> -->
				</li>

				<!-- <li class="">
								<a href="index.html">Gatos</a>
								<ul class="sub-menu">
									<li><a href="#">Comida para gatos</a></li>
									<li><a href="#">Juguetes para gatos</a></li>
									<li><a href="#">Ropa para gatos</a></li>
									<li><a href="#">Arena para gatos</a></li>
								</ul>
							</li>

							<li class="">
								<a href="index.html">Otras mascotas</a>
								<ul class="sub-menu">
									<li><a href="#">Comida para hamsters</a></li>
									<li><a href="#">Accesorios para hamsters</a></li>
									<li><a href="#">Comida para conejos</a></li>
									<li><a href="#">Accesorios para conejos</a></li>
									<li><a href="#">Comida para aves</a></li>
									<li><a href="#">Accesorios para aves</a></li>
								</ul>
							</li> -->

				<li class="label1" data-label1="Sale">
					<a href="shoping-cart.html">Ofertas</a>
				</li>
				<li>
					<a href="<?= base_url() ?>/nosotros">Nosotros</a>
				</li>
				<li>
					<a href="<?= base_url() ?>/contacto">Contacto</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?= media() ?>/tienda/images/icons/icon-close2.png" alt="CLOSE">
				</button>
				<form class="wrap-search-header flex-w p-l-15">
					<button disabled class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" id="searchP-Navbar" placeholder="Buscar...">
				</form>
				<div class="div-productos-navbar">
					<div id="productosNavbar" class="row">
						<?php
						for ($p = 0; $p < count($arrProductos); $p++) {
							$ruta = $arrProductos[$p]['ruta'];
							if (count($arrProductos[$p]['images']) > 0) {
								$portada = $arrProductos[$p]['images'][0]['url_image'];
							} else {
								$portada = media() . '/images/uploads/product.png';
							}
						?>
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 categoria<?= $arrProductos[$p]['categoriaid'] ?> producto">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-pic hov-img0">
										<img src="<?= $portada ?>" alt="<?= $arrProductos[$p]['nombre'] ?>">
										<a href="<?= base_url() . '/tienda/producto/' . $arrProductos[$p]['idproducto'] . '/' . $ruta; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
											Ver producto
										</a>
									</div>

									<div class="block2-txt flex-w flex-t p-t-14">
										<div class="block2-txt-child1 flex-col-l ">
											<a href="<?= base_url() . '/tienda/producto/' . $arrProductos[$p]['idproducto'] . '/' . $ruta; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												<?= $arrProductos[$p]['nombre'] ?>
											</a>

											<span class="stext-105 cl3">
												<?= SMONEY . formatMoney($arrProductos[$p]['precio']); ?>
											</span>
										</div>

										<div class="block2-txt-child2 flex-r p-t-3">
											<a href="#" id="<?= openssl_encrypt($arrProductos[$p]['idproducto'], METHODENCRIPT, KEY); ?>" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail
								icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
												<i class="zmdi zmdi-shopping-cart"></i>

											</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>



	</header>
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
		<div class="header-cart flex-col-l p-l-25 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2" data-section="pagina-inicio" data-value="carrito-titulo">
					Tu carrito
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			<div id="productosCarrito" class="header-cart-content flex-w js-pscroll">
				<?php if ($cantCarrito == 0) { ?>
					<div class="empty-cart-content">
						<div class="text-empty-cart" data-section="pagina-inicio" data-value="carrito-instrucciones">
							Agrega productos y da el primer paso para iniciar tu compra.
						</div>
						<div class="img-empty-cart">
							<img src="<?= media() ?>/tienda/images/img/EmptyCart.svg" alt="Oh my pet-Petshop">
						</div>
						<div class="box-empty-cart">
							<h2 data-section="pagina-inicio" data-value="carrito-vacio">Carrito vacío</h2>
							<button class="btn-ver-productos"><a href="<?= base_url() ?>/tienda" data-section="pagina-inicio" data-value="carrito-boton">Ver productos</a></button>
						</div>
					</div>
				<?php } else { ?>
				<?php getModal('modalCarrito', $data);
				} ?>
			</div>
		</div>
	</div>