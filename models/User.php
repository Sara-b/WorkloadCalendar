<?php
  class User {
    
	static function all() {
		global $bdd;

		$requete = $bdd->prepare("SELECT * FROM user");
		// l'execution 
		$requete->execute();
		$users = $requete->fetchAll();

		return $users;
    }

    static function getUser($id) {
		global $bdd;
	
		$requete = $bdd->prepare("SELECT * FROM user WHERE id=:id");
		// l'execution 
		$requete->bindParam(':id', $id);
		$requete->execute();
		$user = $requete->fetch();
		
		return $user;
    }

    static function getCurrentUser($id) {
		global $bdd;

		$requete = $bdd->prepare('SELECT * FROM user WHERE id=:id'); 
		// l'execution 
		$requete->bindParam(':id', $id);
		$requete->execute();

		$user = $requete->fetch(); 
			$_SESSION['id']=$user['id'];
			$_SESSION['email']=$user['email'];

		return $user;
    }

    static function getUserByPromotion($promotion_id) {
		global $bdd;

		$requete = $bdd->prepare('SELECT * FROM user WHERE promotion_id=promotion_id'); 
			// l'execution 
		$requete->bindParam(':promotion_id', $promotion_id);
		$requete->execute();

		$users = $requete->fetch(); 
			$_SESSION['id']=$user['id'];
			$_SESSION['email']=$user['email'];

		return $users;
    }
	
	static function updateUser($param){
		global $bdd;

		$requete = $bdd->prepare("UPDATE user
								SET email=:email,password=:password,first_name=:first_name,last_name=:last_name
								WHERE id=:id");
		// l'execution 
		$requete->bindParam(':mail', $param['mail']);
		$requete->bindParam(':password', $param['password']);
		$requete->bindParam(':first_name', $param['first_name']);
		$requete->bindParam(':last_name', $param['last_name']);
		$requete->bindParam(':id', $param['id']);
		$requete->execute();

	}
	
	static function connexion($email, $password){
		global $bdd;
		
		//on passe par le formulaire
		if(isset($email) AND $email!="" AND isset($password) AND $password!="") // On a le pseudo et mdp
		  {
			// On récupère tout le contenu de la table 
			$req = $bdd->prepare('SELECT * FROM user WHERE email=:email AND password=:password'); 
			//on passe en paramètre de la requete nos variables $_POST
			$req->execute(array(
			  'email' => $email,
			  'password' => $password
			  ));
			if($donnees=$req->fetchAll()){  
			$_SESSION['id']=$donnees[0]['id'];
			$_SESSION['email']=$donnees[0]['email'];
			return $_SESSION['id'];
			}
			else return false;
			  
			}else{
			  return false;
			}
		  
	}

  }
?>