<script>
<?php 

include('config/db.php');
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
// query a ejecutar
$query ="SELECT Area, sum(total) as total FROM anual_mes_view where month(fecha)=$Mes_Seleccionado group by Area order by total desc;";

// ejectuar el query 
$result = mysqli_query($mysqli, $query);

// recuperar la informacion de la base de datos 
$data2= mysqli_fetch_all($result,MYSQLI_ASSOC);

// liberar la variable donde se guerda la informacion 
mysqli_free_result($result);

// cerrar la conexion con la base de datos
mysqli_close($mysqli);

              



for ($i=0; $i <= 28; $i++) { 
  if (empty($data2[$i])) {
  $data2[$i]=array('Area'=>'NA','total'=>0);
}}

for ($i=0; $i <= 28; $i++){
  $areas_grafica[$i]=($data2[$i]['Area']);
}

for ($i=0; $i <= 28; $i++){
  $valores_grafica_ok[$i]=($data2[$i]['total']);
}



?>

// para crear la grafica que se muestra 
var ctx1 = document.getElementById('grafica1');
  var grafica1 = new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($areas_grafica); ?>,
      datasets: [
      {
        label: 'OK',
        data: <?php echo json_encode($valores_grafica_ok); ?>,
        //data: [95,86,70,100,100,81,98,98,93,98,81,81,86,93,95,88,98,98,93,91,79,95,81,79,95,95,98,93],
        borderWidth: 1,
        fill:true,
        backgroundColor: 'green'
      }
      ]
    },
    options: {
      scales: {
        x: {
        stacked: true,
        },
        y: {
        stacked: true,
          beginAtZero: true,
          suggestedMin: 0,
          suggestedMax: (43*4)
        },
        },
      plugins: {
            title: {
                display: true,
                text: '5S Status Overall Areas',
                padding: {
                    top: 10,
                    bottom: 5
                }
            }
        }
    }
  });
<?php
/**
     * Returns the amount of weeks into the month a date is
     * @param $date a YYYY-MM-DD formatted date
     * @param $rollover The day on which the week rolls over
     */
    function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }


    //
    echo getWeeks("2023-04-08", "sunday"); //outputs 2, for the second week of the month
?>
</script>
