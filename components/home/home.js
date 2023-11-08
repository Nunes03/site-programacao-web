const perfilButton = document.querySelector("#perfilButton");

perfilButton.addEventListener("click", () => redirectProfile());

for (let i = 0; i < 10; i++) {

}

function redirectProfile() {
    window.location.pathname = "/site-programacao-web/components/perfil/perfil.html";
}

function createDivPostContainer() {
    const div = document.createElement("div");
    div.class = "post-container";
}

function createDivPostHeaderContainer(user) {
    const div = document.createElement("div");
    div.class = "post-header-container";
    
    const img = document.createElement("img");
    img.alt = "Foto de Perfil";
    img.class = "post-user-profile-photo";
    img.src = "../../assets/fotoPerfil.jpg";//buildPathProfilePhoto() + user.photoFileName;
    
    const fullName = user.name;
    if (user.lastName != null) {
        fullName = fullName + " " + user.lastName;
    }

    const span = document.createElement("span");
    span.class = "user-name-post";
    span.value = "UsuarioFulano";//fullName

    div.appendChild(img);
    div.appendChild(span);

    return div;
}

function createDivPostDate(user) {
    const div = document.createElement("div");
    div.class = "post-date";

    const span = document.createElement("span");
    span.class = "date-posting";
    span.value = "Postado: 15/10/2023"//user.birthday

    div.appendChild(span);

    return div;
}

function createDivPostContent(post) {
    const div = document.createElement("div");
    div.class = "post-content";

    const span = document.createElement("span");
    span.value = "Olá, primeira postagem!!"//post.content

    div.appendChild(span);

    return div;
}

function createDivPostImage(post) {
    const div = document.createElement("div");
    div.class = "post-image";

    const img = document.createElement("img");
    img.alt = "Imagem";
    img.class = "postagem-dados-foto";
    img.src = "../../assets/emptyPicture.png";//buildPathPostPhoto() + post.file_name;

    div.appendChild(img);

    return div;
}

function createDivPostButton(post) {
    const div = document.createElement("div");
    div.class = "post-button";

    const img = document.createElement("img");
    img.alt = "Curtir";
    img.class = "botao-curtir-imagem";
    img.src = "../../assets/gostar.png";

    const button = document.createElement("button");
    button.class = "like-button";

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