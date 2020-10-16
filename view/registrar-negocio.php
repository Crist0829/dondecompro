<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrate</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/media/image/favicon.png"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="vendors/bundle.css" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="assets/css/app.min.css" type="text/css">
</head>
<body class="dark form-membership">

<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->

<div class="form-wrapper">

    

    <h3 class="texto-verde"> CREAR CUENTA DE NEGOCIO</h3>
   
    <div>
        <figure><img src="assets/media/image/ositos/agregar-negocio.png" alt="image"></figure>
    </div>
    

    <!-- form -->
    <form action="../controller/registrar_negocio.php" method="POST" onsubmit="return validar();">
        <div class="form-group">

            <input type="text" name = "nombre"  id = "nombre" class="form-control" placeholder="Nombre de usuario" onchange="fNombre();" require autofocus>
            <small class="form-text" id="enombre"><i></i>  </small>

        </div>

        <div class="form-group">

            <input type="email" name = "correo" id = "correo" class="form-control" placeholder="Email"  onchange="fCorreo();"require>
            <small class="form-text" id="ecorreo"><i> </i> </small>

        </div>
    
        <div class="form-group">

            <input type="password" name = "clave" id = "clave" class="form-control" placeholder="Contraseña"onchange="fClave();" require>
            <small class="form-text" id="eclave"><i></i>  </small>

        </div>
        <div class="form-group">

            <input type="password" name = "rclave" id = "rclave" class="form-control" placeholder="Repite la contraseña" onchange="frClave();"require>
            <small class="form-text" id="erclave"><i></i>  </small>

        </div>

        <div class="form-group">
        <div class="custom-control custom-checkbox custom-checkbox-success">
        <input type="checkbox" class="custom-control-input" id="licencia">
        <label class="custom-control-label texto-verde" for="licencia">Acepto los terminos de uso</label>
        </div>
        </div>
        
        <div>

        <button class="btn btn-outline-success btn-block">¡REGISTRARSE!</button>

        </div>
        
        <hr class="hr-per-2">

        <p class="texto-verde">O PUEDES REGISTRARTE COMO USUARIO</p>
        <a href="registrar-usuario.php" class="btn btn-outline-success btn-block"><small>REGISTRAR USUARIO</small></a>



        <hr class="hr-per-2">
        <p class="texto-verde">¿Ya tienes una cuenta?</p>
        <a href="../index.php" class="btn btn-outline-success btn-block">INICIA SESIÓN</a>
    </form>
    <!-- ./ form -->


</div>
<!--Validación del formulario de registro en el Front -->
<script src="assets/js/validar.js"> </script>
<!-- Plugin scripts -->
<script src="vendors/bundle.js"></script>

<!-- App scripts -->
<script src="assets/js/app.min.js"></script>
</body>
</html>
