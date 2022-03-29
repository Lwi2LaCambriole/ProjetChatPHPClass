<?php

require_once('libraries/utils.php');
$css = "accueil";
session_start();

startHtml($css);

echo
'<section>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 548.44 135.82"><defs><style>.cls-1{fill:url(#Dégradé_sans_nom_46);}.cls-2{fill:url(#Dégradé_sans_nom_45);}.cls-3{fill:#1572ff;}</style><linearGradient id="Dégradé_sans_nom_46" x1="413.36" y1="67.91" x2="548.44" y2="67.91" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#1572ff"/><stop offset="1" stop-color="#3fff9c"/></linearGradient><linearGradient id="Dégradé_sans_nom_45" x1="446.75" y1="67.91" x2="515.05" y2="67.91" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff"/><stop offset="1" stop-color="#fff"/></linearGradient></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1" d="M413.51,58.52a56.56,56.56,0,0,1,3.42-15.89A62.44,62.44,0,0,1,439.5,13.22a71.75,71.75,0,0,1,62.59-10c14.09,4.41,25.78,12.31,34.55,24.25a58.64,58.64,0,0,1,11.53,41.22,56.77,56.77,0,0,1-3.93,16.22,62.61,62.61,0,0,1-20,26.35,2.21,2.21,0,0,0-1,2c0,7.19,0,14.38,0,21.57a3,3,0,0,1-.07,1,2,2,0,0,1-.88-.38q-10.68-5.88-21.35-11.79a1.77,1.77,0,0,0-1.45-.18,72.4,72.4,0,0,1-24.61,2.18,70.27,70.27,0,0,1-14.81-2.79,66.52,66.52,0,0,1-32.85-21.68A59,59,0,0,1,413.51,58.52Z"/><path class="cls-2" d="M514.81,37.39c.65,5,.06,9.76-3.11,14a2.22,2.22,0,0,1-3,.92,19.75,19.75,0,0,0-9.49-.55A28.83,28.83,0,0,1,509,55.58a64,64,0,0,1-14,6c-.79.23-1.77-.24-2.67-.4a18.71,18.71,0,0,0-9,.4,18.3,18.3,0,0,1,7.94,2.28c-2.53,1.76-4.71,3.59-7.94,3.71a17.29,17.29,0,0,0-8.81,3.22c2.64.63,5-1,7.82.19-5,3-8.23,7.6-14,9.14C460.52,82.2,455.5,88,451.44,94.6a11.28,11.28,0,0,0-1.22,2.23,3.8,3.8,0,0,1-3.47,2.67c.39-2.44,1.91-4.37,3.06-6.44,3.77-6.78,7.71-13.46,11.53-20.21a90.81,90.81,0,0,1,21.91-26.44,45.75,45.75,0,0,1,13.67-8c3.08-1.05,6.16-2.48,9.6-2a58.44,58.44,0,0,0-10.78,4.42,72.16,72.16,0,0,0-24.28,21.64,5.81,5.81,0,0,0-1.57,2.12,3,3,0,0,0,2.24-1.71.15.15,0,0,0,.14-.17l.1,0,0-.08.37-.45.28-.39a71.91,71.91,0,0,1,8.1-7.6,107.15,107.15,0,0,1,14.22-10,130.09,130.09,0,0,1,14.51-6.78c1.17-.3,2.36-.54,3.51-.92C514.26,36.19,514.65,36.54,514.81,37.39Z"/><path class="cls-3" d="M76.58,61.65a44.08,44.08,0,0,1-3.76,18.46,47.9,47.9,0,0,1-10.6,15.21,48.64,48.64,0,0,1-15.56,10.43,52,52,0,0,1-19.31,3.93v9.06c0,5.64-3.59,9.23-9.06,9.23h-8C4.1,128,0,123.87,0,117.72v-94c0-6.15,4.1-10.25,10.26-10.25H27.35a52.08,52.08,0,0,1,19.31,4.1A51.77,51.77,0,0,1,62.22,28a47.9,47.9,0,0,1,10.6,15.21A45.23,45.23,0,0,1,76.58,61.65ZM27.35,83.36a25.23,25.23,0,0,0,8.55-2,27.79,27.79,0,0,0,7-4.62,24.17,24.17,0,0,0,4.62-6.83,22.63,22.63,0,0,0,0-16.41,24.08,24.08,0,0,0-4.62-6.84,28.4,28.4,0,0,0-7-4.79,25,25,0,0,0-8.55-1.88Z"/><path class="cls-3" d="M149.22,128H98.8c-6.16,0-10.26-4.1-10.26-10.25V23.53c0-6.15,4.1-10.25,10.26-10.25h6.83c6.16,0,10.26,4.1,10.26,10.25v78.12h33.33c6.16,0,10.26,4.1,10.26,10.25v5.82C159.48,123.87,155.38,128,149.22,128Z"/><path class="cls-3" d="M216.57,128A47,47,0,0,1,185,115.66a42,42,0,0,1-9.92-14,39.91,39.91,0,0,1-3.59-16.75V23.53c0-6.15,4.11-10.25,10.26-10.25h6.84c6.15,0,10.25,4.1,10.25,10.25v61.2a16.39,16.39,0,0,0,5.47,12.13,18,18,0,0,0,12.65,4.79,15.92,15.92,0,0,0,6.84-1.54,16.27,16.27,0,0,0,5.64-3.76,16.57,16.57,0,0,0,3.76-5.3,17.2,17.2,0,0,0,1.2-6.67V23.53c0-6.15,4.1-10.25,10.25-10.25h7c6.15,0,10.26,4.1,10.26,10.25V84.21A39.6,39.6,0,0,1,258.62,101a46.56,46.56,0,0,1-9.57,13.85,45.54,45.54,0,0,1-14.36,9.4A48,48,0,0,1,216.91,128Z"/><path class="cls-3" d="M368.53,13.28H380a9.83,9.83,0,0,1,10.26,9.57L395.88,117c.34,6.67-3.59,10.94-10.26,10.94h-6.84a9.77,9.77,0,0,1-10.08-9.57l-2.39-37.26-14.19,40a10.11,10.11,0,0,1-9.57,6.84H329.39a10.12,10.12,0,0,1-9.58-6.84L304.6,79.26,302,118.4c-.52,5.81-4.45,9.57-10.26,9.57h-7c-6.49,0-10.59-4.44-10.25-10.94l6.32-94.18c.34-5.81,4.45-9.57,10.26-9.57h11.45a10.2,10.2,0,0,1,9.57,6.66l23.76,65.13L359,20.12A10.1,10.1,0,0,1,368.53,13.28Z"/></g></g></svg>
<p>Échangez avec vos meilleurs amis.</p>
<p>Sortez votre plus belle plume.</p>
<p>Discutez avec légèreté.</p>
</section>


