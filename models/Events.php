<?php
include 'connexion_bdd.php';


function get_eventsByPromotion()
{
    global $bdd;
            
    if ($_SESSION['role'] == 3) {
		$req = $bdd->prepare('SELECT * FROM event 
							LEFT JOIN user ON event.id_professeur = user.id
	    					WHERE event.id_promotion=:id_promotion');  
	   //var_dump($_GET); die();
	    $req->bindParam(':id_promotion', $_SESSION['id_promotion']);
	    $req->execute();
	    $events = $req->fetchAll();
    	return $events;
	}

    if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
        $req = $bdd->prepare('SELECT * FROM event 
                            LEFT JOIN user ON event.id_professeur = user.id
                            WHERE event.id_promotion=:id_promotion');  
       //var_dump($_GET); die();
        $req->bindParam(':id_promotion', $_GET['promotion_id']);
        $req->execute();
        $events = $req->fetchAll();
        return $events;
    }
}

function get_eventsByPromotionPost($promotion_id)
{
    global $bdd;
            
    if ($_SESSION['role'] == 3) {
		$req = $bdd->prepare('SELECT * FROM event 
							LEFT JOIN user ON event.id_professeur = user.id
	    					WHERE event.id_promotion=:id_promotion');  
	   //var_dump($_GET); die();
	    $req->bindParam(':id_promotion', $_SESSION['id_promotion']);
	    $req->execute();
	    $events = $req->fetchAll();
    	return $events;
	}

    if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
        $req = $bdd->prepare('SELECT * FROM event 
                            LEFT JOIN user ON event.id_professeur = user.id
                            WHERE event.id_promotion=:id_promotion');  
       //var_dump($_GET); die();
        $req->bindParam(':id_promotion', $promotion_id);
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
        //var_dump($promotions);die();
    	return $promotions;
	//}
}

function get_event($param)
{
    global $bdd;
            
    $req = $bdd->prepare('SELECT * FROM event 
                        LEFT JOIN user ON event.id_professeur = user.id
                        WHERE event.id=:event_id '); 
   
    //var_dump($param);
    $req->bindParam(':event_id', $param['id']); 
    $req->execute();
    $event = $req->fetchAll();
    //var_dump($event);die();

    return $event;
}

function update_event($param)
{
	global $bdd;

	
}


function add_event($param){
	$req = $bdd->prepare('INSERT INTO event (id_professeur, id_promotion, title, description, start_date, end_date, hoursOfWork)
			 VALUES (:id_professeur,:id_promotion,:title,:description,:startDate,:endDate,:hours)');
	//on passe en paramètre de la requete nos variables $_POST
	try{
		$reponse = $req->execute(array(
		  'id_professeur' => 1,
		  'id_promotion' => $_POST['group_event'],
		  'title' => $_POST['title_event'],
		  'description' => $_POST['description_event'],
		  'startDate' => $_POST['startDate'],
		  'endDate' => $_POST['endDate'],
		  'hours' => $_POST['hours_event']
		  ));
		$message = 'success';
	}
	catch (Exception $e) {
		$message = 'fail';
	}
	header('Location:../add_event.php?message='.$message); 
}

function delete_event($event_id)
{
	global $bdd;
       // die();
    $req = $bdd->prepare('DELETE FROM event WHERE id=:id');
    $req->bindParam(':id', $event_id);
    $req->execute();
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