<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Oh my Pet">
  <link rel="shortcut icon" href="<?php echo media(); ?>/images/logo.jpeg">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo media(); ?>/css/style.css">
  <!-- Font-icon css-->
  <title><?= $data['page_tag']; ?></title>
</head>

<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <div class="logo">      
     <a href=" <?php echo base_url(); ?> ">
      <img  src="<?=media() ?>/tienda/images/img/logo-svg1.svg" class="login_logo" alt="Oh my pet-Petshop"></a>
    </div>
    <div class="login-box">
      <div id="divLoading">
        <div>
          <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
        </div>
      </div>
      <form class="login-form" name="formLogin" id="formLogin" action="">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
        <div class="form-group">
          <label class="control-label">Usuario</label>
          <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus>
        </div>
        <div class="form-group">
          <label class="control-label">Contraseña</label>
          <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
        </div>
        <div class="form-group">
          <div class="utility">
            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
          </div>
        </div>
        <div id="alertLogin" class="text-center"></div>
        <div class="form-group btn-container">
          <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sing-in-alt"></i>Iniciar Sesión</button>
        </div>
      </form>
      <form id="formRecetPass" name="formRecetPass" class="forget-form" action="">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
        <div class="form-group">
          <label class="control-label">EMAIL</label>
          <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
        </div>
        <div class="form-group btn-container">
          <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Reiniciar</button>
        </div>
        <div class="form-group mt-3">
          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar Sesión</a></p>
        </div>
      </form>
    </div>
  </section>
  <script>
    const base_url = "<?= base_url(); ?>";
  </script>
  <!-- Essential javascripts for application to work-->
  <script src="<?php echo media(); ?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo media(); ?>/js/popper.min.js"></script>
  <script src="<?php echo media(); ?>/js/bootstrap.min.js"></script>
  <script src="<?php echo media(); ?>/js/fontawesome.js"></script>
  <script src="<?php echo media(); ?>/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?php echo media(); ?>/js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
  <script src="<?php echo media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
</body>

</html>