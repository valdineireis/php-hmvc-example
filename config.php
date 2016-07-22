<?php
require 'environment.php';

global $config;

$config = array();

if (ENVIRONMENT == 'development') {
	$config['site_path'] = 'http://localhost:8000';
	$config['dbname'] = 'pdo';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	$config['site_path'] = 'http://localhost:8000';
	$config['dbname'] = 'pdo';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

$config['status_pagamento'] = array(
	'1' => 'Aguardando Pgto.',
	'2' => 'Aprovado',
	'3' => 'Cancelado'
);
?>
