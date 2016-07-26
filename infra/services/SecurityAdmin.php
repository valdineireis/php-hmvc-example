<?php

class SecurityAdmin
{
	private $usuarioRepository;

	public function __construct($usuarioRepository) 
	{
		$this->usuarioRepository = $usuarioRepository;
	}

	public function login($email, $senha)
	{
		if (!empty($email) && !empty($senha)) {

			$usuario = new Usuario();
			$usuario->setEmail($email)
					->setSenha($senha);

			$uid = $this->usuarioRepository->login($usuario->getEmail(), $usuario->getSenha());

			if ($uid > 0) {
				$_SESSION['admlogin'] = $uid;
			} else {
				throw new Exception('Usuário e/ou senha inválidos!');
			}
		}
	}

	public function isLogged()
	{
		if (isset($_SESSION['admlogin']) && !empty($_SESSION['admlogin'])) {
			return true;
		}
		return false;
	}

	public function logout()
	{
		unset($_SESSION['admlogin']);
	}
}
