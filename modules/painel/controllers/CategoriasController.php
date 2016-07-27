<?php

class CategoriasController extends AdminController
{
	private $categoriaRepository;

	public function __construct() 
	{
		parent::__construct();
		$this->categoriaRepository = new CategoriaRepository();
	}

	public function index() 
	{
		$dados = array();

		$dados['categorias'] = $this->categoriaRepository->select();

		$this->loadTemplate('categorias', $dados);
	}
}
