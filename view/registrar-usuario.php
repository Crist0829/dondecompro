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

    

    <h3 class="texto-verde"> CREAR CUENTA DE USUARIO</h3>
   
    <div>
        <img src="assets/media/image/ositos/agregar-usuario.png" alt="image">
    </div>
    

    <!-- form -->
    <form action="../controller/registrar_usuario.php" method="POST" onsubmit="return validar();">
        <div class="form-group">

            <input type="text" name = "nombre"  id = "nombre" class="form-control" placeholder="Escribe tu nombre de usuario" onchange="fNombre();" require autofocus autocomplete="off">
            <small class="form-text" id="enombre"><i></i>  </small>

        </div>

        <div class="form-group">

            <input type="email" name = "correo" id = "correo" class="form-control" placeholder="Digita tu email"  onchange="fCorreo();"require autocomplete="off">
            <small class="form-text" id="ecorreo"><i> </i> </small>

        </div>
    
        <div class="form-group">

            <input type="password" name = "clave" id = "clave" class="form-control" placeholder="Establece una contraseña"onchange="fClave();" require autocomplete="off" >
            <small class="form-text" id="eclave"><i></i>  </small>

        </div>
        <div class="form-group">

            <input type="password" name = "rclave" id = "rclave" class="form-control" placeholder="Repite la contraseña" onchange="frClave();"require autocomplete="off">
            <small class="form-text" id="erclave"><i></i>  </small>

        </div>

        <div>
        <label class="custom-radio-checkbox">

            <input class="custom-radio-checkbox__input" id="licencia" type="checkbox">
            <span class="custom-radio-checkbox__show custom-radio-checkbox__show--checkbox"></span>

            <small><strong>Acepto las condiciones de uso y privacidad</strong></small>

        </label>
        </div>
        
        <div>

        <button class="btn btn-success btn-block">¡REGISTRARSE!</button>

        </div>
        
        <hr class="hr-per">

        <p>O PUEDES REGISTRAR UN NEGOCIO</p>
        <a href="registrar-negocio.php" class="btn btn-success btn-block">CREAR UNA CUENTA DE NEGOCIO</a>



        <hr class="hr-per">
        <p>¿Ya tienes una cuenta?</p>
        <a href="../index.php" class="btn btn-success btn-block">INICIA SESIÓN</a>
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
