<?php


//PASAR PRE_FACTURA EN ARRAY JAVASCRIPT
$cliente = select_all_cliente();

if ($cliente->num_rows > 0) {
// output data of each row
    while ($row = $cliente->fetch_assoc()) {
        ?>
        <script>

            var cliente_<?php echo "" . $row['NIF_EMPRESA'];?> = new Array

        </script>

        <?php
        $pre_factura = select_pre_factura_cliente($row['NIF_EMPRESA']);

        if ($pre_factura->num_rows > 0) {
            // output data of each row
            while ($row2 = $pre_factura->fetch_assoc()) {
                ?>
                <script>

                    cliente_<?php echo"".$row['NIF_EMPRESA']; ?>.push(<?php echo "\"" . $row2['ID_PRE_FACTURA'] ." - ".$row2['nombre']. "\""; ?>);
                </script>

                <?php

            }
        }
    }


}
?>