<?php 
// $host_direccion = '10.32.72.171';
// define('ROOT_URL', 'http://'.$host_direccion.'/advance/');
// define('ROOT_LLENAR_DATA','http://'.$host_direccion.'/advance/form_data.php');
// define('ROOT_GENERAL','http://'.$host_direccion.'/advance/general.php');
// define('ROOT_DOWNLOAD','http://'.$host_direccion.'/advance/download.php');
// define('ROOT_EVALUACION','http://'.$host_direccion.'/advance/evaluacion.php');
// define('ROOT_ANUAL','http://'.$host_direccion.'/advance/anual.php')

$host_direccion = getHostByName(getHostName());
define('ROOT_URL', 'http://'.$host_direccion.'/dashboard5s/');
define('ROOT_LLENAR_DATA','http://'.$host_direccion.'/dashboard5s/form_data.php');
define('ROOT_GENERAL','http://'.$host_direccion.'/dashboard5s/general.php');
define('ROOT_DOWNLOAD','http://'.$host_direccion.'/dashboard5s/download.php');
define('ROOT_EVALUACION','http://'.$host_direccion.'/dashboard5s/evaluacion.php');
define('ROOT_ANUAL','http://'.$host_direccion.'/dashboard5s/anual.php');
define('ROOT_ACTION','http://'.$host_direccion.'/dashboard5s/acciones.php');
?>
