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

      <!-- ICONO DE PAGINA -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- TÍTULO -->
      <title>Inicio</title>
      
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
    <div class="pagina">
        <div class="contenedor">
            <div id="datos" class="contenido"></div>
            <button onclick="pagAnterior()"id="btn_anterior">Ant</button>&nbsp;
            <button onclick="pagSiguiente()"id="btn_siguiente">Sig</button>
            
        </div>

        
    <div class="pie-de-pagina">
      <footer>
      © Copyright 2022:  
      <a href="https://cpifpbajoaragon.com">CPIFP Bajo Aragón</a>
      INFOJOVE
      </footer>
    </div>    



    </div>        

</body>
</html>
<?php

    $usuario = 'root';
    $password = 'Admin1234';
    $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
    //Consulta
    $consulta=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Publicacion.ID_Usuario as ID_Usuario, Usuario.Nom_Usuario as Nom_Usuario FROM Publicacion, Usuario WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario AND Fecha_Fin>=CURRENT_DATE() and Estado='Aceptada' and Fecha_Inicio<=CURRENT_DATE() ORDER BY Fecha_Fin");
    $consulta->execute();
    $data=$consulta->fetchAll();
    
    if (empty($data)) {
      header("Location:reloj");
      exit();
    }

?>
<script>
    const datosTabla=<?php echo json_encode($data)?>;
    var obj = datosTabla;
    var pag = 1;
    var datos_pag = 4;
    function NumPaginas(){
        //la funcion math.ceil devuelve el numero entero mas cercano a la division de los datos de la pagina dividido por el numero que queremos mostrar en este caso 4
        return Math.ceil(obj.length / datos_pag);
    }
    //funcion para pasar a la pagina anterior si pag es mayor que 1 restamos uno a pag y llamamos a cambiar pag
    function pagAnterior(){
        if (pag > 1) {
            pag--;
            cambiarPag(pag);
        }
    }
    //funcion para pasar a la pagina siguiente si pag es menor que el numero de paginas que tenemos sumamos uno a pag y llamamos a cambiar pag
    function pagSiguiente(){
        if (pag < NumPaginas()) {
            pag++;
            cambiarPag(pag);
        }
    }
    //funcion para poder cambiar de pagina
    function cambiarPag(pagina){
        var btn_anterior = document.getElementById("btn_anterior");
        var btn_siguiente = document.getElementById("btn_siguiente");
        var datos = document.getElementById("datos");
        
        if (pagina < 1) pagina = 1;
        if (pagina > NumPaginas()) pagina = NumPaginas();
            datos.innerHTML = "";
            datos.innerHTML += '<div class="contenido">';
            datos.innerHTML += '<div class="titulo-noticia">';
            datos.innerHTML += '<h2>PUBLICACIONES</h2>';
            
        for (var i = (pagina-1) * datos_pag; i < (pagina * datos_pag); i++) {
            if(i<obj.length){
                datos.innerHTML += '<div class="subtitulo"><p id="usuario">Publicado por '+obj[i].Nom_Usuario+' el dia '+obj[i].Fecha_Inicio+'</p><p id="expira"> Expira el: '+obj[i].Fecha_Fin+'</p></div>';"<br><br>";
                datos.innerHTML += '</div>';
                datos.innerHTML += '<h3>'+obj[i].Titulo+'</h3><br>';
                datos.innerHTML += '<p>'+obj[i].Descripcion+'</p>';
                datos.innerHTML += '<div class="imagen-noticia"><img id="img-bd" src="'+obj[i].Multimedia+'"></div>';
                datos.innerHTML += '<hr>';
            }
        }
        
        
        if (pagina == 1) {
            btn_anterior.style.visibility = "hidden";
        } else {
            btn_anterior.style.visibility = "visible";
        }
        //console.log(pagina);
        //console.log(NumPaginas());
        if (pagina == NumPaginas()) {
            btn_siguiente.style.visibility = "hidden";
        } else {
            btn_siguiente.style.visibility = "visible";
        }
    }
    //cuando cargue la pagina llamar a la funcion cambiar pagina pasandole el numero de la primera pagina
    window.onload = function() {
        cambiarPag(1);
    };
    </script>
    <!--Recargas la pagina cada cierto tiempo -->
    <script type="text/javascript">
        setTimeout(function(){ location.reload(1);}, 30000);
    </script>