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
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

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
                    #menu_presupuesto {
                        background-color: #ef9448;
                        margin-left: 12%;
                        border-top-left-radius: 50px;
                        border-top-right-radius: 50px;
                        border-bottom-right-radius: 50px;
                        border-bottom-left-radius: 50px;
                    }

                    #menu_presupuesto1 {
                        /*margin-left: 12%;*/
                    }
                }
            </style>
        </div>
    </div>

    <div class="main-panel">
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
                    <a class="navbar-brand">Añadir material al presupuesto</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--USER & LOGOUT-->
                    <?php include('../assets/html/menu/user_logout_pre_factura.html'); ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">

                <?php
                if ($_GET['presupuesto'] == 'nuevo') {
                $id_presupuesto= get_last_id_presupuesto();
                }
                if(!empty($_GET['id'])){
                    $id_presupuesto=$_GET['id'];

                }
                ?>


                <div class="row">
                    <div class="card">
                        <button style="background: #ea8f43; border: none;  color: #FFF; margin: 0 0 5px; padding: 10px; font-size: 15px; cursor: pointer;"
                                onclick="add_product()">Añadir otro producto
                        </button>
                        <button id="delete_button" style="background: #ea8f43; border: none;  color: #FFF; margin: 0 0 5px; padding: 10px; font-size: 15px; cursor: pointer; visibility: hidden"
                                onclick="delete_product()">Eliminar último producto
                        </button>
                        <form id="contact" action="../assets/php/presupuesto/post_material_presupuesto.php"
                              method="post">
                            <input type="hidden" name="contador"
                                   class="contador"
                                   value="1">
                            <input type="hidden" name="id_presupuesto"
                                   value="<?php echo $id_presupuesto ?>">
                            <div id="productos_presupuesto">
                                <div class="row" id="product_1">

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Descripcion</label>
                                            <input type="text" name="descripcion_1"
                                                   class="form-control"
                                                   value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>cantidad</label>
                                            <input type="number" name="cantidad_1"
                                                   class="form-control"
                                                   value="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="text" name="precio_1"
                                                   class="form-control"
                                                   value="" required>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <fieldset>
                                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Añadir
                                    productos al stock
                                </button>
                            </fieldset>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
</div>

</body>

<script>
    var contador = 1;

    function add_product() {
        contador++;

        var div_row = document.createElement("div");
        div_row.className = "row";
        div_row.id="product_"+ contador;

        //ADD DESCRIPCION
        var div_descripcion_col = document.createElement("div");
        div_descripcion_col.className = "col-md-9";

        div_row.appendChild(div_descripcion_col);

        var div_descripcion_form = document.createElement("div");
        div_descripcion_form.className = "form-group";

        div_descripcion_col.appendChild(div_descripcion_form);

        var descripcion_label = document.createElement("label");
        var descripcion_input = document.createElement("input");
        descripcion_input.className = "form-control";
        descripcion_input.typeName = "text";
        descripcion_input.name = "descripcion_" + contador;
        descripcion_input.required=true;

        div_descripcion_form.appendChild(descripcion_label);
        div_descripcion_form.appendChild(descripcion_input);

        var t = document.createTextNode("Descripcion");
        descripcion_label.appendChild(t);

        //ADD CANTIDAD
        var div_cantidad_col = document.createElement("div");
        div_cantidad_col.className = "col-md-1";

        div_row.appendChild(div_cantidad_col);

        var div_cantidad_form = document.createElement("div");
        div_cantidad_form.className = "form-group";

        div_cantidad_col.appendChild(div_cantidad_form);

        var cantidad_label = document.createElement("label");
        var cantidad_input = document.createElement("input");
        cantidad_input.className = "form-control";
        cantidad_input.typeName = "text";
        cantidad_input.name = "cantidad_" + contador;
        cantidad_input.required=true;

        div_cantidad_form.appendChild(cantidad_label);
        div_cantidad_form.appendChild(cantidad_input);

        var t = document.createTextNode("Cantidad");
        cantidad_label.appendChild(t);

        //PRECIO
        var div_precio_col = document.createElement("div");
        div_precio_col.className = "col-md-2";

        div_row.appendChild(div_precio_col);

        var div_precio_form = document.createElement("div");
        div_precio_form.className = "form-group";

        div_precio_col.appendChild(div_precio_form);

        var precio_label = document.createElement("label");
        var precio_input = document.createElement("input");
        precio_input.className = "form-control";
        precio_input.typeName = "text";
        precio_input.name = "precio_" + contador;
        precio_input.required=true;

        div_precio_form.appendChild(precio_label);
        div_precio_form.appendChild(precio_input);

        var t = document.createTextNode("Precio");
        precio_label.appendChild(t);

        document.getElementById("productos_presupuesto").appendChild(div_row);

        $(".contador").val(contador);




        if(contador>=2){
            document.getElementById("delete_button").style.visibility = "visible";
        }else{
            document.getElementById("delete_button").style.visibility = "hidden";
        }
    }

    function delete_product() {

        //eliminar div
        var id_delete ="product_"+contador;


        var el = document.getElementById( id_delete );
        el.parentNode.removeChild( el );
        contador--;

        if(contador>=2){
            document.getElementById("delete_button").style.visibility = "visible";
        }else{
            document.getElementById("delete_button").style.visibility = "hidden";
        }


    }

</script>

</html>

<?php
} else {
    echo "false";
    header("location:../index.php");
}

?>