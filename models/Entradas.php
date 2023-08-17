<?php
class Entradas extends Conectar {
    public function insertar_asistencia($no_control, $hora_inicio, $hora_fin, $fecha) {
        $conectar = parent::conexion();
        parent::set_names();

        // Verificar si el no_control existe en la tabla tm_alumno
        $sql_verificar = "SELECT COUNT(*) AS existencia FROM tm_alumno WHERE no_control = ?";
        $stmt_verificar = $conectar->prepare($sql_verificar);
        $stmt_verificar->bindParam(1, $no_control);
        $stmt_verificar->execute();
        $resultado_verificar = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

        if ($resultado_verificar['existencia'] > 0) {
            // Verificar si ya se ha registrado la asistencia para este número de control y fecha (sin tener en cuenta la hora)
            $sql_verificar_asistencia = "SELECT COUNT(*) AS existencia FROM td_asistencia2 WHERE no_control = ? AND DATE(fecha) = ?";
            $stmt_verificar_asistencia = $conectar->prepare($sql_verificar_asistencia);
            $stmt_verificar_asistencia->bindParam(1, $no_control);
            $stmt_verificar_asistencia->bindParam(2, $fecha);
            $stmt_verificar_asistencia->execute();
            $resultado_verificar_asistencia = $stmt_verificar_asistencia->fetch(PDO::FETCH_ASSOC);

            if ($hora_inicio !== null) {
                // Registro de entrada
                if ($resultado_verificar_asistencia['existencia'] > 0) {
                    // Ya se ha registrado la asistencia para este número de control hoy
                    echo "registro_duplicado";
                    return;
                }

                // Obtener el semestre actual del alumno
                $sql_obtener_semestre = "SELECT fecha_inscripcion FROM tm_alumno WHERE no_control = ?";
                $stmt_obtener_semestre = $conectar->prepare($sql_obtener_semestre);
                $stmt_obtener_semestre->bindParam(1, $no_control);
                $stmt_obtener_semestre->execute();
                $resultado_obtener_semestre = $stmt_obtener_semestre->fetch(PDO::FETCH_ASSOC);
                $fecha_inscripcion = $resultado_obtener_semestre['fecha_inscripcion'];

                // Obtener el anio actual del alumno
                $sql_obtener_anio = "SELECT anio FROM tm_alumno WHERE no_control = ?";
                $stmt_obtener_anio = $conectar->prepare($sql_obtener_anio);
                $stmt_obtener_anio->bindParam(1, $no_control);
                $stmt_obtener_anio->execute();
                $resultado_obtener_anio = $stmt_obtener_anio->fetch(PDO::FETCH_ASSOC);
                $anio = $resultado_obtener_anio['anio'];

                $sql = "INSERT INTO td_asistencia2 (no_control, hora_inicio, fecha, semestre_registrado,anio)
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $conectar->prepare($sql);
                $stmt->bindParam(1, $no_control);
                $stmt->bindParam(2, $hora_inicio);
                $stmt->bindParam(3, $fecha);
                $stmt->bindParam(4, $fecha_inscripcion);
                $stmt->bindParam(5, $anio);

            } elseif ($hora_fin !== null) {
                // Registro de salida
                $sql = "UPDATE td_asistencia2
                        SET hora_fin = ?
                        WHERE no_control = ? AND DATE(fecha) = ?";
                $stmt = $conectar->prepare($sql);
                $stmt->bindParam(1, $hora_fin);
                $stmt->bindParam(2, $no_control);
                $stmt->bindParam(3, $fecha);
            }

            if ($stmt->execute()) {
                // La asistencia se ha registrado correctamente

                // Actualizar el estado del alumno
                $estado_alumno = ($hora_inicio !== null) ? 'Entrada' : 'Salida';
                $sql_actualizar_estado = "UPDATE td_asistencia2 SET alu_estado = ? WHERE no_control = ?";
                $stmt_actualizar_estado = $conectar->prepare($sql_actualizar_estado);
                $stmt_actualizar_estado->bindParam(1, $estado_alumno);
                $stmt_actualizar_estado->bindParam(2, $no_control);
                $stmt_actualizar_estado->execute();

                echo "registro_exitoso";
            } else {
                // Error al registrar la asistencia
                echo "error_registro";
            }
        } else {
            // El número de control no existe en la tabla tm_alumno
            echo "no_control_inexistente";
        }
    }
}

?>
