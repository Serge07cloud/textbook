<?php
try
{
    $dbap = new PDO('mysql:host=localhost; dbname=parcours_d_approbation; charset=utf8', 'root', '1234');
} catch (Exception $e) {
    //die('Erreur : ' . $e->getMessage());
    echo $e->getMessage();
}
?>
