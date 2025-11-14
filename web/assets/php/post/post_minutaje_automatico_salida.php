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
    $id_minutaje = $_POST['idMinutaje'];
    $hora_salida = $_POST['hora_salida_minutaje'];

    $conn = connect();

    $horasHoraSalida = substr($hora_salida, -41, 2);
    $minutosHoraSalida = substr($hora_salida, -38, 2);

    echo $hora_salida;
    echo "<br>";
    echo $horasHoraSalida;
    echo "<br>";
    echo $minutosHoraSalida;
    echo "<br>";

    //redondear minutos salida
    if(($minutosHoraSalida=="01")||($minutosHoraSalida=="02")||($minutosHoraSalida=="03")||($minutosHoraSalida=="04")||($minutosHoraSalida=="05")||($minutosHoraSalida=="06")||($minutosHoraSalida=="07")||($minutosHoraSalida=="08")||($minutosHoraSalida=="09")||($minutosHoraSalida=="10")||($minutosHoraSalida=="11")||($minutosHoraSalida=="12")||($minutosHoraSalida=="13")||($minutosHoraSalida=="14")){
        $nuevaHoraSalida=$horasHoraSalida.':15:00';
    }
        if(($minutosHoraSalida=="16")||($minutosHoraSalida=="17")||($minutosHoraSalida=="18")||($minutosHoraSalida=="19")||($minutosHoraSalida=="20")||($minutosHoraSalida=="21")||($minutosHoraSalida=="22")||($minutosHoraSalida=="23")||($minutosHoraSalida=="24")||($minutosHoraSalida=="25")||($minutosHoraSalida=="26")||($minutosHoraSalida=="27")||($minutosHoraSalida=="28")||($minutosHoraSalida=="29")){
            $nuevaHoraSalida=$horasHoraSalida.':30:00';
        }
            if(($minutosHoraSalida=="31")||($minutosHoraSalida=="32")||($minutosHoraSalida=="33")||($minutosHoraSalida=="34")||($minutosHoraSalida=="35")||($minutosHoraSalida=="36")||($minutosHoraSalida=="37")||($minutosHoraSalida=="38")||($minutosHoraSalida=="39")||($minutosHoraSalida=="40")||($minutosHoraSalida=="41")||($minutosHoraSalida=="42")||($minutosHoraSalida=="43")||($minutosHoraSalida=="44")){
                $nuevaHoraSalida=$horasHoraSalida.':45:00';
            }
                if(($minutosHoraSalida=="46")||($minutosHoraSalida=="47")||($minutosHoraSalida=="48")||($minutosHoraSalida=="49")||($minutosHoraSalida=="50")||($minutosHoraSalida=="51")||($minutosHoraSalida=="52")||($minutosHoraSalida=="53")||($minutosHoraSalida=="54")||($minutosHoraSalida=="55")||($minutosHoraSalida=="56")||($minutosHoraSalida=="57")||($minutosHoraSalida=="58")||($minutosHoraSalida=="59")){

                        switch($horasHoraSalida){
                            case "00":
                                $nuevaHorasHoraSalida="01";
                                break;
                            case "01":
                                $nuevaHorasHoraSalida="02";
                                break;
                            case "02":
                                $nuevaHorasHoraSalida="03";
                                break;
                            case "03":
                                $nuevaHorasHoraSalida="04";
                                break;
                            case "04":
                                $nuevaHorasHoraSalida="05";
                                break;    
                            case "05":
                                $nuevaHorasHoraSalida="06";
                                break;
                            case "06":
                                $nuevaHorasHoraSalida="07";
                                break;
                            case "07":
                                $nuevaHorasHoraSalida="08";
                                break;
                            case "08":
                                $nuevaHorasHoraSalida="09";
                                break;
                            case "09":
                                $nuevaHorasHoraSalida="10";
                                break;    
                            case "10":
                                $nuevaHorasHoraSalida="11";
                                break;
                            case "11":
                                $nuevaHorasHoraSalida="12";
                                break;
                            case "12":
                                $nuevaHorasHoraSalida="13";
                                break;
                            case "13":
                                $nuevaHorasHoraSalida="14";
                                break;
                            case "14":
                                $nuevaHorasHoraSalida="15";
                                break;  
                            case "15":
                                $nuevaHorasHoraSalida="16";
                                break;
                            case "16":
                                $nuevaHorasHoraSalida="17";
                                break;
                            case "17":
                                $nuevaHorasHoraSalida="18";
                                break;
                            case "18":
                                $nuevaHorasHoraSalida="19";
                                break;
                            case "19":
                                $nuevaHorasHoraSalida="20";
                                break;    
                            case "20":
                                $nuevaHorasHoraSalida="21";
                                break;
                            case "21":
                                $nuevaHorasHoraSalida="22";
                                break;
                            case "22":
                                $nuevaHorasHoraSalida="23";
                                break;
                            case "23":
                                $nuevaHorasHoraSalida="00";
                                break;         
                        }

                        $nuevaHoraSalida=$nuevaHorasHoraSalida.':00:00';
                    
                }
            
echo $nuevaHoraEntrada;
    echo "<br>";
    echo $nuevaHoraSalida; 

    //Conectamos con la base de datos, hacemos los inserts y cerramos conexion.


    $sql = "INSERT INTO MINUTAJE (fecha, hora_entrada, hora_salida, ID_servicio, ID_usuario, ID_sede, NIF_cliente) VALUES ('$fecha','$nuevaHoraEntrada', '$nuevaHoraSalida','$servicio2','$usuario','$sede2','$NIF_cliente')";


    if ($conn->query($sql) === TRUE) {
        header('Location: ../../../minutaje_automatico.php?ok=altaMinutajeAutomatico');
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