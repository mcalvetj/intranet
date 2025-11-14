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

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('../assets/librerias/librerias_globales_buscador.html'); ?>
    <!--EDITOR DE TABLAS-->
    <?php
    /*if ($_SESSION["user_rol"] <= 1) {
        //<!--COLUMNAS QUE PUEDEN SER MODIFICADAS-->
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_cliente.js\"></script>";
    }*/
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?>
    <!--LIBRERIA - INSERT-->
    <?php include('../assets/librerias/librerias_insert.html'); ?>

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
if($_GET['error']=='preFactura'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "Noo se ha podido prefacturar",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'pre_factura.php';
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
                    <div>
                        <div>
                            <table id="buscador_cliente" class="table table-striped table-bordered">
                                <!--HEAD DE LA TABLA-->
                                <thead>
                                <tr>
                                    <th style="background-color: #39AF33; width: 3px;">Activos</th>
                                    <th>Nombre completo</th>
                                    <th>NIF empresa</th>
                                    <th>Nombre comercial</th>
                                    <th>País</th>
                                    <th>Telefono</th>
                                    <th>Prefijo</th>
                                    <th>Email</th>
                                    <th>Ciudad facturacion</th>
                                    <th>Codigo postal facturación</th>
                                    <th>Calle facturación</th>
                                    <th>Número facturación</th>
                                    <th>Ciudad envio</th>
                                    <th>Codigo envio</th>
                                    <th>Calle envio</th>
                                    <th>Número envio</th>
                                    <th>IBAN</th>
                                    <th>SEPA</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--OBTENEMOS LOS DATOS PARA RELLENAR LA TABLA-->
                                <?php
                                $data = select_all_cliente();
                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $data->fetch_assoc()) {
                                        $pk = $row['NIF_EMPRESA'];
                                        ?>
                                        <!--INTRODUCIOMOS LOS DATOS AQUÍ-->
                                        <tr>
                                            <?php checkbox_cliente($row['activo'],$row['NIF_EMPRESA'] )?>

                                            <td><label><a class="nombre_completo"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre_completo'] ?> </a></label>
                                            </td>
                                            <td><label><a class="NIF_EMPRESA"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['NIF_EMPRESA'] ?></a></label>
                                            </td>
                                            <td><label><a class="nombre_comercial"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre_comercial'] ?> </a></label>
                                            </td>
                                            <td><label><a class="pais"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['pais'] ?> </a></label>
                                            </td>
                                            <td><label><a class="telefono"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['telefono'] ?></a></label>
                                            </td>
                                            <td><label><a class="prefijo"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['prefijo'] ?> </a></label>
                                            </td>
                                            <td><label><a class="email"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['email'] ?> </a></label>
                                            </td>
                                            <td><label><a class="ciudad_facturacion"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ciudad_facturacion'] ?> </a></label>
                                            </td>
                                            <td><label><a class="codigo_postal_facturacion"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['codigo_postal_facturacion'] ?> </a></label>
                                            </td>
                                            <td><label><a class="calle_facturacion"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['calle_facturacion'] ?> </a></label>
                                            </td>
                                            <td><label><a class="numero_facturacion"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['numero_facturacion'] ?> </a></label>
                                            </td>
                                            <td><label><a class="ciudad_envio"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ciudad_envio'] ?> </a></label>
                                            </td>
                                            <td><label><a class="codigo_postal_envio"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['codigo_postal_envio'] ?> </a></label>
                                            </td>
                                            <td><label><a class="calle_envio"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['calle_envio'] ?> </a></label>
                                            </td>
                                            <td><label><a class="numero_envio"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['numero_envio'] ?> </a></label>
                                            </td>
                                            <td><label><a class="IBAN"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['IBAN'] ?> </a></label>
                                            </td>
                                            <td><label><a class="SEPA"
                                                          data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['SEPA'] ?> </a></label>
                                            </td>
                                        </tr>
                                        <!--MENSAJE POR SI NO OBTIENE DATOS-->
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                                </tbody>
                            </table>
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
}else {
    header("location:../index.php");
}
?>