<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController
{
    public function getAll(): void
    {
        $clientes = ClienteModel::getAll();

        // Header
        header("Content-Type: application/json");
        // Content-Type: text/plain
        // Content-Type: application/xml
        // ....

        // Status code
        http_response_code(200);

        // converter para JSON
        $json = json_encode($clientes);
        echo $json;
    }

    public function getById(int $id): void
    {
        try {
            $cliente = ClienteModel::getById($id);

            if ($cliente === false) {
                http_response_code(404);
                header("Content-Type: application/json");
                $response = json_encode(["messagem" => "erro", "descricao" => "Registo nao encontrado"]);

                echo $response;
                exit;
            }

            http_response_code(200);
            header("Content-Type: application/json");
            $response = json_encode($cliente);

            echo $response;
        } catch (\Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            $response = json_encode(["messagem" => "erro", "descricao" => $e->getMessage()]);

            echo $response;
        }
    }

    public function create(): void
    {
        try {
            $content = file_get_contents("php://input");

            $data = json_decode($content, true);

            $idCliente = ClienteModel::create($data["nome"], $data["email"]);

            http_response_code(201);
            header("Content-Type: application/json");
            $response = json_encode(["messagem" => "sucesso", "id_cliente" => $idCliente]);

            echo $response;
        } catch (\Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            $response = json_encode(["messagem" => "erro", "descricao" => $e->getMessage()]);

            echo $response;
        }
    }

    public function update(int $id): void
    {
        try {
            $cliente = ClienteModel::getById($id);

            if ($cliente === false) {
                http_response_code(404);
                header("Content-Type: application/json");
                $response = json_encode(["messagem" => "erro", "descricao" => "Registo nao encontrado"]);

                echo $response;
                exit;
            }

            $content = file_get_contents("php://input");

            // converter para array
            $data = json_decode($content, true);

            ClienteModel::update($data["nome"], $data["email"], $id);

            http_response_code(204);
        } catch (\Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            $response = json_encode(["messagem" => "erro", "descricao" => $e->getMessage()]);

            echo $response;
        }
    }

    public function delete(int $id): void
    {
        try {
            $cliente = ClienteModel::getById($id);

            if ($cliente === false) {
                http_response_code(404);
                header("Content-Type: application/json");
                $response = json_encode(["messagem" => "erro", "descricao" => "Registo nao encontrado"]);

                echo $response;
                exit;
            }

            ClienteModel::delete($id);

            http_response_code(204);
        } catch (\Exception $e) {
            http_response_code(500);
            header("Content-Type: application/json");
            $response = json_encode(["messagem" => "erro", "descricao" => $e->getMessage()]);

            echo $response;
        }
    }
}
