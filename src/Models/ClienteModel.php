<?php

namespace App\Models;

use PDO;

class ClienteModel
{

    public static function getAll(): array
    {
        return self::getConnection()->query("SELECT * FROM clientes;")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id): false|array
    {
        $db = self::getConnection();

        $st = $db->prepare("SELECT * FROM clientes WHERE id = :id;");
        $st->bindParam(":id", $id);

        $st->execute();

        $cliente = $st->fetch(PDO::FETCH_ASSOC);

        return $cliente;
    }

    public static function delete(int $id): void
    {
        $db = self::getConnection();

        $st = $db->prepare("DELETE FROM clientes WHERE id = :id;");
        $st->bindParam(":id", $id);

        $st->execute();
    }

    public static function create(string $nome, string $email): int
    {
        $db = self::getConnection();

        $st = $db->prepare("INSERT INTO clientes(nome, email) VALUES(:nome, :email)");
        $st->bindParam(":nome", $nome);
        $st->bindParam(":email", $email);

        $st->execute();

        $idCliente = $db->lastInsertId();

        return $idCliente;
    }

    public static function update(string $nome, string $email, int $id): void
    {
        $db = self::getConnection();

        $st = $db->prepare("UPDATE clientes SET nome =:nome, email = :email WHERE id = :id");
        $st->bindParam(":nome", $nome);
        $st->bindParam(":email", $email);
        $st->bindParam(":id", $id);

        $st->execute();
    }

    private static function getConnection(): \PDO
    {
        $dsn = "mysql:host=localhost;dbname=api_clientes;charset=utf8mb4";
        $username = "root";
        $password = "0000";

        return new PDO($dsn, $username, $password);
    }
}
