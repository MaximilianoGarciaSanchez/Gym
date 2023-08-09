<?php
    require_once("../config/conexion.php");
    require_once("../models/Carrera.php");
    $carrera = new Carrera();

    switch($_GET["op"]){
        case "combo":
            $datos = $carrera->get_carrera();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                // $html= "<option></option>";
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['id_carrera']."'>".$row['nom_carrera']."</option>";
                }
                echo $html;
            }

            break;
    }



?>