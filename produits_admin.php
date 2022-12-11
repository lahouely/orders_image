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


if(!isset($_GET['categorie']))
	header('location:categories_admin.php');

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
				echo '<tr><td><a href="produit.php?produit='.$resultat['id'].'">'.$resultat['nom'].'</a><br/><span class="petitepolice">'.$resultat['description'].'</span></td><td>'.$resultat['prix'].' DA</td><td><a href="supprimerproduit.php?produit='.$resultat['id'].'" class="petitepolice">[Supprimer]</a></td></tr>';
				
			}
			$req->closeCursor();
		?>
		</table>
	</div>
	</body>
</html>