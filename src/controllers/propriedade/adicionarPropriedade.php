<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Sistema de Cadastro</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <div class='container box-msg-crud'>
<?php

use Src\Models\Connection;
use Src\Models\Crud;

require '../../models/Connection.php';
require '../../models/Crud.php';

/* Atribui uma conexão PDO */
$pdo = Connection::getInstance();
/* Atribui uma instância da classe Crud, passando como parâmetro a conexão PDO e o nome da tabela */
$crud = Crud::getInstance($pdo, 'propriedade');
/* Recebe os dados enviados pela submissão */
$nome  = (isset($_POST['nomePropriedade'])) ? $_POST['nomePropriedade'] : '';
$cr   = (isset($_POST['cadastroRural'])) ? str_replace(array('.','/'), '', $_POST['cadastroRural']) : '';
/* Inseri os dados do usuário */
$arrayUser = array('nomePropriedade' => $nome, 'cadastroRural' => $cr);
$turn_back = $crud->insert($arrayUser);

if ($turn_back) :
    echo "<div class='msg msg-cad'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
else :
    echo "<div class='msg msg-erro'>Erro ao inserir registro!</div> ";
endif;
echo "<meta http-equiv=refresh content='3;URL=../../../propriedade'>";
?>
    </div>
</body>
</html>
