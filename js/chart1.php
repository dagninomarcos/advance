<script>
<?php 

$mes=date('n');

include('config/db.php');
$query =
"SELECT `C_Despejar`, `C_Organizar`, `C_Limpiar`, `C_Estandarizar`, `C_Disciplina`, `C_Seguridad` FROM test_5s.test_data_5s
WHERE Area='$Area_Seleccionada' and month(convert(Fecha,date))='$mes' order by Fecha ASC;";

$result = mysqli_query($mysqli, $query);
// var_dump($result);
$data2= mysqli_fetch_all($result,MYSQLI_NUM);

// var_dump($data2);
 // echo json_encode($data2);
 // echo "<br>";

mysqli_free_result($result);

/* Close the connection as soon as it's no longer needed */
mysqli_close($mysqli);

for ($i=0; $i <= 5; $i++) { 
  if (empty($data2[$i])) {
  $data2[$i]=array(0,0,0,0,0,0);
}
}

// DATOS DE CADA GRAFICA
$data_grafica_1 = $data2[0];
$data_grafica_2 = $data2[1];
$data_grafica_3 = $data2[2];
$data_grafica_4 = $data2[3];
$data_grafica_5 = $data2[4]; 

// NOMBRE DE CADA GRAFICA
$nombre_grafica_1 = 'Semana 1';
$nombre_grafica_2 = 'Semana 2';
$nombre_grafica_3 = 'Semana 3';
$nombre_grafica_4 = 'Semana 4';
$nombre_grafica_5 = 'Semana 5';

// SUMA TOTAL DE CADA GRAFICA PARA EL COLOR

for ($i=0; $i <= 5; $i++) { 
  if (array_sum($data2[$i])>=39) {
    $color[$i]='rgba(106, 231, 93, 0.8)';//verde
    $color_letra[$i]='rgba(0, 148, 17, 0.8)';
}else
  if(array_sum($data2[$i])==0){
    $color[$i]='rgba(255, 255, 255, 0.8)';//blanco
    $color_letra[$i]='rgba(0, 0, 0, 0.8)';
}else
    $color[$i]='rgba(255, 144, 144, 0.8)';//rojo
    $color_letra[$i]='rgba(162, 0, 0, 0.8)';
}



// SUMA TOTAL DE CADA GRAFICA PARA EL COLOR para el 5
for ($i=0; $i <= 5; $i++) { 
  $sumatoria[$i]=array_sum($data2[$i]);
  $porcentaje[$i]=round((100*array_sum($data2[$i]))/43);
  if (array_sum($data2[$i])>=39) {
  $color_numero[$i]='rgba(0, 255, 35, 0.3)'; // si es mayor a 39 entonces es verde

}else
  if (array_sum($data2[$i])==0) {
  $color_numero[$i]='rgba(255, 255, 255, 0.8)'; // si esta vacio entonces negro 

}else
  $color_numero[$i]='rgba(255, 0, 0, 0.3)'; // si no esta vacio y es menor que 39 es rojo

}


for ($i=0; $i <= 5; $i++) { 
  if (array_sum($data2[$i])>=39) {
    $color_letra[$i]='rgba(0, 148, 17, 0.8)';
}else
  if(array_sum($data2[$i])==0){
    $color_letra[$i]='rgba(0, 0, 0, 0.8)';
}else
    $color_letra[$i]='rgba(162, 0, 0, 0.8)';
}



?>






const ctx = document.getElementById('grafica1');

 const grafica1 = new Chart(ctx, {
    type: 'radar',
    data: {
      labels: ['Despejar', 'Organizar', 'Limpiar', 'Estandarizar', 'Disciplina', 'Seguridad'],
      datasets: [{
        label: '<?php echo $nombre_grafica_1 ?>',
        data: <?php echo json_encode($data_grafica_1);?>,
        // data: [20, 20, 3, 5, 2, 3],
        borderWidth: 1,
        fill:true,
        backgroundColor: '<?php echo $color[0] ?>'
      }]
    },
    options: {
      scales: {
        r: {
          beginAtZero: true,
          suggestedMin: 0,
          suggestedMax: 8
        },
        }
      
    }
  });

  const ctx2 = document.getElementById('grafica2');

 const grafica2 = new Chart(ctx2, {
    type: 'radar',
    data: {
      labels: ['Despejar', 'Organizar', 'Limpiar', 'Estandarizar', 'Disciplina', 'Seguridad'],
      datasets: [{
        label: '<?php echo $nombre_grafica_2 ?>',
        data: <?php echo json_encode($data_grafica_2);?>,
        fill:true,
        backgroundColor: '<?php echo $color[1] ?>',
        borderWidth: 1
      }]
    },
options: {
      scales: {
        r: {
          beginAtZero: true,
          suggestedMin: 0,
          suggestedMax: 8
        },
        }
      
    }
  });

