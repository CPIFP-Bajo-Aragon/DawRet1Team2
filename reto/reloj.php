<?php

include "funciones.php";

inicio_sesion();
require "conection.php";


$usuario = 'administrador';
$password = 'Admin1234';
$db = new PDO('mysql:host=192.168.4.232;dbname=Prueba2', $usuario, $password);

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
//Consulta
/*$consulta=$db->prepare("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Publicacion.ID_Usuario as ID_Usuario, Usuario.Nom_Usuario as Nom_Usuario FROM Publicacion, Usuario WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario AND Fecha_Fin>=CURRENT_DATE() and Estado='Aceptada'  and Fecha_Inicio<=CURRENT_DATE()");
$consulta->execute();
$data=$consulta->fetchAll();*/
    //Compreba si $data esta vacio, si no esta te lleva a la pagina pagina.php
    if (!empty($data)) {
          header("Location:carrousel");  
    }

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reloj.css">
    <link rel="shortcut icon" href="logo.png">
    <title>Reloj</title>
    <script language="JavaScript">
        
        
        function mueveReloj(){

                momentoActual = new Date()
                hora = momentoActual.getHours()
                minuto = momentoActual.getMinutes()
                segundos = momentoActual.getSeconds()

                str_segundo = new String (segundos)
                if (str_segundo.length == 1)
                segundos = "0" + segundos

                str_minuto = new String (minuto)
                if (str_minuto.length == 1)
                minuto = "0" + minuto

                str_hora = new String (hora)
                if (str_hora.length == 1)
                hora = "0" + hora

                horaImprimible = hora + " : " + minuto + " : " + segundos;

                document.form_reloj.reloj.value = horaImprimible

                setTimeout("mueveReloj()")

            }

    </script>
</head>

<body class="reloj" onload="mueveReloj()">
    
        
        <div class="reloj-container">
        
            <form name="form_reloj">

                <input type="text" name="reloj" size="1000" class="hora" disabled>
            
            </form>
            <!--Recargas la paginas cada cierto tiempo -->
            <script type="text/javascript">
                setTimeout(function(){ location.reload(1);}, 15000);
            </script>
        </div>

</body>
</html>
