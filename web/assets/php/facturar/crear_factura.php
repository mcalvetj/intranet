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
    $id_pre_factura = $_POST['id_pre_factura'];
    $fecha_factura1 = $_POST['fecha_factura'];
    $comentario = $_POST['comentario'];
    $comentarioSiNo = $_POST['comentarioSiNo'];

    if($fecha_factura1=="auto"){
        $year1=date("Y-m-d 00:00:00");
        $fecha_factura="\"$year1\"";
        $fecha_factura3=$year1;
        $yearNuevo=substr( $fecha_factura, 3, 2 );
    }else{
        $fecha_factura = $fecha_factura1;
        $yearNuevo=substr( $fecha_factura, 2, 2 );
    }

    $nif_cliente = get_cliente_pre_factura($id_pre_factura);

    $ciudad_facturacion = get_ciudad_facturacion($nif_cliente);
    $ciudad_facturacion = "\"$ciudad_facturacion\"";
    $codigo_postal_facturacion = get_codigo_postal_facturacion($nif_cliente);
    $codigo_postal_facturacion = "\"$codigo_postal_facturacion\"";
    $calle_facturacion = get_calle_facturacion($nif_cliente);
    $calle_facturacion = "\"$calle_facturacion\"";
    $numero_facturacion = get_numero_facturacion($nif_cliente);
    $nif_cliente = "\"$nif_cliente\"";

    //miramos la ultima factura para comprovar el año
    $ultima_factura = get_last_id_factura();
    $fechaUltimaFactura = select_fecha_factura($ultima_factura);
    $yearUltimaFactura=substr( $fechaUltimaFactura, 2, 2 );

    $nuevoIdFactura = $yearNuevo.'0001';
