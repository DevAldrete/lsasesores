-- ============================================================
-- LS ASESORES - Esquema de base de datos
-- Compatible con MySQL 8 y MariaDB (XAMPP / Docker)
-- ============================================================

CREATE DATABASE IF NOT EXISTS lsasesores
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE lsasesores;

CREATE TABLE IF NOT EXISTS leads (
    id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre         VARCHAR(120) NOT NULL,
    email          VARCHAR(150) NOT NULL,
    telefono       VARCHAR(30)  NOT NULL,
    servicio       VARCHAR(60)  NOT NULL,
    mensaje        TEXT         NULL,
    ip             VARCHAR(45)  NULL,
    fecha_creacion TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_email (email),
    KEY idx_fecha_creacion (fecha_creacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
