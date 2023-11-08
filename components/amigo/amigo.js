const BUTTON_PERFIL = document.querySelector("#perfilButton");
const BUTTON_HOME = document.querySelector("#homeButton");
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const CURRENT_USER_EMAIL = getEmailByLocalStorage();

populateData();

function populateData() {
    console.log(CURRENT_USER_EMAIL)
    var friends = findFriendsByUserEmailPhp();
    console.log(friends);
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
            console.log(this.responseText)
            amigoOutput = JSON.parse(this.responseText);
        }
    };

    const getFriendsByUserEmailObject = {
        methodName: "findAmigosByUserEmail",
        methodParameters: [CURRENT_USER_EMAIL]
    };
    const body = buildBody(getFriendsByUserEmailObject);

    xmlHttpRequest.open("POST", METHOD_UTIL_PHP_URL, false);
    xmlHttpRequest.send(body);

    return amigoOutput;
}

/**
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