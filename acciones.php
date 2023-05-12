<?php require('config/config.php')?>
<?php include('config/db.php') ?>
<?php 

// Verificar si hay errores de conexión
if (mysqli_connect_errno()) {
  echo "Error de conexión: " . mysqli_connect_error();
}

// Obtener los datos de la tabla 'ejemplo'
$sql = "SELECT * FROM test_5s.acciones WHERE Estatus!='Completado' order by id desc;";
$resultado = mysqli_query($mysqli, $sql);

// $data2= mysqli_fetch_all($resultado,MYSQLI_ASSOC);
// mysqli_free_result($resultado);
// // echo json_encode($data2);
mysqli_close($mysqli);
?>


<?php include('config/header.php')?>
<style>
.popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  background: white;
  padding: 20px;
  box-shadow: 0px 0px 5px grey;
  display: none;
}

.popup label {
  display: block;
  margin-bottom: 5px;
}

.popup input, .popup select {
  display: block;
  margin-bottom: 10px;
  width: 100%;
}

.popup button {
  margin-top: 10px;
}

.popup #closeButton {
  position: absolute;
  top: -5px;
  right: 5px;
  border: 1px solid black;
  border-radius: 1rem;
}

</style>

<body <?php include('config/body.php')?> >
<?php include('navbar.php');?>
<button onclick="abrirPopup()">Agregar registro</button>




<!-- Crear la tabla HTML -->
<table class="table table-striped" style="background-color:rgba(74, 74, 74, 0.80);border-bottom:1px solid black;border-collapse:collapse;">
  <thead>
    <tr>
      <th style="background-color: rgba(211, 211, 211, 0.8);">ID</th>
      <th style="width:150px;background-color: rgba(211, 211, 211, 0.8);">Area</th>
      <th style="width:450px;background-color: rgba(211, 211, 211, 0.8);">No_Conformidad</th>
      <th style="width:450px;background-color: rgba(211, 211, 211, 0.8);">Acciones</th>
      <th style="width:130px;background-color: rgba(211, 211, 211, 0.8);">Fecha</th>
      <th style="width:110px;background-color: rgba(211, 211, 211, 0.8);">Owner</th>
      <th style="width:110px;background-color: rgba(211, 211, 211, 0.8);">Fecha<br>Completado</th>
      <th style="width:110px;background-color: rgba(211, 211, 211, 0.8);">Estatus</th>
      <th style="width:380px;background-color: rgba(211, 211, 211, 0.8);">Comentarios</th>
      <th style="width:100px;background-color: rgba(211, 211, 211, 0.8);">Actualizar</th>
      <th style="width:100px;background-color: rgba(211, 211, 211, 0.8);">Actualizar Fecha</th> <!-- nuevo botón -->
      <th style="width:100px;background-color: rgba(211, 211, 211, 0.8);">Actualizar Comentarios</th> <!-- nuevo botón -->
    </tr>
  </thead>
    <tbody>
    <?php
    // Mostrar los datos de la tabla
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo "<tr>";
      echo "<td>" . $fila["id"] . "</td>";
      echo "<td>" . $fila["Area"] . "</td>";
      echo "<td>" . $fila["No_Conformidad"] . "</td>";
      echo "<td>" . $fila["Accciones"] . "</td>";
      echo "<td>" . $fila["Fecha"] . "</td>";
      echo "<td>" . $fila["Owner"] . "</td>";
      echo "<td>" . $fila["Fecha_Completado"] . "</td>";
      echo "<td>" . $fila["Estatus"] . "</td>";
      echo "<td>" . $fila["Comentarios"] . "</td>";
      // Agregar un botón para actualizar el registro
      echo '<td><button style="width:110%; height: 50px" onclick="actualizar(' . $fila["id"] . ')">Completada</button></td>';
      echo '<td><button onclick="abrirPopup2(' . $fila["id"] . ')">Actualizar Fecha</button></td>';
      echo '<td><button onclick="abrirPopup3(' . $fila["id"] . ')">Actualizar Comentarios</button></td>';
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<!-- Popup -->
<div id="miPopup" class="popup">
  <form>
    <h2>Dar de Alta Registros</h2>
    <label for='AreaIN'>Area</label>
    <select class="Opiciones" name="Area" id="Area" required>
      <?php include('config/list_areas.php');?>
      <option value="General">General</option>
    </select>
    <label for="No_ConformidadIN">No Conformidad</label>
    <input class="Opiciones" style="width:500px" type="text" name="No_ConformidadIN" id="No_ConformidadIN" required>
    <label for="AccionesIN">Acciones</label>
    <input class="Opiciones" style="width:500px" type="text" name="AccionesIN" id="AcccionesIN" required>
    <label for="FechaIN">Fecha</label>
    <input class="Opiciones" style="width:500px" type="date" name="FechaIN" id="FechaIN" required>
    <label for="OwnerIN">Owner</label>
    <input class="Opiciones" style="width:500px" type="text" name="OwnerIN"  id="OwnerIN" required>
    <label for="Fecha_CompletadoIN">Fecha_Completado</label>
    <input class="Opiciones" style="width:500px" type="date" name="Fecha_CompletadoIN" id="Fecha_CompletadoIN" required>
    <label for="ComentariosIN">Comentarios</label>
    <input class="Opiciones" style="width:500px" type="text" name="ComentariosIN" id="ComentariosIN"  required>
    <input type="button" name="guardar" value="Aceptar" onclick="guardarDatos()"></input>
  </form>
  <button id="closeButton" onclick="cerrarPopup()">Cerrar</button>
