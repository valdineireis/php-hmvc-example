<?php

class UsuarioRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(Usuario::getTableName());
	}

	public function isExiste($email) 
	{
		$sql = "SELECT id FROM {$this->entity} WHERE email = :email";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':email', $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		}

		return false;
	}

	public function isAutenticado($email, $senha) 
	{
		$sql = "SELECT id FROM {$this->entity} WHERE email = :email AND senha = :senha";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':senha', $senha);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		}

		return false;
	}

	public function login($email, $senha) 
	{
		$id = 0;

		$sql = "SELECT id FROM {$this->entity} WHERE ativo = true AND perfil = 'admin' AND email = :email AND senha = :senha";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':senha', $senha);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id'];
		}

		return $id;
	}

	public function getId($email) 
	{
		$id = 0;

		$sql = "SELECT id FROM {$this->entity} WHERE email = :email";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':email', $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id'];
		}

		return $id;
	}

	public function adiciona($nome, $email, $senha)
	{
		$sql = "INSERT INTO {$this->entity} SET nome = :nome, email = :email, senha = :senha, dh_cadastro = NOW(), ativo = 1";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':nome', $nome);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':senha', $senha);
		$sql->execute();

		return self::getConnection()->lastInsertId();
	}
}
