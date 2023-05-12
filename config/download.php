<?php

include('config/db.php');


if(isset($_GET['value'])){
	$inicio=$_GET['fecha-inicio'];
	$final=$_GET['fecha-final'];

$result = $mysqli->query("SELECT * FROM test_5s.download where Fecha>='$inicio' and Fecha<='$final';");

if (empty($result)) die('Couldn\'t fetch records');
$num_fields = mysqli_num_fields($result);
$headers = array();


for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysqli_field_name($result , $i);
}

$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Data.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

}
else{
$inicio='0000-00-00';
$final='0000-00-00';
}

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}
?>