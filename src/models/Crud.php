<?php
/**
 * Crud.php
 *
 * created by: rogarfil
 * Inicial version created on: 09/11/2022 13:22
 *
 * Descrição: A Classe de CRUD genérico foi elaborada com o objetivo de auxlilar nas operações CRUDs em diversos
 * SGBDS, possui funcionalidades para construir instruções de INSERT, UPDATE E DELETE onde as mesmas podem ser
 * executadas nos principais SGBDs, exemplo SQL Server, MySQL e Firebird. Instruções SELECT são recebidas
 * integralmente via parâmetro.
 *                                                                                 *
 */

namespace Src\Models;

use PDO;
use PDOException;

class Crud
{
    // Atributo para guardar uma conexão PDO
    private $pdo = null;

    // Atributo onde será guardado o nome da table
    private $table = null;

    // Atributo estático que contém uma instância da própria classe
    private static $crud = null;

    /*
    * Método privado construtor da classe
    * @param $turn_on = Conexão PDO configurada
    * @param $table = Nome da table
    */
    private function __construct($turn_on, $table = null)
    {
        if (!empty($turn_on)) :
            $this->pdo = $turn_on;
        else :
            echo "<h3>Conexão inexistente!</h3>";
            exit();
        endif;

        if (!empty($table)) {
            $this->table = $table;
        }
    }

    /*
    * Método público estático que retorna uma instância da classe Crud
    * @param $turn_on = Conexão PDO configurada
    * @param $table = Nome da table
    * @return Atributo contendo instância da classe Crud
    */
    public static function getInstance($turn_on, $table = null)
    {
        // Verifica se existe uma instância da classe
        if (!isset(self::$crud)) :
            try {
                self::$crud = new Crud($turn_on, $table);
            } catch (PDOException $e) {
                echo "Erro " . $e->getMessage();
            }
        endif;

        return self::$crud;
    }

    /*
    * Método para setar o nome da table na propriedade $table
    * @param $table = String contendo o nome da table
    */
    public function setTableName($table)
    {
        if (!empty($table)) {
            $this->table = $table;
        }
    }

    /*
    * Método privado para construção da instrução SQL de INSERT
    * @param $arrayDice = Array de dados contendo colunas e valores
    * @return String contendo instrução SQL
    */
    private function buildInsert($arrayDice)
    {
        // Inicializa variáveis
        $sql = "";
        $fields = "";
        $values = "";

        // Loop para montar a instrução com os campos e valores
        foreach ($arrayDice as $key => $value) :
            $fields .= $key . ',';
            $values .= '?,';
        endforeach;

        // Retira vírgula do final da string
        $fields = (substr($fields, -2) == ',') ? trim(substr($fields, (strlen($fields) - 2))) : $fields;

        // Retira vírgula do final da string
        $values = (substr($values, -2) == ',') ? trim(substr($values, (strlen($values) - 2))) : $values;

        // Concatena todas as variáveis e finaliza a instrução
        $sql .= "INSERT INTO " . $this->table . " (" . substr($fields, 0, strlen($fields) - 1) . ")
        VALUES (" . substr($values, 0, strlen($values) - 1) . ")";

        // Retorna string com instrução SQL
        return trim($sql);
    }

    /*
    * Método privado para construção da instrução SQL de UPDATE
    * @param $arrayDice = Array de dados contendo colunas, operadores e valores
    * @param $arrayCondition = Array de dados contendo colunas e valores para condição WHERE
    * @return String contendo instrução SQL
    */

    private function buildUpdate($arrayDice, $arrayCondition)
    {
        // Inicializa variáveis
        $sql = "";
        $valFields = "";
        $valCondition = "";

        // Loop para montar a instrução com os campos e valores
        foreach ($arrayDice as $key => $value) :
            $valFields .= $key . '=?, ';
        endforeach;

        // Loop para montar a condição WHERE
        foreach ($arrayCondition as $key => $value) :
            $valCondition .= $key . '?';
        endforeach;

        // Retira vírgula do final da string
        $valFields = (substr($valFields, 0) == ', ') ? trim(substr($valFields, (strlen($valFields) - 2))) : $valFields ;

        // Retira vírgula do final da string
        $valCondition = (substr($valCondition, -2) == 'AND ') ? trim(substr($valCondition, (strlen($valCondition)
        - 4))) : $valCondition;

        // Concatena todas as variáveis e finaliza a instrução
        $sql .= "UPDATE {$this->table} SET " . substr($valFields, 0, strlen($valFields) - 2) . " WHERE " . $valCondition;

        // Retorna string com instrução SQL
        return trim($sql);
    }

