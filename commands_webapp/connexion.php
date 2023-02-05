<?php 
session_start();
if(isset($_SESSION['id']))
{
	header('location:index.php');
}
if(isset($_POST['email']) AND isset($_POST['motdepasse']))
{
	include_once('dbc.php');
	
	if($_POST['email']=='admin')
	{
		$req=$bdd->query('select * from systeme where param=\'mdpadmin\' and val=MD5(\''.$_POST['motdepasse'].'\')') or die(print_r($bdd->errorInfo()));
		if($req->fetch())
		{
			$_SESSION['id']=-1;
			$req->closeCursor();
			header('location:index.php');
		}
		
		$req->closeCursor();
	}
	
	$req=$bdd->query('select id from utilisateurs where email =\''.$_POST['email'].'\'');
	if(!$req->fetch())
		$msg="verifier votre e-mail:>>".$_POST['email']."<<.";
	$req->closeCursor();
	
	if(!isset($msg))
	{
		$req=$bdd->query('select * from utilisateurs where email =\''.$_POST['email'].'\' and motdepasse = MD5(\''.$_POST['motdepasse'].'\')');
		if($reponse=$req->fetch())
		{
			if($reponse['confirmation']!="1111111111" and $reponse['confirmation']!="0000000000")
			{
				$msg="activez d'abord votre compte en cliquant sur le lien dans l'email .";
			}
			else
			{
				$_SESSION['id']=$reponse['id'];
				$_SESSION['nom']=$reponse['nom'];
				$_SESSION['prenom']=$reponse['prenom'];
				$bdd->exec('delete from commandes where id=\''.$reponse['lastcommande'].'\'');
				$bdd->exec('update utilisateurs set lastcommande=NULL where id=\''.$_SESSION['id'].'\'');
			}
		}
		else
			$msg="l\'e-mail existe mais le mot de passe est errone.";
		
		$req->closeCursor();
	}
	
	if(!isset($msg))header('location:index.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="design.css">
		<title>index</title>
	</head>
	<body>
	<?php
		include('tete.php');
		include('menu.php');
	?>

	<div class="page">
		<h3>Impossible de se connecter</h3>
		<p><?php echo $msg; ?></p>
	</div>
	</body>
</html>