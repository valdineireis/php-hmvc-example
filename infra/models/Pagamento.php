<?php

class Pagamento extends Entity implements EntityContract
{
	private $nome;

	public final static function getTableName() 
	{
		return "pagamentos";
	}

	public function getNome() 
	{
		return $this->nome;
	}

	public function setNome($nome) 
	{
		$this->nome = $nome;
		return $this;
	}
}
