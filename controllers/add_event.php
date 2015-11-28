<?php
// on se connecte à notre base
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=calendar', 'root', '');
    mysql_query("SET NAMES UTF8");
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }

?>
<html>
<head>
<title>Insertion dans la base</title>
</head>
<body>
<?php
// lancement de la requete
$req = $bdd->prepare('INSERT INTO event (id_professeur, id_group, title, description, start_date, end_date, hoursOfWork, id_category)
				 VALUES (:id_professeur,:idgroup,:title,:description,:startDate,:endDate,:hours,:idcategory)');
		//on passe en paramètre de la requete nos variables $_POST
		$reponse = $req->execute(array(
		  'id_professeur' => 1,
		  'idgroup' => $_POST['group_event'],
		  'title' => $_POST['title_event'],
		  'description' => $_POST['description_event'],
		  'startDate' => $_POST['startDate'],
		  'endDate' => $_POST['endDate'],
		  'hours' => $_POST['hours_event'],
		  'idcategory' => $_POST['category_event'],
		  ));

header('Location:../tasks_management.php?message=success'); 
?>
</body>
</html>