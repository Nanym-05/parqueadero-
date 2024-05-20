<?php
include 'conexion.php';

if (isset($_GET['id_vehi']) && isset($_GET['accion']) && $_GET['accion'] == 'ocultar') {
    $id_vehi = $_GET['id_vehi'];

    try {
        // Desactivar la restricción de clave externa
        $sentencia_desactivar_fk = $conexion->prepare('SET foreign_key_checks = 0');
        $sentencia_desactivar_fk->execute();

        // Establecer la zona horaria a Colombia
        date_default_timezone_set('America/Bogota');

        // Obtener la fecha y hora actual en Colombia
        $fecha_salida = date('Y-m-d');
        $hora_salida = date('H:i:s');
        $temposalida = strtotime($fecha_salida.' '.$hora_salida);
        $querytiempo = $conn->query("SELECT * FROM vehiculos, tipo_tarifa where id_vehi='$id_vehi' and id_tipo=fk_tipo");
        $rowtime = $querytiempo->FETCH_ASSOC();
        $tempoingreso = strtotime($rowtime['fecha_inicio'].' '.$rowtime['hora_inicio']);
        $tiempodentro = $temposalida-$tempoingreso;
        $horas = ($tiempodentro/60)/60;
        $costo = (int) $rowtime['costo_hora']*$horas;
        echo $costo;
        

        // Mover el vehículo a la tabla vehi_salida
        $sentencia_insertar_salida = $conexion->prepare('INSERT INTO vehi_salida (placa_salida, modelo_salida, fecha_inicio_sal, hora_inicio_sal, fecha_salida_sal, hora_salida_sal, fk_tipo_salida, cedula_salida, fk_tiempo_salida, pago)
          SELECT placa, modelo, fecha_inicio, hora_inicio, ?, ?, fk_tipo, cedula, fk_tiempo, ?
          FROM vehiculos
          WHERE id_vehi = ?');


        $sentencia_insertar_salida->bind_param('ssii', $fecha_salida, $hora_salida, $costo, $id_vehi);
        $sentencia_insertar_salida->execute();

        // Eliminar el vehículo de la tabla vehiculos
        $sentencia_eliminar = $conexion->prepare('DELETE FROM vehiculos WHERE id_vehi = ?');
        $sentencia_eliminar->bind_param('i', $id_vehi);
        $sentencia_eliminar->execute();

        // Reactivar la restricción de clave externa
        $sentencia_activar_fk = $conexion->prepare('SET foreign_key_checks = 1');
        $sentencia_activar_fk->execute();
        
        header('Location: index.php');
        exit();
    } catch (Exception $e) {
        // Manejar la excepción (por ejemplo, registrarla o mostrar un mensaje de error)
        echo 'Error: ' . $e->getMessage();
    }
}
?>
