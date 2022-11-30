<?php
session_start();
include "conection.php";
if(!isset($_SESSION['id'])){
    header("Location:index");
    exit();
  }

$dir="images/";
$Multimedia = $_FILES['Multimedia']['name'];

/*if(!move_uploaded_file($_FILES['Multimedia']['tmp_name'],$dir.$Multimedia)){
    echo '<script type="text/javascript">
    alert("Error en la subida de archivos");
    window.location.href="pagina";
    </script>';
    exit();
}*/
// variables recogidas

// print_r($_POST);
// exit();

$Titulo=$_POST["Titulo"];
$Descripcion=$_POST["Descripcion"];
$TipoPublicacion=$_POST["TipoPublicacion"];
$FechaInicial=$_POST["FechaInicial"];
$FechaFinal=$_POST["FechaFinal"];
$Ubicacion=$_POST['Ubicacion'];
$cont = 0;

while ($_POST["box".$cont]) {
    
    $Pantalla=$_POST["box".$cont];
    print_r($Pantalla);
    //print_r($cont);
    $cont=$cont+1;
    
}
//$Pantalla=$_POST["box"];
$ID_Usuario=$_SESSION['id'];

//print_r($Pantalla);

$servername="localhost";
$database="Prueba2";
$username="root";
$password="Admin1234";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    echo "Error al conectar con la base de datos";
    exit();
}
//    insercion de publicacion

    $consulta = "INSERT INTO Publicacion (Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Ubicacion, Fecha_Inicio, Fecha_Fin, ID_Usuario)
        VALUES('$Titulo','$Descripcion','".$dir.$Multimedia."','$TipoPublicacion','Pendiente', '$Ubicacion', '$FechaInicial','$FechaFinal','$ID_Usuario' )";
    
    $result = mysqli_query($conn, "SELECT max(ID_Publicacion) as Ultima FROM Publicacion");
    $id_publicacion=mysqli_fetch_array($result);
    $id=$id_publicacion[0]+1;
   
    //print_r($Pantalla);
    if (mysqli_query($conn, $consulta,)) {

        foreach($_POST["box"] as $box){
            $consul= "INSERT INTO Mostrar(ID_Pantalla,ID_Publicacion)VALUES($box,$id)";
            mysqli_query($conn, $consul);
        }


            header("Location:pagina");

        
      
    } else {
        echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
    }


mysqli_close($conn); 

    
    /*$sql4 = $conn->prepare();
    $sql4->execute();
    $data = $sql4->fetchAll();
    

    
    mysqli_query($consul);*/

?>