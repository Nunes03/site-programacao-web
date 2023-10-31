var usuario;
getUserByEmailPhp();
desabilitarCampos(true);
esconderBotoes(true);

document.querySelector('#buttonEdit').onclick = () => {
    desabilitarCampos(false);
    esconderBotoes(false);
}
document.querySelector('#buttonSave').onclick = () => {
    if (validateEmptyFields()) {
        desabilitarCampos(true);
        esconderBotoes(true);
        salvarAlteracao();
        preencherDadosUsuario();
        saveChangesPhp()
    }
}
document.querySelector('#buttonCancel').onclick = () => {
    desabilitarCampos(true);
    esconderBotoes(true);
    preencherDadosUsuario();
}
document.querySelector('#buttonBack').onclick = () => {
    window.location.pathname = "/site-programacao-web/components/home/home.html";
}

document.querySelector('#filePhoto').onchange = () => {
    checkFiles();
}

function preencherDadosUsuario() {
    document.querySelector('#name').value = usuario.name;
    document.querySelector('#lastName').value = usuario.lastName;
    document.querySelector('#fullName').innerText = usuario.name + ' ' + usuario.lastName;
    document.querySelector('#birthday').value = usuario.birthday;
    document.querySelector('#status').value = usuario.status;

    if (usuario.photo) {
        document.querySelector('#photo').src = usuario.photo;
    } else {
        document.querySelector('#photo').src = "../../assets/emptyPicture.jpg";
    }

}

function salvarAlteracao() {
    usuario.name = document.getElementById('name').value;
    usuario.lastName = document.getElementById('lastName').value;
    usuario.birthday = document.getElementById('birthday').value;
    usuario.status = document.getElementById('status').value;

    const reader = new FileReader();
    reader.onload = function (progressEvent) {
        usuario.photo = progressEvent.target.result;
    };

    const imagem = document.querySelector("#filePhoto").files[0];
    reader.readAsDataURL(imagem);
}

function esconderBotoes(esconder) {
    document.getElementById('buttonSave').hidden = esconder;
    document.getElementById('buttonCancel').hidden = esconder;
    document.getElementById('filePhoto').hidden = esconder;
    document.getElementById('buttonEdit').hidden = !esconder;
    document.getElementById('buttonBack').hidden = !esconder;
}

function desabilitarCampos(desabilitar) {
    document.getElementById('name').disabled = desabilitar;
    document.getElementById('lastName').disabled = desabilitar;
    document.getElementById('fullName').disabled = desabilitar;
    document.getElementById('birthday').disabled = desabilitar;
    document.getElementById('status').disabled = desabilitar;
}

function checkFiles() {
    const fup = document.getElementById('filePhoto');
    const file = fup.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (progressEvent) {
            document.getElementById('photo').src = progressEvent.target.result;
            document.getElementById('photo').style.maxWidth = "400px";
            document.getElementById('photo').style.maxHeight = "300px";
        };
        reader.readAsDataURL(file);
    }
}

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
            usuario = base64ToObject(this.responseText);
            preencherDadosUsuario();
        }
    };

    const url = buildCreateAccountUrl({email: user.email, action: 'get'});
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function saveChangesPhp() {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            base64ToObject(this.responseText);
        }
    };

    usuario.action = 'save';
    const url = buildCreateAccountUrl(usuario);
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function buildCreateAccountUrl(data) {
    const base64Object = objectToBase64(data);

    return `perfil.php?data=${base64Object}`;
}

function objectToBase64(object) {
    const objectJson = JSON.stringify(object);

    return stringToBase64(objectJson);
}

function base64ToObject(base64) {
    const string = base64ToString(base64);
    return JSON.parse(string);
}

function stringToBase64(value) {
    return btoa(value);
}

function base64ToString(value) {
    return atob(value);
}