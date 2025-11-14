<?php
include('../../../php/db.php');
include('../../../php/selects.php');
require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

ob_start();



?>
    <html>
    <head>
        <meta charset="ISO-8859-1">
        <style>
            @font-face {
                font-family: "AgfaRotisSemiSerif";
                src: url('/assets/fonts/AgfaRotisSemiSerif.ttf');

            }

            @page {
                size: A4;
                margin-left: 15px;
                margin-right: 15px;
                margin-top: 15%;
                margin-bottom: 15%;

            }

            header {
                position: fixed;
                top: -13%;
                height: 15%;
                margin-left: 6%;
                margin-right: 6%;
            }

            footer {
                position: fixed;
                bottom: -15%;
                left: 0px;
                right: 0px;
                height: 15%;
                margin-left: 6%;
                margin-right: 6%;
            }

            #leftbar {
                position: fixed;
                width: 5%;
                opacity: .6;
            }

            #rightbar {
                position: fixed;
                width: 5%;
                float: right;
            }

            #logo {
                width: 30%;
                margin-left: 10%;
                margin-right: 60%;

            }

            #img_logo {
                display: block;
                width: 100%;
            }

            #text_logo {
                margin-top: 1%;
                font-family: AgfaRotisSemiSerif;
                font-size: 13px;
                text-align: center;
            }

            #datos_contacto_factura {
                font-size: 12px;
                padding-top: 10%;
                width: 50%;
                margin: auto;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                text-align: center;
            }

            #datos_contacto_factura br {
                display: block;
                margin: 0px;
            }

            .negrita {
                font-weight: bold;
            }

            #reg_mercantil {
                height: 50%;
                margin-top: 33%;

            }

            #container {
                margin-left: 6%;
                margin-right: 6%;
                margin-bottom: 15%;
                /*background-color: red;*/
                height: 100%;

            }

            h1 {
                page-break-after: always;
            }

            h1:last-child {
                page-break-after: never;
            }

            #cabecera_facrura {
                width: 100%;
                /* background-color: blue;*/
            }

            #datos_cliente {
                margin-left: 70%;
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 10px;
            }

            .datos_cliente br {
                margin: 0px;
            }

            #id_fecha {
                margin-top: 4%;
                margin-left: 5%;
                margin-right: 5%;
                width: 90%;
                border: 2px solid black;
                background-color: #CACACA;
                float: left;
                height: 2%;
                font-size: 10px;
            }

            #id_factura {
                float: left;
                width: 50%;
                margin-left: 3%;
            }

            #fecha_factura {
                float: right;
                width: 50%;
                text-align: right;
                margin-right: 3%;
            }

            #tabla_factura {
                width: 100%;
            }

            #div_tabla_factura {
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 10px;
                width: 90%;
                margin-top: 4%;
                margin-left: 5%;
            }

            #tabla_factura {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;

            }

            #tabla_factura td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 4px;
            }

            #tabla_factura tr:nth-child(even) {
                background-color: #dddddd;
            }

            #pie_factura {
                width: 90%;
                margin-left: 5%;
            }

            #precio_final {
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 10px;
                margin-left: 60%;
                width: 40%;
            }

            #textos_precio_final {
                margin-left: 20%;
                width: 50%;
                float: left;
            }

            #valores_precio_final {
                width: 30%;
                float: right;
            }

            .text_aling_right {
                text-align: right;
            }

            #tabla_entidades {
                width: 70%;
                font-size: 10px;
                margin-top: 15%;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            }
            #comentario{
                font-size: 10px;
                font-family: Tahoma, Geneva, sans-serif;
                width: 90%;
                margin-left: 5%;
                margin-top: 4%;

            }


        </style>
    </head>
    <body>
    <header>
        <div id="logo">
            <div id="img_logo"><img src="data:image/jpeg;base64,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96efnuVy3d6KvFHC1O4jEQD7HvUz+x2027PVf6ooHJ3HMUCRpd9Wd4F+lkpqrklhRP8ApLGBkVs3+9ZG3O09X3UtNJp6I3p/fKaM2se83Jt4VscNe2nndqgqk7F2PEiu6irzOCMpRUVMU0oupQAAAAAAAAGOVu8TJlDVzUdVc2RVMD1jmjVkiq1zVwVNDVQCj60chel4/El8gB60chel4/El8gB60chel4/El8gB60chel4/El8gB60chel4/El8gB60chel4/El8gAm9DIargl3jVV1JsS+QSZiI1la1mZ0hpm+XOS6XeruD8camVz2ounBuODG/Fbghwm4yzkyTaeuX6btcEYsVaR9sLE8WQyTIFxsFtzA2vvNWymjp43LT7bXO2pHdXU1Hamqqm45Ng82XzTwr3y0H5DufJhikcbz9I/UNoetHIXpePxJfIOqcQetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAn7XdKC60MVfb5knpJtrspURURdlysdociLoc1UA919fSW+jlrayTsqaBu3LJgq7LePBqKoGO+tHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAetHIXpePxJfIAn7XdKC6UMVdb5kqKSbHs5W4oi7LlauhURdCooF0AAAAAEFds85UtFa6iuNxZT1TERzola9yojkxTHZaqagLP1o5C9Lx+JL5AD1o5C9Lx+JL5AD1o5C9Lx+JL5AD1o5C9Lx+JL5AD1o5C9Lx+JL5AD1o5C9Lx+JL5AD1o5C9Lx+JL5AGQW25UNzooq6hmSekmRVilbiiKiKrV1oi60AuQAAAAAgbrnvKVprpKG4XFkFXEjVkiVsiqm0iOTHZaqaUXEC09aOQvS8fiS+QA9aOQvS8fiS+QA9aOQvS8fiS+QA9aOQvS8fiS+QA9aOQvS8fiS+QA9aOQvS8fiS+QA9aOQvS8fiS+QBkdFW01bSQ1lK/tKadiSQyYKm01yYouCoi6QKwAAAAAAAAAAAAAAFOoqaemgfUVMrIYI0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
