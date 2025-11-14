<?php
function select_all_pais()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM PAIS
    ORDER BY PAIS asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_articulos_pre_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM TRONCO_PRE_FACTURA_ARTICULO WHERE ID_pre_factura = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}
function get_importe_sin_iva($id_factura)
{
    $conn = connect();
    $sql = "SELECT total_neto 
    FROM PIE_FACTURA WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['total_neto'];
    close($conn);
    return $value;
}

function get_precio_total_presupuesto($ID_TRONCO_PRESUPUESTO)
{
    $conn = connect();
    $sql = "SELECT precio_total 
    FROM TRONCO_PRESUPUESTO WHERE ID_TRONCO_PRESUPUESTO = '" . $ID_TRONCO_PRESUPUESTO . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['precio_total'];
    close($conn);
    return $value;
}

function get_iva_presupuesto($ID_presupuesto)
{
    $conn = connect();
    $sql = "SELECT IVA 
    FROM PIE_PRESUPUESTO WHERE ID_presupuesto = '" . $ID_presupuesto . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['IVA'];
    close($conn);
    return $value;
}
function get_total_neto_presupuesto($ID_presupuesto)
{
    $conn = connect();
    $sql = "SELECT total_neto 
    FROM PIE_PRESUPUESTO WHERE ID_presupuesto = '" . $ID_presupuesto . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['total_neto'];
    close($conn);
    return $value;
}
function get_total_facturado_presupuesto($ID_presupuesto)
{
    $conn = connect();
    $sql = "SELECT total_facturado 
    FROM PIE_PRESUPUESTO WHERE ID_presupuesto = '" . $ID_presupuesto . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['total_facturado'];
    close($conn);
    return $value;
}

function select_all_servicios_pre_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM TRONCO_PRE_FACTURA_SERVICIO WHERE ID_pre_factura = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_pie_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM PIE_PRESUPUESTO WHERE ID_presupuesto = '" . $id_presupuesto . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_minutajes_pre_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM TRONCO_PRE_FACTURA_MINUTAJE WHERE ID_pre_factura = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_prefijo_pais($pais)
{
    $conn = connect();
    $utf = ("set names 'utf8'");
    $conn->query($utf);
    $sql = "SELECT prefijo FROM PAIS WHERE PAIS = '" . $pais . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $prefijo = $row['prefijo'];
    close($conn);
    return $prefijo;
}

function codigo_de_barras_articulo($id_articulo)
{
    $conn = connect();
    $sql = "SELECT codigo_de_barras FROM ARTICULO WHERE ID_ARTICULO= '" . $id_articulo . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $codigo_de_barras = $row['codigo_de_barras'];
    close($conn);
    return $codigo_de_barras;
}

function codigo_de_barras_articulo_pre_facturado($id_articulo)
{
    $conn = connect();
    $sql = "SELECT codigo_de_barras FROM ARTICULO_FACTURADO WHERE ID_ARTICULO= '" . $id_articulo . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $codigo_de_barras = $row['codigo_de_barras'];
    close($conn);
    return $codigo_de_barras;
}

function cantidad_articulo($id_articulo)
{
    $conn = connect();
    $sql = "SELECT cantidad FROM ARTICULO WHERE ID_ARTICULO= '" . $id_articulo . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $cantidad = $row['cantidad'];
    close($conn);
    return $cantidad;
}

function select_all_contacto()
{
    $conn = connect();
    $sql = "SELECT *
    FROM CONTACTO";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_prefacturas()
{
    $conn = connect();
    $sql = "SELECT *
    FROM PRE_FACTURA";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_presupuestos()
{
    $conn = connect();
    $sql = "SELECT *
    FROM PRESUPUESTO";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_cliente_presupuesto($ID_PRESUPUESTO)
{
    $conn = connect();
    $sql = "SELECT * FROM CABECERA_PRESUPUESTO WHERE ID_presupuesto = '" . $ID_PRESUPUESTO . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['NIF_cliente'];
    close($conn);
    return $value;
}

function select_nif_cliente_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT * FROM CABECERA_FACTURA WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['NIF_cliente'];
    close($conn);
    return $value;
}

function select_comentario_prefactura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT * FROM PRE_FACTURA WHERE ID_PRE_FACTURA = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['comentario'];
    close($conn);
    return $value;
}

function select_fecha_envio_correo($id_factura)
{
    $conn = connect();
    $sql = "SELECT * FROM FACTURA WHERE ID_FACTURA = '" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['fechas_envio_correo'];
    close($conn);
    return $value;
}

function select_comentario_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT * FROM FACTURA WHERE ID_FACTURA = '" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['comentario'];
    close($conn);
    return $value;
}

