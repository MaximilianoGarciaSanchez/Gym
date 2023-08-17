<?php
    require_once("../config/conexion.php");
    require_once("../models/Alumno.php");
    $alumno = new Alumno();

    switch($_GET["op"]){
        
        case "insert":
            $alumno->insert_alumno($_POST["usu_id"],$_POST["no_control"],$_POST["alu_nom"],$_POST["alu_ape"],$_POST["gen_id"],$_POST["id_carrera"],$_POST["sem_id"],$_POST["fecha_inscripcion"],$_POST["anio"]);
        break;

        case "listar_x_usu":
            $datos=$alumno->listar_alumno_x_usu($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();

                if($row["estado"]=="Activado"){
                    $sub_array[] = '<span class="btn btn-inline btn-success btn-sm ladda-button"><i class="fa fa-check-square"></i></span>';
                }else{
                    $sub_array[] = '<span class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-times"></i></span>';
                }
                $sub_array[] = $row["no_control"];
                $sub_array[] = $row["alu_nom"];
                $sub_array[] = $row["alu_ape"];
                $sub_array[] = $row["gen_nombre"];
                $sub_array[] = $row["nom_carrera"];
                $sub_array[] = $row["sem_nom"];

               
                $sub_array[] = '<button type="button" onClick="ver('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
                
            } 
            $results = array(
                "sEcho"=>1,
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar":
            $datos=$alumno->listar_alumno();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["alu_id"];
                $sub_array[] = $row["no_control"];
                $sub_array[] = $row["alu_nom"];
                $sub_array[] = $row["alu_ape"];
                $sub_array[] = $row["gen_nombre"];
                $sub_array[] = $row["nom_carrera"];
                $sub_array[] = $row["sem_nom"];
                $sub_array[] = '<button type="button" onClick="ver('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
                
            } 
            $results = array(
                "sEcho"=>1,
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar_filtro":
            $datos = $alumno->filtrar_alumno(
                isset($_POST["no_control"]) ? $_POST["no_control"] : null,
                isset($_POST["alu_nom"]) ? $_POST["alu_nom"] : null,
                isset($_POST["alu_ape"]) ? $_POST["alu_ape"] : null,
                isset($_POST["gen_id"]) ? $_POST["gen_id"] : null,
                isset($_POST["id_carrera"]) ? $_POST["id_carrera"] : null,
                isset($_POST["sem_id"]) ? $_POST["sem_id"] : null,
                isset($_POST["estado"]) ? $_POST["estado"] : null

            );
        
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                
                if($row["estado"]=="Activado"){
                    $sub_array[] = '<span class="btn btn-inline btn-success btn-sm ladda-button"><i class="fa fa-check-square"></i></span>';
                }else{
                    $sub_array[] = '<span class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-times"></i></span>';
                }
                $sub_array[] = $row["no_control"];
                $sub_array[] = $row["alu_nom"];
                $sub_array[] = $row["alu_ape"];
                $sub_array[] = $row["gen_nombre"];
                $sub_array[] = $row["nom_carrera"];
                $sub_array[] = $row["sem_nom"];
                $sub_array[] = '<button type="button" onClick="ver('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["alu_id"].');"  id="'.$row["alu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

                $data[] = $sub_array;
            }
        
            $results = array(
                "sEcho" => 1,
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
        
            echo json_encode($results);
        break;
        
        case "listar_entrada":
                    $datos = $alumno->listar_entrada(); // Cambia al método que filtra por fecha actual
                    $data = array();
            
                    foreach ($datos as $row) {
                        $sub_array = array();
                        $sub_array[] = $row["no_control"];
                        $sub_array[] = $row["alu_nom"];
                        $sub_array[] = $row["alu_ape"];
            
                        if ($row["alu_estado"] == 'Entrada') {
                            $sub_array[] = '<span class="label label-pill label-success">Entrada</span>';
                        } else {
                            $sub_array[] = '<span class="label label-pill label-danger">Salida</span>';
                        }
            
                        $sub_array[] = date("d/m/Y", strtotime($row["fecha"]));
                        $sub_array[] = date("H:i:s", strtotime($row["hora_inicio"]));
                        $sub_array[] = date("H:i:s", strtotime($row["hora_fin"]));
            
                        $data[] = $sub_array;
                    }
            
                    $results = array(
                        "sEcho" => 1,
                        "iTotalDisplayRecords" => count($data),
                        "aaData" => $data
                    );
            
                    echo json_encode($results);
        break;
        
        case "listar_detalle":
            $datos = $alumno->listar_alumnodetalle($_POST["alu_id"]);
            ?> 
        
                    <!-- Mostrar detalles generales del alumno -->
                    <div class="alumno-details">
                
                        <!-- Mostrar detalles generales del alumno -->
                        <div class="alumno-details">
                            <?php
                            // Verificar si hay datos antes de mostrar los detalles generales
                            if (!empty($datos)) {
                                $datos_generales = $datos[0];
                                ?>
                
                                <section class="card card-orange">
                                    <header class="card-header">
                                        <?php echo $datos_generales['alu_nom'].' '.$datos_generales['alu_ape']; ?>
                                        <span class="label label-pill label-danger"><?php echo $datos_generales['no_control']; ?></span>
                                        <button type="button" class="modal-close"></button>
                                    </header>
                                </section>
                
                            <?php
                            } else {
                                echo "<p>No se encontraron detalles para el alumno.</p>";
                            }
                            ?>
                
                            <?php
                            // Verificar si hay datos antes de mostrar los totales por fecha de semestre
                            if (!empty($datos)) {
                                // Array para almacenar los totales por fecha de semestre
                                $totales_por_semestre_registrado = array();
                                foreach ($datos as $row) {
                                    $semestre_registrado = $row['semestre_registrado'];
                                    $anio = $row['anio']; // Agregamos el campo "anio"
                                    
                                    // Verificar si el semestre y el año aún no están en el array
                                    if (!isset($totales_por_semestre_registrado[$semestre_registrado][$anio])) {
                                        // Agregar el semestre y el año al array y asignar el total de horas
                                        $totales_por_semestre_registrado[$semestre_registrado][$anio] = date("H:i:s", strtotime($row["total_tiempo_total"]));
                                    }
                                }
                            
                                // Mostrar los totales de horas por semestre y año utilizando un bucle anidado
                                foreach ($totales_por_semestre_registrado as $semestre_registrado => $totales_por_anio) {
                                    foreach ($totales_por_anio as $anio => $total_horas) {
                                        ?>
                                        <div class="activity-line-item box-typical">
                                            <div class="activity-line-date"><?php echo $anio; ?> <?php echo ($semestre_registrado == 1) ? 'Enero-Junio' : 'Julio-Diciembre'; ?></div>
                                            <header class="activity-line-item-header">
                                                <div class="activity-line-item-user-name">Registro Total De Horas   </div>
                                                <span class="label label-pill label-info"><?php echo $total_horas; ?></span>
                                            </header>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                
                        <!-- Mostrar detalles de asistencia (dentro del foreach) -->
                        <div class="box-typical box-typical-padding" id="table">
                            <table id="alumno_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="d-none d-sm-table-cell" style="width: 20%;">Fecha de Inscripción</th>
                                        <th class="d-none d-sm-table-cell" style="width: 20%;">Fecha</th>
                                        <th class="d-none d-sm-table-cell" style="width: 20%;">Entrada</th>
                                        <th class="d-none d-sm-table-cell" style="width: 20%;">Salida</th>
                                        <th class="d-none d-sm-table-cell" style="width: 20%;">Tiempo total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datos as $row) {
                                        ?>
                                        <tr>
                                            <!-- Aquí llenamos las celdas de la tabla con los datos de asistencia -->
                                            <td>
                                            <?php
                                            $semestre = ($row['semestre_registrado'] == 1) ? "Enero-Junio" : "Julio-Diciembre";
                                            echo $row['anio'] . ' - ' . $semestre;
                                            ?>
                                            </td>
                                            <td><?php echo $row['fecha']; ?></td>
                                            <td><?php echo $row['hora_inicio']; ?></td>
                                            <td><?php echo $row['hora_fin']; ?></td>
                                            <td><?php echo $row['total_tiempo']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        foreach ($datos as $row) {
                            ?>
                            <tr>
                                <!-- Aquí debes llenar las celdas de la tabla con los datos de asistencia -->
                                <!-- Ejemplo: <td><?php echo $row['nombre_campo']; ?></td> -->
                            </tr>
                            <?php
                        }
                        ?>
                    </div>
        
                    <?php
        break;
        
    
        case "guardaryeditar":
            if (!empty($_POST["alu_id"])) {
                $alu_id = $_POST["alu_id"];
                $no_control = $_POST["no_control1"];
                $alu_nom = $_POST["alu_nom1"];
                $alu_ape = $_POST["alu_ape1"];
                $gen_id = $_POST["gen_id1"];
                $id_carrera = $_POST["id_carrera1"];
                $sem_id = $_POST["sem_id1"];
                $fecha_inscripcion = isset($_POST["fecha_inscripcion"]) ? $_POST["fecha_inscripcion"] : null;
                $anio = $_POST["anio"];
    
        
                // Aquí se manejarían posibles validaciones adicionales
        
                // Llamada a la función de actualización y manejo de errores
                try {
                    $resultado = $alumno->update_alumno($alu_id, $no_control, $alu_nom, $alu_ape, $gen_id, $id_carrera, $sem_id, $fecha_inscripcion, $anio);
                    if ($resultado) {
                        echo "Actualización exitosa"; // Mostrar retroalimentación al usuario
                    } else {
                        echo "Error al actualizar"; // Mostrar retroalimentación al usuario
                    }
                } catch (PDOException $e) {
                    echo "Error en la base de datos: " . $e->getMessage(); // Mostrar mensaje de error específico
                }
            }
        break;
        
   
        case "eliminar":
            $alumno->delete_alumno($_POST["alu_id"]);

        break;

        case "desactivar_alumnos":
            $alumno->desactivar_alumnos(); // Llama a una función que desactiva todos los registros de la tabla
        break;

        case "mostrar";
            $datos=$alumno->get_alumno_x_id($_POST["alu_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["alu_id"] = $row["alu_id"];
                    $output["no_control"] = $row["no_control"];
                    $output["alu_nom"] = $row["alu_nom"];
                    $output["alu_ape"] = $row["alu_ape"];
                    $output["gen_id"] = $row["gen_id"];
                    $output["id_carrera"] = $row["id_carrera"];
                    $output["sem_id"] = $row["sem_id"];
                    $output["fecha_inscripcion"] = $row["fecha_inscripcion"];
                    $output["anio"] = $row["anio"];
                    



                }
                echo json_encode($output);
            }
        break;

        case "total";
            $datos=$alumno->get_alumno_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;
      
        case "totalabierto";
         $datos=$alumno->get_alumno_totalabierto();  
         if(is_array($datos)==true and count($datos)>0){
             foreach($datos as $row)
             {
                 $output["TOTAL"] = $row["TOTAL"];
             }
             echo json_encode($output);
         }
        break;

        case "totalcerrado";
         $datos=$alumno->get_alumno_totalcerrado();  
         if(is_array($datos)==true and count($datos)>0){
             foreach($datos as $row)
             {
                 $output["TOTAL"] = $row["TOTAL"];
             }
             echo json_encode($output);
         }
        break;

        //  /* TODO: Formato Json para grafico de soporte */
        // case "grafico";
        // $datos=$ticket->get_alumno_grafico();  
        // echo json_encode($datos);
        // break;
      
    }



?>