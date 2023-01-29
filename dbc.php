<?php
try
{
	$bdd = new PDO('mysql:host=mydatabase;dbname=database_1;charset=UTF8','dbuser','dbuser');
}
catch(Exeption	$e)
{
	die($e->getMessage());
}
?>
