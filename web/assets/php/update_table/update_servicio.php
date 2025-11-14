
<?php
include('../db.php');
if ($_POST['name'] == ("NIF_empresa" || "descripcion")) {
    $conn = connect();
    $sql = "UPDATE SERVICIO
      SET " . $_POST['name'] . " = '" . $_POST['value'] . "'
      WHERE ID_SERVICIO = '" . $_POST['pk'] . "'";
    $result = $conn->query($sql);
    close($conn);

}else {

    if (!empty($_POST['value'])) {
        $conn = connect();
        $sql = "UPDATE SERVICIO
      SET " . $_POST['name'] . " = '" . $_POST['value'] . "'
      WHERE ID_SERVICIO = '" . $_POST['pk'] . "'";
        $result = $conn->query($sql);
        close($conn);
    } else {
        header('HTTP 400 Bad Request', true, 400);
        echo "Aquest camp és obligatori!";
    }
}
?>