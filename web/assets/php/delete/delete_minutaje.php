<!doctype html>

<?php
session_start();
include('../db.php');
include('../selects.php');
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
    $id_minutaje = $_GET['id'];
    $conn = connect();
    $sql = "DELETE FROM MINUTAJE WHERE ID_MINUTAJE = '" . $id_minutaje . "'";


    if ($conn->query($sql) === TRUE) {
        header('Location: ../../../buscador/buscador_minutaje.php?ok=eliminarMinutaje');
    } else {
        header('Location: ../../../buscador/buscador_minutaje.php?error=eliminarMinutaje');
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