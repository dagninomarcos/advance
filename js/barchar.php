<script>
<?php 

include('config/db.php');

// query a ejecutar
$query =
"SELECT Fecha,
    Area,
        (C_Despejar+C_Organizar+C_Limpiar+C_Estandarizar+C_Disciplina+C_Seguridad) as Sumatoria,
        truncate((((C_Despejar+C_Organizar+C_Limpiar+C_Estandarizar+C_Disciplina+C_Seguridad)*100)/43),0) as Porcentaje_OK,
        ((truncate((((C_Despejar+C_Organizar+C_Limpiar+C_Estandarizar+C_Disciplina+C_Seguridad)*100)/43),0)-100)*-1) as Oportuniades
        FROM test_5s.test_data_5s where week(Fecha)=$fecha_sistema order by Sumatoria desc;";
$query_oportunidades =
"SELECT  id,
        Fecha,
        ROUND((((sum(C_Despejar)-(29*7))*-1)/(29*7))*100,0) as P_Despejar,
        ROUND((((sum(C_Organizar)-(29*8))*-1)/(29*8))*100,0) as P_Organizar,
        ROUND((((sum(C_Limpiar)-(29*7))*-1)/(29*7))*100,0) as P_Limpiar,
        ROUND((((sum(C_Estandarizar)-(29*7))*-1)/(29*7))*100,0) as P_Estandarizar,
        ROUND((((sum(C_Disciplina)-(29*7))*-1)/(29*7))*100,0) as P_Disciplina,
        ROUND((((sum(C_Seguridad)-(29*7))*-1)/(29*7))*100,0) as P_Seguridad
FROM test_5s.test_data_5s where week(Fecha)=$fecha_sistema;";
// ejectuar el query 
$result = mysqli_query($mysqli, $query);
$result2= mysqli_query($mysqli, $query_oportunidades);
// recuperar la informacion de la base de datos 
$data2= mysqli_fetch_all($result,MYSQLI_ASSOC);
$data_oportunidades= mysqli_fetch_all($result2,MYSQLI_ASSOC);
// liberar la variable donde se guerda la informacion 
mysqli_free_result($result);
mysqli_free_result($result2);
// cerrar la conexion con la base de datos
mysqli_close($mysqli);


$areas_oportunidad=[intval($data_oportunidades[0]['P_Despejar']),intval($data_oportunidades[0]['P_Organizar']),
                    intval($data_oportunidades[0]['P_Limpiar']),intval($data_oportunidades[0]['P_Estandarizar']),
                    intval($data_oportunidades[0]['P_Disciplina']),intval($data_oportunidades[0]['P_Seguridad']),
                  ];
for ($i=0; $i <= 28; $i++) { 
  if (empty($data2[$i])) {
  $data2[$i]=array('Fecha'=>'0000-00-00','Area'=>'NA','Sumatoria'=>0,'Porcentaje_OK'=>0,'Oportuniades'=>0);
}
}

// echo json_encode($data2);

// para sacar los valores de lo que dio de resultado el query al igual que los otros for de abajo 
for ($i=0; $i <= 28; $i++){
  $valores_grafica_ok[$i]=intval($data2[$i]['Porcentaje_OK']);
}

for ($i=0; $i <= 28; $i++){
  $valores_grafica_ng[$i]=intval($data2[$i]['Oportuniades']);
}

for ($i=0; $i <= 28; $i++){
  $areas_grafica[$i]=($data2[$i]['Area']);
}

// para sacar los valores de lo que dio de resultado el query al igual que los otros for de abajo 
for ($i=0; $i <= 2; $i++){
  $valores_grafica_ok_2[$i]=intval($data2[$i]['Porcentaje_OK']);
}

for ($i=0; $i <= 2; $i++){
  $valores_grafica_ng_2[$i]=intval($data2[$i]['Oportuniades']);
}

for ($i=0; $i <= 2; $i++){
  $areas_grafica_2[$i]=($data2[$i]['Area']);
}

$data3=array_reverse($data2);


for ($i=0; $i <= 2; $i++){
  $valores_grafica_ok_3[$i]=intval($data3[$i]['Porcentaje_OK']);
}

for ($i=0; $i <= 2; $i++){
  $valores_grafica_ng_3[$i]=intval($data3[$i]['Oportuniades']);
}

