<?php
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
if ($_SESSION["login_done"] == true){

    // Cargamos la clase PHPMailer
    require_once("../assets/php/class.phpmailer.php");
    require_once("../assets/php/class.smtp.php");

    $idFactura = $_POST["id"];
    $correoContacto = $_POST["correo"];
    $texto = $_POST["texto"];

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

    $fecha2 = select_fecha_factura($idFactura);
    $year = substr($fecha2, 2, 2);

    $nombrePdf = $idFactura.'.pdf';

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
    $mail->Subject = "Factura CTW nº ".$idFactura;

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
                                                                <img src="../assets/img/1.png" style="display:block;border:none" alt="" width="600" height="auto">
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
                                                        <img alt="OPS" height="40" src="../assets/img/avatarCorreo.jpg" style="height:auto;line-height:100%;outline:none;text-decoration:none;border-radius:5px" width="40" class="CToWUd">            
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
                                                        <p style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0" dir="auto">'.$texto.'</p><p></p>
                                                        
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
                                                        <img alt="OPS" height="100" style="height:auto;line-height:100%;outline:none;text-decoration:none;border-radius:5px" width="200" class="CToWUd" src="../assets/img/logo_factura.jpg"> 
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
                                                                            <img class="m_6479146215315989567resize CToWUd" src="../assets/img/2.png" style="display:block;border:none" alt="" width="600" height="auto">
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

    $fechaFactura = select_fecha_factura($idFactura);
    $anyo=substr( $fechaFactura, 0, 4 );
    $mes=substr( $fechaFactura, 5, 2 );

    //carpeta donde encontrara el pdf de la factura
    $carpetaConArchivo = '../factura_pdf/'.$anyo."/".$mes."/".$nombrePdf;
    $mail->AddAttachment($carpetaConArchivo);

    



    // Instanciamos un objeto PHPMailer
    $mail2 = new PHPMailer();
    $mail2->CharSet = 'UTF-8';

    // Le decimos que usamos el protocolo SMTP
    $mail2->IsSMTP();

    // Le decimos que es necesario autenticarse
    $mail2->SMTPAuth = true;

    // Asignamos nuestro servidor SMTP
    $mail2->Host = "smtp.ctw.es";

    // Asignamos el puerto SMTP que usa nuestro servidor
    // Normalmente es el 25, pero tu servidor lo podría haber cambiado.
    $mail2->Port = 25;

    // Indicamos aquí nuestro nombre de usuario
    $mail2->Username = "notificador@ctw.es";
    // Indicamos la contraseña
    $mail2->Password = "CTWnotif17";

    // Añadimos la dirección del remitente
    $mail2->From = "notificador@ctw.es";

    // Añadimos el nombre del remitente
    $mail2->FromName = "CTW";

    // En la dirección de responder ponemos la misma del From
    $mail2->AddReplyTo("no-reply@ctw.es","Mensaje automático");

    // Le indicamos que nuestro Email está en Html
    $mail2->IsHTML(true);

    // Indicamos la dirección y el nombre del destinatario
    $mail2->AddAddress("mcalvetj@ctw.es");

    // Ponemos aquí el asunto
    $mail2->Subject = "Factura CTW nº ".$idFactura;

    // Creamos todo el cuerpo del Email en Html en la variable $body
    $body2 = '<html>
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
                                                                        <img src="../assets/img/3.png" style="display:block;border:none" alt="" width="600" height="auto">
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
                                                                <img alt="OPS" height="40" src="../assets/img/avatarCorreo.jpg" style="height:auto;line-height:100%;outline:none;text-decoration:none;border-radius:5px" width="40" class="CToWUd">            
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
                                                                <p style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0" dir="auto">Se ha enviado la factura: '.$nombrePdf.' al correo: '.$correoContacto.' con el siguiente texto:</p>
                                                                <p style="color:#2b2e2f;font-family:Lucida Sans Unicode,Lucida Grande,Tahoma,Verdana,sans-serif;font-size:14px;line-height:22px;margin:15px 0" dir="auto">'.$texto.'</p><p></p>
                                                                
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
                                                                <img alt="OPS" height="100" style="height:auto;line-height:100%;outline:none;text-decoration:none;border-radius:5px" width="200" class="CToWUd" src="../assets/img/logo_factura.jpg"> 
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
                                                                                    <img class="m_6479146215315989567resize CToWUd" src="../assets/img/2.png" style="display:block;border:none" alt="" width="600" height="auto">
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
    $mail2->MsgHTML($body2);

    $mail2->AddAttachment($carpetaConArchivo);

    // Enviamos y comprobamos si se ha mandado el Email correctamente
    if(!$mail->Send()) {
        header('Location: ../factura.php?error=enviarFactura');
    } else {
        $mail2->Send();
        date_default_timezone_set('UTC');
        $fecha = date('d/m/Y');
        $fecha_mas_correo = ' ('.$fecha.' - '.$correoContacto.') ';

        $envios_correos = select_fecha_envio_correo($idFactura);

        $fecha_mas_correo2 = $envios_correos.$fecha_mas_correo;

        $editar_factura = "UPDATE FACTURA SET fechas_envio_correo = '".$fecha_mas_correo2."' WHERE ID_FACTURA = ".$idFactura.";";
        $conn = connect();

        if ($conn->query($editar_factura) == TRUE){
            header('Location: ../factura.php?ok=enviarFactura');
        }else{
            header('Location: ../factura.php?error=enviarFechaFactura');
        }
        
    }

} else {
    echo "false";
    header("location:../index.php");
}
?>