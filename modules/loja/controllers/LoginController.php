<?php

class LoginController extends Controller
{
	private $usuarioRepository;

	public function __construct() 
	{
		$this->usuarioRepository = new UsuarioRepository();
	}

	public function index() 
	{
		$dados = array(
			'aviso' => ''
		);

		if (isset($_POST['email']) && !empty($_POST['email'])) {

			$usuario = new Usuario();
			$usuario->setEmail($_POST['email'])
					->setSenha($_POST['senha']);

			if ($this->usuarioRepository->isAutenticado($usuario->getEmail(), $usuario->getSenha())) {
				$_SESSION['cliente'] = $this->usuarioRepository->getId($usuario->getEmail());
				header("Location: /loja/pedidos");
			} else {
				$dados['aviso'] = "Email e/ou senha não estão corretos!";
			}

		}

		$this->loadTemplate('login', $dados);
	}

	public function logout()
	{
		unset($_SESSION['cliente']);
		header("Location: /loja/login");
	}

}
