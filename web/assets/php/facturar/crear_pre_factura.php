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
    #Declaramos las variables del formulario

    $nif_empresa = $_POST['select_box_nif_empresa'];
    $nombre_pre_factura = $_POST['nombre_pre_factura'];
    $id_string = $_POST['submit'];


    $id_array = explode(',', $id_string);

    if($id_array[0]=='articulo'){
        $ruta='articulo.php';
    }elseif ($id_array[0]=='minutaje'){
        $ruta='minutaje.php';
    }elseif ($id_array[0]=='servicio'){
        $ruta='servicio.php';
    }



    //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
    $conn = connect();

    $sql = "INSERT INTO PRE_FACTURA (NIF_empresa, nombre)
					VALUES ('$nif_empresa', '$nombre_pre_factura')";


    if ($conn->query($sql) == TRUE) {

        $id_pre_factura = id_crear_cabecera_pre_factura($nombre_pre_factura, $nif_empresa);
        $ciudad_facturacion=ciudad_facturacion_crear_cabecera_pre_factura($nif_empresa);
        $codigo_postal_facturacion=codigo_postal_facturacion_crear_cabecera_pre_factura($nif_empresa);
        $calle_facturacion=calle_facturacion_crear_cabecera_pre_factura($nif_empresa);
        $numero_facturacion=numero_facturacion_crear_cabecera_pre_factura($nif_empresa);
        $nombre_pre_factura="$id_pre_factura - "."$nombre_pre_factura";

        $sql2 = "INSERT INTO CABECERA_PRE_FACTURA (ID_pre_factura, nombre, ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion)
					VALUES ('$id_pre_factura', '$nombre_pre_factura', '$ciudad_facturacion', '$codigo_postal_facturacion', '$calle_facturacion', '$numero_facturacion')";
        if ($conn->query($sql2) == TRUE) {
            
            ?>

            <form method="POST" id="send_articulos" action="../../../pre_factura/pre_factura_<?php echo $ruta?>">
                <input type="hidden" id="select_box_nif_empresa" name="select_box_nif_empresa" value="<?php echo $nif_empresa?>">
                <input type="hidden" id="id_string" name="id_string" value="<?php echo $id_string?>">
                <input type="hidden" id="id_string" name="select_box_pre_factura_cliente" value="<?php echo $nombre_pre_factura?>">
                <input style="display:none" type="submit" value="submit" id="buttonId"/>
            </form>
            

            <script>
                document.getElementById("send_articulos").submit();
            </script>

            <?php
        }
    } else {
        header('Location: ../../../pre_factura/pre_factura?error=preFactura');
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