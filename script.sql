DROP DATABASE IF EXISTS api_clientes;

CREATE DATABASE api_clientes
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE api_clientes;

CREATE TABLE clientes (
  id        INT                       NOT NULL AUTO_INCREMENT,
  nome      VARCHAR(100)              NOT NULL,
  email     VARCHAR(150)              NOT NULL,
  estado    ENUM('ativo', 'inativo')  NOT NULL DEFAULT 'ativo',
  criado_em TIMESTAMP                 NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_clientes_email (email)
);