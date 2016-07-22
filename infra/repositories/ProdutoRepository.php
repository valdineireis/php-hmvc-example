<?php

class ProdutoRepository extends RepositoryBase
{
	private $tbl_vendas_produtos;

	public function __construct() 
	{
		parent::__construct(Produto::getTableName());
		$this->tbl_vendas_produtos = VendaProduto::getTableName();
	}

	/**
	 * Seleciona todos os produtos com base nos IDs (código).
	 *
	 * @param array $ids lista de códigos de identificação dos produtos.
	 * @return array
	 */
	public function selectIn(array $ids = array())
	{
		$produtos = array();

		if (is_array($ids) && count($ids) > 0) {
			$sql = "SELECT * FROM {$this->entity} WHERE id IN (".implode(',', $ids).")";
			$sql = self::getConnection()->prepare($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$produtos = $sql->fetchAll(PDO::FETCH_OBJ);
			}
		}

		return $produtos;
	}

	/**
	 * Seleciona um produto com base no ID (código).
	 *
	 * @param int $id código de identificação do produto.
	 * @return array
	 */
	public function selectById($id)
	{
		$produto = array();

		if ($id > 0) {
			$sql = "SELECT * FROM {$this->entity} WHERE id = :id";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':id', $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$produto = $sql->fetch(PDO::FETCH_OBJ);
			}
		}

		return $produto;
	}

	public function getProdutosPorVendaId($idVenda)
	{
		$array = array();

		if (!empty($idVenda)) {
			
			$sql = "SELECT 
					{$this->tbl_vendas_produtos}.quantidade, 
					{$this->tbl_vendas_produtos}.id_produto, 
					{$this->entity}.nome, 
					{$this->entity}.imagem, 
					{$this->entity}.preco 
					FROM {$this->entity} INNER JOIN {$this->tbl_vendas_produtos}
						ON {$this->tbl_vendas_produtos}.id_produto = {$this->entity}.id
					WHERE {$this->tbl_vendas_produtos}.id_venda = :idVenda ";

			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':idVenda', $idVenda);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll(PDO::FETCH_OBJ);
			}
		}

		return $array;
	}
}
