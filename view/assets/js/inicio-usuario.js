window.onload = ()=>{

    let negocios = document.getElementById("negocios")

    fetch("controller/cargar_negocios_publicidad.php")
    .then(data => data.text())
    .then(data => {

        if(parseInt(data) != 0){

            negocios.innerHTML += data

        }else{

            negocios.innerHTML += `<h4 class = "texto-verde text-center"> AÚN NO HAY NEGOCIOS CERCA DE TU UBICACIÓN </h4>`

        }


    })




}