<?php

class Usuario extends Entity implements EntityContract
{
	private static $salt = "security_token_201607051606";

	private $name;
	private $email;
	private $senha;
	private $ativo;
	private $dh_cadastro;

	private $perfis;

	public function __contruct() 
	{
		$this->perfis = array();
	}

	public final static function getTableName() 
	{
		return "usuarios";
	}

	public function getName() 
	{
		return $this->name;
	}

	public function setName($name) 
	{
		$this->name = $name;
		return $this;
	}

	public function getEmail() 
	{
		return $this->email;
	}

	public function setEmail($email) 
	{
		$this->email = $email;
		return $this;
	}

	public function getSenha() 
	{
		return $this->senha;
	}

	public function setSenha($senha) 
	{
		$this->senha = MD5(self::$salt.$senha);
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
		$this->dh_cadastro = $dhCadastro;
		return $this;
	}
}
