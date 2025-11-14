<!doctype html>

<?php
session_start();
include('assets/php/db.php');
include('assets/php/selects.php');
include('assets/php/functions.php');
include('assets/php/functions_array_servicio.php');
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
    <!-- GUARDAR MINUTAJE EN SESSIONES-->
    <script src="assets/js/jquery.session.js"></script>

    <!--Funciones javascript-->
    <script src="./assets/js/functions.js"></script>

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
if($_GET['ok']=='altaMinutajeAutomatico'){
    ?>
    <script>
        swal({
                title: "Alta de minutaje completada!",
                text: "",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'minutaje_automatico.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaMinutajeAutomatico'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El minutaje no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'minutaje_automatico.php';
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
            include('assets/html/logo/logo.html');
            include('assets/html/menu/menu_principal.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_minutaje_automatico").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_minutaje_automatico {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_minutaje_automatico1 {
                        margin-left: -11%;
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
                    <!--TITULO DE LA PÃGINA-->
                    <a class="navbar-brand">Minutaje (automatico)</a>
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
                        <div id="panelEntrar" class="card">
                            <div class="container">
                                <h3>Añadir Minutaje (Automatico)</h3>
                                <h4>Rellene el formulario para añadir la salida realizada</h4>
                                <form id="contact" method="post" name="f_cliente_sede_servicio">
                                    <fieldset>
                                        <?php $data = select_all_cliente(); ?>
                                        <select id="cliente" name="select_box_nif_empresa" class="select_box"
                                                onchange="cambia_sede_servicio()">
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
                                        <select id="sede" class="select_box" name="select_box_sede_cliente" required>
                                            <option value="-">-
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <select id="servicio" class="select_box" name="select_box_servicio" required>
                                            <option value="-">-
                                        </select>
                                    </fieldset>

                                    <fieldset>
                                        <a id="fecha_print" style="display:none;"></a>
                                        <input type="hidden" id="fecha" name="fecha" value="" required/>
                                    </fieldset>
                                    <fieldset>
                                        <a id="hora_entrada_print" style="display:none;"></a>
                                        <input type="hidden" id="hora_entrada" name="hora_entrada" value="" required/>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                        <div id="botonentrar">
                        <center>
                            <button id="entrar" data-submit="...Sending" class="button_horas"
                                    onclick="myFunction1()">Presione este boton al entrar
                            </button>
                        </center>
                        </div>
                        <!--FORMULARIO DE SALIDA-->
                        <div id="panelSalir" class="card">
                            <div class="container">
                                <h3>Finalizar minutaje</h3>
                                <h4>Seleccione el boton para finalizar el minutaje</h4>
                                <form id="contact" action="./assets/php/post/post_minutaje_automatico.php"
                                      method="post">
                                    <fieldset>
                                        <input type="hidden" name="cliente_minutaje" value="">
                                    </fieldset>
                                    <fieldset>
                                        <input type="hidden" name="sede_minutaje" value="">
                                    </fieldset>
<fieldset>
                                        <input type="hidden" name="servicio_minutaje" value="">
                                    </fieldset>

                                    

                                    <!--<fieldset>
                                        <?php $data = select_all_servicio(); ?>
                                        <select id="servicio" name="select_box_servicio" class="select_box" required>
                                            <option value="" disabled selected>Selecciona el servicio*</option>
                                            <?php
                                            if ($data->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                            value="<?php echo $row['ID_SERVICIO'] ?>"><?php echo "$row[nombre] - $row[descripcion]"; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </fieldset>-->
                                    <fieldset>
                                        <input type="hidden" name="fecha_minutaje" value="">
                                    </fieldset>
                                    <fieldset>
                                        <input type="hidden" name="hora_entrada_minutaje" value="">
                                    </fieldset>
                                    <fieldset>
                                        <a id="hora_salida_print" style="display:none;"></a>
                                        <input type="hidden" id="hora_salida" name="hora_salida_minutaje" value=""
                                               required/>
                                    </fieldset>
                                    <center>
                                    <button id="salir" class="button_horas" onclick="myFunction2()">Presione este boton al salir
                                    </button>
                                    </center>
                                </form>

                            </div>
                        </div>

                        <!--FUNCIONES JAVASCRIPT - MINUTAJE AUTOMATICO-->
                            <script src="assets/js/minutaje_automatico.js"></script>
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