<?php 
session_start();

if(isset($_GET["indice"])){

    unset($_SESSION["listado_productos"][$_GET["indice"]]);
    $_SESSION["contador_productos"] --;

    echo 1;


}else{

    echo 0;

}


?>