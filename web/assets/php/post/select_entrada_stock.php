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

    $codigo_de_barras = $_POST['codigo_de_barras'];
    $data = get_articulo_with_codigo_de_barras($codigo_de_barras);
    $_SESSION['s_codigo_de_barras'] = $codigo_de_barras;
    if ($data->num_rows > 0) {

        ?>
        <script>

            window.location = "../../../entrada_stock_existente.php";
        </script>

    <?php
    } else { ?>
        <script>
            window.location = "../../../entrada_stock_nuevo.php";
        </script>
        <?php
    }
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