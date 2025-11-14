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
    <link rel="icon"
          type="image/png"
          href="../assets/img/favicon.ico">
    <meta
            content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'
            name='viewport'/>
    <metaname
    = "viewport" content = "width=device-width"/>

    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('../assets/librerias/librerias_globales_pre_factura.html'); ?>

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

if ($_GET['ok'] == 'eliminarProducto') {
    ?>
    <script>
        swal({
            title: "Eliminación de producto completada!",
            text: "",
            type: "success",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
if ($_GET['error'] == 'eliminarProducto') {
    ?>
    <script>
        swal({
            title: "Error",
            text: "El producto no se ha podido eliminar",
            type: "error",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
    <?php
}
?>

<?php

if ($_GET['ok'] == 'updateComentario') {
    ?>
    <script>
        swal({
            title: "Comentario guardado",
            text: "",
            type: "success",
            showConfirmButton: false,
            timer: 1000
        })
    </script>
    <?php
}
if ($_GET['error'] == 'updateComentario') {
    ?>
    <script>
        swal({
            title: "Error",
            text: "Error al guardar el comentario",
            type: "error",
            showConfirmButton: false,
            timer: 1000
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
                    document.getElementById("menu_presupuesto").className = "active";
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

        if ($_POST['select_box_presupuesto_cliente'] != null) {
            $presupuesto = $_POST['select_box_presupuesto_cliente'];
            $presupuesto_array = explode('-', $presupuesto);
            $id_presupuesto = $presupuesto_array[0];
            $nombre = $presupuesto_array[1];

        } else {
            $id_presupuesto = $_GET['id'];

        }
        $nif_empresa = select_nif_empresa_presupuesto($id_presupuesto);
        $comentario = get_comentario_presupuesto($id_presupuesto);


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
                    <!--TITULO DE LA PÁGINA-->
                    <a class="navbar-brand">Ver pre-factura:
                        <?php
                        if ($_POST['select_box_pre_factura_cliente'] != null) {
                            echo $id_presupuesto . " - " . $nombre;
                        } else {
                            $nombre = select_nombre_presupuesto($id_presupuesto);
                            echo $id_presupuesto . " - " . $nombre;
                        }
                        ?>
                    </a>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Núm presupuesto </label>
                                        <input type="text" name="num_pre_factura"
                                               class="form-control" id="id_presupuesto" disabled
                                               value="<?php echo $id_presupuesto ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre Cliente</label>
                                        <input type="text" name="nombre"
                                               class="form-control" disabled
                                               value="<?php echo $row['nombre_completo'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>NIF</label>
                                        <input type="text" name="NIF"
                                               class="form-control" disabled
                                               value="<?php echo $row['NIF_EMPRESA'] ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección facturación</label>
                                        <input type="text" name="NIF"
                                               class="form-control" disabled
                                               value="<?php echo $row['calle_facturacion'] . " " . $row['numero_facturacion'] . ", " . $row['codigo_postal_facturacion'] . " " . $row['ciudad_facturacion'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Comentario</label>
                                        <input type="text" name="comentario"
                                               class="form-control col-md-12"
                                               value="<?php echo $comentario ?>">
                                    </div>
                                </div>
                                <script>
                                    $('input[name=comentario]').change(function() {
                                        var comentario= $('input[name=comentario]').val();
                                        var id_presupuesto = $('#id_presupuesto').val();

                                        $.ajax({
                                            type: 'post',
                                            url: '../assets/php/presupuesto/update_comentario_presupuesto.php',
                                            data: {
                                                comentario: comentario,
                                                id_presupuesto: id_presupuesto,

                                            }
                                        });
                                        alert("Comenatrio guardado");
                                    });
                                </script>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="row">
                                        <table id="ver_presupuesto"
                                               class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="background-color: #F26842; width: 3px;">Borrar</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Margen</th>
                                                <th style=" width: 50px ;">Precio total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $id_articulos = array();
                                            $data = get_ver_productos_presupuesto($id_presupuesto);

                                            if ($data->num_rows > 0) {
                                                $val = 0;
                                                // output data of each row
                                                while ($row = $data->fetch_assoc()) {
                                                    $val++;

                                                    ?>
                                                    <tr content="<?php echo $row['ID_TRONCO_PRESUPUESTO'] ?>"
                                                        id="<?php echo $val ?>">
                                                        <td><label style="width: 100%">
                                                                <center>
                                                                    <button style="width: 100%"
                                                                            class="btn btn-danger"
                                                                            onclick="quitar_producto_presupuesto(<?php echo $row['ID_TRONCO_PRESUPUESTO']; ?>, <?php echo $row['ID_presupuesto']; ?>)"><span
                                                                                class="glyphicon glyphicon-trash "></span>
                                                                    </button>
                                                                </center>
                                                            </label></td>
                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                class="descripcion"><?php echo $row['descripcion'] ?> </a></label>
                                                        </td>

                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php echo $row['cantidad'] ?>"
                                                                                                class="cantidad precio producto_cantidad_val_<?php echo $val ?>"><?php echo $row['cantidad'] ?></a></label>
                                                        </td>
                                                        <?php
                                                        $precio_original = $row['precio'] / $row['margen'];
                                                        $precio_original = round($precio_original, 2);
                                                        ?>

                                                        <td><label style="margin-top: 11px;"><a href="#"
                                                                                                name="<?php echo $precio_original ?>"
                                                                                                class="precio_unidad  producto_precio_val_<?php echo $val ?>"><?php echo $row['precio'] ?></a></label>
                                                        </td>
                                                        <?php
                                                        $margenes = get_margenes();
                                                        $margen_name = 1;
                                                        ?>
                                                        <td>
                                                            <select name="select_box_margenes"
                                                                    class="form-control producto_select_margen"
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
                                                                   class="producto_precio_total_<?php echo $val ?> suma_precio ">
                                                                    <?php echo $row['precio_total'] ?>
                                                                </a>
                                                            </label>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                echo "No hay nada en el presupuesto, introduzca los productos";
                                            }
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-md-offset-1">
                                    <button style="background: rgb(255, 118, 0);cursor: pointer;width: 100%;border: none; color: #FFF;margin: 0 0 5px;padding: 10px;font-size: 15px;"
                                            onclick="add_presupuesto_btn(<?php echo $id_presupuesto; ?>)">Añadir
                                        productos
                                        al presupuesto
                                    </button>
                                </div>
                            </div>
                            <?php
                            $data_pie_presupuesto = select_pie_presupuesto($id_presupuesto);

                            if ($data_pie_presupuesto->num_rows > 0) {
                                // output data of each row
                                while ($row = $data_pie_presupuesto->fetch_assoc()) {
                                    ?>


                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-9">
                                            <div class="form-group">
                                                <label>Precio sin IVA</label>
                                                <input name="precio_sin_iva"
                                                       class="form-control precio_sin_iva" readonly
                                                       value="<?php echo $row['total_neto'] ?>">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-7">
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
                                        <div class="col-md-2" style="margin-bottom: 20px;">
                                            <div class="form-group">
                                                <label>Precio con IVA</label>
                                                <input name="precio_con_iva"
                                                       class="form-control precio_con_iva_value" readonly
                                                       value="<?php echo $row['total_facturado'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            ?>
                            <div class="row">
                                <form id="crear_pdf_presupuesto" method="post">
                                    <div class="col-md-3 col-md-offset-1">
                                        <div class="form-group">
                                            <button name="id_presupuesto" value="<?php echo $id_presupuesto; ?>"
                                                    class="factura_pre_factura" type="submit"
                                                    onclick='this.form.action="../assets/php/presupuesto/generar_presupuesto_pdf.php"'>
                                                Imprimir presupuesto
                                            </button>
                                        </div>
                                    </div>
                                </form>
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


</div>
</div>

</body>
<script>
    function add_presupuesto_btn(id_presupuesto) {
        document.location.href = 'add_material_presupuesto.php?id=' + id_presupuesto;
    }

    $('.producto_select_margen').on('change', function () {
        var margen = ( this.value );
        var relacion = $(this).closest('tr').attr('id');
        var id_tronco_presupuesto = $(this).closest('tr').attr('content');
        var classe_precio = "producto_precio_val_" + relacion;
        var classe_cantidad = "producto_cantidad_val_" + relacion;
        var classe_precio_total = "producto_precio_total_" + relacion;
        var val_precio = $('.' + classe_precio).attr('name');
        var val_cantidad = $('.' + classe_cantidad).attr('name');
        var val_precio_anterior = $('.' + classe_precio_total).attr('name');
        var precio_con_margen = margen * (val_precio * val_cantidad);
        precio_con_margen = precio_con_margen.toFixed(2);
        var precio_unidad_con_margen = margen * val_precio;
        precio_unidad_con_margen = precio_unidad_con_margen.toFixed(2);
        $('.' + classe_precio).text(precio_unidad_con_margen);
        $('.' + classe_precio_total).attr('name', precio_con_margen);
        $('.' + classe_precio_total).text(precio_con_margen);
        var diferencia_de_precio = precio_con_margen - val_precio_anterior;
        var precio_sin_iva = $('.precio_sin_iva').val();
        var precio_total_presupuesto_sin_iva = (parseFloat(precio_sin_iva) + (parseFloat(diferencia_de_precio)));
        precio_total_presupuesto_sin_iva = precio_total_presupuesto_sin_iva.toFixed(2);
        $('.precio_sin_iva').val(precio_total_presupuesto_sin_iva);
        /*ACTUALIZAMOS EL PRECIO CON IVA*/
        var iva_val = $(".select_iva option:selected").val();
        var iva = parseFloat(iva_val) / 100;
        var precio_total_presupuesto_con_iva = (parseFloat(precio_total_presupuesto_sin_iva) + (parseFloat(precio_total_presupuesto_sin_iva) * iva));
        precio_total_presupuesto_con_iva = precio_total_presupuesto_con_iva.toFixed(2);
        $('.precio_con_iva_value').val(precio_total_presupuesto_con_iva);
        var id_presupuesto = $('#id_presupuesto').val();

        $.ajax({
            type: 'post',
            url: '../assets/php/update_table/aplicar_margen.php',
            data: {
                id_tronco_pre_factura: id_tronco_presupuesto,
                precio_con_margen: precio_con_margen,
                precio_unidad_con_margen: precio_unidad_con_margen,
                margen: margen,
                id_presupuesto: id_presupuesto,


                para: "presupuesto",

                total_sin_iva: precio_total_presupuesto_sin_iva,
                iva: iva_val,
                total_con_iva: precio_total_presupuesto_con_iva,
            }
        });

    })
</script>
</html>

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>