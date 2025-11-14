<!doctype html>
<!--VERIFICAR QUE LOGIN SE HA REALIZADO-->
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
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_cliente.js\"></script>";
    }
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?><!--LIBRERIA - INSERT-->
    <?php include('../assets/librerias/librerias_insert.html'); ?>
    <!--Funciones javascript-->
    <script src="../assets/js/functions.js"></script>

</head>

<body>

<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <!--MENU Y LOGO-->
            <?php
            include('../assets/html/logo/logo_pre_factura.html');
            include('../assets/html/menu/menu_pre_factura.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_factura").className = "active";
                });</script>

        </div>
    </div>
    <!--BARRA SUPERIOR, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand">Rectificar factura</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
                </div>
            </div>
        </nav>
        <!--ZONA DE CONTENIDO DE ESTA PAGINA, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="card">

                                <style>
                                    .visor_pdf_rectificar {
                                        width: 100%;
                                        height: 800px;
                                    }

                                    ,
                                    .halfwidth {
                                        width: 50%;
                                    }

                                </style>
                                <?php
                                $id_factura = $_POST['id_factura'];
                                $fechaFactura = select_fecha_factura($id_factura);
                                $anyo=substr( $fechaFactura, 0, 4 );
                                $mes=substr( $fechaFactura, 5, 2 );

                                $factura_pdf=$anyo.'/'.$mes.'/'.$id_factura;
                                ?>
                                <div class="col-md-12">

                                    <form id="contact" action="opciones_factura_rectificativa.php" method="post">

                                        <h3><b>Seguro que desea rectificar la factura</b> <?php echo $id_factura; ?>?</h3>

                                        <div class="form-group">
                                            <button name="id_factura" class="halfwidth" type="submit" value="<?php echo $id_factura; ?>">
                                                SI, rectificar factura <?php echo $id_factura; ?>
                                            </button>
                                            <button class="half_width" type="submit"
                                                    onclick='this.form.action="seleccionar_rectificar_factura.php"'>
                                               NO, cambiar numero de factura.
                                            </button>


                                        </div>

                                    </form>


                                </div>
                                <br>
                                <iframe src="http://docs.google.com/gview?url=http://ctw.es/test/web_CTW/web/factura_pdf/<?php echo $factura_pdf; ?>.pdf&embedded=true"
                                        class="visor_pdf_rectificar" frameborder="0"></iframe>
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
<!--SI NO HA PASSADO POR EL LOGIN LO MANDAMOS PARA QUE SE AUTENTIFIQUE-->
<?php
} else {
    header("location:../index.php");
}
?>