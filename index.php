<?php
declare(strict_types=1);

require __DIR__ . '/includes/validaciones.php';

$titulo = 'LS ASESORES | Asesoría Contable y Fiscal';

require __DIR__ . '/includes/partials/header.php';
?>

        <section class="hero">
            <div class="contenedor hero__inner">
                <div class="hero__texto">
                    <p class="hero__etiqueta">Asesoría contable y fiscal de confianza</p>
                    <h1 class="hero__titulo">
                        Impulsa la salud financiera de tu negocio con
                        <span class="texto-azul">LS ASESORES</span>
                    </h1>
                    <p class="hero__subtitulo">
                        Contabilidad general, declaraciones de impuestos y asesoría
                        financiera para personas y empresas. Cumple tus obligaciones y
                        ahorra de forma segura, con acompañamiento experto.
                    </p>
                    <div class="hero__acciones">
                        <a class="boton boton--primario" href="#contacto">Solicitar asesoría</a>
                        <a class="boton boton--secundario" href="#servicios">Ver servicios</a>
                    </div>
                    <ul class="hero__indicadores">
                        <li><strong>+15 años</strong><span>de experiencia</span></li>
                        <li><strong>+500</strong><span>clientes atendidos</span></li>
                        <li><strong>100%</strong><span>confidencialidad</span></li>
                    </ul>
                </div>

                <div class="hero__media">
                    <img src="assets/img/hero.svg" alt="Ilustración de asesoría contable y fiscal" width="560" height="460">
                </div>
            </div>
        </section>

        <section class="seccion servicios" id="servicios">
            <div class="contenedor">
                <header class="seccion__cabecera">
                    <p class="seccion__etiqueta">Nuestros servicios</p>
                    <h2 class="seccion__titulo">Soluciones contables para cada necesidad</h2>
                    <p class="seccion__descripcion">
                        Cubrimos las áreas clave para que tu negocio cumpla en tiempo y
                        forma, sin sorpresas ante la autoridad fiscal.
                    </p>
                </header>

                <div class="tarjetas">
                    <article class="tarjeta">
                        <span class="tarjeta__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M5 3h11l3 3v15H5zm10 1.5V7h2.5zM7 9h8v1.6H7zm0 3.5h10v1.6H7zm0 3.5h10v1.6H7z"/></svg>
                        </span>
                        <h3 class="tarjeta__titulo">Contabilidad general</h3>
                        <p class="tarjeta__texto">
                            Registro ordenado de tus operaciones, estados financieros y
                            control de ingresos y egresos al día.
                        </p>
                    </article>

                    <article class="tarjeta">
                        <span class="tarjeta__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5zm-1 14-3.5-3.5 1.4-1.4L11 13.2l4.6-4.6L17 10z"/></svg>
                        </span>
                        <h3 class="tarjeta__titulo">Declaraciones de impuestos</h3>
                        <p class="tarjeta__texto">
                            Cálculo y presentación de tus declaraciones mensuales y anuales
                            dentro de los plazos legales.
                        </p>
                    </article>

                    <article class="tarjeta">
                        <span class="tarjeta__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M4 20V9l8-5 8 5v11h-6v-6h-4v6zm3-8h4V9.2H7zm6 0h4V9.2h-4z"/></svg>
                        </span>
                        <h3 class="tarjeta__titulo">Asesoría financiera</h3>
                        <p class="tarjeta__texto">
                            Estrategias de ahorro fiscal y planeación para tomar mejores
                            decisiones con tus recursos.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section class="seccion beneficios" id="beneficios">
            <div class="contenedor">
                <header class="seccion__cabecera">
                    <p class="seccion__etiqueta">¿Por qué elegirnos?</p>
                    <h2 class="seccion__titulo">Beneficios pensados para ti</h2>
                    <p class="seccion__descripcion">
                        Trabajamos de cerca con cada cliente para proteger su patrimonio
                        y su tranquilidad.
                    </p>
                </header>

                <div class="tarjetas">
                    <article class="tarjeta tarjeta--beneficio">
                        <span class="tarjeta__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M12 2 2 7l10 5 10-5zm0 8L4 6.5V13c0 3 3.6 5.5 8 6.5 4.4-1 8-3.5 8-6.5V6.5z"/></svg>
                        </span>
                        <h3 class="tarjeta__titulo">Ahorro fiscal</h3>
                        <p class="tarjeta__texto">
                            Aprovechamos deducciones y esquemas legales para reducir tu
                            carga tributaria.
                        </p>
                    </article>

                    <article class="tarjeta tarjeta--beneficio">
                        <span class="tarjeta__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M12 2a5 5 0 0 0-5 5v3H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-5-5m-3 8V7a3 3 0 0 1 6 0v3z"/></svg>
                        </span>
                        <h3 class="tarjeta__titulo">Portal seguro 24/7</h3>
                        <p class="tarjeta__texto">
                            Accede a tu información y documentos en cualquier momento con
                            total confidencialidad.
                        </p>
                    </article>

                    <article class="tarjeta tarjeta--beneficio">
                        <span class="tarjeta__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5m0 2c-4 0-8 2-8 4.5V21h16v-2.5C20 16 16 14 12 14"/></svg>
                        </span>
                        <h3 class="tarjeta__titulo">Atención personalizada</h3>
                        <p class="tarjeta__texto">
                            Un asesor dedicado que conoce tu caso y responde tus dudas
                            cuando lo necesitas.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section class="seccion contacto" id="contacto">
            <div class="contenedor contacto__inner">
                <div class="contacto__info">
                    <p class="seccion__etiqueta seccion__etiqueta--claro">Solicita tu asesoría</p>
                    <h2 class="seccion__titulo seccion__titulo--claro">Déjanos tus datos y te contactamos</h2>
                    <p class="contacto__texto">
                        Completa el formulario y un asesor de LS ASESORES se pondrá en
                        contacto contigo para ofrecerte la mejor solución contable.
                    </p>
                    <ul class="contacto__lista">
                        <li>Respuesta en menos de 24 horas hábiles.</li>
                        <li>Primera consulta de diagnóstico sin costo.</li>
                        <li>Información tratada de forma confidencial.</li>
                    </ul>
                </div>

                <div class="contacto__formulario">
                    <form id="formulario-contacto" class="formulario" action="procesar.php" method="post" novalidate>
                        <div class="campo">
                            <label class="campo__label" for="nombre">Nombre completo <span class="campo__req">*</span></label>
                            <input class="campo__input" type="text" id="nombre" name="nombre"
                                   placeholder="Ej. Ana Martínez" autocomplete="name" maxlength="120" required>
                            <p class="campo__error" data-error="nombre" hidden></p>
                        </div>

                        <div class="campo">
                            <label class="campo__label" for="email">Correo electrónico <span class="campo__req">*</span></label>
                            <input class="campo__input" type="email" id="email" name="email"
                                   placeholder="tucorreo@ejemplo.com" autocomplete="email" maxlength="150" required>
                            <p class="campo__error" data-error="email" hidden></p>
                        </div>

                        <div class="campo">
                            <label class="campo__label" for="telefono">Teléfono <span class="campo__req">*</span></label>
                            <input class="campo__input" type="tel" id="telefono" name="telefono"
                                   placeholder="Ej. +52 55 1234 5678" autocomplete="tel" maxlength="30" required>
                            <p class="campo__error" data-error="telefono" hidden></p>
                        </div>

                        <div class="campo">
                            <label class="campo__label" for="servicio">Servicio de interés <span class="campo__req">*</span></label>
                            <select class="campo__input campo__select" id="servicio" name="servicio" required>
                                <option value="" selected disabled>Selecciona una opción</option>
                                <?php foreach (SERVICIOS_PERMITIDOS as $valor => $texto): ?>
                                    <option value="<?= htmlspecialchars($valor, ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="campo__error" data-error="servicio" hidden></p>
                        </div>

                        <div class="campo">
                            <label class="campo__label" for="mensaje">Mensaje <span class="campo__opcional">(opcional)</span></label>
                            <textarea class="campo__input campo__textarea" id="mensaje" name="mensaje" rows="4"
                                      placeholder="Cuéntanos brevemente qué necesitas" maxlength="1000"></textarea>
                            <p class="campo__error" data-error="mensaje" hidden></p>
                        </div>

                        <button type="submit" class="boton boton--primario boton--bloque">Enviar solicitud</button>

                        <div id="mensaje-respuesta" class="alerta" role="status" aria-live="polite" hidden></div>
                    </form>
                </div>
            </div>
        </section>

<?php require __DIR__ . '/includes/partials/footer.php'; ?>