" alt="CTW Logo" style="width: 100%;"></div>
            <div id="text_logo">Catalonian Technologie Werke, S.L</div>
        </div>
    </header>
    <footer>
        <div id="datos_contacto_factura">
            <?php
            $ID_FACTURA=190019;
            $datos_ctw = get_datos_ctw();
            if ($datos_ctw->num_rows > 0) {
            // output data of each row
            while ($row = $datos_ctw->fetch_assoc()) {
            ?>

            <a class="negrita"><?php echo $row['dominio'] ?></a><br>
            <a class="negrita"><?php echo $row['correo_electronico'] ?></a><br>
            <a><?php echo $row['direccion'] ?></a><br>
            <a><?php echo $row['codigo_postal']." - ".$row['ciudad'] ?></a><br>
            <a>Tel <?php echo"(". $row['prefijo'].") ".$row['telefono_fijo'] ?></a><br>
            <a><?php echo $row['telefono_movil'] ?></a><br>
                <?php
            }
            }
            ?>
        </div>

    </footer>
    <div id="leftbar">
        <div id="reg_mercantil">
        </div>
    </div>
    <div id="rightbar"></div>
    <main>
        <div id="container">
            <div id="cabecera_facrura">
                <div id="datos_cliente">
                    <?php
                    $year=date("Y");
                    $year=substr( $year, -2 );
                    $data = get_cabecera_factura(190019);
                    if ($data->num_rows > 0) {
                        // output data of each row
                        while ($row = $data->fetch_assoc()) {
                            $nif_cliente = $row['NIF_cliente'];
                            $nombre_empresa = get_nombre_empresa($row['NIF_cliente']);
                            $nif_intra = get_nif_intra($row['NIF_cliente']);


                            ?>
                            <a class="datos_cliente negrita"><?php echo $nombre_empresa ?></a><br>
                            <a class="datos_cliente">NIF - <?php echo $row['NIF_cliente'] ?></a><br>
                            <a class="datos_cliente">NIF intra - <?php echo $nif_intra ?></a><br>
                            <a class="datos_cliente">Domicilio <?php echo $row['calle_facturacion'] . " , " . $row['numero_facturacion'] ?></a>
                            <br>
                            <a class="datos_cliente"><?php echo $row['codigo_postal_facturacion'] . " - " . $row['ciudad_facturacion'] ?></a>
                            <br>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div id="tronco_factura">
                <div id="id_fecha">
                    <div id="id_factura">
                        <a>Nº Fact. <?php echo $ID_FACTURA ?></a>
                    </div>
                    <div id="fecha_factura">
                        <?php
                        $timestamp = get_fecha_factura($ID_FACTURA);
                        $datetime = explode(" ", $timestamp);
                        $fecha_factura = $datetime[0];
                        ?>
                        <a>Data: <?php echo $fecha_factura ?></a>
                    </div>
                </div>

                <div id="div_tabla_factura">
                    <?php
                    $comentario_factura=get_comentario_factura($ID_FACTURA);
                    echo "<p>$comentario_factura</p>";
                    ?>
                    <table id="tabla_factura">
                        <thead>
                        <tr>
                            <th>Quantitat</th>
                            <th>Concepte</th>
                            <th>Preu unitari</th>
                            <th>Preu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //FACTURA ARTICULOS
                        $articulos_facturados = get_articulos_facturados($ID_FACTURA);
                        if ($articulos_facturados->num_rows > 0) {
                            // output data of each row
                            while ($row = $articulos_facturados->fetch_assoc()) {
                                $id_articulo_facturado = $row['id_articulo_facturado'];
                                $nombre_articulo = get_nombre_articulo_facturado($id_articulo_facturado);
                                $descripcion_articulo = get_descripcion_articulo_facturado($id_articulo_facturado);
                                $sn_articulo = get_sn_articulo_facturado($id_articulo_facturado);
                                $precio_producto=$row['precio'];
                                $precio_producto=round($precio_producto, 2);

                                if ($sn_articulo == "") {
                                    $concepto =$descripcion_articulo;
                                } else {
                                    $concepto =$descripcion_articulo . "<br>S/N: " . $sn_articulo;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $row['cantidad'] ?></td>
                                    <td><?php echo $concepto ?></td>
                                    <td><?php echo number_format((float)$precio_producto, 2, ',', ''); ?></td>
                                    <td><?php echo number_format((float)$row['precio_total'], 2, ',', ''); ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php
                        //FACTURA SERVICIOS
                        $servicios_facturados = get_servicios_facturados($ID_FACTURA);
                        if ($servicios_facturados->num_rows > 0) {
                            // output data of each row
                            while ($row = $servicios_facturados->fetch_assoc()) {
                                $id_servicio_facturado = $row['id_servicio_facturado'];
                                $nombre_servicio = get_nombre_servicio_facturado($id_servicio_facturado);
                                $descripcion_servicio = get_descripcion_servicio_facturado($id_servicio_facturado);
                                $concepto = $nombre_servicio . " - " . $descripcion_servicio;
                                $precio_producto=$row['precio'];
                                $precio_producto=round($precio_producto, 2);


                                ?>
                                <tr>
                                    <td><?php echo $row['cantidad'] ?></td>
                                    <td><?php echo $concepto ?></td>
                                    <td><?php echo number_format((float)$precio_producto, 2, ',', ''); ?></td>
                                    <td><?php echo number_format((float)$row['precio_total'], 2, ',', ''); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php
                        //FACTURA MINUTAJES
                        $minutajes_facturados = get_minutajes_facturados($ID_FACTURA);
                        if ($minutajes_facturados->num_rows > 0) {
                            // output data of each row
                            while ($row = $minutajes_facturados->fetch_assoc()) {
                                $id_servicio = $row['ID_servicio'];
                                $nombre_servicio = get_nombre_servicio($id_servicio);
                                $descripcion_servicio = get_descripcion_servicio($id_servicio);
                                $concepto = $row['fecha'] . "<br>" .$row['comentario'];
                                $precio_producto= $row['precio_servicio'];
                                $precio_producto=round($precio_producto, 2);

                                $precio_producto_total= $row['precio_total'];
                                $precio_producto_total=round($precio_producto, 2);



                                ?>
                                <tr>
                                    <td><?php echo $row['horas'] ?> h</td>
                                    <td><?php echo $concepto ?></td>
                                    <td><?php echo number_format((float)$precio_producto, 2, ',', ''); ?></td>
                                    <td><?php echo number_format((float)$precio_producto_total, 2, ',', ''); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        </tbody>
                    </table>

                </div>


            </div>

            <div id="pie_factura">

                <?php

                $data = get_pie_factura($ID_FACTURA);
                if ($data->num_rows > 0) {
                    // output data of each row
                    while ($row = $data->fetch_assoc()) {
                        $importe_iva= $row['total_facturado'] - $row['total_neto'];
                        ?>

                        <div id="precio_final">
                            <div id="textos_precio_final">
                                <p class="text_aling_right">Base imponible:</p>
                                <p class="text_aling_right"><?php echo $row['IVA']?>% IVA:</p>
                                <p class="negrita">TOTAL:</p>
                            </div>
                            <div id="valores_precio_final">
                                <p class="text_aling_right"><?php echo number_format((float)$row['total_neto'], 2, ',', ''); ?> &euro;</p>
                                <p class="text_aling_right"><?php echo number_format((float)$importe_iva, 2, ',', '');?> &euro;</p>
                                <p class="text_aling_right negrita"><?php echo number_format((float)$row['total_facturado'], 2, ',', ''); ?> &euro;</p>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <br>
                <br>
                <table id="tabla_entidades">
                    <tr>
                        <td>La Caixa:</td>
                        <td>ES56 2100 3031 8222 0075 5280</td>
                        <td>BIC:</td>
                        <td>CAIX ESBB</td>
                    </tr>
                    <tr>
                        <td>Banco Sabadell:</td>
                        <td>ES93 0081 7011 1000 0150 5558</td>
                        <td>BIC:</td>
                        <td>BSAB ESBB</td>
                    </tr>
                    <tr>
                        <td>Santander:</td>
                        <td>ES54 0049 4768 3622 1605 2393</td>
                        <td>BIC:</td>
                        <td>BSCH ESMM</td>
                    </tr>
                    <tr>
                        <td class="negrita">Firma:</td>
                    </tr>
                </table>


            </div>

        </div>


    </main>
    </body>
    </html>
<?php
$dompdf = new Dompdf();
$dompdf->load_html(ob_get_clean());
$dompdf->render();

$pdf = $dompdf->output();
$filename = "../../../../factura_pdf/".$ID_FACTURA.".pdf";
file_put_contents($filename, $pdf);

// Output the generated PDF to Browser
/*$dompdf->stream();*/