<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=database_1','root','');
}
catch(Exeption	$e)
{
	die($e->getMessage());
}
?>