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
        } else {
            infoMessage.innerHTML = "";
            callToCreateAccountPhp();
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

function callToCreateAccountPhp() {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            infoMessage.innerHTML = this.responseText;
        }
    };

    const url = buildCreateAccountUrl();
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function buildCreateAccountUrl() {
    const name = document.querySelector("#name").value;
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;

    return `create-account.php?name=${name}&email=${email}&password=${password}`;
}