</div>

<div id="miPopup2" class="popup">
<form>
  <input type="hidden" name="idActualizar" id="idActualizar" value="">
  <label for="FechaActualizar">Fecha</label>
  <input class="Opiciones" type="date" name="FechaActualizar" id="FechaActualizar" required>
  <input type="button" name="guardar" value="Aceptar" onclick="actualizarFecha(document.getElementById('idActualizar').value)"></input>
  <input type="button" name="guardar" value="Cancelar" onclick="cerrarPopup2()"></input>
</form>
    
</div>

<div id="miPopup3" class="popup">
<form>
  <input type="hidden" name="idActualizarComentario" id="idActualizarComentario" value="">
  <label for="ComentarioActualizar">Comentario</label>
  <textarea class="Opiciones" name="ComentarioActualizar" id="ComentarioActualizar" rows="10" cols="50" resize="none" required></textarea>
  <input type="button" name="guardar" value="Aceptar" onclick="actualizarComentario(document.getElementById('idActualizarComentario').value)"></input>
  <input type="button" name="guardar" value="Cancelar" onclick="cerrarPopup3()"></input>
</form>
    
</div>


</body>


<script>
function actualizar(id) {
  // Preguntar al usuario si desea actualizar el registro
  if (confirm("¿Está seguro de que desea actualizar este registro?")) {
    // Hacer una solicitud AJAX para actualizar el registro en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "actualizar.php?id="+id, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Mostrar un mensaje de éxito al usuario
        // alert("Registro actualizado con éxito");
        // Recargar la página principal después de actualizar el registro
        document.location.reload(true);
      }
    };
    xhr.send();
  }
}

function abrirPopup() {
  var popup = document.getElementById("miPopup");
  popup.style.display = "block";
}

function abrirPopup2(id) {
  var popup = document.getElementById("miPopup2");
  popup.style.display = "block";
  document.getElementById("idActualizar").value=id;
  console.log(id);
}

// function abrirPopup3(id) {
//   var popup = document.getElementById("miPopup3");
//   popup.style.display = "block";
//   document.getElementById("idActualizarComentario").value=id;
//   console.log(id);
// }

