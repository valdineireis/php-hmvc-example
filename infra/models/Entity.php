<?php

abstract class Entity
{
	protected $id;

	protected function getId() {
		return $this->id;
	}

	protected function setId($id) {
		$this->id = $id;
		return $this;
	}
}
