<!doctype html>

<?php
session_start();
include('assets/php/db.php');
include('assets/php/selects.php');
include('assets/php/functions.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

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

if($_GET['ok']=='cambioPassword'){
    ?>
    <script>
        swal({
                title: "Cambio de password completado!",
                text: "",
                type: "success",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'user.php';
            });
    </script>
    <?php
}
if($_GET['error']=='cambioPassword'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El password no se pudo cambiar",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'user.php';
            });
    </script>
    <?php
}
if($_GET['error']=='minimoCaracteres'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El mínimo de carácteres és 8",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'user.php';
            });
    </script>
    <?php
}
if($_GET['error']=='noCoincidenPasswords'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "No coinciden los passwords",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'user.php';
            });
    </script>
    <?php
}
if($_GET['error']=='passwordAntiguoNoCorrecto'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El password antiguo no es el correcto",
                type: "error",
                confirmButtonColor: "#dddcd2",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            },
            function(){
                window.location.href = 'user.php';
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
            <script>$(function () {
                    document.getElementById("x").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #x {
                        background-color: #ef9448;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
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
                    <a class="navbar-brand">Usuario</a>
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar perfil</h4>
                            </div>
                            <div class="content">

                                <?php
               
                                    $data = select_all_user($_SESSION["id_usuario"]); 

                                    if ($data->num_rows > 0) {
                                         // output data of each row
                                         while($row = $data->fetch_assoc()) {
                                ?>

                                <form id="contact" action="assets/php/post/post_user.php" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nombre (disabled)</label>
                                                <input type="text" name="nombre" class="form-control" disabled placeholder="<?php echo $row['nombre']?>" value="<?php echo $row['nombre']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Apellido (disabled)</label>
                                                <input type="text" name="apellido" class="form-control" disabled placeholder="<?php echo $row['apellido']?>" value="<?php echo $row['apellido']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Usuario (disabled)</label>
                                                <input type="text" name="usuario" class="form-control" disabled placeholder="<?php echo $row['user']?>" value="<?php echo $row['user']?>">
                                            </div>
                                        </div>
                                     </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Correo electrónico (disabled)</label>
                                                <input type="text" name="email" class="form-control" disabled placeholder="<?php echo $row['correo']?>" value="<?php echo $row['correo']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Teléfono (disabled)</label>
                                                <input type="text" name="telefon" class="form-control" disabled placeholder="<?php echo $row['telefono']?>" value="<?php echo $row['telefono']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contraseña antigua</label>
                                                <input type="password" name="password" class="form-control" placeholder="********" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contraseña</label>
                                                <input type="password" name="password1" class="form-control" placeholder="********" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Repetir contraseña</label>
                                                <input type="password" name="password2" class="form-control" placeholder="********" >
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="password_anterior" value="<?php echo $row['password']?>">

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Actualizar perfil</button>
                                    <div class="clearfix"></div>
                                </form>

                                <?php           
                                     }
                                } else {
                                     echo "0 results";
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="./assets/img/ctw_logo.gif"/>
                            </div>
                            <div class="content">
                                <div class="author">
                                    <a>
                                        <img class="avatar border-gray" src="assets/img/user_logo/<?php echo $_SESSION["imagen"]; ?>" />

                                        <h4 class="title"><?php echo $_SESSION["username"]; ?><br />
                                        </h4>
                                    </a>
                                </div>
                                <center>
                                <form action="assets/php/post/uploadImageProfile.php" method="post" enctype="multipart/form-data">
                                    <input type="file" class="button_subir_imagen" value="Subir imagen"/>
                                    <button type="submit" class="button_enviar_imagen" value="Upload Image" name="submit">Enviar imagen</button>
                                </form>
                                </center>
                                <p class="description text-center"></p>
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
}else{
    echo "false";
    header("location:../index.php");
}

?>