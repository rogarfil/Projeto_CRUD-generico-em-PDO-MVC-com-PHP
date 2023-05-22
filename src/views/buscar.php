<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
}

use Src\Models\Connection;

// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
if (!empty($termo)) :
    $pdo = Connection::getInstance();
    $sql = 'SELECT a.idProdutor, a.nomeProdutor, a.cpfProdutor, b.idPropriedade, b.nomePropriedade, b.cadastroRural
            FROM produtor a, propriedade b
            WHERE idProdutor LIKE :idProdutor OR nomeProdutor LIKE :nomeProdutor OR cpfProdutor LIKE :cpfProdutor OR idPropriedade LIKE :idPropriedade OR nomePropriedade LIKE :nomePropriedade OR cadastroRural LIKE :cadastroRural';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':idProdutor', $termo . '%');
    $stmt->bindValue(':nomeProdutor', $termo . '%');
    $stmt->bindValue(':cpfProdutor', $termo . '%');
    $stmt->bindValue(':idPropriedade', $termo . '%');
    $stmt->bindValue(':nomePropriedade', $termo . '%');
    $stmt->bindValue(':cadastroRural', $termo . '%');
    $stmt->execute();
    $todos = $stmt->fetchAll(PDO::FETCH_OBJ);
endif;
?>

<!-- Cabeçalho da Listagem -->
<legend><h1>Listagem de Produtores e Propriedades</h1></legend>
<div class="fTable">
    <!-- Formulário de Pesquisa -->
    <form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
        <label class="control-label" for="termo"><h4>Pesquisar</h4></label>
        <div>
        <input type="text" class="form-control" id="termo" name="termo" placeholder="Buscar por qualquer campo do Produtor ou Propriedade">
        </div>
        <button type="submit" class="btn btn-submit">Pesquisar</button>
    </form>
</div>

<?php if (!empty($todos)) : ?>
<!-- Tabela de Busca -->
<table class="rTable">
    <tr>
        <th>Id</th>
        <th>Produtor</th>
        <th>CPF</th>
        <th>Id</th>
        <th>Propriedade</th>
        <th>Cadastro Rural</th>
    </tr>
    <?php foreach ($todos as $todo) : ?>
    <tr class="recuo">
        <td><?=$todo->idProdutor?></td>
        <td><?=$todo->nomeProdutor?></td>
        <td><?=mask($todo->cpfProdutor, '###.###.###-##')?></td>
        <td><?=$todo->idPropriedade?></td>
        <td><?=$todo->nomePropriedade?></td>
        <td><?=mask($todo->cadastroRural, '###.######/##')?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else : ?>
<!-- Mensagem caso não exista cadastros ou não encontrado  -->
<h3 class="text-center text-primary">Realize a Busca para ver o cadastro!</h3>
<?php endif; ?>
</body>
</html>
