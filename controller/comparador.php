<?php 
require_once("../model/base_datos_usuarios.php");
require_once("../model/base_datos_productos.php");
session_start();

$usuario = new consultarUsuario();
$usuario->consultar($_SESSION["nombre"]);
$registro_usuario = $usuario->registro;
$ID = $usuario->registro["ID"];
$info = new DatosInfoNegocio();
$negocios = new Comparador();
$negocios_p = new ComparadorProductos();
$precios = array();
$totales = array();
$aux_suma = 0;
$aux_for = 0;
$aux = "";
$aux4 = "";
$var_aux = "";
$aux5 = "";

function cImagen($a){
    
    
    if($a == null){

        return "view/assets/media/image/user/default.png";

    }else{

        return $a;

    }


}


if($registro_usuario["provincia"] != null){

    $provincia = $usuario->registro["provincia"];
    $municipio = $usuario->registro["municipio"];


    if($municipio != null){

        foreach($negocios->extraerNegociosProvinciaMunicipio($provincia, $municipio) as $negocio){

            $nombre_tabla = "productos_".$negocio["ID"];
            
            
            foreach($_SESSION["listado_productos"] as $producto){

                $precio = $negocios_p->ExtraerPrecios($nombre_tabla, $producto);

                $precios[$negocio["nombre"]][] = $precio["Precio"];

                

            }

            foreach($precios[$negocio["nombre"]] as $valor){

                $aux_suma += (float) $valor;
                
            }

            $totales[] = $aux_suma;
            $precios[$negocio["nombre"]][] = $aux_suma;
            $aux_suma = 0;



        }


        sort($totales);

        foreach($totales as $mejor_precio){

            foreach($precios as $nombre => $precio){

                if($mejor_precio === end($precio)){


                    $usuario = new consultarUsuario();
                    $usuario->consultar($nombre);
                    $ID = $usuario->registro["ID"];
                    $info = new DatosInfoNegocio();
                    $aux = "";
                    $aux2 = "";
                    $aux3 = "";



                    if($info->consultarNegocio($ID)){

    

                        if($info->registro["direccion"] != null){

                            $aux .= "
        
                                <h3><strong class = 'fa fa-street-view texto-gris m-2'> ".$info->registro["direccion"]."</strong></h3>
        
                            ";

                        }

                        if($info->registro["n_telefono"] != null){

                            $aux .= "
        
                                <h3> <strong class='fa fa-phone texto-gris m-2'> ".$info->registro["n_telefono"]." </strong></h3>
        
                            ";

                        }

    

                        $aux .= "
    
                            <h3><strong class='fa fa-money texto-gris'> ".ucfirst($info->registro["metodo_cobro"])."</strong> </h3>
    
                        ";

                        if($info->registro["envios"] != "no"){

                            $aux .=  "<h3 class='texto-gris m-2'><strong class= 'fa fa-check'>ENVÍOS</strong></h3>";
  
                        }

                    }else{

                        echo "
    
                            <h5 class = 'texto-verde m-2'>ESTA ES LA INFORMACIÓN DISPONIBLE DEL NEGOCIO</h5>
    
                        ";


                    }

                    $aux2 = "
    
                        <img src='".cImagen($usuario->registro["imagen"])."' width = '150'>
                        <h3 class = 'texto-verde'>".$usuario->registro["nombre"]."</h3>
                        <div style='padding: 0.5rem !important;'>
                                ".$aux."
                        </div>
                        ".$aux3."

                    ";

                    $aux_for2 = 0;

                    foreach($_SESSION["listado_productos"] as $listado){

                        $aux5 .= "

                            
                            <div class='texto-verde mb-1 text-center'>
                            <p>$listado : $".$precio[$aux_for2]."</p>
                            </div>
                        
                        
                        ";

                        $aux_for2 ++;

                    }

                    $aux5 .= "<div class='texto-verdemb-1 text-center'>
                    <p>TOTAL : $".end($precio)."</p>
                    </div>";

                    $aux4 = "
                        <div class = 'card d-flex flex-column align-items-center'>
                            <div class='card-header'>

                                <h3 class='m-2 texto-verde'> Información del negocio: </h3>
                            
                            </div>

                            <div class = 'card-body d-flex flex-column align-items-center'>

                                ".$aux2."

                            <div class='card'>

                            <div class='card-header'>

                            <h3 class='m-2 texto-verde'> Precios de los productos:</h3>

                            </div>

                            <div class='card-body'>
                                
                            ".$aux5."

                            </div>
                                
                            </div>

                                

                            </div>

                        </div>
                    
                    ";
                    
                    $aux5 = "";

                    echo $aux4;
                    


                }

            }

        }



    }else{

        foreach($negocios->extraerNegociosProvincia($provincia) as $negocio){

            $nombre_tabla = "productos_".$negocio["ID"];
            
            
            foreach($_SESSION["listado_productos"] as $producto){

                $precio = $negocios_p->ExtraerPrecios($nombre_tabla, $producto);

                $precios[$negocio["nombre"]][] = $precio["Precio"];

                

            }

            foreach($precios[$negocio["nombre"]] as $valor){

                $aux_suma += (float) $valor;
                
            }

            $totales[] = $aux_suma;
            $precios[$negocio["nombre"]][] = $aux_suma;
            $aux_suma = 0;

        }

        sort($totales);

        foreach($totales as $mejor_precio){

            foreach($precios as $nombre => $precio){

                if($mejor_precio === end($precio)){


                    $usuario = new consultarUsuario();
                    $usuario->consultar($nombre);
                    $ID = $usuario->registro["ID"];
                    $info = new DatosInfoNegocio();
                    $aux = "";
                    $aux2 = "";
                    $aux3 = "";



                    if($info->consultarNegocio($ID)){

    

                        if($info->registro["direccion"] != null){

                            $aux .= "
        
                                <h3><strong class = 'fa fa-street-view texto-gris m-2'> ".$info->registro["direccion"]."</strong></h3>
        
                            ";

                        }

                        if($info->registro["n_telefono"] != null){

                            $aux .= "
        
                                <h3> <strong class='fa fa-phone texto-gris m-2'> ".$info->registro["n_telefono"]." </strong></h3>
        
                            ";

                        }

    

                        $aux .= "
    
                            <h3><strong class='fa fa-money texto-gris m-2'> ".ucfirst($info->registro["metodo_cobro"])."</strong> </h3>
    
                        ";

                        if($info->registro["envios"] != "no"){

                            $aux .=  "<h3 class='texto-gris'><strong class= 'fa fa-check'>ENVÍOS</strong></h3>";
  
                        }

                    }else{

                        echo "
    
                            <h5 class = 'texto-verde'>ESTA ES TODA LA INFORMACIÓN DISPONIBLE DEL NEGOCIO</h5>
    
                        ";


                    }

                    $aux2 = "
    
                        <img src='".cImagen($usuario->registro["imagen"])."' width = '150'>
                        <h3 class = 'texto-verde m-2'>".$usuario->registro["nombre"]."</h3>
                        <div style='padding: 0.5rem !important;'>
                                ".$aux."
                        </div>
                        ".$aux3."

                    ";

                    $aux_for2 = 0;

                    foreach($_SESSION["listado_productos"] as $listado){

                        $aux5 .= "

                            
                            <div class='texto-verde mb-1 text-center'>
                            <p>$listado : $".$precio[$aux_for2]."</p>
                            </div>
                        
                        
                        ";

                        $aux_for2 ++;

                    }

                    $aux5 .= "<div class='texto-verde mb-1 text-center'>
                    <p>TOTAL : $".end($precio)."</p>
                    </div>";

                    $aux4 = "
                        <div class = 'card d-flex flex-column align-items-center'>
                            <div class='card-header'>

                                <h3 class='m-2 texto-verde'> Información del negocio: </h3>
                            
                            </div>

                            <div class = 'card-body d-flex flex-column align-items-center'>

                                ".$aux2."

                            <div class='card'>

                            <div class='card-header'>

                            <h3 class='m-2 texto-verde'> Precios de los productos:</h3>

                            </div>

                            <div class='card-body'>
                                
                            ".$aux5."

                            </div>
                                
                            </div>

                                

                            </div>

                        </div>
                    
                    ";
                    $aux5 = "";

                    echo $aux4;
                    


                }

            }

        }

        
    }



}else{


    $aux = "
    
        <p> Debes establecer tu ubicación para poder utilizarel comparador, esto 
        lo puedes hacer desde la sección ADMINISTRAR CUENTA";
    
    


}



?>