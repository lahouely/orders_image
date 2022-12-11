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

if(isset($_SESSION['commande']))
{
	$commande=$_SESSION['commande'];
	unset($_SESSION['commande']);
}
else if(isset($_GET['commande']))
	$commande=$_GET['commande'];
else
	header('location:index.php');
	
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
	<div class="commande">
		<div style="text-align:center;"><img src="banner.png"/></div>
		<h3 style="text-align:center;">Bon de commande N�<?php echo $commande; ?>:</h3>
		<p>
		<?php 
			$req=$bdd->query('select * from utilisateurs where id=\''.$_SESSION['id'].'\'');
			$resultat=$req->fetch();
			$req->closeCursor();
			
			echo 'Nom:'.$resultat['nom'].'<br/>';
			echo 'Prenom:'.$resultat['prenom'].'<br/>';
			echo 'Adresse:'.$resultat['adresse'].'<br/>';
			echo 'Email:'.$resultat['email'].'<br/>';
			echo 'Tel:'.$resultat['tel'].'<br/>';
			
			$req=$bdd->query('select * from commandes where id=\''.$commande.'\'');
			$resultat=$req->fetch();
			$req->closeCursor();
			
			echo 'Adresse de livraison:'.$resultat['adresselivraison'].'<br/>';
		?>
		</p>
		<table class="table">
				<tr>
					<td>Produit</td><td>Qunantite</td><td>Prix/unite</td><td>Total</td>
		<?php 
			$req=$bdd->query('select * from detailcommandes as d left join produits as p on d.produit=p.id where d.commande=\''.$commande.'\'');
			$total=0;
			while($resultat=$req->fetch())
			{
				echo '<tr><td>'.$resultat['nom'].'</td>';
				echo '<td>'.$resultat['quantite'].'</td>';
				echo '<td>'.$resultat['prix'].' DA</td>';
				echo '<td>'.$resultat['prix']*$resultat['quantite'].'.00 DA</td></tr>';
				$total+=$resultat['prix']*$resultat['quantite'];
			}
			$req->closeCursor();
		?>
				</tr>
				<tr>
					<td  colspan="3" style="text-align:left;">TOTAL</td><td><?php echo $total; ?>.00 DA</td>
				</tr>
		</table>
	</div>
	</body>
</html>