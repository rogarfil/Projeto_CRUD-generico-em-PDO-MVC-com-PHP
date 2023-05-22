<?php

use Src\Models\Connection;
use Src\Models\Crud;

/* Atribui uma conexão PDO */
$pdo = Connection::getInstance();
// Atribui uma instância da classe Crud, passando como parâmetro a conexão PDO e o nome da tabela
$crud = Crud::getInstance($pdo, 'propriedade');
/* executa uma consulta completa */
$sql = 'SELECT * FROM propriedade ORDER BY nomePropriedade ASC';
$arrayParam = array();
$turn_back = $crud->getSQLGeneric($sql, $arrayParam, true);
