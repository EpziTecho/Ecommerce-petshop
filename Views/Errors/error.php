<?php 
    headerTienda($data);
?>
<!-- <script>
  document.querySelector('header').classList.add('header-v4');
</script> -->
<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-90 p-lr-0-lg" style="padding-bottom: 40vh; padding-top: 30vh" >
  <div class="container">
      <div class="page-error tile">
        <div style="display: flex; justify-content: center;">
          <img src="<?=media() ?>/tienda/images/img/error.svg" style="min-height:5%; min-width:5%; height:auto; width:auto; max-height:300px; max-width:300px;" alt="Oh my pet-Petshop">
        </div>
        <?= $data['page']['contenido']; ?>
        <p><a class="btn btn-warning" href="javascript:window.history.back();" style="margin-top: 10px;"data-section="faq" data-value="atras">Regresar</a></p>
      </div>
  </div>
</div>
<?php footerTienda($data); ?>

