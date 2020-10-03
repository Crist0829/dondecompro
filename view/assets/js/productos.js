var aux_pagina = 1;
var aux2_pagina = 1;


window.onload = function(){

    var entradas = document.getElementById("entradas").value;
    var rubro = document.getElementById("rubro").value;

    var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
        
      }
    }
    xhttp.open("GET", "controller/mostrarproductos.php?entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
    xhttp.send();

}

function filtrar(){

    aux_pagina = 1;
    aux2_pagina = 1;

    var termino = document.getElementById("buscar").value;
    var entradas = document.getElementById("entradas").value;
    var rubro = document.getElementById("rubro").value;


    if(termino == 0){

            
            var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
        
    }
    }
        xhttp.open("GET", "controller/mostrarproductos.php?entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();
            

    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscarproductos.php?termino=" + termino + "&entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();

        }
        
}

function filtrarCambiar(){
    

    var termino = document.getElementById("buscar").value;
    var entradas = document.getElementById("entradas").value;
    var rubro = document.getElementById("rubro").value;


    if(termino == 0){

            
            var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
        
    }
    }
        xhttp.open("GET", "controller/mostrarproductos.php?entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux2_pagina, true);
        xhttp.send();
            

    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscarproductos.php?termino=" + termino + "&entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux2_pagina, true);
        xhttp.send();

        }
        
}

function siguiente(ultima){

    if(aux_pagina == ultima){

        aux_pagina = 1;

    }else{

        aux_pagina += 1;

    }
    
    aux2_pagina = aux_pagina;

    var termino = document.getElementById("buscar").value;
    var entradas = document.getElementById("entradas").value;
    var rubro = document.getElementById("rubro").value;


    if(termino == 0){

            
            var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
        
    }
    }
        xhttp.open("GET", "controller/mostrarproductos.php?entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();
            

    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscarproductos.php?termino=" + termino + "&entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();

        }
        
}

function anterior(ultima){
    
    if(aux_pagina !== 1 && aux_pagina > 1){

        aux_pagina -= 1;

    }else{

        aux_pagina = ultima;
    }

    
    aux2_pagina = aux_pagina;

    var termino = document.getElementById("buscar").value;
    var entradas = document.getElementById("entradas").value;
    var rubro = document.getElementById("rubro").value;


    if(termino == 0){

            
            var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
        
    }
    }
        xhttp.open("GET", "controller/mostrarproductos.php?entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();
            

    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscarproductos.php?termino=" + termino + "&entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();

        }
        
}

function pagina(pagina){

    
    aux_pagina = pagina;
    aux2_pagina = aux_pagina;

    var termino = document.getElementById("buscar").value;
    var entradas = document.getElementById("entradas").value;
    var rubro = document.getElementById("rubro").value;


    if(termino == 0){

            
            var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
        
    }
    }
        xhttp.open("GET", "controller/mostrarproductos.php?entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();
            

    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("productos").innerHTML = this.responseText;
            

        }   

        }

        xhttp.open("GET", "controller/buscarproductos.php?termino=" + termino + "&entradas=" + entradas + "&rubro=" + rubro + "&pagina=" + aux_pagina, true);
        xhttp.send();

        }
        
}

function cambiar(codigo){

    id = codigo.toString();

    precio = document.getElementById(id).value;

    if(precio == "" || precio == null){

        swal("¡No has hecho ningún cambio!");
        precio = document.getElementById(id).placeholder;
        return;

    }else if(isNaN(precio)){

        swal("¡Introduce un dato numérico!")
        return;

    }
    
    
    var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            if(this.responseText == "si"){

                filtrarCambiar();
    
            }else{

                return;

            }
        
      }
    }
    xhttp.open("GET", "controller/cambiarprecio.php?codigo=" + codigo + "&precio=" + precio, true);
    xhttp.send();
    

}






