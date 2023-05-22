<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
}

use Src\Models\Connection;

// Recebe o id do Propriedade via GET
$id = (isset($_GET['idPropriedade'])) ? $_GET['idPropriedade'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id) && is_numeric($id)) :
    // Captura os dados do cliente solicitado
    $conexao = Connection::getInstance();
    $sql = 'SELECT * FROM propriedade WHERE idPropriedade = :idPropriedade';
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':idPropriedade', $id);
    $stmt->execute();
    $propriedade = $stmt->fetch(PDO::FETCH_OBJ);
endif;

?>
<div class="content">
    <!--FORMULÁRIO DE CADASTRO-->
    <div id="cadastro">
        <form method="post" action="src/controllers/propriedade/atualizarPropriedade.php">
            <input type="hidden" name="idPropriedade" value="<?=$propriedade->idPropriedade?>">
            <h1>Propriedade</h1>

            <p>
            <label for="nomePropriedade">Nome da Propriedade</label>
            <input type="text" id="nomePropriedade" name="nomePropriedade" value="<?=$propriedade->nomePropriedade?>"
             required="required"/>
            </p>

            <p>
            <label for="cadastroRural">CPF do Propriedade</label>
            <input type="text" id="cadastroRural" name="cadastroRural" value="<?=mask($propriedade->cadastroRural, '###.######/##')?>"
             required="required"/>
            </p>

            <p>
            <input type="submit" value="Editar"/>
            </p>
        </form>
    </div>
</div>
