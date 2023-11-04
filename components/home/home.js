const perfilButton = document.querySelector("#perfilButton");

perfilButton.addEventListener("click", () => perfilRedirect());

function perfilRedirect() {
    window.location.pathname = "/site-programacao-web/components/pefil/perfil.html";
}