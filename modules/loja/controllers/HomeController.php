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
		$dados = array(
			"produtos" => $this->produtoRepository->select(0, true)
		);

		$this->loadTemplate('home', $dados);
	}

	public function ver($id = 0)
	{
		if (is_numeric($id) && $id > 0) {

			$dados = array(
				"produto" => $this->produtoRepository->selectById($id)
			);
			//print_r($dados);

			$this->loadTemplate('ver-produto', $dados);

		} else {
			header("Location: /erro");
		}
	}

}
