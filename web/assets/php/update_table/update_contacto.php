<?php
include('../db.php');
if ($_POST['name'] == ("extension")) {

    $conn = connect();
    $sql = "UPDATE CONTACTO
      SET " . $_POST['name'] . " = '" . $_POST['value'] . "'
      WHERE ID_CONTACTO = '" . $_POST['pk'] . "'";
    $result = $conn->query($sql);
    close($conn);

} else {
    if (!empty($_POST['value'])) {
        $conn = connect();
        $sql = "UPDATE CONTACTO
      SET " . $_POST['name'] . " = '" . $_POST['value'] . "'
      WHERE ID_CONTACTO = '" . $_POST['pk'] . "'";
        $result = $conn->query($sql);
        close($conn);

    } else {
        header('HTTP 400 Bad Request', true, 400);
        echo "Aquest camp és obligatori!";
    }
}

?>