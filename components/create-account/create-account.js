const createAccountButton = document.querySelector("#createAccount");
const viewPasswordButton = document.querySelector("#viewPassword");

const infoMessage = document.querySelector("#infoMessage");

createAccountButton.addEventListener("click", () => validatePassword());
viewPasswordButton.addEventListener("click", () => viewPassword());

function validatePassword() {
    const valuePassword = document.querySelector("#password").value;
    const valueConfirmPassword = document.querySelector("#confirmPassword").value;

    if (validateEmptyFields()) {
        if (valuePassword.value !== valueConfirmPassword.value) {
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
    const valuePassword = document.querySelector("#password").value;
    const valueConfirmPassword = document.querySelector("#confirmPassword").value;

    if (valuePassword.type === "password") {
        valuePassword.type = "text";
        valueConfirmPassword.type = "text";
    } else {
        valuePassword.type = "password";
        valueConfirmPassword.type = "password";
    }
}

function callToCreateAccountPhp() {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const responseObject = base64ToObject(this.responseText);

            infoMessage.innerHTML = responseObject.message;
        }
    };

    const url = buildCreateAccountUrl();
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function buildCreateAccountUrl() {
    const object = buildCreateAccountObject();
    const base64Object = objectToBase64(object);

    return `create-account.php?data=${base64Object}`;
}

function buildCreateAccountObject() {
    const valueName = document.querySelector("#name").value;
    const valueEmail = document.querySelector("#email").value;
    const valuePassword = document.querySelector("#password").value;

    return {
        name: valueName,
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
    return window.btoa(encodeURIComponent(value));
}

function base64ToString(value) {
    return decodeURIComponent(atob(value));
}