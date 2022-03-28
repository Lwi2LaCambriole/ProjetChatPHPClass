<?php

require_once('Model.php');

class Message extends Model
{

    public function totalMessage(){
		$instructionTotal = "SELECT COUNT(*) FROM message INNER JOIN user ON message.FK_id_user = user.id_user WHERE user.id_user = '".$this->id_user."'";
		$requeteTotal = mysqli_query($this->pdo,$instructionTotal);
		$reponseTotal = mysqli_fetch_array($requeteTotal);
		$total = $reponseTotal['COUNT(*)'];
		return $total;
	}

    public function create($text, $id_discussion){
        $isDeleted=0;
		$requete = "INSERT INTO message (`msg_text`, `FK_id_user`, `FK_id_discussion`, `isDeleted`) VALUES (:texte, :user, :discussion, :deleted)";
		$action = $bdd->prepare($requete);
		$action -> bindValue("texte",$text,PDO::PARAM_STR);
		$action -> bindValue("user",$this->id_session,PDO::PARAM_STR);
		$action -> bindValue("discussion",$id_discussion,PDO::PARAM_STR);
		$action -> bindValue("deleted",$isDeleted,PDO::PARAM_STR);
		$action -> execute();
    }

    public function supprimer($id_message){
        $requete = "UPDATE message SET message.isDeleted = 1 WHERE message.FK_id_user = :user";
		$action = $bdd->prepare($requete);
		$action -> bindValue("user",$id_message,PDO::PARAM_STR);
		$action -> execute();
    }

	getAll($id_discussion){
		$requete = "SELECT * FROM message WHERE message.FK_id_discussion = :discussion ORDER BY message.msg_time ASC";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("discussion",$discussion,PDO::PARAM_STR);
		$action -> execute();
	}

}


?>