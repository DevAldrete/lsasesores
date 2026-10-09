<?php
declare(strict_types=1);

/**
 * Configuración de la aplicación.
 *
 * Las credenciales se leen de variables de entorno, de modo que el mismo
 * código funciona tanto en Docker (docker-compose) como en XAMPP.
 *
 * Si existe un archivo .env en la raíz del proyecto (copia de .env.example),
 * sus valores se cargan y se usan como variables de entorno.
 */

// Carga simple de .env, sin dependencias externas.
$envFile = dirname(__DIR__) . '/.env';
if (is_readable($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        if ($key !== '' && getenv($key) === false) {
            putenv("$key=$value");
        }
    }
}

/**
 * Devuelve una variable de entorno con un valor por defecto.
 */
function env(string $key, string $default = ''): string
{
    $value = getenv($key);

    return ($value === false || $value === '') ? $default : $value;
}

return [
    'db' => [
        // Valores por defecto compatibles con XAMPP (localhost / root / sin password).
        'host'    => env('DB_HOST', 'localhost'),
        'port'    => env('DB_PORT', '3306'),
        'name'    => env('DB_NAME', 'lsasesores'),
        'user'    => env('DB_USER', 'root'),
        'pass'    => env('DB_PASS', ''),
        'charset' => 'utf8mb4',
    ],
];
