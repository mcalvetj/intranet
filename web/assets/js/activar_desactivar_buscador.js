/*******************************
 * ACTIVAR/DESACTIVAR CHECKBOX BUSACDOR
 *******************************/

function onchange_cliente($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'cliente',
                accion: 'activar'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'cliente',
                accion: 'desactivar'
            }
        });
    }
}

function onchange_mayorista($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'mayorista',
                accion: 'activar'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'mayorista',
                accion: 'desactivar'
            }
        });
    }
}

function onchange_sede($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'sede',
                accion: 'activar'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'sede',
                accion: 'desactivar'
            }
        });
    }
}

function onchange_contacto($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'contacto',
                accion: 'activar'
            }
        });
    } else {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'contacto',
                accion: 'desactivar'
            }
        });
    }
}

function onchange_factura($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'factura',
                accion: 'activar'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'factura',
                accion: 'desactivar'
            }
        });
    }
}

function onchange_usuario($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'usuario',
                accion: 'activar'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'usuario',
                accion: 'desactivar'
            }
        });
    }
}
function onchange_servicio($pk, $activo) {
    if ($activo == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'servicio',
                accion: 'activar'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'servicio',
                accion: 'desactivar'
            }
        });
    }
}
function onchange_minutaje_facturado($pk, $facturado) {
    if ($facturado == 0) {

        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'minutaje',
                accion: 'facturado'
            }
        });
    } else {
        $.ajax({
            type: 'post',
            url: '../assets/php/activar_desactivar_buscador.php',
            data: {
                pk: $pk,
                para: 'minutaje',
                accion: 'por_facturar'
            }
        });
    }
}


