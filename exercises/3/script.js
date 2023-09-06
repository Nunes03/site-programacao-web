const selectionTabuada = document.getElementById("valoresTabuada");
const body = document.querySelector("body");
var divTabuada = null;

selectionTabuada.onchange = () => construirTabuada();

setarValores();

function setarValores() {
  for (let valor = 1; valor <= 10; valor++) {
    let option = document.createElement("option");
    option.value = valor;
    option.innerHTML = valor;

    selectionTabuada.appendChild(option);
  }
}

function construirTabuada() {
  limparDivTabuada();

  let titulo = criarTituloTabuada();
  divTabuada.appendChild(titulo);

  let tabela = criarTabelaTabuada();
  divTabuada.appendChild(tabela);

  divTabuada = body.appendChild(divTabuada);
}

function criarTituloTabuada() {
  let valorSelecionado = selectionTabuada.value;
  let titulo = document.createElement("h1");
  titulo.innerHTML = `Tabuada do ${valorSelecionado}`;

  return titulo;
}

function criarTabelaTabuada() {
  let valorSelecionado = parseInt(selectionTabuada.value);
  let tabela = document.createElement("table");

  for (let i = 0; i <= 10; i++) {
    let resultado = i * valorSelecionado;

    let td = document.createElement("td");
    td.innerHTML = `${valorSelecionado} x ${i} = ${resultado}`;

    let tr = document.createElement("tr");
    tr.appendChild(td);

    tabela.appendChild(tr);
  }

  return tabela;
}

function limparDivTabuada() {
  if (divTabuada != null) {
    divTabuada.remove();
  }

  divTabuada = document.createElement("div");
}
