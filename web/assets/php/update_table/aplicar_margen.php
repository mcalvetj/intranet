<?php
include('../db.php');
$para = $_POST['para'];


$margen = $_POST['margen'];
$precio_con_margen = $_POST['precio_con_margen'];
$id_tronco_pre_factura = $_POST['id_tronco_pre_factura'];
$precio_unidad_con_margen = $_POST['precio_unidad_con_margen'];

if($para=="presupuesto"){

    $iva = $_POST['iva'];
    $total_sin_iva = $_POST['total_sin_iva'];
    $total_con_iva = $_POST['total_con_iva'];
    $id_presupuesto = $_POST['id_presupuesto'];

}
if($para=="minutaje"){

    $precio_servicio_margen = $_POST['precio_servicio'];

}

if ($para == "articulo") {
    $conn = connect();
    $sql = "UPDATE TRONCO_PRE_FACTURA_ARTICULO
      SET margen= $margen , precio_total = $precio_con_margen, precio=$precio_unidad_con_margen
      WHERE ID_TRONCO_PRE_FACTURA_ARTICULO = $id_tronco_pre_factura";
    $conn->query($sql);
    close($conn);

}
if($para=="servicio"){
    $conn = connect();
    $sql = "UPDATE TRONCO_PRE_FACTURA_SERVICIO
      SET margen= $margen , precio_total = $precio_con_margen, precio=$precio_unidad_con_margen
      WHERE ID_TRONCO_PRE_FACTURA_SERVICIO = $id_tronco_pre_factura";
    $conn->query($sql);
    close($conn);
}if($para=="minutaje"){
    $conn = connect();
    $sql = "UPDATE TRONCO_PRE_FACTURA_MINUTAJE
      SET margen= $margen , precio_total = $precio_con_margen, precio_servicio = $precio_servicio_margen
      WHERE ID_TRONCO_PRE_FACTURA_MINUTAJE = $id_tronco_pre_factura";
    $conn->query($sql);
    close($conn);
}
if($para=="presupuesto"){
    $conn = connect();
    $sql = "UPDATE TRONCO_PRESUPUESTO
      SET margen= $margen , precio_total = $precio_con_margen, precio=$precio_unidad_con_margen
      WHERE ID_TRONCO_PRESUPUESTO = $id_tronco_pre_factura";
    $conn->query($sql);

    $sql2 = "UPDATE PIE_PRESUPUESTO
      SET IVA= $iva , total_neto = $total_sin_iva, total_facturado=$total_con_iva
      WHERE ID_presupuesto = $id_presupuesto";
    $conn->query($sql2);
    close($conn);
}

?>