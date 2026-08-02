<?php

declare(strict_types=1);

function getDatabaseConnection(): PDO
{
    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $port = getenv('DB_PORT') ?: '5432';
    $dbname = getenv('DB_NAME') ?: 'lab_login';
    $user = getenv('DB_USER') ?: 'postgres';
    $password = getenv('DB_PASSWORD') ?: '';

    $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $dbname);

    if (!extension_loaded('pdo_pgsql')) {
        throw new PDOException('The PHP pdo_pgsql extension is not enabled. Enable php_pdo_pgsql.dll in C:\\php\\php.ini and restart Apache.');
    }

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        return new PDO($dsn, $user, $password, $options);
    } catch (PDOException $exception) {
        throw new PDOException('Unable to connect to PostgreSQL: ' . $exception->getMessage(), (int) $exception->getCode());
    }
}

function ensureDatabaseSchema(PDO $pdo): void
{
    $pdo->exec(<<<SQL
        CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            fullname VARCHAR(100) NOT NULL
        )
SQL);

    $seedUsers = [
        ['admin', 'Admin User', 'Admin@123!'],
        ['jane', 'Jane Doe', 'Password123!'],
        ['banalo', 'Banalo', 'banalo 123'],
    ];

    foreach ($seedUsers as $user) {
        $check = $pdo->prepare('SELECT id FROM users WHERE username = :username');
        $check->execute([':username' => $user[0]]);

        if ($check->fetch()) {
            continue;
        }

        $insert = $pdo->prepare('INSERT INTO users (username, password, fullname) VALUES (:username, :password, :fullname)');
        $insert->execute([
            ':username' => $user[0],
            ':password' => password_hash($user[2], PASSWORD_DEFAULT),
            ':fullname' => $user[1],
        ]);
    }
}
