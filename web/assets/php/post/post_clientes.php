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

                    $nif_empresa = $_POST['nif_empresa'];
                    $nif_intra = $_POST['nif_intra'];
                    $nombre_comercial = $_POST['nombre_comercial'];
                    $nombre_completo = $_POST['nombre_completo'];
                    $telefono = $_POST['telefono'];
                    $email = $_POST['email'];
                    $email = "$email";
                    $ciudad_facturacion = $_POST['ciudad_facturacion'];
                    $codigo_postal_facturacion = $_POST['codigo_postal_facturacion'];
                    $calle_facturacion = $_POST['calle_facturacion'];
                    $numero_facturacion = $_POST['numero_facturacion'];
                    $ciudad_envio = $_POST['ciudad_envio'];
                    $codigo_postal_envio = $_POST['codigo_postal_envio'];
                    $calle_envio = $_POST['calle_envio'];
                    $numero_envio = $_POST['numero_envio'];
                    $iban = $_POST['iban'];
                    $sepa = $_POST['select_box_sepa'];
                    $pais = utf8_encode($_POST['select_box_pais']);
                    $activo = 1;
                    if($email == "") {
                        $email = 'null';
                    }


                    $prefijo = select_prefijo_pais($pais);

                    $pais2 = $_POST['select_box_pais'];

                    //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
                    $conn = connect();

                    $sql = "INSERT INTO CLIENTE (NIF_EMPRESA,nif_intra, nombre_comercial, nombre_completo, telefono, email, ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion, ciudad_envio, codigo_postal_envio, calle_envio, numero_envio, IBAN, SEPA, pais, prefijo, activo)
					VALUES ('$nif_empresa','$nif_intra', '$nombre_comercial', '$nombre_completo', $telefono, '$email', '$ciudad_facturacion', '$codigo_postal_facturacion', '$calle_facturacion', '$numero_facturacion', '$ciudad_envio', '$codigo_postal_envio', '$calle_envio', '$numero_envio', '$iban', '$sepa', '$pais2', $prefijo, $activo)";



                    if ($conn->query($sql) === TRUE) {
                        header('Location: ../../../insert.php?ok=altaCliente');
					} else {
                        header('Location: ../../../insert.php?error=altaCliente');
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