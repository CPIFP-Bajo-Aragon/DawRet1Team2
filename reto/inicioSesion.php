<?php
    session_start();
    include "conection.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php

        if(!isset($_POST['CONFIRMAR']))

        $conexion=conectarBD();

           $usuario=$_POST['user'];
           $clave=$_POST['pass'];
           
    
           //Escribir Consulta
                $sql="SELECT * FROM Usuario WHERE Nom_Usuario=\"$usuario\" and Pass_User= CONCAT('*', UPPER(SHA1(UNHEX(SHA1('$clave')))))"; 
                
           // Ejecutar consulta
                $consulta = $conexion->prepare($sql);
                $consulta->execute();

            // contar numero de filas
                $nfilas=$consulta->rowCount();
                
            // verificar el LOGIN

               if($nfilas==1) :
                    
                    $fila = $consulta->fetch();   
                    $_SESSION['rol']=$fila->ID_Rol;
                    $_SESSION['nombre']=$fila->Nom_Usuario;
                    header("Location:pagina.php");
                    
                    
                    
                elseif ($nfilas==0) :
                    
                    ?>
                    
                    <p>
                    Nombre de usuario y/o contraseña incorrecto. Será redireccionado en 3 segundos.
                    </p>
                    <p>
                        Si no es redireccionado automáticamente, haga click <a href="index.php">aquí</a>.
                    </p>
                    
                    </main>
                    <?php
                        header("refresh:4;url=index.php");
                else : 
                    ?>
                        <p>Ha ocurrido un error fatal, contacte con el administrador.</p>
                        <p>Redirigiendo en 3 segundos.</p>
                    <?php
                    header("refresh:4;url=index.php");
                endif;

        $conexion = null;

    ?>

</body>