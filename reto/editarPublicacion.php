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

    $id=$_POST["ID_Publicacion"];
    $titulo=$_POST["Titulo"];
    //$descripcion=$_POST['Descripcion'];
    $tipoPublicacion=$_POST["TipoPublicacion"]; 
    $fechaInicial=$_POST['FechaInicial'];
    $fechaFinal=$_POST["FechaFinal"];
    // $multimedia=$_GET['Multimedia'];

    print_r($id);
    //print_r($titulo);
    

//Preparamos la consulta y la ejecutamos guardamos su resultado en $data


    // //echo "UPDATE Publicacion SET Titulo='$Titulo' WHERE ID_Publicacion='$id'";

    /*$consulta="UPDATE Publicacion SET Titulo='$titulo', Tipo_Publicacion='$tipoPublicacion', Fecha_Inicio='$fechaInicial', Fecha_Fin='$fechaFinal' WHERE ID_Publicacion='$id' ";
   

     

     if (mysqli_query($conn, $consulta)) {
        header("Location:pagina");
        
     } else {
        echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
    }*/
  
  mysqli_close($conn);


    

?>