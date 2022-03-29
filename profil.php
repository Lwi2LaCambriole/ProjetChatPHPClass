<?php

require_once('libraries/utils.php');
require_once('libraries/models/Discussion.php');
require_once('libraries/models/Message.php');
require_once('libraries/models/User.php');
session_start();
$css = "profil";

$ModelUser = new User();
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

    <img src="IMAGES/avatars/Portrait_Placeholder.png" alt="Avatar" class="avatar">

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


<form method="post">
    <h1>MODIFIER MON PROFIL</h1>
    <input class="modif" placeholder="Prénom" value="Prénom actuel" name="Nom" type="text">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="modif" placeholder="Nom" value="Nom actuel" name="Prénom" type="text">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="modif" placeholder="E-mail" value="E-mail actuel" name="Pseudo" type="text">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="modif" placeholder="Nouveau mot de passe" name="mdp1" type="password">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="modif" placeholder="Confirmer le mot de passe" name="mdp2" type="password">
    <p>Erreur : izdqjozjqdoij</p>

    <input id="avatar" name="uploadAvatar" type="file" hidden>
    <label for="avatar">Nouvelle photo de profil</label>
    <span id="fichier"></span>

    <input class="btn" type="submit" value="Modifier">
    <input class="btn" id="supprimer" type="submit" value="Supprimer">
</form>




<!-- /////////////////////////////////////////// -->';

pageFooter();
endHtml();

}

?>