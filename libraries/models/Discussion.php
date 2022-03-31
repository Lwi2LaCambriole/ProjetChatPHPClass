<?php

require_once('Model.php');
require_once('Message.php');

class Discussion extends Model
{

    public function totalDiscussion()
	{
		$requete = "SELECT COUNT(*) FROM discussion WHERE discussion.FK_user1 = :user1 OR discussion.FK_user2 = :user2";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user1",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> bindValue("user2",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		$discussion = $reponse['COUNT(*)'];
		return $discussion;
	}

	public function verifDiscussion($user)
	{
		$requete = "SELECT COUNT(*) FROM discussion WHERE (discussion.FK_user1 = ".$_SESSION['id_user']." AND discussion.FK_user2 = ".$user.") OR (discussion.FK_user1 = ".$user." AND discussion.FK_user2 = ".$_SESSION['id_user'].")";
		$action = $this->pdo->prepare($requete);
		$action -> execute();
		$reponse = $action -> fetch();
		$discussion = $reponse['COUNT(*)'];
		return $discussion;
	}

	public function totalDiscussionUsers($user){
		$requete = "SELECT COUNT(*) FROM discussion WHERE discussion.FK_user1 = :user1 OR discussion.FK_user2 = :user2";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user1",$user,PDO::PARAM_STR);
		$action -> bindValue("user2",$user,PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		$discussion = $reponse['COUNT(*)'];
		return $discussion;
	}

    public function getLatest(){
		$requete = "SELECT id_discussion FROM discussion ORDER BY discussion.date_crea DESC LIMIT 1";
        $action = $this->pdo->prepare($requete);
		$action -> execute();
		$reponse = $action -> fetch();
		$id = $reponse['id_discussion'];
		return $id;
	}

    public function create($user){
        $isDeleted=0;
		$requete = "INSERT INTO discussion (`FK_user1`, `FK_user2`, `isDeleted`) VALUES (:user1, :user2,  :deleted)";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user1",$_SESSION['id_user'],PDO::PARAM_STR);
		$action -> bindValue("user2",$user,PDO::PARAM_STR);
		$action -> bindValue("deleted",$isDeleted,PDO::PARAM_STR);
		$action -> execute();

		$ModelDiscussion = new Discussion();
        $id_discussion = $ModelDiscussion->getLatest();
        $defaultText = "Salut ! Discutons un peu...";

        $ModelMessage = new Message();
        $ModelMessage->create($defaultText, $id_discussion);

		header('Location: ../discussion.php?id='.$id_discussion.'');
    }

    public function supprimer($id_discussion){
        $requete = "UPDATE discussion SET discussion.isDeleted = 1 WHERE discussion.id_discussion = :discussion";
		$action = $bdd->prepare($requete);
		$action -> bindValue("discussion",$id_discussion,PDO::PARAM_STR);
		$action -> execute();
    }

	public function getAll(){
		$requete = "SELECT * FROM discussion WHERE discussion.FK_user1 = '".$_SESSION['id_user']."' OR discussion.FK_user2 = '".$_SESSION['id_user']."' ORDER BY discussion.date_crea ASC";
		$action = $this->pdo->prepare($requete);
		$action -> execute();
		$reponse = $action -> fetchAll();
		return $reponse;
	}

	public function get($id){
		$requete = "SELECT * FROM discussion WHERE discussion.id_discussion = '".$id."'";
		$action = $this->pdo->prepare($requete);
		$action -> execute();
		$reponse = $action -> fetch();
		return $reponse;
	}

}


?>
