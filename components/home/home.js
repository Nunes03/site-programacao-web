const GET_POSTS_BY_USER_URL = "get-posts-by-user.php";
const CREATE_POST_URL = "create-post.php";
const ADD_LIKE_IN_POST_URL = "add-like-in-post.php";

const perfilButton = document.querySelector("#perfilButton");
const postButton = document.querySelector("#postButton");
const sigInButton = document.querySelector("#sigIn");
const amigosButton = document.querySelector("#amigosButton");

perfilButton.addEventListener("click", () => redirectProfile());
postButton.addEventListener("click", () => createPostInPhp());
amigosButton.addEventListener("click", () => redirectFriends())
sigInButton.addEventListener("click", () => redirectLogin());

updatePostsOnScreen();

const likeButtons = document.querySelectorAll(".like-button");
likeButtons.forEach(
    (button) => {
        button.addEventListener("click", () => addLike(button))
    }
);

function updatePostsOnScreen() {
    removeChildrenByTagId("posts");

    const posts = getPostsByUserInPhp();
    posts.forEach((post) => addDivInDivPosts(post));
}

/**
 *
 * @param tagId string
 */
function removeChildrenByTagId(tagId) {
    const tag = document.querySelector(`#${tagId}`);
    tag.innerHTML = "";
}

function getPostsByUserInPhp() {
    const xmlHttpRequest = new XMLHttpRequest();
    let postsFound = [];

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
            postsFound = JSON.parse(this.responseText);
        }
    };

    const user = getUserByLocalStorage();
    const body = buildBody(user);

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
function buildBody(user) {
    const formData = new FormData();

    Object
        .keys(user)
        .forEach(key => formData.append(key, user[key]))
    ;

    return formData;
}

function redirectProfile() {
    window.location.pathname = "/site-programacao-web/components/perfil/perfil.html";
}

function redirectFriends() {
    window.location.pathname = "/site-programacao-web/components/amigo/amigo.html";
}

function redirectLogin() {
    localStorage.removeItem("user");
    window.location.pathname = "/site-programacao-web/components/login/login.html";
}

function createPostInPhp() {
    if (validatePostFields()) {
        const xmlHttpRequest = new XMLHttpRequest();

        xmlHttpRequest.onreadystatechange = function () {
            if (this.readyState === 4) {
                updatePostsOnScreen();
            }
        };

        buildPostCreate();
    }
}

/**
 *
 * @returns boolean
 */
function validatePostFields() {
    const textAreaPost = document.querySelector("#textAreaPost");

    if (textAreaPost.value == null || textAreaPost.value.trim() === "") {
        window.alert("Para realizar uma postagem preencha o campo de conteúdo!");
        return false;
    }

    return true;
}

function buildPostCreate() {
    const newPost = {
        userEmail: "",
        content: "",
        imageName: "",
        imageContent: null
    };

    const imageFile = document.querySelector("#imagePost");

    if (imageFile.files.length !== 0) {
        const photoSelected = imageFile.files[0];
        newPost.imageName = photoSelected.name;

        const reader = new FileReader();
        reader.onload = function (progressEvent) {
            const formData = new FormData();

            newPost.imageContent = progressEvent.target.result;
            newPost.content = document.querySelector("#textAreaPost").value;
            newPost.userEmail = getUserByLocalStorage().email;

            Object
                .keys(newPost)
                .forEach(key => formData.append(key, newPost[key]))
            ;

            const xmlHttpRequest = new XMLHttpRequest();

            xmlHttpRequest.onreadystatechange = function () {
                if (this.readyState === 4) {
                    updatePostsOnScreen();
                }
            };

            xmlHttpRequest.open("POST", CREATE_POST_URL, false);
            xmlHttpRequest.send(formData);

            const textAreaPost = document.querySelector("#textAreaPost");
            textAreaPost.value = "";
        };

        reader.readAsDataURL(photoSelected);
    }
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
    const divPostButton = createDivPostButton(post);

    div.appendChild(divSeparatorContent);
    div.appendChild(divPostContent);

    if (post.fileName) {
        const divPostImage = createDivPostImage(post);
        div.appendChild(divPostImage);
    }

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
    img.src = post.user.photoFileName == null ?
        "/site-programacao-web/assets/emptyPicture.png"
        : buildPathProfilePhoto(post)
    ;

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
function createDivPostButton(post) {
    const div = document.createElement("div");
    div.className = "post-button";

    const img = document.createElement("img");
    img.alt = "Curtir";
    img.className = "botao-curtir-imagem";
    img.src = "../../assets/like.png";

    const button = document.createElement("button");
    button.className = "like-button";
    button.value = post.id;

    const span = document.createElement("span");
    span.className = "like-message";
    span.textContent = post.likes + " curtidas";
    span.accessKey = post.id;

    button.appendChild(img);

    div.appendChild(button);
    div.appendChild(span);

    return div;
}

function addLike(button) {
    const xmlHttpRequest = new XMLHttpRequest();

    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4) {
        }
    };

    const body = new FormData();
    body.append("postId", button.value)

    xmlHttpRequest.open("POST", ADD_LIKE_IN_POST_URL, true);
    xmlHttpRequest.send(body);

    const span = document.querySelector(`span[accesskey="${button.value}"]`);
    const textContentSpanSplit = span.textContent.split(" ");
    let newLikes = parseInt(textContentSpanSplit[0]) + 1;

    span.textContent = newLikes.toString().concat(" ").concat(textContentSpanSplit[1]);
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
