<?php
declare(strict_types=1);

$titulo = $titulo ?? 'LS ASESORES | Asesoría Contable y Fiscal';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LS ASESORES: contabilidad general, declaraciones de impuestos y asesoría financiera. Solicita tu asesoría personalizada.">
    <title><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <a class="salto-contenido" href="#contacto">Ir al formulario de contacto</a>

    <header class="header" id="inicio">
        <div class="contenedor header__inner">
            <a class="marca" href="#inicio" aria-label="LS ASESORES, ir al inicio">
                <img class="marca__logo" src="assets/img/logo.svg" alt="Logo de LS ASESORES" width="46" height="46">
                <span class="marca__texto">LS <strong>ASESORES</strong></span>
            </a>

            <button class="nav__toggle" type="button" aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="menu-principal">
                <span></span><span></span><span></span>
            </button>

            <nav class="nav" id="menu-principal" aria-label="Navegación principal">
                <ul class="nav__lista">
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#beneficios">Beneficios</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
                <a class="boton boton--primario nav__cta" href="#contacto">Solicitar asesoría</a>
            </nav>
        </div>
    </header>

    <main>
