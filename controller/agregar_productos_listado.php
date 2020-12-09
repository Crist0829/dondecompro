<?php 
session_start();

if(isset($_GET["producto"])){

    $producto = str_replace("_", " ", $_GET["producto"]);

    if(isset($_SESSION["listado_productos"])){

        $_SESSION["listado_productos"][$_SESSION["numero_productos"]] = $producto;
        echo 1;
    
    }else{

        $_SESSION["listado_productos"] = array();
        $_SESSION["listado_productos"][$_SESSION["numero_productos"]] = $producto;

        echo 1;

    }



}else{

    echo 0;

}















?>