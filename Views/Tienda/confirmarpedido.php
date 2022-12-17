<?php
headerTienda($data);
?>
<br><br><br>
<div class="jumbotron container text-center bg0">
    <h1 class="display-4">¡Gracias por tu compra!</h1>
    <p class="lead">Tu pedido fue procesado con éxito.</p>
    <p>No. Orden: <strong> <?= $data['orden']; ?> </strong></p>
    <?php
    if (!empty($data['transaccion'])) {
    ?>
        <p>Transacción: <strong> <?= $data['transaccion']; ?> </strong></p>
    <?php } ?>
    <hr class="my-4">
    <p>Muy pronto estaremos en contacto para coordinar la entrega.</p>
    <p>Puedes ver el estado de tu pedido en la sección pedidos de tu usuario.</p>
    <br>
    <div class="d-flex justify-content-center">
        <a class="btn btn-lg flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer w-25" href="<?= base_url(); ?>" role="button">Continuar</a>
    </div>
</div>

<?php
footerTienda($data);
?>