<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
} ?>
<div class="content">
    <!--FORMULÁRIO DE CADASTRO-->
    <div id="cadastro">
        <form method="post" action="src/controllers/propriedade/adicionarPropriedade.php">
            <h1>Propriedade</h1>

            <p>
            <label for="nomePropriedade">Nome da Propriedade</label>
            <input type="text" id="nomePropriedade" name="nomePropriedade" required="required" placeholder="Nome da Propriedade" />
            </p>

            <p>
            <label for="cadastroRural">Cadastro Rural</label>
            <input type="text" id="cadastroRural" name="cadastroRural" required="required" placeholder="Geo99999923"/>
            </p>

            <p>
            <input type="submit" value="Cadastrar"/>
            </p>
        </form>
    </div>
</div>
