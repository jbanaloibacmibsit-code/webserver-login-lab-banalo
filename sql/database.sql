CREATE DATABASE lab_login;

\c lab_login

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL
);

INSERT INTO users (username, password, fullname) VALUES
    ('admin', '$2y$12$4s9dmfSYSfiaRzUT3huEjeJYrs41f.9xrAUOU/5jQc5HZ/BPcwTv2', 'Admin User'),
    ('jane', '$2y$12$HEUcYQmTQ2JZG5BYScaxeucxSCBueixUDm595dLpwGOlgzqcVtJ9m', 'Jane Doe'),
    ('banalo', '$2y$12$3cEpaZlh9LitaPAWt8MSa.p905BVHJP8ywwJlNF2cGvfCYaYWbCla', 'Banalo')
ON CONFLICT (username) DO NOTHING;
