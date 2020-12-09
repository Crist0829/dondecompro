<?php

/* Devuele un objeto que contiene
   la conexión con la base de datos*/
//--------------//   
class conexion{

    public $conexion_db;
    public $consulta;

    public function __construct()
    {
        $this->conectar();
    }


    public function conectar(){
        require("config.php");
        try{

            $this->conexion_db = new PDO("mysql:host=$name_host; dbname=$name_bd", "$user_name", "$password");
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion_db->exec("SET CHARACTER SET utf8");

        }catch(Exception $e){

            die("Error al intentar establecer conexion con la base de datos").$e->getMessage();

        }

    }
}
//--------------//


//---Establece una conexión y métodos para validar el login---//
class login extends conexion{

    /*En esta propieda se almacena el recurso que se obtiene
    de una consulta*/
    //----------------//
    private $registro;
    //----------------//
    
    /*Este método recibe dos parametros, $valor que puede ser el nombre de usuario o correo
    y $clave, luego llama a dos métodos privados que se encargan de evaluar si existe el nombre de usuario
    o correo y si es así, evaluan si la contraseña ($clave) coincide con la de la base de datos y
    retorna un valor (0, 1, 2) dependiendo del resultado de la consulta */
    //-------------------------------------------//
    public function validate($valor, $clave){

        /*--Llama al método prueba_nombre y si retorna un valor mayor a 0
            entonces evalua con un switch las dos posibilidades*/
        if($nombre = $this->prueba_nombre($valor, $clave)){

            switch($nombre){

                case 1: return 1; break;
                case 2: return 2; break;

            }

            /*Si el método prueba_nombre retorna cero
              se evalua si el método prueba_correo
              retorna un valor mayor a 0 y si es así
              se evalua las dos posibilidades con un switch */
            }else if($correo = $this->prueba_correo($valor,$clave)){

            switch($correo){

                case 1: return 1; break;
                case 2: return 2; break;

            }

        }else{

            /*Si tanto el método prueba_nombre y prueba_correo retornan cero, 
              entonces se retorna 0*/
            return 0;

        }
               
    }
    //-------------------------------------------//


    /*Este método evalua si el nombre está en la base de datos
    sino es así retorna 0, si es así evalua si la contraseña
    coincide y sino es así, retorna 0, si es así
    evalua si el el ID es igual a 1 y si es así
    retorna 2 y si no es así, retorna 1*/
    //----------------------------------------------//
    private function prueba_nombre($nombre, $clave){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE nombre = :nombre";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre",  $nombre);
        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($nombre, $this->registro["nombre"]) == 0){

                if(password_verify($clave, $this->registro["clave"])){

                    if($this->registro["ID"] == 1){

                        return 2;

                    }else{

                        return 1;

                    }

                }

            }else{

                return 0;

            }

        }else{

            return 0;

        }


    }
    //----------------------------------------------//

    /*Este método evalua si el correo está en la base de datos
    sino es así retorna 0, si es así evalua si la contraseña
    coincide y sino es así, retorna 0, si es así
    evalua si el el ID es igual a 1 y si es así
    retorna 2 y si no es así, retorna 1*/
    //----------------------------------------------//
    private function prueba_correo($correo, $clave){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE correo = :correo";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":correo",  $correo);
        $resultado->execute();
    
        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($correo, $this->registro["correo"]) == 0){

                if(password_verify($clave, $this->registro["clave"])){

                    if($this->registro["ID"] == 1){

                        return 2;

                    }else{

                        return 1;

                    }

                }

            }else{

                return 0;

            }

        }else{

            return 0;

        }

    
    }
    //----------------------------------------------//

    //Devuelve el registro (recurso)
    public function getRegistro(){

        return $this->registro;

    }


}
//--------------------------------------------------------------//


/*Tiene el método para insertar un usuario nuevo
  con los difentes datos obtenidos del formulario*/
//--------------------------------------//
class insertarUsuario extends conexion{
    

