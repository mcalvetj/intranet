$(document).ready(function () {
    $('#buscador_articulo tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });

    $('#buscador_minutaje tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    $('#buscador_servicio tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    $('#buscador_facturas tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });

});