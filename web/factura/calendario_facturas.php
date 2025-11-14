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
                    document.getElementById("menu_facturaa").className = "active";
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

                    #menu_ver_factura1 {
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
                    <?php
                    $data = get_all_cabecera_factura();
                    $contador = 0;
                    if ($data->num_rows > 0) {
                        $i = 0;
                        $arrayphp_fecha_factura = array();
                        $arrayphp_precio_sin_iva = array();
                        $arrayphp_nombre_cliente = array();

                        while ($row = $data->fetch_assoc()) {

                            $ID_factura = $row['ID_factura'];
                            $NIF_cliente = $row['NIF_cliente'];
                            $fecha_factura = $row['fecha_factura'];

                            //get fecha
                            $splitTimeStamp = explode(" ", $fecha_factura);
                            $fecha_factura = $splitTimeStamp[0];

                            //get nombre cliente
                            $nombre_cliente = select_nombre_cliente($NIF_cliente);

                            //eliminar acentos clientes
                            //Codificamos la cadena en formato utf8 en caso de que nos de errores
                            $nombre_cliente = utf8_encode($nombre_cliente);

                            //Ahora reemplazamos las letras
                            $nombre_cliente = str_replace(
                                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                                $nombre_cliente
                            );

                            $nombre_cliente = str_replace(
                                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                                $nombre_cliente);

                            $nombre_cliente = str_replace(
                                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                                $nombre_cliente);

                            $nombre_cliente = str_replace(
                                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                                $nombre_cliente);

                            $nombre_cliente = str_replace(
                                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                                $nombre_cliente);

                            $nombre_cliente = str_replace(
                                array('ñ', 'Ñ', 'ç', 'Ç'),
                                array('n', 'N', 'c', 'C'),
                                $nombre_cliente
                            );

                            //get precio sin iva
                            $precio_sin_iva = get_importe_sin_iva($ID_factura);

                            //añadir a arrays
                            array_push($arrayphp_fecha_factura, $fecha_factura);
                            array_push($arrayphp_nombre_cliente, $nombre_cliente);
                            array_push($arrayphp_precio_sin_iva, $precio_sin_iva);

                            /*echo "$contador $nombre_cliente <br>";*/
                            $contador++;
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                    <script>
                        var arrayjavascript_nombre_cliente = <?php echo json_encode($arrayphp_nombre_cliente) ?>;

                        var arrayjavascript_fecha_factura = <?php echo json_encode($arrayphp_fecha_factura) ?>;

                        var arrayjavascript_precio_sin_iva = <?php echo json_encode($arrayphp_precio_sin_iva) ?>;

                        var contador = <?php echo json_encode($contador) ?>;

                    </script>


                    <div class="container theme-showcase">
                        <div id="holder" class="row"></div>
                    </div>


                    <script type="text/tmpl" id="tmpl">
  {{
  var date = date || new Date(),
      month = date.getMonth(),
      year = date.getFullYear(),
      first = new Date(year, month, 1),
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(),
      thedate = new Date(year, month, 1 - startingDay),
      dayclass = lastmonthcss,
      today = new Date(),
      i, j;
  if (mode === 'week') {
    thedate = new Date(date);
    thedate.setDate(date.getDate() - date.getDay());
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(last.getDate()+6);
  } else if (mode === 'day') {
    thedate = new Date(date);
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(thedate.getDate() + 1);
  }

  }}
  <table class="calendar-table table table-condensed table-tight">
    <thead>
      <tr>
        <td colspan="7" style="text-align: center">
          <table style="white-space: nowrap; width: 100%">
            <tr>
              <td style="text-align: left;">
                <span class="btn-group">
                  <button class="js-cal-prev btn btn-default">&lt;</button>
                  <button class="js-cal-next btn btn-default">&gt;</button>
                </span>
                <button class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
              </td>
              <td>
                <span class="btn-group btn-group-lg">
                  {{ if (mode !== 'day') { }}
                    {{ if (mode === 'month') { }}<button class="js-cal-option btn btn-link" data-mode="year">{{: months[month] }}</button>{{ } }}
                    {{ if (mode ==='week') { }}
                      <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
                    {{ } }}
                    <button class="js-cal-years btn btn-link">{{: year}}</button>
                  {{ } else { }}
                    <button class="btn btn-link disabled">{{: date.toDateString() }}</button>
                  {{ } }}
                </span>
              </td>
              <td style="text-align: right">
                <span class="btn-group">
                  <button class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">Year</button>
                  <button class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">Month</button>
                  <button class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">Week</button>
                  <button class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day">Day</button>
                </span>
              </td>
            </tr>
          </table>

        </td>
      </tr>
    </thead>
    {{ if (mode ==='year') {
      month = 0;
    }}
    <tbody>
      {{ for (j = 0; j < 3; j++) { }}
      <tr>
        {{ for (i = 0; i < 4; i++) { }}
        <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
          {{: months[month] }}
          {{ month++;}}
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
    {{ if (mode ==='month' || mode ==='week') { }}
    <thead>
      <tr class="c-weeks">
        {{ for (i = 0; i < 7; i++) { }}
          <th class="c-name">
            {{: days[i] }}
          </th>
        {{ } }}
      </tr>
    </thead>
    <tbody>
      {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
      <tr>
        {{ for (i = 0; i < 7; i++) { }}
        {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
          <div class="date">{{: thedate.getDate() }}</div>
          {{ thedate.setDate(thedate.getDate() + 1);}}
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
    {{ if (mode ==='day') { }}
    <tbody>
      <tr>
        <td colspan="7">
          <table class="table table-striped table-condensed table-tight-vert" >
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="timetitle" >All Day</th>
                <td class="{{: date.toDateCssClass() }}">  </td>
              </tr>
              <tr>
                <th class="timetitle" >Before 6 AM</th>
                <td class="time-0-0"> </td>
              </tr>
              {{for (i = 6; i < 22; i++) { }}
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-0"> </td>
              </tr>
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }}:30 {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-30"> </td>
              </tr>
              {{ } }}
              <tr>
                <th class="timetitle" >After 10 PM</th>
                <td class="time-22-0"> </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
    {{ } }}
  </table>

                    </script>
                    <!--LIBRERIAS CALENDARIO-->
                    <link href="css/style.css" rel="stylesheet"/>
                    <script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
                    <script src="js/index.js"></script>

                    <script>

                        document.getElementById("test").style.color="black";
                        document.getElementsByClassName("").style.color="black";

                    </script>



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
                    <form action="enviarFactura.php" method="post">
                        <input type="hidden" name="id" id="id1">
                        <input type="hidden" id="totalCorreos" value="0" name="totalCorreos">
                        <p>Correo predeterminado</p>
                        <fieldset>
                            <input placeholder="Correo*" id="correoContactoModal1" name="correo" type="email"
                                   style="height: 34px;width: 270px;padding: 6px 12px;font-size: 14px;" required>
                        </fieldset>
                        </br>
                        <p href="#" id="mascampos2"
                           style="background: #ea8f43; border: none;  color: #FFF; margin: 0 0 5px; padding: 10px; font-size: 15px; cursor: pointer; width: 270px;">
                            <span class="glyphicon glyphicon-plus"></span></p>
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
                            <input placeholder="Correo*" id="correoContactoModal2" name="correo" type="email"
                                   style="height: 34px;width: 200px;padding: 6px 12px;font-size: 14px;" required>
                        </fieldset>
                        </br>
                        <p>Texto</p>
                        <fieldset>
                            <textarea name="texto" type="text" style="height: 200px; width: 200px; overflow-y: visible"
                                      required></textarea>
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