    public function insertar_db($nombre, $correo, $clave, $perfil, $estado, $fecha){

        $this->consulta = "INSERT INTO usuarios_bd (nombre, correo, clave, perfil, estado, fecha) values (:nombre, :correo, :clave, :perfil, :estado, :fecha)";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":nombre"=>$nombre, ":correo" => $correo, ":clave" => $clave, ":perfil" => $perfil, ":estado" => $estado, ":fecha" => $fecha));

        $resultado->closeCursor();

        return 1;
    
    }

    public function insertar_temp($nombre, $correo, $clave, $perfil, $estado, $fecha, $activacion){

        $this->consulta = "INSERT INTO usuarios_temp (nombre, correo, clave, perfil, estado, fecha, activacion) values (:nombre, :correo, :clave, :perfil, :estado, :fecha, :activacion)";
        
        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":nombre"=>$nombre, ":correo" => $correo, ":clave" => $clave,
                                 ":perfil" => $perfil,":estado" => $estado, ":fecha" => $fecha, ":activacion" => $activacion));

        $resultado->closeCursor();

        return 1;
    
    }
}
//--------------------------------------//


/*Estas clases contienen los métodos necesarios
para consultar si existe un usuario con el nombre o correo
escritos*/
//---------------------------------------//
class consultarUsuario extends conexion{

    public $registro;
    protected $db = "usuarios_bd";

    public function consultar($nombre){

        $consulta = "SELECT * FROM ".$this->db." where nombre = :nombre";
        $resultado = $this->conexion_db->prepare($consulta);

        $resultado->bindValue(":nombre", $nombre);

        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($nombre, $this->registro["nombre"]) == 0){

                $resultado->closeCursor();
                return 1;

                }
            

            $resultado->closeCursor();
            return 0;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }


    public function verificarClave($clave){

        if(password_verify($clave, $this->registro["clave"])){

            return 1;

        }else{

            return 0;

        }
        


    }

    public function setDB($db){

        $this->db = $db;

    }

    public function consultarEstado($nombre){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE perfil = 1 AND nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();

        $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

        return $this->registro["estado"];

    }

    public function datos($nombre){

        $this->consulta = "SELECT * FROM ".$this->db." where nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();

        $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

        $resultado->closeCursor();

        return $this->registro;

    }

    public function consultarProvinciaMunicipio($provincia, $municipio){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE perfil = 1 AND provincia ="."'".$provincia."'"."  AND municipio ="."'".$municipio."'"."" ;
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function consultarProvincia($provincia){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE perfil = 1 AND provincia ="."'".$provincia."'"."  AND municipio is null";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }


}

class consultarCorreo extends consultarUsuario{


    public function consultar($correo){

        $consulta = "SELECT * FROM ".$this->db." where correo = :correo";

        $resultado = $this->conexion_db->prepare($consulta);

        $resultado->bindValue(":correo", $correo);

        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($correo, $this->registro["correo"]) == 0){

                $resultado->closeCursor();
                 return 1;

            }

            $resultado->closeCursor();
            return 0;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }

    public function datos($correo){

        $this->consulta = "SELECT * FROM ".$this->db." where correo = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $correo);
        $resultado->execute();

        $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

        $resultado->closeCursor();

        return $this->registro;

    }

    public function consultarNombreCorreo($correo, $nombre){

        $consulta = "SELECT * FROM ".$this->db." where nombre = :nombre AND correo = :correo";

        $resultado = $this->conexion_db->prepare($consulta);

        $resultado->bindValue(":correo", $correo);
        $resultado->bindValue(":nombre", $nombre);

        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($correo, $this->registro["correo"]) == 0){

                $resultado->closeCursor();
                 return 1;

            }

            $resultado->closeCursor();
            return 0;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }



}
//---------------------------------------//


/*Esta clase contiene los métodos necesarios para 
verificar en link de activación de la cuenta*/
//------------------------------------------------/
class VerificacionActivacion extends conexion{

    private $registro;
    public $activacion;

    public function __construct($activacion){

        $this->conectar();
        $this->activacion = $activacion;

    }

    
    public function verificar($correo){

        $this->consulta = "SELECT * FROM usuarios_temp WHERE activacion = :activacion AND correo = :correo";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":activacion", $this->activacion);
        $resultado->bindValue(":correo", $correo);

        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            $resultado->closeCursor();

            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function eliminarTMP(){

        $this->consulta= "DELETE from usuarios_temp WHERE activacion = :activacion";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":activacion", $this->activacion);

