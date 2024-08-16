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
