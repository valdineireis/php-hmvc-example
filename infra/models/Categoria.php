<?php

class Categoria extends Entity implements EntityContract
{
	private $nome;

	public final static function getTableName() 
	{
		return "loja_categorias";
	}

	public function isValido()
	{
		return true;
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