        $resultado->execute();

    }


    public function insertarDB(){

        $this->consulta= "INSERT INTO usuarios_bd (nombre, correo, clave, perfil, estado, fecha) VALUES (:nombre, :correo, :clave, :perfil, :estado, :fecha)";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":nombre" => $this->registro["nombre"], ":correo" => $this->registro["correo"],
                                  ":clave" => $this->registro["clave"], ":perfil" => $this->registro["perfil"],
                                  ":estado" => $this->registro["estado"], ":fecha" => $this->registro["fecha"]));

    } 


    public function getRegistro(){

        return $this->registro;

    }

}
//------------------------------------------------/


/*Estas clases contienen los métodos necesarios para 
 actualizar los datos de cuenta*/
//---------------------------------------------//
class ActualizarDatos extends conexion{

    private $registro;

    public function verificarClave($nombre, $clave){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(password_verify($clave, $this->registro["clave"])){

                $resultado->closeCursor();
                return 1;

            }else{

                $resultado->closeCursor();
                return 0;

            }

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function actualizar($nombre, $correo){
        
        $oldnombre = $this->registro["nombre"];
        $this->consulta = "UPDATE usuarios_bd SET nombre = :nombre, correo = :correo WHERE nombre = :oldnombre";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre" => $nombre, ":correo" => $correo, ":oldnombre" => $oldnombre));

        if($resultado->rowCount() > 0){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function nuevaConsulta($nombre, $correo){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE nombre = :nombre AND correo = :correo";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre"=>$nombre, ":correo" => $correo));

        if($resultado->rowCount() > 0){

            $this->registro= $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function getRegistro(){

        return $this->registro;

    }


}


class CambiarImagen extends conexion{

    public function cambiar($nombre, $rutaimagen){

        $this->consulta = "UPDATE usuarios_bd SET imagen = :imagen WHERE nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":imagen" => $rutaimagen, ":nombre" => $nombre));

        if($resultado->rowCount() > 0){

            $resultado->closeCursor(); 
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }

    public function eliminar($nombre){

        $this->consulta = "UPDATE usuarios_bd SET imagen = NULL where nombre = :nombre";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();


        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;
    
        }
    }


}


class CambiarClave extends ActualizarDatos{

    public function actualizar($nombre, $clave){

        $this->consulta = "UPDATE usuarios_bd SET clave = :clave WHERE nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->bindValue(":clave", $clave);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }

}

class Ubicacion extends conexion{

    public function consultarInfoNegocio($ID){

        $this->consulta = "SELECT * FROM info_negocios WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{


            $resultado->closeCursor();
            return 0;

        }

    }

    public function actualizarProvinciaMunicipio($ID, $provincia, $municipio){

        $this->consulta = "UPDATE usuarios_bd SET provincia = :provincia, municipio = :municipio WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":provincia" => $provincia, ":municipio" => $municipio));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function actualizarProvincia($ID, $provincia){

        $this->consulta = "UPDATE usuarios_bd SET provincia = :provincia WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":provincia", $provincia);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }


    }

    public function actualizarDireccion($ID, $direccion){

        $this->consulta = "UPDATE info_negocios SET direccion = :direccion where ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":direccion", $direccion);
        $resultado->execute();
        $resultado->closeCursor();

    }

    public function InsertarDireccion($ID, $direccion){

        $this->consulta = "INSERT INTO info_negocios (direccion, ID) VALUES (:direccion, $ID)";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":direccion", $direccion);
        $resultado->execute();
        $resultado->closeCursor();

    }

    public function eliminarMunicipio($ID){

        $this->consulta = "UPDATE usuarios_bd SET municipio = null where ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();
        $resultado->closeCursor();


    }
}

class InfoNegocio extends conexion{

    public function actualizarInfo($telefono, $envios, $cobro, $ID){

        $this->consulta = "UPDATE info_negocios SET n_telefono = :telefono, envios = :envios, metodo_cobro = :cobro WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":telefono" => $telefono, ":envios" => $envios, ":cobro" => $cobro));
        
        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function actualizarPromos($ID, $promos){

        $this->consulta = "UPDATE info_negocios SET promociones = :promos WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":promos", $promos);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }


    }


}
//--------------------------------------------//


class DatosInfoNegocio extends conexion{

    public function consultarNegocio($ID){

        $this->consulta = "SELECT * FROM info_negocios WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{


            $resultado->closeCursor();
            return 0;

        }

    }

    public function consultarNegocioDB($ID){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{


            $resultado->closeCursor();
            return 0;

        }

    }



}


class Subscripcion extends conexion{

    public function consultarSubscripcion($ID){

        $this->consulta = "SELECT * FROM subscripcion_activa where ID = $ID";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }
}

class Comparador extends conexion{

    public function extraerNegociosProvincia($provincia){

        $this->consulta = "SELECT * FROM usuarios_bd where perfil = 1 AND provincia = :provincia";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":provincia", $provincia);
        $resultado->execute();
        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $resultado->closeCursor();
        return $this->registro;


    }

    public function extraerNegociosProvinciaMunicipio($provincia, $municipio){

        $this->consulta = "SELECT * FROM usuarios_bd where perfil = 1 AND provincia = :provincia AND municipio = :municipio";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":provincia", $provincia);
        $resultado->bindValue(":municipio", $municipio);
        $resultado->execute();
        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $resultado->closeCursor();
        return $this->registro;


    }

}


