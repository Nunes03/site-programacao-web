/**
 *
 * @type {{birthday: string, lastName: string, name: string, photo: Blob, email: string, status: string}}
 */
var usuario = {
    name: "",
    lastName: "",
    birthday: "",
    status: "",
    photo: "",
    email: ""
};

const profilePhpUrl = "perfil.php";
const methodUtilPhpUrl = "../utils/method-util.php";

getUserByEmailPhp();
disableFields(true);
hiddenButons(true);

document.querySelector('#buttonEdit').onclick = () => {
    disableFields(false);
    hiddenButons(false);
}

document.querySelector('#buttonSave').onclick = () => {
    if (validateEmptyFields()) {
        disableFields(true);
        hiddenButons(true);
        updateUser()
            .then(
                value => {
                    populateUserDatas();
                    saveUserPhp();
                }
            )
        ;
    }
}

document.querySelector('#buttonCancel').onclick = () => {
    disableFields(true);
    hiddenButons(true);
    populateUserDatas();
}

document.querySelector('#buttonBack').onclick = () => {
    window.location.pathname = "/site-programacao-web/components/home/home.html";
}

document.querySelector('#filePhoto').onchange = () => {
    checkFiles();
}

function populateUserDatas() {
    document.querySelector('#name').value = usuario.name;
    document.querySelector('#lastName').value = usuario.lastName;
    document.querySelector('#fullName').innerText = usuario.name + ' ' + usuario.lastName;
    document.querySelector('#birthday').value = usuario.birthday;
    document.querySelector('#status').value = usuario.status;

    if (usuario?.photo) {
        document.querySelector('#photo').src = usuario.photo;
    } else {
        document.querySelector('#photo').src = "../../assets/emptyPicture.jpg";
    }
}

async function updateUser() {
    usuario.name = document.querySelector('#name').value;
    usuario.lastName = document.querySelector('#lastName').value;
    usuario.birthday = document.querySelector('#birthday').value;
    usuario.status = document.querySelector('#status').value;
    usuario.email = getEmailByLocalStorage();

    const imagem = document.querySelector("#photo");

    if (imagem?.src) {
        usuario.photo = await fetch(imagem.src).then(response => response.blob());
    }
}

function hiddenButons(hiddden) {
    document.querySelector('#buttonSave').hidden = hiddden;
    document.querySelector('#buttonCancel').hidden = hiddden;
    document.querySelector('#filePhoto').hidden = hiddden;
    document.querySelector('#buttonEdit').hidden = !hiddden;
    document.querySelector('#buttonBack').hidden = !hiddden;
}

function disableFields(disable) {
    document.querySelector('#name').disabled = disable;
    document.querySelector('#lastName').disabled = disable;
    document.querySelector('#fullName').disabled = disable;
    document.querySelector('#birthday').disabled = disable;
    document.querySelector('#status').disabled = disable;
}

function checkFiles() {
    const fup = document.querySelector('#filePhoto');
    const file = fup.files[0];

    if (file != null) {
        const reader = new FileReader();

        reader.onload = function (progressEvent) {
            const photoInput = document.querySelector('#photo');
            photoInput.src = progressEvent.target.result;
            photoInput.style.maxWidth = "400px";
            photoInput.style.maxHeight = "300px";
        };

        reader.readAsDataURL(file);
    }
}

/**
 *
 * @returns {boolean}
 */
function validateEmptyFields() {
    const inputFields = document.querySelectorAll("input");

    const amountEmptyFields = Array
        .from(inputFields)
        .filter(inputField => (inputField.value == null || inputField.value === "") && inputField.id !== 'filePhoto')
        .length
    ;

    if (amountEmptyFields !== 0) {
        alert("Existem campos vazios");

        return false;
    }

    return true;
}

function getUserByEmailPhp() {
    const userDataJson = localStorage.getItem("user");
    const user = JSON.parse(userDataJson);

    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            usuario = JSON.parse(this.responseText);
            populateUserDatas();
        }
    };

    const getUserByEmailObject = {
        methodName: "findUserByEmail",
        methodParameters: [user.email]
    };
    const body = buildBody(getUserByEmailObject);

    xmlHttpRequest.open("POST", methodUtilPhpUrl, true);
    xmlHttpRequest.send(body);
}

function saveUserPhp() {
    console.log(usuario)
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const response = JSON.parse(this.responseText);
        }
    };

    const body = buildBody(usuario);

    xmlHttpRequest.open("POST", profilePhpUrl, true);
    xmlHttpRequest.send(body);
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
