<?php
session_start();

if(isset($_SESSION['id']))		//si l utilisateur est deja connecte
	header('location:index.php');

if(isset($_GET['Id']) and isset($_GET['Code']))  
{
	include_once('dbc.php');
	$reponse=$bdd->query('select * from utilisateurs where email=\''.$_GET['Id'].'\' and confirmation=\''.$_GET['Code'].'\'') or die(print_r($bdd->errorInfo()));
	$existe=$reponse->fetch();
	$reponse->closeCursor();
	if(!$existe) header('location:index.php');
	
	$bdd->exec('update utilisateurs set confirmation=\'1111111111\' where email=\''.$_GET['Id'].'\'');
	header('location:confirmationreussite.php');
}
?>