<?php
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