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
    // eliminamos el usuario
    $query= $db->prepare("DELETE FROM Usuario WHERE ID_Usuario='$id'");

    $query->execute();
    
    header("Location:listaUsers");

  

?>    