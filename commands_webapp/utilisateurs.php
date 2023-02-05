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
		<h3>Utilisateurs :</h3>
		<table class="table">
				
		<?php
			
			$req=$bdd->query('SELECT * FROM utilisateurs ORDER BY nom,prenom ASC');	
			while($resultat=$req->fetch())
			{
				echo '<tr><td><span class="petitepolice">'.$resultat['email'].'<br/>'.$resultat['nom'].'<br/>'.$resultat['prenom'].'</span></td><td><span class="petitepolice">'.$resultat['adresse'].'<br/>TEL: '.$resultat['tel'].'<br/>Date d\'inscription: '.$resultat['dateinscription'].'</span></td><td><a href="supprimerutilisateur.php?utilisateur='.$resultat['id'].'" class="petitepolice">[Supprimer]</a></td></tr>';
				
			}
			$req->closeCursor();
		?>
		</table>
	</div>
	</body>
</html>