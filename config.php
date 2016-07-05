<?php
require 'environment.php';

global $config;

$config = array();

if (ENVIRONMENT == 'development') {
	$config['dbname'] = 'pdo';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	$config['dbname'] = 'pdo';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}
?>
