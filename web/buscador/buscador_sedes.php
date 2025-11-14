<!doctype html>

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
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_sede.js\"></script>";
    }
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?>
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
                    document.getElementById("menu_sedes").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_sedes {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_sedes1 {
                        margin-left: 22%;
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
                <!--TITULO DE LA PÁGINA-->
                <a class="navbar-brand">Buscador sedes</a>
            </div>
            <div class="collapse navbar-collapse">
                <!--USER & LOGOUT-->
                <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
            </div>
        </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <div>
                            <table id="buscador_sede" class="table table-striped table-bordered">
                                <thead>


                                <tr>

                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>Ubicación</th>
                                    <th>Ciudad</th>
                                    <th>Código postal</th>
                                    <th>Calle</th>
                                    <th>Número</th>
                                    <th>Telefono</th>
                                    <th>País</th>
                                    <th>Prefijo</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $data = select_all_sede_buscador();

                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $data->fetch_assoc()) {
                                        $pk = $row['ID_SEDE'];
                                        $pais = $row['pais'];

                                        ?>

                                        <tr>

                                            <td><label style="margin-top: 11px;">
                                                    <a data-pk=<?php echo "\"$pk\""; ?>>
                                                        <?php
                                                        $nif_cliente = $row['NIF_cliente'];
                                                        $nombreCliente = select_nombre_cliente($nif_cliente);
                                                        echo $nombreCliente;
                                                        ?>
                                                    </a></label></td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="nombre"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="ubicacion"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ubicacion'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="ciudad"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ciudad'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="codigo_postal"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['codigo_postal'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="calle"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['calle'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="numero"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['numero'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="telefono"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['telefono'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="pais"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['pais'] ?> </a></label>
                                            </td>

                                            <td><label style="margin-top: 11px;"><a href="#" class="prefijo"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['prefijo'] ?> </a>
                                            </td>

                                        </tr>


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

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>