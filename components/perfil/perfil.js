const idUser = window.sessionStorage?.user?.id  || 1;
var usuario = getUserByIdPhp(idUser);
desabilitarCampos(true);
esconderBotoes(true);


document.getElementById('buttonEdit').onclick = () => {
    desabilitarCampos(false);
    esconderBotoes(false);
}
document.getElementById('buttonSave').onclick = () => { 
    if(validateEmptyFields()) {
    desabilitarCampos(true); 
    esconderBotoes(true); 
    salvarAlteracao();
    preencherDadosUsuario();
    saveChangesPhp() 
    }
}
document.getElementById('buttonCancel').onclick = () => { 
    desabilitarCampos(true); 
    esconderBotoes(true); 
    preencherDadosUsuario(); 
}
document.getElementById('buttonBack').onclick = () => { 
    console.log(window.location)
    window.location.pathname = "/C:/Users/Aluno/Desktop/site-programacao-web-marcelo/components/home/home.html";
}

document.getElementById('filePhoto').onchange = () => { 
    Checkfiles(); 
}

function preencherDadosUsuario() {
    document.getElementById('name').value = usuario.name;
    document.getElementById('lastName').value = usuario.lastName;
    document.getElementById('fullName').innerText = usuario.name + ' ' + usuario.lastName;
    document.getElementById('birthday').value = usuario.birthday;
    document.getElementById('status').value = usuario.status;

    if (!!usuario.foto)
        document.getElementById('userPhoto').src = usuario.foto;  
    else
        document.getElementById('userPhoto').src = "../../assets/emptyPicture.jpg";

}

// function buscaDadosUsuario() {
//     return {
//         nome: 'marcelo',
//         sobrenome: 'schaefer',
//         nascimento: '2003-02-17',
//         status: 'ok',
//         foto: '',
//     };
// }

function salvarAlteracao() {
    usuario.name = document.getElementById('name').value;
    usuario.lastName = document.getElementById('lastName').value;
    usuario.birthday = document.getElementById('birthday').value;
    usuario.status = document.getElementById('status').value;
    usuario.userPhoto = document.getElementById('userPhoto').src;
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

function Checkfiles(){
    const fup = document.getElementById('filePhoto');
    const file = fup.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('userPhoto').src = e.target.result;
            document.getElementById('userPhoto').style.maxWidth = "400px";
            document.getElementById('userPhoto').style.maxHeight  = "300px";
        };
        reader.readAsDataURL(file);
    }
}

function value() {
    return usuario;
}

function validateEmptyFields() {
    const inputFields = document.querySelectorAll("input");

    const amountEmptyFields = Array
        .from(inputFields)
        .filter(inputField => (inputField.value == null || inputField.value === "") && inputField.id != 'filePhoto')
        .length
    ;

    if (amountEmptyFields !== 0) {
        alert("Existem campos vazios");

        return false;
    }

    return true;
}

function getUserByIdPhp(idUser) {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            usuario = base64ToObject(this.responseText);
            console.log(usuario)
            preencherDadosUsuario();
        }
    };

    const url = buildCreateAccountUrl({idUser, action: 'get'});
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