    <!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if($_SESSION["login_done"]==true){
?>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet" />
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet" />

</head>
<body onload="itv = setInterval(prog, 10)">

<div>
					<?php
					//Declaramos las variables del formulario
					$nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $email = $_POST['email'];
                    $telefono = $_POST['telefono'];
					$user = $_POST['user'];
					$password = $_POST['password'];
                    $activo = $_POST['activo'];
                    $rol = $_POST['select_box_rol'];

                    if($activo==''){
                        $activo2 = 0;
                    }else{
                        $activo2 = 1;
                    }

					//Añadimos comillas a los varchars
					$apellido="\"$apellido\"";
                    $email="\"$email\"";
                    $telefono="\"$telefono\"";
                    $nombre="\"$nombre\"";
					$user="\"$user\"";
					$password="\"$password\"";


					//Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
					$conn = connect();

					$sql = "INSERT INTO USUARIO (nombre, apellido, correo, telefono, user, password, rol, activo)
					VALUES ($nombre, $apellido, $email, $telefono, $user, MD5($password), $rol, $activo2)";


					if ($conn->query($sql) === TRUE) {
                        header('Location: ../../../insert.php?ok=altaUsuario');
					} else {
                        header('Location: ../../../insert.php?error=altaUsuario');
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