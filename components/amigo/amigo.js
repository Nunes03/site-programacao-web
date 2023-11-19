const BUTTON_PERFIL = document.querySelector("#perfilButton");
const BUTTON_HOME = document.querySelector("#homeButton");
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const DELETE_AMIGO_URL = "delete-amigo.php"
const CURRENT_USER_EMAIL = getEmailByLocalStorage();
const PROFILE_PHOTO_PATH = "../../src/UserFile/Profile/";
const USER_DEFAULT_PROFILE_PHOTO = "../../assets/fotoPerfil.jpg";
const HOSTNAME = isDevelopment()
    ? "/site-programacao-web"
    : ""
;

const ELEMENTO_AMIGO = document.querySelector('div.container-informacoes-amigos');
populateData();

function populateData() {
    let friends = findFriendsByUserEmail();
    friends.forEach(adicionarElementoAmigoNaTela);
}

function adicionarElementoAmigoNaTela(amigo) {
    let dadosAmigo = findFriendDataByFriendEmail(amigo.email_amigo);

    let amigoContainer = document.createElement('div');
    amigoContainer.classList.add('conteudo');
    amigoContainer.id = CURRENT_USER_EMAIL + amigo.email_amigo;

    let amigoCabecalho = document.createElement('div');
    amigoCabecalho.classList.add('cabecalho-info');

    let amigoNome = document.createElement('span');
    let textNomeAmigo = document.createTextNode(dadosAmigo.name.toString() + " " + dadosAmigo.lastName.toString());
    amigoNome.classList.add('nome-usuario');
    amigoNome.appendChild(textNomeAmigo);

    let containeraAmigoBotao = document.createElement('div');
    containeraAmigoBotao.classList.add('cabecalho-botao');

    let removerAmigoBotao = document.createElement('button');
    removerAmigoBotao.classList.add('botao');
    removerAmigoBotao.addEventListener("click", function () {
        removerAmigo(dadosAmigo.email);
    });

    let textRemoverAmigoBotao = document.createTextNode('Remover amigo');
    removerAmigoBotao.appendChild(textRemoverAmigoBotao);
    containeraAmigoBotao.appendChild(removerAmigoBotao);

    let amigoFoto = document.createElement('img');
    amigoFoto.classList.add('foto-perfil');

    let profilePhotoPath;
    if (dadosAmigo.photoFileName != null) {
        const profilePhotoPathByEmail = dadosAmigo.email
            .replaceAll("@", "_")
            .replaceAll(".", "_")
        ;

        profilePhotoPath = `${PROFILE_PHOTO_PATH}${profilePhotoPathByEmail}/${dadosAmigo.photoFileName}`;
    } else {
        profilePhotoPath = USER_DEFAULT_PROFILE_PHOTO;
    }

    amigoFoto.src = profilePhotoPath

    amigoCabecalho.appendChild(amigoFoto)
    amigoCabecalho.appendChild(amigoNome);
    amigoContainer.appendChild(amigoCabecalho);
    amigoContainer.appendChild(containeraAmigoBotao);
    ELEMENTO_AMIGO.appendChild(amigoContainer);
}

/**
 *
 * @returns {string}
 */
function getEmailByLocalStorage() {
    const userJson = localStorage.getItem("user");
    return JSON.parse(userJson).email;
}

function removeAmigoFromHTML(userEmail, amigoEmail) {
    let amigoHtml = document.getElementById(userEmail + amigoEmail);
    amigoHtml.parentNode.removeChild(amigoHtml);
    location.reload();
}

function removerAmigo(email_amigo) {
    const infoAmigo = {
        userEmail: CURRENT_USER_EMAIL,
        amigoEmail: email_amigo
    };
    const formData = new FormData();

    Object
        .keys(infoAmigo)
        .forEach(key => formData.append(key, infoAmigo[key]))
    ;

    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            removeAmigoFromHTML(infoAmigo.userEmail, infoAmigo.amigoEmail);
        }
    };

    xmlHttpRequest.open("POST", DELETE_AMIGO_URL, false);
    xmlHttpRequest.send(formData);
}

function findFriendDataByFriendEmail(email_amigo) {
    let amigoData;
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            amigoData = JSON.parse(this.responseText);
        }
    };

    const friendDataObject = {
        methodName: "findUserByEmail",
        methodParameters: email_amigo
    };
    const body = buildBody(friendDataObject);

    xmlHttpRequest.open("POST", METHOD_UTIL_PHP_URL, false);
    xmlHttpRequest.send(body);
    return amigoData;
}

function findFriendsByUserEmail() {
    let amigoOutput;
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
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
 * @param data
 * @returns {FormData}
 */
function buildBody(data) {
    const formData = new FormData();

    Object
        .keys(data)
        .forEach(key => formData.append(key, data[key]));

    return formData;
}

function redirect(path) {
    window.location.pathname = path;
}

/**
 * A
 * @returns {boolean}
 */
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

BUTTON_PERFIL.addEventListener("click", () => redirect(`${HOSTNAME}/components/perfil/perfil.html`));
BUTTON_HOME.addEventListener("click", () => redirect(`${HOSTNAME}/components/home/home.html`));
