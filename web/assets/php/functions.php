<html>


    <?php

////////////////////
//activar desactivar checkbox buscador
////////////////////

//CLIENTES
function checkbox_cliente($activo, $NIF_EMPRESA)
{
    if ($activo == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_cliente($NIF_EMPRESA, $activo)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_cliente($NIF_EMPRESA, $activo)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}

//SEDES
function checkbox_sede($activo, $ID_SEDE)
{
    if ($activo == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_sede($ID_SEDE, $activo)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_sede($ID_SEDE, $activo)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}

//CONTACTOS
function checkbox_contacto($activo, $ID_CONTACTO)
{
    if ($activo == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_contacto($ID_CONTACTO, $activo)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_contacto($ID_CONTACTO, $activo)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}

function checkbox_mayorista($activo, $NIF_MAYORISTA)
{
    if ($activo == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_mayorista('$NIF_MAYORISTA', $activo)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_mayorista('$NIF_MAYORISTA', $activo)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}
//USUARIOS
function checkbox_usuarios($activo, $ID_USUARIO)
{
    if ($activo == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_usuario('$ID_USUARIO', $activo)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_usuario('$ID_USUARIO', $activo)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}
//SERVICIOS
function checkbox_servicios($activo, $ID_SERVICIO)
{
    if ($activo == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_servicio('$ID_SERVICIO', $activo)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_servicio('$ID_SERVICIO', $activo)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}

//SERVICIOS
function checkbox_minutaje_facturado($facturado, $ID_MINUTAJE)
{
    if ($facturado == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_minutaje_facturado('$ID_MINUTAJE', $facturado)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_minutaje_facturado('$ID_MINUTAJE', $facturado)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}

//FACTURAS
function checkbox_factura($cobrado, $ID_FACTURA)
{
    if ($cobrado == 0) {//imprime un input activado o desactivado
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\" ><a class=\"checkbox_activo\">&nbsp;0</a><input  type=\"checkbox\" onchange=\" onchange_factura($ID_FACTURA, $cobrado)\"><div  class=\"slider rounda\"></div></label></td>";
    } else {
        echo "<td><label style=\"margin-top: 10px; margin-left:12px;\" class=\"switcha\"><a  class=\"checkbox_activo\">&nbsp;1</a><input  type=\"checkbox\" checked onchange=\" onchange_factura($ID_FACTURA, $cobrado)\" ><div  class=\"slider rounda\"></div></label></td>";
    }

}

?>
</html>