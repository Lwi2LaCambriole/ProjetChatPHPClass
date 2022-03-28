<?php

require_once('Database.php');

class Model extends Database {

    protected $pdo;

	public function __construct()
	{
		$this->pdo = getPdo();
        $this->id_session = $_SESSION['id_user'];
	}

}

?>