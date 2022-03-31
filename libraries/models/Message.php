<?php

require_once('Model.php');

class Message extends Model
{

    public function totalMessage(){
		$requete = "SELECT COUNT(*) FROM message INNER JOIN user ON message.FK_id_user = user.id_user WHERE user.id_user = :user";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		$total = $reponse['COUNT(*)'];
		return $total;
	}

	public function totalMessageUsers($user){
		$requete = "SELECT COUNT(*) FROM message INNER JOIN user ON message.FK_id_user = user.id_user WHERE user.id_user = :user";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user",$user,PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		$total = $reponse['COUNT(*)'];
		return $total;
	}

    public function create($text, $id_discussion){
        $isDeleted=0;
		$requete = "INSERT INTO message (`msg_text`, `FK_id_user`, `FK_id_discussion`, `isDeleted`) VALUES (:texte, :user, :discussion, :deleted)";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("texte",$text,PDO::PARAM_STR);
		$action -> bindValue("user",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> bindValue("discussion",$id_discussion,PDO::PARAM_STR);
		$action -> bindValue("deleted",$isDeleted,PDO::PARAM_STR);
		$action -> execute();
    }

    public function supprimer($id_message){
        $requete = "UPDATE message SET message.isDeleted = 1 WHERE message.FK_id_user = :user";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user", $_SESSION['id_user'],PDO::PARAM_STR);
		$action -> execute();
    }

	public function getLatestDisplay($id_discussion){
		$requete = "SELECT message.msg_text, message.msg_time FROM message WHERE message.FK_id_discussion = :id ORDER BY message.msg_time ASC LIMIT 1";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("id",$id_discussion,PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		return $reponse;
		// Tableau associatif avec en clé msg_text et msg_time
	}

	public function getAll($id_discussion)
	{
		$requete = "SELECT * FROM message WHERE message.FK_id_discussion = :discussion ORDER BY message.msg_time ASC";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("discussion",$discussion,PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		return $reponse;
		// Tableau associatif à double dimensions (foreach...)
		
	}

}


?>