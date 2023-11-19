const createAccountButton = document.querySelector("#createAccount");
const viewPasswordButton = document.querySelector("#viewPassword");
const backToLoginButton = document.querySelector("#backToLogin");
const infoMessage = document.querySelector("#infoMessage");
const HOSTNAME = isDevelopment()
    ? "/site-programacao-web"
    : ""
;

createAccountButton.addEventListener("click", () => validatePassword());
viewPasswordButton.addEventListener("click", () => viewPassword());
backToLoginButton.addEventListener("click", () => backToLogin());

function validatePassword() {
    const valuePassword = document.querySelector("#password");
    const valueConfirmPassword = document.querySelector("#confirmPassword");

    if (validateEmptyFields()) {
        if (valuePassword.value !== valueConfirmPassword.value) {
            infoMessage.innerHTML = "Senhas não conferem";
        } else {
            infoMessage.innerHTML = "";
            callToCreateAccountPhp();
        }
    }
}

function viewPassword() {
    const inputPassword = document.querySelector("#password");
    const inputConfirmPassword = document.querySelector("#confirmPassword");

    if (inputPassword.type === "password") {
        inputPassword.type = "text";
        inputConfirmPassword.type = "text";
    } else {
        inputPassword.type = "password";
        inputConfirmPassword.type = "password";
    }
}

function backToLogin() {
    window.location.pathname = `..${HOSTNAME}/index.html`;
}

/**
 *
 * @returns {boolean}
 */
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

function callToCreateAccountPhp() {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const responseObject = JSON.parse(this.responseText);

            infoMessage.innerHTML = responseObject.message;
        }
    };

    const url = "create-account.php";
    const body = buildBody();

    xmlHttpRequest.open("POST", url, true);
    xmlHttpRequest.send(body);
}

/**
 *
 * @returns {FormData}
 */
function buildBody() {
    const user = getUserObject();
    const formData = new FormData();

    Object
        .keys(user)
        .forEach(
            key => formData.append(key, user[key])
        )
    ;

    return formData;
}

/**
 *
 * @returns {{password: string, name: string, email: string}}
 */
function getUserObject() {
    const name = document.querySelector("#name").value;
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;

    return {
        name: name,
        email: email,
        password: password
    }
}

function isDevelopment() {
    const xmlHttpRequest = new XMLHttpRequest();
    let isDevelopment = true;

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const responseObject = JSON.parse(this.responseText);
            isDevelopment = responseObject.isDevelopment;
        }
    };

    const URL = "../utils/is-development.php"

    xmlHttpRequest.open("POST", URL, false);
    xmlHttpRequest.send();

    return isDevelopment;
}