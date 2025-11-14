<!doctype html>

<?php
session_start();
include('assets/php/db.php');
include('assets/php/selects.php');
include('assets/php/functions.php');
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <?php include('assets/librerias/librerias_globales.html'); ?>
    <script src="assets/js/index.js"></script>

</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <!--MENU Y LOGO-->
            <?php
            include('assets/html/logo/logo.html');
            include('assets/html/menu/menu_principal.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_inicio").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_inicio {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_inicio1 {
                        margin-left: 22%;
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--TITULO DE LA PÃGINA-->
                    <a class="navbar-brand">Página de inicio</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('assets/html/menu/user_logout.html'); ?>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 8.0</h3>
                            <!--Version 2.0-->
                            <div id="version8">
                                <p>Actualización versión 8.0 - --/--/2018</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion8" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion8" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version8Ampliada">
                                    <p>
                                    <li>En proceso</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 7.0</h3>
                            <!--Version 2.0-->
                            <div id="version7">
                                <p>Actualización versión 7.0 - 09/02/2018</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion7" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion7" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version7Ampliada">
                                    <p>
                                    <li>Cuando mandamos una factura por correo, se manda una copia a mcalvetj@ctw.es</li>
                                    <li>Creación de presupuestos</li>
                                    <li>Arreglo al añadir mayorista</li>
                                    <li>Creación de facturas rectificativas</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 6.0</h3>
                            <!--Version 2.0-->
                            <div id="version5">
                                <p>Actualización versión 6.0 - 12/01/2018</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion6" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion6" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version6Ampliada">
                                    <p>
                                        <li>Bloquear botón al facturar y mostrar que ya se esta facturando para evitar posibles duplicados</li>
                                        <li>Creación de carpetas para dividir pdfs de facturas en meses y años</li>
                                        <li>El comentario de factura ya se puede guardar antes de facturar mediante AJAX</li>
                                        <li>Edición y eliminación del comentario prefactura</li>
                                        <li>Descargar varias facturas al seleccionarlas</li>
                                        <li>Descargar facturas por fechas</li>
                                        <li>Arreglo en enviar correo a varios contactos</li>
                                        <li>Redondear minutos en minutaje automático</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 5.0</h3>
                            <!--Version 2.0-->
                            <div id="version5">
                                <p>Actualización versión 5.0 - 22/12/2017</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion5" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion5" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version5Ampliada">
                                    <p>
                                        <li>Control de apóstrof en números de serie al añadir stock</li>
                                        <li>Historial facturas -> añadido el campo precio total</li>
                                        <li>Revisión de los campos editables</li>
                                        <li>Tablas en la prefactura -> Hemos añadido 10 rows ilimitadas</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 4.0</h3>
                            <!--Version 2.0-->
                            <div id="version4">
                                <p>Actualización versión 4.0 - 15/12/2017</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion4" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion4" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version4Ampliada">
                                    <p>
                                        <li>Checkbox en facturas (cobradas SI/NO)</li>
                                        <li>Ahora se puede añadir comentario a las facturas (opcional)</li>
                                        <li>Se puede visualizar factura antes de imprimir</li>
                                        <li>Arreglo al insertar artículos desde la pistola (control de apóstrofes)</li>
                                        <li>Se puede enviar una factura a varios contactos a la vez (máximo 10)</li>
                                        <li>Arreglo en redondeo de 2 decimales al alza los precios de prefacturas y facturas</li>
                                        <li>Reducción de rows en tablas</li>
                                        <li>Arreglo en recuperar fecha factura</li>
                                        <li>Ordenar todos los buscadores por fecha</li>
                                        <li>Añadir X números de serie en artículos con código</li>
                                        <li>Cambio de id de la factura (170001), cuando se cambie de año cambiarán los 2 primeros dígitos (180001)</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 3.0</h3>
                            <!--Version 2.0-->
                            <div id="version3">
                                <p>Actualización versión 3.0 - 27/11/2017</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion3" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion3" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version3Ampliada">
                                    <p>
                                        <li>Al crear la factura, poderla enviar por correo</li>
                                        <li>En la tabla facturas, botón para enviar la factura por correo</li>
                                        <li>En la tabla facturas, botón para enviar un correo con texto y la factura</li>
                                        <li>Editar el nombre de la prefactura</li>
                                        <li>Arreglo en buscadores de articulos, servicios y minutajes facturados (buscador + rows)</li>
                                        <li>Guardar la fecha y el correo al que se envio la factura en historial de facturas</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 2.0</h3>
                            <!--Version 2.0-->
                            <div id="version2">
                                <p>Actualización versión 2.0 - 14/11/2017</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion2" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion2" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version2Ampliada">
                                    <p>
                                        <li>Al borrar un elemento de la prefactura te devuelve a la misma prefactura</li>
                                        <li>Entrada de stock de artículo con y sin código en vez de poner "9999999999999" a mano</li>
                                        <li>Que no se tenga que crear 1 servicio por mes (seleccionar el mes cuando se vaya a prefacturar)</li>
                                        <li>Ya se puede subir números de serie ilimitados en artículos en vez de crear 1 artículo 
                                        por cada número de serie que tenga</li>
                                        <li>Hemos añadido el campo "comentario" en el minutaje, hay que rellenarlo por que saldra en la factura.</li>
                                        <li>Buscadores de minutajes, artículos y servicios facturados</li>
                                        <li>Que el admin pueda borrar las prefacturas</li>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <h3>VERSION 1.0</h3>
                            <!--Version 2.0-->
                            <div id="version1">
                                <p>Actualización versión 1.0 - 25/10/2017</p>
                                Ver características&nbsp;&nbsp;
                                <a id="bajarVersion1" class="btn btn-success btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span></a>
                                <a id="subirVersion1" class="btn btn-danger btn-default" style="cursor:pointer"><span class="glyphicon glyphicon-minus"></span></a>
                                <div id="version1Ampliada">
                                </br>
                                    <p>Primera implementación de la web
                                        <li>Inserts de mayoristas, servicios, artículos, clientes, contactos, sedes, minutajes (manual y automático)</li>
                                        <li>Prefacturación y facturación</li>
                                        <li>Buscadores de clientes, mayoristas, servicios, articulos, minutajes usuarios y articulos/servicios/minutajes facturados</li>
                                        <li>Edición de la información del punto anterior</li>
                                        <li>Eliminación de artículos, minutajes y prefacturas</li>
                                    </p>
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