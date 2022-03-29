<?php

require_once('utils.php');

if($_POST['conmail']!="" && $_POST['conmdp']!=""){
    $mail = $_POST['conmail'];
    $password = $_POST['conmdp'];
    openSession($mail, $password);
}
else{
    header('Location: ../accueil.php');
}




?>