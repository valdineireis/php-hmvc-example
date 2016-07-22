<?php

class PedidosController extends Controller
{
	private $vendaRepository;
	private $produtoRepository;

	public function __construct() 
	{
		$this->vendaRepository = new VendaRepository();
		$this->produtoRepository = new ProdutoRepository();
	}

	public function index() 
	{
		$dados = array();

		if (isset($_SESSION['cliente']) && !empty($_SESSION['cliente'])) {

			$dados['pedidos'] = $this->vendaRepository->getPedidosDoUsuario($_SESSION['cliente']);

			$this->loadTemplate('pedidos', $dados);	
		} else {
			header("Location: /loja/login");
		}
	}

	public function ver($idPedido)
	{
		if (!empty($idPedido)) {
			$dados = array();
			$idPedido = addslashes($idPedido);

			$dados['pedido'] = $this->vendaRepository->getPorId($idPedido, $_SESSION['cliente']);

			if (count($dados['pedido'])) {
				$dados['produtos'] = $this->produtoRepository->getProdutosPorVendaId($idPedido);

				$this->loadTemplate('ver-pedido', $dados);
				exit;
			}
		}

		header("Location: /loja/pedidos");
	}

}
