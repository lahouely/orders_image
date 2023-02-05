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

if(!(isset($_POST['Id']) and isset($_POST['Nom']) and isset($_POST['Description']) and isset($_POST['Prix']) and isset($_POST['Categorie'])))
{
	if(!isset($_GET['produit']))
	header('location:categories_admin.php');
}
else
{
	$bdd->exec('update produits set nom=\''.$_POST['Nom'].'\', description=\''.$_POST['Description'].'\',prix=\''.$_POST['Prix'].'\',categorie=\''.$_POST['Categorie'].'\' where id=\''.$_POST['Id'].'\'');
	//die('update produits set nom=\''.$_POST['Nom'].'\', description=\''.$_POST['Description'].'\',prix=\''.$_POST['Prix'].'\',categorie=\''.$_POST['Categorie'].'\' where id=\''.$_POST['Id'].'\'');
	header('location:produits_admin.php');
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
		<?php
			$req=$bdd->query('SELECT * FROM produits WHERE id=\''.$_GET['produit'].'\'');	
			$resultat=$req->fetch();
			$req->closeCursor();
			if($resultat)
			{
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
			
			var regex = /^[0-9]*(.[0-9]+)?$/;
			
			if(!regex.test(f.Prix.value))
			{
				alert("verifiez le Prix !");
				return false;
			}
			return true;
		}
	//-->
	</script>
		
		<h3>Modifier un produit:</h3>
		<table>
			<form method="post" id="formproduit" action="produit.php" onsubmit="return verif(this);">
				<tr>
					<td><label for="Nom">Nom:</label></td>
					<td><input id="Nom" name="Nom" type="text" size="40" value="<?php echo $resultat['nom']; ?>"/></td>
				</tr>
				<tr>
					<td><label for="Description">Description:</label></td>
					<td><input id="Description" name="Description" type="text" size="40" value="<?php echo $resultat['description']; ?>"/></td>
				</tr>
				<tr>
					<td><label for="Prix">Prix/unite (DA):</label></td>
					<td><input id="Prix" name="Prix" type="text" size="40" value="<?php echo $resultat['prix']; ?>"/></td>
				</tr>
				<tr>
					<td><label for="Categorie">Categorie:</label></td>
					<td>
						<select id="Categorie" name="Categorie">
						<?php
							$reponse=$bdd->query('select * from categories');
							while($temp=$reponse->fetch())
							{
								echo '<option value="'.$temp['id'].'"'.(($temp['id']==$resultat['categorie'])?' selected="selected"':'').'>'.$temp['nom'].'</option>';
							}
							$reponse->closeCursor();
						?>
						</select>
					</td>
				</tr>
				<input type="hidden" name="Id" value="<?php echo $_GET['produit']; ?>"/>
				<tr>
					<td colspan="2" style="text-align:center;"><input type="submit" value="valider" onsubmit="return verif(this);" /></td>
				</tr>
			</form>
		</table>
		<?php 
		}
		else
		{
			echo "<h3>Produit introuvable !</h3>";
		}
		?>
	</div>
	</body>
</html>