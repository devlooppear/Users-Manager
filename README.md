# Users Manager

O **Users Manager** é um sistema para manipular recursos de usuário. A seguir, estão as tecnologias usadas, instruções de início rápido, rotas disponíveis e detalhes sobre autenticação.

## Tecnologias

-   **Laravel**: Framework PHP para desenvolvimento web. 🐘
-   **JavaScript**: Linguagem de programação para interação e lógica no frontend. 🌐
-   **Bootstrap**: Framework CSS para estilização e design responsivo. 🎨
-   **CSS**: Folhas de estilo em cascata para personalização adicional. ✨

## Requisitos

-   **Docker**: Certifique-se de ter o Docker instalado e em execução. 🐳

## Início Rápido

Siga estas etapas para configurar o projeto:

1. **Copie o arquivo de exemplo do ambiente:**

    ```bash
    cp .env.example .env
    ```

2. Instale as dependências do Composer:

    ```bash
    composer install
    ```

3. Inicie os serviços do Docker Compose:

    ```bash
    docker compose up
    ```

4. Execute as migrações e seeders:

    ```bash
    php artisan migrate:fresh --seed
    ```

Após iniciar os serviços com Docker Compose, a aplicação estará acessível em http://localhost:80. 🌐

## Rotas

Aqui estão as rotas disponíveis na API, com seus respectivos métodos HTTP e os controladores que as manipulam:

### Método Rota Descrição Controlador e Ação

- `POST` api/login Autentica um usuário AuthController@login
- `POST` api/logout Desloga um usuário AuthController@logout
- `GET` api/users Lista todos os usuários
- `POST` api/users Cria um novo usuário UserController@store
- `GET` api/users/{user} Exibe detalhes de um usuário específico
- `PUT	PATCH` api/users/{user} Atualiza um usuário específico
- `DELETE` api/users/{user} Remove um usuário UserController@destroy

## Autenticação

O sistema utiliza o Sanctum para autenticação e gerenciamento de tokens. Certifique-se de configurar o Sanctum corretamente e gerar tokens de acesso para autenticar as solicitações. 🔐
