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
                    document.getElementById("menu_sedes").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_sedes {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_sedes1 {
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
                    <a class="navbar-brand">Insertar sede</a>
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
                          <form id="contact" action="../assets/php/post/post_sedes.php" method="post">
                            <h3>Insertar sede</h3>
                            <h4>Rellene el formulario para añadir una nueva sede para un cliente ya añadido.</h4>
                            
                            <fieldset>&nbsp;Selecciona el NIF del cliente:
                            <?php $data = select_all_cliente(); ?>
                            <select name="select_box_nif_empresa" class="select_box">
                              <option value="" disabled selected>Selecciona el NIF del cliente*</option>
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
                            &nbsp;Nombre de la sede:  <input placeholder="Nombre de la sede*" name="nombre" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Ciudad de la sede: <input placeholder="Ciudad de la sede*" name="ciudad" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Código postal de la sede:  </br><input placeholder="Código postal de la sede*" name="codigo_postal" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Calle de la sede:  <input placeholder="Calle de la sede*" name="calle" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Número de la sede:  <input placeholder="Número de la sede*" name="numero" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Ubicacion de la sede:  <input placeholder="Ubicacion de la sede" name="ubicacion" type="text">
                            </fieldset>
                            <fieldset>
                            &nbsp;Teléfono de la sede:  </br><input placeholder="Teléfono de la sede*" name="telefono" type="number"  required>
                            </fieldset>
                            <fieldset> &nbsp;Selecciona el país:
                            <?php $data = select_all_pais(); ?>
                            <select name="select_box_pais" class="select_box">
                              <option value="" disabled selected>Selecciona el país*</option>
                              <?php
                                if ($data->num_rows > 0) {
                                    // output data of each row
                                    while($row = $data->fetch_assoc()) {
                              ?>
                                    <option value="<?php echo $row['PAIS']?>"><?php echo $row['PAIS']?></option>
                            <?php   
                                    }       
                                }
                             ?>       
                            </select>
                            </fieldset>
                            <fieldset>
                            <input style="visibility:hidden" name="activo" type="checkbox" checked>
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
</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>