<?php

session_start();

include "conection.php";

session_destroy();

echo "Cerrando sesion...";

header("refresh:1;url=index.php");

?>
