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
    $id_articulo = $_GET['id'];
    $codigo_de_barras= codigo_de_barras_articulo($id_articulo);
    $cantidad= cantidad_articulo($id_articulo);
   
    $conn = connect();

    $sql = "DELETE FROM ARTICULO WHERE ID_ARTICULO = '" . $id_articulo . "'";

    if ($conn->query($sql) === TRUE) {


        $data = select_cantidad_stock($codigo_de_barras);

        $cantidad_total = $data - $cantidad;

        if ($cantidad_total <= 0) {
            $sql2 = "DELETE FROM STOCK WHERE CODIGO_DE_BARRAS = '$codigo_de_barras'";
        } else {
            $sql2 = "UPDATE STOCK SET cantidad_total = $cantidad_total  WHERE  CODIGO_DE_BARRAS = '$codigo_de_barras'";
        }

        if ($conn->query($sql2) === TRUE) {
            echo "Stock modificado";
        } else {
            //echo "Error en Stock: <br><br>" . $sql . "<br><br><br>" . $conn->error;
            header('Location: ../../../buscador/buscador_articulos.php?error=eliminarStock');
        }

        header('Location: ../../../buscador/buscador_articulos.php?ok=eliminarArticulo');
    } else {
        header('Location: ../../../buscador/buscador_articulos.php?error=eliminarArticulo');
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