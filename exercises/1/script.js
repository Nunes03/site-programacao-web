function validarCampo() {
  let inputs = document.querySelectorAll("input");
  console.log(inputs);

  let results = Array.from(inputs).filter((input) => input.value === "");

  if (results != 0) {
    window.alert("Alguns dos campos estão fazios");
  }
}
