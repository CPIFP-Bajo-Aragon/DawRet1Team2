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
    $query= $db->prepare("DELETE FROM Departamento WHERE ID_Departamento='$id'");
    //print_r ($query);
    $query->execute();
    
    header("Location:listaDepartamentos.php");

  

?> 