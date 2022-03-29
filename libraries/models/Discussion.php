<?php

require_once('Model.php');
require_once('Message.php');

class Discussion extends Model
{

    public function totalDiscussion(){
		$requete = "SELECT COUNT(*) FROM discussion WHERE discussion.FK_user1 = :user1 OR discussion.FK_user2 = :user2";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user1",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> bindValue("user2",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		return $reponse[0];
	}

    public function getLatest(){
		$requete = "SELECT id_discussion FROM discussion ORDER BY discussion.date_crea DESC LIMIT 1";
        $action = $this->pdo->prepare($requete);
		$action -> execute();
		$reponse = $action -> fetch();
		$id = $reponse['id_discussion'];
		return $id;
	}

    public function create($user2){
        $isDeleted=0;
		$requete = "INSERT INTO message (`FK_user1`, `FK_user2`, `isDeleted`) VALUES (:user1, :user2,  :deleted)";
		$action = $bdd->prepare($requete);
		$action -> bindValue("user1",$text,PDO::PARAM_STR);
		$action -> bindValue("user2",$this->id_session,PDO::PARAM_STR);
		$action -> bindValue("deleted",$isDeleted,PDO::PARAM_STR);
		$action -> execute();

        $id_discussion = getLatest();
        $defaultText = "Salut ! Discutons un peu...";

        $ModelMessage = new Message();
        $this->ModelMessage->create($defaultText, $id_discussion);
    }

    public function supprimer($id_discussion){
        $requete = "UPDATE discussion SET discussion.isDeleted = 1 WHERE discussion.id_discussion = :discussion";
		$action = $bdd->prepare($requete);
		$action -> bindValue("discussion",$id_discussion,PDO::PARAM_STR);
		$action -> execute();
    }

	public function getAll(){
		$requete = "SELECT * FROM discussion INNER JOIN message ON discussion.id_discussion = message.FK_id_discussion WHERE discussion.FK_user1 = :user OR discussion.FK_user2 = :user ORDER BY message.msg_time ASC";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		$tab = $reponse['*'];
		return $tab;
	}

}


?>
