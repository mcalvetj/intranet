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
if($_GET['error']=='preFacturaServicio'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El servicio no se ha podido prefacturar",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'pre_factura_servicio.php';
            });
    </script>
    <?php
}
?>

<?php
$id_string = $_POST['id_string'];
$nombre_pre_factura = $_POST['select_box_pre_factura_cliente'];

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
                    document.getElementById("menu_clientes").className = "active";
                });</script>

        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand"><?php echo "Pre-facturar servicio - $nombre_pre_factura"; ?></a>
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


                <?php
                $id_string = $_POST['id_string'];
                $cliente = $_POST['select_box_nif_empresa'];
                $id_array = explode(',', $id_string);
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"> Selecciona la cantidad de los servicios </h4>
                            </div>
                            <div class="content">
                                <form id="contact" action="../assets/php/facturar/pre_factura_servicio_post.php"
                                      method="post">
                                    <?php
                                    for ($i = 1; $i <= count($id_array) - 1; $i++) {
                                        $data = get_servicio_pre_factura($id_array[$i]);
                                        if ($data->num_rows > 0) {
                                            // output data of each row
                                            $row = $data->fetch_assoc();

                                            ?>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label> Servicio(disabled)</label>
                                                        <input type="text" name="nombre"
                                                               class="form-control" disabled

                                                               value="<?php echo $row['nombre'] ?>">
                                                    </div>
                                                </div>
                                                    <input type="hidden" name="descripcion"
                                                           class="form-control" disabled
                                                           value="<?php echo $row['descripcion'] ?>">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label> Mes</label>
                                                        <select name="mes" class="form-control" required>
                                                            <option>
                                                            <option>Enero
                                                            <option>Febrero
                                                            <option>Marzo
                                                            <option>Abril
                                                            <option>Mayo
                                                            <option>Junio
                                                            <option>Julio
                                                            <option>Agosto
                                                            <option>Setiembre
                                                            <option>Octubre
                                                            <option>Noviembre
                                                            <option>Diciembre
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label> Precio(disabled)</label>
                                                        <input type="text" name="precio"
                                                               class="form-control" disabled
                                                               value="<?php echo $row['precio'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label> Cantidad</label>
                                                        <input type="number" name="cantidad_<?php echo $i ?>"
                                                               class="form-control" value="1" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                        } else {
                                            echo "0 results";
                                        }
                                    }

                                    ?>
                                    <fieldset>
                                        <input type="hidden" id="cliente" name="cliente"
                                               value="<?php echo $cliente ?>">

                                    </fieldset>
                                    <fieldset>
                                        <input type="hidden" id="nombre_pre_factura" name="nombre_pre_factura"
                                               value="<?php echo $nombre_pre_factura ?>">

                                    </fieldset>
                                    <center>
                                        <button style="width: 25%" name="submit" value="<?php echo $id_string ?>"
                                                type="submit"> Pre - facturar
                                        </button>
                                    </center>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
                        </div>
                    </div>


                </div>


            </div>


        </div>
    </div>
</div>
</div >
</body>
</html>
<!--SI NO HA PASSADO POR EL LOGIN LO MANDAMOS PARA QUE SE AUTENTIFIQUE-->
<?php
} else {
    header("location:../index.php");
}
?>