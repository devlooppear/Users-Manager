document.addEventListener("DOMContentLoaded", () => {
    const baseUrl = "/api/users";

    window.showCreateModal = function () {
        document.getElementById("createModal").style.display = "flex";
    };

    document.getElementById("createUserForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const name = document.getElementById("createUserName").value;
        const email = document.getElementById("createUserEmail").value;
        const birthDate = document.getElementById("createUserBirthDate").value;
        const password = document.getElementById("createUserPassword").value;

        document.getElementById("createUserNameError").textContent = "";
        document.getElementById("createUserEmailError").textContent = "";
        document.getElementById("createUserBirthDateError").textContent = "";
        document.getElementById("createUserPasswordError").textContent = "";

        try {
            const response = await fetch(`${baseUrl}`, {
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
                    password,
                }),
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(JSON.stringify(errorData.errors));
            }

            await response.json();
            window.location.reload();
        } catch (error) {
            try {
                const errors = JSON.parse(error.message);
                if (errors.name) {
                    document.getElementById("createUserNameError").textContent =
                        errors.name.join(", ");
                }
                if (errors.email) {
                    document.getElementById("createUserEmailError").textContent =
                        errors.email.join(", ");
                }
                if (errors.birth_date) {
                    document.getElementById("createUserBirthDateError").textContent =
                        errors.birth_date.join(", ");
                }
                if (errors.password) {
                    document.getElementById("createUserPasswordError").textContent =
                        errors.password.join(", ");
                }
            } catch (jsonError) {
                console.error("Error parsing error message:", jsonError);
            }
        }
    });

    document.getElementById("cancelCreate").addEventListener("click", function () {
        document.getElementById("createModal").style.display = "none";
    });
});
