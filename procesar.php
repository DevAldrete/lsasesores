<?php
declare(strict_types=1);

/**
 * Endpoint del formulario de contacto.
 *
 * Recibe los datos (FormData o JSON), los revalida en el servidor, guarda el
 * lead en la base de datos con una sentencia preparada y responde en JSON.
 */

require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/validaciones.php';

header('Content-Type: application/json; charset=utf-8');

/**
 * Envía una respuesta JSON y termina la ejecución.
 *
 * @param array<string, mixed> $payload
 */
function responder(int $codigo, array $payload): void
{
    http_response_code($codigo);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    responder(405, [
        'ok'      => false,
        'mensaje' => 'Método no permitido.',
    ]);
}

// Acepta tanto FormData ($_POST) como un cuerpo JSON.
$input = $_POST;
if ($input === []) {
    $cuerpo = file_get_contents('php://input');
    $decodificado = json_decode($cuerpo !== false ? $cuerpo : '', true);
    if (is_array($decodificado)) {
        $input = $decodificado;
    }
}

$resultado = validarLead($input);

if (! $resultado['valido']) {
    responder(422, [
        'ok'      => false,
        'mensaje' => 'Revisa los campos marcados e inténtalo de nuevo.',
        'errores' => $resultado['errores'],
    ]);
}

$datos = $resultado['datos'];
$ip = $_SERVER['REMOTE_ADDR'] ?? null;

try {
    $sql = 'INSERT INTO leads (nombre, email, telefono, servicio, mensaje, ip)
            VALUES (:nombre, :email, :telefono, :servicio, :mensaje, :ip)';

    $sentencia = db()->prepare($sql);
    $sentencia->execute([
        ':nombre'   => $datos['nombre'],
        ':email'    => $datos['email'],
        ':telefono' => $datos['telefono'],
        ':servicio' => $datos['servicio'],
        ':mensaje'  => $datos['mensaje'],
        ':ip'       => $ip,
    ]);
} catch (Throwable $e) {
    error_log('Error al guardar el lead: ' . $e->getMessage());

    responder(500, [
        'ok'      => false,
        'mensaje' => 'Ocurrió un error al enviar tu solicitud. Inténtalo más tarde.',
    ]);
}

responder(201, [
    'ok'      => true,
    'mensaje' => '¡Gracias por contactarnos! Hemos recibido tu solicitud y un asesor de LS ASESORES te contactará muy pronto.',
]);
