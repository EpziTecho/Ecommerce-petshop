<?php
headerTienda($data);
// getModal('modalCarrito',$data);
$arrProductos = $data['productos'];

// dep($arrProductos);

?>
<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-90 p-lr-0-lg" style="padding-bottom: 20vh;">
	<div class="container">
		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<button id="Cattodos" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*" data-section="pagina-inicio" data-value="filtrado-1">
					Todos los productos
				</button>

				<button id="Catperros" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".categoria3" data-section="pagina-inicio" data-value="filtrado-2">
					Productos para perros
				</button>

				<button id="Catgatos" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".categoria2" data-section="pagina-inicio" data-value="filtrado-3">
					Productos para gatos
				</button>

				<button id="Catotros" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".categoria1" data-section="pagina-inicio" data-value="filtrado-4">
					Productos para otras mascotas
				</button>
			</div>

			<div class="flex-w flex-c-m m-tb-10">

				<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search" data-section="pagina-inicio" data-value="boton-buscar">
					<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
					<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Buscar
				</div>
			</div>

			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				<div class="bor8 dis-flex p-l-15">
					<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>

					<input class="mtext-107 cl2 size-114 plh2 p-r-15" id="searchP" type="text" name="search-product" placeholder="Search">
				</div>
			</div>

			<!-- Filter -->

			<form method="post" class="dis-none panel-filter w-full p-t-10">
				<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">

					<div class="filter-col1 p-r-15 p-b-27">
						<div class="mtext-102 cl2 p-b-15">
							Ordenar por
						</div>

						<ul class="filter-order-group-buttons">
							<select name="precio" id="" class="filter-link stext-106 trans-04">
								<option value="asc">Precio: Menor a Mayor</option>
								<option value="des">Precio: Mayor a Menor</option>
							</select>
						</ul>
					</div>
				</div>
			</form>
		</div>

		<div id="productos" class="row">
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
							<a href="<?= base_url() . '/tienda/producto/' . $arrProductos[$p]['idproducto'] . '/' . $ruta; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" data-section="pagina-inicio" data-value="carrito-boton">
								Ver producto
							</a>
							<div class="tag-sale">
								<?php if ($arrProductos[$p]['status'] == 3) { ?>
									<img src="<?= media() ?>/tienda/images/tag-sale.png" alt="tag-oferta">
								<?php } ?>
							</div>
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

			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04" data-section="pagina-inicio" data-value="boton-ver-mas">
					Ver más
				</a>
			</div>
		</div>
	</div>
</div>
<?php footerTienda($data); ?>