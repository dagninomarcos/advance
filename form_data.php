<?php 
$valor=false;
$cosa='';
$existe='';
require('config/config.php');
include('config/db.php');

 if(isset($_GET['submite'])){
 	$Fecha=$_GET['Fecha'];
	$Auditor=$_GET['Auditor'];
  $Auditado=$_GET['Auditado'];
	$Area=$_GET['Area'];
	$C_Despejado=$_GET['Despejar'];
	$C_Organizar=$_GET['Organizar'];
	$C_Limpiar=$_GET['Limpiar'];
	$C_Estandarizar=$_GET['Estandarizar'];
	$C_Disciplina=$_GET['Disciplina'];
	$C_Seguridad=$_GET['Seguridad'];

$query_verificar="SELECT * FROM test_5s.test_data_5s where week(Fecha)=week('$Fecha') and Area='$Area';";
$array_existe=mysqli_query($mysqli,$query_verificar);
$existe=mysqli_fetch_all($array_existe,MYSQLI_NUM);
mysqli_free_result($array_existe);

if (empty($existe[0])) {
$query="INSERT INTO `test_data_5s` (`Fecha`, `Auditor`,`Auditado`, `Area`, `C_Despejar`, `C_Organizar`, `C_Limpiar`, `C_Estandarizar`, `C_Disciplina`, `C_Seguridad`) VALUES ('$Fecha', '$Auditor','$Auditado', '$Area', '$C_Despejado', '$C_Organizar', '$C_Limpiar', '$C_Estandarizar', '$C_Disciplina', '$C_Seguridad')";
mysqli_query($mysqli,$query);
  }
  else{
    $cosa = 'pelas';
  }  



// $query="INSERT INTO `test_data_5s` (`Fecha`, `Auditor`, `Area`, `C_Despejar`, `C_Organizar`, `C_Limpiar`, `C_Estandarizar`, `C_Disciplina`, `C_Seguridad`) VALUES ('$Fecha', '$Auditor', '$Area', '$C_Despejado', '$C_Organizar', '$C_Limpiar', '$C_Estandarizar', '$C_Disciplina', '$C_Seguridad')";
//var_dump($query);
// mysqli_query($mysqli,$query);
}

$db= $mysqli;
$tableName="test_data_5s";
$columns= ['id', 'Fecha','Auditor','Auditado','Area','C_Despejar','C_Organizar', 'C_Limpiar','C_Estandarizar','C_Disciplina','C_Seguridad'];

$fetchData = fetch_data($db, $tableName, $columns);
function fetch_data($db, $tableName, $columns){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) {
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{
$columnName = implode(", ", $columns);
$query = "SELECT ".$columnName." FROM $tableName"." ORDER BY id DESC Limit 15";
$result = $db->query($query);
if($result== true){ 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "No Data Found"; 
 }
}else{
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>




<?php include('config/header.php')?>
<script>
    function hello() {
        alert('Este registro ya esta agreago por esta semana');
    }
    </script>
<body <?php include('config/body.php')?> >
<?php include('navbar.php') ?>
<?php if($cosa=='pelas'){
  echo '<script>
    hello();
    </script>';
  }?>

	<div class="main">


      
<main class="main">

<div class="container_tabla">
 <div class="row">
   <div class="col-sm-20">
    <?php echo $deleteMsg??''; ?>
    <div class="table table-striped">
      <table class="table table-striped" style="color: white; text-align: center; background-color:rgba(255, 255, 255, 0.2); ">
       <thead><tr>
         <th>id</th>
         <th>Fecha</th>
         <th>Auditor</th>
         <th>Auditado</th>
         <th>Area</th>
         <th>C_Despejar</th>
         <th>C_Organizar</th>
         <th>C_Limpiar</th>
         <th>C_Estandarizar</th>
         <th>C_Disciplina</th>
         <th>C_Seguridad</th>
    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      <!-- <td><?php echo $sn; ?></td> -->
      <td><?php echo $data['id']??''; ?></td>
      <td><?php echo $data['Fecha']??''; ?></td>
      <td><?php echo $data['Auditor']??''; ?></td>
      <td><?php echo $data['Auditado']??''; ?></td>
      <td><?php echo $data['Area']??''; ?></td>
      <td><?php echo $data['C_Despejar']??''; ?></td>
      <td><?php echo $data['C_Organizar']??''; ?></td>
      <td><?php echo $data['C_Limpiar']??''; ?></td>  
      <td><?php echo $data['C_Estandarizar']??''; ?></td>  
      <td><?php echo $data['C_Disciplina']??''; ?></td>  
      <td><?php echo $data['C_Seguridad']??''; ?></td>  
     </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>
</main>

	</div>
<?php include('config/footer.php')?>
</body>
</html>
