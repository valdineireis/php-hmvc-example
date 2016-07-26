<?php

abstract class AdminController extends Controller
{
	private $security;

	public function __construct($nomeTemplate = 'admin')
	{
		parent::__construct($nomeTemplate);

		$this->security = new SecurityAdmin(null);

		$this->isAuthenticated();
	}

	private function isAuthenticated()
	{
		if ($this->security->isLogged() == false) {
			header("Location: /painel/login");
		}
	}
}
