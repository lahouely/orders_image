<?php
session_start();

//vérification
$ok=false;
if(isset($_SESSION['id']))
{
	if($_SESSION['id']>=0)
	{
		$ok=true;
	}
}

if(!$ok)
{
	header('location:index.php');
}

include_once('dbc.php');

$req=$bdd->query('select * from utilisateurs where id=\''.$_SESSION['id'].'\'');
$resultat=$req->fetch();
$req->closeCursor();
//die(print_r($resultat));
if($resultat['lastcommande']=='')
{
	header('location:index.php');
}

	$bdd->exec('update commandes set etat=1 where id=\''.$resultat['lastcommande'].'\'');
	$bdd->exec('update utilisateurs set lastcommande=NULL where id=\''.$_SESSION['id'].'\'');
	$_SESSION['commande']=$resultat['lastcommande'];
	header('location:imprimercommande.php');

?>