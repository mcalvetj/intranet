<?php

include_once "conexion.php";
session_start();


function verificar_login($user, $password, $con,&$result)
{
    $sql="SELECT * FROM USUARIO WHERE user = '$user' and password = '$password'";

    $result = mysqli_query($con,$sql);
    $numero_filas = mysqli_num_rows($result);


    /*$sql = "SELECT * FROM USUARIO WHERE user = '$user' and password = '$password' and activo = 1";
    $rec = mysqli_query($sql);
    $count = 0;
    var_dump(mysqli_query($sql));


    while ($row = mysqli_fetch_object($rec)) {
        $count++;
        $result = $row;
    }

    if ($count == 1) {
        return 1;
    } else {
        return 0;
    }*/
    if ($numero_filas == 0) {
        return 0;
    } else {
        return 1;
    }
}

if (!isset($_SESSION['userid'])) {
    if (isset($_POST['login'])) {

        $user = $_POST['user'];
        $password = $_POST['password'];
        $password = md5($password);


        if (verificar_login($user, $password, $con, $result) == 1) {
            $nombre = $_POST['nombre'];
            $_SESSION["id_usuario"] = $result->ID_USUARIO;
            $_SESSION["user"] = $user;
            $_SESSION["username"] = $result->nombre;
            $_SESSION['user_rol'] = $result->rol;
            $_SESSION['imagen'] = $result->imagen;
            $_SESSION["login_done"] = true;
            header("location:./web/index.php");

        } else {
            echo '<div class="error">Usuario o contraseña incorrectos</div>';

        }
    }
    ?>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/css/login.css">
    <script src="./assets/js/login.js"></script>


    <div class="login-page">
        <div class="form">
            <form class="login-form" action="" method="post">
                <input type="text" name="user" placeholder="username"/>
                <input type="password" name="password" placeholder="password"/>
                <button name="login" type="submit" value="login">login</button>
            </form>
        </div>
    </div>

    <?php
} else {
    echo 'Su usuario ingreso correctamente.';
    echo '<a href="logout.php">Logout</a>';
}
?>