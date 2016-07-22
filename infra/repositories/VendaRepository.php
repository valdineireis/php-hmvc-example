<?php

class VendaRepository extends RepositoryBase
{
	private $tbl_tipos_pagamentos;

	public function __construct() 
	{
		parent::__construct(Venda::getTableName());
		$this->tbl_tipos_pagamentos = TipoPagamento::getTableName();
	}

	public function getPorId($idPedido, $idUsuario)
	{
		$array = array();

		if (!empty($idUsuario)) {

			$sql = "SELECT 
						*, 
						(SELECT {$this->tbl_tipos_pagamentos}.nome 
						FROM {$this->tbl_tipos_pagamentos} 
						WHERE {$this->tbl_tipos_pagamentos}.id = {$this->entity}.id_tipo_pagamento) as tipopgto 
					FROM {$this->entity} WHERE id = :id AND id_usuario = :idUsuario ";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':id', $idPedido);
			$sql->bindParam(':idUsuario', $idUsuario);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array = $sql->fetch(PDO::FETCH_OBJ);
			}
		}

		return $array;
	}

	public function getPedidosDoUsuario($idUsuario)
	{
		$array = array();

		if (!empty($idUsuario)) {

			$sql = "SELECT *, (SELECT {$this->tbl_tipos_pagamentos}.nome FROM {$this->tbl_tipos_pagamentos} WHERE {$this->tbl_tipos_pagamentos}.id = {$this->entity}.id_tipo_pagamento) as tipopgto FROM {$this->entity} WHERE id_usuario = :id ";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':id', $idUsuario);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll(PDO::FETCH_OBJ);
			}

		}

		return $array;
	}

	public function adiciona($idTipoPagamento, $idUsuario, $valor, $status, $link, $uf, $cep, $cidade, $bairro, $logradouro, $numero, $complemento)
	{
		$sql = "INSERT INTO {$this->entity} SET 
					id_tipo_pagamento = :id_tipo_pagamento, 
					id_usuario = :id_usuario, 
					valor = :valor, 
					status_pagamento = :status_pagamento, 
					link_pagamento = :link_pagamento,
					uf = :uf,
					cep = :cep,
					cidade = :cidade,
					bairro = :bairro,
					logradouro = :logradouro,
					numero = :numero,
					complemento = :complemento,
					dh_cadastro = NOW()";

		$sql = self::getConnection()->prepare($sql);
		$sql->bindParam(':id_tipo_pagamento', $idTipoPagamento);
		$sql->bindParam(':id_usuario', $idUsuario);
		$sql->bindParam(':valor', $valor);
		$sql->bindParam(':status_pagamento', $status);
		$sql->bindParam(':link_pagamento', $link);
		$sql->bindParam(':uf', $uf);
		$sql->bindParam(':cep', $cep);
		$sql->bindParam(':cidade', $cidade);
		$sql->bindParam(':bairro', $bairro);
		$sql->bindParam(':logradouro', $logradouro);
		$sql->bindParam(':numero', $numero);
		$sql->bindParam(':complemento', $complemento);
		$sql->execute();

		return self::getConnection()->lastInsertId();
	}

	public function atualizaStatus($idVenda, $status, $link)
	{
		$sql = "UPDATE {$this->entity} SET ";

		if (!empty($link)) {
			$sql .= "status_pagamento = :status_pagamento, link_pagamento = :link_pagamento
					WHERE id = :id_venda";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':link_pagamento', $link);
		} else {
			$sql .= "status_pagamento = :status_pagamento
					WHERE id = :id_venda";
			$sql = self::getConnection()->prepare($sql);
		}

		$sql->bindParam(':status_pagamento', $status);
		$sql->bindParam(':id_venda', $idVenda);
		$sql->execute();
	}
}
