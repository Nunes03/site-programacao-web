var usuario = buscaDadosUsuario();
preencherDadosUsuario();
desabilitarCampos(true);
esconderBotoes(true);


document.getElementById('buttonEdit').onclick = () => {
    desabilitarCampos(false);
    esconderBotoes(false);
}
document.getElementById('buttonSave').onclick = () => { 
    desabilitarCampos(true); 
    esconderBotoes(true); 
    salvarAlteracao();
    preencherDadosUsuario(); 
}
document.getElementById('buttonCancel').onclick = () => { 
    desabilitarCampos(true); 
    esconderBotoes(true); 
    preencherDadosUsuario(); 
}



function preencherDadosUsuario() {
    document.getElementById('name').value = usuario.nome;
    document.getElementById('lastName').value = usuario.sobrenome;
    document.getElementById('fullName').innerText = usuario.nome + ' ' + usuario.sobrenome;
    document.getElementById('birth').value = usuario.nascimento;
    document.getElementById('status').value = usuario.status;

    if (!!usuario.foto)
        document.getElementById('userPhoto').src = 'data:image/bmp;base64,' + Base64.encode(usuario.foto);
    else
        document.getElementById('userPhoto').src = "../../assets/emptyPicture.jpg";

}

function buscaDadosUsuario() {
    return {
        nome: 'marcelo',
        sobrenome: 'schaefer',
        nascimento: '2003-02-17',
        status: 'ok',
        foto: '',
    };
}

function salvarAlteracao() {
    usuario.nome = document.getElementById('name').value;
    usuario.sobrenome = document.getElementById('lastName').value;
    usuario.nascimento = document.getElementById('birth').value;
    usuario.status = document.getElementById('status').value;
}

function esconderBotoes(esconder) {
    document.getElementById('buttonSave').hidden = esconder;
    document.getElementById('buttonCancel').hidden = esconder;
    document.getElementById('buttonEdit').hidden = !esconder;

}

function desabilitarCampos(desabilitar) {
    document.getElementById('name').disabled = desabilitar;
    document.getElementById('lastName').disabled = desabilitar;
    document.getElementById('fullName').disabled = desabilitar;
    document.getElementById('birth').disabled = desabilitar;
    document.getElementById('status').disabled = desabilitar;
}

function value() {
    return usuario;
}