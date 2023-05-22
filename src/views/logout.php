<?php

session_start();
ob_start();
unset($_SESSION['idUsuario'], $_SESSION['nomeUsuario']);
$_SESSION['msg'] = "<p class='msg msg-cad'>Deslogado com sucesso!</p>";
header("Location: login");
