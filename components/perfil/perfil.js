const userInput = {
    name: "",
    lastName: "",
    birthday: "",
    status: "",
    photoFileName: "",
    photoFileContent: new Blob(),
    email: ""
};

var userOutput = {
    name: "",
    lastName: "",
    birthday: "",
    status: "",
    photoFileName: "",
    email: ""
}

const PROFILE_PHP_URL = "perfil.php";
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const USER_DEFAULT_PROFILE_PHOTO = "../../assets/fotoPerfil.jpg";

getUserByEmailPhp(true);
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
        updateUser().then(
            value => {
                populateUserDatas();
                saveUserPhp();
            }
        );
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
    const lastName = userOutput.lastName == null
        ? ""
        : userOutput.lastName
    ;

    document.querySelector('#name').value = userOutput.name;
    document.querySelector('#lastName').value = lastName;
    document.querySelector('#fullName').innerText = userOutput.name + " " + lastName;
    document.querySelector('#birthday').value = userOutput.birthday;
    document.querySelector('#status').value = userOutput.status;

    if (userOutput?.photoFileName) {
        const localStorageEmail = getEmailByLocalStorage()
            .replaceAll("@", "_")
            .replaceAll(".", "_")
        ;

        document.querySelector('#photo').src = "../../src/UserFile/Profile/"
            + localStorageEmail
            + "/"
            + userOutput.photoFileName
        ;
    } else {
        document.querySelector('#photo').src = USER_DEFAULT_PROFILE_PHOTO;
    }
}

async function updateUser() {
    userInput.name = document.querySelector('#name').value;
    userInput.lastName = document.querySelector('#lastName').value;
    userInput.birthday = document.querySelector('#birthday').value;
    userInput.status = document.querySelector('#status').value;
    userInput.email = getEmailByLocalStorage();

    const image = document.querySelector("#photo");
    if (image.src !== null && image.src !== USER_DEFAULT_PROFILE_PHOTO) {
        const fup = document.querySelector('#filePhoto');
        const file = fup.files[0];

        if (file != null) {
            const reader = new FileReader();

            reader.onload = function (progressEvent) {
                const photoInput = document.querySelector('#photo');
                userInput.photoFileName = file.name;
                photoInput.src = progressEvent.target.result;
                photoInput.style.maxWidth = "400px";
                photoInput.style.maxHeight = "300px";
            };

            reader.readAsDataURL(file);//CONTINUAR AQUI
        }

        userInput.photoFileName
        userInput.photoFileContent = await fetch(image.src).then(response => response.blob());
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
            userInput.photoFileName = file.name;
            photoInput.src = progressEvent.target.result;
            photoInput.style.maxWidth = "400px";
            photoInput.style.maxHeight = "300px";
        };

        reader.readAsDataURL(file);
    }
}

/**
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

/**
 *
 * @param populationUser boolean
 */
function getUserByEmailPhp(populationUser) {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            userOutput = JSON.parse(this.responseText);

            if (populationUser) {
                populateUserDatas();
            }
        }
    };

    const getUserByEmailObject = {
        methodName: "findUserByEmail",
        methodParameters: [getEmailByLocalStorage()]
    };
    const body = buildBody(getUserByEmailObject);

    xmlHttpRequest.open("POST", METHOD_UTIL_PHP_URL, true);
    xmlHttpRequest.send(body);
}

function saveUserPhp() {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const response = JSON.parse(this.responseText);
        }
    };

    console.log("User Input: ", userInput)
    const body = buildBody(userInput);

    xmlHttpRequest.open("POST", PROFILE_PHP_URL, true);
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
