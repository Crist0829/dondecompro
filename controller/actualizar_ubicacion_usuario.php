<?php 
require_once("../model/base_datos_usuarios.php");
session_start();

if(isset($_POST["provincia"]) && $_POST["provincia"] != "seleccionar"){


    $provincia = $_POST["provincia"];
    $direccion = $_POST["direccion"];
    $nombre = $_SESSION["nombre"];
    $usuario = new consultarUsuario();
    $usuario->consultar($nombre);

    $ID = $usuario->registro["ID"];
    $ubicacion = new Ubicacion();


    if($provincia == "Ciudad Autónoma de Buenos Aires" ||
    $provincia == "Entre Ríos" ||
    $provincia == "Santa Cruz" ||
    $provincia == "Santiago del Estero"){

        if($ubicacion->actualizarProvincia($ID, $provincia)){

            $ubicacion->eliminarMunicipio($ID);
            header("location: ../index.php?page=2&success=20");

        }else{

            header("location: ../index.php?page=2&conerror=50");

        }


    }else{

        $municipio = $_POST["municipio"];

        if($ubicacion->actualizarProvinciaMunicipio($ID, $provincia, $municipio)){

            header("location: ../index.php?page=2&success=20");

        }else{


            header("location: ../index.php?page=2&conerror=40");

        }

    }


}else{


    header("location: ../index.php?page=2&conerror=40");

}


?>