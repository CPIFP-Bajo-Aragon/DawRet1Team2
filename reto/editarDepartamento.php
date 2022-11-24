<?php
session_start();

include "conection.php";

$servername = "localhost";
$database = "Prueba2";
$username = "root";
$password = "Admin1234";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);



    $id=$_POST['ID_Departamento'];
    
    $Nombre=$_POST['Nombre'];
    
    
    //print_r($id);

    
//Preparamos la consulta y la ejecutamos guardamos su resultado en $data

$consulta="UPDATE Departamento SET Nombre='$Nombre' WHERE ID_Departamento='$id' ";

//echo "UPDATE Pantalla SET Nombre='$Nombre', Identificador='$Identificador', Ubicacion='$Ubicacion' WHERE ID_Pantalla='$id' ";



if (mysqli_query($conn, $consulta)) {
    header("Location:listaDepartamentos.php");
    
 } else {
    echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
 }

    mysqli_close($conn);

?>