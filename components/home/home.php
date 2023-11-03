<?php

?>
<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="UTF-8" />
        <title>Página Inicial</title>
        <link rel="stylesheet" type="text/css" href="home.css" />
        <script src="home.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="container-menu">
                <a class="menu-item">UNIASERVICE</a>
                <input type="text" placeholder="Pesquisar..." />
                <button class="botao-pesquisar">Pesquisar</button>
                <a class="menu-item">Perfil</a>
            </div>
            <div class="container-conhecer-pessoas">
                <h4>Pessoas que você talvez conheça</h4>
                <div class="conhecer-pessoas-dados">
                    <div>
                        <img class="conhecer-pessoas-img" src="../../assets/emptyPicture.jpg">
                    </div>
                    <div class="conhecer-pessoas-nome">
                        <a>Fulano de Tal</a>
                    </div>
                </div>
                <div class="conhecer-pessoas-botao">
                    <button class="botao-conhecer-pessoas botao-conhecer-pessoas-adicionar">Adicionar</button>
                    <button class="botao-conhecer-pessoas">Próximo</button>
                </div>
            </div>
            <div class="container-postar">
                <textarea class="postar-texto" placeholder="Escreva algo aqui!"></textarea>
                <button>Postar</button>
                <input type="file" name="arquivos" accept="image/png, image/jpeg"  multiple />
            </div>
            <div class="container-postagem">
                <a>Confira o que há de novo</a>
                <table>
                    <tr>
                        <td>
                            <div class="postagem">
                                <div>
                                    <div class="postagem-cabecalho-info">
                                        <img class="postagem-foto-perfil" src="../../assets/fotoPerfil.jpg">
                                        <a class="postagem-nome-usuario">UsuarioFulano</a>
                                    </div>
                                    <div class="postagem-cabecalho-botao">
                                        <button class="postagem-botao-excluir">Excluir</button>
                                        <button class="postagem-botao-editar">Editar</button>
                                    </div>
                                </div>
                                <div>
                                    <a class="postagem-data-postagem">Postado: 15/10/2023</a>
                                </div>
                                <div class="postagem-dados">
                                    <a> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam illo enim nam! Vel earum reprehenderit a ipsa, nesciunt facere delectus dignissimos enim error in ipsam itaque corporis sequi praesentium laboriosam.</a>
                                    <img class="postagem-dados-foto" src="../../assets/emptyPicture.jpg">
                                </div>
                                <div>
                                    <button class="botao-curtir"><img class="botao-curtir-imagem" src="../../assets/gostar.png">Curtir</button>
                                </div>
                            </div> 
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>