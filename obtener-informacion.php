<?php
// Conectarse a la base de datos
include('config/db.php'); 

// Obtener el ID del comentario a actualizar
$id = $_GET["id"];

// Realizar la consulta a la base de datos
$sql = "SELECT Comentarios FROM test_5s.acciones WHERE id = $id;";
$resultado = mysqli_query($mysqli,$sql);

// Procesar los resultados
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo $fila['Comentarios'];
}

// Cerrar la conexión a la base de datos
mysqli_close($mysqli);

?>
