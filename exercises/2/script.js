const pesoPrimeiro = 1.5;
const pesoSegundo = 2;
const pesoTerceiro = 2.5;
const pesoQuarto = 3;
const somaTodosPesos = pesoPrimeiro + pesoSegundo + pesoTerceiro + pesoQuarto;

function exibirMedia() {
  const primeiroBimestre = document.getElementById("primeiroBimestre");
  const segundoBimestre = document.getElementById("segundoBimestre");
  const terceiroBimestre = document.getElementById("terceiroBimestre");
  const quartoBimestre = document.getElementById("quartoBimestre");

  const mediaPrimeiro = calcularMedia(primeiroBimestre);
  const mediaSegundo = calcularMedia(segundoBimestre);
  const mediaTerceiro = calcularMedia(terceiroBimestre);
  const mediaQuarto = calcularMedia(quartoBimestre);

  const mediaPonderadaPrimeiro = mediaPrimeiro * pesoPrimeiro / somaTodosPesos;
  const mediaPonderadaSegundo = mediaSegundo * pesoSegundo / somaTodosPesos;
  const mediaPonderadaTerceiro = mediaTerceiro * pesoTerceiro / somaTodosPesos;
  const mediaPonderadaQuarto = mediaQuarto * pesoQuarto / somaTodosPesos;

  let mensagem =
    `Média Aritmética 1° Bimestre: ${mediaPrimeiro}` +
    `\nMédia Aritmética 2° Bimestre: ${mediaSegundo}` +
    `\nMédia Aritmética 3° Bimestre: ${mediaTerceiro}` +
    `\nMédia Aritmética 4° Bimestre: ${mediaQuarto} \n` +

    `\nMédia Ponderada 1° Bimestre: ${mediaPonderadaPrimeiro}` +
    `\nMédia Ponderada 2° Bimestre: ${mediaPonderadaSegundo}` +
    `\nMédia Ponderada 3° Bimestre: ${mediaPonderadaTerceiro}` +
    `\nMédia Ponderada 4° Bimestre: ${mediaPonderadaQuarto}`;

  window.alert(mensagem);
}

function calcularMedia(div) {
  const inputs = div.querySelectorAll("input");

  const notas = Array.from(inputs).map((input) => input.value);

  let soma = 0;
  for (indice in notas) {
    let nota = notas[indice];
    nota = nota === "" ? 0 : nota;
    soma += parseFloat(nota);
  }

  return soma / notas.length;
}
