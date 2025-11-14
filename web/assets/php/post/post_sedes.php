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

					$NIF_cliente = $_POST['select_box_nif_empresa'];
					$nombre = $_POST['nombre'];
					$ciudad = $_POST['ciudad'];
					$codigo_postal = $_POST['codigo_postal'];
					$calle = $_POST['calle'];
					$numero = $_POST['numero'];
					$ubicacion = $_POST['ubicacion'];
					$telefono = $_POST['telefono'];
					$pais = utf8_encode($_POST['select_box_pais']);
                    $activo = 1;
                    
                    




					$prefijo = select_prefijo_pais($pais);
					$pais2 = $_POST['select_box_pais'];


					//Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
					$conn = connect();

					$sql = "INSERT INTO SEDE (NIF_cliente, nombre, ubicacion, ciudad, codigo_postal, calle, numero, telefono, pais, prefijo, activo)
					VALUES ('$NIF_cliente', '$nombre', '$ubicacion', '$ciudad', '$codigo_postal', '$calle', '$numero', $telefono, '$pais2', $prefijo, $activo)";
					    


					if ($conn->query($sql) === TRUE) {
                        header('Location: ../../../insert.php?ok=altaSede');
					} else {
                        header('Location: ../../../insert.php?error=altaSede');
                        
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