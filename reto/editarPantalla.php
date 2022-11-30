<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location:index");
    exit();
  }
include "conection.php";
//   print_r($_POST);
 // exit();
$servername = "localhost";
$database = "Prueba2";
$username = "root";
$password = "Admin1234";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);



    $id=$_POST['ID_Pantalla'];
    
    $Nombre=$_POST['Nombre'];
    $Identificador=$_POST['Identificador']; 
    $id_Ubicacion=$_POST['ID_Departamento'];
    
    
    //print_r($id);

    
//Preparamos la consulta y la ejecutamos guardamos su resultado en $data

$consulta="UPDATE Pantalla SET Nombre='$Nombre', Identificador='$Identificador', ID_Departamento='$id_Ubicacion' WHERE ID_Pantalla='$id' ";




if (mysqli_query($conn, $consulta)) {
    header("Location:listaPantallas");
    
 } else {
    echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
 }

    mysqli_close($conn);

?>