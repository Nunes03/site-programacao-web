const perfilButton = document.querySelector("#perfilButton");

perfilButton.addEventListener("click", () => redirectProfile());

function redirectProfile() {
    window.location.pathname = "/site-programacao-web/components/perfil/perfil.html";
}