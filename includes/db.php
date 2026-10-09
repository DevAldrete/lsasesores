<?php
declare(strict_types=1);

/**
 * Conexión PDO única (singleton) a MySQL/MariaDB.
 *
 * El modo de errores por excepción y las sentencias preparadas nativas
 * protegen contra inyección SQL.
 */

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = require __DIR__ . '/config.php';
    $db = $config['db'];

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        $db['host'],
        $db['port'],
        $db['name'],
        $db['charset']
    );

    try {
        $pdo = new PDO($dsn, $db['user'], $db['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        // Los detalles técnicos van al log; al cliente solo un mensaje genérico.
        error_log('Error de conexión a la base de datos: ' . $e->getMessage());

        throw new RuntimeException('No se pudo conectar con la base de datos.');
    }

    return $pdo;
}