function abrirPopup3(id) {
  var popup = document.getElementById("miPopup3");
  popup.style.display = "block";
  document.getElementById("idActualizarComentario").value = id;
  console.log(id);

  // Realizar una llamada AJAX para obtener la información del servidor
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // La respuesta del servidor se ha recibido correctamente
      document.getElementById("ComentarioActualizar").value = this.responseText;
    }
  };
  xmlhttp.open("GET", "obtener-informacion.php?id=" + id, true);
  xmlhttp.send();
}

function aceptarPopup() {
  guardarDatos();
}

function cerrarPopup() {
  document.getElementById("miPopup").style.display = "none";
}

function cerrarPopup2() {
  document.getElementById("miPopup2").style.display = "none";
}

function cerrarPopup3() {
  document.getElementById("miPopup3").style.display = "none";
}

function guardarDatos() {
  // Obtenemos los valores de los campos del formulario
  var area = document.getElementById("Area").value;
  var noConformidad = document.getElementById("No_ConformidadIN").value;
  var acciones = document.getElementById("AcccionesIN").value;
  var fecha = document.getElementById("FechaIN").value;
  var owner = document.getElementById("OwnerIN").value;
  var fechaCompletado = document.getElementById("Fecha_CompletadoIN").value;
  var comentarios = document.getElementById("ComentariosIN").value;  
  console.log(area);
  console.log(noConformidad);
  console.log(acciones);
  console.log(fecha);
  console.log(owner);
  console.log(fechaCompletado);
  console.log(comentarios);
  console.log("guardar.php?=areachila="+area+"&noConformidad="+noConformidad+"&acciones="+acciones);
  
    if (area === "" || noConformidad === "" || acciones === "" || fecha === "" || owner === "" || fechaCompletado === "" || comentarios === "") {
    alert("Por favor completa todos los campos requeridos");
    return;
  }
   // Enviamos los datos a través de AJAX usando el método POST
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "guardar.php?areachila="+area+"&noConformidad="+noConformidad+"&acciones="+acciones+"&fecha="+fecha+"&owner="+owner+"&fechaCompletado="+fechaCompletado+"&comentarios="+comentarios, true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Mostramos una alerta al usuario informándole que se han guardado los datos
       // alert("Los datos han sido guardados correctamente");
      
      // Cerramos el popup

      // document.getElementById("miPopup").style.display = "none";
      location.reload(true);
    }
  };
  xhr.send();
}

function actualizarFecha(id) {
  var nuevaFecha = document.getElementById("FechaActualizar").value;
    if (nuevaFecha === "") {
    alert("Por favor completa todos los campos requeridos");
    return;
  }  
    // debugger;
    // console.log(id);
    // console.log(nuevaFecha);
  // Enviamos los datos a través de AJAX usando el método POST
  // var xhr = new XMLHttpRequest();
  // xhr.open("GET", "actualizar_fecha.php?id="+id+"&fecha="+nuevaFecha, true);
  // xhr.onload = function() {
  //   if (xhr.status === 200) {
  //     // Mostramos una alerta al usuario informándole que se han guardado los datos
  //      // alert("Los datos han sido guardados correctamente");
      
  //     // Cerramos el popup
  //     // document.getElementById("miPopup2").style.display = "none";
      
  //     // location.reload(); // Reloads the page with cache cleared
      

  //   }
  // };
  // xhr.send();
  console.log("id:", id);
  console.log("nuevaFecha:", nuevaFecha);
  // debugger;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "actualizar_fecha.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    // Handle the response from the server

    document.getElementById("miPopup2").style.display = "none";
    location.reload();
  }
};
xhr.send("id=" + id + "&fecha=" + nuevaFecha);
}

function actualizarComentario(id) {
  var nuevaComentario = document.getElementById("ComentarioActualizar").value;
    if (nuevaComentario === "") {
    alert("Por favor completa todos los campos requeridos");
    return;
  }  
  console.log(nuevaComentario);
  console.log(id);
  debugger;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "actualizar_comentario.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    // Handle the response from the server

    document.getElementById("miPopup3").style.display = "none";
    location.reload();
  }
};
xhr.send("id=" + id + "&comentario=" + nuevaComentario);
}

</script>

</html>