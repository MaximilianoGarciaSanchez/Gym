<?php 
    class Carrera extends Conectar{

        public function get_carrera(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_carrera WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }

?>