<?php

    $nombrePdf = $_GET['nombrePdf'];
    $correoContacto = $_GET['correoContacto'];
    $idFactura = $_GET['idFactura'];

    require_once("../class.phpmailer.php");
    require_once("../class.smtp.php");

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
    $mail->AddAddress("mcalvetj@ctw.es");

    // Ponemos aquí el asunto
    $mail->Subject = "Factura CTW nº ".$idFactura;

    // Creamos todo el cuerpo del Email en Html en la variable $body
    $body = '<html>
    <head>
        <style>
            @font-face {
                font-family: "AgfaRotisSemiSerif";
            }
            header{height:15%;} #logo{width: 40%;} #img_logo{display: block;width: 100%;} #text_logo {margin-top: 1%;font-family: AgfaRotisSemiSerif;font-size: 13px;text-align: center;}
            .negrita {
                font-weight: bold;
            }
            #body{
                width: 70%;
            }
            #texto{
            }
        </style>
    </head>
    <body id="body">
    <header>
        <div id="logo">
            <div id="img_logo"><img src="http://ctw.es/wp-content/uploads/2015/04/CTW_trans.gif" alt="CTW Logo" style="width: 200px;"></div>
        </div>
    </header>
        <div id="texto">
        <br><br>
        <a style="margin-top:15px;">Apreciados,</a>
          <br><br>
          <a style="margin-top:15px;">Se ha enviado la factura: '.$nombrePdf.' al correo: '.$correoContacto.'</a>
          <br><br>
        </div> 
    </body>
    </html>';

    // Añadimos aquí el cuerpo del Email
    $mail->MsgHTML($body);

    //carpeta donde encontrara el pdf de la factura
    $carpetaConArchivo = '../../../factura_pdf/'.$nombrePdf;
    $mail->AddAttachment($carpetaConArchivo);

    if(!$mail->Send()) {
        header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?error=altaPrefactura');
   
    } else {
        header('Location: ../../../pre_factura/ver_prefactura_seleccion.php?ok=altaPrefactura');
        
    }
 
?>