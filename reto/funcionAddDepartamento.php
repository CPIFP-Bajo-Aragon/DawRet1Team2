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

$nombre=$_POST["nombre"];

$sql = "INSERT INTO Departamento(Nombre) values ('$nombre')";
if (mysqli_query($conn, $sql)) {
      header("Location:listaDepartamentos.php");
      
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>