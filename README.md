# Backend P2 – Laravel + Docker

Aplicação Laravel com CRUD de Categorias, preparada para rodar em ambiente Docker (PHP, MySQL e phpMyAdmin). O código-fonte Laravel fica em `project/` e o Docker orquestra os serviços.

## Serviços
- `app` (PHP 8.3 CLI) expondo `http://localhost:8000`
- `mysql` (MySQL 8) em `localhost:3306`
- `phpmyadmin` em `http://localhost:8080` (host configurado para `mysql`)

## Requisitos
- Docker Desktop
- Git (para versionamento)

## Primeira execução
Execute os comandos a partir da raiz do projeto (`c:\Users\Mizael Maarques\Documents\Backend-P2` no Windows):

1. Subir containers e construir imagens
   - `docker compose up -d --build`

2. Instalar dependências do Laravel
   - `docker compose exec app bash -lc "cd /var/www/html/project && composer install"`

3. Configurar `.env` (se ainda não existir)
   - `docker compose exec app bash -lc "cd /var/www/html/project && cp .env.example .env"`
   - Verifique as variáveis de banco:
     - `DB_CONNECTION=mysql`
     - `DB_HOST=mysql`
     - `DB_PORT=3306`
     - `DB_DATABASE=laravel`
     - `DB_USERNAME=laravel`
     - `DB_PASSWORD=laravel`

4. Gerar chave da aplicação
   - `docker compose exec app bash -lc "cd /var/www/html/project && php artisan key:generate"`

5. Rodar migrations
   - `docker compose exec app bash -lc "cd /var/www/html/project && php artisan migrate --force"`

6. Verificar servidor
   - `docker compose logs app --tail=80`
   - Esperado: `Server running on http://0.0.0.0:8000`.

7. Acessar no navegador
   - App: `http://localhost:8000/categorias`
   - phpMyAdmin: `http://localhost:8080` (host: `mysql`, usuário: `laravel`, senha: `laravel`, database: `laravel`)

## Fluxo CRUD de Categorias
- Listagem: `GET /categorias`
- Criar: `GET /categorias/create` (form) → `POST /categorias`
- Editar: `GET /categorias/{id}/edit` (form) → `PUT /categorias/{id}`
- Excluir: `DELETE /categorias/{id}`

## Estrutura
- `project/` – código Laravel (rotas, controllers, models, views)
- `docker/` – Dockerfile e infra da app
- `docker-compose.yml` – orquestra `app`, `mysql`, `phpmyadmin`

## Comandos úteis
- Reiniciar container da app: `docker compose restart app`
- Logs em tempo real: `docker compose logs -f app`
- Criar nova migration: `docker compose exec app bash -lc "cd /var/www/html/project && php artisan make:migration <nome>"`
- Rodar migrations novamente: `docker compose exec app bash -lc "cd /var/www/html/project && php artisan migrate"`

## Versionamento
O `.gitignore` ignora arquivos sensíveis e pesados (ex.: `.env`, `vendor/`). Para enviar alterações:

```bash
git add .
git commit -m "Atualizações"
git push
```

## Notas
- O servidor da app inicia automaticamente no container `app` se o Laravel estiver presente em `project/`.
- Se preferir sessões em arquivo ao invés de banco, ajuste `SESSION_DRIVER=file` no `.env`.