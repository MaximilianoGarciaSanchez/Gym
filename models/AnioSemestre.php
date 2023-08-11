<?php 
    class AnioSemestre extends Conectar{

        public function get_anio(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_anio WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }

?>