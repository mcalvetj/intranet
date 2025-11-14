<?php
ob_start();
session_start();
include('../db.php');
include('../selects.php');
//recogemos variables
$idFactura = $_POST["id"];
$correo = $_POST["correo"];
//obtenemos fecha factura
$fechaFactura = select_fecha_factura($idFactura);
//generamos ruta archivo
$anyo=substr( $fechaFactura, 0, 4 );
$mes=substr( $fechaFactura, 5, 2 );
$ruta = '../../../factura_pdf/'.$anyo."/".$mes."/".$idFactura.".pdf";
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.buzondecorreo.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'notificador@ctw.es';                     // SMTP username
    $mail->Password   = 'CTWnotif17';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('notificador@ctw.es', 'Notificador');
    $mail->addAddress($correo);
    $mail->addAddress('notificador@ctw.es');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('no-reply@ctw.es', 'Mensaje autom�tico');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment($ruta);         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Factura CTW n�'.$idFactura;
    $body = '<html>
            <head>

            </head>
            <body style="background:#ffffff">
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
                                                <td align="center" style="padding:0 25px 0 25px;border-left: 4px solid #f66d2a;border-right: 4px solid #f66d2a;border-top: 4px solid #f66d2a;border-bottom: 4px solid #f66d2a;">
                                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                        <td>
                                                        <div style="font-family:arial,helvetica,sans-serif;color:#585c5c;font-weight:normal;text-decoration:none;Margin:0px 0 0 0;padding:0"><p></p>
                                                        <div style="margin-top:25px">
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                        <tr>
                                                        <td width="100%" style="padding:15px 0;">
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed">
                                                        <tbody><tr>
                                                        <td valign="top" style="padding:0 15px 0 15px;width:40px">
                                                        </td>
                                                        <td width="100%" style="padding:0;margin:0" valign="top">
                                                        <p style="font-family:Lucida Grande,Lucida Sans Unicode,Lucida Sans,Verdana,Tahoma,sans-serif;font-size:15px;line-height:18px;margin-bottom:0;margin-top:0;padding:0;color:#1b1d1e">
                                                        <strong>CTW</strong>
                                                        <span>(Equipo de CTW)</span>
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
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    //Update factura para dejar constancia que hemos enviado por correo de la factura
    date_default_timezone_set('UTC');
    $fecha_actual = date('d/m/Y');
    $fecha_mas_correo = ' ('.$fecha_actual.' - '.$correo.') ';
    $envios_correos = select_fecha_envio_correo($idFactura);
    $fecha_mas_correo_total = $envios_correos.$fecha_mas_correo;
    $editar_factura = "UPDATE FACTURA SET fechas_envio_correo = '".$fecha_mas_correo_total."' WHERE ID_FACTURA = ".$idFactura.";";
      $conn = connect();
    if ($conn->query($editar_factura) == TRUE){
        header('Location: ../../../factura.php?ok=enviarFactura');
        close($conn);
    }else {
      echo "<br> Error al actualizar la tabla factura para actualizar el registro de envios. ".$editar_factura;
    }
    close($conn);
    ?>
    <br>
    <button onclick="window.location.href = 'http://intranet.ctw.es/web/factura/filtro_historial_factura.php';">Volver al historial de facturas</button>
<?php

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
