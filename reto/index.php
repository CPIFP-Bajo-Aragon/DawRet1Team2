<!DOCTYPE html>
<html lang="es">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- CSS -->

      <link rel="stylesheet" href="css/inicioSesion.css">

      <!-- ICONO DE PAGINA -->
      <link rel="shortcut icon" href="images/logo.png">

      <!-- BOOTSTRAP -->

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- TÍTULO -->
      <title>Inicio</title>
      
  </head>
<body>

<div class="pagina">
    <div class="flex-supremo">
        
        <div class="flex-container">
        
            <div  class="contenedor">
            <h2>INICIAR SESIÓN</h2><br><br>
                <form action="inicioSesion" method="post">

                    <label for="">USUARIO:</label><br>
                    <input type="text" name="user" id="user"><br><br>
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