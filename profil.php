<?php

require_once('libraries/utils.php');
require_once('libraries/models/Discussion.php');
require_once('libraries/models/Message.php');
require_once('libraries/models/User.php');
session_start();
$css = "profil";

$ModelUser = new User();
$avatar = $ModelUser->getAvatar();
$nom = $ModelUser->getNom();
$prenom = $ModelUser->getPrenom();
$mail = $ModelUser->getMail();
$date = $ModelUser->getDate();

$ModelDiscussion = new Discussion();
$discussions = $ModelDiscussion->totalDiscussion();

$ModelMessage = new Message();
$messages = $ModelMessage->totalMessage();



session_start();

$connected = $_SESSION['id_user'];

if($connected==""){
	notConnected();
}
else{

startHtml($css);
pageHeader();

echo
'<!-- ////////////////// Section Profil ////////////////////// -->

<section>

    <h1>MON PROFIL</h1>

    <img src="IMAGES/avatars/'.$avatar.'" alt="Avatar" class="avatar">

    <p>'.$nom.'</p>
    <p>'.$prenom.'</p>
    <p>'.$mail.'</p>

    <hr class="lignecompte">

    <p>Nombre de messages : <span>'.$messages.'</span></p>
    <p>Nombre de discussions : <span>'.$discussions.'</span></p>
    <p>Compte créé il y a : <span>'.$date.'</span> jours</p>

</section>

<!-- /////////////////////////////////////////// -->

<hr class="lignemodif">

<!-- ////////////////// Section Modifier ////////////////////// -->


<form method="post" action="libraries/redirection.php" enctype="multipart/form-data">
    <h1>MODIFIER MON PROFIL</h1>
    <input class="modif" placeholder="Nom" name="modifnom" type="text">
    <input class="modif" placeholder="Prénom" name="modifprenom" type="text">
    <input class="modif" placeholder="E-mail" name="modifmail" type="text">
    <input class="modif" placeholder="Nouveau mot de passe" name="modifmdp1" type="password">
    <input class="modif" placeholder="Confirmer le mot de passe" name="modifmdp2" type="password">';


    if(isset($_GET['erreur'])){
        if($_GET['erreur']==1){
            echo
            '<p>Erreur : mail indisponible</p>';
        }
        elseif($_GET['erreur']==2){
            echo
            '<p>Erreur : mots de passe non valides</p>';
        }
        elseif($_GET['erreur']==3){
            echo
            '<p>Erreur : mail et mot de passe non valides</p>';
        }
    }

    echo
    '<input id="avatar" name="avatar" type="file" hidden>
    <label for="avatar">Nouvelle photo de profil</label>
    <span id="fichier"></span>

    <input class="btn" type="submit" name="modifier" value="Modifier">
    <input class="btn" id="supprimer" type="submit" name="supprimer" value="Supprimer">
</form>




<!-- /////////////////////////////////////////// -->';

pageFooter();
endHtml();

}

?>