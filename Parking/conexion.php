<?php

include("configuracion.php");
$conexion = new mysqli($server,$user,$password,$bd);

if ($conexion->connect_error){
    die("fallo la conexion: " .$conexion->connect_error);
}else{
    //echo "Conectado";
}