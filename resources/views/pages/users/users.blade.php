@extends('index')

@section('content')
<style>
    .table-list-users {
        border: 1px solid lightgray;
        border-radius: 5px;
        margin: 15px 0px;
    }

    .table .btn {
        margin: 0 2px;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        width: 90vw;
        background: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        max-width: 500px;
    }

    .modal-content .btn {
        margin: 10px auto;
        max-width: 250px;
    }

    .button-group {
        display: flex;
        gap: 5px;
    }

    .button-group .btn {
        margin: 0;
    }

    .btn-create {
        margin-bottom: 15px;
    }

    .error {
        color: red;
        font-size: 0.875rem;
        margin-top: 5px;
    }
</style>
<div class="container mt-4">
    <h2>Listagem de Usuários</h2>

    <button class="btn btn-success btn-create" onclick="showCreateModal()">Criar Usuário</button>

    <div class="table-responsive table-list-users">
        <table class="table table-striped" id="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Email Verificado</th>
                    <th>Criado Em</th>
                    <th>Atualizado Em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination">
        </ul>
    </nav>
</div>

<!-- Modal de Exclusão -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <p>Tem certeza de que deseja deletar?</p>
        <button id="confirmDelete" class="btn btn-danger">Sim</button>
        <button id="cancelDelete" class="btn btn-secondary">Não</button>
    </div>
</div>

<!-- Modal de Edição -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Editar Usuário</h3>
        <form id="editUserForm">
            <input type="hidden" id="editUserId">
            <div class="form-group">
                <label for="editUserName">Nome:</label>
                <input type="text" id="editUserName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editUserEmail">Email:</label>
                <input type="email" id="editUserEmail" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editUserBirthDate">Data de Nascimento:</label>
                <input type="date" id="editUserBirthDate" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" id="cancelEdit" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Criação -->
<div id="createModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Criar Usuário</h3>
        <form id="createUserForm">
            <div class="form-group">
                <label for="createUserName">Nome:</label>
                <input type="text" id="createUserName" class="form-control" required>
                <div id="createUserNameError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="createUserEmail">Email:</label>
                <input type="email" id="createUserEmail" class="form-control" required>
                <div id="createUserEmailError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="createUserBirthDate">Data de Nascimento:</label>
                <input type="date" id="createUserBirthDate" class="form-control" required>
                <div id="createUserBirthDateError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="createUserPassword">Senha:</label>
                <input type="password" id="createUserPassword" class="form-control" required>
                <div id="createUserPasswordError" class="error"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Criar</button>
                <button type="button" id="cancelCreate" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/users/users.js') }}"></script>
<script>
    const baseUrl = '/api/users';

    window.showCreateModal = function() {
        document.getElementById('createModal').style.display = 'flex';
    };

    document.getElementById('createUserForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('createUserName').value;
        const email = document.getElementById('createUserEmail').value;
        const birthDate = document.getElementById('createUserBirthDate').value;
        const password = document.getElementById('createUserPassword').value;

        document.getElementById('createUserNameError').textContent = '';
        document.getElementById('createUserEmailError').textContent = '';
        document.getElementById('createUserBirthDateError').textContent = '';
        document.getElementById('createUserPasswordError').textContent = '';

        fetch(`${baseUrl}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${localStorage.getItem("authToken")}`,
                },
                credentials: "include",
                body: JSON.stringify({
                    name,
                    email,
                    birth_date: birthDate,
                    password
                }),
            })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                }
                return response.json().then((data) => {
                    throw new Error(JSON.stringify(data.errors));
                });
            })
            .then(() => {
                window.location.reload();
            })
            .catch((error) => {
                const errors = JSON.parse(error.message);
                if (errors.name) {
                    document.getElementById('createUserNameError').textContent = errors.name.join(', ');
                }
                if (errors.email) {
                    document.getElementById('createUserEmailError').textContent = errors.email.join(', ');
                }
                if (errors.birth_date) {
                    document.getElementById('createUserBirthDateError').textContent = errors.birth_date.join(', ');
                }
                if (errors.password) {
                    document.getElementById('createUserPasswordError').textContent = errors.password.join(', ');
                }
            });
    });

    document.getElementById('cancelCreate').addEventListener('click', function() {
        document.getElementById('createModal').style.display = 'none';
    });
</script>
@endsection
