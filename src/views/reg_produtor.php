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
        <form method="post" action="src/controllers/produtor/adicionarProdutor.php">
            <h1>Produtor</h1>

            <p>
            <label for="nomeProdutor">Nome do Produtor</label>
            <input type="text" id="nomeProdutor" name="nomeProdutor" required="required" placeholder="Nome do Produtor" />
            </p>

            <p>
            <label for="cpfProdutor">CPF do Produtor</label>
            <input type="text" id="cpfProdutor" name="cpfProdutor" required="required" placeholder="99999999999"/>
            </p>

            <p>
            <input type="submit" value="Cadastrar"/>
            </p>
        </form>
    </div>
</div>
