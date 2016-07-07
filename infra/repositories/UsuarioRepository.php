<?php

class UsuarioRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(Usuario::getTableName());
	}
}
