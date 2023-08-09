<?php
require_once("../config/conexion.php");
require_once("../models/Entradas.php");

$entradas = new Entradas();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["no_control"], $_POST["tipo"], $_POST["fecha_hora"])) {
        // Obtener los datos enviados por AJAX
        $noControl = $_POST["no_control"];
        $tipo = $_POST["tipo"];
        $fechaHora = $_POST["fecha_hora"];

        // Obtener la fecha y la hora separadas
        $fecha = date("Y-m-d", strtotime($fechaHora));
        $hora = date("H:i:s", strtotime($fechaHora));

        if ($tipo == "entrada") {
            // Registro de entrada
            $entradas->insertar_asistencia($noControl, $hora, null, $fecha);

            // Enviar una respuesta al cliente
            echo "";
        } elseif ($tipo == "salida") {
            // Registro de salida
            $entradas->insertar_asistencia($noControl, null, $hora, $fecha);

            // Enviar una respuesta al cliente
            echo "";
        } else {
            // Enviar una respuesta al cliente indicando un tipo inválido
            echo "Tipo de acción inválido";
        }
    } else {
        // Enviar una respuesta al cliente indicando datos faltantes
        echo "Datos faltantes";
    }
}
?>
