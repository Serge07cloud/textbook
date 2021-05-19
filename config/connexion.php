<?php
try
{
//	$bdd = new PDO('mysql:host=us-cdbr-east-03.cleardb.com; dbname=heroku_0802dd7b3d10f9b; charset=utf8', 'be4578df0b10d3', '363d8329');
	$bdd = new PDO('mysql:host=localhost; dbname=ufhbedupxhonlines; charset=utf8', 'root', '');
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
