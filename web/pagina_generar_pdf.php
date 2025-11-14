<?php
session_start();
include('assets/php/db.php');
use Dompdf\Dompdf;
if ($_SESSION["login_done"] == true){
?>


<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('assets/librerias/librerias_globales.html'); ?>


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
                    document.getElementById("menu_pdf").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_pdf {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_ver_pdf {
                        margin-left: 15%;
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
                    <!--TITULO DE LA PÁGINA-->
                    <a class="navbar-brand">Buscador</a>
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
    <?php

    require_once 'dompdf/autoload.inc.php';

    if ( ! isset($_GET['pdf']) ) {
        $content = '<html>';
        $content .= '<head>';
        $content .= '<style>';
        $content .= 'body { font-family: DejaVu Sans; }';
        $content .= '</style>';
        $content .= '</head><body>';
        $content .= '<h1>Ejemplo generaci&oacute;n PDF</h1>';
        $content .= '<a href="index.php?pdf=1">Generar documento PDF</a>';
        $content .= '</body></html>';
        echo $content;
        exit;
    }

    $content = '<html>';
    $content .= '<head>';
    $content .= '<style>';
    $content .= '</style>';
    $content .= '</head><body>';
    $content .= '<h1>Ejemplo generaci&oacute;n PDF</h1>';
    $content .= 'Almacena en una variable todo el contenido que quieras incorporar ';
    $content .= 'en el documento <b>formato HTML</b> para generar a partir de &eacute;ste ';
    $content .= 'el documento PDF.<br><br>';
    $content .= 'Ejemplo lista<br>';
    $content .= '<ul><li>Uno</li><li>Dos</li><li>Tres</li></ul>';
    $content .= 'Ejemplo imagen<br><br>';
    $content .= '<img src="logo-openwebinars.png" alt="" />';
    $content .= '</body></html>';

    echo $content; exit;

    $dompdf = new Dompdf();
    $dompdf->loadHtml($content);
    $dompdf->setPaper('A4', 'landscape'); // (Opcional) Configurar papel y orientación
    $dompdf->render(); // Generar el PDF desde contenido HTML
    $pdf = $dompdf->output(); // Obtener el PDF generado
    $dompdf->stream(); // Enviar el PDF generado al navegador
    ?>
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