    <!doctype html>

<?php
session_start();
include('../../php/db.php');
include('../../php/selects.php');
if($_SESSION["login_done"]==true){
?>


<html lang="en">
<head>

    <!--INSERTS-->
    <link href="../../css/insert.css" rel="stylesheet" />
    <!--CARGAR BARRA INSERT-->
    <link href="../../css/cargarinsert.css" rel="stylesheet" />

</head>
<body onload="itv = setInterval(prog, 10)">

<div>

					<?php
					//Declaramos las variables del formulario
					$nombre = $_POST['nombre'];
					$descripcion = $_POST['descripcion'];
					$precio = $_POST['precio'];
					$nif_empresa = $_POST['select_box_nif_empresa'];

					//Añadimos comillas a los varchars
					$nombre="\"$nombre\"";
					$descripcion="\"$descripcion\"";
					$nif_empresa="\"$nif_empresa\"";

					//Si hay algun campo opcional no rellenado lo transforma en null
					if($descripcion == "\"\""){
						$descripcion = 'null';
					}if($nif_empresa == "\"\""){
						$nif_empresa = 'null';
					}


					//Conectamos con la base de datos, hacemos los inserts y cerramos conexion.
					$conn = connect();

					$sql = "INSERT INTO SERVICIO (nombre, descripcion, precio, NIF_empresa)
					VALUES ($nombre, $descripcion, $precio, $nif_empresa)";
					    


					if ($conn->query($sql) === TRUE) {

                        // Cargamos la clase PHPMailer
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
                        $mail->Username = "facturador@ctw.es";
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
                        $mail->AddAddress("16java16@gmail.com", "pepe");

                        // Ponemos aquí el asunto
                        $mail->Subject = "Envio facturación";

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
                            <div id="img_logo"><img src="http://ctw.es/wp-content/uploads/2015/04/CTW_trans.gif" alt="CTW Logo" style="width: 100%;"></div>
                        </div>
                    </header>
                        <div id="texto">
                        <br><br>
                          <br><br><br>
                        </div> 
                    <footer>
                        <div id="datos_contacto_factura">
                            <a class="negrita">www.ctw.es</a><br>
                            <a class="negrita">mcalvetj@ctw.es</a><br>
                            <a class="negrita">Catalonian Technologie Werke, S.L</a><br>
                            <a>Carrer Bisbe Sivilla 38-40, Atico</a><br>
                            <a>08022 Barcelona</a><br>
                            <a>Tel (34) 93 4181172</a><br>
                            <a>610 246 574</a><br>
                        </div>
                    </footer>
                    </body>
                    </html>';

                        // Añadimos aquí el cuerpo del Email
                        $mail->MsgHTML($body);

                        // Enviamos y comprobamos si se ha mandado el Email correctamente
                        if(!$mail->Send()) {
                            $mensaje_a_mostrar = "Mailer Error: " . $mail->ErrorInfo . "<br>";
                            $hay_errores = true;
                        } else {
                            $mensaje_a_mostrar = "Tu mensaje ha sido enviado.<br>";
                            $hay_errores = false;
                        }
                        header('Location: ../../../insert.php?ok=altaServicio');
					} else {
                        header('Location: ../../../insert.php?error=altaServicio');
					}

					close($conn); 
					 
					?>

</div>
</body>
</html>

<?php 
}else{
    echo "false";
    header("location:../index.php");
}

?>