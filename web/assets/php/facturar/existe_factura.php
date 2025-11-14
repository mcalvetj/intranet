<?php
include('../db.php');

$id_factura = $_POST['id_factura'];
$conn = connect();
$sql = "SELECT * from FACTURA WHERE ID_FACTURA='".$id_factura."';";
$data = $conn->query($sql);
$resultado=$data->num_rows;
if ($resultado=='1') {
    echo "true";

}else{
    echo "false";
}

close($conn);


?>

