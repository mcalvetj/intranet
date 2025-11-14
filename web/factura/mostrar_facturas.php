<!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
include('../assets/php/functions.php');
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
    <?php include('../assets/librerias/librerias_globales_buscador.html'); ?>
    <!--EDITOR DE TABLAS-->
    <?php
    if ($_SESSION["user_rol"] <= 1) {
        //<!--COLUMNAS QUE PUEDEN SER MODIFICADAS-->
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_usuario.js\"></script>";
    }
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?>
    <script src="../assets/js/scripts.js"></script>
    <script type="text/javascript" src="../assets/js/selected_row.js"></script>

</head>
<body>

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
                    document.getElementById("menu_factura").className = "active";

                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_factura {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_factura1 {
                        margin-left: 15%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
        	<form method="POST" id="send_facturas" action="download_facturas.php">
                <input type="hidden" id="id_string" name="id_string" value="">
                <input style="display:none" type="submit" value="submit" id="buttonId"/>
            </form>
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
                    <a class="navbar-brand">Facturas</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <table id="buscador_facturas" class="table table-striped table-bordered">
                        <?php
                        if(!isset($_POST['select_box_nif_empresa'])){
                            $_POST['select_box_nif_empresa']="NULL";
                          }
                          if(!isset($_POST['numero_factura'])){
                            $_POST['numero_factura']="NULL";
                          }
                          if(!isset($_POST['fecha_1'])){
                            $_POST['fecha_1']="NULL";
                          }
                          if(!isset($_POST['fecha_2'])){
                            $_POST['fecha_2']="NULL";
                          }
                        $nif_cliente = $_POST['select_box_nif_empresa'];
                        $numero_factura = $_POST['numero_factura'];
                        $fecha_desde = $_POST['fecha_1'];
                        $fecha_hasta = $_POST['fecha_2'];
                        $data= buscador_de_facturas($nif_cliente, $numero_factura, $fecha_desde, $fecha_hasta);
                        $year=date("Y");
                        $year=substr( $year, -2 );
                        ?>

                        <thead>
                        <tr>
                            <th style="background-color: #39AF33; width: 3px;">Cobrado</th>
                            <th>N�mero</th>
                            <th>Comentario</th>
                            <th>Envio al cliente</th>
                            <th>Enviar</th>
                            <th>Enviar con texto</th>
                            <th>NIF del cliente</th>
                            <th>Fecha facturacion</th>
                            <th>Importe sin IVA</th>
                            <th>Visualizar</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if ($data->num_rows > 0) {
                        	$i = 0;
                            // output data of each row
                            while ($row = $data->fetch_assoc()) {
                                $pk = $row['ID_factura'];
                                $i++;
                                $div = "div" . $i;
                                $fechaFactura = select_fecha_factura($row['ID_factura']);
                                $anyo = substr($fechaFactura, 2, 2);
                                $cobrado=cobrado_factura($row['ID_factura']);
                                $idFactura=$row['ID_factura'];
                                ?>
                                <tr id="<?php echo "$div"; ?>" value="<?php echo "$pk"; ?>">
                                <?php checkbox_factura($cobrado,$idFactura);?>
                                    <td><label style="margin-top: 11px;"><a href="#" class="N_factura"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php echo $row['ID_factura'] ?> </a></label>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a>
                                        <?php
                                            $comentario = select_comentario_factura($row['ID_factura']);
                                            echo $comentario;
                                        ?>
                                        </label></a>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a>
                                        <?php
                                            $envios_correos = select_fecha_envio_correo($row['ID_factura']);
                                            echo $envios_correos;
                                        ?>
                                        </label></a>
                                    </td>
                                    <?php
                                        $nifCliente = select_nif_cliente_factura($row['ID_factura']);
                                        $correoClienteFactura = select_correo_cliente_factura($nifCliente);
                                    ?>
                                    <td><a onclick='enviarFactura(<?php echo $row['ID_factura'] ?>,"<?php echo $correoClienteFactura ?>")' data-toggle="modal" data-target="#myModal1" class="btn" style="cursor:pointer; margin-left: 20%; background:#ef7d1f; color:black"><span class="glyphicon glyphicon-share"></span></a></td>

                                    <!--
                                    <script>
                                        function enviarFactura(id,correo){

                                        swal({
                                          title: "Enviar factura a:",
                                          text: "",
                                          type: "input",
                                          showCancelButton: true,
                                          closeOnConfirm: false,
                                          animation: "slide-from-top",
                                          inputPlaceholder: correo,
                                          inputValue: correo
                                        },
                                        function(inputValue){
                                          if (inputValue === false) return false;

                                          if (inputValue === "") {
                                            swal.showInputError("Tienes que escribir algun correo!");
                                            return false
                                          }

                                          expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                                          if ( !expr.test(inputValue) ){
                                            swal.showInputError("Tienes que escribir un correo valido!");
                                          }else{
                                            window.location.href ="enviarFactura.php?id="+id+"&email="+inputValue;
                                          }

                                        });

                                        }
                                    </script>
                                    -->

                                    <script>
                                        function enviarFactura(id,correo){

                                            $("#id1").val(id);
                                             $("#correoContactoModal1").val(correo);

                                        }
                                    </script>

                                    <td><a disabled onclick='enviarFactura2(<?php echo $row['ID_factura'] ?>,"<?php echo $correoClienteFactura ?>")' data-toggle="modal" data-target="#myModal2" class="btn" style="cursor:pointer; margin-left: 20%; background:#ef7d1f; color:black"><span class="glyphicon glyphicon-envelope"></span></a></td>

                                    <script>
                                        function enviarFactura2(id,correo){

                                            $("#id2").val(id);
                                             $("#correoContactoModal2").val(correo);

                                        }
                                    </script>

                                    <td><label style="margin-top: 11px;"><a href="#" class="NIF_cliente"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php
                                                $nombre_empresa=get_nombre_empresa($row['NIF_cliente']);

                                                echo $row['NIF_cliente']." - ".$nombre_empresa ?> </a></label>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a href="#" class="fecha_facturacion"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php
                                                $datetime = explode(" ", $row['fecha_factura']);
                                                $fecha_factura = $datetime[0];
                                                echo $fecha_factura;
                                                ?> </a></label>
                                    </td>
                                    <td><label style="margin-top: 11px;"><a href="#" class="importe_sin_iva"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><?php
                                                $importe_sin_iva=get_importe_sin_iva($row['ID_factura']);

                                                echo $importe_sin_iva ?> </a></label>
                                    </td>
                                    <!--<td><label style="margin-left:35%"><a class="btn" style="background:#333; color:white" download="" href="../factura_pdf/<?php echo $anyo."_".$row['ID_factura'].".pdf"?>" class="factura_pdf"
                                                                            data-pk=<?php echo "\"$pk\""; ?>><span class="glyphicon glyphicon-floppy-save"></span></a></label>
                                    </td>-->
                                    <td><label style="margin-left:30%">
                                    <?php
                                        $fechaFactura = select_fecha_factura($row['ID_factura']);
                                        $anyo=substr( $fechaFactura, 0, 4 );
                                        $mes=substr( $fechaFactura, 5, 2 );

                                        $factura=$anyo.'/'.$mes.'/'.$row['ID_factura'];
                                    ?>
                                    <a onclick="abrirPopupFactura('<?php echo $anyo.'/'.$mes.'/'.$row['ID_factura'].".pdf"?>')" class="btn" style="background:#333; color:white"><span class="glyphicon glyphicon-eye-open"></span>
                                    </a></label>
                                    </td>

                                    <script>
                                    function abrirPopupFactura(factura) {
                                        window.open("../factura_pdf/"+factura, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=-1300,width=1000,height=700");
                                    }
                                    </script>

                                </tr>

                                <?php
                            }
                        } else {
                            echo "No se han encontrado facturas";
                        }
                        ?>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>


    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModalEnviarFechas" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
      <form action="download_facturas_fechas.php" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Descargar facturas</h4>
        </div>
        <div class="modal-body">
          <p>Selecciona el periodo de fechas</p>
        </div>

        <center>
        <fieldset>
            Seleccionar fecha: Desde/Hasta
            <br>
            <input name="fecha_1" type="date">
            <input name="fecha_2" type="date">
        </fieldset>
        </center>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Descargar</button>
        </div>
        </form>
      </div>

    </div>
  </div>



<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enviar factura</h4>
      </div>
      <div class="modal-body">
      <center>
        <form action="../assets/php/correo/index.php" method="post">
        <input type="hidden" name="id" id="id1">
        <input type="hidden" id="totalCorreos" value="0" name="totalCorreos">
        <p>Correo predeterminado</p>
            <fieldset>
                <input placeholder="Correo*" id="correoContactoModal1" name="correo" type="email" style="height: 34px;width: 270px;padding: 6px 12px;font-size: 14px;" required>
            </fieldset>
        </br>
        <!--<p href="#" id="mascampos2" style="background: #ea8f43; border: none;  color: #FFF; margin: 0 0 5px; padding: 10px; font-size: 15px; cursor: pointer; width: 270px;"><span class="glyphicon glyphicon-plus"></span></p>-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn" style="background:#ef7d1f; color:black">Enviar</button>
        </div>
        </button>

        </form>
      </center>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enviar factura</h4>
      </div>
      <div class="modal-body">
      <center>
        <form action="enviarFacturaTexto.php" method="post">
        <input type="hidden" name="id" id="id2">
        <p>Correo</p>
            <fieldset>
                <input placeholder="Correo*" id="correoContactoModal2" name="correo" type="email" style="height: 34px;width: 200px;padding: 6px 12px;font-size: 14px;" required>
            </fieldset>
        </br>
        <p>Texto</p>
            <fieldset>
                <textarea name="texto" type="text" style="height: 200px; width: 200px; overflow-y: visible" required></textarea>
            </fieldset>
            </br>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn" style="background:#ef7d1f; color:black">Enviar</button>
        </div>
        </button>

        </form>
      </center>
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
