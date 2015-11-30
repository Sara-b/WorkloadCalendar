<?php
session_start();
require '../models/User.php';
require '../models/Events.php';
include("../models/connexion_bdd.php");

?>
<?php
$events = get_eventsByPromotionPost($_POST['promotion_id']);

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
  try{
// lancement de la requete
  $requete = $bdd->prepare("UPDATE event
                  SET id_promotion=:id_promo, title=:title, description=:description, start_date=:start_date, end_date=:end_date, hoursOfWork=:hours
                  WHERE id=:id");
      // l'execution 
      $requete->bindParam(':id_promo', $_POST['promotion_id']);
      $requete->bindParam(':title', $_POST['title_event']);
      $requete->bindParam(':description', $_POST['description_event']);
      $requete->bindParam(':start_date', $_POST['startDate']);
      $requete->bindParam(':end_date', $_POST['endDate']);
      $requete->bindParam(':hours', $_POST['hours_event']);
      $requete->bindParam(':id', $_GET['id']);
      $requete->execute();
      $message = 'success';
    }

  catch (Exception $e){
    $message = 'fail';
  }

 }
  header('Location:../update_event.php?id='.$_GET['id'].'&message='.$message); 

?>