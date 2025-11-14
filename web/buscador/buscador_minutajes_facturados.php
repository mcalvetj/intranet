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

    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?>
    <script type="text/javascript" src="../assets/js/functions.js"></script>
    <script type="text/javascript" src="../assets/js/selected_row.js"></script>

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
                    document.getElementById("menu_minutajes_facturados").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_minutajes_facturados {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_minutajes_facturados {
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
                    <!--TITULO DE LA PÁGINA-->
                    <a class="navbar-brand">Minutajes facturados</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <!--passar los datos a pre_factura_articulos.php-->
            <form method="POST" id="send_minutaje" action="../pre_factura/seleccion_pre_factura.php">
                <input type="hidden" id="id_string" name="id_string" value="">
                <input style="display:none" type="submit" value="submit" id="buttonId"/>
            </form>
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <div>


                            <table id="buscador_minutajes_facturados" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Sede</th>
                                    <th>Servicio</th>
                                    <th>Comentario</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Hora de entrada</th>
                                    <th>Hora de salida</th>




                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $data = select_all_minutaje_facturado();

                                if ($data->num_rows > 0) {
                                $i = 0;
                                // output data of each row
                                while ($row = $data->fetch_assoc()) {
                                $pk = $row['ID_MINUTAJE'];
                                $i++;
                                $div = "div" . $i;

                                ?>
                                <tr id="<?php echo "$div"; ?>" value="<?php echo "$pk"; ?>">
                                    <td><label style="margin-top: 11px;">
                                            <a href="#" data-pk=<?php echo "\"$pk\""; ?>>
                                                <?php
                                                $nif_cliente = $row['NIF_cliente'];
                                                $nombreCliente = select_nombre_cliente($nif_cliente);
                                                echo $nombreCliente;
                                                ?>
                                            </a>
                                        </label>
                                    </td>
                                    <td><label style="margin-top: 11px;">
                                            <a href="#" data-pk=<?php echo "\"$pk\""; ?>>
                                                <?php
                                                $id_sede = $row['ID_SEDE'];
                                                $nombreSede = select_nombre_sede($id_sede);
                                                echo $nombreSede;
                                                ?>
                                            </a>
                                        </label>
                                    </td>
                                    <td><label style="margin-top: 11px;">
                                            <a data-pk=<?php echo "\"$pk\""; ?>>
                                                <?php
                                                $id_servicio = $row['ID_SERVICIO'];
                                                $nombreServicio = select_nombre_servicio($id_servicio);
                                                echo $nombreServicio;
                                                ?>
                                            </a>
                                        </label>
                                    </td>
                                    <td><label style="margin-top: 11px;">
                                            <a class="comentario" data-pk=<?php echo "\"$pk\""; ?>>
                                                <?php
                                                echo $row['comentario'];
                                                ?>
                                            </a>
                                        </label>
                                    </td>
                                    <td><label style="margin-top: 11px;">
                                            <a href="#" data-pk=<?php echo "\"$pk\""; ?>>
                                                <?php
                                                $id_usuario = $row['ID_USUARIO'];
                                                $nombreUsuario = select_nombre_usuario($id_usuario);
                                                echo $nombreUsuario;
                                                ?>
                                            </a>
                                        </label>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a href="#" class="fecha"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['fecha'] ?> </a></label>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a href="#" class="hora_entrada"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['hora_entrada'] ?> </a></label>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a href="#" class="hora_salida"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['hora_salida'] ?> </a></label>
                                    </td>




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