echo $yearNuevo;
echo "<br>";
echo $yearUltimaFactura;
echo "<br>";
echo $ultima_factura; 
echo "<br>";
echo $fecha_factura;

    if($comentarioSiNo==0){
        $comentario2=" ";
    }else{
        $comentario2=$comentario;
    }



    //creamos factura

        //creamos factura
    if($fecha_factura1=="auto"){
        if($yearNuevo==$yearUltimaFactura){
            $crear_factura = "INSERT INTO FACTURA (fecha, comentario) VALUES ('$fecha_factura3','$comentario')";
        }else{
            $crear_factura = "INSERT INTO FACTURA (ID_FACTURA, fecha, comentario) VALUES ($nuevoIdFactura,'$fecha_factura3','$comentario')";
        }
    }else{
        if($yearNuevo==$yearUltimaFactura){
            $crear_factura = "INSERT INTO FACTURA (fecha, comentario) VALUES ('$fecha_factura1','$comentario')";
        }else{
            $crear_factura = "INSERT INTO FACTURA (ID_FACTURA, fecha, comentario) VALUES ('$nuevoIdFactura','$fecha_factura1','$comentario')";
        }
    }

    $conn = connect();
    if ($conn->query($crear_factura) == TRUE) {

    $ID_FACTURA = get_last_id_factura();
    //cabecera pre-factura
    if($fecha_factura1=="auto") {
        $year=date("Y-m-d 00:00:00");
        $fecha_sin_hora="\"$year\"";

        $crear_cabecera_factura = "INSERT INTO CABECERA_FACTURA(ID_factura, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion, fecha_factura)
                        VALUES ($ID_FACTURA,$nif_cliente,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion', $fecha_sin_hora)";
    }else{
        $crear_cabecera_factura = "INSERT INTO CABECERA_FACTURA(ID_factura, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion,fecha_factura)
                        VALUES ($ID_FACTURA,$nif_cliente,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion','$fecha_factura1')";
    }

    //tronco pre-factura
    //tronco articulo
    $articulos_factura = obtener_articulos_factura($id_pre_factura);
    if ($articulos_factura->num_rows > 0) {
        while ($row = $articulos_factura->fetch_assoc()) {
            $id_tronco_pre_factura_articulo = $row['ID_TRONCO_PRE_FACTURA_ARTICULO'];

            $articulo_pre_facturado = obtener_datos_articulo($id_tronco_pre_factura_articulo);
            while ($row = $articulo_pre_facturado->fetch_assoc()) {
                $sql_ID_articulo = $row['ID_articulo'];
                $sql_numero_de_serie = "\"" . $row['numero_de_serie'] . "\"";
                if ($sql_numero_de_serie == "\"\"") {
                    $sql_numero_de_serie = 'null';
                }
                $sql_cantidad = $row['cantidad'];
                $sql_precio = $row['precio'];
                $sql_margen = $row['margen'];
                $sql_precio_total = $row['precio_total'];
                $sql_id_articulo_facturado = $row['id_articulo_facturado'];

                $crear_tronco_factura_articulo = "INSERT INTO TRONCO_FACTURA_ARTICULO(ID_factura, ID_articulo,numero_de_serie, cantidad, precio, margen,precio_total,id_articulo_facturado)
                        VALUES ($ID_FACTURA,$sql_ID_articulo,$sql_numero_de_serie, $sql_cantidad, $sql_precio, $sql_margen,$sql_precio_total,$sql_id_articulo_facturado)";

                if ($conn->query($crear_tronco_factura_articulo) == TRUE) {

                } else {
                    echo "Error: <br><br>" . $crear_tronco_factura_articulo . "<br><br><br>" . $conn->error;
                }
            }
        }
    }

    //tronco servicio
    $servicios_factura = obtener_servicios_factura($id_pre_factura);
    if ($servicios_factura->num_rows > 0) {
        while ($row = $servicios_factura->fetch_assoc()) {
            $id_tronco_pre_factura_servicio=$row['ID_TRONCO_PRE_FACTURA_SERVICIO'];

            $servicio_pre_facturado=obtener_datos_servicio($id_tronco_pre_factura_servicio);
            while ($row = $servicio_pre_facturado->fetch_assoc()) {
                $sql_ID_servicio=$row['ID_servicio'];
                $sql_cantidad=$row['cantidad'];
                $sql_precio=$row['precio'];
                $sql_margen=$row['margen'];
                $sql_precio_total=$row['precio_total'];
                $sql_id_servicio_facturado=$row['id_servicio_facturado'];

                $crear_tronco_factura_servicio = "INSERT INTO TRONCO_FACTURA_SERVICIO(ID_factura, ID_servicio, cantidad,precio, margen,precio_total,id_servicio_facturado)
                        VALUES ($ID_FACTURA,$sql_ID_servicio, $sql_cantidad, $sql_precio, $sql_margen,$sql_precio_total,$sql_id_servicio_facturado)";

                if ($conn->query($crear_tronco_factura_servicio) == TRUE) {

                }else{
                    echo "Error: <br><br>" . $crear_tronco_factura_servicio . "<br><br><br>" . $conn->error;
                }
            }
        }
    }

    //tronco minutaje
    $minutaje_factura = obtener_minutaje_factura($id_pre_factura);
    if ($minutaje_factura->num_rows > 0) {
        while ($row = $minutaje_factura->fetch_assoc()) {
            $id_tronco_pre_factura_minutaje=$row['ID_TRONCO_PRE_FACTURA_MINUTAJE'];
            $sminutaje_pre_facturado=obtener_datos_minutaje($id_tronco_pre_factura_minutaje);
            while ($row = $sminutaje_pre_facturado->fetch_assoc()) {
                $sql_ID_minutaje=$row['ID_minutaje'];
                $sql_ID_servicio=$row['ID_servicio'];
                $sql_comentario=$row['comentario'];
                $sql_comentario="\"$sql_comentario\"";
                $sql_fecha="\"".$row['fecha']."\"";
                $sql_horas=$row['horas'];
                $sql_precio_servicio=$row['precio_servicio'];
                $sql_margen=$row['margen'];
                $sql_precio_total=$row['precio_total'];
                $sql_id_minutaje_facturado=$row['id_minutaje_facturado'];

                $crear_tronco_factura_minutaje = "INSERT INTO TRONCO_FACTURA_MINUTAJE(ID_factura,ID_minutaje, ID_servicio,fecha,horas, precio_servicio, margen,precio_total,id_minutaje_facturado, comentario)
                        VALUES ($ID_FACTURA,$sql_ID_minutaje,$sql_ID_servicio,$sql_fecha,'$sql_horas' ,$sql_precio_servicio, $sql_margen,$sql_precio_total,$sql_id_minutaje_facturado, $sql_comentario)";

                if ($conn->query($crear_tronco_factura_minutaje) == TRUE) {

                }else{
                    echo "Error: <br><br>" . $crear_tronco_factura_minutaje . "<br><br><br>" . $conn->error;
                }
            }
        }
    }

    //crear pie factura
    $total_neto = $_POST['precio_sin_iva'];
    $total_facturado = $_POST['precio_con_iva'];
    $iva = $_POST['select_box_iva'];


    $crear_pie_factura = "INSERT INTO PIE_FACTURA(ID_factura, total_facturado, IVA,total_neto)
                        VALUES ($ID_FACTURA,$total_facturado, $iva, $total_neto)";
    if ($conn->query($crear_pie_factura) == TRUE) {

    }else{
        echo "Error: <br><br>" . $crear_pie_factura . "<br><br><br>" . $conn->error;
    }

    if ($conn->query($crear_cabecera_factura) == TRUE) {

        //borrar pre_factura
        eliminar_pre_factura($id_pre_factura);

        include('crear_factura_pdf.php');
        


        header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?ok=altaPrefactura');
    } else {
        /*header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?error=altaPrefactura');*/
        echo "$conn->error";
    }

    close($conn);

    ?>

<?php
}else{
        echo "Error: <br><br>" . $crear_factura . "<br><br><br>" . $conn->error;
    }
} else {
    echo "false";
    header("location:../index.php");
}

?>