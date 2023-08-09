<?php
    require_once("../config/conexion.php");
    require_once("../models/Semestre.php");
    $semestre = new Semestre();

    switch($_GET["op"]){
        case "combo":
            $datos = $semestre->get_semestre();
            $html="";
            $html.="<option label='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['sem_id']."'>".$row['sem_nom']."</option>";
                }
                echo $html;
            }

            break;
    }



?>