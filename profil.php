<?php

require_once('../libraries/utils.php');
$css = "profil";

startHtml($css);
pageHeader();

echo
'<!-- ////////////////// Section Profil ////////////////////// -->

<section>

    <h1>MON PROFIL</h1>

    <img src="../IMAGES/Portrait_Placeholder.png" alt="Avatar" class="avatar">

    <p>Nom</p>
    <p>Prénom</p>
    <p>E-mail</p>

    <hr class="lignecompte">

    <p>Nombre de messages : <span>nombre</span></p>
    <p>Nombre de discussions : <span>nombre</span></p>
    <p>Compte créé il y a : <span>nombre</span> jours</p>

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

?>