<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
include('../assets/php/functions_array_prefacturas.php');
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
    <?php include('../assets/librerias/librerias_globales_pre_factura.html'); ?>
    <!--LIBRERIA - GLOBAL-->
    <?php/* include('../assets/librerias/librerias_globales_buscador.html'); */?>

    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_pre_factura.html'); ?>
    <script type="text/javascript" src="../assets/js/functions.js"></script>
    <script type="text/javascript" src="../assets/js/aplicar_margenes.js"></script>
    <link href="../assets/css/insert.css" rel="stylesheet"/>

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
if($_GET['ok']=='eliminarArticulo'){
    ?>
    <script>
        swal({
                title: "Eliminaci�n de articulo completada!",
                text: "",
                type: "success",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['error']=='eliminarArticulo'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El articulo no se ha podido eliminar",
                type: "error",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['ok']=='eliminarServicio'){
    ?>
    <script>
        swal({
            title: "Eliminaci�n de servicio completada!",
            text: "",
            type: "success",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['error']=='eliminarServicio'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El servicio no se ha podido eliminar",
                type: "error",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['ok']=='eliminarMinutaje'){
    ?>
    <script>
        swal({
                title: "Eliminaci�n de minutaje completada!",
                text: "",
                type: "success",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['error']=='eliminarMinutaje'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "El minutaje no se ha podido eliminar",
                type: "error",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['ok']=='editarNombrePrefactura'){
    ?>
    <script>
        swal({
                title: "Cambio de nombre completado!",
                text: "",
                type: "success",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['error']=='editarNombrePrefactura'){
    ?>
    <script>
        swal({
                title: "Error",
                text: "No se pudo cambiar el nombre de la prefactura",
                type: "error",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if($_GET['error']=='serAdmin'){
?>
<script>
    swal({
            title: "Error",
            text: "Tienes que ser admin y estar en local",
            type: "error",
        showConfirmButton: false,
        timer: 2000
    })
</script>
<?php
}
?>

<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <!--MENU Y LOGO-->
            <?php
            include('../assets/html/logo/logo_pre_factura.html');
            include('../assets/html/menu/menu_pre_factura.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_pre_factura").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_pre_factura {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_pre_factura1 {
                        /*margin-left: 12%;*/
                    }
                }

                .factura_pre_factura {
                    cursor: pointer;
                    width: 100%;
                    border: none;
                    background: #ea8f43;
                    color: #FFF;
                    margin: 0 0 5px;
                    padding: 10px;
                    font-size: 15px;
                }

                .factura_pre_factura:hover {
                    background: #d5672b;
                    -webkit-transition: background 0.3s ease-in-out;
                    -moz-transition: background 0.3s ease-in-out;
                    transition: background-color 0.3s ease-in-out;
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <!--DATOS DE LA PREFACTURA-->
        <?php

        if($_POST['select_box_pre_factura_cliente']!=null){
            $pre_factura = $_POST['select_box_pre_factura_cliente'];
            $pre_facrura_array = explode('-', $pre_factura);
            $id_pre_factura = $pre_facrura_array[0];
        }else{
            $pre_factura = $_GET['id'];
            $pre_facrura_array = explode('-', $pre_factura);
            $id_pre_factura = $pre_facrura_array[0];
        }

        if($_POST['select_box_nif_empresa']!=null){
            $nif_empresa = $_POST['select_box_nif_empresa'];
        }else{
            $nif_empresa = select_nif_empresa_pre_factura($pre_factura);
        }





        ?>
        <nav class="navbar navbar-default navbar-fixed">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--TITULO DE LA P�GINA-->
                    <a class="navbar-brand">Ver pre-factura</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_pre_factura.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="card">
                        <div>
                            <!--CABECERA PRE-FACTURA-->
                            <?php
                            $suma_precio_total = 0;
                            $cabecera_pre_factura = get_datos_cliente($nif_empresa);
                            // output data of each row
                            $row = $cabecera_pre_factura->fetch_assoc();

                            ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>N�m pre-factura</label>
                                        <input type="text" name="num_pre_factura"
                                               class="form-control" disabled
                                               value="<?php echo $pre_facrura_array[0] ?>">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <label>Nombre prefactura</label>
                                        <form action="../assets/php/editar_nombre_prefactura.php" method="post">
                                        <input type="hidden" name="id_prefactura" value="<?php echo $id_pre_factura ?>">
                                        <input type="text" name="nombre_prefactura" style="width: 150%"
                                               class="form-control"
                                               value="<?php
						                        		$nombre = select_nombre_empresa_pre_factura($pre_factura);
						                            	echo $nombre;
						                        		?>">
						                        <span class="input-group-btn">
        											<button style="height:34px; position: absolute;" class="btn btn-default" type="submit">Cambiar</button>
      											</span>
      									</form>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Nombre Cliente</label>
                                        <input type="text" name="nombre"
                                               class="form-control" disabled
                                               value="<?php echo $row['nombre_completo'] ?>">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIF</label>
                                        <input type="text" name="NIF"
                                               class="form-control" disabled
                                               value="<?php echo $row['NIF_EMPRESA'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Direcci�n facturaci�n</label>
                                        <input type="text" name="NIF"
                                               class="form-control" disabled
                                               value="<?php echo $row['calle_facturacion'] . " " . $row['numero_facturacion'] . ", " . $row['codigo_postal_facturacion'] . " " . $row['ciudad_facturacion'] ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="header">
                                        <h4 class="title"> Art�culos </h4>
                                    </div>
                                    <div class="row">
                                        <table id="ver_pre_factura_articulos"
                                               class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="background-color: #F26842; width: 3px;">Borrar</th>
                                                <th>Art�culo</th>
                                                <th>N�mero de serie</th>
                                                <th>Precio</th>
                                                <th>Unidades</th>
                                                <th style=" width: 150px ;">Margen</th>
                                                <th style=" width: 50px ;">Precio total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $id_articulos = array();
                                            $data = get_ver_pre_factura_articulos($id_pre_factura);
                                            $_SESSION['id_articulos'] = $id_articulos;

                                            if ($data->num_rows > 0) {
                                                $val = 0;
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    array_push($id_articulos, $row['ID_TRONCO_PRE_FACTURA_ARTICULO']);
                                                    $_SESSION['id_articulos'] = $id_articulos;
                                                    $val++;
                                                    $nombre_articulo = get_nombre_articulo($row['id_articulo_facturado']);
                                                    $suma_precio_total = round($suma_precio_total + $row['precio_total'],2);
                                                    $pk = $row['ID_articulo'];
                                                    $id_articulo_facturado = $row['id_articulo_facturado'];

                                                    ?>
                                                    <tr content="<?php echo $row['ID_TRONCO_PRE_FACTURA_ARTICULO'] ?>"
                                                        id="<?php echo $val ?>">
                                                        <td><label style="width: 100%">
                                                                <center>
                                                                    <button style="width: 100%"
                                                                            class="btn btn-danger"
                                                                            onclick="quitar_articulo_pre_factura(<?php echo "$id_articulo_facturado"; ?>,<?php echo "$pre_facrura_array[0]"; ?>)"><span
                                                                            class="glyphicon glyphicon-trash "></span>
                                                                    </button>
                                                                </center>
                                                            </label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                class="nombre_articulo"><?php echo $nombre_articulo ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                class="numero_de_serie"><?php echo $row['numero_de_serie'] ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php
                                                                                                $precio_unidad= precio_unidad_articulo_facturado($id_articulo_facturado);
                                                                                                $precio_unidad=round($precio_unidad,2);

                                                                                                echo $precio_unidad ?>"
                                                                                                class="precio articulo_precio_val_<?php echo $val ?>"><?php echo $row['precio'] ?></a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php echo $row['cantidad'] ?>"
                                                                                                class="cantidad precio articulo_cantidad_val_<?php echo $val ?>"><?php echo $row['cantidad'] ?></a></label>
                                                        </td>
                                                        <?php
                                                        $margenes = get_margenes();
                                                        $margen_name = 1;
                                                        ?>
                                                        <td>
                                                            <select name="select_box_margenes"
                                                                    class="form-control articulo_select_margen"
                                                                    value="test"
                                                            >
                                                                <option value="" disabled selected>Margen
                                                                    actual = <?php echo $row['margen'] ?>
                                                                </option>
                                                                <?php
                                                                if ($margenes->num_rows > 0) {

                                                                    // output data of each row
                                                                    while ($row_margenes = $margenes->fetch_assoc()) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $row_margenes['m_margen'] ?>"><?php echo $row_margenes['m_margen']; ?></option>
                                                                        <?php

                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>

                                                        <td><label style="margin-top: 11px;">
                                                                <a href="#"
                                                                   name="<?php echo $row['precio_total'] ?>"
                                                                   class="articulo_precio_total_<?php echo $val ?> suma_precio ">
                                                                    <?php echo round($row['precio_total'],2 );?>
                                                                </a>
                                                            </label>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                echo "No hay nada pre-facturado";
                                            }
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="header">
                                        <h4 class="title"> Servicios </h4>
                                    </div>
                                    <div class="row">
                                        <table id="ver_pre_factura_servicios"
                                               class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="background-color: #F26842; width: 3px;">Borrar</th>
                                                <th>Pack</th>
                                                <th>Descripci�n</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th style=" width: 150px ;">Margen</th>
                                                <th style=" width: 50px ;">Precio total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $data = get_ver_pre_factura_servicios($id_pre_factura);
                                            $id_servicios = array();
                                            $_SESSION['id_servicios'] = $id_servicios;

                                            if ($data->num_rows > 0) {


                                                $val = 0;
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    array_push($id_servicios, $row['ID_TRONCO_PRE_FACTURA_SERVICIO']);
                                                    $_SESSION['id_servicios'] = $id_servicios;
                                                    $val++;
                                                    $nombre_pack = get_nombre_servicio_facturado($row['id_servicio_facturado']);
                                                    $descripcion_servicio = get_descripcion_servicio_facturado($row['id_servicio_facturado']);
                                                    $suma_precio_total = round($suma_precio_total + $row['precio_total'],2);
                                                    $id_servicio_facturado = $row['id_servicio_facturado'];

                                                    ?>
                                                    <tr content="<?php echo $row['ID_TRONCO_PRE_FACTURA_SERVICIO'] ?>"
                                                        id="<?php echo $val ?>">
                                                        <td><label style="width: 100%">
                                                                <center>
                                                                    <button style="width: 100%"
                                                                            class="btn btn-danger"
                                                                            onclick="quitar_servicio_pre_factura(<?php echo "$id_servicio_facturado"; ?>,<?php echo "$pre_facrura_array[0]"; ?>)"><span
                                                                            class="glyphicon glyphicon-trash "></span>
                                                                    </button>
                                                                </center>
                                                            </label></td>
                                                        <td><label style="margin-top: 11px;"><a
                                                                    href="#"><?php echo $nombre_pack ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a
                                                                    href="#"><?php echo $descripcion_servicio ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a
                                                                    href="#" name="<?php
                                                                $precio_unidad = precio_unidad_servicio_facturado($id_servicio_facturado);
                                                                $precio_unidad=round($precio_unidad ,2);
                                                                echo $precio_unidad ?>"
                                                                    class="servicio_precio_val_<?php echo $val ?>"><?php echo $row['precio'] ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a
                                                                    href="#" name="<?php echo $row['cantidad'] ?>"
                                                                    class="servicio_cantidad_val_<?php echo $val ?>"><?php echo $row['cantidad'] ?></a></label>
                                                        </td>
                                                        <?php
                                                        $margenes = get_margenes();
                                                        $margen_name = 1;
                                                        ?>
                                                        <td>
                                                            <select name="select_box_margenes"
                                                                    class="form-control servicio_select_margen"
                                                                    value="test"
                                                            >
                                                                <option value="" disabled selected>Margen
                                                                    actual = <?php echo $row['margen'] ?>
                                                                </option>
                                                                <?php
                                                                if ($margenes->num_rows > 0) {

                                                                    // output data of each row
                                                                    while ($row_margenes = $margenes->fetch_assoc()) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $row_margenes['m_margen'] ?>"><?php echo $row_margenes['m_margen']; ?></option>
                                                                        <?php

                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a
                                                                    href="#"
                                                                    name="<?php echo $row['precio_total'] ?>"
                                                                    class="servicio_precio_total_<?php echo $val ?>"><?php echo round($row['precio_total'],2); ?></a></label>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                echo "No hay nada pre-facturado";
                                            }
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="header">
                                        <h4 class="title"> Minutaje </h4>
                                    </div>
                                    <div class="row">
                                        <table id="ver_pre_factura_minutajes"
                                               class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="background-color: #F26842; width: 3px;">Borrar</th>
                                                <th>Servicio</th>
                                                <th>Comentario</th>
                                                <th>Precio/h del servicio</th>
                                                <th>Fecha</th>
                                                <th>Horas</th>
                                                <th style=" width: 150px ;">Margen</th>
                                                <th style=" width: 50px ;">Precio total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $data = get_ver_pre_factura_minutajes($id_pre_factura);
                                            $id_minutaje = array();
                                            $_SESSION['id_minutaje'] = $id_minutaje;
                                            if ($data->num_rows > 0) {


                                                $val = 0;
                                                $i = 0;
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    array_push($id_minutaje, $row['ID_TRONCO_PRE_FACTURA_MINUTAJE']);
                                                    $_SESSION['id_minutaje'] = $id_minutaje;
                                                    $val++;
                                                    $nombre_servicio = get_nombre_servicio($row['ID_servicio']);
                                                    $suma_precio_total = round($suma_precio_total + $row['precio_total'],2);
                                                    $id_minutaje_facturado = $row['id_minutaje_facturado'];
                                                    $ID_servicio= $row['ID_servicio'];

                                                    ?>
                                                    <tr content="<?php echo $row['ID_TRONCO_PRE_FACTURA_MINUTAJE'] ?>"
                                                        id="<?php echo $val ?>">
                                                        <td><label style="width: 100%">
                                                                <center>
                                                                    <button style="width: 100%"
                                                                            class="btn btn-danger"
                                                                            onclick="quitar_minutaje_pre_factura(<?php echo "$id_minutaje_facturado"; ?>,<?php echo "$pre_facrura_array[0]"; ?>)"><span
                                                                            class="glyphicon glyphicon-trash "></span>
                                                                    </button>
                                                                </center>
                                                            </label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                class="nombre_servicio"><?php echo $nombre_servicio ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                class="comentario"><?php echo $row['comentario'] ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php
                                                                                                $precio_unidad = get_precio_servicio($ID_servicio);
                                                                                                $precio_unidad=round($precio_unidad ,2);
                                                                                                echo $precio_unidad ?>"

                                                                                                class="precio_h_servicio minutaje_precio_val_<?php echo $val ?>"><?php echo $row['precio_servicio'] ?> </a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                class="fecha"><?php echo $row['fecha'] ?></a></label>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php echo $row['horas'] ?>"
                                                                                                class="horas minutaje_horas_val_<?php echo $val ?>"><?php echo $row['horas'] ?></a></label>
                                                        </td>
                                                        <?php
                                                        $margenes = get_margenes();
                                                        $margen_name = 1;
                                                        ?>
                                                        <td>
                                                            <select name="select_box_margenes"
                                                                    class="form-control minutaje_select_margen"
                                                                    value="test"
                                                            >
                                                                <option value="" disabled selected>Margen
                                                                    actual = <?php echo $row['margen'] ?>
                                                                </option>
                                                                <?php
                                                                if ($margenes->num_rows > 0) {

                                                                    // output data of each row
                                                                    while ($row_margenes = $margenes->fetch_assoc()) {
                                                                        ?>
                                                                        <option
                                                                                value="<?php echo $row_margenes['m_margen'] ?>"><?php echo $row_margenes['m_margen']; ?></option>
                                                                        <?php

                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php echo $row['precio_total'] ?>"
                                                                                                class="precio_total minutaje_precio_total_<?php echo $val ?>"
                                                                ><?php echo round($row['precio_total'],2); ?></a></label>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                echo "No hay nada pre-facturado";
                                            }
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <form id="crear_factura" method="post">
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-9">
                                                <div class="form-group">
                                                    <label>Precio sin IVA</label>
                                                    <input name="precio_sin_iva"
                                                           class="form-control precio_sin_iva" readonly
                                                           value="<?php echo round($suma_precio_total,2); ?>">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="id_pre_factura"
                                                   value="<?php echo $id_pre_factura ?>">
                                            <div class="col-md-3 col-md-offset-6">
                                                <div class="form-group">
                                                    <label>IVA</label>
                                                    <?php $data = select_all_iva(); ?>
                                                    <select name="select_box_iva" class="form-control select_iva"
                                                            required>

                                                        <?php
                                                        if ($data->num_rows > 0) {
                                                            // output data of each row
                                                            while ($row = $data->fetch_assoc()) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $row['IVA'] ?>"><?php echo "$row[IVA]"; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-bottom: 20px;">
                                                <div class="form-group">
                                                    <label>Precio con IVA</label>
                                                    <input name="precio_con_iva"
                                                           class="form-control precio_con_iva_value" readonly
                                                           value="<?php echo round($suma_precio_total,2); ?>" required>
                                                </div>
                                            </div>

                                            <div id="anadirComentario" style="float:left">
                                                <div class="form-group">
                                                    <a onclick='anadirComentario();' class="btn btn-success btn-default" style="cursor:pointer">A�adir comentario <span class="glyphicon glyphicon-plus"></span></a>
                                                </div>
                                            </div>

                                            <div id="eliminarComentario" style="float:left">
                                                <div class="form-group">
                                                    <a onclick='eliminarComentario();' class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-remove"></span></a>
                                                </div>
                                            </div>

                                            <div id="subirComentario" style="float:left; margin-left: 8px;">
                                                <div class="form-group">
                                                    <a onclick="enviarComentario($('#comentario').val(), $('#id_pre_factura').val());return false;" class="btn btn-info btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-open"></span></a>
                                                </div>
                                            </div>



                                            <?php
                                                $comentarioPrefactura = select_comentario_prefactura($id_pre_factura);
                                                if($comentarioPrefactura==""){
                                                    ?>
                                                    <script>
                                                        $("#comentarioPrefactura").hide();
                                                        $("#anadirComentario").hide();
                                                        $("#eliminarComentario").hide();
                                                        $("#subirComentario").hide();
                                                    </script>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <script>
                                                        $("#comentarioPrefactura").hide();
                                                        $("#anadirComentario").hide();
                                                        $("#eliminarComentario").hide();
                                                        $("#subirComentario").hide();
                                                    </script>
                                                    <?php
                                                }
                                            ?>

                                                <textarea id="comentario" name="comentario"><?php echo $comentarioPrefactura ?></textarea>
                                                <input type="hidden" name="comentarioSiNo" id="comentarioSiNo" value="0">

                                            <style>
                                            #comentario{
                                                width: 80%;
                                                height: 150px;
                                                margin-left:16px;
                                                margin-bottom:26px;
                                                float:left;
                                                border-radius: 0px 20px 20px 20px;
                                                -moz-border-radius: 0px 20px 20px 20px;
                                                -webkit-border-radius: 0px 20px 20px 20px;
                                                border: 1px solid #333;
                                                color: black;
                                                font-family: Arial;
                                                font-size:14px;
                                                padding-left:10px;
                                            }
                                            </style>



                                            <script>

                                            $("#comentario").hide();

                                            function anadirComentario(){
                                                $("#comentario").slideDown("slow");
                                                $("#anadirComentario").hide();
                                                $("#subirComentario").show();
                                                $("#editarComentario").hide();
                                                $("#comentarioPrefactura").hide();
                                                $("#tituloComentario").hide();
                                                $("#eliminarComentario").show();
                                                $("#comentarioSiNo").attr("value","1");
                                            }

                                            function editarComentario(){
                                                $("#comentario").slideDown("slow");
                                                $("#anadirComentario").hide();
                                                $("#subirComentario").show();
                                                $("#editarComentario").hide();
                                                $("#tituloComentario").hide();
                                                $("#comentarioPrefactura").hide();
                                                $("#eliminarComentario").hide();
                                                $("#comentarioSiNo").attr("value","1");
                                            }

                                            function eliminarComentario(){
                                                $("#comentario").slideUp("slow");
                                                $("#anadirComentario").show();
                                                $("#subirComentario").hide();
                                                $("#editarComentario").hide();
                                                $("#tituloComentario").hide();
                                                $("#comentarioPrefactura").hide();
                                                $("#eliminarComentario").hide();
                                                $("#comentarioSiNo").attr("value","0");
                                            }

                                            </script>

                                            <script>
                                            function enviarComentario(comentario,id_pre_factura){
                                                    var parametros = {
                                                            "comentario" : comentario,
                                                            "ID_PRE_FACTURA" : id_pre_factura
                                                    };
                                                    $.ajax({
                                                            data:  parametros,
                                                            url:   'enviar_comentario.php',
                                                            type:  'post',
                                                            beforeSend: function () {
                                                                    //$("#resultado").html("Procesando, espere por favor...");
                                                            },
                                                            success:  function (response) {
                                                                    //$("#resultado").html(response);

                                                                $("#comentario").hide();
                                                                $("#anadirComentario").hide();
                                                                $("#subirComentario").hide();
                                                                $("#eliminarComentario").hide();
                                                                $("#editarComentario").show();
                                                                $("#tituloComentario").show();
                                                                $("#comentarioPrefactura").show();
                                                                $("#comentarioPrefactura").attr("value",response);
                                                                $("#comentarioSiNo").attr("value","1");
                                                            }
                                                    });
                                            }
                                            </script>

                                            <input type="hidden" name="caja_texto" id="id_pre_factura" value="<?php echo $id_pre_factura ?>"/>

                                            <br/>

                                            <div id="tituloComentario" style="font: bold 150% sans-serif;">Comentarios: </div>
                                                <input type="hidden" value="<?php echo $comentarioPrefactura ?>" required/>
                                                <input style="border: 0; margin-top:5px; margin-bottom:10px;" type="text" name="comentarioPrefactura" id="comentarioPrefactura" value="<?php echo $comentarioPrefactura ?>" disabled/>

                                            <div id="editarComentario">
                                                <div class="form-group">
                                                    <a onclick='editarComentario();' class="btn btn-primary btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-edit"></span></a>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button name="submit" class="factura_pre_factura" type="submit" onclick='this.form.action="seleccionar_fecha_factura.php"'>
                                                        Facturar
                                                    </button>
                                                </div>
                                            </div>

                                            <!--<div class="col-md-12">
                                                <div class="form-group">
                                                    <button name="submit" class="factura_pre_factura" type="submit" onclick='this.form.action="seleccionar_fecha_factura_correo.php"'>
                                                        Facturar y enviar correo
                                                    </button>
                                                </div>
                                            </div>-->

                                    </form>


                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button onclick="borrar_pre_factura(<?php echo $pre_facrura_array[0] ?>)" style="background: rgb(242, 104, 66);cursor: pointer;width: 100%;border: none; color: #FFF;margin: 0 0 5px;padding: 10px;font-size: 15px;">
                                            Eliminar la pre-factura
                                        </button>
                                    </div>
                                </div>
                            </div>
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
