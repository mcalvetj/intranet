<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>
    <meta charset="ISO-8859-1">

    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet" />
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet" />

</head>
<body onload="itv = setInterval(prog, 10)">

<div>

                        
					<?php

					#Declaramos las variables del formulario
					$NIF_cliente = $_POST['select_box_nif_empresa'];
					$sede = $_POST['select_box_sede_cliente'];
					$servicio = $_POST['select_box_servicio'];
					$usuario = $_POST['select_box_usuario'];
					$fecha = $_POST['fecha'];
					$comentario = $_POST['comentario'];
					$hora_entrada = $_POST['hora_entrada'];
                    $hora_salida = $_POST['hora_salida'];

                    $porciones = explode("//", $sede);

                    $nombreSede = $porciones[0];
                    $ubicacionSede = $porciones[1];

					$conn = connect();
					$data = select_id_sede($nombreSede,$ubicacionSede);

					$servicio2 = select_id_servicio($servicio);

					//Conectamos con la base de datos, hacemos los inserts y cerramos conexion.


					$sql = "INSERT INTO MINUTAJE (fecha, hora_entrada, hora_salida, ID_servicio, ID_usuario, ID_sede, NIF_cliente, comentario)
					VALUES ('$fecha','$hora_entrada', '$hora_salida','$servicio2','$usuario','$data','$NIF_cliente', '$comentario')";


					if ($conn->query($sql) === TRUE) {
                        header('Location: ../../../minutaje_manual.php?ok=altaMinutajeManual');
					} else {
                        header('Location: ../../../minutaje_manual.php?error=altaMinutajeManual');
					}

					close($conn); 
					 
					?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>