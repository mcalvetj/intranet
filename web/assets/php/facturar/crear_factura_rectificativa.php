<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if ($_SESSION["login_done"] == true){
?>

<head>
    <meta charset="ISO-8859-1">


    <link href="../../css/insert.css" rel="stylesheet"/>

    <link href="../../css/cargarinsert.css" rel="stylesheet"/>

</head>
<body onload="itv = setInterval(prog, 10)">

<div>

<?php
//variables
$id_factura_vieja = $_POST['id_factura'];
$fecha_factura = $_POST['fecha_factura'];
$comentario_factura_rectificativa = $_POST['comentario_factura'];

$nif_cliente = select_nif_cliente_factura($id_factura_vieja);

$ciudad_facturacion = get_ciudad_facturacion($nif_cliente);
$ciudad_facturacion = "\"$ciudad_facturacion\"";
$codigo_postal_facturacion = get_codigo_postal_facturacion($nif_cliente);
$codigo_postal_facturacion = "\"$codigo_postal_facturacion\"";
$calle_facturacion = get_calle_facturacion($nif_cliente);
$calle_facturacion = "\"$calle_facturacion\"";
$numero_facturacion = get_numero_facturacion($nif_cliente);
$nif_cliente = "\"$nif_cliente\"";


//creamos factura

$conn = connect();


//cabecera pre-factura
if ($fecha_factura == "auto") {
    $year = date("Y-m-d 00:00:00");
    $fecha_sin_hora = "\"$year\"";

    $crear_factura = "INSERT INTO FACTURA (fecha, comentario)
                        VALUES ($fecha_sin_hora,'$comentario_factura_rectificativa')";
    $conn->query($crear_factura);

    $ID_FACTURA = get_last_id_factura();

    $crear_cabecera_factura = "INSERT INTO CABECERA_FACTURA(ID_factura, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion, fecha_factura)
                        VALUES ($ID_FACTURA,$nif_cliente,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion', $fecha_sin_hora)";
    $conn->query($crear_cabecera_factura);
} else {

    $crear_factura = "INSERT INTO FACTURA (fecha, comentario)
                        VALUES ('$fecha_factura','$comentario_factura_rectificativa')";
    $conn->query($crear_factura);

    $ID_FACTURA = get_last_id_factura();

    $crear_cabecera_factura = "INSERT INTO CABECERA_FACTURA(ID_factura, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion,fecha_factura)
                        VALUES ($ID_FACTURA,$nif_cliente,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion','$fecha_factura')";
    $conn->query($crear_cabecera_factura);
}

//tronco factura
//tronco articulo
$articulos_factura = obtener_articulos_factura_rectificativa($id_factura_vieja);
if ($articulos_factura->num_rows > 0) {
    while ($row = $articulos_factura->fetch_assoc()) {

        $sql_ID_articulo = $row['ID_articulo'];
        $sql_numero_de_serie = "\"" . $row['numero_de_serie'] . "\"";
        $sql_cantidad = $row['cantidad'];
        $sql_precio = $row['precio'] * -1;
        $sql_margen = $row['margen'];
        $sql_precio_total = $row['precio_total'] * -1;
        $sql_id_articulo_facturado = $row['id_articulo_facturado'];

        $crear_tronco_factura_articulo = "INSERT INTO TRONCO_FACTURA_ARTICULO(ID_factura, ID_articulo,numero_de_serie, cantidad, precio, margen,precio_total,id_articulo_facturado)
                            VALUES ($ID_FACTURA,$sql_ID_articulo,$sql_numero_de_serie, $sql_cantidad, $sql_precio, $sql_margen,$sql_precio_total,$sql_id_articulo_facturado)";

        if ($conn->query($crear_tronco_factura_articulo) == TRUE) {


            $devolver_articulo = get_articulo_facturado($sql_id_articulo_facturado);
            if ($devolver_articulo->num_rows > 0) {
                // output data of each row
                while ($row = $devolver_articulo->fetch_assoc()) {
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

                $deolver_articulo_disponible = "INSERT INTO ARTICULO (nombre, descripcion, codigo_de_barras, NIF_mayorista,  codigo_producto_mayorista, numero_de_serie, precio, cantidad, 	numero_factura, ubicacion, fecha_de_alta, NIF_cliente_articulo)
					VALUES ($sql_nombre,$sql_descripcion,$sql_codigo_de_barras,$sql_NIF_mayorista,$sql_codigo_producto_mayorista, $sql_numero_de_serie ,$sql_precio,$sql_cantidad,$sql_numero_factura,$sql_ubicacion, $sql_fecha_de_alta,$sql_NIF_cliente_articulo)";
                $conn->query($deolver_articulo_disponible);
            }
        } else {
            echo "Error: <br><br>" . $crear_tronco_factura_articulo . "<br><br><br>" . $conn->error;
        }
    }
}


//tronco servicio
$servicios_factura = obtener_servicios_factura_rectificativa($id_factura_vieja);
if ($servicios_factura->num_rows > 0) {
    while ($row = $servicios_factura->fetch_assoc()) {
        $id_tronco_factura_servicio = $row['ID_TRONCO_FACTURA_SERVICIO'];
        $servicio_facturado_rectificado = obtener_datos_servicio_rectificativo($id_tronco_factura_servicio);

        while ($row = $servicio_facturado_rectificado->fetch_assoc()) {
            $sql_ID_servicio = $row['ID_servicio'];
            $sql_cantidad = $row['cantidad'];
            $sql_precio = $row['precio'] * -1;
            $sql_margen = $row['margen'];
            $sql_precio_total = $row['precio_total'] * -1;
            $sql_id_servicio_facturado = $row['id_servicio_facturado'];

            $crear_tronco_factura_servicio = "INSERT INTO TRONCO_FACTURA_SERVICIO(ID_factura, ID_servicio, cantidad,precio, margen,precio_total,id_servicio_facturado)
                        VALUES ($ID_FACTURA,$sql_ID_servicio, $sql_cantidad, $sql_precio, $sql_margen,$sql_precio_total,$sql_id_servicio_facturado)";

            if ($conn->query($crear_tronco_factura_servicio) == TRUE) {


            } else {
                echo "Error: <br><br>" . $crear_tronco_factura_servicio . "<br><br><br>" . $conn->error;
            }
        }
    }
}

//tronco minutaje
$minutaje_factura = obtener_minutaje_factura_rectificativa($id_factura_vieja);
if ($minutaje_factura->num_rows > 0) {
    while ($row = $minutaje_factura->fetch_assoc()) {

        $sql_ID_minutaje = $row['ID_minutaje'];
        $sql_ID_servicio = $row['ID_servicio'];
        $sql_comentario = $row['comentario'];
        $sql_comentario = "\"$sql_comentario\"";
        $sql_fecha = "\"" . $row['fecha'] . "\"";
        $sql_horas = $row['horas'];
        $sql_precio_servicio = $row['precio_servicio'] * -1;
        $sql_margen = $row['margen'];
        $sql_precio_total = $row['precio_total'] * -1;
        $sql_id_minutaje_facturado = $row['id_minutaje_facturado'];

        $crear_tronco_factura_minutaje = "INSERT INTO TRONCO_FACTURA_MINUTAJE(ID_factura,ID_minutaje, ID_servicio,fecha,horas, precio_servicio, margen,precio_total,id_minutaje_facturado, comentario)
                        VALUES ($ID_FACTURA,$sql_ID_minutaje,$sql_ID_servicio,$sql_fecha,'$sql_horas' ,$sql_precio_servicio, $sql_margen,$sql_precio_total,$sql_id_minutaje_facturado, $sql_comentario)";

        if ($conn->query($crear_tronco_factura_minutaje) == TRUE) {


            $devolver_minutaje = get_minutaje_facturado($sql_id_minutaje_facturado);
            if ($devolver_minutaje->num_rows > 0) {
                // output data of each row
                while ($row = $devolver_minutaje->fetch_assoc()) {
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
                $conn->query($deolver_minutaje_disponible);


            } else {
                echo "Error: <br><br>" . $crear_tronco_factura_minutaje . "<br><br><br>" . $conn->error;
            }
        }
    }
}


//crear pie factura
$cabecera_factura_rectificativa = get_pie_factura($id_factura_vieja);
if ($cabecera_factura_rectificativa->num_rows > 0) {
    while ($row = $cabecera_factura_rectificativa->fetch_assoc()) {
        $sql_total_facturado = $row['total_facturado'] * -1;
        $sql_IVA = $row['IVA'];
        $sql_total_neto = $row['total_neto'] * -1;

        $crear_pie_factura = "INSERT INTO PIE_FACTURA(ID_factura, total_facturado, IVA,total_neto)
                            VALUES ($ID_FACTURA,$sql_total_facturado, $sql_IVA, $sql_total_neto)";

    }
}
}


if ($conn->query($crear_pie_factura) == TRUE) {

} else {
    /* echo "Error: <br><br>" . $crear_pie_factura . "<br><br><br>" . $conn->error;*/
}

include('crear_factura_pdf.php');

header('Location: ../../../factura.php?ok=altaFacturaRectificativa');

/*header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?error=altaPrefactura');*/
/*echo "$conn->error";


close($conn);

?>

<?php

} else {
echo "false";
header("location:../index.php");
}
*/
?>