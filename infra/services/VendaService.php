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
	 * @param VendaRepository $vendaRepository
	 * @param VendaProdutoRepository $vendaProdutoRepository
	 */
	public function __construct($vendaRepository, $vendaProdutoRepository)
	{
		$this->vendaRepository = $vendaRepository;
		$this->vendaProdutoRepository = $vendaProdutoRepository;
	}

	public function registra($venda, $produtos = array())
	{
		global $config;

		if (!is_object($venda) || $venda == null) {
			throw new Exception("Objeto Venda inválido!");
		}

		$this->venda = $venda;

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
			// PagSeguro
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
			$paymentRequest->addParameter("notificationURL", $config["site_path"]."/checkout/notificacao/pagseguro");

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

	public function verificaVendasPagSeguro($notificationCode = '', $notificationType = '')
	{
		require 'infra/libraries/PagSeguroLibrary/PagSeguroLibrary.php';

		if (!empty($notificationCode) && !empty($notificationType)) {
			$notificationCode = trim($notificationCode);
			$notificationType = trim($notificationType);

			$psNotificationType = new PagSeguroNotificationType($notificationType);
			$strType = $psNotificationType->getTypeFromValue();

			$credentials = PagSeguroConfig::getAccountCredentials();

			try {

				$transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
				$ref = $transaction->getReference();
				$status = $transaction->getStatus()->getValues();

				$novoStatus = 0;
				switch ($status) {
					case '1': // Aguardando Pagamento
					case '2': // Em análise
						$novoStatus = '1';
						break;
					case '3': // Pagamento aprovado
					case '4': // Disponível
						$novoStatus = '2';
						break;
					case '6': // Devolvida
					case '7': // Cancelada
						$novoStatus = '3';
						break;
				}

				$this->venda->setStatusPagamento($novoStatus);
				$this->atualizaStatusVenda();

			} catch (PagSeguroServiceException $e) {
				throw new Exception("Erro na verificação da venda. ".$e->getMessage());
			}
		}
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
