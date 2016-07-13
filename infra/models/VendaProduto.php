<?php

class VendaProduto extends Entity implements EntityContract
{
	private $venda;
	private $produto;
	private $quantidade;

	public function __construct()
	{
		$this->venda = new Venda();
		$this->produto = new Produto();
		$this->setQuantidade(0);
	}

	public final static function getTableName() 
	{
		return "loja_vendas_produtos";
	}

	public function isValido()
	{
		return true;
	}

	public function setVenda($venda)
	{
		$this->venda = $venda;
		return $this;
	}

	public function getVenda()
	{
		return $this->venda;
	}

	public function setProduto($produto)
	{
		$this->produto = $produto;
		return $this;
	}

	public function getProduto()
	{
		return $this->produto;
	}

	public function setQuantidade($qtd)
	{
		$this->quantidade = $qtd;
		return $this;
	}

	public function getQuantidade()
	{
		return $this->quantidade;
	}
}
