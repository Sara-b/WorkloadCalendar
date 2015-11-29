<?php
include 'connexion_bdd.php';


function get_eventsByPromotion($param)
{
    global $bdd;
            
    //if ($_SESSION['role'] == 3) {
		$req = $bdd->prepare('SELECT * FROM event 
							LEFT JOIN user ON event.id_professeur = user.id
	    					WHERE id_group=:id_promotion');  
	   
	   
	    $req->bindParam(':id_promotion', $_SESSION['id_promotion']);
	    $req->execute();
	    $events = $req->fetchAll();
    	return $events;
	//}
}

function get_promotion()
{
    global $bdd;
            
    //if ($_SESSION['role'] == 3) {
		$req = $bdd->prepare('SELECT * FROM promotion'); 
	   
	    $req->execute();
	    $promotions = $req->fetchAll();
    	return $promotions;
	//}
}

function search($mot){
        global $bdd;

        if(isset($mot) && $mot != "") // on vérifie d'abord l'existence du POST.
        {$req = $bdd->prepare("SELECT * FROM promotion WHERE LOWER(title) LIKE LOWER('%$mot%')");
            $req->execute();
            $resultat = $req->fetchAll();

            return $resultat;
         }
}

function update_event($param)
{
}

function get_event($param)
{
}

function delete_mission($param)
{
}


?>