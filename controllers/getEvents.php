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
 	$array_eventObject[$key] = array(
 		'id' => $value['id'],
 		'title' => $value['title'],
 		'start' => $value['start_date'],
 		'end' => $value['end_date'],
 		);
 }
 // sending the encoded result to success page
 echo json_encode($array_eventObject);

?>