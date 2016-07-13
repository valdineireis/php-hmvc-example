<?php

class VendaRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(Venda::getTableName());
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
}
