<?php
session_start();
include "conection.php";

$dir="images/";
$Multimedia = $_FILES['Multimedia']['name'];

if(!move_uploaded_file($_FILES['Multimedia']['tmp_name'],$dir.$Multimedia)){
    echo '<script type="text/javascript">
    alert("Error en la subida de archivos");
    window.location.href="pagina";
    </script>';
    exit();
}

$Titulo=$_POST["Titulo"];
$Descripcion=$_POST["Descripcion"];
$TipoPublicacion=$_POST["TipoPublicacion"];
$FechaInicial=$_POST["FechaInicial"];
$FechaFinal=$_POST["FechaFinal"];
$Ubicacion=$_POST['Ubicacion'];
$ID_Usuario=$_SESSION['id'];


$servername="localhost";
$database="Prueba2";
$username="root";
$password="Admin1234";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    echo "Error al conectar con la base de datos";
    exit();
}

    $consulta = "INSERT INTO Publicacion (Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Ubicacion,  Fecha_Inicio, Fecha_Fin, ID_Usuario)
        VALUES('$Titulo','$Descripcion','".$dir.$Multimedia."', '$TipoPublicacion','Pendiente', '$Ubicacion', '$FechaInicial','$FechaFinal','$ID_Usuario' )";
    if (mysqli_query($conn, $consulta)) {
    header("Location:pagina");
    
} else {
    echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
}


mysqli_close($conn); 

?>