<?php
include 'conexion.php';

// Consulta para obtener todos los vehículos
$sentencia_select = $conetion->prepare('SELECT * FROM vehiculos, tiempo, tipo_tarifa WHERE id_tiempo=fk_tiempo AND id_tipo=fk_tipo ORDER BY id_vehi DESC');
$sentencia_select->execute();
$resultado = $sentencia_select->fetchAll();  

$sentencia_delete = $conetion->prepare('UPDATE vehiculos SET visible = 0 WHERE id_vehi = :id_vehi');
$sentencia_delete->bindParam(':id_vehi', $_GET['id_vehi'], PDO::PARAM_INT);
$sentencia_delete->execute();


if (isset($_POST['btn_buscar'])) {
    $buscar_text = $_POST['buscar'];
    $select_buscar = $conetion->prepare('SELECT * FROM vehiculos, tiempo, tipo_tarifa WHERE id_tiempo=fk_tiempo AND id_tipo=fk_tipo AND placa LIKE :campo');
    $select_buscar->execute(array(':campo' => "%".$buscar_text."%"));
    $resultado = $select_buscar->fetchAll();
}

// Realizar la consulta para obtener los vehículos ingresados hoy//EJERCICIO 1
$sentencia_select_hoy = $conetion->prepare('SELECT * FROM vehiculos WHERE fecha_inicio = CURDATE()');
$sentencia_select_hoy->execute();
$resultado_hoy = $sentencia_select_hoy->fetchAll();

// Realizar la consulta para obtener cuantas motos ingresaron hoy//EJERCICIO 2
$sentencia_cantidad_hoy = $conetion->prepare('SELECT COUNT(*) as cantidad FROM tipo_tarifa,vehiculos WHERE id_tipo=fk_tipo AND fecha_inicio = CURDATE() AND id_tipo = 2');
$sentencia_cantidad_hoy->execute();
$resultado_cantidad = $sentencia_cantidad_hoy->fetch(PDO::FETCH_ASSOC);
$cantidad_dos = $resultado_cantidad['cantidad'];

// Realizar la consulta para obtener el total del mes de octubre//EJERCICIO 3
$individuo = $conetion->prepare("SELECT SUM(pago) as total_ingreso from vehi_salida Where fecha_salida_sal like '%-10-%' or fecha_inicio_sal like '%-10-%'");


$individuo->execute();
$ingre = $individuo->fetch(PDO::FETCH_ASSOC);
$cant = $ingre['total_ingreso']; 



// Realizar la consulta para obtener el total de vehiculos que ingresaron la ultima semana de octubre//EJERCICIO 4

$fechaInicio = '2023-10-30'; 
$fechaFin = '2023-10-31';    

