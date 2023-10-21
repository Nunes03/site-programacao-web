const createAccountButton = document.querySelector("#createAccount");
const viewPasswordButton = document.querySelector("#viewPassword");
const infoMessage = document.querySelector("#infoMessage")

createAccountButton.addEventListener("click", () => validatePassword());
viewPasswordButton.addEventListener("click", () => viewPassword());

function validatePassword() {
    const password = document.querySelector("#password");
    const confirmPassword = document.querySelector("#confirmPassword");

    if (validateEmptyFields()) {
        if (password.value !== confirmPassword.value) {
            infoMessage.innerHTML = "Senhas não conferem";
            createAccountButton.type = "button";
        } else {
            infoMessage.innerHTML = "";
            createAccountButton.type = "submit";
            createAccountButton.submit();
        }
    }
}

function validateEmptyFields() {
    const inputFields = document.querySelectorAll("input");

    const amountEmptyFields = Array
        .from(inputFields)
        .filter(inputField => inputField.value == null || inputField.value === "")
        .length
    ;

    if (amountEmptyFields !== 0) {
        infoMessage.innerHTML = "Existem campos vazios";

        return false;
    }

    infoMessage.innerHTML = "";
    return true;
}

function viewPassword() {
    const password = document.querySelector("#password");
    const confirmPassword = document.querySelector("#confirmPassword");

    if (password.type === "password") {
        password.type = "text";
        confirmPassword.type = "text";
    } else {
        password.type = "password";
        confirmPassword.type = "password";
    }
}
