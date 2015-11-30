<?php
session_start();
require '../models/User.php';
require '../models/Events.php';
include("../models/connexion_bdd.php");
?>

<?php
// List of events
 $json = array();
$_SESSION['id_promotion'] = 1;
 // Query that retrieves events
 $requete = $bdd->prepare("SELECT * FROM event WHERE id_promotion=:id_promotion");
 $requete->execute(array(
 				'id_promotion' => $_SESSION['id_promotion']
			  	));

 $data = $requete->fetchAll(PDO::FETCH_ASSOC);
 $array_eventObject = array();
 
 foreach ($data as $key => $value) {
 	$workHours = $value['hoursOfWork'];
 	//Calcul du nombre d'heures entre la date de début et la date de fin
 	$date1 = new DateTime($value['start_date']);
	$date2 = new DateTime($value['end_date']);
 	$time = $date2->diff($date1);
	$hours = $time->h;
	$totalHours = $hours + ($time->days*24);

	//on travaille 7% du temps de la journée (2h par jour)
	if($totalHours > 0){
	 	if($workHours > ($totalHours/100 * 7)){
 			$color = '#C30101';
	 	}
	 	else if($workHours < ($totalHours/100 * 7) && $workHours > ($totalHours/100 * 4)){
	 		$color = '#C4430B';
	 	}
	 	else if($workHours < ($totalHours/100 * 4) && $workHours > ($totalHours/100 * 2)){
	 		$color = '#F4A723';
	 	}
	 	else if($workHours <= ($totalHours/100 * 2)){
	 		$color = '#9CD023';
	 	}
	}
 	else {
 		$color = '#3BA4D1';
 	}
	
 	$array_eventObject[$key] = array(
 		'id' => $value['id'],
 		'title' => $value['title'],
 		'start' => $value['start_date'],
 		'end' => $value['end_date'],
 		'color' => $color
 		);
 }
 // sending the encoded result to success page
 echo json_encode($array_eventObject);

?>