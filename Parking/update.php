<?php
include 'conexion.php';

if (isset($_GET['id_vehi'])) {
    $id_vehi = (int)$_GET['id_vehi'];
    $buscar_vehi = $conetion->prepare('SELECT * FROM vehiculos WHERE id_vehi=:id_vehi');
    $buscar_vehi->execute(array(':id_vehi' => $id_vehi));
    $resultado_vehi = $buscar_vehi->fetch();
} else {
    header('Location: index.php');
}

if (isset($_POST['guardar'])) {
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $tiempo = $_POST['tiempo_select'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $hora_inicio = $_POST['hora_inicio'];
    $tipo_vehi = $_POST['tipo_vehi'];

    // Verifica si el tiempo ha cambiado
    if ($resultado_vehi['fk_tiempo'] != $tiempo) {
        // Si cambió, verifica si es de horas a meses
        if ($resultado_vehi['fk_tiempo'] == 1 && $tiempo == 2) {
            // Si es de horas a meses, deja que el usuario actualice sus datos
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';

            if (!empty($cedula) && !empty($nombre) && !empty($apellido)) {
                $sql = "INSERT INTO cliente(cedula, nombre, apellido) 
                    VALUES ('$cedula', '$nombre', '$apellido')";
                $resultado = $conexion->query($sql);
            } else {
                echo "<script>alert('Los campos del usuario están vacíos');</script>";
            }

            // Inserta o actualiza el registro de vehículo
            $actualizar_vehi = $conetion->prepare('UPDATE vehiculos SET
                placa=:placa,
                modelo=:modelo,
                fk_tiempo=:tiempo_select,
                fecha_inicio=:fecha_inicio,
                hora_inicio=:hora_inicio,
                fk_tipo=:tipo_vehi
                WHERE id_vehi=:id_vehi'
            );

            $actualizar_vehi->execute(array(
                ':placa' => $placa,
                ':modelo' => $modelo,
                ':tiempo_select'=> $tiempo,
                ':fecha_inicio' => $fecha_inicio,
                ':hora_inicio' => $hora_inicio,
                ':tipo_vehi' => $tipo_vehi,
                ':id_vehi' => $id_vehi
            ));
        } else {
            // Si es de meses a horas, simplemente actualiza el registro de vehículo
            $actualizar_vehi = $conetion->prepare('UPDATE vehiculos SET
                placa=:placa,
                modelo=:modelo,
                fk_tiempo=:tiempo_select,
                fecha_inicio=:fecha_inicio,
                hora_inicio=:hora_inicio,
                fk_tipo=:tipo_vehi
                WHERE id_vehi=:id_vehi'
            );

            $actualizar_vehi->execute(array(
                ':placa' => $placa,
                ':modelo' => $modelo,
                ':tiempo_select'=> $tiempo,
                ':fecha_inicio' => $fecha_inicio,
                ':hora_inicio' => $hora_inicio,
                ':tipo_vehi' => $tipo_vehi,
                ':id_vehi' => $id_vehi
            ));
        }
    } else {
        // Si el tiempo no cambió, simplemente actualiza el registro de vehículo
        $actualizar_vehi = $conetion->prepare('UPDATE vehiculos SET
            placa=:placa,
            modelo=:modelo,
            fk_tiempo=:tiempo_select,
            fecha_inicio=:fecha_inicio,
            hora_inicio=:hora_inicio,
            fk_tipo=:tipo_vehi
            WHERE id_vehi=:id_vehi'
        );

        $actualizar_vehi->execute(array(
            ':placa' => $placa,
            ':modelo' => $modelo,
            ':tiempo_select'=> $tiempo,
            ':fecha_inicio' => $fecha_inicio,
            ':hora_inicio' => $hora_inicio,
            ':tipo_vehi' => $tipo_vehi,
            ':id_vehi' => $id_vehi
        ));
    }

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-aBgZKbFYe65vqTVZGO5e4Jp3mZXWMg7abNExl0zNQTu1PQZfOS3GIwMIGa7PxhUJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Actualizacion</title>
    <style>
           @font-face {
            font-family: 'calle';
            src: url(cal.ttf);
         }
         body::-webkit-scrollbar {
            width: 10px;
        }
        body::-webkit-scrollbar-thumb {
            background-color: gray;
            border-radius: 10px;
        }
        .ti{
            font-family: 'calle';
        }
        .menu{
            margin-top: 3%;
        }
        .vehi {
            width: 100%;
            margin-top: 4%;
            margin-left: 5%;
            margin-bottom: 3%;
            font-family: 'calle';
            font-size: 1.5em;
        }
        .ced {
            width: 95%;
            margin-bottom: 2%;
            margin-left: 5%;
        }
        .mo {
            width: 45%;
            float: left;
            margin-left: 5%;
            margin-bottom: 3%;
        }
        .pa {
            width: 45%;
            float: right;
            margin-left: 5%;
            margin-bottom: 3%;
        }
        .formi{
            margin-top:3%;
        }
        .tipo {
            margin-bottom: 2%;
        }
        .lab{
            font-family: 'calle';
            margin-left: 2%;
            margin-bottom: 1.5%;
            margin-top: 1%;
            font-size: 1.5em;
        }
        .mop {
            width: 100%;
        }
        .regi {
            margin-top: 5%;
        }
        .boton{
           margin-top: 3%;
           margin-bottom: 5%;
        }
    </style>
     <script>
        function mostrarOcultarCampos() {
            var opcionSeleccionada = document.getElementById("tiempo_select").value;
            console.log(opcionSeleccionada);
            // Oculta todos los campos
            document.getElementById("meses_campos").style.display = "none";

            if (opcionSeleccionada == 2) {
                document.getElementById("meses_campos").style.display = "block";
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">

            <nav class="navbar navbar-expand-lg bg-body-tertiary menu">
                <div class="container-fluid">
                    <a class="navbar-brand ti" href="inicio.php">Go x Park</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav"> 
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.php">Registro</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link active" aria-current="page" href="inicio.php#tarifa">Tarifa</a>
                       </li>
                        </ul>
                    </div>
                </div>
            </nav>

                <form class="formi" action="" method="POST">
                    <div class="form-group">
                        <label class="lab" for="placa">Placa:</label>
                        <input type="text" name="placa" value="<?php echo $resultado_vehi['placa']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="lab" for="modelo">Modelo:</label>
                        <input type="text" name="modelo" value="<?php echo $resultado_vehi['modelo']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="lab" for="tiempo">Tiempo:</label>
                        <select id="tiempo_select" class="form-select " name="tiempo_select" onchange="mostrarOcultarCampos()">
                            <?php
                            $registros_tiempo = mysqli_query($conexion, "SELECT * from tiempo order by id_tiempo") or
                                die("Problemas en el select:" . mysqli_error($conexion));
                            while ($reg_tiempo = mysqli_fetch_array($registros_tiempo)) {
                                $selected = ($reg_tiempo['id_tiempo'] == $resultado_vehi['fk_tiempo']) ? 'selected' : '';
                                echo '<option value="' . $reg_tiempo['id_tiempo'] . '" ' . $selected . '>' . $reg_tiempo['servicio'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div id="meses_campos" style="display: none;">

                       <label for="" class="form-label vehi">Datos del cliente</label>
                       <input name="cedula" type="text" class="form-control ced" placeholder="Número de cedula">
                       <input name="nombre" type="text" class="form-control mo" placeholder="Nombre del cliente">
                       <input name="apellido" type="text" class="form-control pa" placeholder="Apellido del cliente">
                    
                    </div>

                    <div class="form-group">
                        <label class="lab" for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" name="fecha_inicio" value="<?php echo $resultado_vehi['fecha_inicio']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="lab" for="hora_inicio">Hora de Inicio:</label>
                        <input type="time" name="hora_inicio" value="<?php echo $resultado_vehi['hora_inicio']; ?>" class="form-control">
                    </div>
                   
                    <div class="form-group">
                        <label class="lab" for="tipo_vehi">Tipo de Vehiculo:</label>
                        <select class="form-select" name="tipo_vehi">
                            <?php
                            $registros_tipo = mysqli_query($conexion, "SELECT * from tipo_tarifa order by id_tipo") or
                                die("Problemas en el select:" . mysqli_error($conexion));
                            while ($reg_tipo = mysqli_fetch_array($registros_tipo)) {
                                $selected = ($reg_tipo['id_tipo'] == $resultado_vehi['fk_tipo']) ? 'selected' : '';
                                echo '<option value="' . $reg_tipo['id_tipo'] . '" ' . $selected . '>' . $reg_tipo['tipo'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <input  type="submit" name="guardar" value="Guardar" class="btn btn-secondary boton">
                    <a  href="index.php" class="btn btn-danger boton">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>