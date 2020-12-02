<?php 
require_once("../model/base_datos_usuarios.php");
session_start();

$usuario = new consultarUsuario();
$usuario->consultar($_SESSION["nombre"]);
$registro_usuario = $usuario->registro;
$ID = $usuario->registro["ID"];
$info = new DatosInfoNegocio();
$aux = "";

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

    if($municipio == null){

        if($usuario->consultarProvincia($provincia)){

            $registro_negocios = $usuario->registro;
            $subscripcion = new Subscripcion();
    
            foreach($registro_negocios as $registro){
                
                $aux3 = "";
                $aux2 =  "";
                

                $ID = $registro["ID"];
                
                if($subscripcion->consultarSubscripcion($ID)){
    
                    if($info->consultarNegocio($ID)){
    
                        if($info->registro["direccion"] != null){
    
                            $aux2 .= "
                            
                                <h3><strong class = 'fa fa-street-view texto-gris'> ".$info->registro["direccion"]."</strong></h3>
                            
                            ";
                    
                        }
                    
                        if($info->registro["n_telefono"] != null){
                    
                            $aux2 .= "
                            
                                <h3> <strong class='fa fa-phone texto-gris'> ".$info->registro["n_telefono"]." </strong></h3>
                            
                            ";
                    
                        }
                    
                        
                        $aux2 .= "
                        
                            <h4><strong class='fa fa-money texto-gris'> ".strtoupper($info->registro["metodo_cobro"])."</strong> </h4>
                        
                        ";


                        if($info->registro["envios"] != "no"){
                    
                            $aux2 .=  "<h3 class='texto-gris'><strong class= 'fa fa-check'>ENVÍOS</strong></h3>";
                      
                          }
                    
                        if($info->registro["promociones"] != null){
                    
                            $aux2 .= "
                            
                                <div class = 'card-per text-center'>
                                <h5>INFO Y PROMOCIONES:</h5>
                    
                                <p class = 'texto-gris text-center'>".$info->registro["promociones"]."</p>
                                </div>
                            
                            ";
                    
                        }

                        $aux3 = "<div> $aux2 </div>";
                    
                        $aux .= "
                            <div class = 'col-md-6'>
    
                                <div class ='card'>
                                    <div class = 'card-body d-flex flex-column align-items-center'>
                                    <img class = 'text-center' src='".cImagen($registro["imagen"])."' width = 150>
                                    <h3 class = 'texto-verde'>".$registro["nombre"]."</h3>
                                        ".$aux3."
                                    </div>
                                </div>
    
                            </div>
                            ";
    
    
    
                    }else{
    
    
                        $aux = 0;
    
                    }
                    
    
    
                    
    
    
                }else{
    
                    $aux = 0;
    
                }
    
    
    
    
            }
    
    
        }else{
    
            $aux = 0;
    
        }


    }else{

        if($usuario->consultarProvinciaMunicipio($provincia, $municipio)){

            $registro_negocios = $usuario->registro;
            $subscripcion = new Subscripcion();
    
            foreach($registro_negocios as $registro){
                
                $aux3 = "";
                $aux2 =  "";
                

                $ID = $registro["ID"];
                
                if($subscripcion->consultarSubscripcion($ID)){
    
                    if($info->consultarNegocio($ID)){
    
                        if($info->registro["direccion"] != null){
    
                            $aux2 .= "
                            
                                <h3><strong class = 'fa fa-street-view texto-gris'> ".$info->registro["direccion"]."</strong></h3>
                            
                            ";
                    
                        }
                    
                        if($info->registro["n_telefono"] != null){
                    
                            $aux2 .= "
                            
                                <h3> <strong class='fa fa-phone texto-gris'> ".$info->registro["n_telefono"]." </strong></h3>
                            
                            ";
                    
                        }
                    
                        
                        $aux2 .= "
                        
                            <h4><strong class='fa fa-money texto-gris'> ".strtoupper($info->registro["metodo_cobro"])."</strong> </h4>
                        
                        ";


                        if($info->registro["envios"] != "no"){
                    
                            $aux2 .=  "<h3 class='texto-gris'><strong class= 'fa fa-check'>ENVÍOS</strong></h3>";
                      
                          }
                    
                        if($info->registro["promociones"] != null){
                    
                            $aux2 .= "
                            
                                <div class = 'card-per text-center'>
                                <h5>INFO Y PROMOCIONES:</h5>
                    
                                <p class = 'texto-gris text-center'>".$info->registro["promociones"]."</p>
                                </div>
                            
                            ";
                    
                        }

                        $aux3 = "<div> $aux2 </div>";
                    
                        $aux .= "
                            <div class = 'col-md-6'>
    
                                <div class ='card'>
                                    <div class = 'card-body d-flex flex-column align-items-center'>
                                    <img class = 'text-center' src='".cImagen($registro["imagen"])."' width = 150>
                                    <h3 class = 'texto-verde'>".$registro["nombre"]."</h3>
                                        ".$aux3."
                                    </div>
                                </div>
    
                            </div>
                            ";
    
    
    
                    }else{
    
    
                        $aux = 0;
    
                    }
                    
    
    
                    
    
    
                }else{
    
                    $aux = 0;
    
                }
    
    
    
    
            }
    
    
        }else{
    
            $aux = 0;
    
        }



    }

    



}else{


    $aux = 0;


}





echo $aux;

?>