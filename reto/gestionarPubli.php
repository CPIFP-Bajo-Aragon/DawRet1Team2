<?php

session_start();
if(!isset($_SESSION['id'])){
  header("Location:index");
  exit();
}
require "conection.php";

?>

<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- CSS -->

      <link rel="stylesheet" href="css/estilos.css">

      <!-- ICONO DE PAGINA -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- TÍTULO -->
      <title>Gestión de Publicaciones</title>
      
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
            <a class="nav-link" href="departamentos">Ubicaciones</a>
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
  <div class="pagina">

      <div  class="contenedor">

        <div class="contenido">

          <!-- AQUÍ VAN LAS NOTICIAS -->

          <h3>Gestión de publicaciones</h3>

            <?php

              $usuario = 'root';
              $password = 'Admin1234';
              $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
              //Consulta
              $consulta=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Publicacion.ID_Usuario as ID_Usuario, Usuario.Nom_Usuario as Nom_Usuario FROM Publicacion, Usuario WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario and Estado='Pendiente' ORDER BY ID_Publicacion DESC");
              $consulta->execute();
              $data=$consulta->fetchAll();
              if (isset($_SESSION["rol"]) && $_SESSION["rol"]==1) {

                if(empty($data)){
                  echo  '<h4 style="text-align:center; margin-top:50px">No hay publicaciones que gestionar</h4>';
                }else{

                foreach ($data as $valores):
                  echo '<div class="contenido">';
                  echo '<p id="expira">Publicado por: '.$valores['Nom_Usuario'].'</p>';
                  echo '<h4>'.$valores['Titulo'].'</h4><br>';
                  echo '<p>'.$valores['Descripcion'].'<p>';
                  echo '<div class="imagen-noticia"><img id="img-bd" src="'.$valores['Multimedia'].'"></div>';
                  echo  '<br>';
                  echo '<p style="text-align:center;">';
                  echo '<a href="aceptarPublicacion.php?id='.$valores["ID_Publicacion"].'"><button id="act-btn">ACEPTAR</button></a>';
                  echo '<a href="rechazarPublicacion.php?id='.$valores["ID_Publicacion"].'"><button id="rchz-btn">RECHAZAR</button></a>';
                  echo '</p>';
                  echo '<hr>';
                  echo '</div>';
                endforeach;
              }

              }else{

            
              foreach ($data as $valores):
                echo '<div class="contenido">';
                echo '<div class="titulo-noticia">';
                echo '<p id="expira">Publicado por: '.$valores['Nom_Usuario'].'</p>';
                echo '<p id="expira"> Expira el: '.$valores['Fecha_Fin'].'</p></div>';
                echo '<h4>'.$valores['Titulo'].'</h4><br>';
                
                echo '<p>'.$valores['Descripcion'].'<p>';
                echo '<div class="imagen-noticia"><img id="img-bd" src="'.$valores['Multimedia'].'"></div>';
                echo '<hr>';
                echo '</div>';
              endforeach;
            }
          ?>

      </div>

  <!----------- FIN DE CONTENIDO DE LA PÁGINA ----------->

  <!----------- FOOTER ----------->


  <div class="pie-de-pagina">
    <footer>
    © Copyright 2022:  
    <a href="https://cpifpbajoaragon.com">CPIFP Bajo Aragón</a>
    INFOJOVE
    </footer>
  </div>

  <!----------- FIN DEL FOOTER ----------->

  </div>
  </body>
</html>