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

if(!isset($_POST['Produit']) OR !isset($_POST['Quantitee']))
	header('location:categories.php');
	
include_once('dbc.php');

$req=$bdd->query('select lastcommande from utilisateurs where id=\''.$_SESSION['id'].'\'');
$resultat=$req->fetch();
$req->closeCursor();

$commande=$resultat['lastcommande'];

$req=$bdd->query('select prix from produits where id=\''.$_POST['Produit'].'\'');
$resultat=$req->fetch();
$req->closeCursor();

$prix=$resultat['prix'];

//die('select * from commandes where utilisateur=\''.$_SESSION['id'].'\' and id=\''.$commande.'\'');
$req=$bdd->query('select * from commandes where utilisateur=\''.$_SESSION['id'].'\' and id=\''.$commande.'\'');
$resultat=$req->fetch();
$req->closeCursor();
//die(print_r($resultat));
if(!$resultat)
{
	header('location:categories.php');
}

$bdd->exec('insert into detailcommandes (commande,produit,quantite,prix) values(\''.$commande.'\',\''.$_POST['Produit'].'\',\''.$_POST['Quantitee'].'\',\''.$prix.'\')');
header('location:categories.php');
?>