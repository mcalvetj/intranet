    <!doctype html>

<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!--LIBRERIAS-->
    <!--LIBRERIA - GLOBAL-->
    <?php include('../assets/librerias/librerias_globales_insert.html'); ?>
    <!--LIBRERIA - INSERT-->
    <?php include('../assets/librerias/librerias_insert.html'); ?>



</head>
<body>

<div class="wrapper">
    <div class="sidebar">
    	<div class="sidebar-wrapper">
            <!--MENU Y LOGO-->
            <?php
            include('../assets/html/logo/logo_insert.html');
            include('../assets/html/menu/menu_insert.html');
            ?>
            <!--CAMBIAR COLOR DE LA ENTRADA DE MENU ACTIVA-->
            <script>$(function () {
                    document.getElementById("menu_servicios").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_servicios {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_servicios1 {
                        margin-left: 11%;
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
                    <a class="navbar-brand">Insertar servicio</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_insert.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card2">

                        <div class="container">  
                          <form id="contact" action="../assets/php/post/post_servicios.php" method="post">
                            <h3>Insertar servicio</h3>
                            <h4>Rellene el formulario para añadir un nuevo servicio</h4>
                            <fieldset>
                            &nbsp;Nombre del servicio:  <input placeholder="Nombre del servicio*" name="nombre" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Descripción:  <input placeholder="Descripción" name="descripcion" type="text">
                            </fieldset>
                            <fieldset>
                            &nbsp;Precio: </br><input placeholder="Precio*" name="precio" type="number" step="any"  required>
                            </fieldset>
                            <fieldset>&nbsp;Selecciona el NIF del cliente(En el caso que sea necesario):
                            <?php $data = select_all_cliente(); ?>
                            <select name="select_box_nif_empresa" class="select_box">
                              <option value="">Selecciona el NIF del cliente...</option>
                              <?php
                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while($row = $data->fetch_assoc()) {
                              ?>
                                    <option value="<?php echo $row['NIF_EMPRESA']?>"><?php echo "$row[nombre_completo] - $row[NIF_EMPRESA]";?></option>
                            <?php   
                                    }       
                                }
                             ?>       
                            </select>
                            </fieldset>
                            <fieldset>
                              <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                            </fieldset>
                          </form>
                        </div>

                                                                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <!--<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>-->
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>


</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>