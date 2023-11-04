const BUTTON_PERFIL = document.querySelector("#perfilButton");
const BUTTON_HOME = document.querySelector("#homeButton");
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const CURRENT_USER_EMAIL = getEmailByLocalStorage();

populateData();

function populateData() {
    // var amigo = document.createElement('div class="conteudo"');
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
