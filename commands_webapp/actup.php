<?php
session_start();


//v�rification
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

$bdd->exec('update systeme set val=\'1\' where param=\'cv\'');

header('location:listecv.php');
?>
