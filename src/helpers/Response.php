<?php

namespace App\helpers;

class Response
{
    public static function json(mixed $data, int $status): void
    {
        http_response_code($status);

        if (!$data) exit;

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        exit;
    }

    public static function ok(array $data): void
    {
        self::json($data, 200);
    }

    public static function noContent(): void
    {
        self::json(null, 204);
    }

    public static function created(array $data): void
    {
        self::json($data, 201);
    }

    public static function notFound(array $data): void
    {
        self::json($data, 404);
    }

    public static function internalServerError(array $data): void
    {
        self::json($data, 500);
    }
}
