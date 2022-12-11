<?php
include_once('dbc.php');

?>
<table  class="menu">
	<tr>
		<td style="text-align:center;"><span class="petitepolice">Bonjour <?php echo $_SESSION['nom'].' '.$_SESSION['prenom'] ?></span></td>
	<tr>
	<tr>
		<td style="text-align:center;"><span class="petitepolice"><a href="index.php">Acceuil</a></span></td>
	<tr>
	<tr>
		<td style="text-align:center;"><span class="petitepolice"><a href="deconnexion.php">Déconnexion</a></span></td>
	<tr>
	<tr>
		<td style="text-align:center;"><span class="petitepolice">
		<?php 
			$req=$bdd->query('select * from utilisateurs where id=\''.$_SESSION['id'].'\'');
			$resultat=$req->fetch();
			$req->closeCursor();
			//die(print_r($resultat));
			if($resultat['lastcommande']!='')
				echo '<a href="terminercommande.php">Terminer commande</a>';
			else
				echo '<a href="nouvellecommande.php">Nouvelle commande</a>';
		?>
		
		</span></td>
	<tr>
	<tr>
		<td style="text-align:center;"><span class="petitepolice"><a href="produits.php">Produits</a></span></td>
	<tr>
	<tr>
		<td style="text-align:center;"><span class="petitepolice"><a href="listecommandes.php">Liste de commandes</a></span></td>
	<tr>
	
</table>