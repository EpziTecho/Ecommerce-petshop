<?php 
headerTienda($data);
$arrProducto = $data['producto'];
$arrProductos = $data['productos'];
$arrImages = $arrProducto['images']; 
$rutacategoria = $arrProducto['categoriaid'].'/'.$arrProducto['ruta_categoria'];
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
   	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-90 p-lr-0-lg">
			<a href="<?= base_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a href="<?= base_url().'/tienda/categoria/'.$rutacategoria; ?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?= $arrProducto['categoria'] ?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">
				<?= $arrProducto['nombre'] ?>
			</span>
		</div>
	</div>
	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-30 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
							<?php 
								if(!empty($arrImages)){
									for ($img=0; $img < count($arrImages) ; $img++) { 
										
							 ?>
								<div class="item-slick3" data-thumb="<?= $arrImages[$img]['url_image']; ?>">
									<div class="wrap-pic-w pos-relative">
										<img src="<?= $arrImages[$img]['url_image']; ?>" alt="<?= $arrProducto['nombre']; ?>">
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $arrImages[$img]['url_image']; ?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							<?php 
									}
								} 
							?>
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?= $arrProducto['nombre']; ?>
						</h4>
						<span class="mtext-107 cl2 dis-block">
							SKU:
							<?= $arrProducto['codigo']; ?>
						</span>

						<?php
							if($arrProducto['status'] == 3){
						?>
							<span class="mtext-106 cl2">
								Antes <del> <?= SMONEY.formatMoney($arrProducto['precio']); ?> </del>
							</span>
							<br>
							<span class="mtext-106 cl2">
								Ahora <?= SMONEY.formatMoney($arrProducto['precio_promocion']); ?>
							</span>
						<?php
							}
							else{
						?>
							<span class="mtext-106 cl2">
								<?= SMONEY.formatMoney($arrProducto['precio']); ?>
							</span>
						<?php
							}
						?>
						<!-- <p class="stext-102 cl3 p-t-23"></p> -->
						<?= $arrProducto['descripcion']; ?>
						<!--  -->
						<div class="p-t-33">
							<div class="flex-w p-b-10" style="justify-content: center; align-items: center;">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input id="cant-product" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" min="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button id="<?= openssl_encrypt($arrProducto['idproducto'],METHODENCRIPT,KEY); ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" data-section="pagina-inicio" data-value="agregar-carrito">
										Agregar al carrito
									</button>
								</div>
							</div>	
						</div>
						<!--  -->
						<div class="flex-w shareproduct">
							<div class="flex-m bor9 p-r-10 m-r-11">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
									<i class="zmdi zmdi-favorite"></i>
								</a>
							</div>

							<a href="<?='https://www.facebook.com/sharer/sharer.php?display=popup&u='.$link; ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>

	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-30 p-b-105">
	<div class="bg6 flex-c-m flex-w size-302 m-t-10 m-b-30 p-tb-15">
				<h3 class="ltext-106 cl5 txt-center" data-section="pagina-inicio" data-value="relacionado">
					Productos relacionados
				</h3>
			</div>
		<div class="container">			
			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

				<?php 
					if(!empty($arrProductos)){
						for ($p=0; $p < count($arrProductos); $p++) { 
							$ruta = $arrProductos[$p]['ruta'];
							if(count($arrProductos[$p]['images']) > 0 ){
								$portada = $arrProductos[$p]['images'][0]['url_image'];
							}else{
								$portada = media().'/images/uploads/product.png';
							}
				 ?>
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="<?= $portada ?>" alt="<?= $arrProductos[$p]['nombre'] ?>">

								<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['idproducto'].'/'.$ruta; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04"  data-section="pagina-inicio" data-value="carrito-boton">
									Ver producto
								</a>
								<div class="tag-sale">
									<?php if($arrProductos[$p]['status'] == 3){ ?>
										<img src="<?= media() ?>/tienda/images/tag-sale.png" alt="tag-oferta">
									<?php } ?>
								</div>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['idproducto'].'/'.$ruta; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?= $arrProductos[$p]['nombre'] ?>
									</a>
									<?php
										if($arrProductos[$p]['status'] == 3){
									?>
										<span class="mtext-106 cl2">
											Antes <del> <?= SMONEY.formatMoney($arrProductos[$p]['precio']); ?> </del>
										</span>
										<span class="mtext-106 cl2">
											Ahora <?= SMONEY.formatMoney($arrProductos[$p]['precio_promocion']); ?>
										</span>
									<?php
										}
										else{
									?>
										<span class="mtext-106 cl2">
											<?= SMONEY.formatMoney($arrProductos[$p]['precio']); ?>
										</span>
									<?php
										}
									?>
								</div>
								<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" id="<?= openssl_encrypt($arrProductos[$p]['idproducto'],METHODENCRIPT,KEY);?>" 
								pr="1"
								class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail
								icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-shopping-cart"></i>
									
								</a>
								</div>
							</div>
						</div>
					</div>
				<?php 
						}
					}	
				 ?>

				</div>
			</div>
		</div>
	</section>
<?php 
	footerTienda($data);
?>
