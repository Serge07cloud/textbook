<?php
function getConnection(){
    try {
        return new PDO('mysql:host=localhost; dbname=ufhbedupxhonline; charset=utf8', 'root', '');
    } catch (Exception $e) {  return null;  }
}
