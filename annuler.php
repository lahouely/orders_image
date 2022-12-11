<?php
session_start();

if(!$ok)
{
	header('location:index.php');
}

include_once('dbc.php');

if(isset($_GET['commande']))
	$bdd->exec('delete from commandes where id=\''.$_GET['commande'].'\'');

header('location:listecommandes.php');
?>
