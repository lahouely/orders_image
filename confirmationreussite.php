<?php
session_start();

if(isset($_SESSION['id']))		//si l utilisateur est deja connecte
	header('location:index.php');

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
		<h3>Termine</h3>
		<p>L'inscription est terminee, connecter vous avec votre email et motdepasse pour pouvoir commander nos produits.</p>
	</div>
	</body>
</html>