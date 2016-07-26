<?php

class NotificacaoController extends Controller
{
	private $vendaRepository;
	private $vendaProdutoRepository;

	public function __construct() 
	{
		parent::__construct();

		$this->vendaRepository = new VendaRepository();
		$this->vendaProdutoRepository = new VendaProdutoRepository();
	}

	public function pagseguro()
	{
		if (isset($_POST['notificationCode']) && isset($_POST['notificationType'])) {
			$vendaService = new VendaService($this->vendaRepository, $this->vendaProdutoRepository);
			$vendaService->verificaVendasPagSeguro($_POST['notificationCode'], $_POST['notificationType']);
		}
	}

}
