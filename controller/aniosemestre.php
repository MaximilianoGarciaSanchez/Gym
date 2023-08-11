<?php
    require_once("../config/conexion.php");
    require_once("../models/AnioSemestre.php");
    $anio = new AnioSemestre();

    switch($_GET["op"]){
        case "combo":
            $datos = $anio->get_anio();
            $html="";
            $html.="<option label='Seleccionar'></option>
            ";
            if(is_array($datos)==true and count($datos)>0){
                // $html= "<option></option>";
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['fecha_inscripcion']."'>".$row['aniosem_nom']."</option>";
                }
                echo $html;
            }

            break;
    }
