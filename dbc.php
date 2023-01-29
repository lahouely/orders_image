<?php
try
{
	$bdd = new PDO('mysql:host=orders-db-mysql-flexible-server.mysql.database.azure.com;dbname=orders-db;charset=UTF8','youcef','pWMv2tsRRKy#t@');
}
catch(Exeption	$e)
{
	die($e->getMessage());
}
?>
