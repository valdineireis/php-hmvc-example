<?php

class PagamentoRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(Pagamento::getTableName());
	}
}
