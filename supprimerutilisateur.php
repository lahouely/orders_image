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

if(isset($_GET['utilisateur']))
	$bdd->exec('delete from utilisateurs where id=\''.$_GET['utilisateur'].'\'');

header('location:utilisateurs.php');
?>
