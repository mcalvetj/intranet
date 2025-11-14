<?php
session_start();
include('db.php');
include('selects.php');
if ($_SESSION["login_done"] == true){

	$idPreFactura = $_POST["id_prefactura"];
    $nombrePrefactura = $_POST["nombre_prefactura"];

	$editar_nombre_prefactura = "UPDATE PRE_FACTURA SET nombre = '".$nombrePrefactura."' WHERE ID_PRE_FACTURA = ".$idPreFactura.";";
        $conn = connect();

        if ($conn->query($editar_nombre_prefactura) == TRUE){
            header('Location: ../../pre_factura/ver_pre_factura.php?ok=editarNombrePrefactura&id='.$idPreFactura);
        }else{
            header('Location: ../../pre_factura/ver_pre_factura.php?error=editarNombrePrefactura&id='.$idPreFactura);
        }

} else {
    echo "false";
    header("location:../../index.php");
}
?>