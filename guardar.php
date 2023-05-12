<?php
// Conectamos a la base de datos
include('config/db.php'); 



// Obtenemos los valores de los campos del formulario
$area1 = $_GET["areachila"];
$noConformidad1 = $_GET["noConformidad"];
$acciones1 = $_GET["acciones"];
$fecha1 = $_GET["fecha"];
$owner1 = $_GET["owner"];
$fechaCompletado1 = $_GET["fechaCompletado"];
$comentarios1 = $_GET["comentarios"];

// Insertamos los datos en la base de datos
$sql = "INSERT INTO `test_5s`.`acciones` (`Area`,`No_Conformidad`,`Accciones`,`Fecha`,`Owner`,`Fecha_Completado`,`Estatus`,`Comentarios`) 
		VALUES ('$area1', '$noConformidad1', '$acciones1', '$fecha1', '$owner1', '$fechaCompletado1', 'Proceso','$comentarios1')";

mysqli_query($mysqli,$sql);


// Cerramos la conexión a la base de
mysqli_close($mysqli);
?>

