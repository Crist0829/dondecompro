<?php 

require_once("../model/base_datos_usuarios.php");

if(!isset($_POST["correo"])){

    header("location: ../index.php");

}

$correo = $_POST["correo"];

$consultar_correo = new consultarCorreo($correo);

if($consultar_correo->consultar($correo)){

    $verificacion = rand(1, 15000);
    $verificacion_con = password_hash($verificacion, PASSWORD_DEFAULT);

    $recuperar = new Recuperar();

    if($recuperar->insertarVerificacion($verificacion_con, $correo)){

        $para = $correo;
        $titulo = 'RESTABLECER CONTRASEÑA';
        $mensaje = "¡Hola! ABRE EL SIGUIENTE LINK PARA ESTABLECER UNA NUEVA CONTRASEÑA: ".$_SERVER["SERVER_NAME"]."/controller/nueva_clave.php?correo=$correo&verificacion=$verificacion_con";
        $cabeceras = $cabeceras = 'From: appdondecompro@gmail.com' . "\r\n" .
                                  'Reply-To: zerpens.com@gmail.com' . "\r\n"; 

        if(mail($para, $titulo, $mensaje, $cabeceras)){

            header("location: ../view/verificacion-2.php");

        }else{

            header("location: ../index.php?conerror=40");

        }


    }else{

        header("location: ../view/recuperar-clave.php?conerror=40");

    }

    

}else{


    header("location: ../view/recuperar-clave.php?conerror=3312");


}




?>