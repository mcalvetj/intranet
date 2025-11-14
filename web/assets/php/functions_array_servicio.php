<?php
//PASAR SEDES EN ARRAY JAVASCRIPT
$cliente = select_all_cliente();

if ($cliente->num_rows > 0) {
    // output data of each row
    while ($row = $cliente->fetch_assoc()) {
        ?>
        <script>

            var cliente_<?php echo "" . $row['NIF_EMPRESA'];?> = new Array
            var cliente_servicio_<?php echo "" . $row['NIF_EMPRESA'];?> = new Array

        </script>

        <?php

        //cambiar sede
        $sede = select_sede_cliente($row['NIF_EMPRESA']);

        if ($sede->num_rows > 0) {
            // output data of each row
            while ($row2 = $sede->fetch_assoc()) {
                ?>
                <script>

                    cliente_<?php echo"".$row['NIF_EMPRESA']; ?>.push(<?php echo "\"".$row2['nombre']."//".$row2['ubicacion']."\""; ?>);
                </script>

                <?php

            }
        }

        //cambiar servicio
        $servicio = select_servicio_cliente($row['NIF_EMPRESA']);

        if ($servicio->num_rows > 0) {
            // output data of each row
            while ($row2 = $servicio->fetch_assoc()) {
                ?>
                <script>

                    cliente_servicio_<?php echo"".$row['NIF_EMPRESA']; ?>.push(<?php echo "\"" . $row2['nombre'] . "\""; ?>);
                </script>

                <?php

            }
        }
    }


}
?>