const ctx3 = document.getElementById('grafica3');

 const grafica3 = new Chart(ctx3, {
    type: 'radar',
    data: {
      labels: ['Despejar', 'Organizar', 'Limpiar', 'Estandarizar', 'Disciplina', 'Seguridad'],
      datasets: [{
        label: '<?php echo $nombre_grafica_3 ?>',
        data: <?php echo json_encode($data_grafica_3);?>,
        fill:true,
        backgroundColor: '<?php echo $color[2] ?>',
        borderWidth: 1
      }]
    },
options: {
      scales: {
        r: {
          beginAtZero: true,
          suggestedMin: 0,
          suggestedMax: 8
        },
        }
      
    }
  });

 const ctx4 = document.getElementById('grafica4');

 const grafica4 = new Chart(ctx4, {
    type: 'radar',
    data: {
      labels: ['Despejar', 'Organizar', 'Limpiar', 'Estandarizar', 'Disciplina', 'Seguridad'],
      datasets: [{
        label: '<?php echo $nombre_grafica_4 ?>',
        data: <?php echo json_encode($data_grafica_4);?>,
        fill:true,
        backgroundColor: '<?php echo $color[3] ?>',

        borderWidth: 1
      }]
    },
options: {
      scales: {
        r: {
          beginAtZero: true,
          suggestedMin: 0,
          suggestedMax: 8
        },
        }
      
    }
  });
 const ctx5 = document.getElementById('grafica5');

 const grafica5 = new Chart(ctx5, {
    type: 'radar',
    data: {
      labels: ['Despejar', 'Organizar', 'Limpiar', 'Estandarizar', 'Disciplina', 'Seguridad'],
      datasets: [{
        label: '<?php echo $nombre_grafica_5 ?>',
        data: <?php echo json_encode($data_grafica_5);?>,
        fill:true,
        backgroundColor: '<?php echo $color[4] ?>',

        borderWidth: 1
      }]
    },
options: {
      scales: {
        r: {
          beginAtZero: true,
          suggestedMin: 0,
          suggestedMax: 8
        },
        }
      
    }
  });

// se genera la tabla de calificaciones
const canvas = document.getElementById("canvas_nombre");
const ctx6 = canvas.getContext("2d");
ctx6.translate(4,0);
ctx6.beginPath();
ctx6.moveTo(5, 5);
ctx6.lineTo(5,198);
ctx6.lineTo(198,198);
ctx6.lineTo(198,5);
ctx6.lineTo(5,5);
ctx6.moveTo(5,33);
ctx6.lineTo(198,33);
ctx6.moveTo(5,66);
ctx6.lineTo(198,66);
ctx6.moveTo(5,99);
ctx6.lineTo(198,99);
ctx6.moveTo(5,132);
ctx6.lineTo(198,132);
ctx6.moveTo(5,165);
ctx6.lineTo(198,165);
ctx6.moveTo(50,6);
ctx6.lineTo(50,198);
ctx6.moveTo(124,6);
ctx6.lineTo(124,198);
ctx6.stroke();
ctx6.font = "10px Arial";
ctx6.fillStyle = "black";
ctx6.fillText("Semana",9,23);
ctx6.fillText("Calificacion",60,23);
ctx6.fillText("Promedio",140,23);

ctx6.font = "20px Arial";
ctx6.fillStyle = "black";
ctx6.fillText("1",21,58);
ctx6.fillText("2",21,90);
ctx6.fillText("3",21,123);
ctx6.fillText("3",21,123);
ctx6.fillText("4",21,156);
ctx6.fillText("5",21,190);

ctx6.fillText("<?php echo $sumatoria[0];?>",68,58);
ctx6.fillText("<?php echo $sumatoria[1];?>",68,90);
ctx6.fillText("<?php echo $sumatoria[2];?>",68,123);
ctx6.fillText("<?php echo $sumatoria[3];?>",68,156);
ctx6.fillText("<?php echo $sumatoria[4];?>",68,190);

