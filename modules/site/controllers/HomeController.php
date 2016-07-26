<?php

class HomeController extends Controller
{
	private $usuarioRepository;

	public function __construct() 
	{
		parent::__construct();
		$this->usuarioRepository = new UsuarioRepository();
	}

	public function index() 
	{
		$usuario = new Usuario();
		$usuario->setNome('Valdinei');

		$dados = array(
			'name' => $usuario->getNome(),
			'usuarios' => $this->usuarioRepository->select()
		);

		$this->loadTemplate('home', $dados);
	}

	public function parametros($nome='', $sobrenome='') 
	{
		echo "<br>";
		echo "Nome: ".$nome." ".$sobrenome;
	}
}
