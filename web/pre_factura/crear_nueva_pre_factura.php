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
            include('../assets/html/logo/logo_buscador.html');
            include('../assets/html/menu/menu_buscador.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_clientes").className = "active";
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
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="container">

                                <!--variables de minutaje o articulos-->
                                <?php
                                $id_string = $_POST['submit'];

                                /*for($i = 0; $i <= $array_id.count();$i++){
                                    echo"$array_id[$i]";

                                }*/
                                ?>

                                <form id="contact" action="../assets/php/facturar/crear_pre_factura.php" method="post"
                                      name="f_cliente_sede">

                                    <h3>Pre-facturar</h3>
                                    <h4>Crear nueva prefactura</h4>


                                    <fieldset>&nbsp;Selecciona el cliente:
                                        <?php $data = select_all_cliente_activo(); ?>
                                        <select name="select_box_nif_empresa" class="select_box">
                                            <option value="" disabled selected>Selecciona el NIF del cliente*</option>
                                            <?php
                                            if ($data->num_rows > 0) {
                                                // output data of each row
                                                while($row = $data->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row['NIF_EMPRESA']?>"><?php echo "$row[nombre_completo] - $row[NIF_EMPRESA]";?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Nombre de la pre-factura: <input placeholder="Nombre de la pre-factura*"
                                                                           name="nombre_pre_factura" type="text" required>
                                    </fieldset>

                                    <fieldset>
                                        <button value="<?php echo $id_string ?>" name="submit" type="submit" id="contact-submit"
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
<!--SI NO HA PASSADO POR EL LOGIN LO MANDAMOS PARA QUE SE AUTENTIFIQUE-->
<?php
} else {
    header("location:../index.php");
}
?>