$sentencia_semana_AM_alternativa = $conetion->prepare("SELECT * 
    FROM vehiculos 
    WHERE fecha_inicio BETWEEN :fecha_inicio AND :fecha_fin 
    AND DATE_FORMAT(hora_inicio, '%p') = 'AM'
");
$sentencia_semana_AM_alternativa->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
$sentencia_semana_AM_alternativa->bindParam(':fecha_fin', $fechaFin, PDO::PARAM_STR);
$sentencia_semana_AM_alternativa->execute();
$vehiculos_ingresados_manana = $sentencia_semana_AM_alternativa->rowCount();


// Realizar la consulta para obtener el vehiculo que mas ingreso en octubre//EJERCICIO 5
$sentencia_mas_ingresos = $conetion->prepare("SELECT placa, modelo, COUNT(*) as total_ingresos
    FROM vehiculos
    WHERE MONTH(fecha_inicio) = 10
    GROUP BY placa, modelo
    ORDER BY total_ingresos DESC
    LIMIT 1
");

$sentencia_mas_ingresos->execute();
$resultado_mas_ingresos = $sentencia_mas_ingresos->fetch(PDO::FETCH_ASSOC);

// Realizar la consulta para obtener los vehiculos tipo bicicleta//EJERCICIO 6

$sentencia_bicicleta = $conetion->prepare('SELECT * FROM tipo_tarifa, vehiculos WHERE id_tipo = fk_tipo AND id_tipo = 3');
$sentencia_bicicleta->execute();
$resultado_bici = $sentencia_bicicleta->fetchAll();


// Realizar la consulta para obtener los vehiculos tipo mensualidad//EJERCICIO 7
$sentencia_mensualidad = $conetion->prepare('SELECT * FROM tiempo, vehiculos WHERE id_tiempo = fk_tiempo AND id_tiempo = 2');
$sentencia_mensualidad->execute();
$resultado_meses = $sentencia_mensualidad->fetchAll();

// Realizar la consulta para obtener los vehiculos con placa al final 2-3//EJERCICIO 8
$consulta_pico_placa = $conetion->prepare('SELECT placa 
    FROM vehiculos WHERE fecha_inicio = CURDATE() AND ( RIGHT(placa, 1) = "2" OR RIGHT(placa, 1) = "3")
');
$consulta_pico_placa->execute();
$resultado_pico_placa = $consulta_pico_placa->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Registro</title>
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
        .formulario{
            margin-right: auto;
            width: 100%;
            display: flex;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top:5%;
        }
        table .head{
            background: black;
        }
        table .head td{
            color: #fff;
            font-family: 'Arial',sans-serif;
            font-weight: bold;
            font-size: 15px;
            text-align: center;
        }

        table tr td{
            border:1px solid #ccc;
            padding: 7px;
            font-size: 14px;
            color: #555;
        }

        .btn__update{
            display: inline-block;
            font-size: 14px;
            color: #fff;
            border-radius: 5px;
            padding: 5px 10px;
            text-decoration: none;
        }

        .btn__delete{
            display: inline-block;
            font-size: 14px;
            color: #fff;
            border-radius: 5px;
            padding: 5px 10px;
            text-decoration: none;
        }
        
    </style>
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
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Consultas
                           </a>
                           <ul class="dropdown-menu">
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci1" class="dropdown-item" href="#">Muestra los vehiculos ingresados el dia de hoy</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci2" class="dropdown-item" href="#">Cantidad de vehiculos tipo motocicleta ingresados el dia de hoy</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci3" class="dropdown-item" href="#">Total del parqueadero del mes de octubre</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci4" class="dropdown-item" href="#">Conteo de los vehiculos ingresados en la mañana en octubre</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci5" class="dropdown-item" href="#">Vehiculo que mas ingreso durante el mes</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci6" class="dropdown-item" href="#">Vehiculos tipo bicicleta</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci7" class="dropdown-item" href="#">Vehiculos que pagan mensualidas</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#ejerci8" class="dropdown-item" href="#">Pico y placa</a></li>
                          </ul>
                        </li>
                    </ul>
                </div>
                <div class="barra__buscador" >
                    <form action="" class="formulario" method="POST">
                        <input type="text" name="buscar" placeholder="Buscar" value="<?php if (isset($buscar_text)) echo $buscar_text; ?>">
                        <input type="submit" class="btn" name="btn_buscar" value="Buscar">
                        <a href="insert.php" class="btn">Nuevo</a>
                    </form>
                </div>
            </div>
        </nav>


<!-- Modal 1 -->
        <div class="modal fade" id="ejerci1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vehículos ingresados hoy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <?php
                foreach ($resultado_hoy as $vehiculo_hoy) {
                    echo 'Placa: ' . $vehiculo_hoy['placa'] . ' - Modelo: ' . $vehiculo_hoy['modelo'] . '<br>';
                }
              ?>
              </div>
            </div>
          </div>
        </div>

        
<!-- Modal 2 -->
        <div class="modal fade" id="ejerci2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cantidad de motocicletas ingresadas hoy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <?php echo "$cantidad_dos "?>
              </div>
            </div>
          </div>
        </div>
        
<!-- Modal 3 -->
<div class="modal fade" id="ejerci3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Total del mes de octubre</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <?php
       echo $cant;
       ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal 4 -->
        <div class="modal fade" id="ejerci4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ultima semana de octubre <br> vehiculos en el horario de la mañana</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <?php echo $vehiculos_ingresados_manana; ?>
              </div>
            </div>
          </div>
        </div>

<!-- Modal 5 -->
        <div class="modal fade" id="ejerci5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vehiculo que mas ingreso en octubre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php                
                    if ($resultado_mas_ingresos) {
                        $placa_mas_ingresos = $resultado_mas_ingresos['placa'];
                        $modelo_mas_ingresos = $resultado_mas_ingresos['modelo'];
                        $total_ingresos = $resultado_mas_ingresos['total_ingresos'];

                        echo "El vehículo con más ingresos en octubre es: Placa: $placa_mas_ingresos, Modelo: $modelo_mas_ingresos, Total de Ingresos: $total_ingresos";
                    } else {
                        echo "No hay datos disponibles para el mes de octubre.";
                    }
                ?>
              </div>
            </div>
          </div>
        </div>
        
<!-- Modal 6 -->
        <div class="modal fade" id="ejerci6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vehiculos tipo bicicleta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <?php
                foreach ($resultado_bici as $vehiculo_bici) {
                  echo 'Placa: ' . $vehiculo_bici['placa'] . ' - Modelo: ' . $vehiculo_bici['modelo'] . '<br>';
              }
              ?>
              </div>
            </div>
          </div>
        </div>
<!-- Modal 7 -->
        <div class="modal fade" id="ejerci7" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vehiculos tipo mensualidad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <?php
                foreach ($resultado_meses as $vehiculo_men) {
                  echo 'Placa: ' . $vehiculo_men['placa'] . ' - Modelo: ' . $vehiculo_men['modelo'] . '<br>';
              }
              ?>
              </div>
            </div>
          </div>
        </div>
<!-- Modal 8 -->
<div class="modal fade" id="ejerci8" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vehiculos con placa final 2-3</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <?php
               
                if (!empty($resultado_pico_placa)) {
                  echo "Hoy es pico y placa terminado en 2 o 3.<br> No saquen sus vehiculos hoy.<br>";
                  echo "<br>Placas afectadas:<br>";
  
                  foreach ($resultado_pico_placa as $vehiculo) {
                      echo $vehiculo['placa'] . "<br>";
                  }
                } 
              ?>
              </div>
            </div>
          </div>
        </div>

        <table>
            <tr class="head">
                <td>Placa</td>
                <td>Modelo</td>
                <td>Fecha inicio</td>
                <td>Hora inicio</td>
                <td>Vehiculo</td>
                <td>Cedula</td> 
                <td>Tiempo</td>
                <td colspan="2">Acción</td>
            </tr>
            <?php foreach ($resultado as $fila): ?>
                <?php if ($fila['visible'] == 1): ?>
                    <tr>    
                        <td><?php echo $fila['placa']; ?> </td>
                        <td><?php echo $fila['modelo']; ?> </td>
                        <td><?php echo $fila['fecha_inicio']; ?> </td>
                        <td><?php echo $fila['hora_inicio']; ?> </td>
                        <td><?php echo $fila['tipo']; ?> </td>
                        <td><?php echo $fila['cedula']; ?> </td>
                        <td><?php echo $fila['servicio']; ?> </td>
                        <td><a href="update.php?id_vehi=<?php echo $fila['id_vehi']; ?>" class="btn btn__update btn-secondary">Editar</a></td>
                       <td><a href="delete.php?id_vehi=<?php echo $fila['id_vehi']; ?>&accion=ocultar" class="btn btn__delete btn-danger">Salir</a></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>

        </table>
    </div>
</div>

</body>
</html>
