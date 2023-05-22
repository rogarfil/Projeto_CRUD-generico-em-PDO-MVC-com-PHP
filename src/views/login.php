<?php

session_start();
ob_start();

require dirname(dirname(__FILE__)) . '/controllers/usuario/accessUsuario.php';

?>
<a class="links" id="paracadastro"></a>
<a class="links" id="paralogin"></a>

<div class="content">
    <!--FORMULÁRIO DE CADASTRO-->
    <div id="cadastro">
        <form method="post" action="src/controllers/usuario/adicionarUsuario.php">
            <h1>Cadastro</h1>

            <p>
            <label for="nomeUsuario">Nome de Usuário</label>
            <input type="text" id="nomeUsuario" name="nomeUsuario" required="required" placeholder="Nome de Usuário" />
            </p>

            <p>
            <label for="senhaUsuario">Sua senha</label>
            <input type="password" id="senhaUsuario" name="senhaUsuario" required="required" placeholder="ex. 1234"/>
            </p>

            <p>
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" />
            <label for="manterlogado">Manter-me logado</label>
            </p>

            <p>
            <input type="submit" value="Cadastrar"/>
            </p>

            <p class="link">
            Já tem conta?
            <a href="#paralogin"> Ir para Login </a>
            </p>
        </form>
    </div>

    <!--FORMULÁRIO DE LOGIN-->
    <div id="login">
        <form method="post" action="">
            <h1>Login</h1>
            <p>
            <label for="nomeUsuario">Nome de Usuário</label>
            <input type="text" id="nomeUsuario" name="nomeUsuario" required="required" placeholder="Admin"/>
            </p>

            <p>
            <label for="senhaUsuario">Sua senha</label>
            <input type="password" id="senhaUsuario" name="senhaUsuario" required="required" placeholder="123456" />
            </p>

            <p>
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" />
            <label for="manterlogado">Manter-me logado</label>
            </p>

            <p>
            <input type="submit" value="Logar" name="SendLogin" />
            </p>

            <p class="link">
            Ainda não tem conta?
            <a href="#paracadastro">Cadastre-se</a>
            </p>
        </form>
    </div>
</div>
