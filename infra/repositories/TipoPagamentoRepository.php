<?php

class TipoPagamentoRepository extends RepositoryBase
{
	public function __construct() 
	{
		parent::__construct(TipoPagamento::getTableName());
	}
}
