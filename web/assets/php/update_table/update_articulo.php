<?php
include('../db.php');


if (($_POST['name'] == "NIF_cliente_articulo") and ($_POST['value']=="")) {
    $conn = connect();
    $sql = "UPDATE ARTICULO
      SET " . $_POST['name'] . " = null
      WHERE ID_ARTICULO = '" . $_POST['pk'] . "'";
    $result = $conn->query($sql);
    close($conn);
}elseif (($_POST['name'] == ("descripcion"  || "codigo_producto_mayorista" || "numero_de_serie" || "ubicacion"))and($_POST['value']=="")) {
    $conn = connect();
    $sql = "UPDATE ARTICULO
      SET " . $_POST['name'] . " = null
      WHERE ID_ARTICULO = '" . $_POST['pk'] . "'";
    $result = $conn->query($sql);
    close($conn);
}
elseif ($_POST['name'] == ("descripcion"  || "codigo_producto_mayorista" || "numero_de_serie" || "ubicacion")) {
    $conn = connect();
    $sql = "UPDATE ARTICULO
      SET " . $_POST['name'] . " = '" . $_POST['value'] . "'
      WHERE ID_ARTICULO = '" . $_POST['pk'] . "'";
    $result = $conn->query($sql);
    close($conn);
}


else {

    if (!empty($_POST['value'])) {
        $conn = connect();
        $sql = "UPDATE ARTICULO
      SET " . $_POST['name'] . " = '" . $_POST['value'] . "'
      WHERE ID_ARTICULO = '" . $_POST['pk'] . "'";
        $result = $conn->query($sql);
        close($conn);

    } else {
        header('HTTP 400 Bad Request', true, 400);
        echo "Aquest camp és obligatori!";
    }

}
?>