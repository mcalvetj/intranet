<!doctype html>
<!--VERIFICAR QUE LOGIN SE HA REALIZADO-->
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
    <?php include('../assets/librerias/librerias_globales_buscador.html'); ?>
    <!--EDITOR DE TABLAS-->
    <?php
    if ($_SESSION["user_rol"] <= 1) {
        //<!--COLUMNAS QUE PUEDEN SER MODIFICADAS-->
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_cliente.js\"></script>";
    }
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_pre_factura.html'); ?>
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
                    document.getElementById("menu_pre_factura").className = "active";
                });</script>

        </div>
    </div>
    <!--BARRA SUPERIOR, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand">Buscador clientes</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
                </div>
            </div>
        </nav>
        <!--ZONA DE CONTENIDO DE ESTA PAGINA, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->
        <div style="padding: 0px 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="container">

                                <!--variables de minutaje o articulos-->
                                <?php
                                $id_string = $_POST['id_string'];
                                $id_array = explode(',', $id_string);
                                if ($id_array[0] == 'articulo') {
                                    $ruta = 'articulo.php';
                                } elseif ($id_array[0] == 'minutaje') {
                                    $ruta = 'minutaje.php';
                                }elseif ($id_array[0] == 'servicio') {
                                    $ruta = 'servicio.php';
                                }
                                ?>

                                <!--CREAR NUEVA PRE_FACTURA-->
                                <form id="contact" action="./crear_nueva_pre_factura.php" method="post"
                                      name="f_cliente_sede">
                                    <fieldset>
                                        <button value="<?php echo $id_string ?>" name="submit" type="submit"
                                                id="contact-submit"
                                                data-submit="...Sending">Crear nueva pre-factura
                                        </button>
                                    </fieldset>
                                </form>


                                <form id="contact" action="./pre_factura_<?php echo $ruta?>" method="post"
                                      name="f_cliente_pre_factura">

                                    <h3>Prefacturar en prefactura existente</h3>
                                    <h4>Selecciona la prefactura</h4>

                                    <fieldset>
                                        &nbsp;Selecciona el cliente y la pre factura:
                                        <?php $data = select_all_cliente(); ?>
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
                                                name="select_box_pre_factura_cliente" >
                                            <option value="-">-
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <input type="hidden" id="id_string" name="id_string"
                                               value="<?php echo $id_string ?>">

                                    </fieldset>

                                    <fieldset>

                                        <button name="submit" type="submit" id="contact-submit"
                                                data-submit="...Sending">Agregar a prefactura existente
                                        </button>
                                    </fieldset>
                                </form>
                                


                            </div>
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
<!--SI NO HA PASSADO POR EL LOGIN LO MANDAMOS PARA QUE SE AUTENTIFIQUE-->
<?php
} else {
    header("location:../index.php");
}
?>
