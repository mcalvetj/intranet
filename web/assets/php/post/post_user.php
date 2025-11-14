    <!doctype html>

<?php
session_start();
include('../db.php');
include('../selects.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>
    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet" />
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet" />
</head>
<body onload="itv = setInterval(prog, 10)">

<div class="wrapper">
    <div>

					<?php
					//Declaramos las variables del formulario
                    $password = $_POST['password'];
					$password1 = $_POST['password1'];
                    $password2 = $_POST['password2'];
                    $password_anterior = $_POST['password_anterior'];
                    $password_length = strlen($password1);
                    $md5password = md5($password1);

                    $passwordantiguo=select_password_user($_SESSION['id_usuario']);
                    echo $password,$passwordantiguo,$password1,$password2;
                    if($passwordantiguo==md5($password)) {
                        if ($password1 == $password2) {

                            if ($password_length >= 3) {

                                $conn = connect();
                                $sql = "UPDATE USUARIO SET password = md5('$password1') WHERE  ID_USUARIO = $_SESSION[id_usuario]";

                            } else {
                                header('Location: ../../../user.php?error=minimoCaracteres');
                            }

                        } else {
                            header('Location: ../../../user.php?error=noCoincidenPasswords');
                        }
                    }else{
                        header('Location: ../../../user.php?error=passwordAntiguoNoCorrecto');
                    }

					if ($conn->query($sql) === TRUE) {
					   header('Location: ../../../user.php?ok=cambioPassword');
                    } else {
                        header('Location: ../../../user.php?error=cambioPassword');
                    }

					close($conn); 
					 
					?>
</div>
</body>
</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>