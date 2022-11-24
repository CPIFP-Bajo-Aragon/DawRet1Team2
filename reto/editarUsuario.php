<?php
session_start();

include "conection.php";

$servername = "localhost";
$database = "Prueba2";
$username = "root";
$password = "Admin1234";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);



    $id=$_POST['ID_Usuario'];
    
    $NomUsuario=$_POST['Nom_Usuario'];
    $Nombre_Completo=$_POST['Nombre_Completo']; 
    $Correo_Usuario=$_POST['Correo_Usuario'];
    //$Pass=$_POST["Pass"];
    
    //print_r($id);

    
//Preparamos la consulta y la ejecutamos guardamos su resultado en $data

$consulta="UPDATE Usuario SET Nom_Usuario='$NomUsuario', Nombre_Completo='$Nombre_Completo', Correo_Usuario='$Correo_Usuario' WHERE ID_Usuario='$id' ";

echo "UPDATE Usuario SET Nom_Usuario='$NomUsuario' WHERE ID_Usuario='$id' ";



if (mysqli_query($conn, $consulta)) {
    header("Location:listaUsers");
    
 } else {
    echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
 }

    mysqli_close($conn);

?>