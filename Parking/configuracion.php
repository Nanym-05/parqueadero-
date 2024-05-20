<?php
$server="localhost";
$user ="root";
$password="";
$bd ="parking";

$conn = mysqli_connect($server, $user, $password, $bd);

try{
    $conetion=new PDO('mysql:host=localhost;dbname='.$bd,$user,$password);
    // echo "Bienvenido";
}catch(PDOException $fail){
    echo "Error de conexion".$fail->getMessage();
}