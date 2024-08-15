document.addEventListener("DOMContentLoaded", () => {
    const usersTableBody = document.querySelector("#users-table tbody");
    const pagination = document.querySelector("#pagination");
    const deleteModal = document.querySelector("#deleteModal");
    const confirmDelete = document.querySelector("#confirmDelete");
    const cancelDelete = document.querySelector("#cancelDelete");
    let deleteUserId = null;

    const baseUrl = `${window.location.origin}/api/users`;

    window.fetchUsers = function (page = 1) {
        fetch(`${baseUrl}?page=${page}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem("authToken")}`,
            },
            credentials: "include",
        })
            .then((response) => response.json())
            .then((data) => {
                renderTable(data.data);
                renderPagination(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    function formatDate(dateString) {
        const options = { year: "numeric", month: "long", day: "numeric" };
        return new Date(dateString).toLocaleDateString(undefined, options);
    }

    function renderTable(users) {
        usersTableBody.innerHTML = "";
        users.forEach((user) => {
            const row = document.createElement("tr");
            row.setAttribute('data-id', user.id);
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${formatDate(user.birth_date)}</td>
                <td>${
                    user.email_verified_at
                        ? formatDate(user.email_verified_at)
                        : "Não Verificado"
                }</td>
                <td>${formatDate(user.created_at)}</td>
                <td>${formatDate(user.updated_at)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="showDeleteModal(${user.id})">Deletar</button>
                </td>
            `;
            usersTableBody.appendChild(row);
        });
    }

    function renderPagination(data) {
        pagination.innerHTML = "";

        if (data.prev_page_url) {
            pagination.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="fetchUsers(${data.current_page - 1}); return false;" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Anterior</span>
                    </a>
                </li>
            `;
        } else {
            pagination.innerHTML += `
                <li class="page-item disabled">
                    <span class="page-link">&laquo; Anterior</span>
                </li>
            `;
        }

        for (let i = 1; i <= data.last_page; i++) {
            pagination.innerHTML += `
                <li class="page-item ${data.current_page === i ? "active" : ""}">
                    <a class="page-link" href="#" onclick="fetchUsers(${i}); return false;">${i}</a>
                </li>
            `;
        }

        if (data.next_page_url) {
            pagination.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="fetchUsers(${data.current_page + 1}); return false;" aria-label="Next">
                        <span aria-hidden="true">Próximo &raquo;</span>
                    </a>
                </li>
            `;
        } else {
            pagination.innerHTML += `
                <li class="page-item disabled">
                    <span class="page-link">Próximo &raquo;</span>
                </li>
            `;
        }
    }

    window.showDeleteModal = function (userId) {
        deleteUserId = userId;
        deleteModal.style.display = 'flex';
    }

    confirmDelete.addEventListener("click", () => {
        if (deleteUserId) {
            fetch(`${baseUrl}/${deleteUserId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${localStorage.getItem("authToken")}`,
                },
                credentials: "include",
            })
                .then((response) => {
                    if (response.ok) {
                        return response.text(); 
                    }
                    throw new Error("Failed to delete user");
                })
                .then(() => {
                    window.location.reload(); 
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });

    cancelDelete.addEventListener("click", () => {
        deleteModal.style.display = 'none';
    });

    fetchUsers();
});
