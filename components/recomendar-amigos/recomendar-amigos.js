const ELEMENTO_BOTAO_ADICIONAR = document.getElementById("botaoAdicionar");
const ELEMENTO_BOTAO_PROXIMO = document.getElementById("botaoProximo");
const ELEMENTO_AMIGO_NOME = document.getElementById("amigoNome");
const ELEMENTO_AMIGO_IMAGEM = document.getElementById("amigoImagem");
const ELEMENTO_SPAN_AVISO = document.querySelector("#aviso");
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const CURRENT_USER_EMAIL = getEmailByLocalStorage();
const PROFILE_PHOTO_PATH = "../../src/UserFile/Profile/";
const USER_DEFAULT_PROFILE_PHOTO = "../../assets/fotoPerfil.jpg";
const ADD_AMIGO_URL = "adicionar-amigo.php"

suggestedFriendEmail = "";
populateData();

ELEMENTO_BOTAO_PROXIMO.addEventListener("click", function () {
    ELEMENTO_AMIGO_NOME.innerText = "";
    ELEMENTO_AMIGO_IMAGEM.src = USER_DEFAULT_PROFILE_PHOTO;
    populateData();
});

ELEMENTO_BOTAO_ADICIONAR.addEventListener("click", function () {
    adicionarAmigo(suggestedFriendEmail);
    populateData();
});

function populateData() {
    let suggestedFriend = findRandonPersonToRecomendate();

    if (suggestedFriend === null) {
        ELEMENTO_SPAN_AVISO.style.display = "";
        ELEMENTO_AMIGO_IMAGEM.style.visibility = "hidden";
        ELEMENTO_AMIGO_NOME.style.visibility = "hidden";
        ELEMENTO_BOTAO_ADICIONAR.style.visibility = "hidden";
    } else {
        ELEMENTO_SPAN_AVISO.style.display = "none";
        ELEMENTO_AMIGO_IMAGEM.style.visibility = "visible";
        ELEMENTO_AMIGO_NOME.style.visibility = "visible";
        ELEMENTO_BOTAO_ADICIONAR.style.visibility = "visible";
        suggestedFriendEmail = suggestedFriend.email;

        let textNomeAmigo = document.createTextNode(suggestedFriend.name.toString() + " " + suggestedFriend.lastName.toString());
        ELEMENTO_AMIGO_NOME.appendChild(textNomeAmigo);

        let profilePhotoPath;
        if (suggestedFriend.photoFileName != null) {
            const profilePhotoPathByEmail = suggestedFriend.email
                .replaceAll("@", "_")
                .replaceAll(".", "_")
            ;

            profilePhotoPath = `${PROFILE_PHOTO_PATH}${profilePhotoPathByEmail}/${suggestedFriend.photoFileName}`;
        } else {
            profilePhotoPath = USER_DEFAULT_PROFILE_PHOTO;
        }

        ELEMENTO_AMIGO_IMAGEM.src = profilePhotoPath;
    }
}

function adicionarAmigo(emailAmigo) {
    const infoAmigo = {
        userEmail: CURRENT_USER_EMAIL,
        amigoEmail: emailAmigo
    };
    const formData = new FormData();

    Object
        .keys(infoAmigo)
        .forEach(key => formData.append(key, infoAmigo[key]))
    ;

    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            location.reload();
        }
    };

    xmlHttpRequest.open("POST", ADD_AMIGO_URL, false);
    xmlHttpRequest.send(formData);
}

function findRandonPersonToRecomendate() {
    let amigoOutput;
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            amigoOutput = JSON.parse(this.responseText);
        }
    };

    const getRandomPerson = {
        methodName: "getRandomUser",
        methodParameters: [CURRENT_USER_EMAIL]
    };

    const body = buildBody(getRandomPerson);

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

/**
 *
 * @returns {string}
 */
function getEmailByLocalStorage() {
    const userJson = localStorage.getItem("user");
    return JSON.parse(userJson).email;
}