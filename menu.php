<?php
		echo '<span>pod: '.explode("-",gethostname())[4].'</span>';
		if(isset($_SESSION['id']))
		{
			if($_SESSION['id']==-1)
				include('menu_admin.php');
			else
				include('menu_utilisateur.php');
		}
		else
		{
			include('menu_invite.php');
		}
?>