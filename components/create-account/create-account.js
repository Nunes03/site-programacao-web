const confirmPassword = document.getElementById("confirm-password");

confirmPassword.addEventListener("input", () => validatePassword());

function validatePassword() {
  const password = document.getElementById("password");
  const messageValidation = document.getElementById("message-validation");

  if (password.value !== confirmPassword.value) {
    messageValidation.innerHTML = "Senhas não conferem";
  } else {
    messageValidation.innerHTML = "";
  }
}
