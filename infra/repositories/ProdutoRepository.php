<?php

class ProdutoRepository extends RepositoryBase
{
	public function __construct() {
		parent::__construct("produtos");
	}

	/**
	 * Seleciona todos os produtos com base nos IDs (código).
	 *
	 * @var ids lista de códigos de identificação dos produtos.
	 */
	public function selectIn($ids = array()) {
		$produtos = array();

		if (count($ids) > 0) {
			$sql = "SELECT * FROM produtos WHERE id IN (".implode(',', $ids).")";
			$sql = self::getConnection()->prepare($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$produtos = $sql->fetchAll(PDO::FETCH_OBJ);
			}

		}

		return $produtos;
	}
}
