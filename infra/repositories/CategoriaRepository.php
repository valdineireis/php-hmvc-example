<?php

class CategoriaRepository extends RepositoryBase
{
	private $tbl_produtos;

	public function __construct() 
	{
		parent::__construct(Categoria::getTableName());
		$this->tbl_produtos = Produto::getTableName();
	}

	public function adiciona($nome)
	{
		if(!empty($nome)) {

			$sql = "INSERT INTO {$this->entity} SET nome = :nome";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':nome', $nome);
			$sql->execute();

		}
	}

	public function edita($nome, $id)
	{
		if(!empty($nome) && is_numeric($id) && $id > 0) {

			$sql = "UPDATE {$this->entity} SET nome = :nome WHERE id = :id";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':nome', $nome);
			$sql->bindParam(':id', $id);
			$sql->execute();

		}
	}

	public function removeCategoria($id)
	{
		$sql = "DELETE FROM {$this->entity} WHERE id = :id";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':id', $id);
		$sql->execute();

		$sql = "DELETE FROM {$this->tbl_produtos} WHERE id_categoria = :id";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':id', $id);
		$sql->execute();
	}
}
