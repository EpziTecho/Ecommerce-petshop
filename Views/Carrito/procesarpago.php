<?php
headerTienda($data);

$subtotal = 0;
$total = 0;
foreach ($_SESSION['arrCarrito'] as $producto) {
	$subtotal += $producto['precio'] * $producto['cantidad'];
}
$total = $subtotal;

$tituloTermino = !empty(getInfoPage(PTERMINOS)) ? getInfoPage(PTERMINOS)['titulo'] : "";
$infoTerminos = !empty(getInfoPage(PTERMINOS)) ? getInfoPage(PTERMINOS)['contenido'] : "";

?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= CLIENT_ID_PRODUCCION ?>&currency=<?= CURRENCY ?>"></script>
<br><br><br>
<hr>
<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="<?= base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
			Inicio
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>
		<span class="stext-109 cl4">
			<?= $data['page_title'] ?>
		</span>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
			<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
				<div>
					<?php
					if (isset($_SESSION['login'])) {
					?>
						<div>
							<label for="tipopago" data-section="pagina-inicio" data-value="carrito-direccion">Dirección de envío</label>
							<div class="bor8 bg0 m-b-12">
								<input id="txtDireccion" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="Dirección de envío">
							</div>
							<div class="bor8 bg0 m-b-22">
								<input id="txtCiudad" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Ciudad / Estado">
							</div>
						</div>
					<?php } else { ?>

						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true" data-section="header_tienda" data-value="navbar-negro-iniciar-sesion">Iniciar Sesión</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="false" data-section="header_tienda" data-value="navbar-negro-registrarse">Crear cuenta</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
								<br>
								<form id="formLogin">
									<div class="form-group">
										<label for="txtEmail" data-section="pagina-inicio" data-value="carrito-usuario">Usuario</label>
										<input type="email" class="form-control" id="txtEmail" name="txtEmail">
									</div>
									<div class="form-group">
										<label for="txtPassword" data-section="pagina-inicio" data-value="carrito-contraseña">Contraseña</label>
										<input type="password" class="form-control" id="txtPassword" name="txtPassword">
									</div>
									<button type="submit" class="btn btn-primary" data-section="header_tienda" data-value="navbar-negro-iniciar-sesion">Iniciar sesión</button>
								</form>

							</div>
							<div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
								<br>
								<form id="formRegister">
									<div class="row">
										<div class="col col-md-6 form-group">
											<label for="txtNombre" data-section="pagina-inicio" data-value="carrito-nombre">Nombres</label>
											<input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
										</div>
										<div class="col col-md-6 form-group">
											<label for="txtApellido" data-section="pagina-inicio" data-value="carrito-apellido">Apellidos</label>
											<input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
										</div>
									</div>
									<div class="row">
										<div class="col col-md-6 form-group">
											<label for="txtTelefono" data-section="contacto" data-value="telefono-titulo">Teléfono</label>
											<input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
										</div>
										<div class="col col-md-6 form-group">
											<label for="txtEmailCliente" data-section="contacto" data-value="email">Email</label>
											<input type="email" class="form-control valid validEmail" id="txtEmailCliente" name="txtEmailCliente" required="">
										</div>
									</div>
									<button type="submit" class="btn btn-primary" data-section="header_tienda" data-value="navbar-negro-registrarse">Regístrate</button>
									<p data-section="pagina-inicio" data-value="carrito-clic"><span class="required">*</span>Al registrarse usted acepta los términos y condiciones</p>
								</form>
							</div>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>

		<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
			<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
				<h4 class="mtext-109 cl2 p-b-30" data-section="pagina-inicio" data-value="carrito-resumen">
					Resumen
				</h4>

				<div class="flex-w flex-t bor12 p-b-13">
					<div class="size-208">
						<span class="stext-110 cl2">
							Subtotal:
						</span>
					</div>

					<div class="size-209">
						<span id="subTotalCompra" class="mtext-110 cl2">
							&nbsp;&nbsp;&nbsp;<?= SMONEY . formatMoney($subtotal) ?>
						</span>
					</div>

					<div class="size-208">
						<span class="stext-110 cl2" data-section="pagina-inicio" data-value="carrito-envio">
							Envío:
						</span>
					</div>

					<div class="size-209">
						<span id="costoEnvio" class="mtext-110 cl2">
							&nbsp;&nbsp;&nbsp;<?= SMONEY . formatMoney(COSTOENVIO) ?>
						</span>
					</div>

					<div class="size-208">
						<span class="stext-110 cl2" data-section="pagina-inicio" data-value="carrito-cupon">
							Dscto Cupón:
						</span>
					</div>

					<div class="size-209">
						<span id="dsctoCupon" class="mtext-110 cl2">
							- S/. 0.00
						</span>
						<input type="hidden" value="0" id="hdCupon">
						<input type="hidden" value="0" id="hdPorcentajeDsctoCupon">
					</div>
				</div>
				<div class="flex-w flex-t p-t-27 p-b-33">
					<div class="size-208">
						<span class="mtext-101 cl2">
							Total:
						</span>
					</div>

					<div class="size-209 p-t-1">
						<span id="totalCompra" class="mtext-110 cl2">
							&nbsp;&nbsp;&nbsp;<?= SMONEY . formatMoney($total + COSTOENVIO) ?>
						</span>
					</div>
					<?php
					if (isset($_SESSION['login'])) {
					?>
						<div class="flex-w flex-t p-t-27 d-flex justify-content-center">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 w-50 text-uppercase" type="text" name="txtCupon" id="txtCupon" placeholder="Código Cupón" autocomplete="off">
							<button type="button" id="btnValidarCupon" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer w-25" data-section="pagina-inicio" data-value="carrito-validar">
								Validar
							</button>
							&nbsp;
							<button type="button" id="btnRetirarCupon" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" style="width: 5%;">
								X
							</button>
							<input type="hidden" id="hdIdCupon" value="0">
						</div>
				</div>
				<hr>

				<div id="divMetodoPago">
					<div id="divCondiciones">
						<input type="checkbox" id="condiciones">
						<label for="condiciones" data-section="pagina-inicio" data-value="carrito-aceptar"> Aceptar </label>
						<a href="#" data-toggle="modal" data-target="#modalTerminos" data-backdrop="static" data-keyboard="false" data-section="terminos-condiciones" data-value="h1"> Términos y Condiciones </a>
						<br>
					</div>
					<p data-section="pagina-inicio" data-value="carrito-clic"><span class="required">*</span>Al hacer clic usted acepta los términos y condiciones</p>
					<div id="optMetodoPago" class="notblock">
						<hr>
						<h4 class="mtext-109 cl2 p-b-30" data-section="pagina-inicio" data-value="carrito-metodo">
							Método de pago
						</h4>
						<div class="divmetodpago">
							<div>
								<label for="paypal">
									<input type="radio" id="paypal" class="methodpago" name="payment-method" checked="" value="Paypal">
									<img src="<?= media() ?>/images/img-paypal.jpg" alt="Icono de PayPal" class="ml-space-sm" width="74" height="20">
								</label>
							</div>
							<div>
								<label for="contraentrega">
									<input type="radio" id="contraentrega" class="methodpago" name="payment-method" value="CT" data-section="pagina-inicio" data-value="carrito-recoger">
									<span>Recoger en Tienda</span>
								</label>
							</div>
							<div id="divtipopago" class="notblock">
								<label for="listtipopago" data-section="pagina-inicio" data-value="carrito-tipo">Tipo de pago</label>
								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select id="listtipopago" class="js-select2" name="listtipopago">
										<?php
										if (count($data['tiposPago']) > 0) {
											foreach ($data['tiposPago'] as $tipopago) {
												if ($tipopago['idtipopago'] != 1) {
										?>
													<option value="<?= $tipopago['idtipopago'] ?>"><?= $tipopago['tipopago'] ?></option>
										<?php
												}
											}
										} ?>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<div id="msgpaypal">
								<p data-section="pagina-inicio" data-value="carrito-paypal">Para completar la transacción, te enviaremos a los servidores seguros de PayPal.</p>
								<div id="paypal-btn-container"></div>
								<script>
									var total = <?= $total ?>;
									var subtotal = <?= $total ?>;
									var costoEnvio = <?= COSTOENVIO ?>;
								</script>
							</div>
						</div>

						<hr id="hrComprar">
						<br>

						<button type="submit" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer notblock" data-section="pagina-inicio" data-value="carrito-pagar">Pagar</button>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTerminos" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?= $tituloTermino ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="page-content">
					<?= $infoTerminos ?>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer w-25" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script src="<?= media() ?>/js/functions_procesarpagos.js"></script>
<?php
footerTienda($data);
?>