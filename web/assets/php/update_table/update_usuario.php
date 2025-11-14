
<?php
include('../db.php');

                                            
if(!empty($_POST['value'])) {
    $conn = connect();
    $sql = "UPDATE USUARIO
      SET ".$_POST['name']." = '".$_POST['value']."'
      WHERE ID_USUARIO = '".$_POST['pk']."'";
    $result = $conn->query($sql);
    close($conn);
    return $data;
  } else {
    header('HTTP 400 Bad Request', true, 400);
    echo "Aquest camp és obligatori!";
  }


?>