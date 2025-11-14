<?php
session_start();

$_SESSION["login_done"] = false;
// datos para la coneccion a mysql
define('DB_SERVER','qyk884.ctw.es');
define('DB_NAME','qyk884');
define('DB_USER','qyk884');
define('DB_PASS','CTWbbdd17');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
mysqli_select_db(DB_NAME,$con);
?>