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
<body>

<div>

    <?php
    $ID_TRONCO_PRESUPUESTO = $_GET['id'];
    $presupuesto = $_GET['presupuesto'];

    $conn = connect();
    $precio_total_producto_eliminado = get_precio_total_presupuesto($ID_TRONCO_PRESUPUESTO);
    $total_neto = get_total_neto_presupuesto($presupuesto);
    $total_facturado = get_total_facturado_presupuesto($presupuesto);
    $iva_presupuesto = get_iva_presupuesto($presupuesto);
    $iva_presupuesto_calculo = ($iva_presupuesto + 100) / 100;
    $precio_total_producto_eliminado_iva = $precio_total_producto_eliminado * $iva_presupuesto_calculo;
    $new_total_neto = $total_neto - $precio_total_producto_eliminado;
    $new_total_facturado = $new_total_neto * $iva_presupuesto_calculo;


    $modificar_pie_presupuesto = "UPDATE PIE_PRESUPUESTO SET total_neto = '$new_total_neto' , IVA = '$iva_presupuesto', total_facturado='$new_total_facturado'  WHERE ID_presupuesto = '$presupuesto '";
echo $modificar_pie_presupuesto;

    if ($conn->query($modificar_pie_presupuesto) === TRUE) {
        $eliminar_de_presupuesto = "DELETE FROM TRONCO_PRESUPUESTO WHERE ID_TRONCO_PRESUPUESTO = $ID_TRONCO_PRESUPUESTO ";
        if ($conn->query($eliminar_de_presupuesto) === TRUE) {
            header('Location: ../../../presupuesto/ver_presupuesto.php?ok=eliminarProducto&id=' . $presupuesto);
        } else {
            echo $sql . "<br><br><br>" . $conn->error;
            header('Location: ../../../presupuesto/ver_presupuesto.php?error=eliminarProducto&id=' . $presupuesto);
        }
    } else {
        echo $sql . "<br><br><br>" . $conn->error;
        header('Location: ../../../presupuesto/ver_presupuesto.php?error=eliminarProducto&id=' . $presupuesto);
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