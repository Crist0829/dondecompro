<?php 

/*Este archivo se carga al inicio y muestra letreros de exito dependiendo el caso*/

if(isset($_GET["success"])){

    if($_GET["success"] == 10){

        echo "<script>

        window.onload=function() {
            
            swal('CONTRASEÑA ACTUALIZADA', 'Tu contraseña se cambió correctamente', 'success');
        }
        </script>";

    }elseif($_GET["success"] == 15){

        echo "<script>

        window.onload=function() {
            
            swal('HAS DADO DE ALTA  AL NEGOCIO CORRECTAMENTE', 'Ahora el negocio podrá acceder a su panel de administración.', 'success');
        }
        </script>";

    }elseif($_GET["success"] == 20){

        echo "<script>

        window.onload=function() {
            
            swal('HAS ACTUALIZADO LA INFORMACIÓN CORRECTAMENTE', '', 'success');
        }
        </script>";

    }else if($_GET["success"] == 25){

        echo "<script>

        window.onload=function() {
            
            swal('CONTRASEÑA ACTUALIZADA', 'Tu contraseña se cambió correctamente, ya puedes iniciar sesión', 'success');
        }
        </script>";

    }
}

?>