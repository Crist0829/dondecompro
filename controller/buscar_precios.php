<?php 

require_once("../model/base_datos_productos.php");

require_once("../model/base_datos_usuarios.php");

$busqueda = new Precios();

$termino = $_GET["termino"];// El termino de la busqueda.
$entradas = 5; // El total de entradas que se verán en pantalla.
$pagina = $_GET["pagina"];// la pagina en la que se encuentre en la paginación.


$total_filas = $busqueda->totalFilasBusqueda($termino); //El total de filas que devuelve la consulta.
$total_paginas = ceil($total_filas/$entradas);// El total de paginas que va a tener la paginación.
$empezar = ($pagina - 1) * $entradas; // Determina desde donde empieza la consulta para mostrar las entradas de página (paginación).


/*Este bucle itera sobre el recurso devuelto por el método buscar y almacena 
                en registro cada uno de los negocios */
//----------------------------------------------------------------------//
foreach($busqueda->buscar($termino, $empezar, $entradas) as $registro){

    echo "<tr id = 'an".$registro["Codigo"]."'>
            <td> 
                    <div>
                        <p class = 'texto-verde-peque'>".$registro["Descripcion"]."</p>
                    </div>

                    <div>
                        <button class='btn btn-success' onClick ='comparar(".$registro["Codigo"].")'>¡EL MEJOR PRECIO!</button>
                    </div>

                    <div id = '".$registro["Codigo"]."'> 
                    </div>
                    <hr class = 'hr-per'>

            </td>
    </tr>";
    
}
//----------------------------------------------------------------------//



//-------------------------------Paginación----------------------------------------//

if($pagina <= 0){

    $pagina = 1;

}

$activa = $pagina;

if(($pagina + 2) % 3 == 0){

    $primera_pagina = $pagina;
    $segunda_pagina = $primera_pagina + 1;
    $tercera_pagina = $primera_pagina + 2;

}else if(($pagina + 1) % 3 == 0){

    $segunda_pagina = $pagina;
    $primera_pagina = $segunda_pagina - 1;
    $tercera_pagina = $segunda_pagina + 1;

}else{

    $tercera_pagina = $pagina;
    $primera_pagina = $tercera_pagina - 2;
    $segunda_pagina = $tercera_pagina - 1;

}

function active($pagina){
    global $activa;

    if($pagina == $activa){

        return "page-item active";

    }else{

        return "page-item";

    }


}

function atras($pagina){

    if($pagina > 1){

        return "<li>
                    <p> . . . </p>
                </li>";
    }

}

function adelante($pagina){

    global $total_paginas;

    if($pagina < $total_paginas){

        return "<li>
                    <p> . . . </p>
                </li>";

    }

}

if($total_paginas == 0){

    echo "<td colspan = 3>
    <div aria-label='...' class='d-flex justify-content-center'>
        <ul class='pagination pagination-rounded d-flex align-self-baseline'>
            <li class='page-item' >
                <a class='page-link' href='#'>
                    <i class='ti-angle-left'></i>
                </a>
            </li>

            <li class='page-item' >
                <a class='page-link' href='#' >
                <i class='ti-angle-right'></i>
                </a>
            </li>

        </ul>
    </div>

    </td>";


}else if($total_paginas <= 3){

    switch($total_paginas){

        case 1: 

            echo "<td colspan=3>

                    <div aria-label='...' class='d-flex justify-content-center'>
                        <ul class='pagination pagination-rounded d-flex align-self-baseline'>
    
                            <li class='".active($primera_pagina)."'btn-outline-youtube>
                                <a class='page-link active' href='#' onClick = 'pagina(".$primera_pagina.")'>".$primera_pagina."</a>
                            </li>
    
                        </ul>
                    </div>
    
                    </td>";
        break;

        case 2:

            echo "<td colspan=3>

            <div aria-label='...' class='d-flex justify-content-center'>
                <ul class='pagination pagination-rounded d-flex align-self-baseline'>
    
                    <li class='".active($primera_pagina)."'btn-outline-youtube>
                <a class='page-link active' href='#' onClick = 'pagina(".$primera_pagina.")'>".$primera_pagina."</a>
                    </li>
    
                    <li class='".active($segunda_pagina)."'>
                        <a class='page-link' href='#' onClick = 'pagina(".$segunda_pagina.")'>".$segunda_pagina."</a>
                    </li>
    
                </ul>
            </div>
    
            </td>";

        break;

        case 3:

            echo "<td colspan=3>

                    <div aria-label='...' class='d-flex justify-content-center'>
                        <ul class='pagination pagination-rounded d-flex align-self-baseline'>
    
                            <li class='".active($primera_pagina)."'btn-outline-youtube>
                                <a class='page-link active' href='#' onClick = 'pagina(".$primera_pagina.")'>".$primera_pagina."</a>
                            </li>
    
                            <li class='".active($segunda_pagina)."'>
                                <a class='page-link' href='#' onClick = 'pagina(".$segunda_pagina.")'>".$segunda_pagina."</a>
                            </li>
    
                            <li class='".active($tercera_pagina)."'>
                                <a class='page-link' href='#' onClick = 'pagina(".$tercera_pagina.")'>".$tercera_pagina."</a>
                            </li>
    
                        </ul>
                    </div>
    
                </td>";
        break;


    }
    

}else{

    echo "<td colspan=3>

    <div aria-label='...' class='d-flex justify-content-center'>
        <ul class='pagination pagination-rounded d-flex align-self-baseline'>
            <li class='page-item' >
                <a class='page-link' href='#' onClick='anterior(".$total_paginas.")'>
                    <i class='ti-angle-left'></i>
                </a>
            </li>
    
            ".atras($primera_pagina)."
    
            <li class='".active($primera_pagina)."'btn-outline-youtube>
                <a class='page-link active' href='#' onClick = 'pagina(".$primera_pagina.")'>".$primera_pagina."</a>
            </li>
    
            <li class='".active($segunda_pagina)."'>
                <a class='page-link' href='#' onClick = 'pagina(".$segunda_pagina.")'>".$segunda_pagina."</a>
            </li>
    
            <li class='".active($tercera_pagina)."'>
                <a class='page-link' href='#' onClick = 'pagina(".$tercera_pagina.")'>".$tercera_pagina."</a>
            </li>
    
            ".adelante($tercera_pagina)."
    
            <li class='page-item' >
                <a class='page-link' href='#' onClick='siguiente(".$total_paginas.")'>
                <i class='ti-angle-right'></i>
                </a>
            </li>
    
        </ul>
    </div>
    
    </td>";

}

//----------------------------------------------------------------------------------//


?>