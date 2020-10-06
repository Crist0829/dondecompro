<?php 

require_once("../model/base_datos_productos.php");
require_once("../model/base_datos_usuarios.php");

$extraer = new Extraer();
$codigo = $_GET["codigo"];
$negocios = array();
$precios = array();
$index= 0;
$aux = 0;

if(!isset($_GET["bajo"])){

    $precio_bajo = 0;

}else {

    $precio_bajo = $_GET["bajo"];

}


/*Se extrae el nombre de cada negocio y el precio del producto*/
foreach($extraer->extraerNegocios() as $registro){

    $id = $registro["ID"];
    $nombre_db = "productos_".$id;
    $extraer = new Precios();

    $extraer_registro = $extraer->extraerPrecio($nombre_db, $codigo);

    $negocios[$index] = [$registro["nombre"], $extraer_registro["Precio"]];

    $index += 1;

}
//------------------------------------------------------------//


//--Se llena el array con los precios obtenidos para ordenarlos--//
for($i = 0; $i < count($negocios); $i++){

    $precios[$i] = $negocios[$i][1];

}

sort($precios);
//----------------------------------------------------------------//

if($precio_bajo == 0){

    /*--Se evalua qué negocio tiene el precio más bajo
    y se muestra en pantalla los primeros 3 que 
    tenga el mismo precio*/         
    //-----------------------------------------//
    for($i = 0; $i < count($negocios); $i++){

        if($negocios[$i][1] == $precios[$precio_bajo]){


            if($aux == 3){

            break;

            }

            if($aux == 0){

                echo "<div class = 'card'>";
                echo "<p class = 'text-center'>El precio más bajo lo tiene: <strong class = 'texto-verde'> ".$negocios[$i][0]." </strong> </p><br>";
                echo "<p class= 'texto-verde text-center'>".$negocios[$i][1]."</p>";
                echo "</div>";
                $aux ++;

            }else{

                echo "<div class = 'card'>";
                echo "<p class = 'text-center'>TAMBIÉN: <strong class = 'texto-verde'> ".$negocios[$i][0]." </strong> </p><br>";
                echo "<p class= 'texto-verde text-center'>".$negocios[$i][1]."</p>";
                echo "</div>";

                $aux ++;

            }
                    
                    
            
        }
            
    }   
    //-----------------------------------------//

}else{

    /*--Se evalua qué negocio tiene el igual al segundo, tercero, cuarto
    etc (dependiendo de la variable precio_bajo)
    y se muestra en pantalla los primeros 3 que 
    tenga el mismo precio*/         
    //-----------------------------------------//
    for($i = 0; $i < count($negocios); $i++){

        if($negocios[$i][1] == $precios[$precio_bajo]){


            if($aux == 3){

            break;

            }

            if($aux == 0){

                echo "<div class = 'card-per2'>";
                echo "<p class = 'text-center'>Otro precio lo tiene: <strong class = 'texto-verde'> ".$negocios[$i][0]." </strong> </p><br>";
                echo "<p class= 'texto-verde text-center'>".$negocios[$i][1]."</p>";
                echo "</div>";
                $aux ++;

            }else{

                echo "<div class = 'card-per2'>";
                echo "<p class = 'text-center'>TAMBIÉN: <strong class = 'texto-verde'> ".$negocios[$i][0]." </strong> </p><br>";
                echo "<p class= 'texto-verde text-center'>".$negocios[$i][1]."</p>";
                echo "</div>";

                $aux ++;

            }
                    
                    
            
        }
            
    }   
    //-----------------------------------------//


}

$tope = count($precios) - 1;

echo "<div class = 'text-center'>

<div class='text-center d-inline-flex'>
<a href='#an".$codigo."'><button class='btn btn-dark btn-sm' onClick ='ocultar()'>OCULTAR</button></a>
</div>

<div class='text-center d-inline-flex card-per3'>
    <a href='#an".$codigo."'><p class = 'btn btn-success' onClick = 'otroPrecio(".$codigo.", $tope)'><i class='ti-search mr-2'></i>Más precios</p></a>
</div>

</div>";



?>