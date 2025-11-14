<!doctype html>

<?php
session_start();
include('assets/php/db.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('assets/librerias/librerias_globales.html'); ?>

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
if($_GET['ok']=='altaCliente'){
    ?>
    <script>
        swal({
                title: "Alta de cliente completada!",
                text: "",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaCliente'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El cliente no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['ok']=='altaSede'){
    ?>
    <script>
        swal({
                title: "Alta de sede completada!",
                text: "",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaSede'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "La sede no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['ok']=='altaContacto'){
    ?>
    <script>
        swal({
                title: "Alta de contacto completada!",
                text: "",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaContacto'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El contacto no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['ok']=='altaMayorista'){
    ?>
    <script>
        swal({
                title: "Alta de mayorista completada!",
                text: "",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaMayorista'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El mayorista no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['ok']=='altaUsuario'){
    ?>
    <script>
        swal({
                title: "Alta de usuario completada!",
                text: "",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaUsuario'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El usuario no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['ok']=='altaServicio'){
    ?>
    <script>
        swal({
                title: "Alta de servicio completada!",
                text: "",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            },
            function(){
                window.location.href = 'insert.php';
            });
    </script>
    <?php
}
if($_GET['error']=='altaServicio'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El servicio no se ha podido dar de alta",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'insert.php';
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
            include('assets/html/logo/logo.html');
            include('assets/html/menu/menu_principal.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_insert").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_insert {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_insert1 {
                        margin-left: 17%;
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
                    <a class="navbar-brand">Insertar</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('assets/html/menu/user_logout.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                        <center>
                            <a href="insert/insert_clientes.php" class="button_insert">Añadir<br>cliente</a>
                            <a href="insert/insert_sedes.php" class="button_insert">Añadir<br>sede</a>
                            <a href="insert/insert_contactos.php" class="button_insert">Añadir<br>contacto</a>
                            <a href="insert/insert_mayoristas.php" class="button_insert">Añadir<br>mayorista</a>
                            <a href="insert/insert_usuarios.php" class="button_insert">Añadir<br>usuario</a>
                            <a href="insert/insert_servicios.php" class="button_insert">Añadir<br>servicio</a>
                        </center>

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