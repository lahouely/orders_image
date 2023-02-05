<?php
session_start();

//vérification
$ok=false;
if(isset($_SESSION['id']))
{
	if($_SESSION['id']==-1)
	{
		$ok=true;
	}
}

if(!$ok)
{
	header('location:index.php');
}

include_once('dbc.php');

if(isset($_GET['produit']))
	$bdd->exec('delete from produits where id=\''.$_GET['produit'].'\'');

header('location:categories_admin.php');
?>
