const loginButton = document.querySelector("#login");
const createAccountButton = document.querySelector("#createAccount");
const infoMessage = document.querySelector("#infoMessage");

loginButton.addEventListener("click", () => login());
createAccountButton.addEventListener("click", () => createAccountRedirect());

function createAccountRedirect() {
    window.location.pathname = "/site-programacao-web-main/components/create-account/create-account.html";
}

function login() {
    if (validateEmptyFields()) {
        vefifyUserExists();
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

function vefifyUserExists() {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const responseObject = base64ToObject(this.responseText);

            if (responseObject.userExists) {
                userExists();
            } else {
                userNotExists(responseObject);
            }
        }
    };

    const url = buildCreateAccountUrl();
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function userExists() {
    const valueEmail = document.querySelector("#email").value;

    localStorage.setItem(
        "data", JSON.stringify([
            {
                user: {
                    name: valueEmail
                }
            }
        ])
    )
    window.location.pathname = "/site-programacao-web-main/components/home/home.html";
}

function userNotExists(responseObject) {
    infoMessage.innerHTML = responseObject.message;
}

function buildCreateAccountUrl() {
    const object = buildCreateAccountObject();
    const base64Object = objectToBase64(object);

    return `login.php?data=${base64Object}`;
}

function buildCreateAccountObject() {
    const valueEmail = document.querySelector("#email").value;
    const valuePassword = document.querySelector("#password").value;

    return {
        email: valueEmail,
        password: valuePassword
    }
}

function objectToBase64(object) {
    const objectJson = JSON.stringify(object);

    return stringToBase64(objectJson);
}

function base64ToObject(base64) {
    const string = base64ToString(base64);
    return JSON.parse(string);
}

function stringToBase64(value) {
    return window.btoa(value);
}

function base64ToString(value) {
    return decodeURIComponent(atob(value));
}