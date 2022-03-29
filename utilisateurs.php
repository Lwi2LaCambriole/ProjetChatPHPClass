<?php

require_once('libraries/utils.php');
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
        <form action="">
            <input type="search" placeholder="Chercher un utilisateur...">
            <i class="fa fa-search"></i>
        </form>
    </div>

    <div class="user">
        <div class="couleur"></div>
        <img src="IMAGES/avatars/Portrait_Placeholder.png" alt="portrait">
        <h2>Guillaume Le Goff</h2>
        <div class="stats">
            <div class="discussions">
                <h3>12</h3>
                <p>Discussions</p>
            </div>
            <div class="messages">
                <h3>1000</h3>
                <p>Messages envoyés</p>
            </div>
        </div>
        <a href="message.html">Envoyer un message</a>
    </div>

    <div class="user">
        <div class="couleur"></div>
        <img src="IMAGES/avatars/Portrait_Placeholder.png" alt="portrait">
        <h2>Alexandre Schaeffer</h2>
        <div class="stats">
            <div class="discussions">
                <h3>12</h3>
                <p>Discussions</p>
            </div>
            <div class="messages">
                <h3>1000</h3>
                <p>Messages envoyés</p>
            </div>
        </div>
        <a href="message.html">Envoyer un message</a>
    </div>

    <div class="user">
        <div class="couleur"></div>
        <img src="IMAGES/avatars/Portrait_Placeholder.png" alt="portrait">
        <h2>Louis Raillard</h2>
        <div class="stats">
            <div class="discussions">
                <h3>12</h3>
                <p>Discussions</p>
            </div>
            <div class="messages">
                <h3>1000</h3>
                <p>Messages envoyés</p>
            </div>
        </div>
        <a href="message.html">Envoyer un message</a>
    </div>

    </section>';



pageFooter();
endHtml();

}



?>