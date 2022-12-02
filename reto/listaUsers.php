<?php

session_start();
if(!isset($_SESSION['id'])){
  header("Location:index");
  exit();
}

//print_r($_SESSION['id']);

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
      <title>Gestionar Usuarios</title>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>

    
      
  </head>
<body>
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
            <a class="nav-link active" aria-current="pagina" href="pagina">Inicio</a>
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


  echo '<li class="nav-item">';
  echo  '<a class="nav-link" href="departamentos">Ubicaciones</a>';
  echo '</li>';

}

?>
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
    

  } else if (isset($_SESSION["rol"]) && $_SESSION["rol"]==2){

    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
    echo  '<li><a class="dropdown-item" href="perfil">Perfil</a></li>';
    echo  '<li><a class="dropdown-item" href="cerrarsesion">Cerrar Sesión</a></li>';
    echo  '<li>';
    echo  '<hr class="dropdown-divider">';
    echo  '</li>';
    echo  '<li><a class="dropdown-item" href="gestionarPubli">Gestionar Publicaciones</a></li>';
    echo  '</li>';
    

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
    echo  '<li><a class="dropdown-item" href="listaDepartamentos">Gestionar Ubicaciones</a></li>';
    echo '</ul>';
  }

  ?>


          </li>
        </ul>
      </div>
    </div>
  </nav>
    <div class="pagina">
    <div class="buscador">
              <form action="buscadorUsuario" method="POST">
                <input type="text" name="texto" id="texto">
                <input id="buscar" type="submit" name="search" id="search" value="BUSCAR">
              </form>
            </div>
            <button id="add-btn" onclick="window.modal.showModal();">Añadir Usuario</button>
            
          

              <dialog id="modal">

              <h3>AÑADIR USUARIO <button  onclick="window.modal.close();"> X </button></h3><br>
                    <form action="añadirUsuario" method="post" onsubmit="return validarFormulario()" name="formulario">

                        <label for="">Nombre Usuario: </label><br>
                        <input type="text" name="name" id="name" required ><br><br>
                        <label for="">Nombre Completo: </label><br>
                        <input type="text" name="comp" id="comp" required onkeyup="validarNombreCompleto(this)"><br><br>
                        <label for="">Contraseña:</label><br>
                        <input type="password" name="password" required><br><br>
                        <label for="">Correo: </label><br>
                        <input type="email" name="email" id="email" required onkeyup="validarCorreo(this)"><br><br>
                        <label for="">Rol:</label><br>
                        <select name="rol" id="" required>
                        <?php
                          $usuario = 'root';
                          $password = 'Admin1234';
                          $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);

                          $query = $db->prepare("SELECT * FROM Rol");
                          $query->execute();
                          $data = $query->fetchAll();

                          foreach ($data as $valores):
                              echo '<option value="'.$valores["ID_Rol"].'">'.$valores["Nombre"].'</option>';
                              endforeach;
                        ?>
                        </select><br><br>    
                        <label for="">Departamento:</label><br>
                        <select name="departamento" id="">
                        <?php
                          $usuario = 'root';
                          $password = 'Admin1234';
                          $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);

                          $query = $db->prepare("SELECT * FROM Departamento");
                          $query->execute();
                          $data = $query->fetchAll();

                          foreach ($data as $valores):
                              echo '<option value="'.$valores["ID_Departamento"].'">'.$valores["Nombre"].'</option>';
                              endforeach;
                        ?>
                        </select><br><br>
                        
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
                  
                  $query = $db->prepare("SELECT ID_Usuario, Nom_Usuario, Nombre_Completo, Rol.Nombre as Nombre_Rol, Correo_Usuario,Departamento.Nombre as Nombre_Departamento FROM Usuario, Departamento, Rol WHERE Usuario.ID_Rol=Rol.ID_Rol and Usuario.ID_Departamento=Departamento.ID_Departamento;");
                  $query->execute();
                  $data = $query->fetchAll();

                  echo '<div class="tabla-gestion"> <table>';
                  echo '<tr><th>Usuario</th><th>Nombre Completo</th><th>ROL</th><th>Correo</th><th>Ubicación</th><th>Modificar</th></tr>';
                  //Recorremos $data con el foreach y mostramos los valores[nombre de la tabla]
                  
                  foreach ($data as $valores):
                    echo '<tr><td>'. $valores['Nom_Usuario'] .'</td><td>'. $valores['Nombre_Completo'] .'</td><td>'. $valores['Nombre_Rol'] .'</td><td>'. $valores['Correo_Usuario'] .'</td><td>'. $valores['Nombre_Departamento'] .'</td><td><a href="UsuarioEditar.php?id='.$valores["ID_Usuario"].'"><img src="img/icons8-lápiz-64.png" class="gest-icons" ></a><a onclick="confirmar(event)" href="borrarUsuario.php?id='.$valores["ID_Usuario"].'"><img src="images/icons8-eliminar-96.png" class="gest-icons"></a></td></tr>';
                  endforeach;

                  echo '</table></div>';

                 

                ?>
                <!--Funcion javascript para confirmar si queremos borrar, si le damos a cancelar se ejecuta el prevendefult que cancela el evento de borrar  -->
                <script>
                    function confirmar(e){
                        var res = confirm('¿Estas seguro de que quieres borrar ese usuario?');
                        if(res == false){
                            e.preventDefault();
                        }
                    }
                </script>



  <!----------- FIN DE CONTENIDO DE LA PÁGINA ----------->
  <!----------- FOOTER ----------->

     <!-- Pie de pagina -->
     <div class="pie-de-pagina">
      <footer>
      © Copyright 2022:
      <a href="https://cpifpbajoaragon.com">CPIFP Bajo Aragón</a>
      INFOJOVE
      <a href="img/manual.pdf">Ayuda</a>
      </footer>
    </div>  

  <!----------- FIN DEL FOOTER ----------->

  </div>      

</body>
</html>


<script>
function validarNombreCompleto(nombre) {
    var n = nombre.value;
    var regName = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
    if (!regName.test(n)) {
        nombre.style = "border: 1px solid red;";
        return false;
    } else {
        nombre.style = "border: 1px solid green";
        return true;
    }
}

function validarCorreo(correo) {

    var c = correo.value;

    if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(c))) {
        correo.style = "border: 1px solid red";
        return false;
    } else {
        correo.style = "border: 1px solid green";
        return true;
    }
}




function validarFormulario() {
    event.preventDefault();
    
    var name = document.getElementById('comp');
    var nbr = validarNombreCompleto(name);
    var correo = document.getElementById('email');
    var c = validarCorreo(correo);
    
    if (nbr && c) {
        document.formulario.submit();
    }else{
      alert("Error");
    }
}
</script>

