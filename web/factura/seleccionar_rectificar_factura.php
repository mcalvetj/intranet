<!doctype html>
<!--VERIFICAR QUE LOGIN SE HA REALIZADO-->
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
        echo "<script type=\"text/javascript\" src=\"../assets/js/editor/edit_cliente.js\"></script>";
    }
    ?>
    <!--LIBRERIAS - BUSCADOR-->
    <?php include('../assets/librerias/librerias_buscador.html'); ?><!--LIBRERIA - INSERT-->
    <?php include('../assets/librerias/librerias_insert.html'); ?>
    <!--Funciones javascript-->
    <script src="../assets/js/functions.js"></script>

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

        </div>
    </div>
    <!--BARRA SUPERIOR, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand">Rectificar factura</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_buscador.html'); ?>
                </div>
            </div>
        </nav>
        <!--ZONA DE CONTENIDO DE ESTA PAGINA, PONE 2 POR QUE ES UNA VARIACION DE LA QUE VIENE POR DEFECTO-->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="container">
                                <form id="contact" action="visualizar_factura_rectificativa.php" method="post" onKeyPress="return disableEnterKey(event)">

                                    <h3>Factura rectificativa</h3>
                                    <h4>Introduce el número de factuar que desea rectificar</h4>

                                    <fieldset>
                                        Número de factura
                                        <input type="text" name="id_factura" id="id_factura"/>
                                    </fieldset>

                                    <input id="inputComprovarFactura" type="text" value="false">

                                    <fieldset>
                                        <button name="submit" type="submit" id="btnsubmit" data-submit="...Sending">Siguiente
                                        </button>
                                    </fieldset>

                                </form>

                                <script language="javascript">

                                $("#inputComprovarFactura").hide();
                                $("#btnsubmit").hide();

                                $("#id_factura").keyup(function(){
                             
                                        checkSubmit($('#id_factura').val());
                                });


                                setInterval(function(){ 
                                    var quePasa = document.getElementById("inputComprovarFactura").value;
                                        if(quePasa=="true"){
                                            $("#btnsubmit").show();
                                        }
                                        if(quePasa=="false"){
                                            $("#btnsubmit").hide();
                                        }
                                 }, 100);

                                
                                    function checkSubmit(id_factura) {
                                        var parametros = {
                                                "id_factura" : id_factura
                                        };
                                        $.ajax({
                                            data:  parametros,
                                            type: 'post',
                                            url: '../assets/php/facturar/existe_factura.php',
                                            success: function (response) {
                                            
                                                $("#inputComprovarFactura").attr("value",response);

                                            }
                                        });

                                        
                                    }

                                        function disableEnterKey(e){
                                            var key; 
                                            if(window.event){
                                            key = window.event.keyCode; //IE
                                            }else{
                                            key = e.which; //firefox 
                                            }
                                            if(key==13){
                                            return false;
                                            }else{
                                            return true;
                                            }
                                        }
                                    


                                </script>

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
<!--SI NO HA PASSADO POR EL LOGIN LO MANDAMOS PARA QUE SE AUTENTIFIQUE-->
<?php
} else {
    header("location:../index.php");
}
?>