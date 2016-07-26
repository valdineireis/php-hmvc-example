<?php

class LoginController extends Controller
{
	private $usuarioRepository;
	private $security;

	public function __construct() 
	{
		parent::__construct('login');
		$this->usuarioRepository = new UsuarioRepository();
		$this->security = new SecurityAdmin($this->usuarioRepository);
	}

	public function index() 
	{
		$dados = array(
			'aviso' => ''
		);

		if (isset($_POST['email'])) {
			try {
				$this->security->login($_POST['email'], $_POST['senha']);
				header("Location: /painel");
			} catch (Exception $e) {
				$dados['aviso'] = $e->getMessage();
			}
		}

		$this->loadTemplate('login', $dados);
	}

	public function sair()
	{
		$this->security->logout();
		header("Location: /painel/login");
	}
}
