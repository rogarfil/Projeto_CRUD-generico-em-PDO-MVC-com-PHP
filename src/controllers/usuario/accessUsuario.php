<?php

/* Inclui a conexão com Banco de Dados */
use Src\Models\Connection;

/* Atribui uma conexão PDO */
$pdo = Connection::getInstance();
/* Recebe os dados enviados pela submissão */
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados['SendLogin'])) :
    $sql = "SELECT * FROM usuario WHERE nomeUsuario =:nomeUsuario LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nomeUsuario', $dados['nomeUsuario'], PDO::PARAM_STR);
    $stmt->execute();
    if (($stmt) and ($stmt->rowCount() != 0)) :
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($dados['senhaUsuario'], $row['senhaUsuario'])) :
            $_SESSION['idUsuario'] = $row['idUsuario'];
            $_SESSION['nomeUsuario'] = $row['nomeUsuario'];
            header("Location: dashboard");
        else :
            $_SESSION['msg'] = "<div class='container box-msg-crud'><p class='msg msg-erro'>
			Erro: Usuário ou senha inválida!</p></div>";
        endif;
    else :
        $_SESSION['msg'] = "<div class='container box-msg-crud'><p class='msg msg-erro'>
		Erro: Usuário ou senha inválida!</p></div>";
    endif;
endif;

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
