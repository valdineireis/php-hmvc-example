<?php

class HomeController extends Controller
{
	public function __construct() 
	{
		parent::__construct('admin');

		$security = new SecurityAdmin(null);

		if ($security->isLogged() == false) {
			header("Location: /painel/login");
		}
	}

	public function index() 
	{
		$dados = array();

		$this->loadTemplate('home', $dados);
	}
}
