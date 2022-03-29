<?php

require_once('utils.php');

if($_POST['conmail']!="" && $_POST['conmdp']!=""){
    $mail = $_POST['conmail'];
    $password = $_POST['conmdp'];
    openSession($mail, $password);
}
elseif($_POST['innom']!="" && $_POST['inprenom']!="" && $_POST['inmail']!="" && $_POST['inmdp1']!="" && $_POST['inmdp2']!=""){
    $nom = $_POST['innom'];
    $prenom = $_POST['inprenom'];
    $mail = $_POST['inmail'];
    $mdp1 = $_POST['inmdp1'];
    $mdp2 = $_POST['inmdp2'];
    inscription($nom, $prenom, $mail, $mdp1, $mdp2);
}
else{
    header('Location: ../accueil.php');
}






?>