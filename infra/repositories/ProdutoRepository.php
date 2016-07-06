<?php

class ProdutoRepository extends RepositoryBase
{
	public function selectIn($ids = array()) {
		$sql = "SELECT * FROM produtos WHERE id IN (:ids)";
		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':ids', $idDosProdutos);
		$idDosProdutos = implode(',', $ids);
		$sql->execute();

		$produtos = array();

		if ($sql->rowCount() > 0) {
			$produtos = $sql->fetchAll(PDO::FETCH_OBJ);
		}

		return $produtos;
	}
}
