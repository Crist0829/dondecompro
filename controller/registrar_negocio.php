<?php

require_once("../model/conect_db.php");
use PHPMailer\PHPMailer\PHPMailer;
require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");



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

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'ccjd.0796@gmail.com';
    $mail->Password = 'Nathaly0829.';
    $mail->setFrom('Dondecomo@gmail.com', 'Donde compro');
    //$mail->addReplyTo('Dondecomo@gmail.com', 'DondeCaaaOmpro');
    $mail->addAddress($correo, $name);
    $mail->Subject = 'Activacion de la cuenta';
    //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body = "Ingrea a este link para activar la cuenta: http://".$_SERVER["SERVER_NAME"]."/Php/dondecompro/view/activacion.php?correo=$correo&activacion=$activacion_con";

if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

    echo 'The email message was sent.';
    header("location: ../view/verificacion.php");
    


}
}





?>