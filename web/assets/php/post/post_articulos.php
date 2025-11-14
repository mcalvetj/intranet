<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet" />
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet" />

</head>
<body onload="itv = setInterval(prog, 10)">

<div >

                            
                        <?php
                        #Declaramos las variables del formulario
                        $cont=0;
                        $suma_cantidad=0;
                        $nombre = $_POST['nombre'];
                        $descripcion = $_POST['descripcion'];
                        $codigo_de_barras = $_POST['codigo_de_barras'];
                        $codigo_de_barras_update = $codigo_de_barras;
                        $nif_mayorista = $_POST['select_box_nif_mayorista'];
                        $codigo_producto_mayorista = $_POST['codigo_producto_mayorista'];
                        $numero_de_serie = $_POST['numero_de_serie'];
                        $precio = $_POST['precio'];
                        $cantidad = $_POST['cantidad'];
                        $numero_factura = $_POST['numero_factura'];
                        $ubicacion = $_POST['ubicacion'];
                        $nif_empresa_articulo = $_POST['select_box_nif_empresa'];

                        //Añadimos comillas a los varchars
                        $nombre="\"$nombre\"";
                        $precio="\"$precio\"";
                        $descripcion="\"$descripcion\"";
                        $codigo_de_barras="\"$codigo_de_barras\"";
                        $nif_mayorista="\"$nif_mayorista\"";
                        $codigo_producto_mayorista="\"$codigo_producto_mayorista\"";
                        $numero_de_serie="\"$numero_de_serie\"";
                        $numero_de_serie= str_replace("'","-","$numero_de_serie");

                        $numero_factura="\"$numero_factura\"";
                        $ubicacion="\"$ubicacion\"";
                        $nif_empresa_articulo="\"$nif_empresa_articulo\"";

                        //Si hay algun campo opcional no rellenado lo transforma en null
                        if($descripcion == "\"\""){
                            $descripcion = 'null';
                        }if($nif_mayorista == "\"\""){
                            $nif_mayorista = 'null';
                        }if($codigo_producto_mayorista == "\"\""){
                            $codigo_producto_mayorista = 'null';
                        }if($ubicacion == "\"\""){
                            $ubicacion = 'null';
                        }if($numero_de_serie == "\"\""){
                            $numero_de_serie = 'null';
                        }if($nif_empresa_articulo == "\"\""){
                            $nif_empresa_articulo = 'null';
                        }

                        $totalNumSeries = $_POST['totalNumSeries'];

                        //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
                        $conn = connect();

                        if($totalNumSeries==0){
                            echo "error";
                            $sql = "INSERT INTO ARTICULO (nombre, descripcion, codigo_de_barras, NIF_mayorista, codigo_producto_mayorista, numero_de_serie, precio, cantidad, numero_factura, ubicacion, NIF_cliente_articulo)
                            VALUES ($nombre, $descripcion, $codigo_de_barras, $nif_mayorista, $codigo_producto_mayorista, null, $precio, $cantidad, $numero_factura, $ubicacion, $nif_empresa_articulo)";

                            if ($conn->query($sql) === TRUE) {

                                $data = select_all_stock();

                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while($row = $data->fetch_assoc()) {

                                        if($row['CODIGO_DE_BARRAS']==$codigo_de_barras_update){

                                            $cont=$cont+1;
                                            $suma_cantidad= $row['cantidad_total'] + $cantidad;
                                        }



                                    }
                                }

                                if($cont==0){

                                    $sql2 = "INSERT INTO STOCK (CODIGO_DE_BARRAS, cantidad_total)
                                    VALUES ($codigo_de_barras, $cantidad)";

                                }else{

                                    $sql2 = "UPDATE STOCK SET cantidad_total = $suma_cantidad  WHERE  CODIGO_DE_BARRAS = $codigo_de_barras";

                                }
                                if ($conn->query($sql2) === TRUE) {

                                }else{
                                    echo "Error en Stock: <br><br>" . $sql . "<br><br><br>" . $conn->error;

                                }

                                header('Location: ../../../entrada_stock.php?ok=altaArticulo');
                            } else {
                                //header('Location: ../../../entrada_stock.php?error=altaArticulo');
                                echo  $sql . "<br><br><br>" . $conn->error;
                            }

                        }else{
                            for($i=1;$i<$totalNumSeries+1;$i++){
                                $texto="numero_de_serie".$i;
                                $numero_de_serie = $_POST[$texto];
                                $numero_de_serie2="\"$numero_de_serie\"";
                                if($numero_de_serie!=null) {
                                    $sql = "INSERT INTO ARTICULO (nombre, descripcion, codigo_de_barras, NIF_mayorista, codigo_producto_mayorista, numero_de_serie, precio, cantidad, numero_factura, ubicacion, NIF_cliente_articulo)
                                  VALUES ($nombre, $descripcion, $codigo_de_barras, $nif_mayorista, $codigo_producto_mayorista, $numero_de_serie2, $precio, $cantidad, $numero_factura, $ubicacion, $nif_empresa_articulo)";

                                    if ($conn->query($sql) === TRUE) {

                                        $data = select_all_stock();

                                        if ($data->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $data->fetch_assoc()) {

                                                if ($row['CODIGO_DE_BARRAS'] == $codigo_de_barras_update) {

                                                    $cont = $cont + 1;
                                                    $suma_cantidad = $row['cantidad_total'] + $cantidad;
                                                }


                                            }
                                        }

                                        if ($cont == 0) {

                                            $sql2 = "INSERT INTO STOCK (CODIGO_DE_BARRAS, cantidad_total)
                                    VALUES ($codigo_de_barras, $cantidad)";

                                        } else {

                                            $sql2 = "UPDATE STOCK SET cantidad_total = $suma_cantidad  WHERE  CODIGO_DE_BARRAS = $codigo_de_barras";

                                        }
                                        if ($conn->query($sql2) === TRUE) {

                                        } else {
                                            //echo "Error en Stock: <br><br>" . $sql . "<br><br><br>" . $conn->error;
                                            header('Location: ../../../entrada_stock.php?error=altaStock');
                                        }

                                        header('Location: ../../../entrada_stock.php?ok=altaArticulo');
                                    } else {
                                        //header('Location: ../../../entrada_stock.php?error=altaArticulo');
                                        echo $sql . "<br><br><br>" . $conn->error;
                                    }

                                }
                            }


                        }


                        /*
                        $sql = "INSERT INTO ARTICULO (nombre, descripcion, codigo_de_barras, NIF_mayorista, codigo_producto_mayorista, numero_de_serie, precio, cantidad, numero_factura, ubicacion, NIF_cliente_articulo)
                        VALUES ($nombre, $descripcion, $codigo_de_barras, $nif_mayorista, $codigo_producto_mayorista, $numero_de_serie, $precio, $cantidad, $numero_factura, $ubicacion, $nif_empresa_articulo)";



                        if ($conn->query($sql) === TRUE) {

                            $data = select_all_stock();

                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while($row = $data->fetch_assoc()) {
                                        
                                        if($row['CODIGO_DE_BARRAS']==$codigo_de_barras_update){
                                            
                                            $cont=$cont+1;
                                            $suma_cantidad= $row['cantidad_total'] + $cantidad;
                                        }
                              
                                    
                             
                                   }       
                                }

                                if($cont==0){

                                    $sql2 = "INSERT INTO STOCK (CODIGO_DE_BARRAS, cantidad_total)
                                    VALUES ($codigo_de_barras, $cantidad)";

                                }else{

                                    $sql2 = "UPDATE STOCK SET cantidad_total = $suma_cantidad  WHERE  CODIGO_DE_BARRAS = $codigo_de_barras";

                                }
                                    if ($conn->query($sql2) === TRUE) {

                                    }else{
                                    echo "Error en Stock: <br><br>" . $sql . "<br><br><br>" . $conn->error;

                                    }

                            header('Location: ../../../entrada_stock.php?ok=altaArticulo');
                        } else {
                            //header('Location: ../../../entrada_stock.php?error=altaArticulo');
                            echo  $sql . "<br><br><br>" . $conn->error;
                        }
*/
                        close($conn); 
                         
                        ?>

</div>
</body>
</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>