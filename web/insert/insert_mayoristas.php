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
                    document.getElementById("menu_mayoristas").className = "active";
                });</script>
            <style>
                @media (max-width: 600px) {
                    #menu_mayoristas {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_mayoristas1 {
                        margin-left: 8%;
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
                    <a class="navbar-brand">Insertar mayorista</a>
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
                          <form id="contact" action="../assets/php/post/post_mayoristas.php" method="post">
                            <h3>Insertar mayorista</h3>
                            <h4>Rellene el formulario para añadir un nuevo mayorista</h4>
                            <fieldset>
                            &nbsp;NIF del mayorista:  <input placeholder="NIF del mayorista*" name="NIF_mayorista" type="text" autofocus>
                            </fieldset>
                            <fieldset>
                            &nbsp;Nombre de la empresa:  <input placeholder="Nombre de la empresa*" name="nombre_empresa" type="text"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Nombre del comercial:  <input placeholder="Nombre del comercial" name="nombre_comercial" type="text">
                            </fieldset>
                            <fieldset>
                            &nbsp;Teléfono de la empresa:  </br><input placeholder="Teléfono de la empresa*" name="telefono_empresa" type="number"  required>
                            </fieldset>
                            <fieldset>
                            &nbsp;Teléfono del comercial:  </br><input placeholder="Teléfono del comercial" name="telefono_comercial" type="number">
                            </fieldset>
                            <fieldset>
                            &nbsp;Extensión teléfono del comercial:  <input placeholder="Extensión teléfono del comercial" name="extension_telefono_comercial" type="text">
                            </fieldset>
                            <fieldset>
                            &nbsp;Correo electrónico de la empresa:  <input placeholder="Correo electrónico de la empresa" name="email_empresa" type="email">
                            </fieldset>
                            <fieldset>
                            &nbsp;Correo electrónico del comercial:  <input placeholder="Correo electrónico del comercial" name="email_comercial" type="email">
                            </fieldset>
                            <fieldset>
                            &nbsp;Ubicación:  <input placeholder="Ubicación" name="ubicacion" type="text">
                            </fieldset>
                            <fieldset>&nbsp;Selecciona el país: 
                            <?php
                            $data = select_all_pais(); ?>
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
                                  &nbsp;IBAN <input placeholder="IBAN" name="IBAN" type="text">
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