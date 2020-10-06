<?php

require_once("../model/base_datos_usuarios.php");


/*Variables y objeto que sirven para manipular la consulta que se hace a la base de datos */


//------------------------//
$mostrar = new Negocio(); // Este objeto es el que tiene los diferentes métodos para mostrar la tabla de negocios al cargar el documento.

$ordenar = $_GET["ordenar"]; //Se captura "ordenar" que se utilizará para ordenar la consulta de manera ascendiente o descendiente.
$entradas = $_GET["entradas"];// Se Captura el numero de entradas que va a tener la pagina de la tabla
$pagina = $_GET["pagina"];// la pagina en la que se encuentre en la paginación.


$total_filas = $mostrar->totalFilas(); //El total de filas que devuelve la consulta.

$total_paginas = ceil($total_filas/$entradas);// El total de paginas que va a tener la paginación.

$empezar = ($pagina - 1) * $entradas;//Esta es la variable que se encarga de indicarle a la consulta donde debe empezar (Se utiliza en el primer parametro del LIMIT)

//-------------------------------------//



/*Estas funciones se encargan de mostrar elementos en el tr de la tabla de negocios información de la consulta */

//--Esta función muestra el estado de la cuenta (ACTIVA O INACTIVA)--/
//-------------------//
function estado($a){

    if($a == 1){

        return "<p class='btn btn-outline-success'>ACTIVA</p>";

    }else{

        return "<p class='btn btn-outline-danger'>INACTIVA</p>";

    }

    


}
//-------------------//

/*Esta funcion muestra el botón "DAR DE ALTA" o "DAR DE BAJA" dependiendo del estado y pasa como parametro el ID y el estado
 a la función darde() que se encarga de darle de alta o de baja  a un negocio en la base de datos */
//---------------------------// 
function darDe($estado,$ID){

    if($estado == 1){

        return "<a href=# class='btn btn-outline-dark' onClick='darde($estado, $ID)'>DAR DE BAJA</a>";

    }else{

        return "<a href=# class='btn btn-outline-light' onClick='darde($estado, $ID)'>DAR DE ALTA</a>";

    }


}
//---------------------------//

/*Esta funcion carga la imagen del negocio, sino tiene imagen, carga la imagen por defecto */
//-------------------------//
function cargarImagen($a){

    if($a == null){

        return 'view/assets/media/image/user/default.png';

    }else{

        return $a;

    }

}
//-------------------------//




/*Este bucle itera sobre el recurso devuelto por el método mostrar y almacena en registro cada uno de los negocios */
//----------------------------------------------------------------------//
foreach($mostrar->mostrar($ordenar, $empezar, $entradas) as $registro){

    echo "<tr>
    <td>

        <a href='product-detail.html' class='d-flex align-items-center'>
        <img width='50' src=".cargarImagen($registro["imagen"])."
                class='rounded mr-3' alt='Vase'>
            <span>".$registro["ID"]."</span>
        </a>

    </td>

    <td>".$registro["nombre"]."</td>

    <td>".$registro["correo"]."</td>

    <td>".estado($registro["estado"])."</td>

    <td class='text-right'>

    ".darDe($registro["estado"],$registro["ID"])."

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

    echo "<td colspan = 5>
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

            echo "<td colspan=5>

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

            echo "<td colspan=5>

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

            echo "<td colspan=5>

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

    echo "<td colspan=5>

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





