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
    $id_minutaje_facturado = $_GET['id'];
    $pre_factura = $_GET['pre_factura'];

    $conn = connect();
    $data = get_minutaje_facturado($id_minutaje_facturado);
    if ($data->num_rows > 0) {
    // output data of each row
    while ($row = $data->fetch_assoc()) {
        //filtrado de nulls
        $sql_fecha = $row['fecha'];
        $sql_fecha = "\"$sql_fecha\"";

        $sql_hora_entrada = $row['hora_entrada'];
        $sql_hora_entrada = "\"$sql_hora_entrada\"";

        $sql_hora_salida = $row['hora_salida'];
        $sql_hora_salida = "\"$sql_hora_salida\"";

        $sql_id_servicio = $row['ID_SERVICIO'];
        $sql_id_servicio = "\"$sql_id_servicio\"";

        $sql_ID_usuario = $row['ID_USUARIO'];

        $sql_ID_sede = $row['ID_SEDE'];

        $sql_NIF_cliente = $row['NIF_cliente'];
        $sql_NIF_cliente = "\"$sql_NIF_cliente\"";

        $sql_comentario = $row['comentario'];
        $sql_comentario = "\"$sql_comentario\"";


    }

    $deolver_minutaje_disponible = "INSERT INTO MINUTAJE (fecha, hora_entrada, hora_salida, ID_servicio, ID_usuario, ID_sede, NIF_cliente, comentario)
					VALUES ($sql_fecha,$sql_hora_entrada,$sql_hora_salida,$sql_id_servicio,$sql_ID_usuario, $sql_ID_sede ,$sql_NIF_cliente, $sql_comentario)";

    if ($conn->query($deolver_minutaje_disponible) === TRUE) {

        $eliminar_de_prefactura="DELETE FROM TRONCO_PRE_FACTURA_MINUTAJE WHERE id_minutaje_facturado = $id_minutaje_facturado ";
        $conn->query($eliminar_de_prefactura);

        $eliminar_minutaje_facturado="DELETE FROM MINUTAJE_FACTURADO WHERE ID_MINUTAJE_FACTURADO = $id_minutaje_facturado ";

        if ($conn->query($eliminar_minutaje_facturado) === TRUE) {
            header('Location: ../../../pre_factura/ver_pre_factura.php?ok=eliminarMinutaje&id='.$pre_factura);
        } else {
            header('Location: ../../../pre_factura/ver_pre_factura.php?error=eliminarMinutaje&id='.$pre_factura);
        }
        } else {
            header('Location: ../../../pre_factura/ver_pre_factura.php?error=eliminarMinutaje&id='.$pre_factura);
        }

    close($conn);

    ?>

</div>


</body>


</html>

<?php
}
} else {
    echo "false";
    header("location:../index.php");


}


?>