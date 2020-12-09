aux_pagina = 1;
aux2_pagina = 0;

window.onload = function(){

    document.getElementById("productos").innerHTML = "<div class = 'card-per4 text-center'> \n\
        <div></div></div>"

}

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

        document.getElementById("productos").innerHTML = ""
        
        aux_no_content = 0;

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

function anadirListado(a){

    let id = a.toString()
    let producto = document.getElementById(id).textContent
    let auxProducto = producto.replace(" ", "_")
    let miListado = document.getElementById("miListado")
    let noProductos = document.getElementById("noProductos")

    fetch("controller/consultar_indice.php")
    .then(data => data.text())
    .then(data =>{

        indice = data

        let producto2 = `

        <div class='row my-2' id='${indice}'>

        <div class = 'col-md-9'>
    
            <div class="list-group-item list-group-item-success" style='height: 3rem;'> 
         
            ${producto}
         
            </div>
         </div>

          <div class = "col-md-3">

            <div class = "list-group-item list-group-item-success-bright text-center" style='height: 3rem;'> 
         
                <button type="button" class="btn btn-success btn-floating" onclick="eliminarProducto(${indice})">
                    <i class="ti-trash"></i>
                </button> 
         
            </div>
         </div>

         </div>
          `

        fetch("controller/agregar_productos_listado.php?producto="+auxProducto)
        .then(data => data.text())
        .then(data =>{

        if(parseInt(data) == 1){

            if(noProductos.style.display == "block"){

                noProductos.style.display = "none"
        
                miListado.innerHTML += producto2

                document.getElementById("comparador").style.display = "block";

        
            }else{
        
            miListado.innerHTML += producto2

                document.getElementById("comparador").style.display = "block";  
        
            }

        }else{

            swal("No se pudo agregar el producto al listado, intentalo nuevamente");

        }

    })

    })
    
}

function eliminarProducto(a){

    let id = a.toString()
    let producto = document.getElementById(id)

    fetch("controller/eliminar_producto_listado.php?indice="+a)
    .then(data => data.text())
    .then(data => {

        if(parseInt(data) == 1){

            producto.style.display = "none";
            
            fetch("controller/consultar_contador.php")
            .then(datos => datos.text())
            .then(datos =>{

                if(parseInt(datos) < 0){

                    document.getElementById("comparador").style.display = "none";
                    document.getElementById("noProductos").style.display = "block";   


                }
                             

            })


        }else{

            alert("error")


        }


    })

}

function verListado(){

    let miListado = document.getElementById("miListado")

    fetch("controller/ver_listado.php")
    .then(data => data.text())
    .then(data =>{

        miListado.innerHTML = data

    })


}

function comparador(){

    fetch("controller/comparador.php")
    .then(data => data.text())
    .then(data => {

        if(data != ""){

            let mejoresPrecios = document.getElementById("mejoresPrecios")

            mejoresPrecios.innerHTML = data

            swal("La comparación se realizó correctamente", "Abajo podés ver los negocios que tienen los mejores precios, ten en cuenta que si algún producto tiene el precio de 0 es posible que el negocio no tenga ese producto.", "success")

        }else{

            swal("Aún no hay negocios cerca de vos, no has actualizado tu información de ubicación o es posible que cerca de tu ubicación no hayan negocios registrado, ¡Recomendá DóndeCompro a negocios cercanos a vos!")

        }

        


    })


}