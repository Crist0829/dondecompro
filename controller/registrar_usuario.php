<?php

require_once("../model/conect_db.php");


$nombre = htmlentities(addslashes($_POST["nombre"])); 
$correo = htmlentities(addslashes($_POST["correo"])); 
$clave = htmlentities(addslashes($_POST["clave"])); 
$perfil = 0;
$estado = 1;
$a_fecha = getdate();
$fecha = $a_fecha["year"]."-".$a_fecha["mon"]."-".$a_fecha["mday"];
$clave_cifrada = password_hash($clave, PASSWORD_DEFAULT);
$activacion_sin = rand(0, 99999);
$activacion_con = password_hash($activacion_sin, PASSWORD_DEFAULT);



$conexion = new insertarUsuario();

if($conexion->insertar_temp($nombre, $correo, $clave_cifrada, $perfil, $estado, $fecha, $activacion_con)){

    $para = $correo;
    $titulo = 'Verificación de la cuenta';
    $mensaje = "Ingresa a este link para verificar tu cuenta: ".$_SERVER["SERVER_NAME"]."/view/activacion.php?correo=$correo&activacion=$activacion_con.";

    mail($para, $titulo, $mensaje);

    header("location: ../view/verificacion.php");

} else {

    echo 'The email message was sent.';
    
}



?>