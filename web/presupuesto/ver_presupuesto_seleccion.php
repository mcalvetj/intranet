<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
include('../assets/php/functions_array_presupuesto.php');
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
                    document.getElementById("menu_presupuesto").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_presupuesto {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_ver_presupuesto1 {
                        margin-left: 12%;
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
                    <!--TITULO DE LA PÁGINA-->
                    <a class="navbar-brand">Ver presupuestos</a>
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
                            <form id="contact" action="./ver_presupuesto.php" method="post"
                                  name="f_cliente_presupuesto">

                                <h3>Ver presupuesto</h3>

                                <fieldset>
                                    &nbsp;Selecciona el cliente y el presupuesto:
                                    <?php $data = select_all_cliente_activo(); ?>
                                    <select id="cliente" name="select_box_nif_empresa" class="select_box"
                                            onchange="cambia_presupuesto()" required>
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
                                    <select id="presupuesto" class="select_box"
                                            name="select_box_presupuesto_cliente">
                                        <option value="-">-
                                    </select>
                                </fieldset>
                                <fieldset>

                                    <button name="submit" type="submit" id="contact-submit"
                                            data-submit="...Sending">Visualizar presupuesto
                                    </button>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card">
                        <div class="container">
                            <form id="contact" action="../assets/php/presupuesto/crear_presupuesto.php" method="post"
                                  name="f_cliente_pre_factura">

                                <h3>Crear presupuesto</h3>

                                <fieldset>
                                    &nbsp;Selecciona el cliente:
                                    <?php $data = select_all_cliente_activo(); ?>
                                    <select id="cliente" name="select_box_nif_empresa" class="select_box" required>
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
                                    &nbsp;Nombre: <input placeholder="Nombre*"
                                                            name="nombre" type="text" required>
                                </fieldset>

                                <fieldset>
                                    &nbsp;Comentario: <input placeholder="Comentario"
                                                         name="comentario" type="text" >
                                </fieldset>

                                <fieldset>

                                    <button name="submit" type="submit" id="contact-submit"
                                            data-submit="...Sending">Crear presupuesto
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

                            <h3>Visualizar todos los presupuestos</h3>

                            <fieldset>
                                <?php $data2 = select_all_presupuestos(); ?>
                                <select class="select_box">
                                    <option value="" disabled selected>Todos los presupuestos</option>
                                    <?php
                                    if ($data2->num_rows > 0) {
                                        // output data of each row
                                        while ($row2 = $data2->fetch_assoc()) {
                                            $data3 = select_cliente_presupuesto($row2[ID_PRESUPUESTO]);
                                            $data4=select_nombre_cliente($data3);
                                            
                                            ?>
                                            <option><?php echo "$data4 - $row2[nombre]"; ?></option>
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