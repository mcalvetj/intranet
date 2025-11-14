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
					//Declaramos las variables del formulario

					$NIF_mayorista = $_POST['NIF_mayorista'];
					$nombre_empresa = $_POST['nombre_empresa'];
					$nombre_comercial = $_POST['nombre_comercial'];
					$telefono_empresa = $_POST['telefono_empresa'];
					$telefono_comercial = $_POST['telefono_comercial'];
					$extension_telefono_comercial = $_POST['extension_telefono_comercial'];
					$email_empresa = $_POST['email_empresa'];
					$email_comercial = $_POST['email_comercial'];
                    $ubicacion = $_POST['ubicacion'];
                    $activo = $_POST['activo'];
					$IBAN = $_POST['IBAN'];

					$pais = utf8_encode($_POST['select_box_pais']);

                    $prefijo = select_prefijo_pais($pais);

                    $pais2 = $_POST['select_box_pais'];

                    $activo2=1;                    

					//Si hay algun campo opcional no rellenado lo transforma en null
					if($nombre_comercial == "" ){
						$nombre_comercial = null;
					}if($telefono_comercial == ""){
						$telefono_comercial ='null';
					}if($extension_telefono_comercial == ""){
						$extension_telefono_comercial ='null';
					}if($email_comercial == ""){
						$email_comercial =null;
					}if($ubicacion == ""){
                        $ubicacion =null;
                    }if($IBAN == ""){
						$IBAN =null;
					}if($email_empresa == ""){
                        $email_empresa =null;
                    }


					//Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
					$conn = connect();

					$sql = "INSERT INTO MAYORISTA (NIF_MAYORISTA, nombre_empresa, nombre_comercial, telefono_empresa, telefono_comercial, extension_telefono_comercial, email_empresa, email_comercial, ubicacion, pais, prefijo, IBAN,activo)
					VALUES ('$NIF_mayorista','$nombre_empresa','$nombre_comercial',$telefono_empresa,$telefono_comercial,$extension_telefono_comercial,'$email_empresa','$email_comercial','$ubicacion','$pais2',$prefijo,'$IBAN',$activo2)";
					    


					if ($conn->query($sql) === TRUE) {
                        header('Location: ../../../insert.php?ok=altaMayorista');
					} else {
                        header('Location: ../../../insert.php?error=altaMayorista');
					}

					close($conn); 
					 
					?>

</div>

</body>
</html>

<?php 
}else{
    header("location:../index.php");
}

?>