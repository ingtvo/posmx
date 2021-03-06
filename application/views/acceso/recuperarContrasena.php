<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>POSMX - Recuperar Contraseña</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url().'assets/' ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url().'assets/' ?>css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Ingresar</div>
      <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger" role="alert">','</div>')?>
        <?php echo (!empty($this->session->userdata('errorUsuario')))?'<div class="alert alert-danger" role="alert">'.$this->session->userdata('errorUsuario').'</div>':''?>
        <?php echo (!empty($this->session->userdata('msjUsuario')))?'<div class="alert alert-success" role="alert">'.$this->session->userdata('msjUsuario').'</div>':''?>
<!--    
        <form>-->
        <?php echo form_open(base_url("modacceso/Acceso/enviarContrasena"))?>
          <div class="form-group">
            <div class="form-label-group">
              <?php echo form_input($recuperaritems["correo"])?>
              <?php echo form_label("Correo", "correo")?>
            </div>
          </div>
          <?php echo form_input($recuperaritems["origen"])?>
          
          <!--
          <a class="btn btn-primary btn-block" href="index.html">Ingresar</a>-->          
          <?php echo form_submit($recuperaritems["ingresar"])?>
<!--    
        </form>-->
        <?php echo form_close() ?>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url('modacceso/Acceso/registro')?>">Registrar una cuenta</a>
          <a class="d-block small" href="<?php echo base_url('modacceso/Acceso/recuperarContrasena')?>"¿Olvidaste tú contraseña?</a>
          <a class="d-block small" href="<?php echo base_url()?>">Inicio</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url().'assets/' ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url().'assets/' ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url().'assets/' ?>vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
