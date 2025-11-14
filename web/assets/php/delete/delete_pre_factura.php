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
    $pre_factura = $_GET['id_pre_factura'];

    $hayArticulos = select_all_articulos_pre_factura($pre_factura);
    $hayServicios = select_all_servicios_pre_factura($pre_factura);
    $hayMinutajes = select_all_minutajes_pre_factura($pre_factura);

    if (($hayArticulos->num_rows > 0) OR ($hayServicios->num_rows > 0) OR ($hayMinutajes->num_rows > 0)) {
        header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?error=prefacturaLlena');
    }else{
        eliminar_pre_factura($pre_factura);
        $data = select_nombre_pre_factura($pre_factura);
        if ($data->num_rows > 0) {
            header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?error=eliminarPrefactura');
        } else {
            header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?ok=eliminarPrefactura');
        }

    }


    ?>



</body>


</html>

<?php
} else {
    echo "false";
    header("location:../index.php");


}


?>