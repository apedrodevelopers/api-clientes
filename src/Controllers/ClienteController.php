<?php

namespace App\Controllers;

use App\helpers\Response;
use App\Models\ClienteModel;

class ClienteController
{
    public function getAll(): void
    {

        try {
            $clientes = ClienteModel::getAll();

            Response::ok(["status" => "success", "data" => $clientes]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Response::internalServerError(["status" => "error", "data" => "Ocorreu um erro no servidor. Tenta novamente"]);
        }
    }

    public function getById(int $id): void
    {
        try {
            $cliente = ClienteModel::getById($id);

            if ($cliente === false) {
                Response::notFound(["status" => "error", "data" => "Registo não encontrado"]);
                exit;
            }

            Response::ok(["status" => "success", "data" => $cliente]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Response::internalServerError(["status" => "error", "data" => "Ocorreu um erro no servidor. Tenta novamente"]);
        }
    }

    public function create(): void
    {
        try {
            $content = file_get_contents("php://input");

            $data = json_decode($content, true);

            $idCliente = ClienteModel::create($data["nome"], $data["email"]);

            Response::created(["status" => "success", "data" => ["id_cliente" => $idCliente]]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Response::internalServerError(["status" => "error", "data" => "Ocorreu um erro no servidor. Tenta novamente"]);
        }
    }

    public function update(int $id): void
    {
        try {
            $cliente = ClienteModel::getById($id);

            if ($cliente === false) {
                Response::notFound(["status" => "error", "data" => "Registo não encontrado"]);
                exit;
            }

            $content = file_get_contents("php://input");

            $data = json_decode($content, true);

            ClienteModel::update($data["nome"], $data["email"], $id);

            Response::noContent();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Response::internalServerError(["status" => "error", "data" => "Ocorreu um erro no servidor. Tenta novamente"]);
        }
    }

    public function delete(int $id): void
    {
        try {
            $cliente = ClienteModel::getById($id);

            if ($cliente === false) {
                Response::notFound(["status" => "error", "data" => "Registo não encontrado"]);
                exit;
            }

            ClienteModel::delete($id);

            Response::noContent();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Response::internalServerError(["status" => "error", "data" => "Ocorreu um erro no servidor. Tenta novamente"]);
        }
    }
}
