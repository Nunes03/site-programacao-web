const input = document.querySelector("#valorTabuada");

const tabelaTabuada = document.querySelector("#tabuada");

input.addEventListener("change", montarTabuada);


function montarTabuada() {
    limparConteudoTag(tabelaTabuada);
    let valorTabuada = input.value;

    if (valorTabuada == null && valorTabuada == "") {
        return;
    }

    popularTabelaTabuada(valorTabuada);
}

function popularTabelaTabuada(valorTabuada) {
    for (let i = 1; i <= 10; i++) {
        const tdValorTabuada = document.createElement("td");
        tdValorTabuada.innerHTML = valorTabuada;

        const tdIgual = document.createElement("td");
        tdIgual.innerHTML = "=";

        const tdX = document.createElement("td");
        tdX.innerHTML = "x";

        const tdResultado = document.createElement("td");
        tdResultado.innerHTML = i * parseFloat(valorTabuada);

        const tdVariavel = document.createElement("td");
        tdVariavel.innerHTML = i;

        const tr = document.createElement("tr");
        tr.appendChild(tdValorTabuada);
        tr.appendChild(tdX);
        tr.appendChild(tdVariavel);
        tr.appendChild(tdIgual);
        tr.appendChild(tdResultado);

        tabelaTabuada.appendChild(tr);
    }
}

function limparConteudoTag(tag) {
    tag.innerHTML = "";
}