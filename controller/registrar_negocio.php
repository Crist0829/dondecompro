<?php

require_once("../model/base_datos_usuarios.php");

$nombre = htmlentities(addslashes($_POST["nombre"])); 
$correo = htmlentities(addslashes($_POST["correo"])); 
$clave = htmlentities(addslashes($_POST["clave"])); 
$perfil = 1;
$estado = 0;
$a_fecha = getdate();
$fecha = $a_fecha["year"]."-".$a_fecha["mon"]."-".$a_fecha["mday"];
$clave_cifrada = password_hash($clave, PASSWORD_DEFAULT);
$activacion_sin = rand(0, 99999);
$activacion_con = password_hash($activacion_sin, PASSWORD_DEFAULT);



$conexion = new insertarUsuario();

if($conexion->insertar_temp($nombre, $correo, $clave_cifrada, $perfil, $estado, $fecha, $activacion_con)){

    $para = $correo;
    $titulo = 'Verificación y activación de la cuenta';
    $mensaje = "¡Hola, $nombre! ABRE EL SIGUIENTE LINK PARA ACTIVAR TU CUENTA: ".$_SERVER["SERVER_NAME"]."/view/activacion.php?correo=$correo&activacion=$activacion_con.";
    $cabeceras = $cabeceras = 'From: appdondecompro@gmail.com' . "\r\n" .
    'Reply-To: zerpens.com@gmail.com' . "\r\n"; 
    mail($para, $titulo, $mensaje, $cabeceras);

    header("location: ../view/verificacion.php");

} else {

    echo 'The email message was sent.';
    
}






?>