
    function cambia_sede() {
        //tomo el valor del select del cliente elegido
        var cliente
        cliente = document.f_cliente_sede.select_box_nif_empresa[document.f_cliente_sede.select_box_nif_empresa.selectedIndex].value
        //miro a ver si el cliente está definido
        if (cliente != "") {
            //si estaba definido, entonces coloco las opciones de la provincia correspondiente.
            //selecciono el array de sedes adecuado
            sedes = eval("cliente_" + cliente)
            //calculo el numero de sedes
            num_sedes = sedes.length
            //marco el número de sedes en el select
            document.f_cliente_sede.select_box_sede_cliente.length = num_sedes
            //para cada sede del array, la introduzco en el select
            for (i = 0; i < num_sedes; i++) {
                document.f_cliente_sede.select_box_sede_cliente.options[i].value = sedes[i]
                document.f_cliente_sede.select_box_sede_cliente.options[i].text = sedes[i]
            }
        } else {
            //si no había sede seleccionada, elimino las provincias del select
            document.f_cliente_sede.select_box_sede_cliente.length = 1
            //coloco un guión en la única opción que he dejado
            document.f_cliente_sede.select_box_sede_cliente.options[0].value = "-"
            document.f_cliente_sede.select_box_sede_cliente.options[0].text = "-"
        }
        //marco como seleccionada la opción primera de sede
        document.f_cliente_sede.select_box_sede_cliente.options[0].selected = true
    }
     function cambia_sede_servicio() {
        //tomo el valor del select del cliente elegido
        var cliente
        cliente = document.f_cliente_sede_servicio.select_box_nif_empresa[document.f_cliente_sede_servicio.select_box_nif_empresa.selectedIndex].value
        //miro a ver si el cliente está definido
        if (cliente != "") {
            //si estaba definido, entonces coloco las opciones de la provincia correspondiente.
            //selecciono el array de sedes adecuado
            sedes = eval("cliente_" + cliente)
            servicio = eval("cliente_servicio_" + cliente)
            //calculo el numero de sedes
            num_sedes = sedes.length
            num_servicio = servicio.length
            //marco el número de sedes en el select
            document.f_cliente_sede_servicio.select_box_sede_cliente.length = num_sedes
            document.f_cliente_sede_servicio.select_box_servicio.length = num_servicio
            //para cada sede del array, la introduzco en el select
            for (i = 0; i < num_sedes; i++) {
                document.f_cliente_sede_servicio.select_box_sede_cliente.options[i].value = sedes[i]
                document.f_cliente_sede_servicio.select_box_sede_cliente.options[i].text = sedes[i]
            }
            for (j = 0; j < num_servicio; j++) {
                document.f_cliente_sede_servicio.select_box_servicio.options[j].value = servicio[j]
                document.f_cliente_sede_servicio.select_box_servicio.options[j].text = servicio[j]
            }
        } else {
            //si no había sede seleccionada, elimino las provincias del select
            document.f_cliente_sede.select_box_sede_cliente.length = 1
            //coloco un guión en la única opción que he dejado
            document.f_cliente_sede.select_box_sede_cliente.options[0].value = "-"
            document.f_cliente_sede.select_box_sede_cliente.options[0].text = "-"

            //si no había sede seleccionada, elimino las provincias del select
            document.f_cliente_sede.select_box_servicio.length = 1
            //coloco un guión en la única opción que he dejado
            document.f_cliente_sede.select_box_servicio.options[0].value = "-"
            document.f_cliente_sede.select_box_servicio.options[0].text = "-"

        }
        //marco como seleccionada la opción primera de sede
        document.f_cliente_sede_servicio.select_box_sede_cliente.options[0].selected = true
        document.f_cliente_sede_servicio.select_box_servicio.options[0].selected = true


    }
    function cambia_pre_factura() {
        //tomo el valor del select del cliente elegido
        var cliente
        cliente = document.f_cliente_pre_factura.select_box_nif_empresa[document.f_cliente_pre_factura.select_box_nif_empresa.selectedIndex].value
        //miro a ver si el cliente está definido
        if (cliente != "") {
            //si estaba definido, entonces coloco las opciones de la provincia correspondiente.
            //selecciono el array de sedes adecuado
            pre_factura = eval("cliente_" + cliente)
            //calculo el numero de sedes
            num_pre_factura = pre_factura.length
            //marco el número de sedes en el select
            document.f_cliente_pre_factura.select_box_pre_factura_cliente.length = num_pre_factura
            //para cada sede del array, la introduzco en el select
            for (i = 0; i < num_pre_factura; i++) {
                document.f_cliente_pre_factura.select_box_pre_factura_cliente.options[i].value = pre_factura[i]
                document.f_cliente_pre_factura.select_box_pre_factura_cliente.options[i].text = pre_factura[i]
            }
        } else {
            //si no había sede seleccionada, elimino las provincias del select
            document.f_cliente_pre_factura.select_box_pre_factura_cliente.length = 1
            //coloco un guión en la única opción que he dejado
            document.f_cliente_pre_factura.select_box_pre_factura_cliente.options[0].value = "-"
            document.f_cliente_pre_factura.select_box_pre_factura_cliente.options[0].text = "-"
        }
        //marco como seleccionada la opción primera de sede
        document.f_cliente_pre_factura.select_box_pre_factura_cliente.options[0].selected = true
    }

    function cambia_presupuesto() {
        //tomo el valor del select del cliente elegido
        var cliente
        cliente = document.f_cliente_presupuesto.select_box_nif_empresa[document.f_cliente_presupuesto.select_box_nif_empresa.selectedIndex].value
        //miro a ver si el cliente está definido
        if (cliente != "") {
            //si estaba definido, entonces coloco las opciones de la provincia correspondiente.
            //selecciono el array de sedes adecuado
            presupuesto = eval("cliente_" + cliente)
            //calculo el numero de sedes
            num_presupeusto = presupuesto.length
            //marco el número de sedes en el select
            document.f_cliente_presupuesto.select_box_presupuesto_cliente.length = num_presupeusto
            //para cada sede del array, la introduzco en el select
            for (i = 0; i < num_presupeusto; i++) {
                document.f_cliente_presupuesto.select_box_presupuesto_cliente.options[i].value = presupuesto[i]
                document.f_cliente_presupuesto.select_box_presupuesto_cliente.options[i].text = presupuesto[i]
            }
        } else {
            //si no había sede seleccionada, elimino las provincias del select
            document.f_cliente_presupuesto.select_box_presupuesto_cliente.length = 1
            //coloco un guión en la única opción que he dejado
            document.f_cliente_presupuesto.select_box_presupuesto_cliente.options[0].value = "-"
            document.f_cliente_presupuesto.select_box_presupuesto_cliente.options[0].text = "-"
        }
        //marco como seleccionada la opción primera de sede
        document.f_cliente_presupuesto.select_box_presupuesto_cliente.options[0].selected = true
    }

    function borrar_minutaje(pk) {
        if (pk != "0") {
            swal({
                    title: "Deseas eliminar este minutaje?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarlo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_minutaje.php?id=" + pk;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "buscador_minutaje.php?error=serAdmin";
        }
    }

    function borrar_articulo(pk) {
        if (pk != "0") {
            swal({
                    title: "Deseas eliminar este articulo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarlo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_articulo.php?id=" + pk;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "buscador_articulos.php?error=serAdmin";
        }
    }

    function quitar_articulo_pre_factura(id,pre_factura) {
        if (id != "0") {
            swal({
                    title: "Deseas eliminar este articulo de la prefactura?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarlo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_articulo_pre_factura.php?id=" + id + "&pre_factura=" + pre_factura;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "ver_pre_factura.php?error=serAdmin";
        }
    }
    function quitar_servicio_pre_factura(id,pre_factura) {
        if (id != "0") {
            swal({
                    title: "Deseas eliminar este servicio de la prefactura?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarlo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_servicio_pre_factura.php?id=" + id + "&pre_factura=" + pre_factura;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "ver_pre_factura.php?error=serAdmin";
        }
    }
    function quitar_producto_presupuesto(id, presupuesto) {
        if (id != "0") {
            swal({
                    title: "Deseas eliminar este producto del presupuesto?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarlo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_producto_presupuesto.php?id=" + id+"&presupuesto="+presupuesto;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "ver_pre_factura.php?error=serAdmin";
        }
    }

    function quitar_minutaje_pre_factura(id,pre_factura) {
        if (id != "0") {
            swal({
                    title: "Deseas eliminar este minutaje de la prefactura?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarlo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_minutaje_pre_factura.php?id=" + id + "&pre_factura=" + pre_factura;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "ver_pre_factura.php?error=serAdmin";
        }
    }

    function borrar_pre_factura(pre_factura) {
        if (pre_factura != "0") {
            swal({
                    title: "Deseas eliminar esta prefactura?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, eliminarla",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../assets/php/delete/delete_pre_factura.php?id_pre_factura=" + pre_factura;
                    } else {
                        swal("Cancelado", " ", "error");
                    }
                });

        } else {
            window.location.href = "ver_pre_factura.php?error=serAdmin";
        }
    }


    
    

    


