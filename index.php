<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DondeCompro</title>

    <!-- Icono -->
    <link rel="shortcut icon" href="view/assets/media/image/favicon.png"/>

    <!-- Main css -->
    <link rel="stylesheet" href="view/vendors/bundle.css" type="text/css">

    <!-- Fuente de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="view/vendors/datepicker/daterangepicker.css" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" href="view/vendors/dataTable/datatables.min.css" type="text/css">

<!-- App css -->
    <link rel="stylesheet" href="view//assets/css/app.min.css" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="dark">
<?php require_once("controller/navegacion.php") ?>
<!-- Precargador de la página -->
<div class="preloader">
    <div class="preloader-icon"></div>
    <span>Cargando...</span>
</div>
<!--Termina el Precargador de la página-->

<!-- Layout wrapper -->
<div class="layout-wrapper">

    <!-- Header -->
    <?php CargarHeader() ?>
    <!-- ./ Header -->

    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- begin::navigation -->
        <?php cargarNavegacion()?>
        <!-- end::navigation -->

        <!-- Content body -->
        <?php cargarContenido()?>
        <!-- ./ Content body -->

    </div>
    <!-- ./ Content wrapper -->

</div>
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="view/vendors/bundle.js"></script>

    <!-- Apex chart -->
    <script src="view/vendors/charts/apex/apexcharts.min.js"></script>

    <!-- Daterangepicker -->
    <script src="view/vendors/datepicker/daterangepicker.js"></script>

    <!-- DataTable -->
    <script src="view/vendors/dataTable/datatables.min.js"></script>

    <!-- Dashboard scripts -->
    <script src="view/assets/js/examples/pages/dashboard.js"></script>

<!-- App scripts -->
<script src="view/assets/js/app.min.js"></script>
</body>
</html>
