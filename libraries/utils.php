<?php

require_once('models/User.php');

function openSession($mail, $password){

    if($mail !== "" && $password !== "")
    {
        $UserModel = new User();
        $count = $UserModel->verifCorrect($mail, $password);

        $UserModel = new User();
        $suppr =$UserModel->verifSuppr($mail, $password);

        if(($count!=0) && ($suppr==0)) // nom d'utilisateur et mot de passe corrects (et compte pas supprimé)
        {
            $UserModel = new User();
            $id_user = $UserModel->getUserConnexion($mail, $password);
            session_start();
            $_SESSION['id_user'] = $id_user;           
            header('Location: ../liste.php');
        }
        else
        {
            header('Location: ../accueil.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
        header('Location: ../accueil.php'); // utilisateur ou mot de passe vide
    }
}

function closeSession(){
    session_destroy();
    header('Location: ../accueil.php');
}


////////////////////////


function inscription($nom, $prenom, $mail, $password, $confirm){


    if( ($nom !== "") && ($prenom !== "") && ($mail !== "") && ($password !== "") && ($confirm !== "") )
    {
        
        if( (strlen($password)>=5) && ($confirm == $password) ) 
        {
            $word1 = "@";
            $word2 = ".";

            if ( (strpos($mail, $word1) !== false) && (strpos($mail, $word2) !== false) )
            {

                $ModelUser = new User();
                $countMail = $ModelUser->verifMail($mail);

                if ($countMail==0)
                {

                    $UserModel = new User();
                    $UserModel->create($nom, $prenom, $mail, $password);
                
                    session_start();

                    $UserModel = new User();
                    $id_user = $UserModel->getLatest();

                    $_SESSION['id_user'] = $id_user;
                    header('Location: ../liste.php');

                }
                else
                {
                    header('Location: ../accueil.php?erreur=5'); // mail déjà existant
                }
            }
            else
            {
                header('Location: ../accueil.php?erreur=4'); // mail invalide
            }   
        }
        else 
        {
        header('Location: ../accueil.php?erreur=3'); // mot de passe invalide
        }
    }
    else 
    {
    header('Location: ../accueil.php?erreur=2'); // Au moins un champs vide
    }
}

///////////////////////////////////

function updateProfil($modifier, $supprimer, $nom, $prenom, $mail, $password, $confirmPassword, $avatar, $avatarLien){


    if (isset($modifier)) {
    
        $ModelUser = new User();
        $countMail = $ModelUser->verifMail($mail);
    
        if ( (($nom != "") && (strlen($nom)<20)) ){
            $ModelUser = new User();
            $ModelUser->updateNom($nom); // On met à jour le nom
        }
    
        if ( ($prenom != "") && (strlen($prenom)<20) ){  // On met à jour le prénom
            $ModelUser = new User();
            $ModelUser->updatePrenom($prenom);
        }

        $word1 = "@";
        $word2 = ".";
    
        if ( ($mail != "") && ($countMail == 0) && ((strpos($mail, $word1) !== false) && (strpos($mail, $word2) !== false)) ){
            
            $ModelUser = new User();
            $ModelUser->updateMail($mail); // On met à jour le mail

            $err1=0;
        }
        elseif($countMail != 0){
            $err1=1;
        }
    
        if ( ($password == $confirmPassword) && ($password != "") && (strlen($password)>=5) ){
            
            $ModelUser = new User();
            $ModelUser->updatePassword($password); // On met à jour le mdp

            $err2=0;
        }
        elseif( ($password != $confirmPassword) && (strlen($password)<5) && (strlen($password)>=1) ) 
        {
            $err2=2;
        }

        if($avatar){
			$avatarLien = preg_replace('/[^A-Za-z0-9 \.\-_]/', '', $avatarLien); // On remplace les caractères non-alphanumériques du nom du fichier
	
			$dest =__DIR__.'/../IMAGES/avatars/'.$avatarLien;
			move_uploaded_file($avatar, $dest); // On enregistre notre fichier dans le bon dossier ! Dans le cas où l'image enregistrée a le meme nom qu'une image déjà existante, l'ancienne sera écrasée.
            
            $ModelUser = new User();
            $ModelUser->updateAvatar($avatarLien); // On met à jour l'avatar
		}

        $err = $err1 + $err2;

        if($err==0)
        {
            header('Location: ../profil.php');
        }
        elseif($err==1)
        {
            header('Location: ../profil.php?erreur=1');
        }
        elseif($err==2)
        {
            header('Location: ../profil.php?erreur=2');
        }
        else
        {
            header('Location: ../profil.php?erreur=3');
        }
        
    
    }
    
    elseif (isset($supprimer)) {
    
        $ModelUser = new User();
        $ModelUser->supprimer();

        closeSession();
    
    }
}

///////////////////////////////

function startHtml($css){
    echo
    '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plumo</title>
        <link rel="stylesheet" href="CSS/'.$css.'.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="JS/script.js"></script>
    </head>
    <body onload="uploadAvatar();" style="margin:0px;">';

}

function endHtml(){

    echo
    '</body>
    </html>';
}

function pageHeader(){
    
    echo
    '<header>
        <div class="logo">
            <a href="liste.php"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 548.44 135.82"><defs><style>.cls-1{fill:url(#Dégradé_sans_nom_46);}.cls-2{fill:url(#Dégradé_sans_nom_45);}.cls-3{fill:#1572ff;}</style><linearGradient id="Dégradé_sans_nom_46" x1="413.36" y1="67.91" x2="548.44" y2="67.91" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1572ff"/><stop offset="1" stop-color="#3fff9c"/></linearGradient><linearGradient id="Dégradé_sans_nom_45" x1="446.75" y1="67.91" x2="515.05" y2="67.91" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff"/><stop offset="1" stop-color="#fff"/></linearGradient></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1" d="M413.51,58.52a56.56,56.56,0,0,1,3.42-15.89A62.44,62.44,0,0,1,439.5,13.22a71.75,71.75,0,0,1,62.59-10c14.09,4.41,25.78,12.31,34.55,24.25a58.64,58.64,0,0,1,11.53,41.22,56.77,56.77,0,0,1-3.93,16.22,62.61,62.61,0,0,1-20,26.35,2.21,2.21,0,0,0-1,2c0,7.19,0,14.38,0,21.57a3,3,0,0,1-.07,1,2,2,0,0,1-.88-.38q-10.68-5.88-21.35-11.79a1.77,1.77,0,0,0-1.45-.18,72.4,72.4,0,0,1-24.61,2.18,70.27,70.27,0,0,1-14.81-2.79,66.52,66.52,0,0,1-32.85-21.68A59,59,0,0,1,413.51,58.52Z"/><path class="cls-2" d="M514.81,37.39c.65,5,.06,9.76-3.11,14a2.22,2.22,0,0,1-3,.92,19.75,19.75,0,0,0-9.49-.55A28.83,28.83,0,0,1,509,55.58a64,64,0,0,1-14,6c-.79.23-1.77-.24-2.67-.4a18.71,18.71,0,0,0-9,.4,18.3,18.3,0,0,1,7.94,2.28c-2.53,1.76-4.71,3.59-7.94,3.71a17.29,17.29,0,0,0-8.81,3.22c2.64.63,5-1,7.82.19-5,3-8.23,7.6-14,9.14C460.52,82.2,455.5,88,451.44,94.6a11.28,11.28,0,0,0-1.22,2.23,3.8,3.8,0,0,1-3.47,2.67c.39-2.44,1.91-4.37,3.06-6.44,3.77-6.78,7.71-13.46,11.53-20.21a90.81,90.81,0,0,1,21.91-26.44,45.75,45.75,0,0,1,13.67-8c3.08-1.05,6.16-2.48,9.6-2a58.44,58.44,0,0,0-10.78,4.42,72.16,72.16,0,0,0-24.28,21.64,5.81,5.81,0,0,0-1.57,2.12,3,3,0,0,0,2.24-1.71.15.15,0,0,0,.14-.17l.1,0,0-.08.37-.45.28-.39a71.91,71.91,0,0,1,8.1-7.6,107.15,107.15,0,0,1,14.22-10,130.09,130.09,0,0,1,14.51-6.78c1.17-.3,2.36-.54,3.51-.92C514.26,36.19,514.65,36.54,514.81,37.39Z"/><path class="cls-3" d="M76.58,61.65a44.08,44.08,0,0,1-3.76,18.46,47.9,47.9,0,0,1-10.6,15.21,48.64,48.64,0,0,1-15.56,10.43,52,52,0,0,1-19.31,3.93v9.06c0,5.64-3.59,9.23-9.06,9.23h-8C4.1,128,0,123.87,0,117.72v-94c0-6.15,4.1-10.25,10.26-10.25H27.35a52.08,52.08,0,0,1,19.31,4.1A51.77,51.77,0,0,1,62.22,28a47.9,47.9,0,0,1,10.6,15.21A45.23,45.23,0,0,1,76.58,61.65ZM27.35,83.36a25.23,25.23,0,0,0,8.55-2,27.79,27.79,0,0,0,7-4.62,24.17,24.17,0,0,0,4.62-6.83,22.63,22.63,0,0,0,0-16.41,24.08,24.08,0,0,0-4.62-6.84,28.4,28.4,0,0,0-7-4.79,25,25,0,0,0-8.55-1.88Z"/><path class="cls-3" d="M149.22,128H98.8c-6.16,0-10.26-4.1-10.26-10.25V23.53c0-6.15,4.1-10.25,10.26-10.25h6.83c6.16,0,10.26,4.1,10.26,10.25v78.12h33.33c6.16,0,10.26,4.1,10.26,10.25v5.82C159.48,123.87,155.38,128,149.22,128Z"/><path class="cls-3" d="M216.57,128A47,47,0,0,1,185,115.66a42,42,0,0,1-9.92-14,39.91,39.91,0,0,1-3.59-16.75V23.53c0-6.15,4.11-10.25,10.26-10.25h6.84c6.15,0,10.25,4.1,10.25,10.25v61.2a16.39,16.39,0,0,0,5.47,12.13,18,18,0,0,0,12.65,4.79,15.92,15.92,0,0,0,6.84-1.54,16.27,16.27,0,0,0,5.64-3.76,16.57,16.57,0,0,0,3.76-5.3,17.2,17.2,0,0,0,1.2-6.67V23.53c0-6.15,4.1-10.25,10.25-10.25h7c6.15,0,10.26,4.1,10.26,10.25V84.21A39.6,39.6,0,0,1,258.62,101a46.56,46.56,0,0,1-9.57,13.85,45.54,45.54,0,0,1-14.36,9.4A48,48,0,0,1,216.91,128Z"/><path class="cls-3" d="M368.53,13.28H380a9.83,9.83,0,0,1,10.26,9.57L395.88,117c.34,6.67-3.59,10.94-10.26,10.94h-6.84a9.77,9.77,0,0,1-10.08-9.57l-2.39-37.26-14.19,40a10.11,10.11,0,0,1-9.57,6.84H329.39a10.12,10.12,0,0,1-9.58-6.84L304.6,79.26,302,118.4c-.52,5.81-4.45,9.57-10.26,9.57h-7c-6.49,0-10.59-4.44-10.25-10.94l6.32-94.18c.34-5.81,4.45-9.57,10.26-9.57h11.45a10.2,10.2,0,0,1,9.57,6.66l23.76,65.13L359,20.12A10.1,10.1,0,0,1,368.53,13.28Z"/></g></g></svg></a>
        </div>

        <div class="form">
            <a href="liste.php">Discussions</a>
            <a href="utilisateurs.php">Utilisateurs</a>
            <a href="profil.php">Mon profil</a>
            <a href="libraries/redirection.php?deconnexion=true">Déconnexion</a>
        </div>
    </header>';
}

function pageFooter(){
    echo
    '<footer>
        <p>Politique d\'utilisation de données</p>
        <p>Conditions</p>
        <p>Politique d\'utilisation des cookies</p>
        <p>© Plumo 2022</p>
    </footer>';
}

function notConnected(){
    echo
    '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plumo</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500&display=swap");

body{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

section{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 200px;
}
p{
    font-family: Fredoka;
    font-weight: 300;
    font-size: 20px;
    
}
a{
    text-decoration: none;
    color: #1572FF;
    font-family: Fredoka;
    font-size: 15px;
    font-weight: 500;
    transition: font-size 0.25s;
}

a:hover{
    font-size: 16px;
}
    </style>
</head>
<body>

    <section>
        <img src="IMAGES/logo-plumo.png" alt="logo" width="300px">
        <p>Vous n\'êtes pas connecté !</p>
        <a href="accueil.php">Par ici pour vous connecter ou vous inscrire.</a>
        
    </section>

</body>
</html>

</body>
</html>';
}
