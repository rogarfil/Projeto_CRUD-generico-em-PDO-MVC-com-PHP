<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
}

require 'src/controllers/produtor/tabelaProdutor.php'; ?>

<!-- Cabeçalho da Listagem -->
<legend><h1>Listagem Produtor</h1></legend>

<!-- Link para página de cadastro -->
<a href='reg_produtor' class="btn btn-submit">Cadastrar Produtor</a><br />
<div class='clearfix'></div>

<?php if (!empty($turn_back)) : ?>
    <div class="content">
        <!-- Tabela de Produtores -->
        <table class="rTable">
            <tr class="titulo">
                <th>Nome Produtor</th>
                <th>CPF do Produtor</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($turn_back as $tb) : ?>
            <tr>
                <td><?=$tb->nomeProdutor?></td>
                <td><?=mask($tb->cpfProdutor, '###.###.###-##')?></td>
                <td>
                <a href='edit_produtor?idProdutor=<?=$tb->idProdutor?>' class="btn btn-editar">Editar</a>
                <a class="Deletar btn btn-excluir" href="<?php echo
                "src/controllers/produtor/eliminarProdutor.php?idProdutor=$tb->idProdutor";
                ?>">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else : ?>
<!-- Mensagem caso não exista Produtores ou não encontrado  -->
<h3 class="text-center text-primary">Não existem Produtores cadastrados!</h3>
<?php endif; ?>
