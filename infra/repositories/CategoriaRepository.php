<?php

class CategoriaRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(Categoria::getTableName());
	}
}
