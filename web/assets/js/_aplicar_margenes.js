$(document).ready(function () {


    var iva = $('.select_iva').val();
    var precio_sin_iva = $('.precio_sin_iva').val();
    var iva_aplicado = ((parseFloat(iva)* parseFloat(precio_sin_iva))/100);
    var precio_con_iva= parseFloat(precio_sin_iva)+ parseFloat(iva_aplicado);
    $('.precio_con_iva_value').val(precio_con_iva);




    $('.select_iva').on('change', function () {
        var iva = ( this.value );
        var precio_sin_iva = $('.precio_sin_iva').val();
        precio_sin_iva = precio_sin_iva;
        var iva_aplicado = ((iva / 100) * precio_sin_iva);
        iva_aplicado = iva_aplicado.toFixed(1);

        var float_iva_aplicado = (parseFloat(iva_aplicado));
        var float_pecio_sin_iva = (parseFloat(precio_sin_iva));
        var precio_con_iva = float_iva_aplicado + float_pecio_sin_iva;
        var precio_con_iva=precio_con_iva.toFixed(2);
        $('.precio_con_iva_value').val(precio_con_iva);
    })
    $('.minutaje_select_margen').on('change', function () {
        var margen = ( this.value );
        var relacion = $(this).closest('tr').attr('id');
        var id_tronco_pre_factura_minutaje = $(this).closest('tr').attr('content');
        var classe_precio = "minutaje_precio_val_" + relacion;
        var classe_horas = "minutaje_horas_val_" + relacion;        
        var classe_precio_total = "minutaje_precio_total_" + relacion;
        var val_precio = $('.' + classe_precio).attr('name');
        var val_horas = $('.' + classe_horas).attr('name');
        var val_precio_anterior = $('.' + classe_precio_total).attr('name');

        //array horas
        var array_horas = new Array();
        var array_horas = val_horas.split(":");
        var horas= array_horas[0];
        var horas= horas*60;
        var minutos = array_horas[1];
        var precio_sin_margen=(((parseFloat(minutos)+parseFloat(horas))*val_precio)/60);
        var precio_con_margen = margen * precio_sin_margen;
        var precio_con_margen = precio_con_margen.toFixed(2);
        $('.' + classe_precio_total).attr('name', precio_con_margen);
        $('.' + classe_precio_total).text(precio_con_margen);
        var diferencia_de_precio = precio_con_margen - val_precio_anterior;
        var precio_sin_iva = $('.precio_sin_iva').val();
        var precio_total_pre_factura_sin_iva = (parseFloat(precio_sin_iva) + (parseFloat(diferencia_de_precio)));
        var precio_total_pre_factura_sin_iva = precio_total_pre_factura_sin_iva.toFixed(2);
        $('.precio_sin_iva').val(precio_total_pre_factura_sin_iva);
        /*ACTUALIZAMOS EL PRECIO CON IVA*/
        var iva = $(".select_iva option:selected").val();
        iva = parseFloat(iva) / 100;
        var precio_total_pre_factura_con_iva = (parseFloat(precio_total_pre_factura_sin_iva) + (parseFloat(precio_total_pre_factura_sin_iva) * iva));
        var precio_total_pre_factura_con_iva=precio_total_pre_factura_con_iva.toFixed(2);
        $('.precio_con_iva_value').val(precio_total_pre_factura_con_iva);


        $.ajax({
            type: 'post',
            url: '../assets/php/update_table/aplicar_margen.php',
            data: {
                id_tronco_pre_factura: id_tronco_pre_factura_minutaje,
                precio_con_margen: precio_con_margen,
                margen: margen,
                para: "minutaje",
            }
        });

    })

    $('.articulo_select_margen').on('change', function () {
        var margen = ( this.value );
        var relacion = $(this).closest('tr').attr('id');
        var id_tronco_pre_factura_articulo = $(this).closest('tr').attr('content');
        var classe_precio = "articulo_precio_val_" + relacion;
        var classe_cantidad = "articulo_cantidad_val_" + relacion;
        var classe_precio_total = "articulo_precio_total_" + relacion;
        var val_precio = $('.' + classe_precio).attr('name');
        var val_cantidad = $('.' + classe_cantidad).attr('name');
        var val_precio_anterior = $('.' + classe_precio_total).attr('name');
        var precio_con_margen = margen * (val_precio * val_cantidad);
        var precio_con_margen = precio_con_margen.toFixed(2);
        var precio_unidad_con_margen = margen * val_precio;
        var precio_unidad_con_margen = precio_unidad_con_margen.toFixed(2);
        $('.' + classe_precio).text(precio_unidad_con_margen);
        $('.' + classe_precio_total).attr('name', precio_con_margen);
        $('.' + classe_precio_total).text(precio_con_margen);
        var diferencia_de_precio = precio_con_margen - val_precio_anterior;
        var precio_sin_iva = $('.precio_sin_iva').val();
        var precio_total_pre_factura_sin_iva = (parseFloat(precio_sin_iva) + (parseFloat(diferencia_de_precio)));
        var precio_total_pre_factura_sin_iva = precio_total_pre_factura_sin_iva.toFixed(2);
        $('.precio_sin_iva').val(precio_total_pre_factura_sin_iva);
        /*ACTUALIZAMOS EL PRECIO CON IVA*/
        var iva = $(".select_iva option:selected").val();
        iva = parseFloat(iva) / 100;
        var precio_total_pre_factura_con_iva = (parseFloat(precio_total_pre_factura_sin_iva) + (parseFloat(precio_total_pre_factura_sin_iva) * iva));
        var precio_total_pre_factura_con_iva=precio_total_pre_factura_con_iva.toFixed(2);
        $('.precio_con_iva_value').val(precio_total_pre_factura_con_iva);


        $.ajax({
            type: 'post',
            url: '../assets/php/update_table/aplicar_margen.php',
            data: {
                id_tronco_pre_factura: id_tronco_pre_factura_articulo,
                precio_con_margen: precio_con_margen,
                precio_unidad_con_margen:precio_unidad_con_margen,
                margen: margen,

                para: "articulo",
            }
        });
    })


    $('.servicio_select_margen').on('change', function () {
        var margen = ( this.value );
        var relacion = $(this).closest('tr').attr('id');
        var id_tronco_pre_factura_servicio = $(this).closest('tr').attr('content');
        var classe_precio = "servicio_precio_val_" + relacion;
        var classe_cantidad = "servicio_cantidad_val_" + relacion;
        var classe_precio_total = "servicio_precio_total_" + relacion;
        var val_precio = $('.' + classe_precio).attr('name');
        var val_cantidad = $('.' + classe_cantidad).attr('name');
        var val_precio_anterior = $('.' + classe_precio_total).attr('name');
        var precio_con_margen = margen * (val_precio * val_cantidad);
        var precio_con_margen = precio_con_margen.toFixed(2);
        var precio_unidad_con_margen = margen * val_precio;
        var precio_unidad_con_margen = precio_unidad_con_margen.toFixed(2);
        $('.' + classe_precio).text(precio_unidad_con_margen);
        $('.' + classe_precio_total).attr('name', precio_con_margen);
        $('.' + classe_precio_total).text(precio_con_margen);
        var diferencia_de_precio = precio_con_margen - val_precio_anterior;
        var precio_sin_iva = $('.precio_sin_iva').val();
        var precio_total_pre_factura_sin_iva = (parseFloat(precio_sin_iva) + (parseFloat(diferencia_de_precio)));
        var precio_total_pre_factura_sin_iva = precio_total_pre_factura_sin_iva.toFixed(2);
        $('.precio_sin_iva').val(precio_total_pre_factura_sin_iva);
        /*ACTUALIZAMOS EL PRECIO CON IVA*/
        var iva = $(".select_iva option:selected").val();
        iva = parseFloat(iva) / 100;
        var precio_total_pre_factura_con_iva = (parseFloat(precio_total_pre_factura_sin_iva) + (parseFloat(precio_total_pre_factura_sin_iva) * iva));
        var precio_total_pre_factura_con_iva = precio_total_pre_factura_con_iva.toFixed(2);
            $('.precio_con_iva_value').val(precio_total_pre_factura_con_iva);



        $.ajax({
            type: 'post',
            url: '../assets/php/update_table/aplicar_margen.php',
            data: {
                id_tronco_pre_factura: id_tronco_pre_factura_servicio,
                precio_con_margen: precio_con_margen,
                precio_unidad_con_margen:precio_unidad_con_margen,
                margen: margen,
                para: "servicio",
            }
        });
    })
});