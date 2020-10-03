aux_pagina = 1;
aux2_pagina = 0;

function buscar(){

    var termino = document.getElementById("termino").value;



    if(termino == ""){

        document.getElementById("productos").innerHTML = "";


    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscar_precios.php?termino=" + termino + "&pagina=" + aux_pagina, true);
        xhttp.send();


    }

    


}

function anterior(ultima){

    if(aux_pagina !== 1 && aux_pagina > 1){

        aux_pagina -= 1;

    }else{

        aux_pagina = ultima;
    }

    var termino = document.getElementById("termino").value;



    if(termino == ""){

        document.getElementById("productos").innerHTML = "";


    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscar_precios.php?termino=" + termino + "&pagina=" + aux_pagina, true);
        xhttp.send();


    }

}

function siguiente(ultima){

    if(aux_pagina == ultima){

        aux_pagina = 1;

    }else{

        aux_pagina += 1;

    }

    var termino = document.getElementById("termino").value;



    if(termino == ""){

        document.getElementById("productos").innerHTML = "";


    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscar_precios.php?termino=" + termino + "&pagina=" + aux_pagina, true);
        xhttp.send();


    }

}

function pagina(pagina){

    aux_pagina = pagina;

    var termino = document.getElementById("termino").value;



    if(termino == ""){

        document.getElementById("productos").innerHTML = "";


    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscar_precios.php?termino=" + termino + "&pagina=" + aux_pagina, true);
        xhttp.send();


    }

}

function comparar(codigo){

    var id = codigo.toString();

    var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById(id).innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/comparador.php?codigo=" + codigo, true);
        xhttp.send();

        document.getElementById(id).innerHTML = "<div class = 'card-per2 text-center'> \n\
        <div class='spinner-border text-success' role='status'> <span class='sr-only'>Espera...</span></div>";


    

}

function ocultar(){

    var termino = document.getElementById("termino").value;



    if(termino == ""){

        document.getElementById("productos").innerHTML = "";


    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscar_precios.php?termino=" + termino + "&pagina=" + aux_pagina, true);
        xhttp.send();


    }



}

function otroPrecio(codigo, tope){

    if(aux2_pagina == tope){

        aux2_pagina = 0;

    }else{

        aux2_pagina ++;

    }

    
    var id = codigo.toString();

    var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById(id).innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/comparador.php?codigo=" + codigo + "&bajo=" + aux2_pagina, true);
        xhttp.send();

        document.getElementById(id).innerHTML = "<div class = 'card-per2 text-center'> \n\
        <div class='spinner-border text-success' role='status'> <span class='sr-only'>Espera...</span></div>";


    

}