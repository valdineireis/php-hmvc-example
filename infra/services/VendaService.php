<?php

class VendaService
{
	/* 
	 * @var Venda $venda Objeto
	 */
	private $venda;

	private $vendaRepository;
	private $vendaProdutoRepository;

	/*
	 * @param Venda $venda Objeto que contém os campos de uma venda
	 * @param VendaRepository $vendaRepository
	 * @param VendaProdutoRepository $vendaProdutoRepository
	 */
	public function __construct($venda, $vendaRepository, $vendaProdutoRepository)
	{
		if (!is_object($venda) || $venda == null) {
			throw new Exception("Objeto venda inválido!");
		}

		$this->venda = $venda;
		$this->vendaRepository = $vendaRepository;
		$this->vendaProdutoRepository = $vendaProdutoRepository;
	}

	public function registra($produtos = array())
	{
		global $config;

		/*
		1 => Aguardando Pgto.
		2 => Aprovado
		3 => Cancelado
		*/
		$this->venda->setStatusPagamento('1');
		$this->venda->setLinkPagamento('');

		// Adiciona a venda no bando de dados
		$this->registraVenda();

		// Verifica a forma de pagamento para integração
		if($this->venda->getTipoPagamento()->getId() == '1') {
			$this->venda->setStatusPagamento('2');
			$this->venda->setLinkPagamento('/checkout/home/obrigado');
		} elseif ($this->venda->getTipoPagamento()->getId() == '2') {
			// Pagseguro
			require 'infra/libraries/PagSeguroLibrary/PagSeguroLibrary.php';

			$paymentRequest = new PagSeguroPaymentRequest();
			
			if (is_array($produtos) && count($produtos) > 0) {
				foreach ($produtos as $prod) {
					$paymentRequest->addItem($prod->id, $prod->nome, 1, $prod->preco);
				}
			}

			$paymentRequest->setCurrency("BRL");
			$paymentRequest->setReference($this->venda->getId());
			$paymentRequest->setRedirectUrl($config["site_path"]."/checkout/home/obrigado");
			$paymentRequest->addParameter("notificationURL", $config["site_path"]."/checkout/home/notificacao");

			try {

				$cred = PagSeguroConfig::getAccountCredentials();
				$this->venda->setLinkPagamento($paymentRequest->register($cred));

			} catch (PagSeguroServiceException $e) {
				throw new Exception("Erro de integração com o PagSeguro. ".$e->getMessage());
			}
		}

		$this->atualizaStatusVenda();
		$this->registraItensVenda($produtos);
	}

	private function registraVenda()
	{
		$vid = $this->vendaRepository->adiciona(
						$this->venda->getTipoPagamento()->getId(), 
						$this->venda->getUsuario()->getId(), 
						$this->venda->getValor(), 
						$this->venda->getStatusPagamento(), 
						$this->venda->getLinkPagamento(), 
						$this->venda->getUf(), 
						$this->venda->getCep(), 
						$this->venda->getCidade(), 
						$this->venda->getBairro(), 
						$this->venda->getLogradouro(), 
						$this->venda->getNumero(), 
						$this->venda->getComplemento()
		);
		$this->venda->setId($vid);
	}

	private function atualizaStatusVenda()
	{
		$this->vendaRepository->atualizaStatus(
				$this->venda->getId(), 
				$this->venda->getStatusPagamento(), 
				$this->venda->getLinkPagamento()
		);
	}

	private function registraItensVenda($produtos = array())
	{
		if (is_array($produtos) && count($produtos) > 0) {
			foreach ($produtos as $prod) {
				$this->vendaProdutoRepository->adiciona($this->venda->getId(), $prod->id, 1);
			}
		}
	}
}
