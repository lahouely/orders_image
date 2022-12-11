<?php
session_start();

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
		<h3>Categories</h3>
		<table class="table">
		<?php
			
			$req=$bdd->query('SELECT * FROM categories');	
			while($resultat=$req->fetch())
			{
				echo '<tr><td><a href="produits.php?categorie='.$resultat['id'].'">'.$resultat['nom'].'</a></td><td><span class="petitepolice">'.$resultat['description'].'</span></td></tr>';
			}
			$req->closeCursor();
		?>
		</table>
	</div>
	</body>
</html>