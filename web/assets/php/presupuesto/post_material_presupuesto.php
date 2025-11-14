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
    $contador = $_POST['contador'];
    $id_presupuesto = $_POST['id_presupuesto'];
    $precio = 0;
    $cantidad = 0;
    $precio_total = 0;
    $precio_total_presupuesto = 0;

    //tronco presupuesto


    //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
    $conn = connect();
    for ($i = 1; $i <= $contador; $i++) {

        $post_descripcion = "descripcion_" . $i;
        $post_precio = "precio_" . $i;
        $post_cantidad = "cantidad_" . $i;


        $descripcion = $_POST[$post_descripcion];
        $precio = $_POST[$post_precio];
        $precio = round($precio, 2);
        $cantidad = $_POST[$post_cantidad];


        //precio total del producto
        $precio_total = $precio * $cantidad;
        $precio_total = round($precio_total, 2);

        //precio total del presupuesto
        $precio_total_presupuesto = $precio_total_presupuesto + $precio_total;
        $precio_total_presupuesto = round($precio_total_presupuesto, 2);

        $tronco_presupuesto = "INSERT INTO TRONCO_PRESUPUESTO (ID_presupuesto, descripcion, cantidad, precio, precio_total)
                        VALUES ($id_presupuesto, '$descripcion', $cantidad, $precio,$precio_total)";

        $conn->query($tronco_presupuesto);

    }

        //pie presupuesto

        //COMPROBAR SI EXISTE
        $data_pie_presupuesto = select_pie_presupuesto($id_presupuesto);

        if ($data_pie_presupuesto->num_rows > 0) {
            // output data of each row
            while ($row = $data_pie_presupuesto->fetch_assoc()) {

                $suma_total_presupuesto=$row['total_neto']+$precio_total_presupuesto;
                $precio_total_iva = $suma_total_presupuesto + (($suma_total_presupuesto / 100) * 21);
                $precio_total_iva = round($precio_total_iva, 2);

                $pie_presupuesto = "UPDATE PIE_PRESUPUESTO SET total_neto = $suma_total_presupuesto, total_facturado = $precio_total_iva where ID_presupuesto=$id_presupuesto";

                if ($conn->query($pie_presupuesto) === TRUE) {
                    header('Location: ../../../presupuesto/ver_presupuesto.php?id=' . $id_presupuesto);
                } else {
                    echo $sql . "<br><br><br>" . $conn->error;
                }

            }

        }else{
            $precio_total_iva = $precio_total_presupuesto + (($precio_total_presupuesto / 100) * 21);
            $precio_total_iva = round($precio_total_iva, 2);

            $pie_presupuesto = "INSERT INTO PIE_PRESUPUESTO (ID_presupuesto, total_neto, IVA, total_facturado)
                        VALUES ($id_presupuesto, $precio_total_presupuesto, 21,$precio_total_iva)";

            if ($conn->query($pie_presupuesto) === TRUE) {
                header('Location: ../../../presupuesto/ver_presupuesto.php?id=' . $id_presupuesto);
            } else {
                echo $sql . "<br><br><br>" . $conn->error;
            }

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