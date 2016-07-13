<?php

class HomeController extends Controller
{
	private $produtoRepository;
	private $tipoPagamentoRepository;
	private $usuarioRepository;

	public function __construct() 
	{
		$this->produtoRepository = new ProdutoRepository();
		$this->tipoPagamentoRepository = new TipoPagamentoRepository();
		$this->usuarioRepository = new UsuarioRepository();
	}

	public function index()
	{
		$dados = array();
		$prods = array();

		if (isset($_SESSION['checkout'])) {
			$prods = $_SESSION['checkout'];
		}

		$dados["produtos"] = $this->produtoRepository->selectIn($prods);

		$this->loadTemplate('checkout', $dados);
	}

	public function add($id = 0)
	{
		if (is_numeric($id) && $id > 0) {
			if (!isset($_SESSION['checkout'])) {
				$_SESSION['checkout'] = array();
			}

			$_SESSION['checkout'][] = addslashes($id);
		}

		header("Location: /checkout");
	}

	public function remove($id = 0)
	{
		if (is_numeric($id) && $id > 0) {
			
			foreach ($_SESSION['checkout'] as $chave => $valor) {
				if ($id == $valor) {
					unset($_SESSION['checkout'][$chave]);
				}
			}

		}

		header("Location: /checkout");
	}

	public function finalizar() 
	{
		$dados = array(
			'pagamentos' => array(),
			'total' => 0,
			'erro' => '',
			'form' => array()
		);
		$prods = array();

		$dados['tipos_pagamentos'] = $this->tipoPagamentoRepository->select();

		if (isset($_SESSION['checkout'])) {
			$prods = $_SESSION['checkout'];
		}

		if (count($prods) > 0) {
			$dados['produtos'] = $this->produtoRepository->selectIn($prods);

			foreach ($dados['produtos'] as $prod) {
				$dados['total'] += $prod->preco;
			}
		}

		$this->finalizarCompra($dados);

		$this->loadTemplate('finalizar_compra', $dados);
	}

	public function obrigado()
	{
		$this->loadTemplate('obrigado', array());
	}

	private function finalizarCompra(&$dados)
	{
		if (isset($_POST['usuario_nome']) && !empty($_POST['usuario_nome'])) {

			try {
				$uid = 0;
				$usuario = new Usuario();
				$usuario->setNome($_POST['usuario_nome'])
						->setEmail($_POST['usuario_email'])
						->setSenha($_POST['usuario_senha']);

				if ($this->usuarioRepository->isExiste($usuario->getEmail())) {
					if ($this->usuarioRepository->isAutenticado($usuario->getEmail(), $usuario->getSenha())) {
						$uid = $this->usuarioRepository->getId($usuario->getEmail());
						$usuario->setId($uid);
					} else {
						throw new Exception("Usuário e/ou senha inválidos!");
					}
				} else {
					$uid = $this->usuarioRepository->adiciona($usuario->getNome(), $usuario->getEmail(), $usuario->getSenha());
					$usuario->setId($uid);
				}

				if ($uid > 0) {
					$subtotal = 0;
					$prods = array();

					if (isset($_SESSION['checkout'])) {
						$prods = $_SESSION['checkout'];
					}

					if (count($prods)) {
						$prods = $this->produtoRepository->selectIn($prods);

						foreach ($prods as $prod) {
							$subtotal += $prod->preco;
						}
					}

					$tipoPagamento = new TipoPagamento();
					$tipoPagamento->setId($_POST['tipo_pg']);

					$venda = new Venda();
					$venda->setCep($_POST['endereco_cep'])
						  ->setUf($_POST['endereco_uf'])
						  ->setCidade($_POST['endereco_cidade'])
						  ->setBairro($_POST['endereco_bairro'])
						  ->setLogradouro($_POST['endereco_logradouro'])
						  ->setNumero($_POST['endereco_numero'])
						  ->setComplemento($_POST['endereco_complemento'])
						  ->setTipoPagamento($tipoPagamento)
						  ->setUsuario($usuario)
						  ->setValor($subtotal);

					if ($venda->isValido()) {
						$venda->finaliza($prods);

						$link = $venda->getLinkPagamento();

						unset($_SESSION['checkout']);

						header("Location: ".$link);
					} else {
						throw new Exception("Preencha todos os campos.");
					}
				}

			} catch (Exception $e) {
				$dados['erro'] = $e->getMessage();
				$dados['form'] = array(
					'usuario_nome' => $_POST['usuario_nome'],
					'usuario_email' => $_POST['usuario_email'],
					'endereco_cep' => $_POST['endereco_cep'],
					'endereco_uf' => $_POST['endereco_uf'],
					'endereco_cidade' => $_POST['endereco_cidade'],
					'endereco_bairro' => $_POST['endereco_bairro'],
					'endereco_numero' => $_POST['endereco_numero'],
					'endereco_complemento' => $_POST['endereco_complemento'],
					'tipo_pg' => $_POST['tipo_pg']
				);
			}
		}
	}
}
