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
		<h3>Toutes les commandes :</h3>
		<table class="table">
		<tr><td>Code</td><td>Date</td><td>Adresselivraison</td><td>Etat</td><td>Changement de l'etat</td></tr>
		<?php
			$etats=array('incomplete','en attente','reçu et validee','achevee');
			$req=$bdd->query('SELECT * FROM commandes ORDER BY etat ASC');	
			while($resultat=$req->fetch())
			{
				echo '<tr><td><a href="imprimercommande_admin.php?commande='.$resultat['id'].'">'.$resultat['id'].'</a></td><td>'.$resultat['datecommande'].'</td><td>'.$resultat['adresselivraison'].'</td><td>';
				echo $etats[$resultat['etat']];
				if($resultat['etat']==1)
				echo '<a href="annuler.php?commande='.$resultat['id'].'"> [Annuler]</a>';
				
				echo '</td><td><a href="etatcommande.php?commande='.$resultat['id'].'&etat=2">[reçu et validee]</a>';
				echo '<a href="etatcommande.php?commande='.$resultat['id'].'&etat=3">[achevee]</a>';
				echo '<a href="annuler.php?commande='.$resultat['id'].'">[supprimer]</a>';
				
				echo '</td></tr>';
			}
			$req->closeCursor();
		?>
		</table>
	</div>
	</body>
</html>