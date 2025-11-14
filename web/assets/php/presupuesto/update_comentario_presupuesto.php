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

    $conn = connect();

    //Declaramos las variables del formulario
    $comentario = $_POST['comentario'];
    $id_presupuesto = $_POST['id_presupuesto'];

    $update_comentario = "UPDATE PRESUPUESTO SET comentario = '$comentario' where ID_PRESUPUESTO=$id_presupuesto";

    if ($conn->query($update_comentario) === TRUE) {
        header('Location: ../../../presupuesto/ver_presupuesto.php?ok=updateComentario&id=' . $id_presupuesto);
    } else {
        echo $sql . "<br><br><br>" . $conn->error;
        header('Location: ../../../presupuesto/ver_presupuesto.php?error=updateComentario&id=' . $id_presupuesto);
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