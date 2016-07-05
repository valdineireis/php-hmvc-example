<?php

class HomeController extends Controller
{
	private $usuarioRepository;

	public function __construct() {
		$this->usuarioRepository = new UsuarioRepository();
	}

	public function index() {
		$usuario = new Usuario();
		$usuario->setName('Valdinei');

		$dados = array(
			'name' => $usuario->getName(),
			'usuarios' => $this->usuarioRepository->selectAll()
		);

		$this->loadTemplate('home', $dados);
	}

	public function parametros($nome, $sobrenome) {
		echo "<br>";
		echo "Nome: ".$nome." ".$sobrenome;
	}
}
