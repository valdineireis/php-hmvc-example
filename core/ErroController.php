<?php

class ErroController extends Controller
{
	public function index() 
	{
		$dados = array();
		$this->loadTemplate('pagina-nao-encontrada', $dados);
	}
}
