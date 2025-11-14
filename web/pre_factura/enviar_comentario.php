
<?php
include('../assets/php/db.php');

    $conn = connect();
    $sql = "UPDATE PRE_FACTURA
  SET comentario = '" . $_POST['comentario'] . "'
  WHERE ID_PRE_FACTURA = '" . $_POST['ID_PRE_FACTURA'] . "'";
    
    if ($conn->query($sql) === TRUE){
    	echo $_POST['comentario'];
    }else{
    	echo "error al subir comentario";
    }
    
    close($conn);

?>