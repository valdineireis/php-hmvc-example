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
?>
