CREATE DATABASE dbapi;

USE dbapi;

CREATE TABLE cursos (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    ativo BIT DEFAULT 1
);

INSERT INTO cursos (nome) VALUES ('Lógica de Programação');
INSERT INTO cursos (nome) VALUES ('Banco de Dados');
INSERT INTO cursos (nome) VALUES ('PHP 8');
INSERT INTO cursos (nome, ativo) VALUES ('HTML');
INSERT INTO cursos (nome, ativo) VALUES ('CSS', 1);
INSERT INTO cursos (nome, ativo) VALUES ('APIs');
INSERT INTO cursos (nome, ativo) VALUES ('Redes', 0);
INSERT INTO cursos (nome, ativo) VALUES ('Javascript');
