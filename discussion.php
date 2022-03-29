<?php

require_once('libraries/utils.php');
$css = "discussion";
session_start();

$connected = $_SESSION['id_user'];

if($connected==""){
	notConnected();
}
else{

startHtml($css);
pageHeader();

    echo
    '<section class="chatbox">

		<h1>Nom de la personne</h1>

		<section class="chat-window">

			<article class="msg-container msg-remote" id="msg-0">
				<div class="msg-box">
					<img class="user-img" id="user-0" src="IMAGES/avatars/Portrait_Placeholder.png" />
					<div class="flr">
						<div class="messages">
							<p class="msg" id="msg-0">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius, neque non tristique tincidunt, mauris nunc efficitur erat, elementum semper justo odio id nisi.
							</p>
						</div>
						<span class="timestamp"><span class="username">Nom</span>&bull;<span class="posttime">3 minutes ago</span></span>
					</div>
				</div>
			</article>

			<article class="msg-container msg-self" id="msg-0">
				<div class="msg-box">
					<div class="flr">
						<div class="messages">
							<p class="msg" id="msg-1">
								Lorem ipsum dolor sit amet
							</p>
							<p class="msg" id="msg-2">
								Praesent varius
							</p>
						</div>
						<span class="timestamp"><span class="username">Nom</span>&bull;<span class="posttime">2 minutes ago</span></span>
					</div>
					<img class="user-img" id="user-0" src="IMAGES/avatars/Portrait_Placeholder.png" />
				</div>
			</article>

		</section>


		<form action="message.html">
			<input type="text" autocomplete="on" placeholder="J\'avais juste envie d\'écrire..." />
			<button>
                <img src="IMAGES/logo-bulle-svg.svg" alt="">
            </button>
		</form>

		
	</section>';



pageFooter();
endHtml();

}

?>