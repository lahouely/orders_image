<?php
session_start();

include_once('dbc.php');

if(isset($_GET['commande']) and isset($_GET['etat']))
	$bdd->exec('update commandes set etat=\''.$_GET['etat'].'\' where id=\''.$_GET['commande'].'\'');

header('location:commandes.php');
?>
