<?php 
	session_start(); 

	include 'connexion_bdd.php'; //inclusion de la connection à la bdd voir le fichier bdd.php
		
	if(isset($_SESSION['id']) && $_SESSION['id']>0){
		header("location:../index.php");
	}
	//var_dump($_POST);
	//die();

	if(isset($_POST['email']) AND $_POST['email']!="" AND isset($_POST['password']) AND $_POST['password']!="") {
		// je prepare une requete pour recuperer toutes les informations de l'utilisateur, quand le pseudo est egale au pseudo rentré et le passwd égale au passwd rentré.
	    $req = $bdd->prepare('SELECT user.*, promotion.title/*, group.title*/ FROM user 
	    						LEFT JOIN promotion ON user.id_promotion = promotion.id
	    						/*LEFT JOIN group ON promotion.id = group.id_promotion*/
	    						WHERE email=:email 
	    						AND password=:password');  
	    //on passe en paramètre de la requete nos variables $_POST
	    $req->execute(array(
			  'email' => $_POST['email'],
			  'password' => $_POST['password']
			  ));
			if($donnees=$req->fetchAll())
			{  
				//var_dump($donnees);
				//die();
				$_SESSION['id']=$donnees[0]['id'];
				$_SESSION['email']=$donnees[0]['email'];
				$_SESSION['password']=$donnees[0]['password'];
				$_SESSION['first_name']=$donnees[0]['first_name'];
				$_SESSION['last_name']=$donnees[0]['last_name'];
				$_SESSION['role']=$donnees[0]['role'];
				$_SESSION['id_promotion']=$donnees[0]['id_promotion'];
				$_SESSION['promotion']=$donnees[0]['title'];
				$_SESSION['group']=$donnees[0]['group'];
				$_SESSION['specialization']=$donnees[0]['specialization'];
				header('location:../index.php');
			} else
			{
				echo"mauvais logs";
			} 
			  
	}else
	{
		echo"il faut remplir tous les champs";
	}
?>

		