<?php
session_start();

if(isset($_SESSION['id']))		//si l utilisateur est deja connecte
	header('location:index.php');

if(isset($_POST['Nom']) AND isset($_POST['Prenom']) AND isset($_POST['Email']) AND isset($_POST['Tel']) AND isset($_POST['Adresse']) AND isset($_POST['motdepasse1']) AND isset($_POST['motdepasse2']))  
{
	include_once('dbc.php');
	include_once('password.php');
	$reponse=$bdd->query('select * from utilisateurs where email=\''.$_POST['Email'].'\'') or die(print_r($bdd->errorInfo()));
	$existe=$reponse->fetch();
	$reponse->closeCursor();
	if($existe) die("Cette E'mail existe deja!");
	
	//$confirmation=randomstring(10);
	$confirmation="1111111111";

	$bdd->exec('insert into utilisateurs(nom,prenom,email,tel,adresse,motdepasse,confirmation,dateinscription) values (\''.$_POST['Nom'].'\',\''.$_POST['Prenom'].'\',\''.$_POST['Email'].'\',\''.$_POST['Tel'].'\',\''.$_POST['Adresse'].'\',MD5(\''.$_POST['motdepasse1'].'\'),\''.$confirmation.'\',CURDATE())');
	
	//if(!mail($_POST['Email'],'confirmation','http://localhost/commandes/confirmation.php?Id='.$_POST['Email'].'&Code='.$confirmation,'From: admin@localhost'))
	//die ('l\'envoi du mail a echouer');
	
	header('location:inscriptionreussite.php');
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
	
	<script type="text/javascript">
	<!--
		function verif(f)
		{
			if(f.Nom.value=="")
			{
				alert("le champ Nom est vide !");
				return false;
			}
			if(f.Prenom.value=="")
			{
				alert("le champ Prenom est vide !");
				return false;
			}
			
			if(f.Email.value=="")
			{
				alert("le champ Email est vide !");
				return false;
			}
			if(f.Tel.value=="")
			{
				alert("le champ Tel est vide !");
				return false;
			}
			if(f.Adresse.value=="")
			{
				alert("le champ Adresse est vide !");
				return false;
			}
			if(f.motdepasse1.value=="")
			{
				alert("le motdepasse est vide !");
				return false;
			}
			if(f.motdepasse1.value!=f.motdepasse2.value)
			{
				alert("les deux mots de passe sont differents !");
				return false;
			}
			return true;
		}
	//-->
	</script>

	<div class="page">
		<form method="post" id="forminscription" action="inscription.php" onsubmit="return verif(this);">
		<table>
				<tr>
					<td colspan="2" style="text-align:center;"><h3>Inscription</h3></td>
				</tr>
				<tr>
					<td><label for="Nom">Nom:</label></td>
					<td><input id="Nom" name="Nom" type="text" size="40"/></td>
				</tr>
				<tr>
					<td><label for="Prenom">Prenom:</label></td>
					<td><input id="Prenom" name="Prenom" type="text" size="40"/></td>
				</tr>
				<tr>
					<td><label for="Email">Email:</label></td>
					<td><input id="Email" name="Email" type="text" size="40"/></td>
				</tr>
				<tr>
					<td><label for="Tel">Tel:</label></td>
					<td><input id="Tel" name="Tel" type="text" size="40"/></td>
				</tr>
				<tr>
					<td><label for="Adresse">Adresse:</label></td>
					<td><input id="Adresse" name="Adresse" type="text" size="40"/></td>
				</tr>
				<tr>
					<td><label for="motdepasse1">Mot de passe:</label></td>
					<td><input id="motdepasse1" name="motdepasse1" type="password" size="40"/></td>
				</tr>
				<tr>
					<td><label for="motdepasse2">Verification:</label></td>
					<td><input id="motdepasse2" name="motdepasse2" type="password" size="40"/></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;"><input type="submit" value="valider"/></td>
				</tr>
			</table>
		</form>
	</div>
	</body>
</html>
