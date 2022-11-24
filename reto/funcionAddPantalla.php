<?php
session_start();
include "conection.php";

    
$servername = "localhost";
$database = "Prueba2";
$username = "root";
$password = "Admin1234";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

$nombreP=$_POST["nombre2"];
$id=$_POST["id"];
$ubi=$_POST["ubi"];

$sql = "INSERT INTO Pantalla(Nombre,Identificador,Ubicacion) values ('$nombreP', '$id', '$ubi')";
if (mysqli_query($conn, $sql)) {
      header("Location:listaPantallas");
      
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>