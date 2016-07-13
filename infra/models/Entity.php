<?php

abstract class Entity
{
	protected $id;

	public function getId() 
	{
		return $this->id;
	}

	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}
}
