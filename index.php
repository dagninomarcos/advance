<?php require('config/config.php')?>
<?php include('config/db.php') ?>
<?php
$fecha_sistema=date("Y-m-d");
$query ="CALL Colores('$fecha_sistema');";
//asdasdasdadsmarcos dagnino estuvo aqui otra vez de nuevo
// ejectuar el query 
$result = mysqli_query($mysqli, $query);

// recuperar la informacion de la base de datos 
$data2= mysqli_fetch_all($result,MYSQLI_ASSOC);
// var_dump($data2);
// liberar la variable donde se guerda la informacion 
mysqli_free_result($result);

// cerrar la conexion con la base de datos
mysqli_close($mysqli);
?>
<?php include('config/header.php')?>
<style type="text/css">
.container-cool-index2{
    display: grid;
    grid-template-columns: auto;
    grid-template-rows: auto auto;
    }


</style>
<body <?php include('config/body.php')?> >
<?php include('navbar.php');?>



<div class="main">
      <aside class="left-index">
<div class="grid-container-big-index">
<div class="container-cool-index2">
<canvas class="titulo_index" id="cinco-s" width="300" height="300"></canvas>	
<canvas class="titulo_index" id="referencias" width="300" height="130" style="background-color: white;"></canvas>    
 
</div>
</div>

      </aside>
	
<main class="main">
<div class="grid-container-big">
 <h1 class="strokeme" style="font-size:50px;"  style="justify-content: center;">Areas a Seleccionar</h1>
<div style="display: grid; grid-template-columns: 280px 280px 280px 280px; color: white; text-align: center; align-content:center;">
    <h1 class="strokeme" style="font-size:30px; " >Celdas</h1>
    <h1 class="strokeme" style="font-size:30px;">Sub-ensambles</h1>
    <h1 class="strokeme" style="font-size:30px;">Area 3</h1>
    <h1 class="strokeme" style="font-size:30px;">Areas externas<br> a la planta</h1>
</div>
<div class="grid-container">
    <div class="grid-container-botones">
<a href="area.php?Lugar=C1" class="botones" style="background-color:<?php echo ($data2[0]['Color']);?>;">C1</a>
<a href="area.php?Lugar=C8" class="botones" style="background-color:<?php echo ($data2[1]['Color']);?>;">C8</a>
<a href="area.php?Lugar=Celda7" class="botones" style="background-color:<?php echo ($data2[2]['Color']);?>;">Celda7</a>
<a href="area.php?Lugar=C2" class="botones" style="background-color:<?php echo ($data2[3]['Color']);?>;">C2</a>
<a href="area.php?Lugar=C3"  class="botones" style="background-color:<?php echo ($data2[4]['Color']);?>;">C3</a>
<a href="area.php?Lugar=C4"  class="botones" style="background-color:<?php echo ($data2[5]['Color']);?>;">C4</a>
<a href="area.php?Lugar=Celda_PCS" class="botones" style="background-color:<?php echo ($data2[6]['Color']);?>;">Celda PCS</a>
    </div>
    <div class="grid-container-botones">
<a href="area.php?Lugar=XFMR_Switcher" class="botones" style="background-color:<?php echo ($data2[7]['Color']);?>;">XFMR Switcher</a>
<a href="area.php?Lugar=SMT" class="botones" style="background-color:<?php echo ($data2[8]['Color']);?>;">SMT</a>
<a href="area.php?Lugar=Preparacion" class="botones" style="background-color:<?php echo ($data2[9]['Color']);?>;">Preparacion</a>
<a href="area.php?Lugar=Cables" class="botones" style="background-color:<?php echo ($data2[10]['Color']);?>;">Cables</a>
<a href="area.php?Lugar=Chassis" class="botones" style="background-color:<?php echo ($data2[11]['Color']);?>;">Chassis</a>
<a href="area.php?Lugar=BURN_IN" class="botones" style="background-color:<?php echo ($data2[12]['Color']);?>;">BURN IN</a>
<a href="area.php?Lugar=XFMR_Toroides_Lineales" class="botones" style="background-color:<?php echo ($data2[13]['Color']);?>;">XFMR Toroides/Lineales</a>
    </div>
    <div class="grid-container-botones">
<a href="area.php?Lugar=IQC" class="botones" style="background-color:<?php echo ($data2[14]['Color']);?>;">IQC</a>
<a href="area.php?Lugar=Almacen" class="botones" style="background-color:<?php echo ($data2[15]['Color']);?>;">Almacen</a>
<a href="area.php?Lugar=Quimicos" class="botones" style="background-color:<?php echo ($data2[16]['Color']);?>;">Quimicos</a>
<a href="area.php?Lugar=Ingenieria" class="botones" style="background-color:<?php echo ($data2[17]['Color']);?>;">Ingenieria</a>
<a href="area.php?Lugar=Mantenimiento" class="botones" style="background-color:<?php echo ($data2[18]['Color']);?>;">Mantenimiento</a>
<a href="area.php?Lugar=RMA" class="botones"style="background-color:<?php echo ($data2[19]['Color']);?>;">RMA</a>
<a href="area.php?Lugar=Cuarto_Harneses" class="botones"style="background-color:<?php echo ($data2[28]['Color']);?>;">Cuarto_Harneses</a>
    </div>
    <div class="grid-container-botones">
