const BUTTON_PERFIL = document.querySelector("#perfilButton");
const BUTTON_HOME = document.querySelector("#homeButton");
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const CURRENT_USER_EMAIL = getEmailByLocalStorage();

populateData();

function populateData() {
    var friends = findFriendsByUserEmailPhp();
    if (friends != null) {
        // var amigo = document.createElement('div class="conteudo"');
    }
}

/**
 *
 * @returns {string}
 */
function getEmailByLocalStorage() {
    const userJson = localStorage.getItem("user");
    return JSON.parse(userJson).email;
}

BUTTON_PERFIL.addEventListener("click", () => redirect("/site-programacao-web/components/perfil/perfil.html"));
BUTTON_HOME.addEventListener("click", () => redirect("/site-programacao-web/components/home/home.html"));

function redirect(path) {
    window.location.pathname = path;
} 

function findFriendsByUserEmailPhp() {
    let amigoOutput;
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            amigoOutput = JSON.parse(this.responseText);
            console.log(this.responseText);
        }
    };

    const getFriendsByUserEmailObject = {
        methodName: "findAmigosByUserEmail",
        methodParameters: [CURRENT_USER_EMAIL]
    };
    const body = buildBody(getFriendsByUserEmailObject);

    xmlHttpRequest.open("POST", METHOD_UTIL_PHP_URL, false);
    xmlHttpRequest.send(body);

    console.log("amigo.js - findFriendsByUserEmailPhp");
    console.log(amigoOutput);
    return amigoOutput;
}

/**
 * @param amigo
 * @returns {FormData}
 */
function buildBody(amigo) {
    const formData = new FormData();

    Object
        .keys(amigo)
        .forEach(key => formData.append(key, amigo[key]))
    ;

    return formData;
}