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

<div class="pagina" id="resultado">

    <!-- BUSCADOR  -->

           <!-- <div class="buscador">
              <form action="buscadorHistorial.php" method="POST">
                <input type="text" name="texto" id="texto">
                <input type="submit" name="search" id="search" Value="BUSCAR">
              </form>
            </div><br><br> -->

       

    <!-- FIN BUSCADOR -->

        <div class="ordenar">
          <input type="button" name="ordenar" id="ordenar" value="Ordenar por Fecha" onclick="ordenar()" >
        </div><br><br>

        

        <?php
          //Conexion con base de datos
          $usuario = 'root';
          $password = 'Admin1234';
          $db = new PDO('mysql:host=localhost;dbname=Prueba2', $usuario, $password);
          //Consulta
          $consulta=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Usuario.Nom_Usuario as Nom_Usuario FROM Publicacion, Usuario WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario");
          $consulta->execute();
          $data=$consulta->fetchAll();
       
          echo '<table id="publi">';
          echo '<tr><th>Noticia</th><th>Titulo</th><th>Tipo de Publicación</th><th>Estado</th><th>Fecha de Inicio</th><th>Fecha de fin</th><th>Publicado por</th></tr>';
          //Recorremos con foreach y mostramos los datos
            foreach ($data as $valores):
              echo '<tr><td><button id="show" onclick="verinfocliente('.$valores['ID_Publicacion'].');window.modal.showModal() "> Ver Noticia</button></td><td>'. $valores['Titulo'] .'</td><td>'. $valores['Tipo_Publicacion'] .'</td><td>'. $valores['Estado'] .'</td><td>'. $valores['Fecha_Inicio'] .'</td><td>'. $valores['Fecha_Fin'] .'</td><td>'. $valores['Nom_Usuario'] .'</td></tr>';
            endforeach;
          echo '</table>';
         
        ?>
    <!--codigo javascript para mostrar los datos de ver noticias -->
    <script type="text/javascript">
      //cogemos la id de la fila que queramos y la cual esta en el onclick
      var id = document.querySelector("button").getAttribute("onclick");
      //pasanos el array con todos los datos a un array javascript
      const datos=<?php echo json_encode($data)?>;
        function verinfocliente(id){
        
         //le pasamos la id y con el find vamos a buscar la id que sea igual a la que le pasamos para poder mostrar la informacion de esa noticia exacta
         let o=datos.find(elemento=>elemento.ID_Publicacion == id);
          //le ponemos los valores que queremos a los elementos de la ventana modal
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
  <script type="text/javascript">
    const datosTabla=<?php echo json_encode($data)?>;
    //funcion para ordenar las publicaciones por orden de fecha de inicio 
    function ordenar(){
      //cuando llamamos a la funcion le decimos a la tabla que tenemos que se ponga en display none
      const ocul=document.getElementById("publi").style = 'display: none;';
      //ordenamos la tabla con la funcion sort los parametros a y b nos indicaran que fecha es mayor o menor
      const d= datosTabla.sort((a, b) => new Date(a.Fecha_Inicio).getTime() > new Date(b.Fecha_Inicio).getTime());
      
    //creamos la tabla con javascript
    const contenedor = document.getElementById("resultado");
 
    const tabla = document.createElement("table");
 
    let tr = document.createElement("tr");
      //array para poner en th y no tener que escribir tanto codigo
    const array = [
      {nombre: "Noticia"},
      {nombre: "Titulo"},
      {nombre: "Tipo de Publicacion"},
      {nombre: "Estado"},
      {nombre: "Fecha de Inicio"},
      {nombre: "Fecha de Fin"},
      {nombre: "Publicado por"},
    ];
    //recorremos array y le ponemos cada una a una columna
    for (let i = 0; i < array.length; i++) {
      let th = document.createElement("th");
      let thText = document.createTextNode(array[i].nombre);
      th.appendChild(thText);
      tr.appendChild(th);
      
    }

    //recorremos el array con todos los datos y llenamos la tabla
    d.forEach((e) => {

      tabla.appendChild(tr);
 
      tr = document.createElement("tr");
      
      td = document.createElement("td");
      button= document.createElement("button");
      button.innerHTML="Ver Noticia";
      button.id="show";
      //le damos al boton que hemos creado la funciones correspondientes
      button.onclick=function () {
        verinfocliente(e.ID_Publicacion);
        window.modal.showModal();
      };
      //button.appendChild(Text);
      td.appendChild(button);
      tr.appendChild(td);
 
      td = document.createElement("td");
      tdText = document.createTextNode(e.Titulo);
      td.appendChild(tdText);
      tr.appendChild(td);
 
      td = document.createElement("td");
      tdText = document.createTextNode(e.Tipo_Publicacion);
      td.appendChild(tdText);
      tr.appendChild(td);

      td = document.createElement("td");
      tdText = document.createTextNode(e.Estado);
      td.appendChild(tdText);
      tr.appendChild(td);

      td = document.createElement("td");
      tdText = document.createTextNode(e.Fecha_Inicio);
      td.appendChild(tdText);
      tr.appendChild(td);

      td = document.createElement("td");
      tdText = document.createTextNode(e.Fecha_Fin);
      td.appendChild(tdText);
      tr.appendChild(td);

      td = document.createElement("td");
      tdText = document.createTextNode(e.Nom_Usuario);
      td.appendChild(tdText);
      tr.appendChild(td);
 
      tabla.appendChild(tr);
 
    });
 
    contenedor.appendChild(tabla);

      
    }
         
  </script>