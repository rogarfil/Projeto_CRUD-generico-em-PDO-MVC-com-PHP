<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
}

use Src\Models\Connection;

// Recebe o id do Produtor via GET
$id = (isset($_GET['idProdutor'])) ? $_GET['idProdutor'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id) && is_numeric($id)) :
    // Captura os dados do cliente solicitado
    $conexao = Connection::getInstance();
    $sql = 'SELECT idProdutor, nomeProdutor, cpfProdutor FROM produtor WHERE idProdutor = :idProdutor';
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':idProdutor', $id);
    $stmt->execute();
    $produtor = $stmt->fetch(PDO::FETCH_OBJ);
endif;

?>
<div class="content">
    <!--FORMULÁRIO DE CADASTRO-->
    <div id="cadastro">
        <form method="post" action="src/controllers/produtor/atualizarProdutor.php">
            <input type="hidden" name="idProdutor" value="<?=$produtor->idProdutor?>">
            <h1>Produtor</h1>

            <p>
            <label for="nomeProdutor">Nome do Produtor</label>
            <input type="text" id="nomeProdutor" name="nomeProdutor" value="<?=$produtor->nomeProdutor?>" required="required"/>
            </p>

            <p>
            <label for="cpfProdutor">CPF do Produtor</label>
            <input type="text" id="cpfProdutor" name="cpfProdutor" value="<?=mask($produtor->cpfProdutor, '###.###.###-##')?>" required="required"/>
            </p>

            <p>
            <input type="submit" value="Editar"/>
            </p>
        </form>
    </div>
</div>
