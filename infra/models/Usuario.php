<?php

class Usuario extends Entity implements EntityContract
{
	private static $salt = "security_token_201607051606";

	private $nome;
	private $email;
	private $senha;
	private $ativo;
	private $dh_cadastro;

	private $perfis;

	public function __contruct()
	{
		$this->setAtivo(true);
		$this->setDhCadastro(date('d-m-Y H:i:s'));
		$this->perfis = array();
	}

	public final static function getTableName() 
	{
		return "usuarios";
	}

	public function isValido()
	{
		return true;
	}

	public function getNome() 
	{
		return $this->nome;
	}

	public function setNome($nome) 
	{
		$this->nome = addslashes($nome);
		return $this;
	}

	public function getEmail() 
	{
		return $this->email;
	}

	public function setEmail($email) 
	{
		if (!Util::validaEmail($email)) {
			throw new Exception('E-mail inválido!');
		}

		$this->email = $email;
		return $this;
	}

	public function getSenha() 
	{
		return $this->senha;
	}

	public function setSenha($senha) 
	{
		$s = addslashes($senha);
		$this->senha = MD5(self::$salt.$s);
		return $this;
	}

	public function isAtivo() 
	{
		return $this->ativo;
	}

	public function setAtivo($ativo) 
	{
		$this->ativo = $ativo;
		return $this;
	}

	public function getDhCadastro() 
	{
		return $this->dh_cadastro;
	}

	public function setDhCadastro($dhCadastro) 
	{
		$this->dh_cadastro = Util::formataData($dhCadastro);
		return $this;
	}
}
