<?php

$_SESSION["login_done"] = false;
// datos para la coneccion a mysql
/*define('DB_SERVER','qyk884.ctw.es');
define('DB_NAME','qyk884');
define('DB_USER','qyk884');
define('DB_PASS','CTWbbdd17');*/
define('DB_SERVER','localhost');
define('DB_NAME','QTC152');
//define('DB_USER','phpmyadmin');
define('DB_USER','intra_phpmyadmin');
define('DB_PASS','Unisys00!');


$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS, DB_NAME);
?>