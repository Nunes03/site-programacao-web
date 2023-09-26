const createAccountButton = document.querySelector("#createAccount");
const viewPasswordButton = document.querySelector("#viewPassword");

createAccountButton.addEventListener("click", () => validatePassword());
viewPasswordButton.addEventListener("click", () => viewPassword());

function validatePassword() {
  const password = document.querySelector("#password");
  const confirmPassword = document.querySelector("#confirmPassword");

  if (password.value !== confirmPassword.value) {
    window.alert("Senhas não conferem");
  }
}

function viewPassword() {
  const password = document.querySelector("#password");
  const confirmPassword = document.querySelector("#confirmPassword");

  if (password.type == "password") {
    password.type = "text";
    confirmPassword.type = "text";
  } else {
    password.type = "password";
    confirmPassword.type = "password";
  }
}
