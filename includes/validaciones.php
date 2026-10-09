<?php
declare(strict_types=1);

/**
 * Reglas de validación y sanitización de leads del lado del servidor.
 *
 * El formulario (JS) aplica las mismas reglas en el cliente; aquí se
 * revalidan porque la validación del cliente nunca es confiable.
 */

const SERVICIOS_PERMITIDOS = [
    'contabilidad' => 'Contabilidad general',
    'impuestos'    => 'Declaraciones de impuestos',
    'asesoria'     => 'Asesoría financiera',
];

/**
 * Valida y normaliza los datos de un lead.
 *
 * @param array<string, mixed> $input Datos crudos recibidos del formulario.
 * @return array{valido: bool, datos: array<string, ?string>, errores: array<string, string>}
 */
function validarLead(array $input): array
{
    $errores = [];

    $nombre   = trim((string) ($input['nombre'] ?? ''));
    $email    = trim((string) ($input['email'] ?? ''));
    $telefono = trim((string) ($input['telefono'] ?? ''));
    $servicio = trim((string) ($input['servicio'] ?? ''));
    $mensaje  = trim((string) ($input['mensaje'] ?? ''));

    // Nombre: obligatorio, 3 a 120 caracteres, solo letras y separadores.
    if ($nombre === '') {
        $errores['nombre'] = 'El nombre es obligatorio.';
    } elseif (mb_strlen($nombre) < 3 || mb_strlen($nombre) > 120) {
        $errores['nombre'] = 'El nombre debe tener entre 3 y 120 caracteres.';
    } elseif (!preg_match('/^[\p{L}\s.\'-]+$/u', $nombre)) {
        $errores['nombre'] = 'El nombre contiene caracteres no válidos.';
    }

    // Email: obligatorio y con formato válido.
    if ($email === '') {
        $errores['email'] = 'El correo electrónico es obligatorio.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $errores['email'] = 'Ingresa un correo electrónico válido.';
    }

    // Teléfono: obligatorio, permite + - espacios y paréntesis, 7 a 15 dígitos.
    $soloDigitos = preg_replace('/\D+/', '', $telefono) ?? '';
    if ($telefono === '') {
        $errores['telefono'] = 'El teléfono es obligatorio.';
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $telefono)
        || strlen($soloDigitos) < 7
        || strlen($soloDigitos) > 15) {
        $errores['telefono'] = 'Ingresa un teléfono válido (entre 7 y 15 dígitos).';
    }

    // Servicio: obligatorio y dentro de la lista permitida.
    if ($servicio === '') {
        $errores['servicio'] = 'Selecciona un servicio.';
    } elseif (!array_key_exists($servicio, SERVICIOS_PERMITIDOS)) {
        $errores['servicio'] = 'El servicio seleccionado no es válido.';
    }

    // Mensaje: opcional, máximo 1000 caracteres.
    if ($mensaje !== '' && mb_strlen($mensaje) > 1000) {
        $errores['mensaje'] = 'El mensaje no puede superar los 1000 caracteres.';
    }

    $datos = [
        'nombre'   => $nombre,
        'email'    => $email,
        'telefono' => $telefono,
        'servicio' => $servicio,
        'mensaje'  => $mensaje !== '' ? $mensaje : null,
    ];

    return [
        'valido'  => $errores === [],
        'datos'   => $datos,
        'errores' => $errores,
    ];
}
