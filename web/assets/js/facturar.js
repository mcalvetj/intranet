$(document).ready(function () {
    function pre_facturar_articulos($array_id) {
        $.ajax({
            type: 'post',
            url: '../../pre_factura/pre_factura_articulos.php',
            data: {
                pk: $array_id,
                producto: 'articulo',
            }
        });
    }
    

});