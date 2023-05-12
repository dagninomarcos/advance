<?php
// Conectamos a la base de datos
include('config/db.php'); 



// Obtenemos los valores de los campos del formulario
$id = $_POST["id"];
$comentario = $_POST["comentario"];

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// Insertamos los datos en la base de datos
$sql = "UPDATE `test_5s`.`acciones` SET `Comentarios` = '$comentario' WHERE `id` = $id;";

mysqli_query($mysqli,$sql);


// Cerramos la conexión a la base de
mysqli_close($mysqli);
?>

