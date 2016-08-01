<?php

class ProdutosController extends AdminController
{
	private $produtoRepository;

	public function __construct() 
	{
		parent::__construct();
		$this->produtoRepository = new ProdutoRepository();
	}

	public function index() 
	{
		$dados = array();
		$offset = 0;
		$limit = 10;

		if (isset($_GET['p']) && !empty($_GET['p'])) {
			$p = addslashes($_GET['p']);
			$offset = ($limit * $p) - $limit;
		}

		$dados['total_produtos'] = $this->produtoRepository->totalRows();
		$dados['limit_produtos'] = $limit;
		$dados['produtos'] = $this->produtoRepository->select($offset, $limit);

		$this->loadTemplate('produtos', $dados);
	}

	/*
	public function add()
	{
		$dados = array();

		if(isset($_POST['nome'])) {

			$categoria = new Categoria();
			$categoria->setNome($_POST['nome']);

			$this->categoriaRepository->adiciona($categoria->getNome());

			header("Location: /painel/categorias");
		}

		$this->loadTemplate('categorias_add', $dados);
	}

	public function edit($id)
	{
		$dados = array();

		if(isset($_POST['nome']) && is_numeric($id) && $id > 0) {

			$categoria = new Categoria();
			$categoria->setNome($_POST['nome']);

			$this->categoriaRepository->edita($categoria->getNome(), $id);

			header("Location: /painel/categorias");
		}

		$dados['categoria'] = $this->categoriaRepository->getById($id);

		$this->loadTemplate('categorias_edit', $dados);
	}

	public function remove($id)
	{
		if (is_numeric($id) && $id > 0) {
			$this->categoriaRepository->removeCategoria($id);
		}

		header("Location: /painel/categorias");
	}
	*/
}