ctx6.fillText("<?php echo $porcentaje[0];?>%",138,58);
ctx6.fillText("<?php echo $porcentaje[1];?>%",138,90);
ctx6.fillText("<?php echo $porcentaje[2];?>%",138,123);
ctx6.fillText("<?php echo $porcentaje[3];?>%",138,156);
ctx6.fillText("<?php echo $porcentaje[4];?>%",138,190);

const canvas2 = document.getElementById("myCanvas");
const ctx7 = canvas2.getContext("2d");

//primer seccion 
  ctx7.beginPath();
  ctx7.moveTo(85, 48);
  ctx7.lineTo(420, 48);
  ctx7.lineTo(420, 160);
  ctx7.lineTo(67, 160);
  ctx7.lineTo(85, 48);
  ctx7.fillStyle = '<?php echo $color_numero[0]?>';
  ctx7.fill();
  ctx7.stroke();
//segunda seccion
  ctx7.beginPath();
  ctx7.moveTo(67, 160);
  ctx7.lineTo(191, 160);
  ctx7.lineTo(161, 335);
  ctx7.lineTo(41, 319);
  ctx7.lineTo(67, 160);
  ctx7.fillStyle = '<?php echo $color_numero[1]?>';
  ctx7.fill();
  ctx7.stroke();
//tercer seccion //
  ctx7.beginPath();
  ctx7.moveTo(181, 220);
  ctx7.quadraticCurveTo(450,150, 440, 380);  
  ctx7.lineTo(300,380);
  ctx7.quadraticCurveTo(295,245, 161, 335);  
  ctx7.fillStyle = '<?php echo $color_numero[2]?>';
  ctx7.fill();
  ctx7.stroke();
  

 //cuarta seccion //
 ctx7.beginPath();
 ctx7.moveTo(440, 380);
 ctx7.quadraticCurveTo(430,560, 230, 560);  
 ctx7.lineTo(230, 475);
 ctx7.quadraticCurveTo(305,465, 300, 380);  
 ctx7.fillStyle = '<?php echo $color_numero[3]?>';
 ctx7.fill();
 ctx7.stroke()

//quinta seccion
 ctx7.beginPath();
 ctx7.moveTo(230, 560);
 ctx7.quadraticCurveTo(60,550, 22, 420);//done  
 ctx7.lineTo(163, 405);//done
 ctx7.quadraticCurveTo(170,470, 230, 475);  
 ctx7.fillStyle = '<?php echo $color_numero[4]?>';
 ctx7.fill();
 ctx7.stroke()

//semana 1
ctx7.font = "17px Arial Black";
ctx7.fillStyle = '<?php echo $color_letra[0]; ?>';
ctx7.fillText("Semana 1",200,110);
//semana 2
ctx7.font = "17px Arial Black";
ctx7.fillStyle = '<?php echo $color_letra[1]; ?>';
ctx7.fillText("Semana 2",68,250);
//semana 3
ctx7.font = "17px Arial Black";
ctx7.fillStyle = '<?php echo $color_letra[2]; ?>';
ctx7.fillText("Semana 3",295,290);
//semana 4
ctx7.font = "17px Arial Black";
ctx7.fillStyle = '<?php echo $color_letra[3]; ?>';
ctx7.fillText("Semana 4",295,480);
//semana 5
ctx7.font = "17px Arial Black";
ctx7.fillStyle = '<?php echo $color_letra[4]; ?>';
ctx7.fillText("Semana 5",80,490);

