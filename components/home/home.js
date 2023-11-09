const perfilButton = document.querySelector("#perfilButton");

perfilButton.addEventListener("click", () => redirectProfile());

const posts = getPostsByUser();
console.log(posts);
posts.forEach((post) => addDivInDivPosts(post));

function getPostsByUser() {
  const xmlHttpRequest = new XMLHttpRequest();
  let postsFound = [];

  xmlHttpRequest.onreadystatechange = function () {
    if (this.readyState === 4) {
      postsFound = JSON.parse(this.responseText);
    }
  };

  const url = "get-posts-by-user.php";
  const user = getUserByLocalStorage();
  const body = buildBody(user);

  xmlHttpRequest.open("POST", url, false);
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
        .forEach(
            key => formData.append(key, user[key])
        )
    ;

    return formData;
}

function redirectProfile() {
  window.location.pathname =
    "/site-programacao-web/components/perfil/perfil.html";
}

function addDivInDivPosts(post) {
    console.log("Aqui 1: ", post);

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
  console.log("Aqui: ", post);
  img.src = buildPathProfilePhoto() + post.user.photoFileName;

  let fullName = post.name;
  if (post.lastName != null) {
    fullName = fullName + " " + post.lastName;
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
 * @param user
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
  img.src = buildPathPostPhoto() + post.fileName;

  div.appendChild(img);

  return div;
}

/**
 *
 * @param post
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

  button.appendChild(img);

  div.appendChild(button);

  return div;
}

/**
 *
 * @returns {string}
 */
function buildPathProfilePhoto() {
  const user = JSON.parse(localStorage.getItem("user"));
  const folderName = user.email.replace("@", "_").replace(".", "_");
  return `../../src/UserFile/Profile/${folderName}/`;
}

/**
 *
 * @returns {string}
 */
function buildPathPostPhoto() {
  const user = JSON.parse(localStorage.getItem("user"));
  const folderName = user.email.replace("@", "_").replace(".", "_");
  return `../../src/UserFile/Post/${folderName}/`;
}
