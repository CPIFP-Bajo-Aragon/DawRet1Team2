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

      <link rel="stylesheet" href="css/formulario.css">

      <!-- ICONO DE PAGINA
    -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- TÍTULO -->
      <title>Nueva Publicación</title>
      
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
            <a class="nav-link active" href="formulario">Nueva Publicación</a>
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
      <div class="flex-supremo">
        <div class="flex-container">
          <div class="contenedor">
            <h3>NUEVA PUBLICACIÓN</h3><br>
            <form action="enviar" method="post" enctype="multipart/form-data" name="formulario" onsubmit="return validarFormulario()">

              <label for="">Titulo: </label><br>
              <input type="text" name="Titulo" id="Titulo" placeholder="Titulo *" required><br><br>
              <label for="">Descripcion:</label><br>
              <textarea name="Descripcion" id="Descripcion" cols="50" rows="5" placeholder="Descripción *" required></textarea><br><br>
              <label for="">Ubicacion:</label><br>
              <select name="Ubicacion" id="Departamento">
                        
                <?php

                  $usuario = 'root';
                  $password = 'Admin1234';
                  
                  $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);

                  $query = $db->prepare("SELECT * FROM Departamento");
                  $query->execute();
                  $data = $query->fetchAll();

                  foreach ($data as $valores):
                    echo '<option>'.$valores["Nombre"].'</option>';
                  endforeach;

                  ?>

                </select><br><br>

                <label for="">Pantallas: </label><br>

                <?php

                $query = $db->prepare("SELECT Departamento.*, Pantalla.ID_Pantalla, Pantalla.Nombre, Estar.* 
                FROM Departamento, Pantalla, Estar 
                WHERE Departamento.ID_Departamento=Estar.ID_Departamento 
                and Estar.ID_Pantalla = Pantalla.ID_Pantalla");
               
                $query->execute();
                
                $data2 = $query->fetchAll();
                
                foreach ($data2 as $valores2):
                  echo $valores2;
                  echo '<input type="checkbox" name="nom_pantalla" id="nom_pantalla">'.$valores2['Pantalla.Nombre'];
                  
                endforeach;
                ?>

                <br>

                <label for="">Tipo Publicacion: </label><br>
                <select>
                  <option value="">Noticia</option>
                  <option value="">Reunión</option>
                  <option value="">Nose</option>
                </select><br><br>
                <label for="">Fecha Inicial</label>
                <input type="date" name="FechaInicial" id="FechaInicial" class="fecha" required><br><br>
                <label for="">Fecha Final</label>
                <input type="date" name="FechaFinal" id="FechaFinal" class="fecha" required onblur="validarFecha(this)"><br><br>
                <label for="">Archivo:</label><br>
                <input type="file" name="Multimedia" id="Multimedia"><br><br>
                <input type="submit" name="enviar" id="enviar" value="ENVIAR">
                <input type="reset" name="reeset" id="reset" value="RESET">

              </form>
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

<script>

function validarFecha(fecha) {
    var fechaIni=document.getElementById('FechaInicial').value;
    var fechafinal=fecha.value;
    
    if (fechafinal>=fechaIni) {  
        fecha.style = "border: 1px solid green;";
        return true;
    } else {
        fecha.style = "border: 1px solid red;";
        return false;
    }
}

function validarFormulario() {
    event.preventDefault();

    var fecha = document.getElementById('FechaFinal');
    var f = validarFecha(fecha);
    
    if (f) {
        document.formulario.submit();
    }else{
      alert("Formato Incorrecto");
    }
}
</script>
