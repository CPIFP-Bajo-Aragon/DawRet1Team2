<?php

session_start();
if(!isset($_SESSION['id'])){
  header("Location:index");
  exit();
}

require "conection.php"; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pantalla</title>
    
    <!-- CSS -->

    <!-- <link rel="stylesheet" href="css/estilos.css"> -->
    <link rel="stylesheet" href="css/formulario.css"> 

    <!-- ICONO DE PAGINA
    -->
    <link rel="shortcut icon" href="images/logo.png">

    <!-- BOOTSTRAP -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- TÍTULO -->
    <title>Editar Pantalla</title>
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
              echo  '<li><a class="dropdown-item" href="listaDepartamentos">Gestionar Ubicaciones</a></li>';
              echo '</ul>';

            }

            ?>


          </li>
        </ul>
      </div>
    </div>
  </nav>

<!----------- FIN DE CABECERA Y MENÚ ----------->
<div class="pagina">
<!----------- CONTENIDO DE LA PÁGINA ----------->

<?php
$usuario = 'root';
$password = 'Admin1234';
$db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
    
    $id=$_GET['id'];

    $consulta= $db->prepare("SELECT p.ID_Pantalla,p.Nombre,p.Identificador,p.ID_Departamento, d.Nombre as Nom_dep, d.ID_Departamento as ID_Dep FROM Pantalla p, Departamento d WHERE ID_Pantalla='$id' and p.ID_Departamento=d.ID_Departamento");
    $consulta->execute();
    $data2=$consulta->fetchAll();
    
    //print_r($data2);

?>

<div class="pagina">
    <div class="flex-supremo">
        <div class="flex-container">
            <div class="contenedor">
            <div class="atras"><div class="item1"><h3>EDITAR PANTALLA </h3></div><div class="item2"><a href="listaPantallas"><img src="img/atras.png" id="flecha" ></a></div></div><br><br>
            
            
                <form action="editarPantalla.php?id=" method="POST">

                <!-- <label for="">ID: </label><br> -->
                <input type="hidden" name="ID_Pantalla" id="ID_Pantalla" autofocus="autofocus" value="<?php echo $data2[0]["ID_Pantalla"];?>">
                
                <label for="">Nombre: </label><br>
                <input type="text" name="Nombre" id="Nombre" value="<?php echo $data2[0]["Nombre"];?>"><br><br>

                <label for="">Identificador: </label><br>
                <input type="text" name="Identificador" id="macAddress" value="<?php echo $data2[0]["Identificador"];?>"><br><br>
                <script>
                  var macAddress = document.getElementById("macAddress");

                  function formatMAC(e) {
                      var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
                          //Valida si las letras estan dentro de la A a la F 
                          //Si no, coloca espacio en blanco
                          str = e.target.value.replace(/[^a-f0-9]/ig, "");

                      while (r.test(str)) {
                          //Coloca : despues de cada 2 digitos
                          str = str.replace(r, '$1' + ':' + '$2');
                      }

                      e.target.value = str.slice(0, 17);
                  };

                  macAddress.addEventListener("keyup", formatMAC, false);

                  </script>
                <label for="">Ubicacion: </label>
                <select name="ID_Departamento"id="Departamento">
                        
                <?php
 
                  $usuario = 'root';
                  $password = 'Admin1234';
                  
                  $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);

                  $query = $db->prepare("SELECT * FROM Departamento");
                  $query->execute();
                  $data = $query->fetchAll();
                  echo '<option value="'.$data2[0]["ID_Dep"].'">'.$data2[0]["Nom_dep"].'</option>';
                  foreach ($data as $valores):
                    
                    echo '<option value="'.$valores["ID_Departamento"].'">'.$valores["Nombre"].'</option>';
                    
                  endforeach;
                  
                  ?>
                  
                </select><br><br>
                
                <input type="submit" name="enviar" id="enviar" value="ENVIAR">
                <input type="reset" name="reeset" id="reset" value="RESET">

                </form>


            </div>
        </div>
    </div>
</div>

<div class="pie-de-pagina">
      <footer>
      © Copyright 2022:
      <a href="https://cpifpbajoaragon.com">CPIFP Bajo Aragón</a>
      INFOJOVE
      <a href="img/manual.pdf">Ayuda</a>
      </footer>
    </div>  
                </div>

</body>
</html>