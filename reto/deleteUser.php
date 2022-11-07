<?php

session_start();

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
      <title>Eliminar Usuario</title>
      
  </head>

  <body>
  
  <!----------- CABECERA Y MENÚ ----------->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="pagina.php">
        <img src="images/logo.png" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="pagina.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="formulario.php">Formulario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reloj.php">Reloj</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historico.php">Historico</a>
          </li>
          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="true">
            
            
            <!-- NOMBRE DEL USUARIO ACTIVO Y SU FUNCIÓN -->
              
              <?php 
              
              echo $_SESSION["nombre"];
            
              echo '</a>';

            //AQUÍ, DEPENDIENDO DEL ROL DE CADA USUARIO, TENDRA LA OPCION DE AÑADIR USUARIO O NO

            if (isset($_SESSION["rol"]) && $_SESSION["rol"]==3) {

              echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
              echo  '<li><a class="dropdown-item" href="cerrarsesion.php">Cerrar Sesión</a></li>';
              echo '</ul>';

            } else {
    
              echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
              echo  '<li><a class="dropdown-item" href="index.php">Cerrar Sesión</a></li>';
              echo  '<li>';
              echo  '<hr class="dropdown-divider">';
              echo  '</li>';
              echo  '<li><a class="dropdown-item" href="añadirUser.php">Añadir Usuario</a></li>';
              echo  '</li>';
              echo  '<li><a class="dropdown-item" href="deleteUser.php">Eliminar Usuario</a></li>';
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

    <div class="flex-supremo">
        <div class="tablero">
            <div class="contenedor">
                <?php

                  //Conexion con base de datos
                  $usuario = 'root';
                  $password = 'Admin1234';
                  $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
                  //Preparamos la consulta y la ejecutamos guardamos su resultado en $data
                  $query = $db->prepare("SELECT ID_Usuario, Nom_Usuario, Rol.Nombre as Nombre_Rol, Departamento.Nombre as Nombre_Departamento FROM Usuario, Departamento, Rol WHERE Usuario.ID_Rol=Rol.ID_Rol and Usuario.ID_Departamento=Departamento.ID_Departamento;");
                  $query->execute();
                  $data = $query->fetchAll();

                  echo '<table>';
                  echo '<tr><th>Nombre</th><th>ROL</th><th>Departamento</th><th>Eliminar</td></tr>';
                  //Recorremos $data con el foreach y mostramos los valores[nombre de la tabla]
                  foreach ($data as $valores):
                    echo '<tr><td>'. $valores['Nom_Usuario'] .'</td><td>'. $valores['Nombre_Rol'] .'</td><td>'. $valores['Nombre_Departamento'] .'</td><td><a href="borrarUsuario.php"><img src="images/icons8-eliminar-96.png" height="32px" title="'.$valores['ID_Usuario'].'"></a></td></tr>';
                  endforeach;

                  echo '</table>';

                  function deleteUser(){
                    $id=$valores['ID_Usuario'];
                    $sqlBorrarUsu="DELETE FROM Usuario WHERE ID_Usuario=$id"; 
                    $consulta = $conexion->prepare($sqlBorrarUsu);
                    $consulta->execute();
                    header("Location: pagina.php");
                  }

                ?>
            </div>
        </div>
    
        
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

