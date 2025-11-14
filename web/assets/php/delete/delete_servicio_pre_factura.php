<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet"/>
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet"/>

</head>
<body onload="itv = setInterval(prog, 10)">

<div>

    <?php
    $id_servicio_facturado = $_GET['id'];
    $pre_factura = $_GET['pre_factura'];

    $conn = connect();



    $eliminar_servicio_prefactura = "DELETE FROM TRONCO_PRE_FACTURA_SERVICIO WHERE id_servicio_facturado = $id_servicio_facturado ";

    if ($conn->query($eliminar_servicio_prefactura) === TRUE) {

        $eliminar_servicio_facturado="DELETE FROM SERVICIO_FACTURADO WHERE ID_SERVICIO_FACTURADO = $id_servicio_facturado ";

        if ($conn->query($eliminar_servicio_facturado) === TRUE) {
            header('Location: ../../../pre_factura/ver_pre_factura.php?ok=eliminarServicio&id='.$pre_factura);
        } else {
            header('Location: ../../../pre_factura/ver_pre_factura.php?error=eliminarServicio&id='.$pre_factura);
        }



    } else {
        header('Location: ../../../pre_factura/ver_pre_factura.php?error=eliminarServicio&id='.$pre_factura);
        }

    close($conn);

    ?>

</div>


</body>


</html>

<?php

} else {
    echo "false";
    header("location:../index.php");


}


?>