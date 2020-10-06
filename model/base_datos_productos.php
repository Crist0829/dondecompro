<?php

/* Devuele un objeto que contiene
   la conexión con la base de datos*/
//-------------------------//   
class conexion_productos{

    public $conexion_db;
    public $consulta;

    public function __construct()
    {
        $this->conectar();
    }


    public function conectar(){
        require("config.php");
        try{

            $this->conexion_db = new PDO("mysql:host=$name_host; dbname=$name_bd_productos", "$user_name", "$password");
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion_db->exec("SET CHARACTER SET utf8");

        }catch(Exception $e){

            die("Error al intentar establecer conexion con la base de").$e->getMessage();

        }

    }
}
//-------------------------//



/*Es clase contiene los métodos necearios para mostrar y manipular los productos
en el panel de administración de productos*/
//------------------------------------------//
class Productos extends conexion_productos{

    public $db;

    public function __construct($nombre_db){

        $this->db = $nombre_db;
        $this->conectar();

    }


    static function consultaRubro($rubro, $empezar, $entradas, $bd){
        

        if($rubro == "TODOS"){

            return "SELECT * FROM $bd LIMIT $empezar, $entradas";

        }else{

            return "SELECT * FROM $bd WHERE Rubro = :rubro LIMIT $empezar, $entradas";

        }

    }

    static function consultaRubroNFILAS($rubro, $db){

        if($rubro == "TODOS"){

            return "SELECT * FROM $db";

        }else{

            return "SELECT * FROM $db WHERE Rubro = :rubro";

        }

    }

    static function consultaRubroBusqueda($rubro, $empezar, $entradas, $db){

        if($rubro == "TODOS"){

            return "SELECT * FROM  $db WHERE Descripcion LIKE ? LIMIT $empezar, $entradas";;

        }else{

            return "SELECT * FROM  $db WHERE Descripcion LIKE ? AND Rubro = ? LIMIT $empezar, $entradas";

        }

    }

    static function consultaRubroBusquedaNFILAS($rubro, $db){

        if($rubro == "TODOS"){

            return "SELECT * FROM  $db WHERE Descripcion LIKE ?";

        }else{

            
            return "SELECT * FROM  $db WHERE  Descripcion LIKE ? AND Rubro = ?";

        }

    }


    static function bindValueRubro($rubro, $resultado){

        if($rubro == "TODOS"){

            return 1;

        }else{

            
            $resultado->bindValue(":rubro", $rubro);

        }
        
    }

    static function bindValueRubroBusqueda($rubro, $resultado, $termino){

        if($rubro == "TODOS"){

            $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);

        }else{

            $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);
            $resultado->bindValue(2, "$rubro", PDO::PARAM_STR);

        }
        
    }

    
    public function mostrar($rubro, $empezar, $entradas){

        $this->consulta = $this::consultaRubro($rubro, $empezar, $entradas, $this->db);
        

        $resultado = $this->conexion_db->prepare($this->consulta);
        $this::bindValueRubro($rubro, $resultado);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }


    
    public function buscar($termino, $rubro, $empezar, $entradas){

        
        $this->consulta = $this::consultaRubroBusqueda($rubro, $empezar, $entradas, $this->db);

        $resultado = $this->conexion_db->prepare($this->consulta);
        $this::bindValueRubroBusqueda($rubro, $resultado, $termino);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }


    public function totalFilas($rubro){

        $this->consulta = $this::consultaRubroNFILAS($rubro, $this->db);

        $resultado = $this->conexion_db->prepare($this->consulta);
        $this::bindValueRubro($rubro, $resultado);
        $resultado->execute();

        return $resultado->rowCount();

    }

    public function totalFilasBusqueda($termino, $rubro){

        $this->consulta = $this::consultaRubroBusquedaNFILAS($rubro, $this->db);

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);
        $this::bindValueRubroBusqueda($rubro, $resultado, $termino);
        $resultado->execute();

        return $resultado->rowCount();
    }


    public function cambiarPrecio($precio, $codigo){

        $this->consulta = "UPDATE $this->db SET Precio = :precio WHERE Codigo = :codigo";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":precio" => $precio, ":codigo" => $codigo));
        
        return $resultado->rowCount();

    }

}
//------------------------------------------//


class CrearTabla extends conexion_productos{

    public function duplicar($nombre){

        $this->consulta = "CREATE TABLE $nombre LIKE productos_base";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        $resultado->closeCursor();
    }

    public function insertar($nombre){

        $this->consulta = "INSERT INTO $nombre SELECT * FROM productos_base";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();
        $resultado->closeCursor();

    }




}


class Precios extends conexion_productos{

    public function buscar($termino, $empezar, $entradas){

        
        $this->consulta = "SELECT *  FROM  productos_base WHERE Descripcion LIKE ?  LIMIT $empezar, $entradas";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public function totalFilasBusqueda($termino){

        
        $this->consulta = "SELECT Descripcion, Rubro  FROM  productos_base WHERE Descripcion LIKE ?";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(1, "%$termino%", PDO::PARAM_STR);
        $resultado->execute();

        return $resultado->rowCount();
    
    }

    public function extraerPrecio($nombre_db, $codigo){

        $this->consulta = "SELECT * FROM $nombre_db where Codigo = :codigo";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":codigo" => $codigo));

        $registro = $resultado->fetch(PDO::FETCH_ASSOC);

        $resultado->closeCursor();

        return $registro;

    }

}





?>