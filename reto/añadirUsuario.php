 
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


$nombre=$_POST["name"];
$nombre_comp=$_POST['comp'];
$pass=$_POST["password"];
$email=$_POST['email'];
$rol=$_POST["rol"];
$departamento=$_POST["departamento"];


echo "Connected successfully";
 
$sql = "INSERT INTO Usuario(Nom_Usuario, Nombre_Completo, Pass_user, ID_Rol,ID_Departamento, Correo_Usuario) values ('$nombre', '$nombre_comp', CONCAT('*', UPPER(SHA1(UNHEX(SHA1('$pass'))))), '$rol', '$departamento', '$email')";
if (mysqli_query($conn, $sql)) {
      header("Location:listaUsers.php");
      
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>
