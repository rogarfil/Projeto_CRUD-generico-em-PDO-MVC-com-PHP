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
$crud = Crud::getInstance($pdo, 'produtor');
/* Recebe os dados enviados pela submissão */
$id = filter_input(INPUT_GET, 'idProdutor', FILTER_SANITIZE_SPECIAL_CHARS);
// Exclui o registro do usuário */
$arrayCond = array('idProdutor=' => $id);
$turn_back = $crud->delete($arrayCond);

if ($turn_back) :
    echo "<div class='msg msg-cad'>Registro excluido com sucesso, aguarde você está sendo redirecionado ...</div> ";
else :
    echo "<div class='msg msg-erro'>Erro ao excluir registro!</div> ";
endif;
echo "<meta http-equiv=refresh content='3;URL=../../../produtor'>";
?>
    </div>
</body>
</html>