<a href="area.php?Lugar=Patios_David" class="botones" style="background-color:<?php echo ($data2[20]['Color']);?>;">Patios<br>David A</a>
<a href="area.php?Lugar=Patio_Jardin" class="botones" style="background-color:<?php echo ($data2[21]['Color']);?>;">Patio Jardin<br>Monica M</a>
<a href="area.php?Lugar=Patios_Frontal_Manuel" class="botones" style="background-color:<?php echo ($data2[22]['Color']);?>;">Patios Frontal<br>Manuel S</a>
<a href="area.php?Lugar=Patios_Rampas_Gerardo" class="botones" style="background-color:<?php echo ($data2[23]['Color']);?>;">Patios Rampas<br>Gerardo M</a>
<a href="area.php?Lugar=Patio_Pasillo_Acceso" class="botones" style="background-color:<?php echo ($data2[24]['Color']);?>;">Patio Pasillos Acceso<br>Lateral Jesus D</a>
<a href="area.php?Lugar=Patio_Estacionamientos" class="botones" style="background-color:<?php echo ($data2[25]['Color']);?>;">Patio Estacionamientos<br>Marco H</a>
<a href="area.php?Lugar=Patios_Miguel" class="botones" style="background-color:<?php echo ($data2[26]['Color']);?>;">Patios<br>Miguel M</a>
<a href="area.php?Lugar=Patios_Rampas_Loreley" class="botones" style="background-color:<?php echo ($data2[27]['Color']);?>;">Patios Rampas<br>Loreley B</a>
    </div>
</div>
</div>
      </main>
</div>
</div>
<?php include('config/footer.php')?>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- <script type="text/javascript" src="js/chart.js"></script> -->
<!-- <script type="text/javascript" src="js/chart1.php"></script> -->
<script>
const canvas = document.getElementById("cinco-s");
const ctx = canvas.getContext("2d");
function drawStroked(text, x, y, l) {
    ctx.font = '290px Arial Black';
    ctx.strokeStyle = 'white';
    ctx.lineWidth = 8;
    ctx.strokeText(text, x, y, l);
    ctx.shadowOffsetX = 3;
      ctx.shadowOffsetY = 3;
      ctx.shadowColor = 'rgba(255, 255, 255, 0.5)';   
      ctx.shadowBlur = 5;  
    ctx.fillStyle = 'rgb(254, 80, 0)';
    ctx.fillText(text, x, y, l);
    
}
function drawStroked2(text, x, y, l) {
    ctx.font = '30px Arial Black';
    ctx.strokeStyle = 'white';
    ctx.lineWidth = 3;
    ctx.strokeText(text, x, y, l);
    ctx.shadowOffsetX = 3;
      ctx.shadowOffsetY = 3;
      ctx.shadowColor = 'rgba(255, 255, 255, 0.5)';   
      ctx.shadowBlur = 5;  
    ctx.fillStyle = 'rgb(254, 80, 0)';
    ctx.fillText(text, x, y, l);
}

drawStroked("5S", 7, 230, 280);
drawStroked2("Dashboard", 55, 270, 600);  

ctx.beginPath();
ctx.strokeStyle = "#FF0000";
ctx.fillStyle = 'rgba(255, 255, 255, 0.1)';
ctx.lineWidth =1;
ctx.moveTo(40,30);
ctx.lineTo(115,30);
ctx.lineTo(75,45);
ctx.fill();


var canvas2 = document.getElementById("referencias");
var ctx2 = canvas2.getContext("2d");
ctx2.fillStyle = "#2d6aa8";
ctx2.fillRect(10,10,30,30);
ctx2.fillStyle = "#97c93c";
ctx2.fillRect(10,50,30,30);
ctx2.fillStyle = "#b82927";
ctx2.fillRect(10,90,30,30);
ctx2.font = "20px Arial Black";
ctx2.fillStyle = "#000000";
ctx2.fillText("No tiene Registro",50,35);
ctx2.font = "13px Arial Black";
ctx2.fillStyle = "#000000";
ctx2.fillText("Paso Auditoria de la Semana",50,71);
ctx2.font = "13px Arial Black";
ctx2.fillStyle = "#000000";
ctx2.fillText("No Paso Auditoria de la Semana",50,110);

</script>


</body>
</html>
