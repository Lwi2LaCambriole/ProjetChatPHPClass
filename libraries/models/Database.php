<?php 

class Database {

    public function getPdo(){
        $pdo = new PDO('mysql:host=localhost;dbname=plumeo', 'louis', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    }

}

?>