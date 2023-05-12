<?php
// Conectar a la base de datos
include('config/db.php');

// Verificar si hay errores de conexión
if (mysqli_connect_errno()) {
  echo "Error de conexión: " . mysqli_connect_error();
}

// Verificar si se recibió el ID del registro a actualizar
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  // Realizar la consulta SQL para actualizar el registro
  $sql = "UPDATE `test_5s`.`acciones` SET `Estatus` = 'Completado' WHERE id = $id;";
  echo $sql;
  $resultado = mysqli_query($mysqli, $sql);

  // Verificar si la actualización fue exitosa
  if ($resultado) {
    echo "Registro actualizado correctamente";
  } else {
    echo "Error al actualizar el registro";
  }
}

// Cerrar la conexión con MySQL
mysqli_close($mysqli);
?>