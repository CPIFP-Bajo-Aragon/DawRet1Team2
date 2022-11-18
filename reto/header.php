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
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <title>INICIO</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="pagina.php">
            <img src="logo.png" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pagina.php">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="formulario.php">Formulario</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="historico.php">Historico</a>
                </li>
                
                <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="true">
                    
                <?php 
                
                    echo $_SESSION["nombre"];
                
                    echo '</a>';


                if (isset($_SESSION["rol"]) && $_SESSION["rol"]==3) {

                    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
                    echo  '<li><a class="dropdown-item" href="index.php">Cerrar Sesión</a></li>';
                    echo '</ul>';

                } else {
        
                    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
                    echo  '<li><a class="dropdown-item" href="index.php">Cerrar Sesión</a></li>';
                    echo  '<li>';
                    echo  '<hr class="dropdown-divider">';
                    echo  '</li>';
                    echo  '<li><a class="dropdown-item" href="añadirUser.php">Añadir Usuario</a></li>';
                    echo '</ul>';

                }

                ?>
                </li>
            </ul>
            </div>
        </div>
        </nav>
</body>
</html>