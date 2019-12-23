<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>POSMX - Registro</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url().'assets/' ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url().'assets/' ?>css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5" style="max-width:none">
      <div class="card-header">Registro</div>
      <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger" role="alert">','</div>')?>
        <?php echo (!empty($error) && $error != null)?'<div class="alert alert-danger" role="alert">'.$error.'</div>':''?>

        <?php echo form_open(base_url("acceso/registrarUsuario"))?>
          <form class="needs-validation" novalidate="">
            <div class="row">
              <div class="col-md-4 mb-3"><!--
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" id="nombres" placeholder="" value="" required="">-->
                <?php echo form_label("Nombres", "nombres")?>
                <?php echo form_input($regitems["nombres"])?>                
                <div class="invalid-feedback">
                  El campo nombres es requerido.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <?php echo form_label("Apellido Paterno", "apellidoPaterno")?>
                <?php echo form_input($regitems["apellidoPaterno"])?>
                <div class="invalid-feedback">
                  Apellido paterno es requerido
                </div>
              </div>
              <div class="col-md-4 mb-3">                
                <?php echo form_label("Apellido Materno", "apellidoMaterno")?>
                <?php echo form_input($regitems["apellidoMaterno"])?>
                <div class="invalid-feedback">
                  Apellido materno es requerido
                </div>
              </div>
            </div><!-- fin del row-->

            <div class="row">
              <div class="col-md-4 mb-3">                
                <?php echo form_label("Correo Electrónico", "correo")?>
                <?php echo form_input($regitems["correo"])?>
                <div class="invalid-feedback">
                  Pro favor introduce un correo electrónico válido.
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <?php echo form_label("Contraseña", "contrasena")?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>                                    
                    <?php echo form_input($regitems["contrasena"])?>
                  <div class="invalid-feedback" style="width: 100%;">
                    La contraseña de usuario es requerida.
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <?php echo form_label("Confirmar contraseña", "contrasena2")?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>                                    
                    <?php echo form_input($regitems["contrasena2"])?>
                  <div class="invalid-feedback" style="width: 100%;">
                    Re escriba la de usuario es requerido.
                  </div>
                </div>
              </div>                
            </div><!-- fin del row-->
<!--
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-12">
              <label for="direccion">Dirección</label>
              <input type="text" class="form-control" id="direccion" placeholder="1234 Main St" required="">
              <div class="invalid-feedback">
                Por favor introduce una dirección.
              </div>
            </div>

            <div class="row">
              </div>
              <div class="col-md-5 mb-3">
                <label for="pais">País</label>
                <select class="custom-select d-block w-100" id="pais" required="">
                  <option value="">Seleccionar...</option>
                  <option>México</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona un país válido.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="estado">Estado</label>
                <select class="custom-select d-block w-100" id="estado" required="">
                  <option value="">Seleccionar...</option>
                  <option>Ciudad de México</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona un estado válido
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="codigoPostal">Código postal</label>
                <input type="text" class="form-control" id="codigoPostal" placeholder="" required="">
                <div class="invalid-feedback">
                  Coódigo postal requerido.
                </div>
              </div>
            </div>

            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Mi dirección es la misma que mi negocio.</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Estoy deacuerdo con los terminos y condiciones</label>
            </div>
            <hr class="mb-4">

            <div class="row">
              

            <div class="d-block col-md-3 mb-3">
              <h4 class="mb-3">Mi negocio es</h4>
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                <label class="custom-control-label" for="credit">Start Up</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="debit">Pequeño Negocio</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="paypal">Comerciante informal</label>
              </div>
            </div>

            <div class="d-block col-md-3 mb-3">
              <h4 class="mb-3">Laboran</h4>
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                <label class="custom-control-label" for="credit">1 a 5 Empleados</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="debit">6 a 20 Empleados</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="paypal">21-50 Empleados</label>
              </div>

              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="paypal">Más de 51 Empleados</label>
              </div>
            </div>

            <div class="d-block col-md-3 mb-3">
              <h4 class="mb-3">Mi negocio tiene</h4>
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                <label class="custom-control-label" for="credit">1 a 10 Productos</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="debit">11 a 50 Productos</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="paypal">51 a 100 Productos</label>
              </div>              
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="paypal"> Más de 100 Productos</label>
              </div>
            </div>

            <div class="d-block col-md-3 mb-3">
              <h4 class="mb-3">Ramo</h4>
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                <label class="custom-control-label" for="credit">Salud</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="debit">Consumo</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                <label class="custom-control-label" for="paypal">Servicios</label>
              </div>
            </div>


            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">RFC</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                <small class="text-muted">Introduce tu RFC Completo</small>
                <div class="invalid-feedback">
                  RFC es requerido
                </div>
              </div>              
            </div>

            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Dato</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                <div class="invalid-feedback">
                  Dato requerido
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Dato</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                <div class="invalid-feedback">
                  Dato requerido
                </div>
              </div>
            </div>
          -->
            <hr class="mb-4">
            <?php echo form_submit($regitems["registrar"])?>
          </form>
        <?php echo form_close() ?>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url('acceso/registro')?>">Registrar una cuenta</a>
          <a class="d-block small" href="<?php echo base_url('acceso/recuperar')?>">¿Olvidaste tú contraseña?</a>
          <a class="d-block small" href="<?php echo base_url('acceso')?>">Inicio</a>
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
