<!-- Modal de Edição -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Editar Usuário</h3>
        <form id="editUserForm">
            <input type="hidden" id="editUserId">
            <div class="form-group">
                <label for="editUserName">Nome:</label>
                <input type="text" id="editUserName" class="form-control" required>
                <div id="editUserNameError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="editUserEmail">Email:</label>
                <input type="email" id="editUserEmail" class="form-control" required>
                <div id="editUserEmailError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="editUserBirthDate">Data de Nascimento:</label>
                <input type="date" id="editUserBirthDate" class="form-control" required>
                <div id="editUserBirthDateError" class="error"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" id="cancelEdit" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>
</div>
