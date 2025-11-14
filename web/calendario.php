  <?php
 session_start();
 include('../assets/php/db.php');
 include('../assets/php/selects.php');
 if($_SESSION["login_done"]==true){
 ?>
 
 
 <html lang="en">
 <head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 
    <title>WEB TEST</title>
 
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
     <meta name="viewport" content="width=device-width" />
 
 
     <!-- ARCHIVOS NECESARIOS PARA DATATABLES-->
 <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
 
 <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
 
 <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
 
 <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">-->
 
      <!-- ARCHIVOS NECESARIOS PARA DATATABLES-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
 
     <!--COLUMNAS QUE PUEDEN SER MODIFICADAS-->
     <script type="text/javascript" src="./assets/js/editor.js"></script>
 
 
     <!-- DATATABLES TABLAS -->
     <script src="./table/tables.js"></script>
     <!-- Bootstrap core CSS     -->
     <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
 
     <!-- Animation library for notifications   -->
     <link href="./assets/css/animate.min.css" rel="stylesheet"/>
 
     <!--  Light Bootstrap Table core CSS    -->
     <link href="./assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
 
 
     <!--  CSS for Demo Purpose, don't include it in your project     -->
     <link href="./assets/css/demo.css" rel="stylesheet" />
 
 
     <!--     Fonts and icons     -->
     <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
     <link href="./assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
 
     <!-- nuestro css -->
     <link href="./assets/css/micss.css" rel="stylesheet" />
     
     <!--<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>-->
     <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
     <!--EDIT DATATABLE CODE TYPE TABLE-->
     <link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
     
     <!--TABLE_EDITOR.CSS-->
     <link href="./assets/css/table_editor.css" rel="stylesheet"/>
     <link href="./assets/css/table.css" rel="stylesheet"/>
     <!--BOTONES EXCEL-->
     <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
     <script src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
     <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
     <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
     <script src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
     <script src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
     <!--BOTONES EXCEL CSS-->
     <link href="../assets/css/table2.css" rel="stylesheet"/>
     <!--EDIT DATATABLE CODE-->
     <link href="../assets/css/table4.css" rel="stylesheet"/>
     <!--INSERTS-->
     <link href="../assets/css/insert.css" rel="stylesheet" />
 
 
 
 </head>
 <body>
 <!--
 
         Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
         Tip 2: you can also add an image using data-image tag
 
     -->
 <div class="wrapper">
     <div class="sidebar">
 
     
 
        <div class="sidebar-wrapper">
             <div class="logo">
                 <a href="./"><img src="./assets/img/ctw_logo.gif" alt="CTW Logo"></a>
                  
             </div>
 
             <ul class="nav">
                <li>
                    <a href="./index.php">
                        <i class="pe-7s-note2"></i>
                        <p>INICIO</p>
                    </a>
                </li>                
                <li>
                    <a href="./buscador/buscador.php">
                        <i class="pe-7s-search"></i>
                        <p>Buscador</p>
                    </a>
                </li>
                <li>
                    <a href="entrada_stock.php">
                        <i class="pe-7s-box2"></i>
                        <p>Entrada de stock</p>
                    </a>
                </li>
                <li>
                    <a href="./insert/insert.php">
                        <i class="pe-7s-pen"></i>
                        <p>Insert</p>
                    </a>
                </li>
                <li>
                    <a href="./minutaje_manual.php">
                        <i class="pe-7s-pen"></i>
                        <p>Minutaje (manual)</p>
                    </a>
                </li>
                <li>
                    <a href="./minutaje_automatico.php">
                        <i class="pe-7s-pen"></i>
                        <p>Minutaje (automatico)</p>
                    </a>
                </li>
                <li class="active">
                    <a href="./calendario.php">
                        <i class="pe-7s-pen"></i>
                        <p>Calendario</p>
                    </a>
                </li>
            </ul>
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
                    <a class="navbar-brand">Buscador</a>
                 </div>
                 <div class="collapse navbar-collapse">
                     <ul class="nav navbar-nav navbar-right">
                         <li>
                             <a href="../user.php"> <?php echo $_SESSION["username"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a>
                         </li>
                         <li>
                             <a href="../../logout.php">Log out
                             </a>
                         </li>
                     </ul>
                 </div>
             </div>
         </nav>
 
 
         <div class="content">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
 
                              <?php 
                              function getGCalendarUrl($event){  
                                $titulo = urlencode($event['titulo']); 
                                $descripcion = urlencode($event['descripcion']); 
                                $localizacion = urlencode($event['localizacion']); 
                                $start=new DateTime($event['fecha_inicio'].' '.$event['hora_inicio'].' '.date_default_timezone_get()); 
                                $end=new DateTime($event['fecha_fin'].' '.$event['hora_fin'].' '.date_default_timezone_get()); $dates = urlencode($start->format("Ymd\THis")) . "/" . urlencode($end->format("Ymd\THis"));
                                $name = urlencode($event['nombre']);
                                $url = urlencode($event['url']);
                                $gCalUrl = "http://www.google.com/calendar/event?action=TEMPLATE&amp;text=$titulo&amp;dates=$dates&amp;details=$descripcion&amp;location=$localizacion&amp;trp=false&amp;sprop=$url&amp;sprop=name:$name";
                                return ($gCalUrl);
                                }
                                // array asociativo con los parametros mecesarios.
                                $evento = array(
                                  'titulo' => 'Mi evento de prueba',
                                  'descripcion' => 'Descripcion del evento de prueba',
                                  'localizacion' => 'Aqui ponemos la dirección donde se celebra el evento',
                                  'fecha_inicio' => '2014-04-10', // Fecha de inicio de evento en formato AAAA-MM-DD
                                'hora_inicio'=>'17:30', // Hora Inicio del evento
                                'fecha_fin'=>'2014-04-12', // Fecha de fin de evento en formato AAAA-MM-DD
                                'hora_fin'=>'19:00', // Hora final del evento
                                'nombre'=>'ReviBlog', // Nombre del sitio
                                'url'=>'www.reviblog.net' // Url de la página
                                );
                                ?>
                                <iframe src="https://calendar.google.com/calendar/embed?src=tutq89pua5n7fp1b596im3vq6s%40group.calendar.google.com&ctz=Europe/Madrid" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                                <a href="<?php echo getGCalendarUrl($evento); ?>"><img src="http://www.google.com/calendar/images/ext/gc_button6_es.gif" border="0"></a>                                   
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