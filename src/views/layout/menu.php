<?php

use Src\Models\Url;

/* Ler URL (array) */
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$lastPart = end($parts);
$varParts = explode('?', $lastPart);
$secret = end($varParts);
$verParts = explode('=', $secret);
$resulta = end($verParts);

/* Defini qual elemento do array */
$port = $varParts[0];
$ports = $verParts[0];

if ($port == 'login') : ?>
    <a href="<?php echo Url::getBase(); ?>home"><i class="fa fa-fw fa-home"></i> Home</a>
    <?php
elseif (
    $port == 'dashboard' or $port == 'produtor' or $port == 'propriedade' or
    $port == 'reg_produtor' or $port == 'reg_propriedade' or $port == 'buscar' or
    $ports == 'idProdutor' or $ports == 'idPropriedade'
) :
    ?>
    <a href="<?php echo Url::getBase(); ?>produtor"><i class="fa fa-fw fa-handshake-o"></i> Produtor</a>
    <a href="<?php echo Url::getBase(); ?>propriedade"><i class="fa fa-fw fa-truck"></i> Propriedade</a>
    <a href="<?php echo Url::getBase(); ?>buscar"><i class="fa fa-fw fa-search"></i> Buscar</a>
    <a href="<?php echo Url::getBase(); ?>logout"><i class="fa fa-fw fa-arrow-right"></i> Sair</a>
    <?php
else :
    ?>
    <a href="<?php echo Url::getBase(); ?>home"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="<?php echo Url::getBase(); ?>login"><i class="fa fa-fw fa-unlock"></i> Login</a>
    <?php
endif;
