<?php

class UsuarioRepository extends RepositoryBase
{
	public function select($quantidade = 0) {
		$sql = "SELECT * FROM usuarios ";

		if ($quantidade > 0) {
			$sql .= "LIMIT :quantidade";
			$sql = self::getConnection()->prepare($sql);
			$sql->bindParam(':quantidade', $qtd);
			$qtd = $quantidade;
		} else {
			$sql = self::getConnection()->prepare($sql);
		}

		$sql->execute();

		$usuarios = array();

		if ($sql->rowCount() > 0) {
			$usuarios = $sql->fetchAll(PDO::FETCH_OBJ);
		}

		return $usuarios;
	}
}
