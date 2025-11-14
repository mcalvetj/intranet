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
    //DEFINIR VARIABLES
    $contador = 0;
    $cliente = $_POST['cliente'];
    $nombre_pre_factura = $_POST['nombre_pre_factura'];
    $nombre_pre_factura_array = explode('-', $nombre_pre_factura);
    $id_pre_factura=$nombre_pre_factura_array[0];
    $id_string = $_POST['submit'];
    $id_array = explode(',', $id_string);


    //Passar el minutaje a minutaje facturado
    for ($i = 1; $i <= count($id_array) - 1; $i++) {
        $data = get_minutaje_pre_factura($id_array[$i]);
        if ($data->num_rows > 0) {
            // output data of each row
            $row = $data->fetch_assoc();
            $sql_NIF_cliente = $row['NIF_cliente'];
            $sql_NIF_cliente = "\"$sql_NIF_cliente\"";

            //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
            $conn = connect();
            
            $sql = "INSERT INTO MINUTAJE_FACTURADO (ID_MINUTAJE, fecha, hora_entrada, hora_salida, ID_SERVICIO, ID_USUARIO, ID_SEDE, NIF_cliente, comentario)
					VALUES (" . $row['ID_MINUTAJE'] . ",'" . $row['fecha'] . "','" . $row['hora_entrada'] . "','" . $row['hora_salida'] . "'," . $row['ID_servicio'] . "," . $row['ID_usuario'] . "," . $row['ID_sede'] . ", $sql_NIF_cliente, '".$row['comentario']."')";

            if ($conn->query($sql) === TRUE) {
            } else {
                $contador++;
                echo "Error: <br><br>" . $sql . "<br><br><br>" . $conn->error;
            }

            //BORRAMOS EL MINUTAJE DE LA TABLA MINUTAJE
            $delete_tabla_minutaje = "DELETE FROM MINUTAJE WHERE ID_MINUTAJE ='" . $row['ID_MINUTAJE'] . "'";
            if ($conn->query($delete_tabla_minutaje) === TRUE) {
            } else {
                $contador++;
                echo "Error: <br><br>" . $sql . "<br><br><br>" . $conn->error;
            }

            //AÑADIMOS EL MINUTAJE EN LA TABLA TRONCO_PRE_FACTURA_MINUTAJE
            $precio_servicio= get_precio_servicio($row['ID_servicio']);

            //calculamos las horas
            $dteStart = new DateTime($row['hora_entrada']);
            $dteEnd   = new DateTime($row['hora_salida']);
            $dteDiff  = $dteStart->diff($dteEnd);
            //minutaje total
            $hora= $dteDiff->format("%H%I%S");

            //calcular precio total
            $horas =  $dteDiff->format("%H");
            $horas= $horas*60;
            $min =$dteDiff->format("%I");
            $precio_total= ((($min+$horas)*$precio_servicio)/60);
            $last_id_minutaje_facturado=last_id_minutaje_facturado();


            $insert_tronco_pre_factura_minutaje = "INSERT INTO TRONCO_PRE_FACTURA_MINUTAJE(ID_pre_factura, ID_minutaje, ID_servicio,fecha, horas, precio_servicio, precio_total, id_minutaje_facturado, comentario)
			VALUES (" . $id_pre_factura . "," . $row['ID_MINUTAJE'] . ",".$row['ID_servicio'].",'".$row['fecha']."',$hora, $precio_servicio, $precio_total, $last_id_minutaje_facturado,'".$row['comentario']."')";

            if($conn->query($insert_tronco_pre_factura_minutaje) === TRUE){

            }else {
                $contador++;
                echo "Error: <br><br>" . $insert_tronco_pre_factura_minutaje . "<br><br><br>" . $conn->error;
            }


            /* $sql="INSERT INTO tabla1 SELECT *FROM tabla2 WHERE condicion";*/
        } else {
            echo "0 results";
        }
    }


    if ($contador == 0) {
        header('Location: ../../../buscador/buscador_minutaje.php?ok=preFacturaMinutaje');
    } else {
        header('Location: ../../../buscador/buscador_minutaje.php?error=preFacturaMinutaje');
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
