<?php
session_start();
require '../models/User.php';
require '../models/Events.php';
include("../models/connexion_bdd.php");

?>
<?php

$events = get_eventsByPromotion();
$totalHoursOfWorkOnPeriod = 0;
 foreach ($events as $event) {
  if($event['end_date'] > $_POST['startDate']){
    $date1 = new DateTime($event['start_date']);
    $date2 = new DateTime($event['end_date']);
    $time = $date2->diff($date1);
    $hours = $time->h;
    $totalDays = $hours + ($time->days);
    $workTimeByDay = $totalDays / $event['hoursOfWork'];
    $totalWorkTimeForThisEvent=0;

    if($event['start_date'] > $_POST['startDate'] && $event['end_date'] < $_POST['endDate']){
      $totalWorkTimeForThisEvent = $workTimeByDay * $totalDays;
    }
    else if($event['start_date'] > $_POST['startDate'] && $event['end_date'] > $_POST['endDate']){
      $date1 = new DateTime($event['start_date']);
      $date2 = new DateTime($_POST['endDate']);
      $time = $date2->diff($date1);
      $hours = $time->h;
      $totalDays = $hours + ($time->days);
      $totalWorkTimeForThisEvent = $workTimeByDay * $totalDays;
    }
    else if($event['start_date'] < $_POST['startDate'] && $event['end_date'] < $_POST['endDate']){
      $date1 = new DateTime($_POST['startDate']);
      $date2 = new DateTime($event['end_date']);
      $time = $date2->diff($date1);
      $hours = $time->h;
      $totalDays = $hours + ($time->days);
      $totalWorkTimeForThisEvent = $workTimeByDay * $totalDays;
    }
    else if($event['start_date'] < $_POST['startDate'] && $event['end_date'] > $_POST['endDate']){
      $date1 = new DateTime($_POST['startDate']);
      $date2 = new DateTime($_POST['endDate']);
      $time = $date2->diff($date1);
      $hours = $time->h;
      $totalDays = $hours + ($time->days);
      $totalWorkTimeForThisEvent = $workTimeByDay * $totalDays;
    }
    $totalHoursOfWorkOnPeriod += $totalWorkTimeForThisEvent;
  }
 }

  $date1 = new DateTime($_POST['startDate']);
  $date2 = new DateTime($_POST['endDate']);
  $time = $date2->diff($date1);
  $hours = $time->h;
  $totalHours = $hours + ($time->days*24);
  
 if($totalHoursOfWorkOnPeriod > ($totalHours/100 * 7) || ($totalHoursOfWorkOnPeriod + $_POST['hours_event']) > ($totalHours/100 * 7)){
    $message = "too_many_hours";
 }
 else {
// lancement de la requete
$req = $bdd->prepare('INSERT INTO event (id_professeur, id_promotion, title, description, start_date, end_date, hoursOfWork)
				 VALUES (:id_professeur,:id_promotion,:title,:description,:startDate,:endDate,:hours)');
		//on passe en paramètre de la requete nos variables $_POST
	try{
		$reponse = $req->execute(array(
		  'id_professeur' => $_SESSION['id'],
		  'id_promotion' => $_POST['promotion_id'],
		  'title' => $_POST['title_event'],
		  'description' => $_POST['description_event'],
		  'startDate' => $_POST['startDate'],
		  'endDate' => $_POST['endDate'],
		  'hours' => $_POST['hours_event']
		  ));
		
		$message = 'success';
	}

	catch (Exception $e){
		$message = 'fail';
	}

 }
	header('Location:../add_event.php?message='.$message); 

?>