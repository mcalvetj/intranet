<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>

    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet"/>
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet"/>

</head>
<body onload="itv = setInterval(prog, 10)">
<div>

    <?php
    #Declaramos las variables del formulario
    $NIF_cliente = $_POST['cliente_minutaje'];
    $sede = $_POST['sede_minutaje'];
    $servicio = $_POST['servicio_minutaje'];
    $usuario = $_SESSION["id_usuario"];
    $fecha = $_POST['fecha_minutaje'];
    $hora_entrada = $_POST['hora_entrada_minutaje'];

    $porciones = explode("//", $sede);

    $nombreSede=$porciones[0];
    $ubicacionSede=$porciones[1];

    $conn = connect();
    $sede2 = select_id_sede($nombreSede,$ubicacionSede);

    $servicio2 = select_id_servicio($servicio);

    $horasHoraEntrada = substr($hora_entrada, -41, 2);
    $minutosHoraEntrada = substr($hora_entrada, -38, 2);

    echo $hora_entrada;
    echo "<br>";

    //redondear minutos entrada
    if(($minutosHoraEntrada=="01")||($minutosHoraEntrada=="02")||($minutosHoraEntrada=="03")||($minutosHoraEntrada=="04")||($minutosHoraEntrada=="05")||($minutosHoraEntrada=="06")||($minutosHoraEntrada=="07")||($minutosHoraEntrada=="08")||($minutosHoraEntrada=="09")||($minutosHoraEntrada=="10")||($minutosHoraEntrada=="11")||($minutosHoraEntrada=="12")||($minutosHoraEntrada=="13")||($minutosHoraEntrada=="14")){
        $nuevaHoraEntrada=$horasHoraEntrada.':00:00';
    }
    if(($minutosHoraEntrada=="16")||($minutosHoraEntrada=="17")||($minutosHoraEntrada=="18")||($minutosHoraEntrada=="19")||($minutosHoraEntrada=="20")||($minutosHoraEntrada=="21")||($minutosHoraEntrada=="22")||($minutosHoraEntrada=="23")||($minutosHoraEntrada=="24")||($minutosHoraEntrada=="25")||($minutosHoraEntrada=="26")||($minutosHoraEntrada=="27")||($minutosHoraEntrada=="28")||($minutosHoraEntrada=="29")){
        $nuevaHoraEntrada=$horasHoraEntrada.':15:00';
    }
    if(($minutosHoraEntrada=="31")||($minutosHoraEntrada=="32")||($minutosHoraEntrada=="33")||($minutosHoraEntrada=="34")||($minutosHoraEntrada=="35")||($minutosHoraEntrada=="36")||($minutosHoraEntrada=="37")||($minutosHoraEntrada=="38")||($minutosHoraEntrada=="39")||($minutosHoraEntrada=="40")||($minutosHoraEntrada=="41")||($minutosHoraEntrada=="42")||($minutosHoraEntrada=="43")||($minutosHoraEntrada=="44")){
        $nuevaHoraEntrada=$horasHoraEntrada.':30:00';
    }
    if(($minutosHoraEntrada=="46")||($minutosHoraEntrada=="47")||($minutosHoraEntrada=="48")||($minutosHoraEntrada=="49")||($minutosHoraEntrada=="50")||($minutosHoraEntrada=="51")||($minutosHoraEntrada=="52")||($minutosHoraEntrada=="53")||($minutosHoraEntrada=="54")||($minutosHoraEntrada=="55")||($minutosHoraEntrada=="56")||($minutosHoraEntrada=="57")||($minutosHoraEntrada=="58")||($minutosHoraEntrada=="59")){
        $nuevaHoraEntrada=$horasHoraEntrada.':45:00';
    }


    //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.


    $sql = "INSERT INTO MINUTAJE (fecha, hora_entrada, hora_salida, ID_servicio, ID_usuario, ID_sede, NIF_cliente) VALUES ('$fecha','$nuevaHoraEntrada', NULL,'$servicio2','$usuario','$sede2','$NIF_cliente')";


    if ($conn->query($sql) === TRUE) {
        header('Location: ../../../minutaje_automatico.php');
    } else {
        header('Location: ../../../minutaje_automatico.php?error=altaMinutajeAutomatico');
    }

    close($conn);

    ?>

</div>

</body>
</html>

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>