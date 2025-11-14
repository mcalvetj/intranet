<?php

declare(strict_types=1);

const DB_SERVER = 'localhost';
const DB_NAME   = 'QTC152';
const DB_USER   = 'mcalvetj';
const DB_PASS   = 'Unisys00!';

/**
 * Returns a shared mysqli connection instance.
 */
function get_db_connection(): \mysqli
{
    static $connection = null;

    if ($connection instanceof \mysqli) {
        return $connection;
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $connection = new \mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $connection->set_charset('utf8mb4');
    } catch (\mysqli_sql_exception $exception) {
        throw new \RuntimeException('No se pudo establecer la conexión con la base de datos.', 0, $exception);
    }

    return $connection;
}
