if ($.session.get("esperandoSalida") != 1) {
    $("#panelSalir").hide();
    $("#panelEntrar").show();
    $("#botonentrar").show();
} else {
    $("#panelEntrar").hide();
    $("#botonentrar").hide();
    $("#panelSalir").show();
}

$("#entrar").click(function () {

        $.session.set("cliente_minutaje", $("#cliente").val());
        $.session.set("sede_minutaje", $("#sede").val());
        $.session.set("servicio_minutaje", $("#servicio").val());
        $.session.set("fecha_minutaje", $("#fecha").val());
        $.session.set("hora_entrada_minutaje", $("#hora_entrada").val());
        $.session.set("esperandoSalida", 1);
        if ($.session.get("sede_minutaje") != '-') {
            $("#panelEntrar").hide();
            $("#panelSalir").show();
            $("#botonentrar").hide();
        }else{
            $("#panelEntrar").show();
            $("#panelSalir").hide();
            $("#botonentrar").show();
        }
});

$("#salir").click(function () {
    $("input:hidden[name=cliente_minutaje]").val($.session.get("cliente_minutaje"));
    $("input:hidden[name=sede_minutaje]").val($.session.get("sede_minutaje"));
    $("input:hidden[name=servicio_minutaje]").val($.session.get("servicio_minutaje"));
    $("input:hidden[name=fecha_minutaje]").val($.session.get("fecha_minutaje"));
    $("input:hidden[name=hora_entrada_minutaje]").val($.session.get("hora_entrada_minutaje"));
    $.session.set("esperandoSalida", 0);
    $.session.set("sede_minutaje", '');

});


function myFunction1() {
    var d = new Date(); // for now
    //obtener hora actual
    var horas = d.getHours(); // => 9
    var minutos = d.getMinutes(); // =>  30
    d.getSeconds(); // => 51
    //var tiempo = horas + ":" + minutos;
    var tiempo = d;
    //obtener fecha
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    var fecha = year + "-" + month + "-" + day;

    //passar hora de inicio
    document.getElementById("hora_entrada_print").innerHTML = tiempo;
    document.getElementById('hora_entrada').value = tiempo;

    //passar fecha
    document.getElementById("fecha_print").innerHTML = fecha;
    document.getElementById('fecha').value = fecha;

}

function myFunction2() {
    var d = new Date(); // for now
    var horas = d.getHours(); // => 9
    var minutos = d.getMinutes(); // =>  30
    d.getSeconds(); // => 51
    //var tiempo = horas + ":" + minutos;
    var tiempo = d;

    document.getElementById("hora_salida_print").innerHTML = tiempo;
    document.getElementById('hora_salida').value = tiempo;
}

function enviarFechaEntrada(){
    var fecha = new Date(); // for now
    
}
