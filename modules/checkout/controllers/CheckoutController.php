<?php

class CheckoutController extends Controller
{
	private $produtoRepository;

	public function __construct() {
		$this->produtoRepository = new ProdutoRepository();
	}

	public function index() {
		$dados = array();
		$prods = array();

		if (isset($_SESSION['checkout'])) {
			$prods = $_SESSION['checkout'];
		}

		$dados = $this->produtoRepository->selectIn($prods);

		$this->loadView('checkout', $dados);
	}

	public function add($id = '') {
		if (!empty($id)) {
			if (!isset($_SESSION['checkout'])) {
				$_SESSION['checkout'] = array();
			}

			$_SESSION['checkout'][] = $id;

			header("Location: /checkout");
		}
	}
}
