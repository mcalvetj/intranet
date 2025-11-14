<?php
ob_start();
session_start();
include('../assets/php/db.php');
include('../assets/php/selects.php');
if ($_SESSION["login_done"] == true){

    // Cargamos la clase PHPMailer
    require_once("../assets/php/class.phpmailer.php");
    require_once("../assets/php/class.smtp.php");

    //$idFactura = $_POST["id"];
    //$correoContacto = $_POST["correo"];

    /*$diaActual = date("d");
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

    $nombrePdf = $idFactura.'.pdf';*/

    // Instanciamos un objeto PHPMailer
    $mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.buzondecorreo.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'notificador@ctw.es';
$mail->Password = 'CTWnotif17';
$mail->setFrom('notificador@ctw.es', 'Your Name');
$mail->addReplyTo('no-reply@ctw.es","Mensaje automático');
$mail->addAddress('sergi.capellera@gmail.com', 'Receiver Name');
$mail->Subject = 'PHPMailer SMTP message';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->AltBody = 'This is a plain text message body';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
    else {
    echo "false";
    header("location:../index.php");
}
ob_end_flush();
?>
