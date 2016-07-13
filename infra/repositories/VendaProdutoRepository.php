<?php

class VendaProdutoRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(VendaProduto::getTableName());
	}

	public function adiciona($idVenda = 0, $idProduto = 0, $quantidade = 0)
	{
		if (Util::isNumero($idVenda) && Util::isNumero($idProduto) && Util::isNumero($quantidade)) {
			$sql = "INSERT INTO {$this->entity} SET 
						id_venda = :id_venda, 
						id_produto = :id_produto, 
						quantidade = :quantidade";

			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':id_venda', $idVenda);
			$sql->bindParam(':id_produto', $idProduto);
			$sql->bindParam(':quantidade', $quantidade);
			$sql->execute();
		}
	}
}
