CREATE DATABASE marina_beauty;

USE marina_beauty;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL UNIQUE,
    senha VARCHAR(15) NOT NULL
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    data_atendimento DATE NOT NULL,
    horario_atendimento TIME NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

INSERT INTO clientes (nome, email, telefone, senha) VALUES
('João Silva', 'joao@gmail.com', '18991345896', '0128'),
('Maria Oliveira', 'maria@gmail.com', '18994402892', '7124'),
('Pedro Souza', 'pedro@gmail.com', '18993256851', '1234');

INSERT INTO agendamentos (cliente_id, data_atendimento, horario_atendimento) VALUES
(1, '2024-12-06', '15:00'),
(2, '2024-11-25', '17:00'),
(3, '2024-01-07', '18:00');
