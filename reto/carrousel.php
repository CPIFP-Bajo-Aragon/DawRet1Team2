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

      <link rel="stylesheet" href="css/pantalla.css">

      <!-- ICONO DE PAGINA -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> -->

      <!-- TÍTULO -->
      <title>Carrousel</title>
      
      <!-- Montserrat -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,900;1,900&display=swap" rel="stylesheet"> 

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;0,900;1,900&display=swap" rel="stylesheet"> 
        
  </head>

  <body>
  
  <!----------- CABECERA Y MENÚ ----------->

  <header>
    <img id="cabecera" src="images/logo.png">
    
  </header>

  <!----------- FIN DE CABECERA Y MENÚ ----------->

  <!----------- CONTENIDO DE LA PÁGINA ----------->
<?php
            $usuario = 'root';
            $password = 'Admin1234';
            $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);

            //$id=$_GET['id'];
            //Consulta
            /*$consulta=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Publicacion.ID_Usuario as ID_Usuario, Usuario.Nom_Usuario as Nom_Usuario FROM Publicacion, Usuario WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario AND Fecha_Fin>=CURRENT_DATE() and Estado='Aceptada' and Fecha_Inicio<=CURRENT_DATE() ORDER BY Fecha_Fin");
            $consulta->execute();
            $data=$consulta->fetchAll();*/

            $ipAddress=$_SERVER['REMOTE_ADDR'];
            $arp=`arp -n $ipAddress`;
            $string = str_replace(' ', '', $arp);
            $lines=explode(":", $string);
            $first = substr($lines[0], -2).":";
            $last = substr($lines[5], 0, 2);

            $mid="";
            for ($i=1; $i <=4 ; $i++) { 
              
              $mid .= $lines[$i].":";
              
              
            }
            
            $mac = $first.$mid.$last;
             
              
            
                $consulta=$db->prepare("SELECT p.ID_Publicacion, p.Titulo, p.Descripcion, p.Multimedia, p.Tipo_Publicacion, p.Estado, p.Fecha_Inicio, p.Fecha_Fin, p.ID_Usuario as ID_Usuario, Usuario.Nom_Usuario as Nom_Usuario FROM Usuario,((Mostrar INNER JOIN Pantalla ON Mostrar.ID_Pantalla = Pantalla.ID_Pantalla) INNER JOIN Publicacion p ON Mostrar.ID_Publicacion = p.ID_Publicacion) WHERE Pantalla.Identificador='$mac' AND Usuario.ID_Usuario=p.ID_Usuario AND Fecha_Fin>=CURRENT_DATE() and Estado='Aceptada' and Fecha_Inicio<=CURRENT_DATE() ORDER BY Fecha_Fin" );
                //print_r($consulta);
                $consulta->execute();
                $data=$consulta->fetchAll();
                // print_r($data);
                // exit();
                
               
          ?>
            
         
  <section>  
      
        <div class="slideshow-container">
          <?php
          //Muestra cada publicacion de la consulta
          foreach ($data as $valores):
            echo '<div class="publicacion fade">';
                echo '<br><h2>'.$valores["Titulo"].'</h2>';
                echo '<div class="descripcion">';
                echo '<div class="user"><p>'.$valores["Nom_Usuario"].'</p></div>';
                
                echo '<div class="descrip"><p>'.$valores["Descripcion"].'</p></div>';
                
                echo '</div>';
                if($valores["Multimedia"]==0){
                  echo '<br>';
                }else{
                  echo '<div class="imagen"><img src="'. $valores["Multimedia"] .'" ;></div><br>';
                }
            echo '</div>';
            
          endforeach;
          
          ?>
        </div>

      <div style="text-align:center">
        <!-- <span class="dot"></span> -->
          <?php
          //Muestra un circulo por cada publicacion de la consulta 
          foreach ($data as $valores):
            echo '<span class="dot"></span>';
          endforeach;
          ?>
      </div>
</section>

  <?php
  //Si no hay publicación, muestra el reloj
    if (empty($data)) {
      header("Location:reloj");
      exit();
    }
  
  ?>

  <script>

        let slideIndex = 0;//Contador de publicaciones
        showSlides();
        
        function showSlides() {
          let i;
          let slides = document.getElementsByClassName("publicacion");
          let dots = document.getElementsByClassName("dot");
          //Bucle que recorre todas las publicaciones que hay
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;//Suma uno al contador
          if (slideIndex > slides.length) {slideIndex = 1}//Si ya no hay mas publicaciones, vuelve a la primera    
          //Bucle del circulo que esta activo
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 10000); // Cambia de imagen cada cierto tiempo
        }
    </script>


  <!----------- FIN DE CONTENIDO DE LA PÁGINA ----------->

  <!----------- FOOTER ----------->


  
    <footer>
    © Copyright 2022:  
    <a href="https://cpifpbajoaragon.com">CPIFP Bajo Aragón</a>
    INFOJOVE
    </footer>
  

  <!----------- FIN DEL FOOTER ----------->

  </div>
  </body>
</html>
<!--Recargas la pagina cada cierto tiempo -->
<script type="text/javascript">
        setTimeout(function(){ location.reload(1);}, 80000);
</script>