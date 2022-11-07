<?php
require 'conection.php';


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inicioSesion.css">
    <link rel="shortcut icon" href="logo.png">
    <title>Iniciar sesion</title>
</head>
<body>

<div class="pagina">
    <div class="flex-supremo">
        <h1>INICIAR SESIÓN</h1>
        <div class="flex-container">
        
            <div  class="contenedor">
                <form action="inicioSesion.php" method="post">

                    <label for="">USUARIO:</label><br>
                    <input type="text" name="user" id="pass"><br><br>
                    <label for="">CONTRASEÑA:</label><br>
                    <input type="password" name="pass" id="pass"><br><br>
                    <input type="submit" name="send" id="send" value="CONFIRMAR">
                </form>
            </div>
        </div>
    </div>
    <div class="pie-de-pagina">
        <footer>
            © Copyright 2022: 
            <a href="https://cpifpbajoaragon.com">CPIFP Bajo Aragón</a>
        </footer>
    </div>

</div>
</body>
</html>