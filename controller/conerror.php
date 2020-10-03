<?php 

/*este archivo es cargado al iniciio y muestra mensajes de error dependiendo el caso*/

if(isset($_GET["conerror"])){

        if($_GET["conerror"] == 30){

            echo "<script>

            window.onload=function() {
                
                swal('CONTRASEÑA INCORRECTA', 'Vuelve a escribir tu nombre de usuario (o email) y contraseña', 'error');
            }
            </script>";

        }else if($_GET["conerror"] == 35){

            echo "<script>

            window.onload=function() {
                
                swal('CONTRASEÑA INCORRECTA', 'No pudimos realizar los cambios, verifica tu contraseña.', 'error');
            }
            </script>";

        }else if($_GET["conerror"] == 40){

            echo "<script>

            window.onload=function() {
                
                swal('NO PUDIMOS REALIZAR LA PETICIÓN', 'Por favor, intenta más tarde.', 'error');
            }
            </script>";

        }else if($_GET["conerror"] == 45){

            echo "<script>

            window.onload=function() {
                
                swal('ERROR AL SUBIR LA IMAGEN', 'No pudimos subir la imagen, comprueba que hayas selecionado un archivo, que tenga un formato correcto y que su tamaño sea menor a 2MB', 'error');
            }
            </script>";

        }


}


?>