ctx7.font = "700px Arial Black";
ctx7.strokeStyle = 'black';
ctx7.lineWidth = 30 ;
ctx7.strokeText("S",440,550,400);
ctx7.fillStyle = 'white';
ctx7.fillText("S",440,550,400);


 function cliclableScales(Area_Seleccionada_OK,Semana_Seleccionada){

  // Crear un div para el pop-up

  const popup = document.createElement('div');
  popup.style.position = 'absolute';
  popup.style.top = '50%';
  popup.style.left = '50%';
  popup.style.transform = 'translate(-50%, -50%)';
  popup.style.padding = '1px';
  popup.style.background = '#fff';
  popup.style.border = '1px solid #000';
  popup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
  popup.style.zIndex = '999';
  popup.style.width = 'auto'; // Ajustar el ancho del pop-up
  popup.style.height = 'auto'; // Altura automática



  // Crear una tabla y agregar filas y columnas
  const table = document.createElement('table');
  const headerRow = table.insertRow();
  const headerCell1 = headerRow.insertCell();
  const headerCell2 = headerRow.insertCell();
  const headerCell3 = headerRow.insertCell();
  const headerCell4 = headerRow.insertCell();
  headerCell1.textContent = 'No_Pregunta';
  headerCell1.classList.add("mi-clase");
  headerCell2.textContent = 'Comentario';
  headerCell2.classList.add("mi-clase");
  headerCell3.textContent = 'No_Pregunta';
  headerCell3.classList.add("mi-clase");
  headerCell4.textContent = 'Comentario';
  headerCell4.classList.add("mi-clase");

// Obtener los datos de la base de datos utilizando una petición AJAX
const xhr = new XMLHttpRequest();
xhr.open('GET', 'datos.php?Area='+Area_Seleccionada_OK+'&semana='+Semana_Seleccionada); 
// Ruta al archivo PHP que obtiene los datos de la base de datos
xhr.onreadystatechange = function() {
  if (this.readyState === 4 && this.status === 200) {
    const data = JSON.parse(this.responseText);
    const halfLength = Math.ceil(data.length / 2); // Obtener la mitad de la longitud del array
    const firstHalf = data.splice(0, halfLength); // Obtener la primera mitad del array
    const secondHalf = data; // La segunda mitad son los elementos que quedan en el array
    firstHalf.forEach((item, index) => {
      const dataRow = table.insertRow();
      const dataCell1 = dataRow.insertCell();
      const dataCell2 = dataRow.insertCell();
      const dataCell3 = dataRow.insertCell();
      const dataCell4 = dataRow.insertCell();
      dataCell1.textContent = item.No_pregunta;
      dataCell1.classList.add("mi-clase");
      dataCell1.addEventListener("mouseover", () => {
      dataCell1.title = item.pregunta;
      });
      dataCell2.textContent = item.Comentario;
      dataCell2.classList.add("mi-clase");
      dataCell2.style.width = '150px'; // Establecer ancho para la celda dataCell2
      // Insertar la segunda mitad en las celdas 3 y 4
      if (index < secondHalf.length) {
        const secondHalfItem = secondHalf[index];
        dataCell3.textContent = secondHalfItem.No_pregunta;
        dataCell3.classList.add("mi-clase");
        dataCell3.addEventListener("mouseover", () => {
        dataCell3.title = secondHalfItem.pregunta;
      });
        dataCell4.textContent = secondHalfItem.Comentario;
        dataCell4.classList.add("mi-clase");
        dataCell4.style.width = '150px'; // Establecer ancho para la celda dataCell3
      }
    });
  }
};
xhr.send();

  popup.appendChild(table);

  // Agregar el botón "Cerrar" al pop-up
  const closeBtnContainer = document.createElement('div');
  closeBtnContainer.className = 'closeBtnContainer';
  const closeBtn = document.createElement('button');
  closeBtn.textContent = 'Cerrar';
  closeBtn.text_aligh = 'Center';
  closeBtn.style.width = '200px';
  closeBtn.addEventListener('click', () => {
    popup.remove(); // Eliminar el pop-up del DOM
  });
  popup.appendChild(closeBtn);

  // Agregar el pop-up al body
  document.body.appendChild(popup);
}


// Agregar un escuchador de eventos para el clic
  ctx.addEventListener('click', () =>{
    cliclableScales('<?php echo $Area_Seleccionada ?>',0);
  },
);


// Agregar un escuchador de eventos para el clic
  ctx2.addEventListener('click', () =>{
    cliclableScales('<?php echo $Area_Seleccionada ?>',1);
  },
);

  // Agregar un escuchador de eventos para el clic
  ctx3.addEventListener('click', () =>{
    cliclableScales('<?php echo $Area_Seleccionada ?>',2);
  },
);

  // Agregar un escuchador de eventos para el clic
  ctx4.addEventListener('click', () =>{
    cliclableScales('<?php echo $Area_Seleccionada ?>',3);
  },
);


// Agregar un escuchador de eventos para el clic
  ctx5.addEventListener('click', () =>{
    cliclableScales('<?php echo $Area_Seleccionada ?>',4);
  },
);
</script>
