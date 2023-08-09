<?php 
    class Genero extends Conectar{

        public function get_genero(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_genero WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }

?>