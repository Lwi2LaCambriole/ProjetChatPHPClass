<?

require_once('Model.php');

class User extends Model
{

	public function getUserConnexion($mail, $password){
		$requete = "SELECT id_user FROM user WHERE mail = '".$mail."' AND password = '".$password."'";
        $exec_requete = mysqli_query($this->pdo,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['id_user'];
		return $id_user;
	}

	public function getLatest(){
		$requete = "SELECT id_user FROM user ORDER BY user.date_crea DESC LIMIT 1";
        $exec_requete = mysqli_query($this->pdo,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['id_user'];
		return $id_user;
	}

	public function verifCorrect($mail, $password){
		$requete = "SELECT count(*) FROM user WHERE pseudo = '".$mail."' AND password = '".$password."' ";
        $exec_requete = mysqli_query($this->pdo,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
		return $count;
	}

	public function verifSuppr($mail, $password){
		$instructionSuppr = "SELECT isDeleted FROM user WHERE id_user = '".$this->id_user."' ";
		$requeteSuppr = mysqli_query($this->pdo,$instructionSuppr);
		$reponseSuppr = mysqli_fetch_array($requeteSuppr);
		$suppr = $reponseSuppr['isDeleted'];
		return $suppr;
	}

	public function getMail(){
		$instructionMail = "SELECT mail FROM user WHERE id_user = '".$this->id_user."' ";
		$requeteMail = mysqli_query($this->pdo,$instructionMail);
		$reponseMail = mysqli_fetch_array($requeteMail);
		$mail = $reponseMail['mail'];
		return $mail;
	}

	public function getNom(){
		$instructionNom = "SELECT nom FROM user WHERE id_user = '".$this->id_user."' ";
		$requeteNom = mysqli_query($this->pdo,$instructionNom);
		$reponseNom = mysqli_fetch_array($requeteNom);
		$nom = $reponseNom['nom'];
		return $nom;
	}

	public function getPrenom(){
		$instructionNom = "SELECT prenom FROM user WHERE id_user = '".$this->id_user."' ";
		$requetePrenom = mysqli_query($this->pdo,$instructionPrenom);
		$reponsePrenom = mysqli_fetch_array($requetePrenom);
		$prenom = $reponsePrenom['prenom'];
		return $prenom;
	}

	public function getDate(){
		$instructionDate = "SELECT date_crea FROM user WHERE id_user = '".$this->id_user."' ";
		$requeteDate = mysqli_query($this->pdo,$instructionDate);
		$reponseDate = mysqli_fetch_array($requeteDate);
		$debut = strtotime(['date_crea']);

		$ajd = strtotime(date("y.m.d"));
		$duree = floor(abs($ajd - $debut) / 86400);
		return $duree;
	}

	public function verifMail($mail){
		$instructionMail = "SELECT count(*) FROM mail where mail = :mail";
		$requeteMail = $this->pdo->prepare($instructionMail);
		$requeteMail -> bindValue("mail",$mail,PDO::PARAM_STR);
		$requeteMail -> execute();
		$reponse = $requeteMail -> fetch();
		$countMail = $reponse['count(*)'];
		return $countMail;
	}

	public function create($nom, $prenom, $mail, $password){
		$isDeleted=0;
		$requete = "INSERT INTO compte (`nom`, `prenom`, `mail`, `password`, `isDeleted`) VALUES (:nom, :prenom, :mail, :pass, :deleted)";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("nom",$nom,PDO::PARAM_STR);
		$action -> bindValue("prenom",$prenom,PDO::PARAM_STR);
		$action -> bindValue("mail",$mail,PDO::PARAM_STR);
		$action -> bindValue("pass",$password,PDO::PARAM_STR);
		$action -> bindValue("deleted",$isDeleted,PDO::PARAM_STR);
		$action -> execute();
	}

	public function updateNom($nom){
		$InstructionNvnom = "UPDATE user SET nom = :nom WHERE id_user = :id";
		$requeteNvnom = $this->pdo->prepare($InstructionNvnom);
		$requeteNvnom -> bindvalue("nom", $nom, PDO::PARAM_STR);
		$requeteNvnom -> bindvalue("id", $this->id_session, PDO::PARAM_STR);
		$requeteNvnom -> execute();
	}

	public function updatePrenom($prenom){
		$InstructionNvprenom = "UPDATE user SET prenom = :prenom WHERE id_user = :id";
		$requeteNvprenom = $this->pdo->prepare($InstructionNvprenom);
		$requeteNvprenom -> bindvalue("prenom", $prenom, PDO::PARAM_STR);
		$requeteNvprenom -> bindvalue("id", $this->id_session, PDO::PARAM_STR);
		$requeteNvprenom -> execute();
	}

	public function updateMail($mail){
		$InstructionNvmail = "UPDATE user SET mail = :mail WHERE id_user = :id";
        $requeteNvmail = $this->pdo->prepare($InstructionNvmail);
        $requeteNvmail -> bindvalue("mail", $mail, PDO::PARAM_STR);
        $requeteNvmail -> bindvalue("id", $this->id_session, PDO::PARAM_STR);
        $requeteNvmail -> execute();
	}

	public function updatePassword($password){
		$InstructionNvpass = "UPDATE user SET password = :pass WHERE id_user = :id";
        $requeteNvpass = $this->pdo->prepare($InstructionNvpass);
        $requeteNvpass -> bindvalue("pass", $password, PDO::PARAM_STR);
        $requeteNvpass -> bindvalue("id", $this->id_session, PDO::PARAM_STR);
        $requeteNvpass -> execute();
	}

	public function updateAvatar($avatar){
		$InstructionNvavatar = "UPDATE user SET user.avatar_lien = :avatar WHERE id_user = :id";
        $requeteNvavatar = $this->pdo->prepare($InstructionNvavatar);
        $requeteNvavatar -> bindvalue("avatar", $avatar, PDO::PARAM_STR);
        $requeteNvavatar -> bindvalue("id", $this->id_session, PDO::PARAM_STR);
        $requeteNvavatar -> execute();
	}

	public function supprimer(){
        $requete = "UPDATE user SET user.isDeleted = 1 WHERE user.id_user = :user";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user",$this->id_session,PDO::PARAM_STR);
		$action -> execute();
    }

	public function getAll(){
		$requete = "SELECT * FROM user WHERE user.id_user != :user ORDER BY user.nom ASC";
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user",$this->id_session,PDO::PARAM_STR);
		$action -> execute();
	}

	public function cherche($recherche){
		$requete = 'SELECT * FROM user WHERE user.nom LIKE "%'.$recherche.'%" OR user.prenom LIKE "%'.$recherche.'%" ORDER BY user.nom ASC';
		$action = $this->pdo->prepare($requete);
		$action -> bindValue("user",$this->id_session,PDO::PARAM_STR);
		$action -> execute();
		$reponse = $action -> fetch();
		return $reponse;
	}

}



?>