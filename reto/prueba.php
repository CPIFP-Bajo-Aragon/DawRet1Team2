<?php

session_start();


$servername = "localhost";
$database = "Prueba2";
$username = "root";
$password = "Admin1234";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

$sql=("SELECT ID_Publicacion, Titulo, Descripcion, Multimedia, Tipo_Publicacion, Estado, Fecha_Inicio, Fecha_Fin, Publicacion.ID_Usuario as ID_Usuario, Usuario.Nom_Usuario as Nom_Usuario FROM Publicacion, Usuario WHERE Usuario.ID_Usuario=Publicacion.ID_Usuario AND Fecha_Fin>=CURRENT_DATE() and Estado='Aceptada' and Fecha_Inicio<=CURRENT_DATE() ORDER BY Fecha_Fin");
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$image_count = 0;
$button_html = '';
$slider_html = '';
$thumb_html = '';
while( $rows = mysqli_fetch_assoc($resultset)){
$active_class = "";
if(!$image_count) {
$active_class = 'active';
$image_count = 1;
}
$image_count++;
$thumb_image = "nature_thumb_".$rows['ID_Publicacion'].".jpg";
// slider image html
$slider_html.= "<div class='item ".$active_class."'>";
$slider_html.= "<img src='images/".$rows['Multimedia']."' alt='1.jpg' class='img-responsive'>";
$slider_html.= "<div class='carousel-caption'></div></div>";
// Thumbnail html
$thumb_html.= "<li><img src='images/".$thumb_image."' alt='$thumb_image'></li>";
// Button html
$button_html.= "<li data-target='#carousel-example-generic' data-slide-to='".$image_count."' class='".$active_class."'></li>";
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>


<div class="container">
<h2>Create Bootstrap Carousel Slider with Thumbnails using PHP & MySQL</h2>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
<ol class="carousel-indicators">
<?php echo $button_html; ?>
</ol>
<div class="carousel-inner">
<?php echo $slider_html; ?>
</div>
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
</a>
<ul class="thumbnails-carousel clearfix">
<?php echo $thumb_html; ?>
</ul>
</div>
</div>



<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script src="js/carousel-slider.js"></script>

</body>
</html>