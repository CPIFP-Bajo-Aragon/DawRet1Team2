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

        </div>

</body>
</html>
