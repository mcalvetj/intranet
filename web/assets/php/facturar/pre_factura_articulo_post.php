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
    $cantidad_seleccionada = array("cantidad");
    $cantidad_total = array("cantidad");
    // Buscar cantidad que se desea facturar de articulos seleccionados
    for ($i = 1; $i <= count($id_array) - 1; $i++) {
        $num = "cantidad_" . $i;
        array_push($cantidad_seleccionada, $_POST["$num"]);
    }
    // Buscar cantidad total de articulos seleccionados
    for ($i = 1; $i <= count($id_array) - 1; $i++) {
        $id = $id_array[$i];

        $cantidad_total_valor = cantidad_articulo($id);
        array_push($cantidad_total, $cantidad_total_valor);
    }

    //Passar el articulo a articulo_articulo facturado
    for ($i = 1;
         $i <= count($id_array) - 1;
         $i++) {
        $data = get_articulo_pre_factura($id_array[$i]);
        if ($data->num_rows > 0) {
            // output data of each row
            $row = $data->fetch_assoc();

            //filtrado de nulls
            $sql_descripcion = $row['descripcion'];
            $sql_descripcion = "\"$sql_descripcion\"";

            $sql_NIF_mayorista = $row['NIF_mayorista'];
            $sql_NIF_mayorista = "\"$sql_NIF_mayorista\"";

            $sql_codigo_producto_mayorista = $row['codigo_producto_mayorista'];
            $sql_codigo_producto_mayorista = "\"$sql_codigo_producto_mayorista\"";

            $sql_numero_de_serie = $row['numero_de_serie'];
            $sql_numero_de_serie = "\"$sql_numero_de_serie\"";

            $sql_ubicacion = $row['ubicacion'];
            $sql_ubicacion = "\"$sql_ubicacion\"";


            if ($sql_codigo_producto_mayorista == "\"\"") {
                $sql_codigo_producto_mayorista = 'null';
            }
            if ($sql_descripcion == "\"\"") {
                $sql_descripcion = 'null';
            }
            if ($sql_NIF_mayorista == "\"\"") {
                $sql_NIF_mayorista = 'null';
            }
            if ($sql_numero_de_serie == "\"\"") {
                $sql_numero_de_serie = 'null';
            }
            if ($sql_ubicacion == "\"\"") {
                $sql_ubicacion = 'null';
            }


            //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
            $conn = connect();
            $sql = "INSERT INTO ARTICULO_FACTURADO (ID_ARTICULO, nombre, descripcion, NIF_mayorista, codigo_de_barras, codigo_producto_mayorista, 	numero_de_serie, precio, cantidad, 	numero_factura, ubicacion, fecha_de_alta, cliente_facturado)
					VALUES (" . $row['ID_ARTICULO'] . ",'" . $row['nombre'] . "',$sql_descripcion,$sql_NIF_mayorista,'" . $row['codigo_de_barras'] . "',$sql_codigo_producto_mayorista, $sql_numero_de_serie ," . $row['precio'] . ",$cantidad_seleccionada[$i],'" . $row['numero_factura'] . "',$sql_ubicacion,'" . $row['fecha_de_alta'] . "','$cliente')";

            if ($conn->query($sql) === TRUE) {

                //comparar la contidad que queda de este mismo articulo
                $cantidad_restante_articulo = $cantidad_total[$i]-$cantidad_seleccionada[$i];
                if($cantidad_restante_articulo==0){//si la cantidad restante es 0 lo eliminaremos de la tabla articulos

                    $delete_tabla_articulo = "DELETE FROM ARTICULO WHERE ID_ARTICULO = ". $row['ID_ARTICULO'];
                    $conn->query($delete_tabla_articulo);
                }else{//Si quedan unidades acutalizaremos esa cantidad
                    $update_tabla_articulo = "UPDATE ARTICULO SET cantidad = $cantidad_restante_articulo  WHERE  ID_ARTICULO = ". $row['ID_ARTICULO'];
                    $conn->query($update_tabla_articulo);
                }

                //comparar la contidad que queda del stock
                $cantidad_restante_stock = select_cantidad_stock($row['codigo_de_barras']);
                $cantidad_restante_stock = $cantidad_restante_stock-$cantidad_seleccionada[$i];
                $codigo_de_barras= $row['codigo_de_barras'];
                if($cantidad_restante_stock==0){//si la cantidad restante de stock es 0 lo eliminaremos de la tabla stock

                    $delete_tabla_stock = "DELETE FROM STOCK WHERE CODIGO_DE_BARRAS ='$codigo_de_barras'";
                    $conn->query($delete_tabla_stock);
                }else{//Si quedan unidades acutalizaremos esa cantidad de la tabla stock
                    $update_tabla_stock = "UPDATE STOCK SET cantidad_total = $cantidad_restante_stock  WHERE  CODIGO_DE_BARRAS = '$codigo_de_barras'";                 $conn->query($update_tabla_stock);
                }

            } else {
                $contador++; echo "1";
                echo "Error: <br><br>" . $sql . "<br><br><br>" . $conn->error;
            }

            //a�adimos los articulos en la tabla tronco_pre_factura_articulos
            $suma_precio = $row['precio'] * $cantidad_seleccionada[$i];
            $last_id_articulo_facturado=last_id_articulo_facturado();
            $insert_tronco_pre_factura_articulo = "INSERT INTO TRONCO_PRE_FACTURA_ARTICULO(ID_pre_factura, ID_articulo, numero_de_serie, cantidad, precio, precio_total, id_articulo_facturado)
			VALUES (" . $id_pre_factura . "," . $row['ID_ARTICULO'] . ",$sql_numero_de_serie,$cantidad_seleccionada[$i],'" . $row['precio'] . "',$suma_precio, $last_id_articulo_facturado )";

            if($conn->query($insert_tronco_pre_factura_articulo) === TRUE){

            }else {
                $contador++; echo "2";
                echo "Error: <br><br>" . $sql . "<br><br><br>" . $conn->error;
            }

        } else {
            echo "0 results";
        }
    }


    if ($contador == 0) {
        header('Location: ../../../buscador/buscador_articulos.php?ok=preFacturaArticulo');
    } else {
        header('Location: ../../../buscador/buscador_articulos.php?error=preFacturaArticulo');
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
