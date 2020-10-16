<?php 

require_once("../controller/conerror.php");

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Contraseña</title>

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

  
    

    <h5 class="titulos">RECUPERAR CONTRASEÑA</h5>
    <p>Te enviaremos un link a tu correo para verificar tus datos
        y luego podrás establecer otra contraseña.
    </p>

    <div>
        <img src="assets/media/image/ositos/recuperar-clave.png" alt="image">
    </div>

    <!-- form -->
    <form action="../controller/recuperar_clave.php" method="POST">
        <div class="form-group">
            <input type="email" name = "correo" class="form-control" placeholder="Email" required autofocus>
        </div>
        <input type="submit" class="btn btn-outline-success btn-block" value="ENVIAR">
        <hr class="hr-per-2">
        <div>
        <p >También puedes</p>
        <a href="registrar-usuario.php" class="btn btn-sm btn-outline-success btn-block">Registrarte</a>
        <a href="../index.php" class="btn btn-sm btn-outline-success btn-block">Iniciar sesión</a>
        </div>
        
    </form>
    <!-- ./ form -->


</div>

<!-- Plugin scripts -->
<script src="vendors/bundle.js"></script>

<!-- App scripts -->
<script src="assets/js/app.min.js"></script>
</body>
</html>
