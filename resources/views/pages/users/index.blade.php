@extends('index')

@section('content')
<link rel="stylesheet" href="{{ asset('css/users/users.css') }}">

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

<!-- Inclua os modais separados -->
@include('pages.users.create')
@include('pages.users.edit')
@include('pages.users.delete')

<script src="{{ asset('js/users/users.js') }}"></script>
<script src="{{ asset('js/users/users-create.js') }}"></script>
@endsection