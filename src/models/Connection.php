<?php

/**
 * Connection.php
 *
 * created by: rogarfil
 * Inicial version created on: 12/10/2022 15:07
 *
 * Descrição: Classe elaborada com o objetivo de auxlilar nas operações CRUDs em diversos SGBDS, possui
 * funcionalidades para construir instruções de INSERT, UPDATE E DELETE onde as mesmas podem ser executadas
 * nos principais SGBDs, exemplo SQL Server, MySQL e Firebird. Instruções SELECT são recebidas integralmente
 * via parâmetro.
 *
 */

namespace Src\Models;

use PDO;
use PDOException;

/**
 * Constantes de parâmetros para configuração da conexão
 */
define('SGBD', 'mysql');
define('HOST', 'localhost');
define('DBNAME', 'geotecnologia');
define('USER', 'root');
define('PASSWORD', '');
define('PORT', '3306');
define('CHARSET', 'utf8');
define('SERVER', 'linux');

/**
 * Configura o fuso horário padrão utilizado por todas as funções de data e hora em um script
 */
date_default_timezone_set('America/Sao_Paulo');

/**
 * Habilita a exibição de erro
 */
ini_set('display_errors', true);

/**
 * Informa o nível dos ERRORS que serão exibidos
 */
error_reporting(E_ALL);

class Connection
{
    /**
     * Atributo estático para instância do PDO
     */
    private static $pdo;

    /**
     * Singleton: Método construtor privado para impedir classe de gerar objeto
     */
    private function __construct()
    {
        # code...
    }

    /**
     * Método privado para verificar se a extensão PDO do banco de dados escolhido está habilitada
     */
    private static function checkExtension()
    {
        switch (SGBD) :
            case 'mysql':
                $extension = 'pdo_mysql';
                break;
            case 'mssql':
                if (SERVER == 'linux') :
                    $extension = 'pdo_dblib';
                else :
                    $extension = 'pdo_sqlsrv';
                endif;
                break;
            case 'postgre':
                $extension = 'pdo_pgsql';
                break;
            case 'sqlite':
                $extension = 'pdo_sqlite';
                break;
            case 'oci8':
                $extension = 'pdo_oci';
                break;
            case 'firebird':
                $extension = 'pdo_firebird';
                break;
        endswitch;

        if (!extension_loaded($extension)) :
            echo "<h1>Extensão {$extension} não habilitada!</h1>";
            exit();
        endif;
    }

    /**
     * Método estático para retornar uma conexão válida
     * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão
     */
    public static function getInstance(): PDO
    {
        self::checkExtension();

        if (!isset(self::$pdo)) {
            try {
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => true);

                switch (SGBD) :
                    case 'mysql':
                        self::$pdo = new PDO("mysql:host=" . HOST . "; port=" . PORT . "; dbname="
                         . DBNAME . ";", USER, PASSWORD, $options);
                        break;
                    case 'mssql':
                        if (SERVER == 'linux') :
                            /**
                             * DNS PDO para Linux
                             */
                            self::$pdo = new PDO("dblib:host=" . HOST . "; port=" . PORT . "; dbname="
                             . DBNAME . ";", USER, PASSWORD, $options);
                        else :
                            /**
                             * DNS PDO para Windows
                             */
                            self::$pdo = new PDO("sqlsrv:host=" . HOST . "; port=" . PORT . "; dbname="
                             . DBNAME . ";", USER, PASSWORD, $options);
                        endif;
                        break;
                    case 'postgre':
                        self::$pdo = new PDO("pgsql:host=" . HOST . "; port=" . PORT . "; dbname="
                         . DBNAME . ";", USER, PASSWORD, $options);
                        break;
                    case 'sqlite':
                        self::$pdo = new PDO("sqlite:host=" . HOST . "; port=" . PORT . "; dbname="
                         . DBNAME . ";", USER, PASSWORD, $options);
                        /**
                         * DSN PDO para trabalhar com banco SQLite em memória
                         */
                        self::$pdo = new PDO("sqlite:memory=", null, null, $options);
                        /**
                         * DSN PDO para trabalhar com banco SQLite em disco
                         */
                        self::$pdo = new PDO("sqlite:path_tax_bank=", USER, PASSWORD, $options);
                        break;
                    case 'oci8':
                        self::$pdo = new PDO("oci:host=" . HOST . "; port=" . PORT . "; dbname="
                         . DBNAME . ";", USER, PASSWORD, $options);
                        break;
                    case 'firebird':
                        self::$pdo = new PDO("firebird:host=" . HOST . "; port=" . PORT . "; dbname="
                         . DBNAME . ";", USER, PASSWORD, $options);
                        break;
                endswitch;
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }

    public static function isConnected(): bool
    {
        if (self::$pdo) :
            return true;
        else :
            return false;
        endif;
    }
}
