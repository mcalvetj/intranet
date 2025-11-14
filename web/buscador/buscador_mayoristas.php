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
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_mayoristas.js\"></script>";
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
                    document.getElementById("menu_mayoristas").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_mayoristas {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_mayoristas1 {
                        margin-left: 8%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" style="width: 2100px">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <!--TITULO DE LA PÃGINA-->
                <a class="navbar-brand">Buscador mayoristas</a>
            </div>
            <div class="collapse navbar-collapse">
                <!--USER & LOGOUT-->
                <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
            </div>
        </div>
        </nav>

        <div class="content2">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <div>
                            <table id="buscador_mayorista" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="background-color: #39AF33; width: 3px;">Activos</th>
                                    <th>Nif mayorista</th>
                                    <th>Nombre empresa</th>
                                    <th>Nombre del comercial</th>
                                    <th>Teléfono empresa</th>
                                    <th>Teléfono del comercial</th>
                                    <th>Extensión teléfono del comercial</th>
                                    <th>Email empresa</th>
                                    <th>Email del comercial</th>
                                    <th>Ubicación</th>
                                    <th>País</th>
                                    <th>Prefijo</th>
                                    <th>IBAN</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $data = select_all_mayorista();

                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $data->fetch_assoc()) {
                                        $pk = $row['NIF_MAYORISTA'];

                                        ?>
                                        <tr>
                                            <?php checkbox_mayorista($row['activo'],$row['NIF_MAYORISTA']  )?>
                                            <td><label style="margin-top: 11px;"><a href="#" class="NIF_MAYORISTA"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['NIF_MAYORISTA'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="nombre_empresa"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre_empresa'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="nombre_comercial"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre_comercial'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="telefono_empresa"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['telefono_empresa'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="telefono_comercial"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['telefono_comercial'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#"
                                                                                    class="extension_telefono_comercial"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['extension_telefono_comercial'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="email_empresa"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['email_empresa'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="email_comercial"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['email_comercial'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="ubicacion"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ubicacion'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="pais"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['pais'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="prefijo"
                                                                                         data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['prefijo'] ?> </a></label>
                                            </td>
                                            <td><label style="margin-top: 11px;"><a href="#" class="IBAN"
                                                                                    data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['IBAN'] ?> </a></label>
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