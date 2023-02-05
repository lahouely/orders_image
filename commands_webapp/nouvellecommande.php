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
if($resultat['lastcommande']!='')
{
	header('location:categories.php');
}

if(isset($_GET['Adresse']))
{
	$req=$bdd->query('select id from commandes ORDER BY id desc');
	if($resultat=$req->fetch())
		$id=$resultat['id']+1;
	else 
		$id=1;
		
	$req->closeCursor();
	
	$bdd->exec('insert into commandes (id,adresselivraison,utilisateur,datecommande,etat) values (\''.$id.'\',\''.$_GET['Adresse'].'\',\''.$_SESSION['id'].'\',CURDATE(),0)');
	$bdd->exec('update utilisateurs set lastcommande=\''.$id.'\' where id=\''.$_SESSION['id'].'\'');
	
	header('location:categories.php');
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
		<script type="text/javascript">
	<!--
		function verif(f)
		{
			if(f.Adresse.value=="")
			{
				alert("le champ Nom est vide !");
				return false;
			}
			
			return true;
		}
	//-->
	</script>
		
		<h3>Nouvelle commande:</h3>
		<table>
			<form method="get" action="nouvellecommande.php" onsubmit="return verif(this);">
				<tr>
					<td colspan="2" style="text-align:center;">Entrez l'adresse de livraison ou choisissez une dans la liste.</td>
				</tr>
				<tr>
					<td><label for="Adresse">Adresse livraison:</label></td>
					<td><input id="Adresse" name="Adresse" type="text" size="40" /></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;"><input type="submit" value="valider" onsubmit="return verif(this);" /></td>
				</tr>
				<?php
					$req=$bdd->query('select distinct adresselivraison from commandes where utilisateur=\''.$_SESSION['id'].'\'');
					while($resultat=$req->fetch())
					{
				?>
					<tr>
						<td colspan="2" style="text-align:center;"><a href="<?php echo 'nouvellecommande.php?Adresse='.$resultat['adresselivraison']; ?>"><?php echo $resultat['adresselivraison']; ?></a></td>
					</tr>
				<?php
					}
					$req->closeCursor();
				?>
			</form>
		</table>
	</div>
	</body>
</html>