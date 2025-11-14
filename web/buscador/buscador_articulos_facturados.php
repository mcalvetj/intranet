<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('../assets/librerias/librerias_globales_buscador.html'); ?>
    <!--EDITOR DE TABLAS-->

    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <!--MENU Y LOGO-->
            <?php
            include('../assets/html/logo/logo_buscador.html');
            include('../assets/html/menu/menu_buscador.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_articulos_facturados").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_articulos_facturados {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_articulos_facturados1 {
                        margin-left: 22%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--TITULO DE LA PÁGINA-->
                    <a class="navbar-brand">Artículos facturados</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <div>
                            <table id="buscador_articulos_facturados" class="table table-striped table-bordered">
                                <thead>


                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Código de barras</th>
                                    <th>Mayorista</th>
                                    <th>Código producto del mayorista</th>
                                    <th>Número de serie</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Número de factura</th>
                                    <th>Ubicación</th>
                                    <th>Fecha de alta</th>
                                    <th>Cliente</th>
                                    <th>Factura</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $data = select_all_articulo_facturado();

                                if ($data->num_rows > 0) {
                                    $i = 0;
                                    // output data of each row
                                    while ($row = $data->fetch_assoc()) {
                                        $pk = $row['ID_ARTICULO'];
                                        $i++;
                                        $div = "div" . $i;
                                        ?>
                                        <tr id="<?php echo "$div"; ?>" value="<?php echo "$pk"; ?>">
                                            <td><label style="margin-top: 11px;"><a href="#" class="nombre"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="descripcion"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['descripcion'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a
                                                        data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['codigo_de_barras'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;">
                                                    <a href="#" class="NIF_mayorista" data-pk=<?php echo "\"$pk\""; ?>>
                                                        <?php
                                                        $nif_mayorista = $row['NIF_mayorista'];
                                                        $nombreMayorista = select_nombre_mayorista($nif_mayorista);
                                                        echo $nombreMayorista;
                                                        ?>
                                                    </a></label></td>
                                            <td><label style="margin-top: 11px;"><a href="#"
                                                                                    class="codigo_producto_mayorista"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['codigo_producto_mayorista'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="numero_de_serie"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['numero_de_serie'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="precio"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['precio'] ?> &euro;
                                                    </a></label></td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="cantidad"><?php echo $row['cantidad'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="numero_factura"><?php echo $row['numero_factura'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="ubicacion"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ubicacion'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="fecha_de_alta"><?php echo $row['fecha_de_alta'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;">
                                                    <a href="#" class="NIF_cliente_articulo"
                                                       data-pk=<?php echo "\"$pk\""; ?>>
                                                        <?php
                                                        if ($row['cliente_facturado'] == '') {
                                                            echo $row['cliente_facturado'];

                                                        } else {
                                                            $nif_cliente = $row['cliente_facturado'];
                                                            $nombreCliente = select_nombre_cliente($nif_cliente);
                                                            echo $nombreCliente;
                                                        }
                                                        ?>
                                                    </a></label></td>
                                                <td><label style="margin-top: 11px;">
                                                <a href="#">
                                                    <?php
                                                    $ID_articulo_facturado = $row['ID_ARTICULO_FACTURADO'];
                                                    $ID_factura = select_ID_factura($ID_articulo_facturado);
                                                    echo $ID_factura;
                                                    ?>
                                                </a></label></td>
                                        </tr>
                                        

                                        <?php

                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>


                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


</body>
</html>

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>