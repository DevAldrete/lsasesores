/**
 * LS ASESORES - Interacciones del cliente
 *
 * 1) Menú de navegación móvil.
 * 2) Validación del formulario en el cliente.
 * 3) Envío asíncrono (fetch) y mensaje de confirmación (reward message).
 *
 * Las reglas replican las del servidor (includes/validaciones.php), que es
 * quien tiene la última palabra.
 */
(function () {
    'use strict';

    /* ---------- 1. Menú de navegación móvil ---------- */
    var toggle = document.querySelector('.nav__toggle');
    var menu = document.getElementById('menu-principal');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var abierto = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!abierto));
            toggle.setAttribute('aria-label', abierto ? 'Abrir menú de navegación' : 'Cerrar menú de navegación');
            menu.setAttribute('data-abierto', String(!abierto));
        });

        Array.prototype.forEach.call(menu.querySelectorAll('a'), function (enlace) {
            enlace.addEventListener('click', function () {
                toggle.setAttribute('aria-expanded', 'false');
                menu.setAttribute('data-abierto', 'false');
            });
        });
    }

    /* ---------- 2 y 3. Formulario de contacto ---------- */
    var formulario = document.getElementById('formulario-contacto');
    if (!formulario) {
        return;
    }

    var alerta = document.getElementById('mensaje-respuesta');
    var boton = formulario.querySelector('button[type="submit"]');
    var SERVICIOS = ['contabilidad', 'impuestos', 'asesoria'];

    var reglas = {
        nombre: function (valor) {
            var v = valor.trim();
            if (!v) return 'El nombre es obligatorio.';
            if (v.length < 3 || v.length > 120) return 'El nombre debe tener entre 3 y 120 caracteres.';
            if (!/^[\p{L}\s.'-]+$/u.test(v)) return 'El nombre contiene caracteres no válidos.';
            return '';
        },
        email: function (valor) {
            var v = valor.trim();
            if (!v) return 'El correo electrónico es obligatorio.';
            if (v.length > 150 || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) {
                return 'Ingresa un correo electrónico válido.';
            }
            return '';
        },
        telefono: function (valor) {
            var v = valor.trim();
            var digitos = v.replace(/\D+/g, '');
            if (!v) return 'El teléfono es obligatorio.';
            if (!/^[0-9+\-\s()]+$/.test(v) || digitos.length < 7 || digitos.length > 15) {
                return 'Ingresa un teléfono válido (entre 7 y 15 dígitos).';
            }
            return '';
        },
        servicio: function (valor) {
            if (!valor) return 'Selecciona un servicio.';
            if (SERVICIOS.indexOf(valor) === -1) return 'El servicio seleccionado no es válido.';
            return '';
        },
        mensaje: function (valor) {
            if (valor.trim().length > 1000) return 'El mensaje no puede superar los 1000 caracteres.';
            return '';
        }
    };

    function mostrarError(campo, mensaje) {
        var contenedor = formulario.querySelector('[data-error="' + campo + '"]');
        var input = formulario.elements[campo];

        if (contenedor) {
            contenedor.textContent = mensaje;
            contenedor.hidden = !mensaje;
        }
        if (input && input.closest('.campo')) {
            input.closest('.campo').classList.toggle('campo--invalido', Boolean(mensaje));
            input.setAttribute('aria-invalid', mensaje ? 'true' : 'false');
        }
    }

    function validarCampo(campo) {
        var input = formulario.elements[campo];
        if (!input || !reglas[campo]) {
            return '';
        }
        var mensaje = reglas[campo](input.value);
        mostrarError(campo, mensaje);
        return mensaje;
    }

    function validarFormulario() {
        var valido = true;
        var primerError = null;

        Object.keys(reglas).forEach(function (campo) {
            if (validarCampo(campo)) {
                valido = false;
                if (!primerError) {
                    primerError = formulario.elements[campo];
                }
            }
        });

        if (primerError) {
            primerError.focus();
        }
        return valido;
    }

    Object.keys(reglas).forEach(function (campo) {
        var input = formulario.elements[campo];
        if (!input) {
            return;
        }
        input.addEventListener('blur', function () {
            validarCampo(campo);
        });
        input.addEventListener('input', function () {
            if (input.getAttribute('aria-invalid') === 'true') {
                validarCampo(campo);
            }
        });
    });

    function mostrarAlerta(tipo, mensaje) {
        alerta.textContent = mensaje;
        alerta.className = 'alerta alerta--' + tipo;
        alerta.hidden = false;
        alerta.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    formulario.addEventListener('submit', function (evento) {
        evento.preventDefault();
        alerta.hidden = true;

        if (!validarFormulario()) {
            mostrarAlerta('error', 'Revisa los campos marcados e inténtalo de nuevo.');
            return;
        }

        boton.disabled = true;
        boton.textContent = 'Enviando...';

        fetch(formulario.action, {
            method: 'POST',
            body: new FormData(formulario),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(function (respuesta) {
                return respuesta.json().then(function (data) {
                    return { ok: respuesta.ok, data: data };
                });
            })
            .then(function (resultado) {
                var data = resultado.data;

                if (resultado.ok && data.ok) {
                    mostrarAlerta('exito', data.mensaje);
                    formulario.reset();
                    Object.keys(reglas).forEach(function (campo) {
                        mostrarError(campo, '');
                    });
                    return;
                }

                if (data && data.errores) {
                    Object.keys(data.errores).forEach(function (campo) {
                        mostrarError(campo, data.errores[campo]);
                    });
                }
                mostrarAlerta('error', (data && data.mensaje) || 'No se pudo enviar la solicitud.');
            })
            .catch(function () {
                mostrarAlerta('error', 'No se pudo conectar con el servidor. Verifica tu conexión e inténtalo de nuevo.');
            })
            .finally(function () {
                boton.disabled = false;
                boton.textContent = 'Enviar solicitud';
            });
    });
})();
