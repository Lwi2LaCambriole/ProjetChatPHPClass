<?php

require_once('Model.php');
require_once('Message.php');

class Discussion extends Model
{

    public function totalForUser(){
		$instructionTotal = "SELECT COUNT(*) FROM discussion JOIN user ON discussion.FK_user1 = user.id_user WHERE user.id_user = '".$this->id_user."' UNION SELECT COUNT(*) FROM discussion JOIN user ON discussion.FK_user2 = user.id_user WHERE user.id_user = '".$id_user."'";
		$requeteTotal = mysqli_query($this->pdo,$instructionTotal);
		$reponseTotal = mysqli_fetch_array($requeteTotal);
		$tab = $reponseTotal['COUNT(*)'];

        $total = array_sum($tab);

		return $total;
	}

    public function getLatest(){
		$requete = "SELECT id_discussion FROM discussion ORDER BY discussion.date_crea DESC LIMIT 1";
        $exec_requete = mysqli_query($this->pdo,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['id_user'];
		return $id_discussion;
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
		$requete = "SELECT * FROM discussion INNER JOIN message ON discussion.id_discussion = message.FK_id_discussion WHERE discussion.FK_user1 = '".$this->id_user."' OR discussion.FK_user2 = '".$this->id_user."' ORDER BY message.msg_time ASC";
		$exec_requete = mysqli_query($this->pdo,$requete);
        $discussions  = mysqli_fetch_array($exec_requete);
		return $discussions;
	}

}


?>
