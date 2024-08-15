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
</style>
<div class="container mt-4">
    <h2>Listagem de Usuários</h2>

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

<script src="{{ asset('js/users/users.js') }}"></script>
@endsection