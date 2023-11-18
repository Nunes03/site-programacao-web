const loginButton = document.querySelector("#login");
const createAccountButton = document.querySelector("#createAccount");
const infoMessage = document.querySelector("#infoMessage");

loginButton.addEventListener("click", () => login());
createAccountButton.addEventListener("click", () => createAccountRedirect());

function createAccountRedirect() {
    window.location.pathname = "/site-programacao-web/components/create-account/create-account.html";
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
            const responseObject = JSON.parse(this.responseText);

            if (responseObject.userExists) {
                userExists();
            } else {
                userNotExists(responseObject);
            }
        }
    };

    const url = "login.php"
    const body = buildBody();

    xmlHttpRequest.open("POST", url, true);
    xmlHttpRequest.send(body);
}

function userExists() {
    const valueEmail = document.querySelector("#email").value;
    const jsonLocalStorege = JSON.stringify({email: valueEmail});

    localStorage.setItem("user", jsonLocalStorege);
    window.location.pathname = "/site-programacao-web/components/home/home.html";
}

function userNotExists(responseObject) {
    infoMessage.innerHTML = responseObject.message;
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
 * @returns {{password: string, email: string}}
 */
function getUserObject() {
    const valueEmail = document.querySelector("#email").value;
    const valuePassword = document.querySelector("#password").value;

    return {
        email: valueEmail,
        password: valuePassword
    }
}