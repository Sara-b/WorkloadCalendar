<?php
include 'connexion_bdd.php';


function get_eventsByPromotion()
{
    global $bdd;
            
    if ($_SESSION['role'] == 3) {
		$req = $bdd->prepare('SELECT * FROM event 
							LEFT JOIN user ON event.id_professeur = user.id
	    					WHERE id_group=:id_promotion');  
	   //var_dump($_GET); die();
	    $req->bindParam(':id_promotion', $_SESSION['id_promotion']);
	    $req->execute();
	    $events = $req->fetchAll();
    	return $events;
	}

    if ($_SESSION['role'] == 2 || $_SESSION['role'] == 2) {
        $req = $bdd->prepare('SELECT * FROM event 
                            LEFT JOIN user ON event.id_professeur = user.id
                            WHERE id_group=:id_promotion');  
       //var_dump($_GET); die();
        $req->bindParam(':id_promotion', $_GET['promotion_id']);
        $req->execute();
        $events = $req->fetchAll();
        return $events;
    }
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

function delete_event($param)
{
	global $bdd;
        die();
    $req = $bdd->prepare('DELETE FROM event WHERE id=:id');
    $req->bindParam(':id', $param['id']);
    $req->execute();
    $event = $req->fetch(); 
    
    return $event;
}


?>