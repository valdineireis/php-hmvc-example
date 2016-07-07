<?php

class HomeController extends Controller
{
	private $produtoRepository;

	public function __construct() 
	{
		$this->produtoRepository = new ProdutoRepository();
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
}
