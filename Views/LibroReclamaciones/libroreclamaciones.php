<?php
headerTienda($data);
$banner = $data['page']['portada'];
$idpagina = $data['page']['idpost'];
?>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('Assets/images/uploads/img_7fc2fe8dfa8a355f53ca5bf4a74ad663.jpg');">
	<h2 class="ltext-105 cl0 txt-center" data-section="pagina-inicio" data-value="libro-reclamacion-titulo">
		Libro de Reclamaciones
	</h2>
</section>
<?php
if (viewPage($idpagina)) {

?>

	<!-- Content page -->


	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr flex-c">
				<div class="size-210 bor10 p-lr-70 p-t-60 p-b-30 p-lr-15-lg w-full-md">
					<form id="frmLibroReclamaciones">
						<h4 class="mtext-105 cl2 txt-center p-b-30" data-section="footer_tienda" data-value="contacto-titulo">
							CONTACTE CON NOSOTROS
						</h4>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="Asunto" name="Asunto" placeholder="Asunto">
							<i class=" how-pos4 pointer-none fa fa-envelope"></i>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="nombreLibroReclamaciones" name="nombreLibroReclamaciones" placeholder="Nombre Completo">
							<i class=" how-pos4 pointer-none fa fa-user"></i>
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="emailLibroReclamaciones" name="emailLibroReclamaciones" placeholder="Correo Electronico">
							<i class=" how-pos4 pointer-none fa fa-book"></i>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="telefonoLibroReclamaciones" name="telefonoLibroReclamaciones" placeholder="Telefono ">
							<i class=" how-pos4 pointer-none fa fa-phone"></i>
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" id="mensaje" name="mensaje" placeholder="Deja tu consulta o mensaje"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" data-section="contacto" data-value="btn-enviar">
							Enviar
						</button>
					</form>

				</div>
				<!-- <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Direccion
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								<?= DIRECCION ?>
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Telefono
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
                            <a class="linkFooter" href="tel:<?= TELEFONOEMPRESA ?>"><?= TELEFONOEMPRESA ?></a>
							</p>
						</div>
					</div>
                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								EMAIL
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
                            <a class="linkFooter" href="mailto:<?= EMAIL_EMPRESA ?>"><?= EMAIL_EMPRESA ?></a>
							</p>
						</div>
					</div>
					
                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-smartphone"></span>
						</span>
                        <div class="size-212 p-t-2">
                         
							<span class="mtext-110 cl2">
								Si lo prefiere puede contactarnos por WhatsApp
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
                            <a class="linkFooter" href="https://wa.me/<?= WHATSAPP ?>"><?= WHATSAPP ?></a>
							</p>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>
	</div>

<?php
	// echo $data['page']['contenido'];
} else {
?>
	<div>
		<div class="container-fluid py-5 text-center">
			<img src="<?= media() ?>/images/construction.png" alt="En construcción">
			<h3>Estamos trabajando para usted.</h3>
		</div>
	</div>

<?php }
footerTienda($data); ?>