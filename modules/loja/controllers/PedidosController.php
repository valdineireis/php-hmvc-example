<?php

class PedidosController extends Controller
{
	public function __construct() 
	{
	}

	public function index() 
	{
		$dados = array();

		if (isset($_SESSION['cliente']) && !empty($_SESSION['cliente'])) {
			$this->loadTemplate('pedidos', $dados);			
		} else {
			header("Location: /loja/login");
		}
	}

}
