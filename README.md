# api-clientes

API REST para gerenciamento de clientes.

> **Obs.:** Uma versão melhorada está disponível na branch [`versao-melhorada`](../../tree/versao-melhorada).

## Instalação

```bash
git clone https://github.com/apedrodevelopers/api-clientes.git
composer install
cd api-clientes/public
```

## Como executar

```bash
php -S localhost:80
```

## Endpoints

| Método   | Rota                 | Descrição                |
| -------- | -------------------- | ------------------------ |
| `GET`    | `/api/clientes`      | Listar todos os clientes |
| `GET`    | `/api/clientes/{id}` | Buscar cliente por ID    |
| `POST`   | `/api/clientes`      | Criar novo cliente       |
| `PUT`    | `/api/clientes/{id}` | Atualizar um cliente     |
| `DELETE` | `/api/clientes/{id}` | Deletar um cliente       |
