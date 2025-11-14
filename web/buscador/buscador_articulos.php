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
    <?php
    if ($_SESSION["user_rol"] <= 1) {
        //<!--COLUMNAS QUE PUEDEN SER MODIFICADAS-->
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_articulo.js\"></script>";
    }
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?>
    <script type="text/javascript" src="../assets/js/selected_row.js"></script>
    <script type="text/javascript" src="../assets/js/functions.js"></script>




</head>
<body>

<?php
if(!isset($_GET['ok'])){
    $_GET['ok']="NULL";
  }
  if(!isset($_GET['warning'])){
    $_GET['warning']="NULL";
  }
  if(!isset($_GET['error'])){
    $_GET['error']="NULL";
  }
if($_GET['ok']=='eliminarArticulo'){
    ?>
    <script>
        swal({
                title: "Eliminación de articulo completada!",
                text: "",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'buscador_articulos.php';
            });
    </script>
    <?php
}
if($_GET['error']=='eliminarArticulo'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El articulo no se ha podido eliminar",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'buscador_articulos.php';
            });
    </script>
    <?php
}
if($_GET['error']=='eliminarStock'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El articulo no se ha podido eliminar del stock",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'buscador_articulos.php';
            });
    </script>
    <?php
}
?>

<?php
if($_GET['ok']=='preFacturaArticulo'){
    ?>
    <script>
        swal({
                title: "Ok",
                text: "El articulo se ha podido prefacturar",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'buscador_articulos.php';
            });
    </script>
    <?php
}
?>
<?php
if($_GET['error']=='preFacturaArticulo'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El articulo no se ha podido prefacturar",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'buscador_articulos.php';
            });
    </script>
    <?php
}
if($_GET['error']=='serAdmin'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "Tienes que ser admin y estar en local",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'buscador_articulos.php';
            });
    </script>
    <?php
}
?>

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
                    document.getElementById("menu_articulos").className = "active";
            });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_articulos {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_articulos1 {
                        margin-left: 10%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar2 navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <!--TITULO DE LA PÃƒÂƒÃ‚ÂGINA-->
                <a class="navbar-brand">Buscador artículos</a>
            </div>
            <div class="collapse navbar-collapse">
                <!--USER & LOGOUT-->
                <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
            </div>
        </div>
        </nav>

        <!--ZONA DE CONTENIDO DE ESTA PAGINA, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->

        <div class="content2">
            <!--passar los datos a pre_factura_articulos.php-->
                <form method="POST" id="send_articulos" action="../pre_factura/seleccion_pre_factura.php">
                    <input type="hidden" id="id_string" name="id_string" value="">
                    <input style="display:none" type="submit" value="submit" id="buttonId"/>
                </form>
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <div>
                            <table id="buscador_articulo" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="background-color: #F26842; width: 3px;">Borrar</th>
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
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $data = select_all_articulo();

                                if ($data->num_rows > 0) {
                                    $i = 0;
                                    // output data of each row
                                    while ($row = $data->fetch_assoc()) {
                                        $pk = $row['ID_ARTICULO'];
                                        $i++;
                                        $div = "div" . $i;
                                        ?>
                                        <tr id="<?php echo "$div"; ?>" value="<?php echo "$pk"; ?>">
                                            <td><label style="width: 100%">
                                                    <center>
                                                        <button style="width: 100%" class="btn btn-danger"
                                                                onclick="borrar_articulo(<?php echo "$pk"; ?>)"><span
                                                                class="glyphicon glyphicon-trash "></span></button>
                                                    </center>
                                                </label></td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="nombre"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="descripcion"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['descripcion'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a
                                                        data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['codigo_de_barras'] ?> </a</label>
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
                                                        if ($row['NIF_cliente_articulo'] == '') {
                                                            echo $row['NIF_cliente_articulo'];

                                                        } else {
                                                            $nif_cliente = $row['NIF_cliente_articulo'];
                                                            $nombreCliente = select_nombre_cliente($nif_cliente);
                                                            echo $nombreCliente;
                                                        }
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