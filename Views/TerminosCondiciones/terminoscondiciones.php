<?php
headerTienda($data);
$banner = $data['page']['portada'];
$idpagina = $data['page']['idpost'];
?>
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('Assets/images/uploads/img_7fc2fe8dfa8a355f53ca5bf4a74ad663.jpg');">
    <h2 class="ltext-105 cl0 txt-center" data-section="terminos-condiciones" data-value= "h1">
        Términos y Condiciones
    </h2>
</section>
<?php
if (viewPage($idpagina)) {
?>
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="size-210 bor10 p-lr-70 p-t-60 p-b-30 p-lr-15-lg w-full-md">
                    <div class="page-content">
                        <?php echo $data['page']['contenido']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
<?php
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