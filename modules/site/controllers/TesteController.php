<?php

class TesteController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		echo "Class TesteController<br>metodo index";
	}
	public function teste() {
		echo "Class TesteController<br>metodo teste";
	}
}
