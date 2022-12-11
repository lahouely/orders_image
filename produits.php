<?php
session_start();

if(!isset($_GET['categorie']))
	header('location:categories.php');

include_once('dbc.php');

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
			if(isset($_SESSION['id']))
			{
				$req=$bdd->query('SELECT * FROM utilisateurs WHERE id=\''.$_SESSION['id'].'\'');	
				$resultat=$req->fetch();
				$req->closeCursor();
				$lastcommande=$resultat['lastcommande'];
			}
			
			$req=$bdd->query('SELECT * FROM categories WHERE id=\''.$_GET['categorie'].'\'');	
			$resultat=$req->fetch();
			$req->closeCursor();
		?>
		<h3>Produits de la categorie <?php echo $resultat['nom']; ?>:</h3>
		<table class="table">
				
		<?php
			
			$req=$bdd->query('SELECT * FROM produits WHERE categorie=\''.$_GET['categorie'].'\'');	
			while($resultat=$req->fetch())
			{
				echo '<tr><td>'.$resultat['nom'].'<br/><span class="petitepolice">'.$resultat['description'].'</span></td><td>'.$resultat['prix'].' DA</td>';
				if(isset($_SESSION['id']))
				{
				if($lastcommande!='')
				echo '<td><a href="commnaderproduit.php?produit='.$resultat['id'].'">[Commander]</a></td></tr>';
				else
				echo '<td>Cliquez sur nouvelle commande pour commander</td></tr>';
				
				}
				else
				echo '<td>inscrivez vous et connectez vous pour commander</td></tr>';
				
				
			}
			$req->closeCursor();
		?>
		</table>
	</div>
	</body>
</html>