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
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_contacto.js\"></script>";
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
                <a class="navbar-brand">Buscador contactos</a>
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
                            
                            <table id="buscador_contacto" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #39AF33; width: 3px;">Activos</th>
                                            <th>Nombre</th>
                                            <th>Sede</th>
                                            <th>Cargo</th>
                                            <th>Email</th>
                                            <th>Telefono</th>
                                            <th>País</th>
                                            <th>Prefijo</th>
                                            <th>Extensión</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $data = select_all_contacto();
                                    if ($data->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $data->fetch_assoc()) {
                                            $pk = $row['ID_CONTACTO'];
                                            ?>
                                                    <tr id="<?php echo $row['ID_CONTACTO']; ?>">
                                                        <?php checkbox_contacto($row['activo'],$row['ID_CONTACTO']  )?>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="nombre" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['nombre']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;">
                                                        <a href="#" class="sede" data-pk=<?php echo "\"$pk\""; ?>>
                                                        <?php 
                                                        $id_sede = $row['ID_sede'];
                                                        $nombreSede = select_nombre_sede($id_sede);
                                                        echo $nombreSede;
                                                        ?> 
                                                        </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="cargo" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['cargo']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="email" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['email']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="telefono" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['telefono']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="pais" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['pais']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="prefijo" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['prefijo']?> </a></label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#" class="extension" data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['extension']?> </a></label></td>
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