<?php
session_start();

if(!isset($_GET['produit']))
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
	<script type="text/javascript">
	<!--
		function verif(f)
		{
			var regex = /^[0-9]+$/;
			
			if(!regex.test(f.Quantitee.value))
			{
				alert("Quantitee invalide !");
				return false;
			}
			
			return true;
		}
	//-->
	</script>
	<div class="page">
		<?php
			
			$req=$bdd->query('SELECT * FROM produits WHERE id=\''.$_GET['produit'].'\'');	
			$resultat=$req->fetch();
			$req->closeCursor();
		?>
		<h3>Entrez la quantitee du produit "<?php echo $resultat['nom']; ?>" :</h3>
		<form method="post" action="affcommande.php" onsubmit="return verif(this);">
			<table>
				<tr>
					<td><label for="Quantitee">Quantitee:</label></td>
					<td><input id="Quantitee" name="Quantitee" type="text" size="40"/></td>
				</tr>
				
				<input id="Produit" name="Produit" type="hidden" value="<?php echo $_GET['produit']; ?>"/></td>
				
				<tr>
					<td colspan="2" style="text-align:center;"><input type="submit" value="valider"/></td>
				</tr>
			</table>
		</form>
	</div>
	</body>
</html>