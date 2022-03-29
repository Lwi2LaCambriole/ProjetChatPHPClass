<?php

require_once("pdo.php");

class Model {

    protected $pdo;

	public function __construct()
	{
		$this->pdo = getPdo();
	}

}

?>