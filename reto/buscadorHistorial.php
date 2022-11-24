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

      <!-- ICONO DE PAGINA
    -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- TÍTULO -->
      <title>Historico</title>
      
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
            echo '<a class="nav-link active" href="historico">Historico</a>';
            echo '</li>';

          }

          ?>
          <li class="nav-item">
            <a class="nav-link" href="departamentos">Ubicaciones</a>
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

    <!-- BUSCADOR -->
        
   
            <div class="buscador">
              <form action="buscador.php" method="POST">
                <input type="text" name="texto" id="texto">
                <input type="submit" name="search" id="search" value="BUSCAR">
              </form>
            </div><br><br><br>
    
            <?php
            //Si se ha pulsado el botón de buscar
            if (isset($_POST['search'])) {


                //Recogemos las claves enviadas
                $keywords = $_POST['texto'];

                //Conectamos con la base de datos en la que vamos a buscar
                $usuario = 'root';
                $password = 'Admin1234';
                $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);

                $consulta=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Usuario.Nom_Usuario as Nom_Usuario
                                          FROM Publicacion, Usuario 
                                          WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario
                                          and (Titulo LIKE '%".$keywords."%'
                                          OR Descripcion LIKE '%".$keywords."%'
                                          OR Tipo_Publicacion LIKE '%".$keywords."%'
                                          OR Estado LIKE '%".$keywords."%'
                                          OR Nom_Usuario LIKE '%".$keywords."%')
                                          ORDER BY fecha_Fin desc");
                $consulta->execute();
                $data=$consulta->fetchAll();


                

                //Si ha resultados
                if (empty($data)) {
                    echo '<h2>Resultados</h2>';
                    echo '<h3>No se encuentran resultados con los criterios de búsqueda.</h3>';
                    
                }
                else {
                    //Si no hay registros encontrados
                    echo '<h2>Resultados</h2>';

                    echo '<table>';
                    echo '<tr><th>Noticia</th><th>Titulo</th><th>Tipo de Publicación</th><th>Estado</th><th>Fecha de Inicio</th><th>Fecha de fin</th><th>Publicado por</th></tr>';
                    //Recorremos con foreach y mostramos los datos
                      foreach ($data as $valores):
                        echo '<tr><td><button id="show" onclick="verinfocliente('.$valores['ID_Publicacion'].');window.modal.showModal() "> Ver Noticia</button></td><td>'. $valores['Titulo'] .'</td><td>'. $valores['Tipo_Publicacion'] .'</td><td>'. $valores['Estado'] .'</td><td>'. $valores['Fecha_Inicio'] .'</td><td>'. $valores['Fecha_Fin'] .'</td><td>'. $valores['Nom_Usuario'] .'</td></tr>';
                      endforeach;
                    echo '</table>';
                    }}
                  ?>
              
              <script type="text/javascript">
                var id = document.querySelector("button").getAttribute("onclick");
                const datos=<?php echo json_encode($data)?>;
                  function verinfocliente(id){
                  
                   
                   let o=datos.find(elemento=>elemento.ID_Publicacion == id);
                    
                    document.getElementById('titulo').innerHTML=o.Titulo;
                    document.getElementById('desc').innerHTML=o.Descripcion;
                    document.getElementById('img').innerHTML='<img src="'+o.Multimedia+'">';
                  }
              </script>
              
          
                <dialog id="modal">
          
                <h2>Noticia <button  onclick="window.modal.close();"> X </button></h2><br>
          
                    <?php
          
          
                    //Conexion con base de datos
                    /*$usuario = 'root';
                    $password = 'Admin1234';
                    $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
                    //Consulta
                    $idd=$valores['ID_Publicacion'];
                    $consulta2=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia FROM Publicacion WHERE ID_Publicacion=$idd");
                    $consulta2->execute();
                    $datas=$consulta2->fetchAll();
                    foreach ($datas as $valores):*/
                    echo '<div class="contenido">';
                    echo '<div class="titulo-noticia">';
                    echo '<h3 id="titulo"></h3><br>';
                    echo '</div>';
                    echo '<p id="desc"><p>';
                    echo '<div class="imagen-noticia" id="img"><img id="img-bd" src=""></div>';
                    echo '</div>';
                    //endforeach;
                    ?>
          
                      
                </dialog>


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