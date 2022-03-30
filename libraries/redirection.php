<?php

require_once('utils.php');
session_start();

if($_POST['connexion']){
    $mail = $_POST['conmail'];
    $password = $_POST['conmdp'];
    openSession($mail, $password);
}

elseif($_POST['inscription']){
    $nom = $_POST['innom'];
    $prenom = $_POST['inprenom'];
    $mail = $_POST['inmail'];
    $mdp1 = $_POST['inmdp1'];
    $mdp2 = $_POST['inmdp2'];
    inscription($nom, $prenom, $mail, $mdp1, $mdp2);
}
elseif($_POST['modifier'] || $_POST['supprimer'])
{

    $modifier = $_POST['modifier'];
    $supprimer = $_POST['supprimer'];

    $nom = $_POST['modifnom'];
    $prenom = $_POST['modifprenom'];
    $mail = $_POST['modifmail'];
    $mdp1 = $_POST['modifmdp1'];
    $mdp2 = $_POST['modifmdp2'];
    $avatar = $_FILES['avatar']['tmp_name'];
    $avatarLien = $_FILES['avatar']['name'];

    updateProfil($modifier, $supprimer, $nom, $prenom, $mail, $mdp1, $mdp2, $avatar, $avatarLien);
}

elseif(isset($_GET['deconnexion'])) { 
    if($_GET['deconnexion']==true) { 
        closeSession();
    }
}
// else
// {
//     header('Location: ../accueil.php');
// }






?>