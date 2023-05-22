<?php

session_start();
ob_start();

if ((!isset($_SESSION['idUsuario'])) and (!isset($_SESSION['nomeUsuario']))) {
    $_SESSION['msg'] = "<p class='msg msg-erro'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: login");
} ?>

<div class="content">
    <h1>Bem vindo! <?php echo $_SESSION['nomeUsuario']; ?></h1>
    <div class="sub-title">
        <h4>Esta é sua área administrativa</h4>
    </div>
</div>
