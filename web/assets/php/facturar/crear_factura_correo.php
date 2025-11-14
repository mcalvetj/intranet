<!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if ($_SESSION["login_done"] == true){
?>

<head>
    <meta charset="ISO-8859-1">


    <link href="../../css/insert.css" rel="stylesheet"/>

    <link href="../../css/cargarinsert.css" rel="stylesheet"/>

</head>
<body onload="itv = setInterval(prog, 10)">

<div>

    <?php
    //variables
    $id_pre_factura = $_POST['id_pre_factura'];
    $fecha_factura1 = $_POST['fecha_factura'];
    $comentario = $_POST['comentario'];
    $comentarioSiNo = $_POST['comentarioSiNo'];

    $diaActual = date("d");
    $mesActual = date("F");
    if ($mesActual=="January") $mesActual="Enero";
    if ($mesActual=="February") $mesActual="Febrero";
    if ($mesActual=="March") $mesActual="Marzo";
    if ($mesActual=="April") $mesActual="Abril";
    if ($mesActual=="May") $mesActual="Mayo";
    if ($mesActual=="June") $mesActual="Junio";
    if ($mesActual=="July") $mesActual="Julio";
    if ($mesActual=="August") $mesActual="Agosto";
    if ($mesActual=="September") $mesActual="Setiembre";
    if ($mesActual=="October") $mesActual="Octubre";
    if ($mesActual=="November") $mesActual="Noviembre";
    if ($mesActual=="December") $mesActual="Diciembre";
    $horaActual = date("h:i");

    if($fecha_factura1=="auto"){
        $year1=date("Y-m-d 00:00:00");
        $fecha_factura="\"$year1\"";
        $fecha_factura3=$year1;
        $yearNuevo=substr( $fecha_factura, 3, 2 );
    }else{
        $fecha_factura = $fecha_factura1;
        $yearNuevo=substr( $fecha_factura, 2, 2 );
    }

    $nif_cliente = get_cliente_pre_factura($id_pre_factura);

    $ciudad_facturacion = get_ciudad_facturacion($nif_cliente);
    $ciudad_facturacion = "\"$ciudad_facturacion\"";
    $codigo_postal_facturacion = get_codigo_postal_facturacion($nif_cliente);
    $codigo_postal_facturacion = "\"$codigo_postal_facturacion\"";
    $calle_facturacion = get_calle_facturacion($nif_cliente);
    $calle_facturacion = "\"$calle_facturacion\"";
    $numero_facturacion = get_numero_facturacion($nif_cliente);
    $nif_cliente = "\"$nif_cliente\"";

    $correoContacto = $_POST['correoContacto'];
    date_default_timezone_set('UTC');
    $fecha = date('d/m/Y');
    $fecha_mas_correo = ' ('.$fecha.' - '.$correoContacto.') ';

    //miramos la ultima factura para comprovar el año
    $ultima_factura = get_last_id_factura();
    $fechaUltimaFactura = select_fecha_factura($ultima_factura);
    $yearUltimaFactura=substr( $fechaUltimaFactura, 2, 2 );

    $nuevoIdFactura = $yearNuevo.'0001';
    echo $yearNuevo;
    echo "<br>";
    echo $yearUltimaFactura;
    echo "<br>";
    echo $ultima_factura; 
    echo "<br>";
    echo $fecha_factura; 
    //creamos factura

    if($comentarioSiNo==0){
        $comentario2=" ";
    }else{
        $comentario2=$comentario;
    }

        //creamos factura
    if($fecha_factura1=="auto"){
        if($yearNuevo==$yearUltimaFactura){
        $crear_factura = "INSERT INTO FACTURA (cobrado, fechas_envio_correo, fecha, comentario) VALUES (0,'$fecha_mas_correo','$fecha_factura3','$comentario')";
        }else{
            $crear_factura = "INSERT INTO FACTURA (ID_FACTURA, cobrado, fechas_envio_correo, fecha, comentario) VALUES ($nuevoIdFactura,0,'$fecha_mas_correo','$fecha_factura3','$comentario')";
        }
    }else{
        if($yearNuevo==$yearUltimaFactura){
            $crear_factura = "INSERT INTO FACTURA (cobrado, fechas_envio_correo, fecha, comentario) VALUES (0,'$fecha_mas_correo','$fecha_factura1','$comentario')";
        }else{
            $crear_factura = "INSERT INTO FACTURA (ID_FACTURA, cobrado, fechas_envio_correo, fecha, comentario) VALUES ($nuevoIdFactura,0,'$fecha_mas_correo','$fecha_factura1','$comentario')";
        }
    }

    

    //creamos factura
    
    $conn = connect();
    if ($conn->query($crear_factura) == TRUE) {

    $ID_FACTURA = get_last_id_factura();
    //cabecera pre-factura
    if($fecha_factura=="auto") {
        $year=date("Y-m-d 00:00:00");
        $fecha_sin_hora="\"$year\"";

        $crear_cabecera_factura = "INSERT INTO CABECERA_FACTURA(ID_factura, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion, fecha_factura)
                        VALUES ($ID_FACTURA,$nif_cliente,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion', $fecha_sin_hora)";
    }else{
        $crear_cabecera_factura = "INSERT INTO CABECERA_FACTURA(ID_factura, NIF_cliente,ciudad_facturacion, codigo_postal_facturacion, calle_facturacion, numero_facturacion,fecha_factura)
                        VALUES ($ID_FACTURA,$nif_cliente,$ciudad_facturacion, $codigo_postal_facturacion, $calle_facturacion, '$numero_facturacion','$fecha_factura')";
    }

    //tronco pre-factura
    //tronco articulo
    $articulos_factura = obtener_articulos_factura($id_pre_factura);
    if ($articulos_factura->num_rows > 0) {
        while ($row = $articulos_factura->fetch_assoc()) {
            $id_tronco_pre_factura_articulo = $row['ID_TRONCO_PRE_FACTURA_ARTICULO'];

            $articulo_pre_facturado = obtener_datos_articulo($id_tronco_pre_factura_articulo);
            while ($row = $articulo_pre_facturado->fetch_assoc()) {
                $sql_ID_articulo = $row['ID_articulo'];
                $sql_numero_de_serie = "\"" . $row['numero_de_serie'] . "\"";
                if ($sql_numero_de_serie == "\"\"") {
                    $sql_numero_de_serie = 'null';
                }
                $sql_cantidad = $row['cantidad'];
                $sql_precio = $row['precio'];
                $sql_margen = $row['margen'];
                $sql_precio_total = $row['precio_total'];
                $sql_id_articulo_facturado = $row['id_articulo_facturado'];

                $crear_tronco_factura_articulo = "INSERT INTO TRONCO_FACTURA_ARTICULO(ID_factura, ID_articulo,numero_de_serie, cantidad, precio, margen,precio_total,id_articulo_facturado)
                        VALUES ($ID_FACTURA,$sql_ID_articulo,$sql_numero_de_serie, $sql_cantidad, $sql_precio, $sql_margen,$sql_precio_total,$sql_id_articulo_facturado)";

                if ($conn->query($crear_tronco_factura_articulo) == TRUE) {

                } else {
                    echo "Error: <br><br>" . $crear_tronco_factura_articulo . "<br><br><br>" . $conn->error;
                }
            }
        }
    }

    //tronco servicio
    $servicios_factura = obtener_servicios_factura($id_pre_factura);
    if ($servicios_factura->num_rows > 0) {
        while ($row = $servicios_factura->fetch_assoc()) {
            $id_tronco_pre_factura_servicio=$row['ID_TRONCO_PRE_FACTURA_SERVICIO'];

            $servicio_pre_facturado=obtener_datos_servicio($id_tronco_pre_factura_servicio);
            while ($row = $servicio_pre_facturado->fetch_assoc()) {
                $sql_ID_servicio=$row['ID_servicio'];
                $sql_cantidad=$row['cantidad'];
                $sql_precio=$row['precio'];
                $sql_margen=$row['margen'];
                $sql_precio_total=$row['precio_total'];
                $sql_id_servicio_facturado=$row['id_servicio_facturado'];

                $crear_tronco_factura_servicio = "INSERT INTO TRONCO_FACTURA_SERVICIO(ID_factura, ID_servicio, cantidad,precio, margen,precio_total,id_servicio_facturado)
                        VALUES ($ID_FACTURA,$sql_ID_servicio, $sql_cantidad, $sql_precio, $sql_margen,$sql_precio_total,$sql_id_servicio_facturado)";

                if ($conn->query($crear_tronco_factura_servicio) == TRUE) {

                }else{
                    echo "Error: <br><br>" . $crear_tronco_factura_servicio . "<br><br><br>" . $conn->error;
                }
            }
        }
    }

    //tronco minutaje
    $minutaje_factura = obtener_minutaje_factura($id_pre_factura);
    if ($minutaje_factura->num_rows > 0) {
        while ($row = $minutaje_factura->fetch_assoc()) {
            $id_tronco_pre_factura_minutaje=$row['ID_TRONCO_PRE_FACTURA_MINUTAJE'];
            $sminutaje_pre_facturado=obtener_datos_minutaje($id_tronco_pre_factura_minutaje);
            while ($row = $sminutaje_pre_facturado->fetch_assoc()) {
                $sql_ID_minutaje=$row['ID_minutaje'];
                $sql_ID_servicio=$row['ID_servicio'];
                $sql_comentario=$row['comentario'];
                $sql_comentario="\"$sql_comentario\"";
                $sql_fecha="\"".$row['fecha']."\"";
                $sql_horas=$row['horas'];
                $sql_precio_servicio=$row['precio_servicio'];
                $sql_margen=$row['margen'];
                $sql_precio_total=$row['precio_total'];
                $sql_id_minutaje_facturado=$row['id_minutaje_facturado'];

                $crear_tronco_factura_minutaje = "INSERT INTO TRONCO_FACTURA_MINUTAJE(ID_factura,ID_minutaje, ID_servicio,fecha,horas, precio_servicio, margen,precio_total,id_minutaje_facturado, comentario)
                        VALUES ($ID_FACTURA,$sql_ID_minutaje,$sql_ID_servicio,$sql_fecha,'$sql_horas' ,$sql_precio_servicio, $sql_margen,$sql_precio_total,$sql_id_minutaje_facturado, $sql_comentario)";

                if ($conn->query($crear_tronco_factura_minutaje) == TRUE) {

                }else{
                    echo "Error: <br><br>" . $crear_tronco_factura_minutaje . "<br><br><br>" . $conn->error;
                }
            }
        }
    }

    //crear pie factura
    $total_neto = $_POST['precio_sin_iva'];
    $total_facturado = $_POST['precio_con_iva'];
    $iva = $_POST['select_box_iva'];


    $crear_pie_factura = "INSERT INTO PIE_FACTURA(ID_factura, total_facturado, IVA,total_neto)
                        VALUES ($ID_FACTURA,$total_facturado, $iva, $total_neto)";
    if ($conn->query($crear_pie_factura) == TRUE) {

    }else{
        echo "Error: <br><br>" . $crear_pie_factura . "<br><br><br>" . $conn->error;
    }

    if ($conn->query($crear_cabecera_factura) == TRUE) {

        //borrar pre_factura
        eliminar_pre_factura($id_pre_factura);

        include('crear_factura_pdf.php');
        
    }

        require_once("../class.phpmailer.php");
        require_once("../class.smtp.php");

        $fecha2 = select_fecha_factura($ID_FACTURA);
        $year = substr($fecha2, 2, 2);

        $nombrePdf = $ID_FACTURA.'.pdf';

        // Instanciamos un objeto PHPMailer
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        // Le decimos que usamos el protocolo SMTP
        $mail->IsSMTP();

        // Le decimos que es necesario autenticarse
        $mail->SMTPAuth = true;

        // Asignamos nuestro servidor SMTP
        $mail->Host = "smtp.ctw.es";

        // Asignamos el puerto SMTP que usa nuestro servidor
        // Normalmente es el 25, pero tu servidor lo podría haber cambiado.
        $mail->Port = 25;

        // Indicamos aquí nuestro nombre de usuario
        $mail->Username = "notificador@ctw.es";
        // Indicamos la contraseña
        $mail->Password = "CTWnotif17";

        // Añadimos la dirección del remitente
        $mail->From = "notificador@ctw.es";

        // Añadimos el nombre del remitente
        $mail->FromName = "CTW";

        // En la dirección de responder ponemos la misma del From
        $mail->AddReplyTo("no-reply@ctw.es","Mensaje automático");

        // Le indicamos que nuestro Email está en Html
        $mail->IsHTML(true);

        // Indicamos la dirección y el nombre del destinatario
        $mail->AddAddress($correoContacto);

        // Ponemos aquí el asunto
        $mail->Subject = "Factura CTW nº ".$ID_FACTURA;

        // Creamos todo el cuerpo del Email en Html en la variable $body
        $body = '<html>
            <head>
                
            </head>
            <body style="background:#EBEAEA">
            <div>
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="min-width:600px" bgcolor="#EBEAEA">
                    <tbody><tr>
                        <td valign="top" align="center">

                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tbody><tr>
                                    <td valign="bottom" align="center">
                                        <table cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#ffffff">
                                            <tbody><tr>
                                                <td align="center" valign="bottom">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <img src="../../img/1.png" style="display:block;border:none" alt="" width="600" height="auto">
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
                                                        <tbody><tr>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            

                            
                    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tbody>
                                <tr>
                                    <td valign="top" align="center">
                                        <table role="presentation" style="min-width:600px;width:600px" cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#ffffff">
                                            <tbody>
                                            <tr>
                                                <td align="center" style="padding:0 25px 0 25px;border-left: 4px solid #f66d2a;border-right: 4px solid #f66d2a;">
                                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                        <td>
                                                        <div style="font-family:arial,helvetica,sans-serif;color:#585c5c;font-weight:normal;text-decoration:none;Margin:0px 0 0 0;padding:0"><p></p>
                                                        <div style="margin-top:25px">
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">  
                                                        <tbody>
                                                        <tr>    
                                                        <td width="100%" style="padding:15px 0;border-top:1px dotted #c5c5c5">      
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed">        
                                                        <tbody><tr>                      
                                                        <td valign="top" style="padding:0 15px 0 15px;width:40px">              
                                                        <img alt="OPS" height="40" src="../../img/avatarCorreo.jpg" style="height:auto;line-height:100%;outline:none;text-decoration:none;border-radius:5px" width="40" class="CToWUd">            
                                                        </td>                    
                                                        <td width="100%" style="padding:0;margin:0" valign="top">            
                                                        <p style="font-family:Lucida Grande,Lucida Sans Unicode,Lucida Sans,Verdana,Tahoma,sans-serif;font-size:15px;line-height:18px;margin-bottom:0;margin-top:0;padding:0;color:#1b1d1e">
                                                        <strong>CTW</strong> 
                                                        <span>(Equipo de CTW)</span>                                          
                                                        </p>            
                                                        <p style="font-family:Lucida Grande,Lucida Sans Unicode,Lucida Sans,Verdana,Tahoma,sans-serif;font-size:13px;line-height:25px;margin-bottom:15px;margin-top:0;padding:0;color:#bbbbbb">
                                                        '.$diaActual.' '.$mesActual.', '.$horaActual.' GMT            
                                                        </p>                                    
                                                        <div style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0">
                                                        <p style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0" dir="auto">Apreciados,</p>
                                                        <p style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0" dir="auto">Adjuntamos la factura correspondiente a los servicios que tienen contratados con nosotros.</p>
                                                        <p style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0" dir="auto">Reciban un cordial saludo! :)</p><p></p>
                                                        
                                                        </div>                                  
                                                        </td>        
                                                        </tr>      
                                                        </tbody>
                                                        </table>    
                                                        </td>  
                                                        </tr>
                                                        </tbody>
                                                        </table>
                                                        </div>
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:0 0px 0px 0"></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    <div>
                                                        <img alt="OPS" height="100" style="height:auto;line-height:100%;outline:none;text-decoration:none;border-radius:5px" width="200" class="CToWUd" src="../../img/logo_factura.jpg"> 
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                            

                            

                            
                            <table class="m_6479146215315989567section" role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#EBEAEA">
                                <tbody>
                                    <tr>
                                        <td valign="top" align="center">
                                            <table class="m_6479146215315989567wrapper" role="presentation" style="min-width:600px;width:600px" cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#ffffff">
                                                <tbody>
                                                    <tr>
                                                        <td class="m_6479146215315989567mobHpadding" align="center" style="padding:0 0px 0 0px">
                                                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <img class="m_6479146215315989567resize CToWUd" src="../../img/2.png" style="display:block;border:none" alt="" width="600" height="auto">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div>

                            <div style="display:none"><div></div>
                            </div>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
            </body>
            </html>';

        // Añadimos aquí el cuerpo del Email
        $mail->MsgHTML($body);

        $fechaFactura = select_fecha_factura($ID_FACTURA);
        $anyo=substr( $fechaFactura, 0, 4 );
        $mes=substr( $fechaFactura, 5, 2 );

        //carpeta donde encontrara el pdf de la factura
        $carpetaConArchivo = '../../../factura_pdf/'.$anyo."/".$mes."/".$nombrePdf;
        $mail->AddAttachment($carpetaConArchivo);

        
        if(!$mail->Send()) {
            header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?error=altaPrefactura');
        } else {
            header('Location: enviar_correo_confirmando.php?nombrePdf='.$nombrePdf.'&correoContacto='.$correoContacto.'&idFactura='.$idFactura);
            
        }
       
    
 

    close($conn);

    ?>

<?php
}
} else {
    echo "false";
    header("location:../index.php");
}

?>