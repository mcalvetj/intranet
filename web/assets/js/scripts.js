jQuery.fn.generaNuevosCampos = function(etiqueta, nombreCampo, indice){
    $(this).each(function(){
        elem = $(this);
        elem.data("etiqueta",etiqueta);
        elem.data("numero_de_serie",nombreCampo);
        elem.data("indice",indice);

        elem.click(function(e){
            e.preventDefault();
            elem = $(this);
            etiqueta = elem.data("etiqueta");
            nombreCampo = elem.data("numero_de_serie");
            indice = elem.data("indice");
            texto_insertar = '<p>' + etiqueta + ' ' + indice + ':<br><input type="text" name="' + nombreCampo + indice + '" /></p>';
            indice ++;
            elem.data("indice",indice);
            nuevo_campo = $(texto_insertar);
            elem.before(nuevo_campo);
            $("#totalNumSeries").val(indice-1);
            document.getElementById("cantidad").value=1;
            $("#fieldsetCantidad").hide();
        });
    });

    return this;
}

jQuery.fn.generaNuevosCampos2 = function(etiqueta, nombreCampo, indice){
    $(this).each(function(){
        elem = $(this);
        elem.data("etiqueta",etiqueta);
        elem.data("correo",nombreCampo);
        elem.data("indice",indice);

        
        elem.click(function(e){
            e.preventDefault();
            elem = $(this);
            etiqueta = elem.data("etiqueta");
            nombreCampo = elem.data("correo");
            indice = elem.data("indice");
            
            if(indice<11){
                texto_insertar = '<p>' + etiqueta + ' ' + indice + ':<br><input type="text" name="' + nombreCampo + indice + '" /></p>';
                indice ++;
                elem.data("indice",indice);
                nuevo_campo = $(texto_insertar);
                elem.before(nuevo_campo);
                $("#totalCorreos").val(indice-1);
            }else{
                alert("maximo envio a 10 correos");
            }

        });
        
    });

    return this;
}

$(document).ready(function(){
    $("#mascampos").generaNuevosCampos("Número de serie", "numero_de_serie", 1);
});

$(document).ready(function(){
    $("#mascampos2").generaNuevosCampos2("Correo", "correo", 1);
});