for ($i=0; $i <= 2; $i++){
  $areas_grafica_3[$i]=($data3[$i]['Area']);
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
      },
      {
        label: 'Oportunidades',
        data: <?php echo json_encode($valores_grafica_ng); ?>,
        //data: [5, 14, 30, 0, 0, 19,2,2,7,2,19,19,14,7,5,12,2,2,7,9,21,5,19,21,5,5,2,7],
        borderWidth: 1,
        fill:true,
        backgroundColor: 'red'
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
          suggestedMax: 100
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
console.log(grafica1)
function cliclableScales(canvas,click){
const link ='area.php?Lugar=';
const height = grafica1.scales.x.height
const areas=(<?php echo json_encode($areas_grafica); ?>)
const top = grafica1.chartArea.top
const bottom = grafica1.scales.x.bottom
const left = grafica1.scales.x.left // correcto
const right =(((grafica1.scales.x.maxWidth-(grafica1.scales.x.left + grafica1.scales.x.paddingLeft))-grafica1.scales.x.paddingLeft) / grafica1.scales.x.ticks.length)// correcto
const left2 = right - ((grafica1.scales.x.left - grafica1.scales.x.paddingLeft)*2)
const right2 = left + left2
    // console.log(height)
    // console.log(top)
    // console.log(bottom)
    // console.log(left)
    // console.log(right)
    // console.log(left2)
    // console.log(right2)
  //console.log(canvas)
  //console.log(click)
  let resetCoordinates = canvas.getBoundingClientRect()
  //console.log(resetCoordinates)
  const x=click.clientX - resetCoordinates.left;
  const y=click.clientY - resetCoordinates.top;
  // console.log(x)
  // console.log(y)
  // console.log(grafica1.scales.x.ticks.length)
  //  console.log(grafica1.scales.x.maxWidth)
// for (let i=0; i < grafica1.scales.x.ticks.length ; i++) {
//   if (x>= left + (right*i) && x<= right + (right*i ) && y >= top && y<= bottom)  {

//     console.log(i)

//   }
// }

  for (let i=0; i < grafica1.scales.x.ticks.length ; i++) {
  if (x>= left2 +(right*i) && x<= right2 +(right*i) && y >= top && y<= bottom)  {

  console.log(link.concat(areas[i]));
if (areas[i]=='NA'){

}else{
   location.href= link.concat(areas[i]);

}
  }
}

}

ctx1.addEventListener('click',(e) => {
  cliclableScales(ctx1,e)
})

  var ctx2 = document.getElementById('grafica2');
  var grafica2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($areas_grafica_2); ?>,
      datasets: [
      {
        label: 'OK',
        data: <?php echo json_encode($valores_grafica_ok_2); ?>,
        borderWidth: 1,
        fill:true,
        backgroundColor: 'green'
      },
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
          suggestedMax: 100
        },
        },
      plugins: {
            title: {
                display: true,
                text: 'Top 3 Cumplimiento 5S',
                padding: {
                    top: 10,
                    bottom: 5
                }
            }
        }
    }
  });

  var ctx3 = document.getElementById('grafica3');
  var grafica3 = new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($areas_grafica_3); ?>,
      datasets: [
      {
        label: 'Oportunidad',
        data: <?php echo json_encode($valores_grafica_ng_3); ?>,
        borderWidth: 1,
        fill:true,
        backgroundColor: 'red'
      },
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
          suggestedMax: 30
        },
        },
      plugins: {
            title: {
                display: true,
                text: 'Top 3 Con Mayor Oporunidad de Mejora   ',
                padding: {
                    top: 10,
                    bottom: 5
                }
            }
        }
    }
  });

  var ctx4 = document.getElementById('grafica4');
  var grafica4 = new Chart(ctx4, {
    type: 'bar',
    data: {
      labels: ['Despejar','Organizar','Limpiar','Estandarizar','Disciplina','Seguridad'],
      datasets: [
      {
        label: 'Oportunidad',
        data: <?php echo json_encode($areas_oportunidad); ?>,
        borderWidth: 1,
        fill:true,
        backgroundColor: 'brown'
      },
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
          suggestedMin: 0
          // suggestedMax: 100
        },
        },
      plugins: {
            title: {
                display: true,
                text: '5S Oportunidad de Mejora',
                padding: {
                    top: 10,
                    bottom: 5
                }
            },
            datalabels: {
            anchor: 'end',
            align: 'top',
            formatter: Math.round,
            font: {
                weight: 'bold'
            }
        }
        }
    }
  });
</script>
