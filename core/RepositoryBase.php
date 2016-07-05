<?php

/**
 * Classe abstrata de conexão. Padrão SingleTon.
 * Retorna um objeto PDO pelo método estático getConnection();
 *
 * Valdinei Reis valdinei@nocodigo.com
 */
abstract class RepositoryBase
{
    /** @var PDO */
	private static $db = null;

    /** Retorna um objeto PDO Singleton Pattern. */
    protected static function getConnection() {
        return self::Conectar();
    }

    /**
     * Conecta com o banco de dados com o pattern singleton.
     * Retorna um objeto PDO!
     */
    private static function Conectar() {
		global $config;

        try {
            if (self::$db == null) {
                $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$db = new PDO($dsn, $config['dbuser'], $config['dbpass'], $options);
            }
        } catch (PDOException $e) {
            echo 'Erro ao conectar: '.$e->getCode().' - '.$e->getMessage().' - '.$e->getFile().' - '.$e->getLine();
            die;
        }

        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db;
    }
}