<!-- /////////////////////////////////////////// -->

<hr class="ligne-co">

<!-- ///////////////////// Section Connexion ////////////////////// -->

<div class="formulaire">

<h1 class="titre-co">Connectez-vous</h1>
<h3 class="soustitre-co"><span class="soustitre1">Pour envoyer une missive à votre dulcinée.</span></h3>

<form method="post" action="libraries/redirection.php">
    <input class="connexion" placeholder="Mail" name="conmail" type="text">
    <input class="connexion" placeholder="Mot de passe" name="conmdp" type="password">';

if($_GET['erreur']==1){
    echo
    '<p>Erreur : Identifiants incorrects</p>';
}

    echo
    '<input class="btn-co" type="submit" value="connexion">
    
</form>
</div>


<!-- /////////////////////////////////////////// -->

<hr class="ligne-in">

<!-- ///////////////////// Section Inscription ////////////////////// -->

<div class="formulaire">

<h1 class="titre-in">Inscrivez-vous</h1>
<h3 class="soustitre-in"><span class="soustitre2">Pas de nouvelles, mauvaises nouvelles !</span></h3>

<form method="post" action="libraries/redirection.php">
    <input class="inscription" placeholder="Nom" name="Nom" type="text">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="inscription" placeholder="Prénom" name="Prénom" type="text">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="inscription" placeholder="E-mail" name="E-mail" type="text">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="inscription" placeholder="Mot de passe" name="mdp1" type="password">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="inscription" placeholder="Confirmer" name="mdp2" type="password">
    <p>Erreur : izdqjozjqdoij</p>
    <input class="btn-in" type="submit" value="Inscription">
</form>


</div>

<!-- /////////////////////////////////////////// -->

<div class="header">
<div class="inner-header flex"></div> 
<div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto"><defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs><g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(85, 219, 255,0.6" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(98, 228, 161,0.4)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(21, 114, 255, 0.8)" />
        </g>
    </svg>
</div>  
</div>';


pageFooter();
endHtml();


?>