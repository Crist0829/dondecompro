<?php 

require_once("../../../model/conect_db.php");

$nombre = $_GET["nombre"];

$consulta = new consultarUsuario();

$respuesta = $consulta->consultar($nombre);

if($respuesta == 0){

    echo 0;

}else{

    echo 1;

}







?>