const BUTTON_PERFIL = document.querySelector("#perfilButton");
const BUTTON_AMIGOS = document.querySelector("#amigoButton");

BUTTON_PERFIL.addEventListener("click", () => redirect("/site-programacao-web/components/perfil/perfil.html"));
BUTTON_AMIGOS.addEventListener("click", () => redirect("/site-programacao-web/components/amigo/amigo.html"));

function redirect(path) {
    window.location.pathname = path;
} 