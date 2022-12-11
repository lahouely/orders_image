<?php

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
			
			if(f.Niveau.value=="")
			{
				alert("le champ Niveau est vide !");
				return false;
			}
			
			return true;
		}
	//-->
	</script>
	
	<div class="page">
		<h3>Upload d'un CV :</h3>
		<table class="table">	
		<?php
			
			$req=$bdd->query('SELECT val FROM systeme WHERE param="cv"');	
			$resultat=$req->fetch();
			$req->closeCursor();
			
			if($resultat['val']=="0")
			{
				echo '<p>le depos des CVs est désactivé par l\'administrateur</p>';
			}
			else
			{
			?>
			<table>
				<form method="post" action="uploadcv.php" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
				<tr>
					<td>
						<label for="nom">Nom:</label>
					</td>
					<td>
						<input type="nom" id="nom" name="nom" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="prenom">Prenom:</label>
					</td>
					<td>
						<input type="prenom" id="prenom" name="prenom" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="niveau">Niveau:</label>
					</td>
					<td>
						<input type="niveau" id="niveau" name="niveau" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="file">CV (format .doc | max. 2Mo):</label>
					</td>
					<td>
						<input type="file" id="file" name="cv" />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center; padding:auto; margin:auto;">
						<input type="submit" value="envoyer" onsubmit="return verif(this);" />
					</td>
				</tr>
				</form>
			<?php
			}
			?>
		</table>
	</div>
	</body>
</html>