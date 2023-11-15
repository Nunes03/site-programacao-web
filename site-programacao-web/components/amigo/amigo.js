const METHOD_UTIL_PHP_URL = "../utils/method-util.php";

window.alert("a");
populateData();

function populateData() {
    const userOutput = findUserByEmailPhp();
    debugger;
    console.log(userOutput);
    userOutput.id;
    var amigo = document.createElement('div class="conteudo"');
}

function findUserByEmailPhp() {
    let userOutput;
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            userOutput = JSON.parse(this.responseText);
        }
    };

    const getUserByEmailObject = {
        methodName: "findUserByEmail",
        methodParameters: [getEmailByLocalStorage()]
    };
    const body = buildBody(getUserByEmailObject);

    xmlHttpRequest.open("POST", METHOD_UTIL_PHP_URL, false);
    xmlHttpRequest.send(body);

    return userOutput;
}

/**
 *
 * @returns {string}
 */
function getEmailByLocalStorage() {
    const userJson = localStorage.getItem("user");
    return JSON.parse(userJson).email;
}

/**
 *
 * @param user
 * @returns {FormData}
 */
function buildBody(user) {
    const formData = new FormData();

    Object
        .keys(user)
        .forEach(key => formData.append(key, user[key]))
    ;

    return formData;
}
