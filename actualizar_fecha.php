<?php
// Conectamos a la base de datos
include('config/db.php'); 



// Obtenemos los valores de los campos del formulario
$id = $_POST["id"];
$fecha = $_POST["fecha"];

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// Insertamos los datos en la base de datos
$sql = "UPDATE `test_5s`.`acciones` SET `Fecha_Completado` = '$fecha' WHERE `id` = $id;";

mysqli_query($mysqli,$sql);


// Cerramos la conexión a la base de
mysqli_close($mysqli);
?>

