<?php

abstract class RepositoryBase
{
	protected $db;

	public function __construct() {
		global $config;

		$this->db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		
		// set the PDO error mode to exception
    	$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}
