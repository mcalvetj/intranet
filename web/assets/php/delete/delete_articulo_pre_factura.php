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
    $id_articulo_facturado = $_GET['id'];
    $pre_factura = $_GET['pre_factura'];

    $conn = connect();
    $data = get_articulo_facturado($id_articulo_facturado);
    if ($data->num_rows > 0) {
    // output data of each row
    while ($row = $data->fetch_assoc()) {
        //filtrado de nulls
        $sql_nombre = $row['nombre'];
        $sql_nombre = "\"$sql_nombre\"";

        $sql_descripcion = $row['descripcion'];
        $sql_descripcion = "\"$sql_descripcion\"";

        $codigo_de_barras = $row['codigo_de_barras'];
        $sql_codigo_de_barras = $row['codigo_de_barras'];
        $sql_codigo_de_barras = "\"$sql_codigo_de_barras\"";

        $sql_NIF_mayorista = $row['NIF_mayorista'];
        $sql_NIF_mayorista = "\"$sql_NIF_mayorista\"";

        $sql_codigo_producto_mayorista = $row['codigo_producto_mayorista'];
        $sql_codigo_producto_mayorista = "\"$sql_codigo_producto_mayorista\"";

        $sql_numero_de_serie = $row['numero_de_serie'];
        $sql_numero_de_serie = "\"$sql_numero_de_serie\"";

        $sql_ubicacion = $row['ubicacion'];
        $sql_ubicacion = "\"$sql_ubicacion\"";

        $sql_precio = $row['precio'];
        $sql_precio = "\"$sql_precio\"";

        $cantidad = $row['cantidad'];
        $sql_cantidad = $row['cantidad'];
        $sql_cantidad = "\"$sql_cantidad\"";

        $sql_numero_factura = $row['numero_factura'];
        $sql_numero_factura = "\"$sql_numero_factura\"";

        $sql_fecha_de_alta = $row['fecha_de_alta'];
        $sql_fecha_de_alta = "\"$sql_fecha_de_alta\"";

        $sql_NIF_cliente_articulo = 'null';


        if ($sql_codigo_producto_mayorista == "\"\"") {
            $sql_codigo_producto_mayorista = 'null';
        }
        if ($sql_descripcion == "\"\"") {
            $sql_descripcion = 'null';
        }
        if ($sql_NIF_mayorista == "\"\"") {
            $sql_NIF_mayorista = 'null';
        }
        if ($sql_numero_de_serie == "\"\"") {
            $sql_numero_de_serie = 'null';
        }
        if ($sql_ubicacion == "\"\"") {
            $sql_ubicacion = 'null';
        }

    }

    $deolver_articulo_disponible = "INSERT INTO ARTICULO (nombre, descripcion, codigo_de_barras, NIF_mayorista,  codigo_producto_mayorista, 	numero_de_serie, precio, cantidad, 	numero_factura, ubicacion, fecha_de_alta, NIF_cliente_articulo)
					VALUES ($sql_nombre,$sql_descripcion,$sql_codigo_de_barras,$sql_NIF_mayorista,$sql_codigo_producto_mayorista, $sql_numero_de_serie ,$sql_precio,$sql_cantidad,$sql_numero_factura,$sql_ubicacion, $sql_fecha_de_alta,$sql_NIF_cliente_articulo)";

    if ($conn->query($deolver_articulo_disponible) === TRUE) {
        $num_filas = get_row_stock($codigo_de_barras);

        if($num_filas ==0){
            $actualizar_stock=" INSERT INTO STOCK (CODIGO_DE_BARRAS, cantidad_total) VALUES($sql_codigo_de_barras,$cantidad)";
            $conn->query($actualizar_stock);

        }else{
            $cantidad_total_stock=select_cantidad_stock($codigo_de_barras);
            $cantidad_total_stock=$cantidad_total_stock+$cantidad;

            $actualizar_stock=" UPDATE STOCK SET cantidad_total = '".$cantidad_total_stock."' where CODIGO_DE_BARRAS='".$codigo_de_barras."'";
            $conn->query($actualizar_stock);

        }

        $eliminar_de_prefactura="DELETE FROM TRONCO_PRE_FACTURA_ARTICULO WHERE id_articulo_facturado = $id_articulo_facturado ";
        $conn->query($eliminar_de_prefactura);

        $eliminar_articulo_facturado="DELETE FROM ARTICULO_FACTURADO WHERE ID_ARTICULO_FACTURADO = $id_articulo_facturado ";
        if ($conn->query($eliminar_articulo_facturado) === TRUE) {
            header('Location: ../../../pre_factura/ver_pre_factura.php?ok=eliminarArticulo&id='.$pre_factura);
        } else {
            header('Location: ../../../pre_factura/ver_pre_factura.php?error=eliminarArticulo&id='.$pre_factura);
        }

        } else {
        header('Location: ../../../pre_factura/ver_pre_factura.php?error=eliminarArticulo&id='.$pre_factura);
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