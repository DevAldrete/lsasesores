# LS ASESORES - Landing Page de Servicios Contables y Fiscales

Este repositorio contiene el código fuente y la base de datos de la **Landing Page** para **LS ASESORES**, desarrollada como parte de la evaluación del Parcial 2 de la materia *Metodologías de Desarrollo para Aplicaciones Web*.

La plataforma está diseñada para la captación de clientes interesados en servicios de contabilidad general, declaraciones de impuestos y asesoría financiera.

---

## 🚀 Características y Estructura

La landing page cumple con la estructura requerida para la conversión de clientes:

- **Header:** Logo oficial de LS ASESORES.
- **Hero Section:** Título principal, subtítulo y portada (*Hero Shot*) orientada a la asesoría fiscal.
- **Beneficios:** Sección destacada con los valores principales de la firma (Ahorro fiscal, Portal seguro 24/7, Atención personalizada).
- **Formulario con Validación (Call to Action):** Captura de datos del cliente con validaciones previas al envío en el lado del cliente (JS) y del servidor (PHP).
- **Integración con Base de Datos:** Guardado automático de los leads/solicitudes en MySQL.
- **Mensaje de Confirmación (Reward Message):** Notificación dinámica tras completar el envío del formulario.
- **Footer:** Datos de contacto, ubicación e iconos de redes sociales.

---

## 🛠️ Tecnologías Utilizadas

- **Frontend:** HTML5, CSS3, JavaScript.
- **Backend:** PHP.
- **Base de Datos:** MySQL / MariaDB.
- **Servidor:** Apache / Nginx (MAMP, XAMPP, Docker o Servidor Web).

---

## 📐 Diseño Responsivo (Resoluciones Soportadas)

El diseño está optimizado y probado para adaptarse a las siguientes resoluciones:

1. **1920 x 1080** (Pantallas grandes / Monitor)
2. **1366 x 768** (Laptops estándar)
3. **1024 x 768** (Tablets en orientación horizontal)
4. **420 x 736** (Móviles grandes)
5. **380 x 640** (Móviles estándar)

---

## 📁 Estructura del Proyecto

```
lsasesores/
├── index.php                 # Landing page (punto de entrada)
├── procesar.php              # Endpoint del formulario (validación + guardado)
├── includes/
│   ├── config.php            # Configuración y credenciales (env + .env)
│   ├── db.php                # Conexión PDO a MySQL/MariaDB
│   ├── validaciones.php      # Reglas de validación del servidor
│   └── partials/
│       ├── header.php        # Cabecera y navegación
│       └── footer.php        # Pie de página
├── assets/
│   ├── css/estilos.css       # Estilos y responsive
│   ├── js/validacion.js      # Validación cliente + envío AJAX
│   └── img/                  # Logo y recursos gráficos
├── database/schema.sql       # Esquema de la base de datos
├── docker-compose.yml        # Entorno de desarrollo (web + db + adminer)
├── Dockerfile
└── .env.example
```

---

## ⚙️ Cómo ejecutar el proyecto

### Opción A — Docker (macOS / Linux / Windows)

Requiere [Docker Desktop](https://www.docker.com/products/docker-desktop/).

```bash
docker compose up -d --build
```

| Servicio  | URL / Puerto                    |
|-----------|---------------------------------|
| Landing   | http://localhost:8080           |
| Adminer   | http://localhost:8081           |
| MariaDB   | `localhost:3307`                |

Credenciales de la base de datos (definidas en `docker-compose.yml`):

- **Usuario:** `lsasesores`
- **Contraseña:** `lsasesores`
- **Base de datos:** `lsasesores`

Para detener el entorno:

```bash
docker compose down          # detiene los contenedores (conserva los datos)
docker compose down -v       # detiene y borra la base de datos
```

> Los puertos `8080`, `8081` y `3307` se eligieron para no chocar con XAMPP
> (que usa `80` y `3306`) si ambos se ejecutan al mismo tiempo.

### Opción B — XAMPP

Requiere [XAMPP](https://www.apachefriends.org/) (Apache + MySQL/MariaDB + PHP 8).

1. Copia la carpeta del proyecto a `htdocs`, por ejemplo:
   `C:\xampp\htdocs\lsasesores` (Windows) o `/Applications/XAMPP/htdocs/lsasesores` (macOS).
2. Inicia **Apache** y **MySQL** desde el panel de control de XAMPP.
3. Importa la base de datos:
   - Abre `http://localhost/phpmyadmin`.
   - Ve a la pestaña **Importar** y selecciona `database/schema.sql`.
   - Alternativamente, desde la terminal:
     ```bash
     mysql -u root < database/schema.sql
     ```
4. Abre la aplicación en: `http://localhost/lsasesores/`

> No hace falta configurar nada más: `includes/config.php` usa por defecto
> `localhost`, usuario `root` y sin contraseña, que es la configuración estándar
> de XAMPP. Si tus credenciales son distintas, copia `.env.example` a `.env`
> y ajusta los valores.

---

## 🔧 Configuración (opcional)

Copia `.env.example` a `.env` solo si necesitas cambiar las credenciales:

```dotenv
DB_HOST=localhost
DB_PORT=3306
DB_NAME=lsasesores
DB_USER=root
DB_PASS=
```

En Docker estas variables ya se inyectan desde `docker-compose.yml`, por lo que
el archivo `.env` no es necesario.

---

## 🗄️ Base de Datos

Tabla `leads`, donde se almacenan las solicitudes del formulario:

| Campo            | Tipo          | Descripción                          |
|------------------|---------------|--------------------------------------|
| `id`             | INT (PK, AI)  | Identificador único                  |
| `nombre`         | VARCHAR(120)  | Nombre del cliente                   |
| `email`          | VARCHAR(150)  | Correo electrónico                   |
| `telefono`       | VARCHAR(30)   | Teléfono de contacto                 |
| `servicio`       | VARCHAR(60)   | Servicio de interés                  |
| `mensaje`        | TEXT          | Mensaje opcional                     |
| `ip`             | VARCHAR(45)   | IP de origen de la solicitud         |
| `fecha_creacion` | TIMESTAMP     | Fecha y hora de registro             |

---

## 🔌 Endpoint del formulario

`POST procesar.php` — recibe los datos del formulario y responde en JSON.

- **Éxito (201):** `{ "ok": true, "mensaje": "..." }`
- **Error de validación (422):** `{ "ok": false, "errores": { "campo": "mensaje" } }`
- **Error de servidor (500):** `{ "ok": false, "mensaje": "..." }`

Acepta tanto `FormData` (`application/x-www-form-urlencoded` / `multipart`) como
un cuerpo JSON.
