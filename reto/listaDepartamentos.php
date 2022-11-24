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
      <link rel="stylesheet" href="css/formulario.css">

      <!-- ICONO DE PAGINA -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- TÍTULO -->
      <title>Gestionar Departamentos</title>
      
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

<div class="buscador">

<form action="buscadorDepartamento" method="POST">

  <input type="text" name="texto" id="texto">
  <input type="submit" name="search" id="search" value="BUSCAR">

</form>

</div>

            <button id="add-btn" onclick="window.modal.showModal();">Añadir Ubicación</button>

              <dialog id="modal">

              <h3>AÑADIR UBICACIÓN <button  onclick="window.modal.close();"> X </button></h3><br>
              <form action="funcionAddDepartamento" method="post">

                  <label for="">Nombre: </label><br>
                  <input type="text" name="nombre" id="nombre"><br><br>
                  
                  
                  <input type="submit" name="enviar" id="enviar" value="REGISTRAR">
                  <input type="reset" name="reeset" id="reset" value="RESET">

                </form>
                    
              </dialog>

                <?php

                  //Conexion con base de datos
                  $usuario = 'root';
                  $password = 'Admin1234';
                  $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
                  //Preparamos la consulta y la ejecutamos guardamos su resultado en $data
                  
                  $query = $db->prepare("SELECT ID_Departamento, Nombre FROM Departamento;");
                  $query->execute();
                  $data = $query->fetchAll();

                  echo '<table>';
                  echo '<tr><th>Nombre</th><th>Modificar</th></tr>';
                  //Recorremos $data con el foreach y mostramos los valores[nombre de la tabla]
                  
                  foreach ($data as $valores):
                    echo '<tr><td>'. $valores['Nombre'] .'</td><td><a href="editarDepartamentoForm.php?id='.$valores['ID_Departamento'].'" ><img src="img/icons8-lápiz-64.png" height="32px""></a><a onclick="confirmar(event)" href="borrarDepartamento.php?id='.$valores["ID_Departamento"].'"><img src="images/icons8-eliminar-96.png" height="32px""></a></td></tr>';
                  endforeach;

                  echo '</table>';

                 

                ?>

              


                <!--Funcion javascript para confirmar si queremos borrar, si le damos a cancelar se ejecuta el prevendefult que cancela el evento de borrar  -->
                <script>
                    function confirmar(e){
                        var res = confirm('¿Estas seguro de que quieres BORRAR este departamento?');
                        if(res == false){
                            e.preventDefault();
                        }
                    }
                </script>
            


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

