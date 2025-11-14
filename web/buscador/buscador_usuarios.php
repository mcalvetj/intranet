    <!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!--LIBRERIAS-->


    <!--LIBRERIA - GLOBAL-->
    <?php include('../assets/librerias/librerias_globales_buscador.html'); ?>
    <!--EDITOR DE TABLAS-->
    <?php
    if ($_SESSION["user_rol"] <= 1) {
        //<!--COLUMNAS QUE PUEDEN SER MODIFICADAS-->
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_usuario.js\"></script>";
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
                    document.getElementById("menu_usuarios").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_usuarios {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_usuarios1 {
                        margin-left: 15%;
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
                <a class="navbar-brand">Buscador usuarios</a>
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
                    <div >
                        <div >
                                <table id="buscador_usuario" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #39AF33; width: 30px;">Activo</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Nick</th>
                                            <th>Rol</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $data = select_all_usuario();
                                            if ($data->num_rows > 0) {
                                                 // output data of each row
                                                 while($row = $data->fetch_assoc()) {
                                                    $pk = $row['ID_USUARIO'];

                                        ?>
                                                    <tr>
                                                        <?php checkbox_usuarios($row['activo'],$row['ID_USUARIO']  )?>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="nombre" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="apellido" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['apellido']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="correo" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['correo']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="telefono" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['telefono']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="user" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['user']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="rol" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['rol']?> </a></label></td>
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
}else{
    echo "false";
    header("location:../index.php");
}

?>