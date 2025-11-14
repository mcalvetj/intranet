<!doctype html>

<?php
session_start();
include('assets/php/db.php');
include('./assets/php/selects.php');
include('assets/php/functions.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('assets/librerias/librerias_globales.html'); ?>
    <!--FORMULARIO - CSS-->
    <link href="./assets/css/insert.css" rel="stylesheet"/>

</head>

<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <!--MENU Y LOGO-->
            <?php
            include('assets/html/logo/logo.html');
            include('assets/html/menu/menu_principal.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_entrada_stock").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_entrada_stock {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_entrada_stock1 {
                        margin-left: 2%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--TITULO DE LA PÃGINA-->
                    <a class="navbar-brand">Entrada de artículo</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('assets/html/menu/user_logout.html'); ?>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="container">
                                <?php
                                $codigo_de_barras = $_SESSION['s_codigo_de_barras'];
                                $codigo_de_barras= str_replace("'","-","$codigo_de_barras");

                                $data = get_articulo_with_codigo_de_barras($codigo_de_barras);
                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    $row = $data->fetch_assoc();

                                }
                                ?>
                                <form id="contact" action="./assets/php/post/post_articulos.php" method="post">
                                    <h3>Añadir Artículo</h3>
                                    <h4>Rellene el formulario para añadir el artículo al stock</h4>
                                    <fieldset>
                                        &nbsp;Nombre: <input placeholder="Nombre*" class="nombre" name="nombre" type="text" value="<?php echo $row['nombre']?>"
                                                             required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Descripción: <input placeholder="Descripción" name="descripcion"
                                                                  type="text" value="<?php echo $row['descripcion']?>">
                                    </fieldset>

                                    <fieldset>&nbsp;Selecciona el NIF del mayorista:
                                        <?php $data2 = select_all_mayorista(); ?>
                                        <select name="select_box_nif_mayorista" class="select_box">
                                            <option value="<?php echo $row['NIF_mayorista'] ?>" selected><?php echo $row['NIF_mayorista'] ?></option>
                                            <?php
                                            if ($data2->num_rows > 0) {
                                                // output data of each row
                                                while ($row2 = $data->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row2['NIF_MAYORISTA'] ?>"><?php echo "$row2[nombre_empresa] - $row2[NIF_MAYORISTA]"; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Código producto del mayorista: <input
                                            placeholder="Código producto del mayorista" name="codigo_producto_mayorista" value="<?php echo $row['codigo_producto_mayorista']?>"
                                            type="text">
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Números de series
                                        <center><p href="#" id="mascampos" style="background: #ea8f43; border: none;  color: #FFF; margin: 0 0 5px; padding: 10px; font-size: 15px; cursor: pointer;"><span class="glyphicon glyphicon-plus"></span></p></center>

                                    </fieldset>
                                    <input type="hidden" id="totalNumSeries" value="0" name="totalNumSeries">
                                    <fieldset>
                                        &nbsp;Precio: </br><input placeholder="Precio*" name="precio" type="number" step="any" value="<?php echo $row['precio']?>"
                                                                  required>
                                    </fieldset>
                                    <fieldset id="fieldsetCantidad">
                                        &nbsp;Cantidad: </br><input placeholder="Cantidad*" name="cantidad" id="cantidad"
                                                                    type="number" value=""
                                                                    required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Número de factura: <input placeholder="Número de factura*" value="<?php echo $row['numero_factura']?>"
                                                                        name="numero_factura" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Ubicación: <input placeholder="Ubicación" name="ubicacion" value="<?php echo $row['ubicacion']?>" type="text">
                                    </fieldset>
                                    <fieldset>&nbsp;Selecciona el NIF del cliente(En el caso que sea necesario):
                                        <?php $data3 = select_all_cliente(); ?>
                                        <select name="select_box_nif_empresa" class="select_box">
                                            <option value="<?php echo $row['NIF_cliente_articulo']?>"><?php echo $row['NIF_cliente_articulo']?></option>
                                            <?php
                                            if ($data3->num_rows > 0) {
                                                // output data of each row
                                                while ($row3 = $data3->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row3['NIF_EMPRESA'] ?>"><?php echo "$row3[nombre_completo] - $row3[NIF_EMPRESA]"; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <input type="hidden" name="codigo_de_barras" value="<?php echo $codigo_de_barras?>">
                                    </fieldset>
                                    <fieldset>
                                        <button name="submit" type="submit" id="contact-submit"
                                                data-submit="...Sending">Submit
                                        </button>
                                    </fieldset>

                                </form>
                            </div>
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