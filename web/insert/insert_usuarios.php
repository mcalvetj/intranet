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
                    <a class="navbar-brand">Insertar usuario</a>
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
                                <form id="contact" action="../assets/php/post/post_usuarios.php" method="post">
                                    <h3>Insertar usuario</h3>
                                    <h4>Rellene el formulario para añadir un nuevo usuario</h4>
                                    <fieldset>
                                        &nbsp;Nombre: <input placeholder="Nombre*" name="nombre" type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Apellido: <input placeholder="Apellido*" name="apellido" type="text"
                                                               required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Correo electrónico: <input placeholder="Correo electrónico*" name="email"
                                                                         type="email" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Teléfono: </br><input placeholder="Teléfono*" name="telefono" type="number"
                                                               required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Nick de usuario: <input placeholder="Nick de usuario*" name="user"
                                                                      type="text" required>
                                    </fieldset>
                                    <fieldset>
                                        &nbsp;Contraseña: <input placeholder="Contraseña*" name="password" type="text"
                                                                 required>
                                    </fieldset>
                                    <fieldset>&nbsp;Selecciona el rol de usuario:
                                        <?php $data = select_all_rol(); ?>
                                        <select name="select_box_rol" class="select_box" required>
                                            <option value="" disabled selected>Selecciona el rol*</option>
                                            <?php
                                            if ($data->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row['rol'] ?>"><?php echo "$row[rol] - $row[descripcion]"; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <input style="visibility:hidden" name="activo" type="checkbox" checked>
                                    </fieldset>
                                    <fieldset>
                                        <button name="submit" type="submit" id="contact-submit"
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

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>