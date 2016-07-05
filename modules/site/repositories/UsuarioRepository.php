<?php

class UsuarioRepository extends RepositoryBase
{
	public function __construct() {
		parent::__construct();
	}

	public function selectAll() {
		$sql = "SELECT * FROM usuarios";
		$sql = $this->db->query($sql);

		return $sql->fetchAll();
	}
}
