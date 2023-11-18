const PROFILE_PHP_URL = "perfil.php";
const METHOD_UTIL_PHP_URL = "../utils/method-util.php";
const USER_DEFAULT_PROFILE_PHOTO = "../../assets/fotoPerfil.jpg";
const PATH_TO_HOME = "/site-programacao-web/components/home/home.html";
const PROFILE_PHOTO_PATH = "../../src/UserFile/Profile/";

const buttonEdit = document.querySelector('#buttonEdit');
const buttonSave = document.querySelector('#buttonSave');
const buttonCancel = document.querySelector('#buttonCancel');
const buttonBack = document.querySelector('#buttonBack');
const inputFilePhoto = document.querySelector('#inputFilePhoto');

var alteredPhoto = false;

buttonEdit.addEventListener("click", () => edit());
buttonSave.addEventListener("click", () => save());
buttonCancel.addEventListener("click", () => cancel());
buttonBack.addEventListener("click", () => backToHome());
inputFilePhoto.addEventListener("change", () => updateFilePhoto());

populateUserData();
disableFields(true);
hiddenButons(true);

function edit() {
    disableFields(false);
    hiddenButons(false);
}

function save() {
    if (validateEmptyFields()) {
        disableFields(true);
        hiddenButons(true);
        updateUser();
    }
}

function cancel() {
    disableFields(true);
    hiddenButons(true);
    populateUserData();
}

function backToHome() {
    window.location.pathname = PATH_TO_HOME
}

function updateFilePhoto() {
    getFile();
}

function populateUserData() {
    const userOutput = findUserByEmailPhp();
    alteredPhoto = false;

    const lastName = userOutput.lastName == null
        ? ""
        : userOutput.lastName
    ;

    document.querySelector('#name').value = userOutput.name;
    document.querySelector('#lastName').value = lastName;
    document.querySelector('#fullName').innerText = userOutput.name + " " + lastName;
    document.querySelector('#birthday').value = userOutput.birthday;
    document.querySelector('#status').value = userOutput.status;

    let profilePhotoPath;
    if (userOutput.photoFileName != null) {
        const profilePhotoPathByEmail = getEmailByLocalStorage()
            .replaceAll("@", "_")
            .replaceAll(".", "_")
        ;

        profilePhotoPath = `${PROFILE_PHOTO_PATH}${profilePhotoPathByEmail}/${userOutput.photoFileName}`;
    } else {
        profilePhotoPath = USER_DEFAULT_PROFILE_PHOTO;
    }

    document.querySelector('#photo').src = profilePhotoPath;
}

function updateUser() {
    buildUserInput()
        .then(
            userInput => {
                saveUserPhp(userInput);
                populateUserData();
            }
        )
    ;
}

async function buildUserInput() {
    const userInput = {};

    userInput.name = document.querySelector('#name').value;
    userInput.lastName = document.querySelector('#lastName').value;
    userInput.birthday = document.querySelector('#birthday').value;
    userInput.status = document.querySelector('#status').value;
    userInput.email = getEmailByLocalStorage();
    userInput.alteredPhoto = alteredPhoto;

    if (alteredPhoto) {
        const fileInputPhoto = document.querySelector("#inputFilePhoto");
        const photoSelected = fileInputPhoto.files[0];
        userInput.photoFileName = photoSelected.name;

        const reader = new FileReader();
        reader.onload = function (progressEvent) {
            document.querySelector("#photo").src = progressEvent.target.result;
        };
        reader.readAsDataURL(photoSelected);

    }

    userInput.photoFileContent = await fetch(document.querySelector("#photo").src).then(response => response.blob());

    return userInput;
}

function hiddenButons(hiddden) {
    document.querySelector('#buttonSave').hidden = hiddden;
    document.querySelector('#buttonCancel').hidden = hiddden;
    document.querySelector('#inputFilePhoto').hidden = hiddden;
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

function getFile() {
    const inputFile = document.querySelector('#inputFilePhoto');
    const fileSelected = inputFile.files[0];

    if (fileSelected != null) {
        alteredPhoto = true;
        const reader = new FileReader();

        reader.onload = function (progressEvent) {
            document.querySelector('#photo').src = progressEvent.target.result
        };

        reader.readAsDataURL(fileSelected);
    }
}

/**
 * @returns {boolean}
 */
function validateEmptyFields() {
    const inputFields = document.querySelectorAll("input");

    const amountEmptyFields = Array
        .from(inputFields)
        .filter(inputField => (inputField.value == null || inputField.value === "") && inputField.id !== 'inputFilePhoto')
        .length
    ;

    if (amountEmptyFields !== 0) {
        alert("Existem campos vazios");

        return false;
    }

    return true;
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

function saveUserPhp(userInput) {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
    };

    const body = buildBody(userInput);

    xmlHttpRequest.open("POST", PROFILE_PHP_URL, false);
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
