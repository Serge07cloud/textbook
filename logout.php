<?php
session_start();
$helper = array_keys($_SESSION);
foreach ($helper as $key){
    unset($_SESSION[$key]);
}

if (session_destroy()) {
    header("Location:connexion.php");
}
?>