function select_correo_cliente_factura($nif_cliente)
{
    $conn = connect();
    $sql = "SELECT * FROM CLIENTE WHERE NIF_EMPRESA = '" . $nif_cliente . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['email'];
    close($conn);
    return $value;
}

function select_cantidad_stock($codigo_de_barras)
{
    $conn = connect();
    $sql = "SELECT cantidad_total FROM STOCK WHERE CODIGO_DE_BARRAS = '" . $codigo_de_barras . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $cantidad = $row['cantidad_total'];
    close($conn);
    return $cantidad;
}

function select_fecha_factura($idFactura)
{
    $conn = connect();
    $sql = "SELECT fecha_factura FROM CABECERA_FACTURA WHERE ID_factura = '" . $idFactura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $fecha_factura = $row['fecha_factura'];
    close($conn);
    return $fecha_factura;
}

function select_all_cliente()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM CLIENTE
    ORDER BY activo desc, nombre_completo asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_cliente_utf8()
{
    $conn = connect();
    $utf = ("set names 'utf8'");
    $conn->query($utf);
    $sql = "SELECT * 
    FROM CLIENTE
    ORDER BY activo desc, nombre_completo asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_cliente_activo()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM CLIENTE
    WHERE activo = 1
    ORDER BY activo desc, nombre_completo asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function borrar_articulo($id_articulo)
{
    $conn = connect();
    $sql = "DELETE FROM 'ARTICULO' WHERE ID_ARTICULO = " . $id_articulo;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function borrar_stock($codigo_de_barras)
{
    $conn = connect();
    $sql = "DELETE FROM 'STOCK' WHERE CODIGO_DE_BARRAS = '" . $codigo_de_barras . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function update_stock($codigo_de_barras, $cantidad_total)
{
    $conn = connect();
    $sql = "UPDATE STOCK SET cantidad_total = $cantidad_total  WHERE  CODIGO_DE_BARRAS = '" . $codigo_de_barras . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_sede_buscador()
{
    $conn = connect();
    $sql = "SELECT S.ID_SEDE, S.NIF_cliente, S.nombre, S.ubicacion, S.ciudad, S.codigo_postal, S.calle, S.numero, S.pais, S.prefijo, S.telefono
    FROM SEDE S, CLIENTE C
    WHERE C.NIF_EMPRESA = S.NIF_cliente
    and C.activo=1";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_sede_activo()
{
    $conn = connect();
    $sql = "SELECT *
    FROM SEDE S, CLIENTE C
    WHERE S.NIF_cliente = C.NIF_EMPRESA";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_rol()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM ROL";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_iva()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM IVA";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_sede()
{
    $conn = connect();
    $sql = "SELECT *
    FROM SEDE S, CLIENTE C
    WHERE S.NIF_cliente = C.NIF_EMPRESA";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_mayorista()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM MAYORISTA
    ORDER BY nombre_empresa asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_sepa()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM SEPA";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_servicio()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM SERVICIO
    ORDER BY nombre asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_servicio_cliente($NIF_cliente)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM SERVICIO
    WHERE NIF_empresa='.$NIF_cliente.'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_usuario()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM USUARIO
    ORDER BY nombre asc";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_stock()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM STOCK";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_articulo()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM ARTICULO";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_articulo_facturado()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM ARTICULO_FACTURADO";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_servicio_facturado()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM SERVICIO_FACTURADO";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_minutaje_facturado()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM MINUTAJE_FACTURADO";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_all_minutaje()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM MINUTAJE";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_margenes()
{
    $conn = connect();
    $sql = "SELECT margen as m_margen 
    FROM MARGEN";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_sede_cliente($nif_cliente)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM SEDE S
    WHERE S.NIF_cliente = '" . $nif_cliente . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_servicio_cliente($nif_cliente)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM SERVICIO S
    WHERE S.NIF_empresa = '" . $nif_cliente . "'
    OR S.NIF_empresa IS NULL";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_articulo_with_codigo_de_barras($codigo_de_barras)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM ARTICULO
    WHERE codigo_de_barras = '" . $codigo_de_barras . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_pre_factura_cliente($nif_cliente)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM PRE_FACTURA PF
    WHERE PF.NIF_empresa = '" . $nif_cliente . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_presupuesto_cliente($nif_cliente)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM PRESUPUESTO PR
    WHERE PR.NIF_empresa = '" . $nif_cliente . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_facturas_fechas($fecha_inicio,$fecha_final)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM FACTURA
    WHERE fecha BETWEEN '$fecha_inicio' and '$fecha_final'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_nombre_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT nombre FROM PRESUPUESTO WHERE ID_PRESUPUESTO = " . $id_presupuesto ;
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['nombre'];
    close($conn);
    return $valor;
}
function get_comentario_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT comentario FROM PRESUPUESTO WHERE ID_PRESUPUESTO = " . $id_presupuesto ;
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['comentario'];
    close($conn);
    return $valor;
}

function select_id_sede($nombre, $ubicacion)
{
    $conn = connect();
    $sql = "SELECT ID_SEDE FROM SEDE WHERE nombre = '" . $nombre . "' AND ubicacion = '" . $ubicacion . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $prefijo = $row['ID_SEDE'];
    close($conn);
    return $prefijo;
}

function select_id_servicio($nombre)
{
    $conn = connect();
    $sql = "SELECT ID_SERVICIO FROM SERVICIO WHERE nombre = '" . $nombre . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $prefijo = $row['ID_SERVICIO'];
    close($conn);
    return $prefijo;
}

function select_all_user($id_user)
{
    $conn = connect();
    $sql = "SELECT *
    FROM USUARIO
    WHERE ID_USUARIO = '" . $id_user . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function select_password_user($id_user)
{
    $conn = connect();
    $sql = "SELECT *
        FROM USUARIO
        WHERE ID_USUARIO = '" . $id_user . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $password = $row['password'];
    close($conn);
    return $password;
}

function select_nombre_servicio($ID_servicio)
{
    $conn = connect();
    $sql = "SELECT nombre 
    FROM SERVICIO WHERE ID_SERVICIO = '" . $ID_servicio . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_servicio = $row['nombre'];
    close($conn);
    return $nombre_servicio;
}

function select_nombre_pre_factura($pre_factura)
{
    $conn = connect();
    $sql = "SELECT nombre 
    FROM PRE_FACTURA WHERE ID_PRE_FACTURA = '" . $pre_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre = $row['nombre'];
    close($conn);
    return $nombre;
}

function select_nif_empresa_pre_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT NIF_empresa 
    FROM PRE_FACTURA WHERE ID_PRE_FACTURA = '" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nif_factura = $row['NIF_empresa'];
    close($conn);
    return $nif_factura;
}

function select_nif_empresa_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT NIF_empresa 
    FROM PRESUPUESTO WHERE ID_PRESUPUESTO = '" . $id_presupuesto . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['NIF_empresa'];
    close($conn);
    return $valor;
}

function select_nombre_empresa_pre_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT nombre 
    FROM PRE_FACTURA WHERE ID_PRE_FACTURA = '" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre = $row['nombre'];
    close($conn);
    return $nombre;
}

function select_nombre_usuario($ID_usuario)
{
    $conn = connect();
    $sql = "SELECT nombre 
    FROM USUARIO WHERE ID_USUARIO = '" . $ID_usuario . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_usuario = $row['nombre'];
    close($conn);
    return $nombre_usuario;
}

function select_nombre_sede($ID_sede)
{
    $conn = connect();
    $sql = "SELECT nombre 
    FROM SEDE WHERE ID_SEDE = '" . $ID_sede . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_sede = $row['nombre'];
    close($conn);
    return $nombre_sede;
}

function select_nombre_cliente($NIF_cliente)
{
    $conn = connect();
    $sql = "SELECT *
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $NIF_cliente . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_cliente = $row['nombre_comercial'];
    close($conn);
    return $nombre_cliente;
}

function select_nombre_completo_cliente($NIF_cliente)
{
    $conn = connect();
    $sql = "SELECT nombre_completo
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $NIF_cliente . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_cliente = $row['nombre_completo'];
    close($conn);
    return $nombre_cliente;
}

function select_nombre_completo_cliente_por_correo($correo)
{
    $conn = connect();
    $sql = "SELECT nombre_completo
    FROM CLIENTE WHERE correo = '" . $correo . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_cliente = $row['nombre_completo'];
    close($conn);
    return $nombre_cliente;
}

function select_nombre_mayorista($NIF_mayorista)
{
    $conn = connect();
    $sql = "SELECT nombre_empresa
    FROM MAYORISTA WHERE NIF_MAYORISTA = '" . $NIF_mayorista . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_mayorista = $row['nombre_empresa'];
    close($conn);
    return $nombre_mayorista;
}

function select_ID_factura($ID_articulo_facturado)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_ARTICULO WHERE id_articulo_facturado = '" . $ID_articulo_facturado . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ID_factura = $row['ID_factura'];
    close($conn);
    return $ID_factura;
}

//PRE_FACTURAS//////////////////////

function get_id_pre_factura($cliente, $nombre_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM PRE_FACTURA 
    WHERE NIF_empresa = '" . $cliente . "'
    AND nombre='" . $nombre_pre_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ID_PRE_FACTURA = $row['ID_PRE_FACTURA'];
    close($conn);
    return $ID_PRE_FACTURA;
}


//PRE_FACTURA_ARTICULO//////////////////////
function last_id_articulo_facturado()
{
    $conn = connect();
    $sql = "SELECT 	ID_ARTICULO_FACTURADO
    FROM ARTICULO_FACTURADO
    ORDER BY ID_ARTICULO_FACTURADO desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $id_articulo_facturado = $row['ID_ARTICULO_FACTURADO'];
    close($conn);
    return $id_articulo_facturado;
}

function id_crear_cabecera_pre_factura($nombre_pre_factura, $nif_cliente)
{
    $conn = connect();
    $sql = "SELECT ID_PRE_FACTURA
    FROM PRE_FACTURA 
    WHERE nombre = '" . $nombre_pre_factura . "'
    and NIF_empresa = '" . $nif_cliente . "'
    ORDER BY ID_PRE_FACTURA desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $id_pre_factura = $row['ID_PRE_FACTURA'];
    close($conn);
    return $id_pre_factura;
}

function ciudad_facturacion_crear_cabecera_pre_factura($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT ciudad_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $nif_empresa . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ciudad_facturacion = $row['ciudad_facturacion'];
    close($conn);
    return $ciudad_facturacion;
}

function codigo_postal_facturacion_crear_cabecera_pre_factura($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT codigo_postal_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $nif_empresa . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $odigo_postal_facturacion = $row['codigo_postal_facturacion'];
    close($conn);
    return $odigo_postal_facturacion;
}

function calle_facturacion_crear_cabecera_pre_factura($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT calle_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $nif_empresa . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $calle_facturacion = $row['calle_facturacion'];
    close($conn);
    return $calle_facturacion;
}

function numero_facturacion_crear_cabecera_pre_factura($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT numero_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $nif_empresa . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $numero_facturacion = $row['numero_facturacion'];
    close($conn);
    return $numero_facturacion;
}

function get_articulo_pre_factura($ID_ARTICULO)
{
    $conn = connect();
    $sql = "SELECT *
    FROM ARTICULO WHERE ID_ARTICULO = '" . $ID_ARTICULO . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_sede_id_sede($id_sede)
{
    $conn = connect();
    $sql = "SELECT nombre FROM SEDE WHERE ID_SEDE = '" . $id_sede . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $sede = $row['nombre'];
    close($conn);
    return $sede;
}

function get_servicio_id_servicio($id_servicio)
{
    $conn = connect();
    $sql = "SELECT nombre FROM SERVICIO WHERE ID_SERVICIO = '" . $id_servicio . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $servicio = $row['nombre'];
    close($conn);
    return $servicio;
}

//PRE_FACTURA_MINUTAJE//////////////////////
function get_minutaje_pre_factura($ID_MINUTAJE)
{
    $conn = connect();
    $sql = "SELECT *
    FROM MINUTAJE WHERE ID_MINUTAJE = '" . $ID_MINUTAJE . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_precio_servicio($ID_servicio)
{
    $conn = connect();
    $sql = "SELECT *
    FROM SERVICIO WHERE ID_SERVICIO = '" . $ID_servicio . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $precio = $row['precio'];
    close($conn);
    return $precio;
}

//PRE_FACTURA_SERVICIO//////////////////////
function get_servicio_pre_factura($ID_SERVICIO)
{
    $conn = connect();
    $sql = "SELECT *
    FROM SERVICIO WHERE ID_SERVICIO = " . $ID_SERVICIO;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_datos_cliente($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT *
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $nif_empresa . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

//VER PRE_FACTURA//////////////////////
//////////////////////////////////////////////////////////////////
function precio_unidad_articulo_facturado($id_articulo_facturado)
{
    $conn = connect();
    $sql = "SELECT *
    FROM ARTICULO_FACTURADO
    WHERE ID_ARTICULO_FACTURADO =$id_articulo_facturado";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $precio = $row['precio'];
    close($conn);
    return $precio;
}

function precio_unidad_servicio_facturado($id_servicio_facturado)
{
    $conn = connect();
    $sql = "SELECT *
    FROM SERVICIO_FACTURADO
    WHERE ID_SERVICIO_FACTURADO =$id_servicio_facturado";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $precio = $row['precio'];
    close($conn);
    return $precio;
}

function get_servicio_minutaje($id_servicio_facturado)
{
    $conn = connect();
    $sql = "SELECT *
    FROM SERVICIO_FACTURADO
    WHERE ID_SERVICIO_FACTURADO =$id_servicio_facturado";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ID_SERVICIO = $row['ID_servicio'];
    close($conn);
    return $ID_SERVICIO;
}

function get_ver_pre_factura_articulos($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_ARTICULO WHERE ID_pre_factura = " . $id_pre_factura;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_ver_productos_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRESUPUESTO WHERE ID_presupuesto = " . $id_presupuesto;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_ver_pre_factura_servicios($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_SERVICIO WHERE ID_pre_factura = " . $id_pre_factura;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_ver_pre_factura_minutajes($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_MINUTAJE WHERE ID_pre_factura = " . $id_pre_factura;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_nombre_articulo($ID_articulo)
{
    $conn = connect();
    $sql = "SELECT *
    FROM ARTICULO_FACTURADO WHERE ID_ARTICULO_FACTURADO = '" . $ID_articulo . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre = $row['nombre'];
    close($conn);
    return $nombre;
}

function get_nombre_servicio($ID_servicio)
{
    $conn = connect();
    $sql = "SELECT *
    FROM SERVICIO WHERE ID_SERVICIO = '" . $ID_servicio . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre = $row['nombre'];
    close($conn);
    return $nombre;
}

function get_descripcion_servicio($ID_servicio)
{
    $conn = connect();
    $sql = "SELECT *
    FROM SERVICIO WHERE ID_SERVICIO = '" . $ID_servicio . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $descripcion = $row['descripcion'];
    close($conn);
    return $descripcion;
}

function get_articulo_facturado($id_articulo_facturado)
{
    $conn = connect();
    $sql = "SELECT *
    FROM ARTICULO_FACTURADO WHERE ID_ARTICULO_FACTURADO = '" . $id_articulo_facturado . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_row_stock($codigo_de_barras)
{
    $conn = connect();
    $sql = "SELECT count(*)
    FROM STOCK where CODIGO_DE_BARRAS = '" . $codigo_de_barras . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $total = $row['count(*)'];
    close($conn);
    return $total;
}

function last_id_servicio_facturado()
{
    $conn = connect();
    $sql = "SELECT 	ID_SERVICIO_FACTURADO
    FROM SERVICIO_FACTURADO
    ORDER BY ID_SERVICIO_FACTURADO desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $id_servicio_facturado = $row['ID_SERVICIO_FACTURADO'];
    close($conn);
    return $id_servicio_facturado;
}

function last_id_minutaje_facturado()
{
    $conn = connect();
    $sql = "SELECT 	ID_MINUTAJE_FACTURADO
    FROM MINUTAJE_FACTURADO
    ORDER BY ID_MINUTAJE_FACTURADO desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $id_minutaje_facturado = $row['ID_MINUTAJE_FACTURADO'];
    close($conn);
    return $id_minutaje_facturado;
}

function get_minutaje_facturado($id_minutaje_facturado)
{
    $conn = connect();
    $sql = "SELECT *
    FROM MINUTAJE_FACTURADO WHERE ID_MINUTAJE_FACTURADO = '" . $id_minutaje_facturado . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_last_fecha_factura()
{
    $conn = connect();
    $sql = "SELECT fecha
    FROM FACTURA
    ORDER BY fecha desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $timestamp = strtotime($row['fecha']);
    close($conn);
    return $timestamp;
}

function get_cliente_pre_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT NIF_empresa
    FROM PRE_FACTURA WHERE ID_PRE_FACTURA = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $NIF_cliente = $row['NIF_empresa'];
    close($conn);
    return $NIF_cliente;
}

function get_ciudad_facturacion($NIF_EMPRESA)
{
    $conn = connect();
    $sql = "SELECT ciudad_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $NIF_EMPRESA . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ciudad_facturacion = $row['ciudad_facturacion'];
    close($conn);
    return $ciudad_facturacion;
}

function get_codigo_postal_facturacion($NIF_EMPRESA)
{
    $conn = connect();
    $sql = "SELECT codigo_postal_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $NIF_EMPRESA . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ciudad_facturacion = $row['codigo_postal_facturacion'];
    close($conn);
    return $ciudad_facturacion;
}

function get_calle_facturacion($NIF_EMPRESA)
{
    $conn = connect();
    $sql = "SELECT calle_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $NIF_EMPRESA . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $calle_facturacion = $row['calle_facturacion'];
    close($conn);
    return $calle_facturacion;
}

function get_numero_facturacion($NIF_EMPRESA)
{
    $conn = connect();
    $sql = "SELECT numero_facturacion
    FROM CLIENTE WHERE NIF_EMPRESA = '" . $NIF_EMPRESA . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $numero_facturacion = $row['numero_facturacion'];
    close($conn);
    return $numero_facturacion;
}

function get_last_id_factura()
{
    $conn = connect();
    $sql = "SELECT ID_FACTURA
    FROM FACTURA
    ORDER BY ID_FACTURA desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $ID_FACTURA = $row['ID_FACTURA'];
    close($conn);
    return $ID_FACTURA;
}

function get_last_id_presupuesto()
{
    $conn = connect();
    $sql = "SELECT ID_PRESUPUESTO
    FROM PRESUPUESTO
    ORDER BY ID_PRESUPUESTO desc";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $value = $row['ID_PRESUPUESTO'];
    close($conn);
    return $value;
}

function obtener_articulos_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_ARTICULO WHERE ID_pre_factura = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_articulos_factura_rectificativa($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_ARTICULO WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_datos_articulo($id_tronco_pre_factura_articulo)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_ARTICULO WHERE ID_TRONCO_PRE_FACTURA_ARTICULO = '" . $id_tronco_pre_factura_articulo . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}




function obtener_servicios_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_SERVICIO WHERE ID_pre_factura = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}
function obtener_servicios_factura_rectificativa($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_SERVICIO WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}
function obtener_datos_articulo_rectificativo($id_tronco_factura_articulo)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_ARTICULO WHERE ID_TRONCO_FACTURA_ARTICULO = '" . $id_tronco_factura_articulo . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_minutaje_factura_rectificativa($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_MINUTAJE WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_datos_servicio_rectificativo($id_tronco_factura_servicio)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_SERVICIO WHERE ID_TRONCO_FACTURA_SERVICIO = '" . $id_tronco_factura_servicio . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_datos_servicio($id_tronco_pre_factura_servicio)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_SERVICIO WHERE ID_TRONCO_PRE_FACTURA_SERVICIO = '" . $id_tronco_pre_factura_servicio . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_minutaje_factura($id_pre_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_MINUTAJE WHERE ID_pre_factura = '" . $id_pre_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function obtener_datos_minutaje($id_tronco_pre_factura_minutaje)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRE_FACTURA_MINUTAJE WHERE ID_TRONCO_PRE_FACTURA_MINUTAJE = '" . $id_tronco_pre_factura_minutaje . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function eliminar_pre_factura($id_pre_factura)
{
    $conn = connect();
    $sql_pre_factura = "DELETE FROM `PRE_FACTURA` WHERE `ID_PRE_FACTURA`='" . $id_pre_factura . "'";
    $conn->query($sql_pre_factura);
    $sql_cabecera_pre_factura = "DELETE FROM `CABECERA_PRE_FACTURA` WHERE `ID_pre_factura`='" . $id_pre_factura . "'";
    $conn->query($sql_cabecera_pre_factura);
    $sql_tronco_pre_factura_articulo = "DELETE FROM `TRONCO_PRE_FACTURA_ARTICULO` WHERE `ID_pre_factura`='" . $id_pre_factura . "'";
    $conn->query($sql_tronco_pre_factura_articulo);
    $sql_tronco_pre_factura_minutaje = "DELETE FROM `TRONCO_PRE_FACTURA_MINUTAJE` WHERE `ID_pre_factura`='" . $id_pre_factura . "'";
    $conn->query($sql_tronco_pre_factura_minutaje);
    $sql_tronco_pre_factura_servicio = "DELETE FROM `TRONCO_PRE_FACTURA_SERVICIO` WHERE `ID_pre_factura`='" . $id_pre_factura . "'";
    $conn->query($sql_tronco_pre_factura_servicio);
    $sql_pie_pre_factura = "DELETE FROM `PIE_PRE_FACTURA` WHERE `ID_pre_factura`='" . $id_pre_factura . "'";
    $conn->query($sql_pie_pre_factura);


}

function cobrado_factura($ID_factura)
{
    $conn = connect();
    $sql = "SELECT cobrado
    FROM FACTURA WHERE ID_FACTURA = '" . $ID_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['cobrado'];
    close($conn);
    return $valor;
}

function buscador_de_facturas($nif_cliente, $numero_factura, $fecha_desde, $fecha_hasta)
{
    $conn = connect();
    $desde = false;
    $hasta = false;
    $contador = 0;
    $fecha = 0;
    $x_campos_bbdd = array("campos");
    $y_valor_campos = array("valores");


    if ($nif_cliente != "") {
        $contador++;
        array_push($x_campos_bbdd, "NIF_cliente");
        array_push($y_valor_campos, $nif_cliente);
    }
    if ($numero_factura != "") {
        array_push($x_campos_bbdd, "ID_factura");
        array_push($y_valor_campos, $numero_factura);
        $contador++;
    }
    if ($fecha_desde != "") {
        $desde = true;
        $fecha++;
    }
    if ($fecha_hasta != "") {
        $hasta = true;
        $fecha++;
    }

    if ($contador == 0) {
        $sql = "SELECT * FROM CABECERA_FACTURA";
    } else {
        $sql = "SELECT * FROM CABECERA_FACTURA WHERE ";
        for ($i = 1; $i <= $contador; $i++) {
            if ($i >= 2) {
                $sql = $sql . " AND $x_campos_bbdd[$i]=\"$y_valor_campos[$i]\" ";
            } else {
                $sql = $sql . " $x_campos_bbdd[$i]=\"$y_valor_campos[$i]\" ";
            }

        }

    }

    //añadimos los campos de fecha
    if ($fecha == !0) {

        if ($contador == 0) {//no hay nada
            $sql = "SELECT * FROM CABECERA_FACTURA WHERE ";

            if ($desde == true && $hasta == true) {
                $sql = $sql . "fecha_factura BETWEEN '$fecha_desde' and '$fecha_hasta'";
            } else if ($desde == true && $hasta == false) {
                $sql = $sql . "fecha_factura BETWEEN '$fecha_desde' and CURRENT_DATE";
            } else if ($desde == false && $hasta == true) {
                $sql = $sql . "fecha_factura BETWEEN '*' and '$fecha_hasta'";

            }

        } else {//ya hay un campo hay que poner AND
            if ($desde == true && $hasta == true) {
                $sql = $sql . " AND fecha_factura BETWEEN '$fecha_desde' and '$fecha_hasta'";
            } else if ($desde == true && $hasta == false) {
                $sql = $sql . " AND fecha_factura BETWEEN '$fecha_desde' and CURRENT_DATE";
            } else if ($desde == false && $hasta == true) {
                $sql = $sql . " AND fecha_factura BETWEEN '*' and '$fecha_hasta'";

            }
        }
    }

    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_datos_ctw()
{
    $conn = connect();
    $sql = "SELECT *
    FROM DATOS_CTW";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}


function get_cabecera_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM CABECERA_FACTURA WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_cabecera_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT *
    FROM CABECERA_PRESUPUESTO WHERE ID_presupuesto = '" . $id_presupuesto . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}
function get_pie_presupuesto($id_presupuesto)
{
    $conn = connect();
    $sql = "SELECT *
    FROM PIE_PRESUPUESTO WHERE ID_presupuesto = '" . $id_presupuesto . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}


function get_pie_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM PIE_FACTURA WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_nombre_empresa($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT nombre_completo
    FROM CLIENTE
    WHERE NIF_EMPRESA ='" . $nif_empresa . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nombre_completo = $row['nombre_completo'];
    close($conn);
    return $nombre_completo;
}

function get_nif_intra($nif_empresa)
{
    $conn = connect();
    $sql = "SELECT nif_intra
    FROM CLIENTE
    WHERE NIF_EMPRESA ='" . $nif_empresa . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $nif_intra = $row['nif_intra'];
    close($conn);
    return $nif_intra;
}

function get_fecha_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT fecha_factura
    FROM CABECERA_FACTURA
    WHERE ID_factura ='" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $fecha_factura = $row['fecha_factura'];
    close($conn);
    return $fecha_factura;
}
function get_comentario_factura($id_factura)
{
    $conn = connect();
    $sql = "SELECT comentario
    FROM FACTURA
    WHERE ID_FACTURA ='" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['comentario'];
    close($conn);
    return $valor;
}

function get_productos_presupuesto($id_presupuestos)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_PRESUPUESTO WHERE ID_presupuesto = '" . $id_presupuestos . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_articulos_facturados($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_ARTICULO WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_servicios_facturados($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_SERVICIO WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_minutajes_facturados($id_factura)
{
    $conn = connect();
    $sql = "SELECT *
    FROM TRONCO_FACTURA_MINUTAJE WHERE ID_factura = '" . $id_factura . "'";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}

function get_nombre_articulo_facturado($id_artuculo_facturado)
{
    $conn = connect();
    $sql = "SELECT nombre
    FROM ARTICULO_FACTURADO
    WHERE ID_ARTICULO_FACTURADO ='" . $id_artuculo_facturado . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['nombre'];
    close($conn);
    return $valor;
}

function get_nombre_servicio_facturado($id_servicio_facturado)
{
    $conn = connect();
    $sql = "SELECT nombre
    FROM SERVICIO_FACTURADO
    WHERE ID_SERVICIO_FACTURADO ='" . $id_servicio_facturado . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['nombre'];
    close($conn);
    return $valor;
}

function get_descripcion_articulo_facturado($id_artuculo_facturado)
{
    $conn = connect();
    $sql = "SELECT descripcion
    FROM ARTICULO_FACTURADO
    WHERE ID_ARTICULO_FACTURADO ='" . $id_artuculo_facturado . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['descripcion'];
    close($conn);
    return $valor;
}

function get_descripcion_servicio_facturado($id_servicio_facturado)
{
    $conn = connect();
    $sql = "SELECT descripcion
    FROM SERVICIO_FACTURADO
    WHERE ID_SERVICIO_FACTURADO ='" . $id_servicio_facturado . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['descripcion'];
    close($conn);
    return $valor;
}

function get_sn_articulo_facturado($id_artuculo_facturado)
{
    $conn = connect();
    $sql = "SELECT numero_de_serie
    FROM ARTICULO_FACTURADO
    WHERE ID_ARTICULO_FACTURADO ='" . $id_artuculo_facturado . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['numero_de_serie'];
    close($conn);
    return $valor;
}

function get_nif_empresa($id_factura)
{
    $conn = connect();
    $sql = "SELECT NIF_cliente
    FROM CABECERA_FACTURA
    WHERE ID_factura ='" . $id_factura . "'";
    $data = $conn->query($sql);
    $row = $data->fetch_assoc();
    $valor = $row['NIF_cliente'];
    close($conn);
    return $valor;
}

function select_all_articulo_facturado_id($id_articulo_facturado)
{
    $conn = connect();
    $sql = "SELECT * 
    FROM ARTICULO_FACTURADO
    WHERE ID_ARTICULO_FACTURADO=".$id_articulo_facturado;
    $data = $conn->query($sql);
    close($conn);
    return $data;
}
function get_all_cabecera_factura()
{
    $conn = connect();
    $sql = "SELECT * 
    FROM CABECERA_FACTURA";
    $data = $conn->query($sql);
    close($conn);
    return $data;
}


//////////////////////////////////////////////////////////////////