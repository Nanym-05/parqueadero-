<?php
include 'conexion.php';

$Sql2="SELECT * FROM tipo_tarifa ";
$Resultado2=$conexion->query($Sql2); 
$tipo=$Resultado2->fetch_assoc();


$Sql3="SELECT * FROM tiempo ";
$Resultado3=$conexion->query($Sql3); 
$tiempo=$Resultado3->fetch_assoc();

$id="SELECT id_vehi FROM vehiculos ";
$Resultado_id=$conexion->query($id); 
$id_vehi=$Resultado_id->fetch_assoc();

if (isset($_POST["registro"])) {
    $tipo_vehiculo = mysqli_real_escape_string($conexion, $_POST["tipo_vehi"] ) ;   
    $modelo = mysqli_real_escape_string($conexion,$_POST["modelo"]);
    $placa = mysqli_real_escape_string($conexion, $_POST["placa"] ) ;
    $tiempo_estadia = mysqli_real_escape_string($conexion, $_POST["tiempo_select"] ) ;

    $fecha_inicio = mysqli_real_escape_string($conexion, $_POST["fecha_inicio"] ) ;
    $hora_inicio = mysqli_real_escape_string($conexion, $_POST["hora_inicio"]) ;

    $cedula = mysqli_real_escape_string($conexion, $_POST["cedula"] );
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]) ;
    $apellido = mysqli_real_escape_string($conexion,$_POST["apellido"] ) ;

    if (!empty($tipo_vehiculo) && !empty($modelo) && !empty($placa) && !empty($tiempo_estadia) && !empty($fecha_inicio) && !empty($hora_inicio )){
        $sqlvehi = "SELECT id_vehi FROM vehiculos WHERE placa='$placa'";
       
            if ($tiempo_estadia == $tiempo['id_tiempo']) {
                // Consulta de inserción para horas
                $consulta_insert_vehiculos = "INSERT INTO vehiculos(placa, modelo, fecha_inicio, hora_inicio, fk_tipo, fk_tiempo ) 
                    VALUES ('$placa', '$modelo', '$fecha_inicio', '$hora_inicio', '$tipo_vehiculo', '$tiempo_estadia')";
                $resultado1 = $conexion->query($consulta_insert_vehiculos);
            } else {
                // Consulta de inserción para meses
                if (!empty($cedula) || !empty($nombre) || !empty($apellido)) {
                    $sql = "INSERT INTO cliente(cedula, nombre, apellido) 
                        VALUES ('$cedula', '$nombre', '$apellido')";
                    $resultado = $conexion->query($sql);
                } else {
                    echo "<script>alert('Los campos del usuario están vacíos');</script>";
                }
    
                $consulta_insert_vehiculos = "INSERT INTO vehiculos(placa, modelo, fecha_inicio, hora_inicio, fk_tipo, cedula, fk_tiempo ) 
                    VALUES ('$placa', '$modelo', '$fecha_inicio', '$hora_inicio', '$tipo_vehiculo', '$cedula', '$tiempo_estadia')";
                $resultado1 = $conexion->query($consulta_insert_vehiculos);
            }
    
            header('location: index.php');
            if ($resultado1 == true) {
            }
        
    } else {
        echo "<script>alert('Los campos están vacíos');</script>";
    }
    
    
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
    <title>Insercion</title>
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
        .ti {
            font-family: 'calle';
        }
        .menu {
            margin-top: 3%;
        }
        .vehi {
            font-family: 'calle';
            font-size: 1.5em;
            width: 100%;
            margin-top: 4%;
            margin-left: 3%;
            margin-bottom: 3%;
        }
        .tipo {
            margin-bottom: 2%;
        }
        .mop {
            width: 100%;
        }
        .mo {
            width: 48%;
            float: left;
        }
        .pa {
            width: 48%;
            float: right;
        }
        .regi {
            margin-top: 5%;
        }
        .ced {
            width: 100%;
            margin-bottom: 2%;
        }
    </style>
  <script>
        function mostrarOcultarCampos() {
            var opcionSeleccionada = document.getElementById("tiempo_select").value;
            console.log(opcionSeleccionada);
            // Oculta todos los campos
            document.getElementById("horas_campos").style.display = "none";
            document.getElementById("meses_campos").style.display = "none";

            // Muestra los campos según la opción seleccionada
            if (opcionSeleccionada == 1) {
                document.getElementById("horas_campos").style.display = "block";
            } else if (opcionSeleccionada == 2) {
                document.getElementById("meses_campos").style.display = "block";
                document.getElementById("horas_campos").style.display = "block";
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

            <form action="" method="post">

                <label for="" class="form-label vehi ">Vehiculo</label>

                <select class="form-select tipo" id="inputGroupSelect01" name="tipo_vehi"  id="tipo_vehi" >
                  <option value="<?php echo $tipo['id_tipo'];?>"><?php echo $tipo['tipo']?></option>
                  <?php
      
                      $registros = mysqli_query($conexion, "SELECT * from tipo_tarifa order by id_tipo") or
                      die("Problemas en el select:" . mysqli_error($conexion));
                      while ($reg = mysqli_fetch_array($registros)) {
                        echo '<option value="' . $reg['id_tipo'] . '">' . $reg['tipo'] . '</option>';
                     }
                  ?>
                                                                     
                </select>

                <div class="mop">

                    <input type="text" class="form-control mo " name="modelo" placeholder="Marca">
                    <input type="text" class="form-control pa " name="placa" placeholder="Placa">

                </div>

                <label for="" class="form-label vehi ">¿Cuanto tiempo te quedaras?</label>

                
                <select id="tiempo_select" class="form-select" name="tiempo_select" onchange="mostrarOcultarCampos()">
                    <option value="<?php echo $tiempo['id_tiempo'];?>"><?php echo $tiempo['servicio']?></option>
                    <?php
                        $registros = mysqli_query($conexion, "SELECT id_tiempo, servicio from tiempo order by id_tiempo") or
                        die("Problemas en el select:" . mysqli_error($conexion));
                        while ($reg = mysqli_fetch_array($registros)) {
                            echo '<option value="' . $reg['id_tiempo'] . '">' . $reg['servicio'] . '</option>';
                        }
                    ?>
                </select>
               

                <div id="horas_campos" style="display: none;">

                    <label for="" class="form-label vehi ">Fecha y hora en la cual te estas registrando</label>
                    <input  name="fecha_inicio" type="date" class="form-control mo " placeholder="Fecha de inicio">
                    <input name="hora_inicio" type="time" class="form-control pa " placeholder="Hora de inicio">
                    
                </div>

                <div id="meses_campos" style="display: none;">

                       <label for="" class="form-label vehi ">Datos del cliente</label>
                       <input name="cedula" type="text" class="form-control ced" placeholder="Número de cedula">
                       <input name="nombre" type="text" class="form-control mo" placeholder="Nombre del cliente">
                       <input name="apellido" type="text" class="form-control pa" placeholder="Apellido del cliente">
                    
                </div>

                <button name="registro" class="btn btn-dark mb-3 regi" type="submit" >Registrar</button>

            </form>

        </div>
    </div>
</div>

</body>
</html>