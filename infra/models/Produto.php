<?php

class Produto extends Entity implements EntityContract
{
	private $nome;
	private $preco;
	private $imagem;
	private $descricao;

	public final static function getTableName() 
	{
		return "loja_produtos";
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

	public function getPreco() 
	{
		return $this->preco;
	}

	public function setPreco($preco) 
	{
		$this->preco = $preco;
		return $this;
	}

	public function getImagem() 
	{
		return $this->imagem;
	}

	public function setImagem($imagem) 
	{
		$this->imagem = $imagem;
		return $this;
	}

	public function getDescricao() 
	{
		return $this->descricao;
	}

	public function setDescricao($descricao) 
	{
		$this->descricao = $descricao;
		return $this;
	}
}
