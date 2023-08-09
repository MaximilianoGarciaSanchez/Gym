<?php
    require_once("../config/conexion.php");
    require_once("../models/Genero.php");
    $genero = new Genero();

    switch($_GET["op"]){
        case "combo":
            $datos = $genero->get_genero();
            $html="";
            $html.="<option label='Seleccionar'></option>
            ";
            if(is_array($datos)==true and count($datos)>0){
                // $html= "<option></option>";
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['gen_id']."'>".$row['gen_nombre']."</option>";
                }
                echo $html;
            }

            break;
    }



?>