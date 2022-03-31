<?php

require_once('libraries/utils.php');
require_once('libraries/models/User.php');
require_once('libraries/models/Discussion.php');
require_once('libraries/models/Message.php');
$css = "liste";
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
        <h1>Vos messages</h1>

        <a href="utilisateurs.php" class="ajouter">
            <svg class="plus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 124.58 119.68"><defs><style>.cls-1{fill:#1572ff;}</style></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1" d="M124.58,55.49v9.25c0,9.79-6.53,16.32-16.32,16.32H83.78v22.3c0,9.79-6.53,16.32-16.32,16.32H56.58c-9.8,0-16.32-6.53-16.32-16.32V81.06l-23.94-.27C6.53,80.79,0,74.26,0,64.46V55.22C0,45.42,6.53,38.9,16.32,38.9H40.26V16.32C40.26,6.53,46.78,0,56.58,0H67.46c9.79,0,16.32,6.53,16.32,16.32V38.9l24.48.27C118.05,39.17,124.58,45.7,124.58,55.49Z"/></g></g></svg>
            <p>Nouvelle conversation</p>
        </a>';

        $ModelDiscussion = new Discussion();
        $discussions = $ModelDiscussion->getAll();
    
        foreach ($discussions as $discu)
        {
            $id = $discu["id_discussion"];
            $user1 = $discu["FK_user1"];
            $user2 = $discu["FK_user2"];
            $delete = $discu["isDeleted"];

            if($user1 != $_SESSION['id_user'])
            {
                $ModelUser = new User();
                $prenom = $ModelUser->getPrenomListe($user1);
                $nom = $ModelUser->getNomListe($user1);
                $avatar = $ModelUser->getAvatarListe($user1);
            }
            elseif($user2 != $_SESSION['id_user'])
            {
                $ModelUser = new User();
                $prenom = $ModelUser->getPrenomListe($user2);
                $nom = $ModelUser->getNomListe($user2);
                $avatar = $ModelUser->getAvatarListe($user2);
            }
    
            if($delete == 0)
            {
                $ModelMessage = new Message();
                $lastMessage = $ModelMessage->getLatestDisplay($id);
                
            
                $time = $lastMessage["msg_time"];
                $text = $lastMessage["msg_text"];
                if(strlen($text)>100)
                {
                    $text = substr($text, 0, 50)."...";
                }
                

                echo
                '<a href="discussion.php?id='.$id.'" class="groupe">
                    <img src="IMAGES/avatars/'.$avatar.'" alt="image-groupe">
                    <div class="texte">
                        <div class="titre">
                            <h3>'.$prenom.' '.$nom.'</h3>
                            <p>'.$time.'</p>
                        </div>
                        <p>'.$text.'</p>
                    </div>
                </a>';
            }

        }

        $ModelDiscussion = new Discussion();
        $discutotal = $ModelDiscussion->totalDiscussionUsers($_SESSION['id_user']);

        if($discutotal==0)
        {
            echo
            '<div class="rien">
                <p>Aucune conversation...</p>
            </div>';
        }

        '</section>';
        

pageFooter();
endHtml();

}


?>