/*Estas clases contienen los métodos necearios para mostrar y manipular los negocios
en el panel de administración de negocios */
//--------------------------------//
class Negocio extends conexion{

    

    public function mostrar($ordenar, $empezar, $entradas){

        $this->consulta = "SELECT ID, nombre, correo, estado, imagen FROM  usuarios_bd WHERE perfil = 1 ORDER BY nombre $ordenar LIMIT $empezar, $entradas";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }


    

    public function darDeAlta($ID){

        $this->consulta = "UPDATE usuarios_bd SET estado = 1 WHERE ID = :ID";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":ID", $ID);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            return 1;

        }else{

            return 0;

        }

    }

    public function darDeBaja($ID){

        $this->consulta = "UPDATE usuarios_bd SET estado = 0 WHERE ID = :ID";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":ID", $ID);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            return 1;

        }else{

            return 0;

        }

    }

    public function buscar($termino, $ordenar, $empezar, $entradas){

        
        $this->consulta = "SELECT ID, nombre, correo, estado, imagen FROM  usuarios_bd WHERE perfil = 1 AND nombre LIKE ? ORDER BY nombre $ordenar LIMIT $empezar, $entradas";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }


    public function totalFilas(){

        $this->consulta = "SELECT * FROM usuarios_bd where perfil = 1";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute();

        return $resultado->rowCount();

    }

    public function totalFilasBusqueda($termino){

        $this->consulta = "SELECT ID, nombre, correo, estado, imagen FROM  usuarios_bd WHERE perfil = 1 AND nombre LIKE ?";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);
        $resultado->execute();

        return $resultado->rowCount();
    }

}

class Extraer extends conexion{

    public $registro;


    public function extraerNegocios(){

        $this->consulta = "SELECT * FROM usuarios_bd WHERE perfil = 1 AND estado = 1";
        
        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $this->registro;

    }


}
//--------------------------------//

class Recuperar extends conexion{

    public function insertarVerificacion($verificacion, $correo){

        $this->consulta = "INSERT INTO recuperar_clave (verificacion, correo) values (:verificacion, :correo)";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":verificacion", $verificacion);
        $resultado->bindValue(":correo", $correo);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;
        }else{

            $resultado->closeCursor();
            return  0;

        }


    }

    public function verificarCorreoVeri($correo, $verificacion){

        $this->consulta = "SELECT * FROM recuperar_clave where correo = :correo AND verificacion = :verificacion";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":correo", $correo);
        $resultado->bindValue(":verificacion", $verificacion);
        
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;
        }else{

            $resultado->closeCursor();
            return  0;

        }
    }

    public function insertarClave($correo, $clave){

        $this->consulta = "UPDATE usuarios_bd SET clave = :clave WHERE correo = :correo";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":correo" => $correo, ":clave" => $clave));

        if($resultado->rowCount() > 0){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }


    }

    public function borrarCorreoVeri($correo){

        $this->consulta = "DELETE FROM recuperar_clave WHERE correo = :correo";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":correo", $correo);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

}



?>