# Projeto CRUD generico em PDO e MVC com PHP.

## index.php

Todas a estrutura para funcionamento estão neste único arquivo.

## Connection.php :

Esta Classe genérico tem por objetivo auxiliar nas operações de diversos SGBDS.

## Crud.php :

Classe elaborada com o objetivo de funcionalidades para construir instruções de INSERT, UPDATE E DELETE e o SELECT é recebido integralmente via parâmetro.

## Url.php

A implementação de url amigáveis no php, é uma das maneiras mais fáceis e estruturada de se obter resultados com os buscadores.
Habilitar o mod_rewrite do php, depois criar um arquivo .htaccess do Apache no diretório raiz de seu site, como segue:

### Ativar mecanismo de reescrita

RewriteEngine On

### Se não for um arquivo execute as regras

RewriteCond %{REQUEST_FILENAME} !-f

### Se não for um diretório, execute as regras

RewriteCond %{REQUEST_FILENAME} !-d

### Redirecione para index.php se você atender às condições acima

RewriteRule ^(.\*)$ index.php?pg=$1 [QSA,L]
