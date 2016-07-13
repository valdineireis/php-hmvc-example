<?php

class TipoPagamento extends Entity implements EntityContract
{
	private $nome;

	public final static function getTableName() 
	{
		return "loja_tipos_pagamentos";
	}

	public function getNome() 
	{
		return $this->nome;
	}

	public function setNome($nome) 
	{
		$this->nome = Util::normaliza($nome);
		return $this;
	}

	public function isValido()
	{
		if (!empty($this->id) && Util::isNumero($this->id) && !empty($this->nome)) {
			return true;
		}

		return false;
	}
}
