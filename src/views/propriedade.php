<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
}

require 'src/controllers/propriedade/tabelaPropriedade.php'; ?>

<!-- Cabeçalho da Listagem -->
<legend><h1>Listagem Propriedade</h1></legend>

<!-- Link para página de cadastro -->
<a href='reg_propriedade' class="btn btn-submit">Cadastrar Propriedade</a>
<div class='clearfix'></div>

<?php if (!empty($turn_back)) : ?>
    <div class="content">
        <!-- Tabela de Propriedades -->
        <table class="rTable">
            <tr>
                <th>Nome Propriedade</th>
                <th>Cadastro Rural</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($turn_back as $tb) : ?>
            <tr>
                <td><?=$tb->nomePropriedade?></td>
                <td><?=mask($tb->cadastroRural, '###.######/##')?></td>
                <td>
                <a href='edit_propriedade?idPropriedade=<?=$tb->idPropriedade?>' class="btn btn-editar">Editar</a>
                <a class="Deletar btn btn-excluir" href="<?php echo
                "src/controllers/propriedade/eliminarPropriedade.php?idPropriedade=$tb->idPropriedade";
                ?>">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else : ?>
<!-- Mensagem caso não exista Propriedades ou não encontrado  -->
<h3 class="text-center text-primary">Não existem Propriedades cadastrados!</h3>
<?php endif; ?>
