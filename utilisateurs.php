<?php

require_once('libraries/utils.php');
require_once('libraries/models/User.php');
require_once('libraries/models/Discussion.php');
require_once('libraries/models/Message.php');

   

$css = "utilisateurs";
session_start();

$connected = $_SESSION['id_user'];

if($connected==""){
	notConnected();
}
else{

startHtml($css);
pageHeader();

    echo
    '<section>

    <h1>Liste des utilisateurs</h1>

    <div class="cherche">
        <form action="libraries/redirection.php" method="POST">
            <input type="search" placeholder="Chercher un utilisateur..." name="recherche">
            <i class="fa fa-search"></i>
        </form>
    </div>';

    $recherche = $_GET["recherche"];

    if( !$recherche || ($recherche == "") ) {
        $ModelUser = new User();
        $users = $ModelUser->getAll();
    }
    else {
        $ModelUser = new User();
        $users = $ModelUser->cherche($recherche);
    }

    // $coucou = $_SESSION['id_user'];
    // $bdd=new PDO("mysql:host=localhost;dbname=plumeo;charset=utf8", "louis", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // $requete = "SELECT * FROM user WHERE user.id_user != '".$coucou."' ORDER BY user.nom ASC";
    // $users = $bdd -> query ($requete);
    // echo $users;

    foreach ($users as $user)
    {
        $id = $user['id_user'];
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $avatar = $user['avatar_lien'];

        $ModelDiscussion = new Discussion();
        $discussion = $ModelDiscussion->totalDiscussionUsers($id);
        

        $ModelDiscussion = new Discussion();
        $verif = $ModelDiscussion->verifDiscussion($id);

        $ModelMessage = new Message();
        $message = $ModelMessage->totalMessageUsers($id);

        if($verif==0)
        {
            echo
            '<div class="user">
                <div class="couleur"></div>
                <img src="IMAGES/avatars/'.$avatar.'" alt="portrait">
                <h2>'.$prenom.' '.$nom.'</h2>
                <div class="stats">
                    <div class="discussions">
                        <h3>'.$discussion.'</h3>
                        <p>Discussions</p>
                    </div>
                    <div class="messages">
                        <h3>'.$message.'</h3>
                        <p>Messages</p>
                    </div>
                </div>
                <a href="libraries/redirection.php?user='.$id.'">Envoyer un message</a>
            </div>';
        }
    }

    echo
    '</section>';



pageFooter();
endHtml();

}



?>