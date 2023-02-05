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
		<a href="actup.php">activer l'upload</a><br/>
		<a href="disup.php">deactiver l'upload</a><br/>
		<a href=""></a>
		<h3>Condidats :</h3>
		<table class="table">
				
		<?php
			
			$req=$bdd->query('SELECT * FROM cv ORDER BY nom,prenom ASC');	
			while($resultat=$req->fetch())
			{
				echo '<tr><td><span class="petitepolice">'.$resultat['nom'].'<br/>'.$resultat['prenom'].'</span></td><td><span class="petitepolice">'.$resultat['niveau'].'</span></td><td><a href="supprimercv.php?cv='.$resultat['id'].'" class="petitepolice">[Supprimer]</a></td><td><a href="cv\\'.$resultat['id'].'.doc" class="petitepolice">[Telecharger]</a></td></tr>';
			}
			$req->closeCursor();
		?>
		</table>
	</div>
	</body>
</html>