<?php


include('db.php');


$para= $_POST['para'];
$accion= $_POST['accion'];
$pk= $_POST['pk'];

$function = $para."_".$accion;
// ACTIVAR DESACTIVAR CLIENTES
if($function == "cliente_activar"){
    cliente_activar($pk);

}else if($function == "cliente_desactivar"){
    cliente_desactivar($pk);
}
// ACTIVAR DESACTIVAR SEDES
else if($function == "sede_activar"){
   sede_activar($pk);

}else if($function == "sede_desactivar"){
    sede_desactivar($pk);
}else if($function == "contacto_desactivar"){
    contacto_desactivar($pk);
}else if($function == "contacto_activar"){
    contacto_activar($pk);
}else if($function == "factura_desactivar"){
    factura_desactivar($pk);
}else if($function == "factura_activar"){
    factura_activar($pk);
}else if($function == "mayorista_activar"){
    mayorista_activar($pk);
}else if($function == "mayorista_desactivar"){
    mayorista_desactivar($pk);
}else if($function == "usuario_activar"){
    usuario_activar($pk);
}else if($function == "usuario_desactivar"){
    usuario_desactivar($pk);
}else if($function == "servicio_activar"){
    servicio_activar($pk);
}else if($function == "servicio_desactivar"){
    servicio_desactivar($pk);
}else if($function == "minutaje_facturado"){
    minutaje_facturado($pk);
}else if($function == "minutaje_por_facturar"){
    minutaje_por_facturar($pk);
}


///////////////
//FUNCIONES
//////////////


function cliente_activar($pk){
    $conn = connect();
    $sql = "UPDATE CLIENTE
    SET activo = 1
    WHERE NIF_EMPRESA = '".$pk."'";
    $result = $conn->query($sql);
    close($conn);
}
function cliente_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE CLIENTE
    SET activo = 0
    WHERE NIF_EMPRESA = '".$pk."'";
    $result = $conn->query($sql);
    close($conn);
}
function sede_activar($pk){
    $conn = connect();
    $sql = "UPDATE SEDE
    SET activo = 1
    WHERE ID_SEDE = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function sede_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE SEDE
    SET activo = 0
    WHERE ID_SEDE = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function contacto_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE CONTACTO
    SET activo = 0
    WHERE ID_CONTACTO = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function contacto_activar($pk){
    $conn = connect();
    $sql = "UPDATE CONTACTO
    SET activo = 1
    WHERE ID_CONTACTO = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function factura_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE FACTURA
    SET cobrado = 0
    WHERE ID_FACTURA = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function factura_activar($pk){
    $conn = connect();
    $sql = "UPDATE FACTURA
    SET cobrado = 1
    WHERE ID_FACTURA = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function mayorista_activar($pk){
    $conn = connect();
    $sql = "UPDATE MAYORISTA
    SET activo = 1
    WHERE NIF_MAYORISTA = '".$pk."'";
    $result = $conn->query($sql);
    close($conn);
}
function mayorista_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE MAYORISTA
    SET activo = 0
    WHERE NIF_MAYORISTA =  '".$pk."'";
    $result = $conn->query($sql);
    close($conn);
}
function usuario_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE USUARIO
    SET activo = 0
    WHERE ID_USUARIO = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function usuario_activar($pk){
    $conn = connect();
    $sql = "UPDATE USUARIO
    SET activo = 1
    WHERE ID_USUARIO = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function servicio_activar($pk){
    $conn = connect();
    $sql = "UPDATE SERVICIO
    SET activo = 1
    WHERE ID_SERVICIO = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function servicio_desactivar($pk){
    $conn = connect();
    $sql = "UPDATE SERVICIO
    SET activo = 0
    WHERE ID_SERVICIO = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function minutaje_facturado($pk){
    $conn = connect();
    $sql = "UPDATE MINUTAJE
    SET facturado = 1
    WHERE ID_MINUTAJE = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}
function minutaje_por_facturar($pk){
    $conn = connect();
    $sql = "UPDATE MINUTAJE
    SET facturado = 0
    WHERE ID_MINUTAJE = ".$pk;
    $result = $conn->query($sql);
    close($conn);
}