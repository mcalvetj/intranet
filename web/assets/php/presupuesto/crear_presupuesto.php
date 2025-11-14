<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if ($_SESSION["login_done"] == true) {
    ?>


    <html lang="en">
    <head>

        <!--INSERTS-->
        <link href="../../css/insert.css" rel="stylesheet"/>
        <!--CARGAR BARRA INSERT-->
        <link href="../../css/cargarinsert.css" rel="stylesheet"/>

    </head>
    <body onload="itv = setInterval(prog, 10)">

    <div>

        <?php
        //Declaramos las variables del formulario
        $nombre = $_POST['nombre'];
        $nif_empresa = $_POST['select_box_nif_empresa'];
        $comentario = $_POST['comentario'];

        $ciudad_facturacion = get_ciudad_facturacion($nif_empresa);
        $ciudad_facturacion = "\"$ciudad_facturacion\"";
        $codigo_postal_facturacion = get_codigo_postal_facturacion($nif_empresa);
        $codigo_postal_facturacion = "\"$codigo_postal_facturacion\"";
        $calle_facturacion = get_calle_facturacion($nif_empresa);
        $calle_facturacion = "\"$calle_facturacion\"";
        $numero_facturacion = get_numero_facturacion($nif_empresa);

        //Añadimos comillas a los varchars
        $comentario = "\"$comentario\"";
        $nombre = "\"$nombre\"";
        $nif_empresa = "\"$nif_empresa\"";

        //nulls
        if($comentario== "\"\""){
            $comentario='null';
        }



        //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
        $conn = connect();

        $sql = "INSERT INTO PRESUPUESTO (nombre,comentario,NIF_empresa)
					VALUES ($nombre, $comentario, $nif_empresa)";

        if ($conn->query($sql) === TRUE) {

            $ID_PRESUPUESTO = get_last_id_presupuesto();
            echo $ID_PRESUPUESTO;

            $crear_cabecera_presupuesto = "INSERT INTO CABECERA_PRESUPUESTO(ID_presupuesto, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion)
                        VALUES ($ID_PRESUPUESTO,$nif_empresa,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion')";
            if ($conn->query($crear_cabecera_presupuesto) === TRUE) {
                header('Location: ../../../presupuesto/add_material_presupuesto.php?presupuesto=nuevo');
            } else {
                echo $crear_cabecera_presupuesto . "<br><br><br>" . $conn->error;
            }
        } else {
            echo $sql . "<br><br><br>" . $conn->error;
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