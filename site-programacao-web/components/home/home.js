const perfilButton = document.querySelector("#perfilButton");
const GET_POSTS_BY_USER_URL = "get-posts-by-user.php";
const GET_POSTS_BY_USER_SELECTED = "get-posts-by-user-selected";

perfilButton.addEventListener("click", () => redirectProfile());
document.querySelector("#nomePesquisa").addEventListener("change", () => getPostsByUserSelected(document.querySelector("#nomePesquisa").value));

const posts = getPostsByUserInPhp();
posts.forEach((post) => addDivInDivPosts(post));

function getPostsByUserInPhp() {
    const xmlHttpRequest = new XMLHttpRequest();
    let postsFound = [];

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            postsFound = JSON.parse(this.responseText);
        }
    };

    const user = getUserByLocalStorage();
    const body = buildBodyParameter(user);

    xmlHttpRequest.open("POST", GET_POSTS_BY_USER_URL, false);
    xmlHttpRequest.send(body);

    return postsFound;
}

function getUserByLocalStorage() {
    const userJson = localStorage.getItem("user");

    return JSON.parse(userJson);
}

/** 
 *
 * @returns {FormData}
 */
function buildBodyParameter(user) {
    const formData = new FormData();
    Object
        .keys(user)
        .forEach(key => formData.append(key, user[key]))
    ;

    return formData;
}

function redirectProfile() {
    window.location.pathname =
        "/site-programacao-web/components/perfil/perfil.html";
}

function addDivInDivPosts(post) {
    const divPosts = document.querySelector("#posts");
    const divPostContainer = createDivPostContainer(post);

    divPosts.appendChild(divPostContainer);
}

function createDivPostContainer(post) {
    const div = document.createElement("div");
    div.className = "post-container";

    const divSeparatorContent = createDivSeparatorContent(post);
    const divPostContent = createDivPostContent(post);
    const divPostImage = createDivPostImage(post);
    const divPostButton = createDivPostButton(post);

    div.appendChild(divSeparatorContent);
    div.appendChild(divPostContent);
    div.appendChild(divPostImage);
    div.appendChild(divPostButton);

    return div;
}

/**
 *
 * @param post
 * @returns {HTMLDivElement}
 */
function createDivSeparatorContent(post) {
    const div = document.createElement("div");
    div.className = "separator-content";

    const divPostHeaderContainer = createDivPostHeaderContainer(post);
    const divPostDate = createDivPostDate(post);

    div.appendChild(divPostHeaderContainer);
    div.appendChild(divPostDate);

    return div;
}

/**
 *
 * @param post
 * @returns {HTMLDivElement}
 */
function createDivPostHeaderContainer(post) {
    const div = document.createElement("div");
    div.className = "post-header-container";

    const img = document.createElement("img");
    img.alt = "Foto de Perfil";
    img.className = "post-user-profile-photo";
    img.src = buildPathProfilePhoto(post);

    let fullName = post.user.name;
    if (post.user.lastName != null) {
        fullName = fullName + " " + post.user.lastName;
    }

    const span = document.createElement("span");
    span.className = "user-name-post";
    span.textContent = fullName;

    div.appendChild(img);
    div.appendChild(span);

    return div;
}

/**
 *
 * @param post
 * @returns {HTMLDivElement}
 */
function createDivPostDate(post) {
    const div = document.createElement("div");
    div.className = "post-date";

    const span = document.createElement("span");
    span.className = "date-posting";
    span.textContent = `Postado: ${post.date}`;

    div.appendChild(span);

    return div;
}

/**
 *
 * @param post
 * @returns {HTMLDivElement}
 */
function createDivPostContent(post) {
    const div = document.createElement("div");
    div.className = "post-content";

    const span = document.createElement("span");
    span.textContent = post.content;

    div.appendChild(span);

    return div;
}

/**
 *
 * @param post
 * @returns {HTMLDivElement}
 */
function createDivPostImage(post) {
    const div = document.createElement("div");
    div.className = "post-image";

    const img = document.createElement("img");
    img.alt = "Imagem";
    img.className = "postagem-dados-foto";
    img.src = buildPathPostPhoto(post);

    div.appendChild(img);

    return div;
}

/**
 *
 * @returns {HTMLDivElement}
 */
function createDivPostButton() {
    const div = document.createElement("div");
    div.className = "post-button";

    const img = document.createElement("img");
    img.alt = "Curtir";
    img.className = "botao-curtir-imagem";
    img.src = "../../assets/like.png";

    const button = document.createElement("button");
    button.className = "like-button";

    button.appendChild(img);

    div.appendChild(button);

    return div;
}

/**
 *
 * @param post
 * @returns {string}
 */
function buildPathProfilePhoto(post) {
    const folderName = post.user.email.replace("@", "_").replace(".", "_");
    return `../../src/UserFile/Profile/${folderName}/${post.user.photoFileName}`;
}

/**
 *
 * @param post
 * @returns {string}
 */
function buildPathPostPhoto(post) {
    const folderName = post.user.email.replace("@", "_").replace(".", "_");
    return `../../src/UserFile/Post/${folderName}/${post.fileName}`;
}
// const perfilButton = document.querySelector("#perfilButton");
const botoaPesquisa = document.querySelector('#botaoPesquisar');

// perfilButton.addEventListener("click", () => perfilRedirect());
botoaPesquisa.addEventListener("click", () => buscarPessoas());

this.buscarPessoas();


function perfilRedirect() {
    window.location.pathname = "/site-programacao-web/components/pefil/perfil.html";
}

function limparListaPessoas() {
    document.querySelector('#listaPessoas').querySelectorAll('option').forEach(option => {
        option.remove();
    });
}

function buscarPessoas() {
    this.limparListaPessoas();
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            const responseObject = JSON.parse(this.responseText);

            if (responseObject) {
                criaOpcoesSelecionarPessoa(responseObject);
            }
        }
    };

    const url = "get-user-by-name.php"
    const body = buildBodyByUserSearch();

    xmlHttpRequest.open("POST", url, true);
    xmlHttpRequest.send(body);
}

function criaOpcoesSelecionarPessoa(users) {
    if (!Array.isArray(users)) {
        users = [users];
    }

    users.forEach(user => {
        var pessoa = document.createElement('option');
        pessoa.innerText = user.email + ' - ' + user.name;
        pessoa.id = user.email;
        pessoa.addEventListener("onclick", () => 
            this.getPostsByUserSelected(pessoa.id)
        );

        pessoa.onclick = function() {
            this.getPostsByUserSelected(pessoa.id);
        }
        document.querySelector('#listaPessoas').appendChild(pessoa);
    });
}


/**
 *
 * @returns {FormData}
 */
function buildBodyByUserSearch() {
    const user = getUserObject();
    const formData = new FormData();

    Object
        .keys(user)
        .forEach(
            key => formData.append(key, user[key])
        )
        ;

    return formData;
}

/**
 *
 * @returns {{password: string, email: string}}
 */
function getUserObject() {
    const name = document.querySelector("#nomePesquisa").value;

    return {
        name: name
    }
}

function getPostsByUserSelected(email) {
    if(email){
        email = email.split(' - ',)[0];

    const xmlHttpRequest = new XMLHttpRequest();
    let postsFound = [];

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            postsFound = JSON.parse(this.responseText);
        }
    };

    const body = buildBodyParameter({email: email});

    xmlHttpRequest.open("POST", GET_POSTS_BY_USER_SELECTED, false);
    xmlHttpRequest.send(body);

    return postsFound;
    }
}


