<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Inicio</title>
    <style>
         @font-face {
            font-family: 'calle';
            src: url(cal.ttf);
         }
         
        body::-webkit-scrollbar {
            width: 10px;
        }
        body::-webkit-scrollbar-thumb {
            background-color: black;
            border-radius: 10px;
        }
        body{
            overflow-x: hidden;
        }
        .ti{
            font-family: 'calle';
        }
        .menu{
            margin-top: 3%;
        }
        .tex{
            color: darkred;
            margin-top: 2%;
            font-size: 7em;
            font-family: 'calle';
            text-align: left;
        }
        .texi{
            font-size: 6em;
            font-family: 'calle';
            text-align: left;
        }
        .ta{
            margin-top: 20%;
            margin-bottom: 8%;
            font-size: 3em;
            font-family: 'calle';
            color: darkred;
        }
        .fondo{
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: -1;
        }
        .pa{
            font-size: 1.2em;
            text-align: left;
        }
        .tabli{
            margin-bottom: 5%;
            position: absolute;
            z-index: -1;    
        }
        .pan{
            margin-top: 16%;
            font-size: 13em;
            font-family: 'calle';
            color: black;
            position: absolute;
            z-index: 2;  
        }
    </style>
</head>
<body>

    <img class="fondo" src="fondo.png" alt="fondo">

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

             <p class="tex">Tu espacio de confianza</p>
             <p class="texi">Más que un parking</p>
             <p class="pa">        
             ¡Descubre la comodidad en cada espacio con Go X Park! Tu destino ideal. <br>
             Estaciona sin complicaciones
             y disfrutar al máximo de cada viaje. 
             <br>¡Bienvenido a la experiencia definitiva del estacionamiento!</p>



             <h1 id="tarifa" class="ta">Tarifas</h1>


             <table class="table tabli">
               <thead>
                 <tr>
                   <th scope="col">N°</th>
                   <th scope="col">Vehiculos</th>
                   <th scope="col">Hora</th>
                   <th scope="col">Mes</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <th scope="row">1</th>
                   <td>Carro</td>
                   <td>4000</td>
                   <td>80000</td>
                 </tr>
                 <tr>
                   <th scope="row">2</th>
                   <td>Moto</td>
                   <td>2000</td>
                   <td>50000</td>
                 </tr>
                 <tr>
                   <th scope="row">3</th>
                   <td>Bicicleta</td>
                   <td>2000</td>
                   <td>50000</td>
                 </tr>
                 
               </tbody>
             </table>

             <br>
             <br>
             <br>
             <br>

        
         </div>
    </div>
</div>

<h1 class="pan">-----GO X PARK----</h1>
</body>
</html>