<?php

session_start();

require "conection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>

    <!-- CSS -->

    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/formulario.css">

    <!-- ICONO DE PAGINA
    -->
    <link rel="shortcut icon" href="images/logo.png">

    <!-- BOOTSTRAP -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- TÍTULO -->
    <title>Editar Usuario</title>
</head>
<body>
 <!----------- CABECERA Y MENÚ ----------->

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="pagina">
        <img src="images/logo.png" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="pagina">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="formulario">Nueva Publicación</a>
          </li>
          <?php

          if (isset($_SESSION["rol"]) && $_SESSION["rol"]==3) {

          

          }else{
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="historico">Historico</a>';
            echo '</li>';

          }

          ?>
          <li class="nav-item">
            <a class="nav-link" href="departamentos">Departamentos</a>
          </li>
          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle active"  role="button" data-bs-toggle="dropdown" aria-expanded="true">
            
            
            <!-- NOMBRE DEL USUARIO ACTIVO Y SU FUNCIÓN -->
              
            <?php 
              
              echo $_SESSION["nombre"];
            
              echo '</a>';

            //AQUÍ, DEPENDIENDO DEL ROL DE CADA USUARIO, TENDRA LA OPCION DE AÑADIR USUARIO O NO

            if (isset($_SESSION["rol"]) && $_SESSION["rol"]==3) {

              echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
              echo  '<li><a class="dropdown-item" href="perfil">Perfil</a></li>';
              echo  '<li><a class="dropdown-item" href="cerrarsesion">Cerrar Sesión</a></li>';
              echo '</ul>';

            } else {
    
              echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
              echo  '<li><a class="dropdown-item" href="perfil">Perfil</a></li>';
              echo  '<li><a class="dropdown-item" href="cerrarsesion">Cerrar Sesión</a></li>';
              echo  '<li>';
              echo  '<hr class="dropdown-divider">';
              echo  '</li>';
              echo  '<li><a class="dropdown-item" href="gestionarPubli">Gestionar Publicaciones</a></li>';
              echo  '</li>';
              echo  '<li><a class="dropdown-item" href="listaUsers">Gestionar Usuarios</a></li>';
              echo  '</li>';
              echo  '<li><a class="dropdown-item" href="listaPantallas">Gestionar Pantallas</a></li>';
              echo  '</li>';
              echo  '<li><a class="dropdown-item" href="listaDepartamentos">Gestionar Departamentos</a></li>';
              echo '</ul>';

            }

            ?>


          </li>
        </ul>
      </div>
    </div>
  </nav>

<!----------- FIN DE CABECERA Y MENÚ ----------->

<!----------- CONTENIDO DE LA PÁGINA ----------->

<?php
$usuario = 'root';
$password = 'Admin1234';
$db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
    
    $id=$_GET['id'];

    $consulta= $db->prepare("SELECT * FROM Usuario WHERE ID_Usuario='$id'");
    
    //$consulta = $db->prepare("SELECT ID_Usuario, Nom_Usuario, Nombre_Completo, Rol.Nombre as Nombre_Rol, Correo_Usuario,Departamento.Nombre as Nombre_Departamento FROM Usuario, Departamento, Rol WHERE Usuario.ID_Rol=Rol.ID_Rol and Usuario.ID_Departamento=Departamento.ID_Departamento;");
    $consulta->execute();
    $data2=$consulta->fetchAll();
    
    // print_r($data2);

?>

<div class="pagina">
      <div class="flex-supremo">
        <div class="flex-container">
            <div class="contenedor">
            <a href="listaUsers"><img src="img/atras.png" height="32px" ></a><h3>EDITAR USUARIO </h3><br>
            
                <form action="editarUsuario.php?id=" method="POST">

                <!-- <label for="">ID: </label><br> -->
                <input type="hidden" name="ID_Usuario" id="ID_Usuario" autofocus="autofocus" value="<?php echo $data2[0]["ID_Usuario"];?>">

                <label for="">Nombre de Usuario: </label><br>
                <input type="text" name="Nom_Usuario" id="Nom_Usuario" value="<?php echo $data2[0]["Nom_Usuario"];?>"><br><br>

                <label for="">Nombre completo: </label><br>
                <input type="text" name="Nombre_Completo" id="Nombre_Completo" value="<?php echo $data2[0]["Nombre_Completo"];?>"><br><br>

                <label for="">Correo: </label>
                <input type="text" name="Correo_Usuario" id="Correo_Usuario" value="<?php echo $data2[0]["Correo_Usuario"];?>"><br><br>

                <input type="submit" name="enviar" id="enviar" value="ENVIAR">
                <input type="reset" name="reeset" id="reset" value="RESET">

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>