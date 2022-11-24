<?php

include "funciones.php";

inicio_sesion();
require "conection.php";

//Conexion con base de datos
$usuario = 'root';
$password = 'Admin1234';
$db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);


//Preparamos la consulta y la ejecutamos guardamos su resultado en $data

    $id=$_GET['id'];
    //print_r($id);
    $consulta= $db->prepare("UPDATE Publicacion SET Estado='Aceptada' WHERE ID_Publicacion='$id'");
    //print_r ($consulta);
    $consulta->execute();
    
    header("Location:pagina");


?>