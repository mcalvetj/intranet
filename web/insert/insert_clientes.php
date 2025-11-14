<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
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
                    document.getElementById("menu_clientes").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_clientes {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_clientes1 {
                        margin-left: 16%;
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
                    <a class="navbar-brand">Insertar cliente</a>
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
                                <form id="contact" action="../assets/php/post/post_clientes.php" method="post">
                                    <h3>Insertar cliente</h3>
                                    <h4>Rellene el formulario para añadir un nuevo cliente</h4>
                                    <fieldset>
                                        &nbsp;NIF de la empresa: <input placeholder="NIF de la empresa*"
                                                                        name="nif_empresa" type="text" autofocus>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;NIF intra: <input placeholder="NIF intra"
                                                                        name="nif_intra" type="text" autofocus>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Nombre del comercial: <input placeholder="Nombre del comercial*"
                                                                           name="nombre_comercial" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Nombre de la empresa: <input placeholder="Nombre de la empresa*"
                                                                           name="nombre_completo" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Teléfono: </br><input placeholder="Teléfono*" name="telefono" type="number"
                                                               required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Correo electrónico: <input placeholder="Correo electrónico" name="email"
                                                                         type="email" >
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Ciudad para la facturación: <input
                                            placeholder="Ciudad para la facturación*" name="ciudad_facturacion"
                                            type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Código postal para la facturación: </br><input
                                            placeholder="Código postal para la facturación*"
                                            name="codigo_postal_facturacion" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Calle para la facturación: <input placeholder="Calle para la facturación*"
                                                                                name="calle_facturacion" type="text"
                                                                                required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Número para la facturación (Especificar aquí si se trata de un local, bis,...): <input
                                            placeholder="Número para la facturación*" name="numero_facturacion"
                                            type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Ciudad para el envio: <input placeholder="Ciudad para el envio*"
                                                                           name="ciudad_envio" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Código postal para el envio: <input
                                            placeholder="Código postal para el envio*" name="codigo_postal_envio"
                                            type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Calle para el envio: <input placeholder="Calle para el envio*"
                                                                          name="calle_envio" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Número para el envio: (Especificar aquí si se trata de un local, bis,...) <input placeholder="Número para el envio*"
                                                                           name="numero_envio" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;IBAN: <input placeholder="IBAN*" name="iban" type="text" required>
                                    </fieldset>
                                    <fieldset>&nbsp;SEPA:*
                                        <?php $data = select_all_sepa(); ?>
                                        <select name="select_box_sepa" class="select_box" required>
                                            <option value="" disabled selected>NO/SI</option>
                                            <?php
                                            if ($data->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row['valor'] ?>"><?php echo "$row[valor]"; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>&nbsp;Selecciona el país:
                                        <?php $data = select_all_pais(); ?>
                                        <select name="select_box_pais" class="select_box">
                                            <option value="" disabled selected>Selecciona País*</option>
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
                                                data-submit="...Sending">Dar de alta
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