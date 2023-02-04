<?php

include_once('dbc.php');

if(isset($_POST))
{
	if ($_FILES['cv']['error'] > 0) $msg="Erreur lors du transfert";
	else if ($_FILES['cv']['size'] > 2000000) $msg="Le fichier est trop gros";
	else
	{
		$infosfichier = pathinfo($_FILES['cv']['name']);
		$extension_upload = $infosfichier['extension'];
		
		if($extension_upload!='doc')
			$msg="Extension incorrecte";
		else
		{
		srand((double)microtime()*1000000);
		$id=rand()%1000000;
		$bdd->exec('insert into cv (id,nom,prenom,niveau) values (\''.$id.'\',\''.$_POST['nom'].'\',\''.$_POST['prenom'].'\',\''.$_POST['niveau'].'\')') or die(print_r($bdd->errorInfo()));
		
		
		if(move_uploaded_file($_FILES['cv']['tmp_name'],'\\var\\www\\html\\cv\\'.$id.'.doc')) //Si la fonction renvoie TRUE, c'est que �a a fonctionn�...
	     {
	          $msg= 'Upload effectue avec succes !';
	     }
	     else 
	     {
	          $msg= 'Echec de l\'upload !';
	     }
		}
	}

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
		<h3><?php echo $msg;?></h3>
		
	</div>
	</body>
</html>