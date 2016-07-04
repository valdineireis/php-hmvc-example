<?php

class HomeController extends Controller
{
	public function index() {
		$usuario = new Usuario();
		$usuario->setName('Valdinei');

		$dados = array(
			'name' => $usuario->getName()
		);

		$this->loadView('home', $dados);
	}

	public function parametros($nome, $sobrenome) {
		echo "<br>";
		echo "Nome: ".$nome." ".$sobrenome;
	}
}
