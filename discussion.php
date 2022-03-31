<?php

require_once('libraries/utils.php');
require_once('libraries/models/User.php');
require_once('libraries/models/Discussion.php');
require_once('libraries/models/Message.php');

$css = "discussion";
session_start();

if(isset($_SESSION['id_user'])){

	$iduser = $_SESSION['id_user'];
	$idconv = $_GET["id"];

		$ModelDiscussion = new Discussion();
		$conv = $ModelDiscussion->get($idconv);
		$user1 = $conv["FK_user1"];
		$user2 = $conv["FK_user2"];

		if($user1 != $_SESSION['id_user'])
		{
			$ModelUser = new User();
			$prenomOther = $ModelUser->getPrenomListe($user1);
			$nomOther = $ModelUser->getNomListe($user1);
			$avatarOther = $ModelUser->getAvatarListe($user1);
		}
		elseif($user2 != $_SESSION['id_user'])
		{
			$ModelUser = new User();
			$prenomOther = $ModelUser->getPrenomListe($user2);
			$nomOther = $ModelUser->getNomListe($user2);
			$avatarOther = $ModelUser->getAvatarListe($user2);
		}

		$ModelUser = new User();
		$prenomUs = $ModelUser->getPrenom();
		$nomUs = $ModelUser->getNom();
		$avatarUs = $ModelUser->getAvatar();
	
	if( ($iduser == $user1) || ($iduser == $user2) )
	{
		startHtml($css);
		pageHeader();
	
		echo
		'<section class="chatbox">
		
			<h1>'.$prenomOther.' '.$nomOther.'</h1>
		
			<section class="chat-window">';

		$ModelMessage = new Message();
		$messages = $ModelMessage->getAll($idconv);
		
		foreach($messages as $msg)
		{

			$text = $msg["msg_text"];
			$time = $msg["msg_time"];
			$deleted = $msg["isDeleted"];

			if($deleted==0)
			{
				if($msg["FK_id_user"]==$_SESSION['id_user'])
				{
					echo
					'<article class="msg-container msg-self" id="msg-0">
						<div class="msg-box">
							<div class="flr">
								<div class="messages">
									<p class="msg" id="msg-1">
										'.$text.'
									</p>
								</div>
								<span class="timestamp"><span class="username">'.$prenomUs.' '.$nomUs.'</span>&bull;<span class="posttime">'.$time.'</span></span>
							</div>
							<img class="user-img" id="user-0" src="IMAGES/avatars/'.$avatarUs.'" />
						</div>
					</article>';
				}
				else
				{
					echo
					'<article class="msg-container msg-remote" id="msg-0">
						<div class="msg-box">
							<img class="user-img" id="user-0" src="IMAGES/avatars/'.$avatarOther.'" />
							<div class="flr">
								<div class="messages">
									<p class="msg" id="msg-0">
									'.$text.'
									</p>
								</div>
								<span class="timestamp"><span class="username">'.$prenomOther.' '.$nomOther.'</span>&bull;<span class="posttime">'.$time.'</span></span>
							</div>
						</div>
					</article>';
				}
			}
		}
		
			
		echo
		'</section>
		
			<form method="post" action="libraries/redirection.php?conv='.$idconv.'" >
				<input type="text" autocomplete="on" placeholder="J\'avais juste envie d\'écrire..." name="message" />
				<button>
					<img src="IMAGES/logo-bulle-svg.svg" alt="logoplumo">
				</button>
			</form>
			
		</section>';

		pageFooter();
		endHtml();
	}
	else
	{
		pasledroit();
	}
		
}
else{
	notConnected();
}

?>