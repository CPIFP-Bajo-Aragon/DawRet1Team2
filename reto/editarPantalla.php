<?php
session_start();

include "conection.php";

$servername = "localhost";
$database = "Prueba2";
$username = "root";
$password = "Admin1234";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);



    $id=$_POST['ID_Pantalla'];
    
    $Nombre=$_POST['Nombre'];
    $Identificador=$_POST['Identificador']; 
    $Ubicacion=$_POST['Ubicacion'];
    
    
    //print_r($id);

    
//Preparamos la consulta y la ejecutamos guardamos su resultado en $data

$consulta="UPDATE Pantalla SET Nombre='$Nombre', Identificador='$Identificador', Ubicacion='$Ubicacion' WHERE ID_Pantalla='$id' ";

//echo "UPDATE Pantalla SET Nombre='$Nombre', Identificador='$Identificador', Ubicacion='$Ubicacion' WHERE ID_Pantalla='$id' ";



if (mysqli_query($conn, $consulta)) {
    header("Location:listaPantallas");
    
 } else {
    echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
 }

    mysqli_close($conn);

?>