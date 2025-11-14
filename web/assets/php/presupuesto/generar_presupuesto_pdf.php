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
    $id_presupuesto = $_POST['id_presupuesto'];



    //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
    $conn = connect();

    include('crear_presupuesto_pdf.php');

    close($conn);

    header('Location: ../../../presupuesto/ver_presupuesto.php?id=' . $id_presupuesto);

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