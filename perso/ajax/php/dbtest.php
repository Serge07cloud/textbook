<?php
try
{
    $bdtest = new PDO('mysql:host=localhost; dbname=enseignement_universite; charset=utf8', 'root', '1234');
} catch (Exception $e) {
    //die('Erreur : ' . $e->getMessage());
    echo $e->getMessage();
}
?>
