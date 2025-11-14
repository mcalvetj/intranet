<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
include('../assets/php/functions_array_prefacturas.php');
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
    <?php include('../assets/librerias/librerias_globales_pre_factura.html'); ?>

    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_pre_factura.html'); ?>
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
if($_GET['ok']=='altaPrefactura'){
    ?>
    <script>
        swal({
                title: "Alta de prefactura completada!",
                text: "",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaPrefactura'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "La prefactura no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
            });
    </script>
    <?php
}
if($_GET['ok']=='deleteMinutaje'){
    ?>
    <script>
        swal({
                title: "Alta de prefactura completada!",
                text: "",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
            });
    </script>
    <?php
}
if($_GET['error']=='deleteMinutaje'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "La prefactura no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
            });
    </script>
    <?php
}
?>
<?php
if($_GET['ok']=='eliminarPrefactura'){
    ?>
    <script>
        swal({
                title: "Eliminacion completada!",
                text: "",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
            });
    </script>
    <?php
}
if($_GET['error']=='eliminarPrefactura'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "La prefactura no se ha podido eliminar",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
            });
    </script>
    <?php
}
if($_GET['error']=='prefacturaLlena'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "La prefactura no se ha podido eliminar dado que no esta vacia",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'ver_prefactura_seleccion.php';
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
            include('../assets/html/logo/logo_pre_factura.html');
            include('../assets/html/menu/menu_pre_factura.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_pre_factura").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_pre_factura {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_pre_factura1 {
                        margin-left: 12%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <form method="POST" id="send_servicios" action="../pre_factura/seleccion_pre_factura.php">
                <input type="hidden" id="id_string" name="id_string" value="">
                <input style="display:none" type="submit" value="submit" id="buttonId"/>
            </form>
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--TITULO DE LA PÁGINA-->
                    <a class="navbar-brand">Ver pre-factura</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_pre_factura.html'); ?>
                </div>
            </div>
        </nav>


        <div style="padding: 30px 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="container">
                            <form id="contact" action="./ver_pre_factura.php" method="post"
                                  name="f_cliente_pre_factura">

                                <h3>Pre-facturar</h3>
                                <h4>Ver prefactura cliente</h4>

                                <fieldset>
                                    &nbsp;Selecciona el cliente y la pre factura:
                                    <?php $data = select_all_cliente_activo(); ?>
                                    <select id="cliente" name="select_box_nif_empresa" class="select_box"
                                            onchange="cambia_pre_factura()" required>
                                        <option value="" disabled selected>Selecciona el cliente*</option>
                                        <?php
                                        if ($data->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $data->fetch_assoc()) {
                                                ?>
                                                <option
                                                    value="<?php echo $row['NIF_EMPRESA'] ?>"><?php echo "$row[nombre_completo] - $row[NIF_EMPRESA]"; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </fieldset>
                                <fieldset>
                                    <select id="pre_factura" class="select_box"
                                            name="select_box_pre_factura_cliente">
                                        <option value="-">-
                                    </select>
                                </fieldset>
                                <fieldset>

                                    <button name="submit" type="submit" id="contact-submit"
                                            data-submit="...Sending">Visualizar prefactura
                                    </button>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div style="padding: 0px 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="container">
                            
                                <h3>Visualizar todas las pre-facturar</h3>

                                <fieldset>
                                    <?php $data2 = select_all_prefacturas(); ?>
                                    <select class="select_box">
                                        <option value="" disabled selected>Todas las prefacturas*</option>
                                        <?php
                                        if ($data2->num_rows > 0) {
                                            // output data of each row
                                            while ($row2 = $data2->fetch_assoc()) {
                                                $data3 = select_nombre_completo_cliente($row2[NIF_empresa]);
                                                ?>
                                                <option><?php echo "$row2[nombre] - $data3 ($row2[NIF_empresa])"; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </fieldset>
                            
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