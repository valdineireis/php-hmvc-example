<?php

class UsuarioRepository extends RepositoryBase
{
	public function __construct() {
		parent::__construct();
	}

	public function select($quantidade = 0) {
		$sql = "SELECT * FROM usuarios ";

		if ($quantidade > 0) {
			$sql .= "LIMIT ".$quantidade;
		}

		$sql = $this->db->query($sql);

		$usuarios = array();

		if ($sql->rowCount() > 0) {
			$usuarios = $sql->fetchAll(PDO::FETCH_OBJ);
		}

		return $usuarios;
	}
}
