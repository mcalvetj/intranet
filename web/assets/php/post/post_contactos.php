    <!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>
    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet" />
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet" />

</head>
<body onload="itv = setInterval(prog, 10)">

<div>
    
						<?php
						#Declaramos las variables del formulario
						$nombre = $_POST['nombre'];
						$sede = $_POST['select_box_sede_cliente'];
						$cargo = $_POST['cargo'];
						$email = $_POST['email'];
						$telefono = $_POST['telefono'];
						$pais = utf8_encode($_POST['select_box_pais']);
						$extension = $_POST['extension'];

						$prefijo = select_prefijo_pais($pais);

						$pais2 = $_POST['select_box_pais'];

						//Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
						$conn = connect();
                        $data = select_id_sede($sede);
						if($extension==''){

						$sql = "INSERT INTO CONTACTO (nombre, ID_sede, cargo, email, telefono, pais, prefijo)
						VALUES ('$nombre', '$data', '$cargo', '$email', '$telefono', '$pais2', $prefijo)";

						}else{

						$sql = "INSERT INTO CONTACTO (nombre, ID_sede, cargo, email, telefono, pais, prefijo, extension)
						VALUES ('$nombre', '$data', '$cargo', '$email', '$telefono', '$pais2', $prefijo, $extension)";

						}

						if ($conn->query($sql) === TRUE) {
						?>
							<!--
						<div id="precargador">
							  <p id="progressnum"></p> 
							  <div id="progressbar">
							     <div id="indicador"></div>
							  </div>
						</div>
							
						    <script>
						    //document.body.style.background = "#ea7f33";
						    var maxprogress = 300;
								var actualprogress = 0;
								var itv = 0;
								function prog()
								{
								  if(actualprogress >= maxprogress) 
								  {
								    clearInterval(itv);     
								    return;
								  } 
								  var progressnum = document.getElementById("progressnum");
								  var indicador = document.getElementById("indicador");
								  actualprogress +=2;  
								  indicador.style.width=actualprogress + "px";
								  progressnum.innerHTML = "Añadiendo contacto...";
								  if (actualprogress==300){
									window.location="../../../insert/insert_contactos.php";
								  }
								}
							</script>-->

						<?php
                            header('Location: ../../../insert.php?ok=altaContacto');
						} else {
                            header('Location: ../../../insert.php?error=altaContacto');
						}

						close($conn); 
						 
						?>

</div>
</body>
</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>