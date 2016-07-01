<?php

class HomeController extends Controller
{
	public function index() {
		$dados = array(
			'name' => 'fotos'
		);

		$this->loadView('home', $dados);
	}
}
