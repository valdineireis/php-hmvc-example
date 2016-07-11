<?php

class HomeController extends Controller
{
	private $produtoRepository;
	private $tipoPagamentoRepository;

	public function __construct() 
	{
		$this->produtoRepository = new ProdutoRepository();
		$this->tipoPagamentoRepository = new TipoPagamentoRepository();
	}

	public function index()
	{
		$dados = array();
		$prods = array();

		if (isset($_SESSION['checkout'])) {
			$prods = $_SESSION['checkout'];
		}

		$dados["produtos"] = $this->produtoRepository->selectIn($prods);

		$this->loadTemplate('checkout', $dados);
	}

	public function add($id = 0)
	{
		if (is_numeric($id) && $id > 0) {
			if (!isset($_SESSION['checkout'])) {
				$_SESSION['checkout'] = array();
			}

			$_SESSION['checkout'][] = addslashes($id);
		}

		header("Location: /checkout");
	}

	public function remove($id = 0)
	{
		if (is_numeric($id) && $id > 0) {
			
			foreach ($_SESSION['checkout'] as $chave => $valor) {
				if ($id == $valor) {
					unset($_SESSION['checkout'][$chave]);
				}
			}

		}

		header("Location: /checkout");
	}

	public function finalizar() {
		$dados = array(
			'pagamentos' => array(),
			'total' => 0
		);
		$prods = array();

		$dados['tipos_pagamentos'] = $this->tipoPagamentoRepository->select();

		if (isset($_SESSION['checkout'])) {
			$prods = $_SESSION['checkout'];
		}

		if (count($prods) > 0) {
			$dados['produtos'] = $this->produtoRepository->selectIn($prods);

			foreach ($dados['produtos'] as $prod) {
				$dados['total'] += $prod->preco;
			}
		}

		$this->loadTemplate('finalizar_compra', $dados);
	}
}
