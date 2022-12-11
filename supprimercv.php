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

if(isset($_GET['cv']))
{
	$bdd->exec('delete from cv where id=\''.$_GET['cv'].'\'');
	system('ERASE D:\\Commandes\\xampp\\htdocs\\commandes\\vc\\'.$_GET['cv'].'.doc');
}
header('location:listecv.php');
?>
