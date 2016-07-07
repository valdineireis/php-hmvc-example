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

	/** @var Nome da tabela do banco de dados */
	private $entity;

	public function __construct($entity) 
	{
		$this->entity = $entity;
	}

    /** Retorna um objeto PDO Singleton Pattern. */
    protected static function getConnection() 
	{
        return self::conectar();
    }

    /**
     * Conecta com o banco de dados com o pattern singleton.
     * Retorna um objeto PDO!
     */
    private static function conectar() 
	{
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

	/**
	 * Seleciona todos os dados da tabela no banco de dados.
	 *
	 * @param int $quantidade número máximo de resultados, se for igual a 0, retorna todos os registros.
	 * @param bool $rand se preenchido com o valor TRUE, retorna resultados aleatórios.
	 */
	public function select($quantidade = 0, $rand = false) 
	{
		$sql = "SELECT * FROM {$this->entity} ";

		if ($rand) {
			$sql .= "ORDER BY RAND() ";
		}

		if ($quantidade > 0) {
			$sql .= "LIMIT :quantidade";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':quantidade', $qtd);
			$qtd = $quantidade;
		} else {
			$sql = self::getConnection()->prepare($sql);
		}

		$sql->execute();

		$result = array();

		if ($sql->rowCount() > 0) {
			$result = $sql->fetchAll(PDO::FETCH_OBJ);
		}

		return $result;
	}
}
