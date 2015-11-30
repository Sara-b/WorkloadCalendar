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


function add_event($param){
	$req = $bdd->prepare('INSERT INTO event (id_professeur, id_promotion, title, description, start_date, end_date, hoursOfWork, id_category)
			 VALUES (:id_professeur,:id_promotion,:title,:description,:startDate,:endDate,:hours,:idcategory)');
	//on passe en paramètre de la requete nos variables $_POST
	try{
		$reponse = $req->execute(array(
		  'id_professeur' => 1,
		  'id_promotion' => $_POST['group_event'],
		  'title' => $_POST['title_event'],
		  'description' => $_POST['description_event'],
		  'startDate' => $_POST['startDate'],
		  'endDate' => $_POST['endDate'],
		  'hours' => $_POST['hours_event'],
		  'idcategory' => $_POST['category_event'],
		  ));
		$message = 'success';
	}
	catch (Exception $e) {
		$message = 'fail';
	}
	header('Location:../add_event.php?message='.$message); 
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

function get_events_json(){
	 global $bdd;
	 // Query that retrieves events
	 $requete = $bdd->prepare("SELECT * FROM event WHERE id_promotion=:id_promotion");
	 $requete->execute(array(
	 				'id_promotion' => $_SESSION['id_promotion']
				  	));

	 $data = $requete->fetchAll(PDO::FETCH_ASSOC);
	 $array_eventObject = array();
	 
	 foreach ($data as $key => $value) {
	 	$array_eventObject[$key] = array(
	 		'id' => $value['id'],
	 		'title' => $value['title'],
	 		'start' => $value['start_date'],
	 		'end' => $value['end_date'],
	 		);
	 }
	 // sending the encoded result to success page
	 echo json_encode($array_eventObject);
}

?>