    /*
    * Método privado para construção da instrução SQL de DELETE
    * @param $arrayCondition = Array de dados contendo colunas, operadores e valores para condição WHERE
    * @return String contendo instrução SQL
    */
    private function buildDelete($arrayCondition)
    {
        // Inicializa variáveis
        $sql = "";
        $valFields = "";

        // Loop para montar a instrução com os campos e valores
        foreach ($arrayCondition as $key => $value) :
            $valFields .= $key . '?';
        endforeach;

        // Retira a palavra AND do final da string
        $valFields = (substr($valFields, -4) == 'AND ') ? trim(substr($valFields, (strlen($valFields)
         - 4))) : $valFields;

        // Concatena todas as variáveis e finaliza a instrução
        $sql .= "DELETE FROM {$this->table} WHERE " . $valFields;

        // Retorna string com instrução SQL
        return trim($sql);
    }

    /*
    * Método público para inserir os dados na table
    * @param $arrayDice = Array de dados contendo colunas e valores
    * @return Retorna resultado booleano da instrução SQL
    */
    public function insert($arrayDice)
    {
        try {
            // Atribui a instrução SQL construida no método
            $sql = $this->buildInsert($arrayDice);

            // Passa a instrução para o PDO
            $stmt = $this->pdo->prepare($sql);

            // Loop para passar os dados como parâmetro
            $cont = 1;
            foreach ($arrayDice as $value) :
                $stmt->bindValue($cont, $value);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno
            /** @var TYPE_NAME $turn_back */
            $turn_back = $stmt->execute();

            return $turn_back;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*
    * Método público para atualizar os dados na table
    * @param $arrayDice = Array de dados contendo colunas e valores
    * @param $arrayCondition = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)
    * @return Retorna resultado booleano da instrução SQL
    */
    public function update($arrayDice, $arrayCondition)
    {
        try {
            // Atribui a instrução SQL construida no método
            $sql = $this->buildUpdate($arrayDice, $arrayCondition);

            // Passa a instrução para o PDO
            $stmt = $this->pdo->prepare($sql);

            // Loop para passar os dados como parâmetro
            $cont = 1;
            foreach ($arrayDice as $value) :
                $stmt->bindValue($cont, $value);
                $cont++;
            endforeach;

            // Loop para passar os dados como parâmetro cláusula WHERE
            foreach ($arrayCondition as $value) :
                $stmt->bindValue($cont, $value);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno
            /** @var TYPE_NAME $turn_back */
            $turn_back = $stmt->execute();

            return $turn_back;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*
    * Método público para excluir os dados na table
    * @param $arrayCondition = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)
    * @return Retorna resultado booleano da instrução SQL
    */
    public function delete($arrayCondition)
    {
        try {
            // Atribui a instrução SQL construida no método
            $sql = $this->buildDelete($arrayCondition);

            // Passa a instrução para o PDO
            $stmt = $this->pdo->prepare($sql);

            // Loop para passar os dados como parâmetro cláusula WHERE
            $cont = 1;
            foreach ($arrayCondition as $value) :
                $stmt->bindValue($cont, $value);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno
            /** @var TYPE_NAME $turn_back */
            $turn_back = $stmt->execute();

            return $turn_back;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*
    * Método genérico para executar instruções de consulta independente do nome da table passada no _construct
    * @param $sql = Instrução SQL inteira contendo, nome das tables envolvidas, JOINS, WHERE, ORDER
    * BY, GROUP BY e LIMIT
    * @param $arrayParam = Array contendo somente os parâmetros necessários para clásusla WHERE
    * @param $fetchAll  = Valor booleano com valor default TRUE indicando que serão retornadas várias
    * linhas, FALSE retorna apenas a primeira linha
    * @return Retorna array de dados da consulta em forma de objetos
    */
    public function getSQLGeneric($sql, $arrayParams = null, $fetchAll = true)
    {
        try {
            // Passa a instrução para o PDO
            $stmt = $this->pdo->prepare($sql);

            // Verifica se existem condições para carregar os parâmetros
            if (!empty($arrayParams)) :
                // Loop para passar os dados como parâmetro cláusula WHERE
                $cont = 1;
                foreach ($arrayParams as $value) :
                    $stmt->bindValue($cont, $value);
                    $cont++;
                endforeach;
            endif;

            // Executa a instrução SQL
            $stmt->execute();

            // Verifica se é necessário retornar várias linhas
            if ($fetchAll) :
                $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
            else :
                $dados = $stmt->fetch(PDO::FETCH_OBJ);
            endif;

            return $dados;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
