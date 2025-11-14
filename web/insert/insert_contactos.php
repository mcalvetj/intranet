<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
include('../assets/php/functions_array_sede.php');
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
    <?php include('../assets/librerias/librerias_globales_insert.html'); ?>
    <!--LIBRERIA - INSERT-->
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
            include('../assets/html/logo/logo_insert.html');
            include('../assets/html/menu/menu_insert.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_contactos").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_contactos {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_contactos1 {
                        margin-left: 13%;
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
                    <a class="navbar-brand">Insertar contacto</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_insert.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card2">

                            <div class="container">
                                <form id="contact" action="../assets/php/post/post_contactos.php" method="post" name="f_cliente_sede">
                                    <h3>Insertar contacto</h3>
                                    <h4>Rellene el formulario para añadir una nuevo contacto a una sede ya añadida.</h4>

                                    <fieldset>
                                        &nbsp;Nombre del contacto: <input placeholder="Nombre del contacto*"
                                                                          name="nombre" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Selecciona el cliente y la sede:
                                        <?php $data = select_all_cliente(); ?>
                                        <select id="cliente" name="select_box_nif_empresa" class="select_box"
                                                onchange="cambia_sede()">
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
                                        <select id="sede" class="select_box" name="select_box_sede_cliente">
                                            <option value="-">-
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Cargo: <input placeholder="Cargo*" name="cargo" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Correo electrónico: <input placeholder="Correo electrónico*" name="email"
                                                                         type="email" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Teléfono: </br><input placeholder="Teléfono*" name="telefono" type="number"
                                                               required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Extensión: <input placeholder="Extensión" name="extension" type="text">
                                    </fieldset>
                                    <fieldset>&nbsp;Selecciona el país:
                                        <?php $data = select_all_pais(); ?>
                                        <select name="select_box_pais" class="select_box">
                                            <option value="" disabled selected>Selecciona el país*</option>
                                            <?php
                                            if ($data->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row['PAIS'] ?>"><?php echo $row['PAIS'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
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
</body>
</html>

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>