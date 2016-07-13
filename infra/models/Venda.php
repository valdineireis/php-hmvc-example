<?php

class Venda extends Entity implements EntityContract
{
	private $vendaRepository;
	private $vendaProdutoRepository;

	private $valor;
	private $status_pagamento;
	private $link_pagamento;

	private $uf;
	private $cep;
	private $cidade;
	private $bairro;
	private $logradouro;
	private $numero;
	private $complemento;
	private $dh_cadastro;
	
	private $tipoPagamento;
	private $usuario;

	public function __construct()
	{
		$this->tipoPagamento = new TipoPagamento();
		$this->usuario = new Usuario();
		$this->setDhCadastro(date('d-m-Y H:i:s'));

		$this->vendaRepository = new VendaRepository();
		$this->vendaProdutoRepository = new VendaProdutoRepository();
	}

	public final static function getTableName() 
	{
		return "loja_vendas";
	}

	public function isValido()
	{
		if (Util::isNumero($this->valor) && 
			!empty($this->uf) && 
			!empty($this->cep) && 
			!empty($this->cidade) && 
			!empty($this->bairro) && 
			!empty($this->logradouro) && 
			is_object($this->tipoPagamento) && Util::isNumero($this->tipoPagamento->getId()) &&
			is_object($this->usuario) && Util::isNumero($this->usuario->getId())) 
		{
			return true;
		}

		return false;
	}

	public function finaliza($produtos = array())
	{
		/*
		1 => Aguardando Pgto.
		2 => Aprovado
		3 => Cancelado
		*/
		$status = '1';
		$link = '';

		if($this->getTipoPagamento()->getId() == '1') {
			$status = '2';
			$link = '/checkout/home/obrigado';
		} else {

			// Integração com Pagamentos...

		}

		$this->setLinkPagamento($link);
		$this->setStatusPagamento($status);

		$vid = $this->vendaRepository->adiciona(
						$this->getTipoPagamento()->getId(), 
						$this->getUsuario()->getId(), 
						$this->getValor(), 
						$this->getStatusPagamento(), 
						$this->getLinkPagamento(), 
						$this->getUf(), 
						$this->getCep(), 
						$this->getCidade(), 
						$this->getBairro(), 
						$this->getLogradouro(), 
						$this->getNumero(), 
						$this->getComplemento()
		);
		$this->setId($vid);

		if (is_array($produtos) && count($produtos) > 0) {
			foreach ($produtos as $prod) {
				$this->vendaProdutoRepository->adiciona($this->getId(), $prod->id, 1);
			}
		}
	}

	public function setValor($valor)
	{
		$this->valor = $valor;
		return $this;
	}

	public function getValor()
	{
		return $this->valor;
	}

	public function setStatusPagamento($status)
	{
		$this->status_pagamento = $status;
		return $this;
	}

	public function getStatusPagamento()
	{
		return $this->status_pagamento;
	}

	public function setLinkPagamento($link)
	{
		$this->link_pagamento = $link;
		return $this;
	}

	public function getLinkPagamento()
	{
		return $this->link_pagamento;
	}

	public function setUf($uf)
	{
		$this->uf = $uf;
		return $this;
	}

	public function getUf()
	{
		return $this->uf;
	}

	public function setCep($cep)
	{
		$this->cep = $cep;
		return $this;
	}

	public function getCep()
	{
		return $this->cep;
	}

	public function setCidade($cidade)
	{
		$this->cidade = $cidade;
		return $this;
	}

	public function getCidade()
	{
		return $this->cidade;
	}

	public function setBairro($bairro)
	{
		$this->bairro = $bairro;
		return $this;
	}

	public function getBairro()
	{
		return $this->bairro;
	}

	public function setLogradouro($logradouro)
	{
		$this->logradouro = $logradouro;
		return $this;
	}

	public function getLogradouro()
	{
		return $this->logradouro;
	}

	public function setNumero($numero)
	{
		$this->numero = $numero;
		return $this;
	}

	public function getNumero()
	{
		return $this->numero;
	}

	public function setComplemento($complemento)
	{
		$this->complemento = $complemento;
		return $this;
	}

	public function getComplemento()
	{
		return $this->complemento;
	}

	public function setTipoPagamento($tipo)
	{
		$this->tipoPagamento = $tipo;
		return $this;
	}

	public function getTipoPagamento()
	{
		return $this->tipoPagamento;
	}

	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;
		return $this;
	}

	public function getUsuario()
	{
		return $this->usuario;
	}

	public function getDhCadastro() 
	{
		return $this->dh_cadastro;
	}

	public function setDhCadastro($dhCadastro) 
	{
		$this->dh_cadastro = Util::formataData($dhCadastro);
		return $this;
	}
}
