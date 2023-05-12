<?php
include('config/db.php');
$Area_Seleccionada=$_GET['Area'];
$Semana=$_GET['semana'];
$query =
"CALL Comentarios('$Semana','$Area_Seleccionada');";

$result = mysqli_query($mysqli, $query);
 // var_dump($result);
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// var_dump($data);
//  echo json_encode($data);

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);


mysqli_free_result($result);

/* Close the connection as soon as it's no longer needed */
mysqli_close($mysqli);
?>
