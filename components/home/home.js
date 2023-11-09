const perfilButton = document.querySelector("#perfilButton");

perfilButton.addEventListener("click", () => redirectProfile());

for (let i = 0; i < 2; i++) {
    // createTrInPostTable();
}

function redirectProfile() {
    window.location.pathname = "/site-programacao-web/components/perfil/perfil.html";
}

function createTrInPostTable() {
    const tablePosts = document.querySelector("#tablePosts");

    const tr = document.createElement("tr");

    const td = document.createElement("td");
    const divPostContainer = createDivPostContainer();
    td.appendChild(divPostContainer);

    tr.appendChild(td);
    tablePosts.appendChild(tr);
}

function createDivPostContainer() {
    const div = document.createElement("div");
    div.className = "post-container";

    const userMock = {name: "Lucas", lastName: "Nunes"}

    const divPostHeaderContainer = createDivPostHeaderContainer(userMock);
    const divPostDate = createDivPostDate(userMock);
    const divPostContent = createDivPostContent(userMock);
    const divPostImage = createDivPostImage(userMock);
    const divPostButton = createDivPostButton(userMock);

    div.appendChild(divPostHeaderContainer);
    div.appendChild(divPostDate);
    div.appendChild(divPostContent);
    div.appendChild(divPostImage);
    div.appendChild(divPostButton);

    return div;
}

function createDivPostHeaderContainer(user) {
    const div = document.createElement("div");
    div.className = "post-header-container";

    const img = document.createElement("img");
    img.alt = "Foto de Perfil";
    img.className = "post-user-profile-photo";
    img.src = "../../assets/fotoPerfil.jpg";//buildPathProfilePhoto() + user.photoFileName;

    let fullName = user.name;
    if (user.lastName != null) {
        fullName = fullName + " " + user.lastName;
    }

    const span = document.createElement("span");
    span.className = "user-name-post";
    span.textContent = fullName;//fullName

    div.appendChild(img);
    div.appendChild(span);

    return div;
}

function createDivPostDate(user) {
    const div = document.createElement("div");
    div.className = "post-date";

    const span = document.createElement("span");
    span.className = "date-posting";
    span.textContent = "Postado: 15/10/2023"//user.birthday

    div.appendChild(span);

    return div;
}

function createDivPostContent(post) {
    const div = document.createElement("div");
    div.className = "post-content";

    const span = document.createElement("span");
    span.textContent = "Olá, primeira postagem!!"//post.content

    div.appendChild(span);

    return div;
}

function createDivPostImage(post) {
    const div = document.createElement("div");
    div.className = "post-image";

    const img = document.createElement("img");
    img.alt = "Imagem";
    img.className = "postagem-dados-foto";
    img.src = "../../assets/emptyPicture.png";//buildPathPostPhoto() + post.file_name;

    div.appendChild(img);

    return div;
}

function createDivPostButton(post) {
    const div = document.createElement("div");
    div.className = "post-button";

    const img = document.createElement("img");
    img.alt = "Curtir";
    img.className = "botao-curtir-imagem";
    img.src = "../../assets/gostar.png";

    const button = document.createElement("button");
    button.className = "like-button";

    button.appendChild(img);

    div.appendChild(button);

    return div;
}

function buildPathProfilePhoto() {
    const user = JSON.parse(localStorage.getItem("user"));
    const folderName = user
        .email
        .replace("@", "_")
        .replace(".", "_")
    ;

    return `../../src/UserFile/Profile/${folderName}/`;
}

function buildPathPostPhoto() {
    const user = JSON.parse(localStorage.getItem("user"));
    const folderName = user
        .email
        .replace("@", "_")
        .replace(".", "_")
    ;

    return `../../src/UserFile/Post/${folderName}/`;
}