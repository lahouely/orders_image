<?php
try
{
	$bdd = new PDO('mysql:host=10.2.0.4;dbname=orders-db;charset=UTF8','youcef','pWMv2tsRRKy#t@');
}
catch(Exeption	$e)
{
	die($e->getMessage());
}
?>
